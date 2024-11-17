<?php

namespace App\Livewire\Steps;

use Livewire\Component;

class PersonalInfo extends Component
{
    public $name;
    public $email;
    public $phone;

    public $step_data = [];
    public $subscriptionType='free';
    public $step=1;

    protected $rules = [
        'name' => 'required|min:2',
        'email' => 'required|email|unique:members,email',
        'phone' => 'required|regex:/^([0-9\s\-\+\(\)]*)$/|min:10',
        'subscriptionType' => 'required|in:free,premium',
    ];


    /**
     * @return void
     * @throws \Psr\Container\ContainerExceptionInterface
     * @throws \Psr\Container\NotFoundExceptionInterface
     *
     *
     */
    public function mount(){

        $data = session()->get('form_data');

        $this->step_data['subscriptionType'] = $this->subscriptionType;
        $this->name =  $data["step".$this->step]['name'] ?? '';
        $this->email = $data["step".$this->step]['email'] ?? '';
        $this->phone = $data["step".$this->step]['phone'] ?? '';
        $this->subscriptionType = $data["step".$this->step]['subscriptionType'] ?? $this->subscriptionType;

        if(isset($data["step".$this->step])) {

            $this->initializeStepData($data["step".$this->step]);
        }


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

    /**
     * @return void
     *
     * Livewire lifecycle method fired on subscription dropdown change
     *
     * dispacthes event to update the toatl no.of steps based on the subscription type
     */
    public function updatedSubscriptiontype(){

        $this->dispatch('subscriptionChange',$this->subscriptionType);

    }

    /**
     * @return void
     *
     * Don't remove. Won't work updatedSubscriptionType method without this
     */
    public function handleSubscriptionChange(){

    }

    public function submitStep()
    {
        $this->validate();

        $this->dispatch('updateFormData', 1, $this->step_data, $this->rules);
    }

    public function render()
    {
        return view('livewire.steps.personal-info');
    }
}
