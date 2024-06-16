<?php

namespace App\Http\Controllers;

use App\Models\Pesanan;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use App\Midtrans\CreateSnapTokenService;
use App\Http\Controllers\PesananController;

class PesananController extends Controller
{
    public function create()
    {
        return view('pesanan.create');
    }
    public function store(Request $request)
    {
        $pesanan = $request->all();
        $pesanan['tanggal_pesan'] = Carbon::today();
        $pesanan['tanggal_bayar'] = Carbon::today();
        $service = new CreateSnapTokenService($pesanan);
        $token = $service->getSnaptoken();
        $pesanan['token'] = $token;
        $pesanan = Pesanan::create($pesanan);
        return view('pesanan.checkout', ['pesanan' => $pesanan]);
    }
}
