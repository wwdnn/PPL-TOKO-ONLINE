<?php

namespace App\Controllers;
// use App\Models\DashboardModel as DashboardModel;

class CartController extends BaseController
{
    public function index()
    {
        $cart = \Config\Services::cart();
        $data = [
            'carts' => $cart->contents()
        ];
        return view('CartView', $data);
    }
}
