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

        $categories = ProductCategory::orderBy('id', 'asc')->get();
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

        if(Auth::check()){
                $this->data['auth'] = true;
        }else{
            $this->data['auth'] = false;
        }

        if (Session::has('locale')) {
            App::setLocale(Session::get('locale'));
        }

        $this->data['title'] = $page->title;
        $this->data['page'] = $page->withFakes();
        $this->data['menu'] = MenuItem::all();
        $this->data['cart'] = Cart::content();

        // foreach ($this->data['cart'] as $item) {
        //     if($item->rowId == '82912d227e2689bd28dfe27b449abc2a')
        //     {
        //         $item->options["error"] = 1;
        //         Cart::update($item->rowId, $item->options["error"]);
        //     }
            
        // }


        //danh sach san pham
        if ($slug == 'mua-thuc-pham-sach') {
            $this->data['isShop'] = '1';
            $categories = ProductCategory::get();
            $this->data['categories'] = $categories;
            return view('pages.index', $this->data);
        }

        // thong tin 
        if ($page->template == 'about_us' || $page->template == 'services' || $page->template == 'index_info'){
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
            if($this->data['auth']){
                $this->data['customer'] = DB::table('customers')->where('id', Auth::user()->connected_id)->first();
                if(Auth::user()->connected_id == null){
                    $this->data['auth'] = false;
                }
            }

            

            $this->data['districts'] = DB::table('district')->where('city_id', 1)->get();
        }

        //he thong nong trai
        if ($page->template == 'farm_information') {
            $this->data['farmers'] = DB::select('SELECT f.`id` "id", f.`name` "name", f.`photo` "photo", f.`short_address` "short_address", f.`rating` "rating", f.`rating_count` "rating_count", f.`quality` "quality", f.`product_list` "product_list" FROM `farmers` f WHERE 1');
        }

        return view('pages.'.$page->template, $this->data);
    }

    public function getProduct($slug)
    {
        
        $product = DB::select('SELECT p.`id` "id", p.`name` "name", p.`slug` "slug", p.`image` 
            "image", p.`price` "price", p.`price_old` "price_old", p.`category` "category", p.`unit_quantity` "unit_quantity", p.`unit` "unit", p.`short_description` "short_description", p.`description` "description" FROM `products` p WHERE p.`slug` = ? ', [$slug]);

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

    public function showBlog($blog_id)
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
        $this->data['blog_id'] = $blog_id;

        // return $this->data['articles'] = DB::select('SELECT a.`title` "title", a.`slug` "slug", a.`content` "content", a.`image` "image", a.`status` "status", a.`date` "date", t.`name` "tag_name", t.`slug` "tag_slug" FROM `articles` a, `article_tag` at, `tags` t WHERE at.`article_id` = a.`id` AND t.`id` = at.`tag_id` AND a.`category_id` = ? ', [$blog_id]);
        
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
        $this->data['article'] = DB::table('articles')->where('id', $post_id)->first();
        $this->data['blog_id'] = $this->data['article']->category_id;

        return view('pages.blog_post', $this->data);
    }
    
    public function showFarmer($farmer_id)
    {
        $page = Page::findBySlug('thong-tin-trang-trai-an-toan');

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

        $this->data['farmer'] = DB::select('SELECT f.`id` "id", f.`name` "name", f.`photo` "photo", f.`short_address` "short_address", f.`rating` "rating", f.`rating_count` "rating_count", f.`profile` "profile" FROM `farmers` f WHERE f.`id` = ? ', [$farmer_id]);

        return view('pages.farm_information_show', $this->data);
    }
}
