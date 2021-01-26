<?php

namespace App\Http\Controllers\Front;


use App\Models\Page;

class PageController extends MainController
{
    public $subViewFolder;

    public function boot()
    {
        $this->subViewFolder = "pages";
    }

    public function index($slug)
    {
        return $this->render("{$this->viewFolder}.{$this->subViewFolder}.index", [
            'page' => Page::findBySlug($slug),
        ]);
    }
}
