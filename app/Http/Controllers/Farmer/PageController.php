<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Backpack\PageManager\app\Models\Page;
use App\Models\ProductCategory;
use App\Models\MenuItem;
use Cart;
use DB;
use Session;
use App;
use Auth;

class PageController extends Controller
{

    public function page($slug)
    {

        

        $this->data['title'] = 'title';
        

        return view('pages.'.$page->template, $this->data);
    }

    
}
