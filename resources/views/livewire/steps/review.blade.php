<div>
    <h3 class="mb-4">Review Your Information</h3>

    <!-- Personal Information Section -->
    <div class="card mb-4">
        <div class="card-header d-flex justify-content-between align-items-center">
            <h5 class="mb-0">Personal Information</h5>
            <button type="button"
                    class="btn btn-sm btn-outline-primary"
                    wire:click="editStep(1)">
                Edit
            </button>
        </div>
        <div class="card-body">
            <div class="row">
                <div class="col-md-6">
                    <p class="mb-1"><strong>Name:</strong></p>
                    <p class="text-muted">{{ $formData['step1']['name'] }}</p>
                </div>
                <div class="col-md-6">
                    <p class="mb-1"><strong>Email:</strong></p>
                    <p class="text-muted">{{ $formData['step1']['email'] }}</p>
                </div>
                <div class="col-md-6">
                    <p class="mb-1"><strong>Phone:</strong></p>
                    <p class="text-muted">{{ $formData['step1']['phone'] }}</p>
                </div>
                <div class="col-md-6">
                    <p class="mb-1"><strong>Subscription Type:</strong></p>
                    <p class="text-muted text-capitalize">{{ $formData['step1']['subscriptionType'] }}</p>
                </div>
            </div>
        </div>
    </div>

    <!-- Address Information Section -->
    <div class="card mb-4">
        <div class="card-header d-flex justify-content-between align-items-center">
            <h5 class="mb-0">Address Information</h5>
            <button type="button"
                    class="btn btn-sm btn-outline-primary"
                    wire:click="editStep(2)">
                Edit
            </button>
        </div>
        <div class="card-body">
            <div class="row">
                <div class="col-md-12">
                    <p class="mb-1"><strong>Address:</strong></p>
                    <p class="text-muted">
                        {{ $formData['step2']['address_line_1'] }}<br>
                        @if($formData['step2']['address_line_2'])
                            {{ $formData['step2']['address_line_2'] }}<br>
                        @endif
                        {{ $formData['step2']['city'] }}, {{ $formData['step2']['state'] }}<br>
                        {{ $formData['step2']['postal_code'] }}<br>
                        {{ $countries[$formData['step2']['country_id']]['name'] ?? $formData['step2']['country'] }}
                    </p>
                </div>
            </div>
        </div>
    </div>

    <!-- Payment Information Section (Only for Premium) -->
    @if($formData['step1']['subscriptionType'] === 'premium')
        <div class="card mb-4">
            <div class="card-header d-flex justify-content-between align-items-center">
                <h5 class="mb-0">Payment Information</h5>
                <button type="button"
                        class="btn btn-sm btn-outline-primary"
                        wire:click="editStep(3)">
                    Edit
                </button>
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-md-6">
                        <p class="mb-1"><strong>Card Number:</strong></p>
                        <p class="text-muted">
                            **** **** **** {{ substr($formData['step3']['card_number'], -4) }}
                        </p>
                    </div>
                    <div class="col-md-6">
                        <p class="mb-1"><strong>Expiration Date:</strong></p>
                        <p class="text-muted">{{ $formData['step3']['expiry'] }}</p>
                    </div>
                </div>
            </div>
        </div>
    @endif


    <!-- Action Buttons -->
    <div class="d-flex justify-content-between align-items-center">
        <button type="button"
                class="btn btn-secondary"
                wire:click="$dispatch('previousStep')">
            Previous
        </button>
        <button type="button"
                class="btn btn-primary"
                wire:click="submit_form"
                @if(!isset($formData['step1']) || !isset($formData['step2']) || ($formData['step1']['subscriptionType'] == 'premium' && !isset($formData['step3']))) disabled @endif>
            Complete Registration
        </button>
    </div>
</div>
