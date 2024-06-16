<?php

namespace App\Midtrans;

use stdClass;
use App\Models\Pesanan;
use Midtrans\Notification;
use Illuminate\Support\Facades\Log;

class CallbackService extends Midtrans
{
    protected $notification;
    protected $order;
    protected $serverKey;

    public function __construct()
    {
        parent::__construct();
        $this->serverKey = env('MIDTRANS_SERVER_KEY');
        
        try {
            $this->_handleNotification();
        } catch (\Exception $e) {
            Log::error("Failed to handle notification: " . $e->getMessage());
        }
    }

    public function _isSignatureKeyVerified()
    {
        // baris ini untuk mencoba lewat RESTER
        // return true;
        // baris ini untuk mencoba lewat ngrok
        return ($this->_createLocalSignatureKey() == $this->notification->signature_key);
    }

    public function isSuccess()
    {
        $statusCode = $this->notification->status_code;
        $transactionStatus = $this->notification->transaction_status;
        $fraudStatus = !empty(trim($this->notification->fraud_status));
        
        return ($statusCode == 200 && $fraudStatus &&
            ($transactionStatus == 'capture' || $transactionStatus == 'settlement'));
    }

    public function isExpire()
    {
        return ($this->notification->transaction_status == 'expire');
    }

    public function isCancelled()
    {
        return ($this->notification->transaction_status == 'cancel');
    }

    public function getNotification()
    {
        return $this->notification;
    }

    public function getOrder()
    {
        return $this->order;
    }

    public function _createLocalSignatureKey()
    {
        $orderId = $this->order->pesanan_id;
        $statusCode = $this->notification->status_code;
        $grossAmount = $this->order->nominal;
        $serverKey = $this->serverKey;
        $input = $orderId . $statusCode . $grossAmount . '.00' . $serverKey;
        $signature = openssl_digest($input, 'sha512');
        
        return $signature;
    }

    protected function _handleNotification()
    {
        try {
            $this->notification = new Notification();
            $pesanan_id = $this->notification->order_id;
            $this->order = Pesanan::where('pesanan_id', $pesanan_id)->first();
            
            if (!$this->order) {
                throw new \Exception("Order not found for ID: $pesanan_id");
            }
        } catch (\Exception $e) {
            Log::error("Error handling notification: " . $e->getMessage());
            throw $e;
        }
    }
}
