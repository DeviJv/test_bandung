<?php

namespace App\Http\Controllers;

use App\Models\CheckIn;
use App\Models\Tiket;
use Illuminate\Http\Request;
use Redirect, Response;

class CheckInController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\CheckIn  $checkIn
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {

        $check = CheckIn::where('bookings_id', $id)->first();
        if ($check->status == "Y") {
            return redirect()->route('bookings.index')->with('error', 'Maaf Anda Sudah CheckIn');
        }
        $check->status = "Y";
        $check->save();
        return redirect()->route('bookings.index')->with('success', 'Berhasil Checkin');
    }
    public function get_harga($id)
    {
        $tiket = Tiket::where('id', $id)->get();
        return Response::json($tiket);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\CheckIn  $checkIn
     * @return \Illuminate\Http\Response
     */
    public function edit(CheckIn $checkIn)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\CheckIn  $checkIn
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, CheckIn $checkIn)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\CheckIn  $checkIn
     * @return \Illuminate\Http\Response
     */
    public function destroy(CheckIn $checkIn)
    {
        //
    }
    public function booking_form()
    {
        $tikets = Tiket::All();
        return view('form_booking', ['tikets' => $tikets]);
    }
}