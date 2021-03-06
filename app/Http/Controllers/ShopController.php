<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;

class ShopController extends Controller
{
    /**
     *  Показывает магазин с отображением
     *  тех продкутов, которые уже есть у пользоватля
     *
     * @return \Illuminate\View\View
     */
    public function show(): \Illuminate\View\View
    {
        if (\request()->user() != null) {
            $products_in_user = array();
            foreach (\request()->user()->usersProducts as $userProduct){
                array_push($products_in_user, [$userProduct->product, $userProduct->count]);
            }
            return view('shop', ['in_user_list' => $products_in_user, 'products'=>Product::all()]);
        }
        return view('shop', ['products'=>Product::all()]);
    }

    /**
     *  Показывает магазин с отображением продуктов по названию
     *  тех продкутов, которые уже есть у пользоватля
     *
     * @return \Illuminate\View\View
     */
    public function seek(Request $request): \Illuminate\View\View
    {
        $query_str =  '%'.$request->title.'%';
        $found = Product::where('title', 'like', $query_str)->get();
        if (\request()->user() != null) {
            $products_in_user = array();
            foreach (\request()->user()->usersProducts as $userProduct){
                array_push($products_in_user, [$userProduct->product, $userProduct->count]);
            }
            return view('shop', ['in_user_list' => $products_in_user, 'products'=>$found]);
        }
        return view('shop', ['products'=>$found]);
    }
}
