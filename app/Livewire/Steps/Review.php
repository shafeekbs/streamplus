<?php

namespace App\Livewire\Steps;

use Livewire\Component;

class Review extends Component
{

    public $formData=[];
    public $countries;

    /**
     * @return void
     * @throws \Psr\Container\ContainerExceptionInterface
     * @throws \Psr\Container\NotFoundExceptionInterface
     *
     * initialise fromData  submitted data from the session
     *
     * Needed counties array to show the country name in address section
     */
    public function mount(){

        $this->formData = session()->get('form_data');

        $this->countries = session()->get('countries');

    }

    public function editStep($step){

        $this->dispatch('goToStep',$step);
    }


    public function submit_form(){

        $this->dispatch('submitForm');
    }
    public function render()
    {
        return view('livewire.steps.review');
    }
}
