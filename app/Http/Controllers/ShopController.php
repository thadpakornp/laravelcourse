<?php

namespace App\Http\Controllers;

use App\Models\OrdersHeader;
use App\Models\OrdersLine;
use Illuminate\Http\Request;
use App\Models\Store;

class ShopController extends Controller
{
    public function index()
    {
        $items = Store::all();

        return view('welcome',compact('items'));
    }

    public function addcart($id)
    {
        $product = Store::find($id);
        $rowId = uniqid();

        \Cart::session(auth()->user()->id)->add(array(
            'id' => $rowId,
            'name' => $product->name,
            'price' => $product->price,
            'quantity' => 1,
            'attributes' => array(),
            'associatedModel' => $product
        ));

        return back();
    }

    public function cart()
    {
        return view('cart');
    }

    public function cartremove($rowId)
    {
        \Cart::session(auth()->user()->id)->remove($rowId);
        return back();
    }

    public function clear()
    {
        \Cart::session(auth()->user()->id)->clear();

        return back();
    }

    public function orders()
    {
        if(\Cart::session(auth()->user()->id)->isEmpty()){
            return redirect()->route('home');
        }

        $ordernumber = uniqid();
        $items = \Cart::session(auth()->user()->id)->getContent();

        $header = OrdersHeader::create([
            'user_id' => auth()->user()->id,
            'order_number' => $ordernumber
        ]);

        if($header){
            foreach($items as $item){
                OrdersLine::create([
                    'order_header' => $header->id,
                    'product_id' => $item->associatedModel->id,
                    'quantity' => $item->quantity
                ]);
            }
            $this->clear();
            return redirect()->route('home');
        }
        return back();
    }
}
