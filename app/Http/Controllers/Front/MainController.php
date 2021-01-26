<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use App\Models\Page;

class MainController extends Controller
{
    public $viewFolder;

    public $pageTitle;

    public function __construct()
    {
        $this->viewFolder = 'front';
        $this->pageTitle = 'chameleon.com';

        if ( method_exists($this, 'boot') ) {
            $this->boot();
        }
    }

    public function render($view, $data = array())
    {
        $viewData = [
            'headerNavbar' => Page::navbar('header'),
            'footerNavbar' => Page::navbar('footer'),
            'pageTitle'    => $data['page']->title ?? $this->pageTitle,
        ];

        return view($view)->with(array_merge($viewData, $data));
    }
}
