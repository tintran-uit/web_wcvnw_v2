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

class PageController extends Controller
{
    public function index()
    {
        $page = Page::findBySlug('index');

        if (!$page)
        {
            abort(404, 'Please go back to our <a href="'.url('').'">homepage</a>.');
        }

        // echo(App::getLocale());die();

        if (Session::has('locale')) {
            App::setLocale(Session::get('locale'));
        }

        $this->data['title'] = $page->title;
        $this->data['page'] = $page->withFakes();
        $this->data['menu'] = MenuItem::all();
        $this->data['cart'] = Cart::content();

        $categories = ProductCategory::where('visible', 1)->orderBy('id', 'asc')->get();
        $this->data['categories'] = $categories;
        return view('pages.index', $this->data);
    }


    public function page($slug)
    {

        $page = Page::findBySlug($slug);

        if (!$page)
        {
            abort(404, 'Please go back to our <a href="'.url('').'">homepage</a>.');
        }

        if (Session::has('locale')) {
            App::setLocale(Session::get('locale'));
        }

        $this->data['title'] = $page->title;
        $this->data['page'] = $page->withFakes();
        $this->data['menu'] = MenuItem::all();
        $this->data['cart'] = Cart::content();

        //danh sach san pham
        if ($slug == 'mua-thuc-pham-sach') {
            $this->data['isShop'] = '1';
            $categories = ProductCategory::where('visible', 1)->get();
            $this->data['categories'] = $categories;
            return view('pages.index', $this->data);
        }

        // thong tin 
        if ($page->template == 'about_us' || $page->template == 'services'){
            //thông tin
            $this->data['about_pages'] = DB::table('pages')->where('template', 'about_us')->get();
            //chăm sóc khách hàng
            $this->data['service_pages'] = DB::table('pages')->where('template', 'services')->get();
        }

        //gio hang trong
        if ($page->template == 'cart' && count($this->data['cart']) == 0) {
            return view('alert.empty_basket', $this->data);
        }
        // if ($page->template == 'payment' && count($this->data['cart']) == 0) {
        //     return view('alert.empty_basket', $this->data);
        // }

        //thanh toan
        if ($page->template == 'payment')
        {
            if (count($this->data['cart']) == 0) {
                return view('alert.empty_basket', $this->data);
            }

            $this->data['districts'] = DB::table('district')->where('city_id', 1)->get();
        }

        return view('pages.'.$page->template, $this->data);
    }

    public function getProduct($slug)
    {
        
        $product = DB::select('SELECT p.`id` "id", p.`name` "name", p.`slug` "slug", p.`image` 
            "image", p.`price` "price", p.`unit_quantity` "unit_quantity", p.`unit` "unit" FROM `products` p WHERE p.`slug` = ? ', [$slug]);

        if (!$product)
        {
            abort(404, 'Please go back to our <a href="'.url('').'">homepage</a>.');
        }

        $page = Page::findBySlug('thong-tin-chi-tiet-thuc-pham-sach');
        $this->data['title'] = $page->title;
        $this->data['page'] = $page->withFakes();
        $this->data['menu'] = MenuItem::all();
        $this->data['cart'] = Cart::content();
        $this->data['product'] = $product;

        return view('pages.product_details', $this->data);
    }

    public function getBlog($blog_id)
    {
        $page = Page::findBySlug('kinh-nghiem-mua-thuc-pham-sach');

        if (!$page)
        {
            abort(404, 'Please go back to our <a href="'.url('').'">homepage</a>.');
        }

        // echo(App::getLocale());die();

        if (Session::has('locale')) {
            App::setLocale(Session::get('locale'));
        }

        $this->data['title'] = $page->title;
        $this->data['page'] = $page->withFakes();
        $this->data['menu'] = MenuItem::all();
        $this->data['cart'] = Cart::content();

        $this->data['articles'] = DB::table('articles')->where('category_id', $blog_id)->get();
        
        return view('pages.blog', $this->data);
    }

    public function getPost($post_id)
    {
        $page = Page::findBySlug('kinh-nghiem-mua-thuc-pham-sach');

        if (!$page)
        {
            abort(404, 'Please go back to our <a href="'.url('').'">homepage</a>.');
        }

        // echo(App::getLocale());die();

        if (Session::has('locale')) {
            App::setLocale(Session::get('locale'));
        }

        $this->data['title'] = $page->title;
        $this->data['page'] = $page->withFakes();
        $this->data['menu'] = MenuItem::all();
        $this->data['cart'] = Cart::content();

         
        return view('pages.blog_post', $this->data);
    }
    

}
