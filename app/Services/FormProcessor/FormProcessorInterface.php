<?php

namespace App\Services\FormProcessor;

/**
 * Interface FormProcessorInterface
 *
 * This interface defines the contract for processing multi-step form data.
 * Any class implementing this interface must provide a method to handle the
 * processing logic, such as saving personal details, addresses, and payments.
 *
 * If needs toa dd a new logic to save data, create a new class implements this interface and update AppServiceProvider
 *
 * @package App\Services\FormProcessor
 */
interface FormProcessorInterface {

    public function process(array $formData);
}
