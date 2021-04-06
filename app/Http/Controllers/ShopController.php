<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreShopRequest;
use App\Http\Requests\UpdateShopRequest;
use App\Models\Shop;
use DB;
use Illuminate\Http\Request;

class ShopController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $shops = Shop::paginate(10);

        return view('shops.index', compact('shops'));

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('shops.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreShopRequest $request)
    {

        $data = array();
        $data['name'] = $request->name;
        $data['email'] = $request->email;
        $data['website'] = $request->website;

        //    $shop = Shop::create($request->all());
        $image = $request->file('logo');
        if ($image) {
            $image_name = date('dmy_H_s_i');
            $ext = strtolower($image->getClientOriginalExtension());

            $image_full_name = $image_name . '.' . $ext;
            $upload_path = 'public/logo/';

            $image_url = $upload_path . $image_full_name;
            $success = $image->move($upload_path, $image_full_name);

            $data['logo'] = $image_url;

            $shop = DB::table('shops')->insert($data);

            return redirect()->route('shops.index');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Shop $shop)
    {
        return view('shops.edit', compact('shop'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateShopRequest $request, $id)
    {
        // if ($request->has('logo')) {
        //     $logo = $request->file('logo')->storeAs('public/logo', $shop->id, 'public');
        // }

        // $shop->update([
        //     'name' => $request->name,
        //     'email' => $request->email,
        //     'website' => $request->website,
        //     'logo' => $shop->id
        // ]);

        $data = array();
        $data['name'] = $request->name;
        $data['email'] = $request->email;
        $data['website'] = $request->website;

        $image = $request->file('logo');
        if ($image) {

            $image_name = date('dmy_H_s_i');
            $ext = strtolower($image->getClientOriginalExtension());
            $image_full_name = $image_name . '.' . $ext;
            $upload_path = 'public/logo/';
            $image_url = $upload_path . $image_full_name;
            $success = $image->move($upload_path, $image_full_name);

            $data['logo'] = $image_url;
            $shop = DB::table('shops')->where('id', $id)->update($data);

            return redirect()->route('shops.index');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Shop $shop)
    {
        $message = $shop->name . " successfully deleted!";
        $shop->customers->map->delete();
        $shop->delete();

        return redirect()->route('shops.index')->withSuccess($message);
    }
}
