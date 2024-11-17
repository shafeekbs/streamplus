<div>
    <h3>Personal Information</h3>
    <form wire:submit.prevent="submitStep">
        <div class="mb-3">
            <label class="form-label">Name</label>
            <input type="text" class="form-control @error('name') is-invalid @enderror" wire:model.lazy="name" >
            @error('name') <span class="text-danger">{{ $message }}</span> @enderror
        </div>

        <div class="mb-3">
            <label class="form-label">Email</label>
            <input type="email" class="form-control @error('email') is-invalid @enderror" wire:model.lazy="email" >
            @error('email') <span class="text-danger">{{ $message }}</span> @enderror
        </div>

        <div class="mb-3">
            <label class="form-label">Phone</label>
            <input type="tel" class="form-control @error('phone') is-invalid @enderror" wire:model.lazy="phone" >
            @error('phone') <span class="text-danger">{{ $message }}</span> @enderror
        </div>

        <div class="mb-3">
            <label class="form-label">Subscription Type</label>
            <select class="form-select @error('subscriptionType') is-invalid @enderror" wire:model="subscriptionType" wire:change="handleSubscriptionChange()" >
                <option value="free">Free</option>
                <option value="premium">Premium</option>
            </select>
            @error('subscriptionType') <span class="text-danger">{{ $message }}</span> @enderror
        </div>

        <button type="submit" class="btn btn-primary">Next</button>
    </form>
</div>
