<?php

namespace App\Http\Controllers;

use App\Models\Store;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $stores = Store::get();

        return view('home', compact('stores'));
    }

    public function formsave()
    {
        return view('formsave');
    }

    public function formsavestore(Request $request)
    {
        $name = $request->input('storename');
        $description = $request->input('description');
        $price = $request->input('price');

        // $store = Store::create($request->all());
        $store = Store::create([
            'name' => $name,
            'description' => $description,
            'price' => $price,
        ]);
        if ($store) {
            if ($request->hasFile('img')) {
                $img = $request->file('img');
                $img->move(public_path(), $img->getClientOriginalName());
                Store::find($store->id)->update(['img' => $img]);
            }
            return redirect()->to('/home');
        }
    }

    public function formdelete($id)
    {
        Store::destroy($id);
        return back();
    }

    public function formedit($id)
    {
        $store = Store::find($id);

        return view('formedit', compact('store'));
    }

    public function formsaveedit(Request $request)
    {
        $data = [
            'name' => $request->input('storename'),
            'description' => $request->input('description'),
            'price' => $request->input('price'),
        ];
        Store::find($request->input('id'))->update($data);

        // Store::find($request->input('id'))->update([
        //     'name' => $request->input('name'),
        //     'description' => $request->input('description'),
        //     'price' => $request->input('price'),
        // ]);

        // Store::find($request->input('id'))->update($request->all());
        return redirect()->to('/home');
    }
}
