<div>
    <form wire:submit.prevent="submitStep">
        <div class="mb-4">
            <label class="form-label">{{ __('address.country') }}</label>
            <select class="form-select @error('country') is-invalid @enderror"
                     wire:model="country" wire:change="handleCountryChange($event.target.value, $event.target.getAttribute('data-code'))">
                <option value="">Select Country</option>
                @foreach($countries as $id=>$country_details)
                    <option value="{{ $id }}-{{$country_details['code']}}-{{$country_details['name']}}">{{ $country_details['name'] }}</option>
                @endforeach
            </select>
            @error('country')
            <div class="invalid-feedback">{{ $message }}</div>
            @enderror



        </div>



        @if(count($address_fields) > 0)
            @foreach($address_fields as $field => $label)
                <div class="mb-4">
                    <label class="form-label">{{__($label)}}</label>
                    <input type="text"
                           class="form-control @error($field) is-invalid @enderror"
                           wire:model.lazy="{{$field}}">
                    @error($field)
                    <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
            @endforeach



        @endif

        <div class="d-flex justify-content-between">
            <button type="button" class="btn btn-secondary" wire:click="$dispatch('previousStep')">
                Back
            </button>
            <button type="submit" class="btn btn-primary">
                Continue
            </button>
        </div>
    </form>
</div>
