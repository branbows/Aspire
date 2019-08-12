<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use \App;
use App\Http\Requests;
use App\FaqCategory;
use App\Faq;
use Yajra\Datatables\Datatables;
use DB;
use Auth;

class FaqsController extends Controller
{
    public function __construct()
    {
        $this->middleware('guest');		
    }


    public function index()
    {
    	$data['active_class']       = 'faqs';
        $data['title']              = getPhrase('faqs');
        
        $categories = FaqCategory::where('status',1)->get();
        $data['categories'] = $categories;
        
        // return view('site.faqs',$data);
        $view_name = getTheme().'::site.faqs';
        return view($view_name, $data);
    }
}
