<div>
    <form wire:submit.prevent="submitStep">
        <div class="row">
            <div class="col-md-12 mb-4">
                <label class="form-label">Card Number</label>
                <div class="input-group">
                    <input type="text"
                           class="form-control @error('card_number') is-invalid @enderror"
                           wire:model.lazy="card_number"
                           placeholder="1234 5678 9012 3456">
                    <span class="input-group-text">
                        <i class="bi bi-credit-card"></i>
                    </span>
                    @error('card_number')
                    <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
            </div>

            <div class="col-md-6 mb-4">
                <label class="form-label">Expiry Date</label>
                <input type="text"
                       class="form-control @error('expiry') is-invalid @enderror"
                       wire:model.lazy="expiry"
                       placeholder="MM/YY">
                @error('expiry')
                <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <div class="col-md-6 mb-4">
                <label class="form-label">CVV</label>
                <div class="input-group">
                    <input type="password"
                           class="form-control @error('cvv') is-invalid @enderror"
                           wire:model.lazy="cvv"
                           placeholder="123"
                           maxlength="3">
                    <span class="input-group-text"
                          data-bs-toggle="tooltip"
                          title="3-digit security code on the back of your card">
                        <i class="bi bi-question-circle"></i>
                    </span>
                    @error('cvv')
                    <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
            </div>
        </div>

        <div class="alert alert-info d-flex align-items-center" role="alert">
            <i class="bi bi-shield-lock me-2"></i>
            <div>
                Your payment information is secured with industry-standard encryption.
            </div>
        </div>

        <div class="d-flex justify-content-between mt-4">
            <button type="button" class="btn btn-secondary" wire:click="$dispatch('previousStep')">
                <i class="bi bi-arrow-left me-2"></i>Back
            </button>
            <button type="submit" class="btn btn-primary">
                Continue<i class="bi bi-arrow-right ms-2"></i>
            </button>
        </div>
    </form>
</div>
