<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\View;

class BaseController extends Controller
{
    private $breadcrumbs = [];

    public function breadcrumbs($breadcrumbs){
        foreach($breadcrumbs as $name => $url){
            $breadcrumbs = ['name' => ucwords($name) , 'route' => $url];
            array_push($this->breadcrumbs,$breadcrumbs);
            View::share('breadcrumbs',$this->breadcrumbs);
        }
    }
}
