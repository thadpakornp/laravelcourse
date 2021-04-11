<?php

namespace App\Http\Controllers;

use App\Models\Store;
use App\Models\User;
use Illuminate\Http\Request;

class HomeController extends Controller
{

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $stores = Store::with(['users'])->Get30bath()->get();

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
            'user_id' => auth()->user()->id,
            'description' => $description,
            'price' => $price,
        ]);
        if ($store) {
            if ($request->hasFile('img')) {
                $img = $request->file('img');
                $img->move(public_path(), $img->getClientOriginalName());
                Store::find($store->id)->update(['img' => $img->getClientOriginalName()]);
            }
            return redirect()->to('/admin/home');
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
        return redirect()->to('/admin/home');
    }

    public function users()
    {
        $users = User::get(['name', 'email', 'user_type']); // User::all();

        return view('users', compact('users'));
    }
}
