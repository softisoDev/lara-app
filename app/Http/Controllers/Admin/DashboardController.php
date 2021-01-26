<?php

namespace App\Http\Controllers\Admin;

class DashboardController extends MainController
{
    public $subViewFolder;

    public function boot()
    {
        $this->subViewFolder = 'dashboard';
    }

    public function index()
    {
        return $this->render("{$this->viewFolder}.{$this->subViewFolder}.index");
    }

}
