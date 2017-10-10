<?php

namespace Backpack\Base\app\Http\Controllers\Auth;

use Backpack\Base\app\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use Auth;
use Session;

class LoginController extends Controller
{
    protected $data = []; // the information we send to the view

    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */
    use AuthenticatesUsers {
        logout as defaultLogout;
        login as defaultLogin;
    }

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        // var_dump($this); die();
        $this->middleware('guest', ['except' => 'logout']);

        // ----------------------------------
        // Use the admin prefix in all routes

        // If not logged in redirect here.
        $this->loginPath = property_exists($this, 'loginPath') ? $this->loginPath
            : config('backpack.base.route_prefix', 'admin').'/login';

        // Redirect here after successful login.
        $this->redirectTo = property_exists($this, 'redirectTo') ? $this->redirectTo 
             : config('backpack.base.route_prefix', 'admin').'/dashboard';

        // Redirect here after logout.
        $this->redirectAfterLogout = property_exists($this, 'redirectAfterLogout') ? $this->redirectAfterLogout
            : '';
        // ----------------------------------
    }

    // -------------------------------------------------------
    // Laravel overwrites for loading backpack views
    // -------------------------------------------------------

    /**
     * Show the application login form.
     *
     * @return \Illuminate\Http\Response
     */
    public function showLoginForm()
    {
        $this->data['title'] = trans('backpack::base.login'); // set the page title

        return view('backpack::auth.login', $this->data);
    }

    /**
     * Log the user out and redirect him to specific location.
     *
     * @param \Illuminate\Http\Request $request
     *
     * @return \Illuminate\Http\Response
     */
    public function logout(Request $request)
    {
        // Do the default logout procedure
        $this->defaultLogout($request);

        // And redirect to custom location
        return redirect($this->redirectAfterLogout);
    }

    public function login(Request $request)
    {
        Session::set('modal', 'login');
        // echo "string"; die();
        // Do the default logout procedure
        // $this->defaultLogout($request);
        $this->defaultLogin($request);

        $user = Auth::user();
        if ($user['account_type'] == 'Admin') {
            return redirect($this->redirectTo);
        }elseif ($user['account_type'] == 'Farmer') {
            return redirect('farmer/farmer-acc-item');
        }
        // return $user;
        // And redirect to custom location
        return redirect('/');
    }
}
