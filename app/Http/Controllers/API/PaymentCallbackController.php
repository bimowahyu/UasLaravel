<?php

namespace App\Http\Controllers\API;

use App\Models\Pesanan;
use Illuminate\Http\Request;
use App\Midtrans\CallbackService;
use App\Http\Controllers\Controller;
use App\Http\Controllers\API\PaymentCallbackController;

class PaymentCallbackController extends Controller
{
    public function receive(Request $request){
        $callback = new CallbackService;
        if ($callback->_isSignatureKeyVerified()) {
            $notification = $callback->getNotification();
            $order = $callback->getOrder();
                if ($callback->isSuccess()) {
                    Pesanan::where('pesanan_id', $order->pesanan_id)->update([
                        'status_pesanan' => 'TERBAYAR',
                    ]);
                }
                if ($callback->isExpire()) {
                    Pesanan::where('pesanan_id', $order->pesanan_id)->update([
                        'status_pesanan' => 'PEMBAYARAN_DITOLAK',
                    ]);
                }
                if ($callback->isCancelled()) {
                    Pesanan::where('pesanan_id', $order->pesanan_id)->update([
                        'status_pesanan' => 'PEMBAYARAN_DITOLAK',
                    ]);
                }
                return response()
                    ->json([
                        'success' => true,
                        'message' => 'Notification successfully processed',
                    ]);
        } else {
            return response()
                ->json([
                        'error' => true,
                        'message' => 'Signature key not verified',
                ], 403);
            }
        }
}
