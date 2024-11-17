<?php

namespace App\Services\FormProcessor;

use App\Models\Address;
use App\Models\Member;
use Illuminate\Support\Facades\DB;
use App\Services\Payment\PaymentProcessorInterface;


/**
 * Class FormProcessor
 *
 * This service handles the onbopardng multi-step form processing.
 * It validates and processes personal details, address details, and payment information
 * (if applicable) while ensuring data integrity using transactions.
 *
 * The service uses a payment processor to handle payments for premium subscriptions.
 *
 *
 * @package App\Services\FormProcessor
 */

class FormProcessor implements FormProcessorInterface {

    /**
     * @var PaymentProcessorInterface
     *     The payment processor instance used for handling payments.
     */
    protected $paymentProcessor;

    /**
     * FormProcessor constructor.
     *
     * @param PaymentProcessorInterface $paymentProcessor
     *     Injected payment processor implementation for handling premium subscription payments.
     *     Currently just saving data
     */
    function __construct(PaymentProcessorInterface $paymentProcessor) {

        $this->paymentProcessor = $paymentProcessor;
    }

    /**
     * Process the multi-step onbaording form data.
     *
     * This method performs the following actions:
     * 1. Creates a `Member` record with personal details from step 1.
     * 2. Creates an `Address` record and associates it with the member from step 2.
     * 3. Processes payment details for premium subscriptions (step 3).
     *
     * @param array $form_data
     *     The complete form data organized by steps (e.g., `step1`, `step2`, `step3`).
     *
     * @return int
     *     The ID of the created `Member` record.
     *
     * @throws \Exception
     *     If any error occurs during the transaction, or if required payment details are missing.
     */
    public function process(array $form_data){

        try {

            DB::beginTransaction();

            $personal_details = $form_data['step1'];
            $member = Member::create([
                'name' => $personal_details['name'],
                'email' => $personal_details['email'],
                'phone' => $personal_details['phone'],
                'subscription_type' => $personal_details['subscriptionType']
            ]);

            $member_id = $member->id;

            $address_details = $form_data['step2'];
            $address = new Address([
                'address_line_1' => $address_details['address_line_1'],
                'address_line_2' => $address_details['address_line_2'],
                'postal_code' => $address_details['postal_code'],
                'city' => $address_details['city'],
                'country_id' => $address_details['country_id'],
                'state' => $address_details['state']

            ]);

            $member->address()->save($address);



            if($personal_details['subscriptionType'] == Member::$subscription_types['premium']) {
                if(!isset($form_data['step3'])) {
                    session()->flash('error', 'Payment details not captured.Please try again');
                    throw new \Exception('Error Occured');
                }
                $payment_details = $form_data['step3'];
                $payment_details['member_id'] = $member_id;
                $this->paymentProcessor->processPayment($payment_details);
            }

            DB::commit();

            session()->flash('success', 'Registration completed successfully!');
            return $member_id;

        } catch (\Exception $e){

            DB::rollBack();
            session()->flash('error', 'An error occured. Please try again');
            dd($e->getMessage());

        }

    }
}
