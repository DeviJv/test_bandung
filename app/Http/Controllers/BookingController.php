<?php

namespace App\Http\Controllers;

use App\Models\Booking;
use App\Models\CheckIn;
use App\Models\Customer;
use App\Models\Tiket;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Redirect, Response;

class BookingController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $booking = Booking::with('customers', 'tikets', 'checkins')->get();

        return view('booking.list', ['booking' => $booking]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $tikets = Tiket::All();
        return view('form_booking', ['tikets' => $tikets]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        DB::beginTransaction();
        try {
            $customers = new Customer;
            $customers->name = $request->name;
            $customers->email = $request->email;
            $customers->alamat = $request->name;
            $customers->save();
            $booking = new Booking;
            $unique_no = Booking::orderBy('id', 'DESC')->pluck('id')->first();
            if ($unique_no == null or $unique_no == "") {
                $unique_no = 1;
            } else {
                $unique_no = $unique_no + 1;
            }
            $booking->inv = 'INV' . $unique_no . now();
            $booking->tikets_id = $request->tikets_id;
            $booking->customers_id = $customers->id;
            $booking->sub_total = $request->sub_total;
            $booking->save();
            $checkin = new CheckIn;
            $checkin->bookings_id = $booking->id;
            $checkin->save();
            DB::commit();
            $request->session()->flash('inv', $booking->inv);
            return redirect()->route('bookings.create')->with('success', 'Berhasil Membooking.');
        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->route('bookings.create')->with('error', 'Input Tidak Valid.');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Booking  $booking
     * @return \Illuminate\Http\Response
     */
    public function show(Booking $booking)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Booking  $booking
     * @return \Illuminate\Http\Response
     */
    public function edit(Booking $booking)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Booking  $booking
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Booking $booking)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Booking  $booking
     * @return \Illuminate\Http\Response
     */
    public function destroy(Booking $booking)
    {
        //
    }
}