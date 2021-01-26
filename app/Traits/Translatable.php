<?php


namespace App\Traits;


use App\Models\Page;
use Illuminate\Support\Facades\DB;

trait Translatable
{
    public function scopeCreateData($query, array $data, self $parent = null)
    {
        /**
         * @param $page Page
         */

        DB::beginTransaction();

        if ( is_null($parent) ) {
            $save = self::create(array_diff_key($data, $this->fillable, app('languages')));
        } else {
            $save = $parent->children()->create(array_diff_key($data, $this->fillable, app('languages')));
        }

        if ( !$save ) {
            return false;
        }

        $translatableData = array_intersect_key($data, app('languages'));

        if ( empty($translatableData) ) {
            DB::rollBack();
            return false;
        }

        foreach ($translatableData as $key => $value) {

            $value[self::$langColumnName] = $key;
            $value[self::$translatableFK] = $save->id;

            $save->translation()->create($value);
        }

        DB::commit();
        return true;
    }

    public function updateData(array $data)
    {
        DB::beginTransaction();

        $update = $this->update(array_diff_key($data, $this->fillable, app('languages')));

        if ( !$update ) {
            return false;
        }

        $translatableData = array_intersect_key($data, app('languages'));

        if ( empty($translatableData) ) {
            DB::rollBack();
            return false;
        }

        foreach ($translatableData as $key => $value) {
            $find = $this->translation()->where(self::$langColumnName, $key)->first();

            if ( !$find ) {
                $this->translation()->create($value);
            } else {
                $this->translation()->where(self::$langColumnName, $key)->update($value);
            }
        }

        DB::commit();
        return true;
    }


}
