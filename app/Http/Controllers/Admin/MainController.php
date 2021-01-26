<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;

class MainController extends Controller
{
    public $viewFolder;

    public $pageTitle;

    public function __construct()
    {
        $this->viewFolder = 'admin';
        $this->pageTitle = 'chameleon.com';

        if (method_exists($this, 'boot')) {
            $this->boot();
        }
    }

    public function render($view, $data = array())
    {
        return view($view)->with($data);
    }
}
