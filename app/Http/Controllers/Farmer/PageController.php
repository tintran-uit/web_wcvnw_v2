<?php

namespace App\Http\Controllers\Farmer;

use Illuminate\Http\Request;
use Backpack\PageManager\app\Models\Page;
use App\Models\ProductCategory;
use App\Models\MenuItem;
use App\Http\Controllers\Controller;
use Cart;
use DB;
use Session;
use App;
use Auth;

class PageController extends Controller
{

    public function page()
    {
        $this->data['title'] = 'title';
        

        return view('farmer.dashboard', $this->data);
    }

    
}
