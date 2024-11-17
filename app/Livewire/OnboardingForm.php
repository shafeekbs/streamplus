<?php

namespace App\Livewire;


use App\Providers\AppServiceProvider;
use App\Services\FormProcessor\FormProcessorInterface;

use Livewire\Component;

/**
 * Livewire parent component for onboarding multi step from
 */
class OnboardingForm extends Component
{
    public $formData = [];

    public $rules = [];

    /**
     * @var string[]
     * methods expected to be dispatched from child components (form steps)
     */
    protected $listeners = [
        'nextStep',
        'previousStep',
        'updateFormData',
        'subscriptionChange',
        'submitForm',
        'goToStep'

    ];

    protected $layout = 'layouts.app';

    public $current_step = 1;
    public $totalSteps = 3;
    public function mount() {

        $this->formData = session()->get('form_data') ?? [];
        if(isset($this->formData['step1']['subscriptionType']) && $this->formData['step1']['subscriptionType'] == 'premium') {

            $this->totalSteps=4;
        }

    }

    /**
     * @param $step
     * @param $data
     * @param $step_rules
     * @return void
     *
     * Dispatched from child component, once the step is submitted after validation.
     * Get data submitted in the corresponding step and rules for the step. Update the global $formData and rules, so that we can validate the data again before final submission.
     *
     */
    public function updateFormData($step, $data, $step_rules) {

        foreach ($step_rules as $field=>$rule) {

            $this->rules["formData.step{$step}.{$field}"] = $rule;
        }
        $this->formData["step{$step}"] = $data;
        session()->put('form_data', $this->formData);

        $this->nextStep();
    }

    /**
     * @return void
     *
     * Called by updateFormData function.
     * Updates $current_step property so that the component will re render and show the corresponding child component,
     * as the condition is in onboarding.blade.php which is the view of parent component
     *
     */
    private function nextStep(){


        if($this->current_step == 2 && $this->formData['step1']['subscriptionType'] == 'free') {

            $this->current_step = $this->totalSteps;

        } else {

            $this->current_step++;

        }

    }

    /**
     * @param $step
     * @return void
     *
     * Dispatched from Review component to go to specific step to edit anything.
     */
    public function goToStep($step) {
        if($step >= 1 && $step <= 4) {

            $this->current_step = $step;
        }
    }

    /**
     * @return void
     *
     * Logic is same as nextStep, but here it's decrementing the $current_step property to go to previous variable
     */
    public function previousStep(){


        if($this->current_step == 4 && $this->formData['step1']['subscriptionType'] == 'free') {

            $this->current_step = 2;

        } else {

            $this->current_step--;

        }



    }

    /**
     *
     * Handles form submission. Dispatched from Review component for final data submission
     *  Validates the data again with rules updated from stepSubmission
     *
     * @param FormProcessorInterface $formProcessor
     *  formprocessor implelmentaion, injected via dependency injection responsible for processsing the form data, service binded in AppServiceProvider
     *  If need to change the implenetation to a new system or DB, crate a new service under Services/FormProcessor imlementing the interface and update Service provider
     *
     * @return \Illuminate\Http\RedirectResponse|void
     *  Redirect to success page after succesful data saving to db or flashes erro on failure
     *
     *
     *
     */
    public function submitForm(FormProcessorInterface $formProcessor){

        $this->validate();

        try{

            $r = $formProcessor->process($this->formData);

            session()->forget('form_data');
            session()->flash('success', 'Registration completed successfully!');

            return redirect()->route('onboarding.success');

        } catch(\Exception $e) {

            session()->flash('error', 'Error in onboarding. Please try again later!');
        }


    }

    /**
     * @param $subscription
     * @return void
     *
     * Dispatched from PersonalInfo component whrn the subscription dropdown changes.
     *
     * updates total no of steps based on the subscription type, so that it will update the progress bar
     */
    public function subscriptionChange($subscription) {
        if($subscription == 'premium') {

            $this->totalSteps = 4;

        } else {

            $this->totalSteps=3;

        }
    }

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Foundation\Application
     *
     */
    public function render()
    {
        return view('livewire.onboarding-form');
    }
}
