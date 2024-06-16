<?php
namespace App\Midtrans;

use Midtrans\Snap;
use App\Midtrans\Midtrans;
use App\Midtrans\CreateSnapTokenService;

class CreateSnapTokenService extends Midtrans{
    protected $pesanan;
    public function __construct($pesanan){
        parent::__construct();
        $this->pesanan = $pesanan;
    }
    public function getSnapToken(){
        $params = [
            'transaction_details' => [
            'order_id' => $this->pesanan['pesanan_id'],
            'gross_amount' => $this->pesanan['nominal'],
            ],
        ];
        $snapToken = Snap::getSnapToken($params);
        return $snapToken;
    }
}