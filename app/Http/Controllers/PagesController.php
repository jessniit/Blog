<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PagesController extends Controller
{
    public function index()
    {
        $title=" laravel blog";
        
        //return view('pages/index',compact('title'));
        return view('pages.index')->with('t',$title);
    }
    public function dummy()
    {$a="about page";
        return view('pages.about')->with('t',$a);//another methode
    }
    public function service()
    {
        //$title="service page";
        $srvc=array('tit'=>'service','services'=>['php','laravel','codeigniter']);
        return view('pages.service')->with($srvc);//another methode
    }
    
}
