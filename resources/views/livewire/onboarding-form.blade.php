<div class="container py-4">

    <div class="row justify-content-center">

        <div class="col-md-8">
            <div class="bg-primary text-white py-4 mb-4">
                <div class="container">
                    <div class="row align-items-center">
                        <div class="col-auto">
                            <a class="navbar-brand d-flex align-items-center text-white text-decoration-none" href="/">
                                <i class="bi bi-play-circle-fill me-2" style="font-size: 2rem;"></i>
                                <span class="h3 mb-0">StreamPlus</span>
                            </a>
                        </div>
                        <div class="col text-end">
                            <span class="badge bg-white text-primary">Onboarding</span>
                        </div>
                    </div>
                </div>
            </div>
            <div class="card">
                <div class="card-header">
                    <div class="progress">
                        <div class="progress-bar" role="progressbar"
                             style="width: {{ ($current_step / $totalSteps) * 100 }}%">
                            Step {{ $current_step }} of {{ $totalSteps }}
                        </div>
                    </div>
                </div>

                <div class="card-body">

                    @if($current_step === 1)
                        @livewire('steps.personal-info')
                    @elseif($current_step === 2)
                        @livewire('steps.address')
                    @elseif($current_step === 3 && $formData['step1']['subscriptionType'] === 'premium')
                        @livewire('steps.payment')
                    @else
                        @livewire('steps.review')
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
