<?php

namespace App\Http\Controllers\Front;

use App\Models\Page;

class HomeController extends MainController
{
    public $subViewFolder;

    public function boot()
    {
        $this->subViewFolder = 'home';
    }

    public function index()
    {
        return $this->render("{$this->viewFolder}.{$this->subViewFolder}.index", ['home' => Page::homePage()]);
    }
}
