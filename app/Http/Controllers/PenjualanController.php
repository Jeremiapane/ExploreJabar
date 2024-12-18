<?php

namespace App\Http\Controllers;

use App\Models\Booking;
use App\Models\Kendaraan;
use App\Models\Paket;
use App\Models\PemanduWisata;
use Illuminate\Http\Request;
use RealRashid\SweetAlert\Facades\Alert;

class PenjualanController extends Controller
{
    public function index()
    {
        $list_booking = Booking::whereHas('paket', function ($query) {
            $query->where('created_by', session('id_operasional'));
        })->with('paket', 'wisatawan')->get();
        return view('travel.penjualan.dashboard', compact('list_booking'));
    }

    public function detailBooking($id)
    {
        $detail = Booking::whereHas('paket', function ($query) {
            $query->where('created_by', session('id_operasional'));
        })->with('paket.kendaraan', 'paket.pemanduWisata.user', 'wisatawan')->find($id);
        return view('travel.penjualan.detail-booking', compact('detail'));
    }

    public function updateBooking(Request $request)
    {
        $booking = Booking::with('paket.pemanduWisata', 'paket.kendaraan')->findOrFail($request->id);
        $booking->update([
            'status' => $request->status,
            'catatan_agen' => $request->catatan_agen,
        ]);
        if ($booking->status != 'ditolak') {
            $paket = Paket::findOrFail($booking->paket->id);
            $paket->update([
                'status_paket' => 'tersedia',
            ]);
        }
        Alert::success('Success', 'Status Booking Wisatawan Diperbaharui');
        return redirect()->back()->with('success', 'Status Booking Wisatawan Diperbaharui');
    }

}
