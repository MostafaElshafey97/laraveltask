<?php

namespace App\Http\Controllers;
use App\Http\Requests\UpdateCustomerRequest;
use App\Http\Requests\StoreCustomerRequest;

use Illuminate\Http\Request;
use App\Models\Customer;
use App\Models\Shop;

use DB;


class CustomerController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
     {
		$customers = Customer::with('shop')->orderBy('created_at', 'DESC')->paginate(10);

      
    return view('customers.index', compact('customers'));

    // $shop = DB::table('shops')->get();
    // $customers = DB::table('customers')
    //             ->join('shops','customers.shop_id','shops.id')
    //             ->select('customers.*','shops.name')
    //             ->get();
    // return view('customers.index',compact('shop','customers'));







    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $customers = Customer::get();
        
        
		return view('customers.create', compact('customers'));
        
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreCustomerRequest $request)
    {
        try {
			$customer = Customer::create($request->all());
            //dd($customer);
			return redirect()->route('customers.index')->withSuccess($customer->first_name . ' has been created!');
		} catch (\Throwable $t) {
			 return redirect()->back()->withErrors($t->getMessage());
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
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit( Customer $customer)
    {
        $shops = Shop::get();
		return view('customers.edit', compact('customer', 'shops')); 
       }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
	public function update(UpdateCustomerRequest $request, Customer $customer)
	{
		$customer->update($request->all());
		return redirect()->route('customers.index')->withSuccess($customer->first_name . ' has been updated!');
	}

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Customer $customer)
    {
		// $customer->delete();

		// return redirect()->route('customers.index');

        $message = $customer->first_name . " successfully deleted!";
		$customer->delete();

		return redirect()->route('customers.index')->withSuccess($message);
	}    
}
