<?php

namespace App\Livewire\Steps;

use Illuminate\Support\Facades\Crypt;
use Livewire\Component;

class Payment extends Component
{


    public $card_number;
    public $expiry;
    public $cvv;


    public $step_data = [];


    public $rules =[ 'card_number' => 'required|digits:16',
        'expiry' => 'required|max:5',
        'cvv' => 'required|digits:3'];

    protected $this_step=3;


    /**
     * @return void
     * @throws \Psr\Container\ContainerExceptionInterface
     * @throws \Psr\Container\NotFoundExceptionInterface
     *
     * Mount submitted value from session to persist data if coming back from another step
     *
     */
    public function mount(){

        $data = session()->get('form_data');

        $data = $data["step".$this->this_step] ?? array();

        $this->card_number = $data['card_number'] ?? '';
        $this->expiry = $data['expiry'] ?? '';
        $this->cvv = '';


        $this->initializeStepData($data);

    }

    private function initializeStepData($data){

        foreach($data as $property => $value) {

            $this->step_data[$property] = $value;
        }
    }

    public function updated($propertyName){


        $this->validateOnly($propertyName);

        $this->step_data[$propertyName] = $this->{$propertyName};

    }
    public function submitStep()
    {

        $this->validate($this->rules);
        $this->dispatch('updateFormData', $this->this_step, $this->step_data, $this->rules);
    }
    public function render()
    {
        return view('livewire.steps.payment');
    }
}
