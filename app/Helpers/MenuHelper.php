<?php

use Illuminate\Support\Facades\Request;

if (!function_exists('isActiveMenu')) {
    function isActiveMenu($url)
    {
        return Request::is(trim($url, '/')) ? 'active' : '';
    }
}

if (!function_exists('isActiveParent')) {
    function isActiveParent($submenu)
    {
        foreach ($submenu as $child) {
            if (isset($child['url']) && Request::is(trim($child['url'], '/'))) {
                return 'open active'; // class to highlight parent menu
            }
        }
        return '';
    }
}
