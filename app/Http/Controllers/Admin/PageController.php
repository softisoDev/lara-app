<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests\Admin\PageStoreRequest;
use App\Http\Requests\Admin\PageTranslationAddRequest;
use App\Http\Requests\Admin\PageUpdateRequest;
use App\Models\Page;
use Illuminate\Contracts\View\Factory;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\View\View;

class PageController extends MainController
{
    public $subViewFolder;

    public function boot()
    {
        $this->subViewFolder = 'pages';
    }

    /**
     * Display a listing of the resource.
     *
     * @return Factory|View
     */
    public function index()
    {
        return $this->render("{$this->viewFolder}.{$this->subViewFolder}.index", [
            'pages' => Page::query()->withoutGlobalScopes()->get()->currentLanguage(),
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Factory|View
     */
    public function create()
    {
        app()->setLocale('en');
        return $this->render("{$this->viewFolder}.{$this->subViewFolder}.create", [
            'menuType'   => Page::MENU_TYPE,
            'parentPage' => Page::parentPage(),
        ]);
    }

    public function addTranslation($id, $lang)
    {
        $page = Page::findForTranslationById($id, $lang);

        return $this->render("{$this->viewFolder}.{$this->subViewFolder}.add_translation", [
            'page'        => $page,
            'languages'   => app('languages'),
            'currentLang' => $lang,
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(PageStoreRequest $request)
    {
        $response['success'] = false;

        $parent = Page::find($request->post('parent_page'));

        if ( $request->post('parent_page', 0) == 0 ) {
            $content = array_merge($request->except(['_token', 'type', 'parent_page']), ['slug' => Str::slug($request->post('title'))]);
        } else {
            $content = array_merge($request->except(['_token', 'type', 'parent_page']), [
                'slug' => $parent->createNewSlug($request->post('title'))
            ]);
        }

        $data = [
            'type'               => $request->post('type'),
            config('app.locale') => $content,
        ];

        $save = Page::createData($data, $parent);

        if ( $save ) {
            $response['success'] = true;
        }

        return redirect()->back()->with($response);
    }


    public function updateTranslation(PageTranslationAddRequest $request, $id)
    {
        $response['success'] = false;

        $page = Page::query()->withoutGlobalScopes()->findOrFail($id);

        $parent = Page::find($page->parent_id);

        $lang = $request->post('lang');

        $data = [
            $lang => array_merge($request->except(['_token', '_method']), [
                'slug' => self::generateNewSlug($parent, $request->post('title')),
            ])
        ];

        $update = $page->updateData($data);

        if ( $update ) {
            $response['success'] = true;
        }

        return redirect()->back()->with($response);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param int $id
     * @return Factory|View
     */
    public function edit($id)
    {
        $page = Page::query()->with(['currentLanguage'])->withoutGlobalScopes()->findOrFail($id);

        return $this->render("{$this->viewFolder}.{$this->subViewFolder}.edit", [
            'menuType' => Page::MENU_TYPE,
            'page'     => $page,
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param int $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(Request $request, $id)
    {
        $page = Page::query()->withoutGlobalScopes()->findOrFail($id);

        $response['success'] = false;

        $update = $page->update($request->except(['_token', '_method']));

        if ( $update ) {
            $response['success'] = true;
        }

        return redirect()->back()->with($response);
    }

    public function order()
    {
        return $this->render("{$this->viewFolder}.{$this->subViewFolder}.order", [
            'pages' => Page::query()->withoutGlobalScopes()
                ->with(['currentLanguage', 'children'])
                ->defaultOrder()
                ->get()->currentLanguage()
                ->toTree(),
        ]);
    }

    public function setOrder(Request $request)
    {
        $response['success'] = false;

        if ( !$request->ajax() ) {
            return response()->json($response);
        }

        $data = $request->post('data');
        $save = Page::rebuildTree($data);

        if ( $save ) {
            self::regenerateSlugAfterOrder();
            $response['success'] = true;
        }

        return response()->json($response);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function destroy($id)
    {
        return response()->json([
            'success' => true,
        ]);
    }

    private function generateNewSlug($parent, $title)
    {
        if ( is_null($parent) ) {
            return Str::slug($title);
        } else {
            return $parent->createNewSlug($title);
        }
    }

    private function regenerateSlugAfterOrder()
    {
        $pages = Page::with(['translation'])
            ->withoutGlobalScopes()
            ->get();
        foreach ($pages as $page) {

            foreach ($page->translation as $item) {
                app()->setLocale($item->lang);
                $item->update([
                    'slug' => $page->generateSlug(),
                ]);
            }
        }
    }
}
