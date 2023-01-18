<?php

namespace App\Http\Controllers;

use App\Models\Customer;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class CustomerController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $customer = Customer::orderBy('created_at', 'desc')->paginate(15);
        return view('customers.list', ['customers' => $customer]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('customers.form');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'email' => 'required',
            'alamat' => 'required',
            'gender' => 'required',
        ]);

        Customer::create($request->post());
        return redirect()->route('customers.index')->with('success', 'Berhasil Menambah Customer.');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Customer  $customer
     * @return \Illuminate\Http\Response
     */
    public function show(Customer $customer)
    {
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Customer  $customer
     * @return \Illuminate\Http\Response
     */
    public function edit(Customer $customer)
    {
        return view('customers.form', ['customer' => $customer]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Customer  $customer
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Customer $customer)
    {
        $request->validate([
            'name' => 'required',
            'email' => 'required',
            'alamat' => 'required',
        ]);

        $customer->fill($request->post())->save();
        return redirect()->route('customers.index')->with('success', 'Customers Has Been updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Customer  $customer
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, Customer $customer)
    {

        $customer->delete();
        $request->session()->flash('id', $customer->id);
        return redirect()->route('customers.index')->with('success', 'Customers Berhasil Di Hapus');
    }

    public function restore($id)
    {
        $customer = Customer::where('id', $id)->withTrashed()->restore();
        $customer = Customer::find($id)->first();

        return redirect()->route('customers.index')->with('success', 'Customers ' . $customer->name . ' Berhasil Di Restore');
    }
}