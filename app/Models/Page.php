<?php

namespace App\Models;

use App\Observers\PageObserver;
use App\Scopes\ActiveScope;
use App\Traits\Translatable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Carbon;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Str;
use Kalnoy\Nestedset\NodeTrait;

class Page extends Model
{
    use NodeTrait;
    use Translatable;

    public const MENU_TYPE = [
        0 => 'header',
        1 => 'footer',
    ];

    public static function boot()
    {
        parent::boot(); // TODO: Change the autogenerated stub
        static::addGlobalScope(new ActiveScope());
        self::observe(PageObserver::class);
    }

    public $translatableAttributes = [
        'title',
        'slug',
        'body',
        'meta_desc',
    ];

    public static $langColumnName = 'lang';
    public static $translatableFK = 'page_id';

    protected $fillable = [
        'parent_id',
        '_lft',
        '_rgt',
        'status',
        'type',
    ];

    public function getTypeAttribute($value)
    {
        return json_decode($value);
    }

    public function setTypeAttribute($value)
    {
        $this->attributes['type'] = json_encode($value);
    }

    public function translation()
    {
        return $this->hasMany(PageTranslation::class, 'page_id', 'id');
    }

    public function currentLanguage()
    {
        return $this->translation()->where('lang', app()->getLocale());
    }

    public function generateSlug()
    {
        $slugs = Page::with(['translation' => function ($query) {
            $query->select(['page_id', 'slug', 'lang', 'title']);
            $query->where('lang', app()->getLocale());
        }])->ancestorsAndSelf($this->id, ['id'])->map(function ($item) {
            return Str::slug($item->translation->first()->title);
        })->toArray();

        return implode("-", $slugs);
    }

    public function createNewSlug($newTitle)
    {
        $selfSlug = Str::slug($newTitle);

        return implode("-", [$this->generateSlug(), $selfSlug]);
    }

    public function scopeParentPage($query, $type = 0, $prependValue = "Parent page", $prependKey = 0)
    {
        return self::query()->select(['id'])
            ->with(['currentLanguage'])
            ->get()
            ->currentLanguage()
            ->pluck('title', 'id')
            ->prepend($prependValue, $prependKey)
            ->toArray();
    }

    public function scopeNavbar($query, $type = 'header')
    {
        $cacheKey = $type . '.' . app()->getLocale();
        $type = in_array($type, self::MENU_TYPE) ? array_search($type, self::MENU_TYPE) : 'header';

        return Cache::remember($cacheKey, Carbon::now()->addMonths(), function () use ($type) {
            return self::whereHas('currentLanguage')
                ->with(['children', 'currentLanguage'])
                ->defaultOrder()
                ->whereIsRoot()
                ->where('type', 'LIKE', '%"' . $type . '"%')
                ->get()
                ->currentLanguage();
        });
    }

    public function scopeFindBySlug($query, $slug)
    {
        $page = self::query()->whereHas('translation', $filter = function ($query) use ($slug) {
            $query->where('slug', $slug);
        })->with(['currentLanguage', 'children'])->get();

        if ( !$page->count() || !$page->first()->currentLanguage->count() ) {
            return abort(404);
        }

        return $page->currentLanguage()->first();
    }

    public function scopeHomePage($query)
    {
        $result = new Collection();
        $homePage = self::with(['currentLanguage'])->defaultOrder()->whereIsRoot()->first();

        if (!$homePage->currentLanguage->count()){
            return abort(404);
        }

        return $result->add($homePage)->currentLanguage()->first();
    }

    public function scopeFindForTranslationById($query, $id, $language)
    {
        app()->setLocale($language);

        $page = self::query()->withoutGlobalScopes()->with(['currentLanguage'])->where('id', $id)->get();

        if ( !$page->count() || !$page->first()->currentLanguage->count() ) {
            return $page->first();
        }

        return $page->currentLanguage()->first();
    }

    public static function removeNavbarCache()
    {
        foreach (self::MENU_TYPE as $type) {
            foreach (array_keys(app('languages')) as $language) {
                Cache::forget($type . '.' . $language);
            }
        }
    }

    public function getMenuTypeHuman()
    {
        $response = [];

        foreach ($this->type as $type) {
            $response[] = self::MENU_TYPE[$type];
        }
        return implode(", ", $response);
    }

    public function children()
    {
        return $this->hasMany(get_class($this), $this->getParentIdName())->setModel($this)->with('currentLanguage');
    }
}
