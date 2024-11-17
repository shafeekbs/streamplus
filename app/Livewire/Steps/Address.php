<?php

namespace App\Livewire\Steps;

use App\Models\Country;
use App\Providers\CountryConfigProvider;
use App\Services\CountryConfig\CountryConfigInterface;


use Livewire\Component;


class Address extends Component
{
    public $address_line_1;
    public $address_line_2;
    public $city;
    public $state;
    public $country;
    public $postal_code;

    public $step_data = [];


    public $rules = ['country' => 'required'];

    protected $this_step=2;

    public $countries = [];

    protected $selected_country = [];

    protected $countryConfig;

    public $address_fields = [];

    /**
     * @return void
     * @throws \Psr\Container\ContainerExceptionInterface
     * @throws \Psr\Container\NotFoundExceptionInterface
     *
     * Mount submitted value rfom session to persist data if coming back from another step
     * Fetches country list from tables.
     *
     */
    public function mount(){

        $data = session()->get('form_data');

        $data = $data["step".$this->this_step] ?? array();

        $this->address_line_1 = $data['address_line_1'] ?? '';
        $this->address_line_2 = $data['address_line_2'] ?? '';
        $this->city = $data['city'] ?? '';
        $this->postal_code = $data['postal_code'] ?? '';
        $this->state = $data['state'] ?? '';
        $this->country = $data['country'] ?? '';

        if($this->country != "") {
            $this->address_fields = session()->has('country_config') ? session()->get('country_config')['fields'] : [];
        }



        $this->countries = Country::select('id','code','name')
           // ->where('status',1)
            ->get()
            ->keyBy('id');

        session()->put('countries', $this->countries);

        $this->initializeStepData($data);

    }

    /**
     * @param $data
     * @return void
     *
     * Initializes step_data property with existing value, as we are building step_data on update of fields.
     *
     *
     */
    private function initializeStepData($data){

        foreach($data as $property => $value) {

            $this->step_data[$property] = $value;
        }
    }

    /**
     * @return void
     *
     * LiveWire lifecyscle method fired when country dropdoewn changes
     *  Handles the upadtion of address fields based on the country selected.
     *
     */
    public function updatedCountry(){

        [$country_id, $country_code, $country_name] = explode('-',$this->country);
        $country_data['code'] = $country_code;
        $country_data['id'] = $country_id;
        $country_data['name'] = $country_name;
        $this->selected_country = ['code' => $country_data['code'], 'id' => $country_data['id'],'name' => $country_data['name']];

        $countryConfig = app(CountryConfigInterface::class);
        $country_config_details = $countryConfig->getConfig($country_data);
        unset($country_config_details['rules']['country']);
        $this->rules = array_merge($this->rules,$country_config_details['rules']);

        unset($country_config_details['fields']['country']);
        $this->address_fields = $country_config_details['fields'];
        $this->step_data['country_id'] = $country_id;
        session()->put('country_config', $country_config_details);
       // dd($this->rules);
    }

    /**
     * @param $id
     * @param $code
     * @return void
     *
     * Don't remove, dropdown change is not firing until wire:change is associated with dropdown.
     */
    public function handleCountryChange($id,$code){
       //dd($id.'-'.$code);
    }


    /**
     * @param $propertyName
     * @return void
     * @throws \Illuminate\Validation\ValidationException
     *
     * Livewire lifecycle method fired on every field update
     *
     */
    public function updated($propertyName){


        $this->validateOnly($propertyName);

        $this->step_data[$propertyName] = $this->{$propertyName};

    }

    /**
     * @return void
     *
     * Handles step submission
     * Fired when click on the next step / continue button from steps
     *
     * Validate the step data and dispatches updateFormData to sync data.
     *
     */
    public function submitStep()
    {

        $this->validate($this->rules);

        $this->dispatch('updateFormData', 2, $this->step_data, $this->rules);
    }

    public function render()
    {
        return view('livewire.steps.address');
    }
}
