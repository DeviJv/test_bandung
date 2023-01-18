<?php

namespace App\Http\Controllers;

use App\Models\Tiket;
use Illuminate\Http\Request;

class TiketController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $tiket = Tiket::orderBy('created_at', 'desc')->paginate(15);
        return view('tiket.list', ['tikets' => $tiket]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('tiket.form');
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
            'jenis' => 'required',
            'sheet' => 'required',
            'harga' => 'required',
        ]);

        Tiket::create($request->post());
        return redirect()->route('tikets.index')->with('success', 'Berhasil Menambah Tiket.');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\tiket  $tiket
     * @return \Illuminate\Http\Response
     */
    public function show(Tiket $tiket)
    {
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\tiket  $tiket
     * @return \Illuminate\Http\Response
     */
    public function edit(Tiket $tiket)
    {
        return view('tiket.form', ['tiket' => $tiket]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\tiket  $tiket
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Tiket $tiket)
    {
        $request->validate([
            'jenis' => 'required',
            'sheet' => 'required',
            'harga' => 'required',
        ]);

        $tiket->fill($request->post())->save();
        return redirect()->route('tikets.index')->with('success', 'tiket Has Been updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\tiket  $tiket
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, Tiket $tiket)
    {

        $tiket->delete();
        $request->session()->flash('id', $tiket->id);
        return redirect()->route('tikets.index')->with('success', 'tiket Berhasil Di Hapus');
    }

    public function restore($id)
    {
        $tiket = Tiket::where('id', $id)->withTrashed()->restore();
        $tiket = Tiket::find($id)->first();

        return redirect()->route('tikets.index')->with('success', 'tiket ' . $tiket->name . ' Berhasil Di Restore');
    }
}