<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Cart;

class CartProductController extends Controller
{
    public function addCart(Request $request)
    {
    	$data = $request->data;
    	// Cart::update('1', $data['qty']);
    	return Cart::content();
    }
}
