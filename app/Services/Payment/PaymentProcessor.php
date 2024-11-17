<?php

namespace App\Services\Payment;

use App\Models\PaymentInfo;
use App\Services\Payment\PaymentProcessorInterface;
use Illuminate\Support\Facades\Crypt;


/**
 * Default payment Processor class
 *
 * If a new payment gateway is introduced, define a new class that implements PaymentProcessorInterface
 * and define processpayment method. Also update the PaymentProcessorProvider to register the active payment method class
 *
 *
 */
class PaymentProcessor implements PaymentProcessorInterface{

    public function processPayment(array $info)
    {
       $payment_info = PaymentInfo::create([
           'member_id' => $info['member_id'],
           'card_number' => Crypt::encrypt($info['card_number']),
           'expiry' => $info['expiry'],
           'cvv' => Crypt::encrypt($info['cvv'])
       ]);

       return $payment_info;
    }
}
