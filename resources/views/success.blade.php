<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Registration Successful - {{ config('app.name') }}</title>

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Bootstrap Icons -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">
</head>
<body class="bg-light">
<div class="container py-5">
    <div class="row justify-content-center">
        <div class="col-12 col-md-8 col-lg-6">
            <div class="card border-0 shadow-sm">
                <div class="card-body p-4 p-md-5">
                    <!-- Success Icon -->
                    <div class="text-center mb-4">
                        <div class="bg-success text-white rounded-circle p-3 d-inline-block">
                            <i class="bi bi-check-lg" style="font-size: 3rem;"></i>
                        </div>
                    </div>

                    <!-- Success Message -->
                    <div class="text-center mb-4">
                        <h2 class="h3 mb-3">Registration Successful!</h2>
                        <p class="text-muted mb-0">Your account has been created successfully.</p>
                    </div>

                    <!-- Welcome Message -->
                    <div class="bg-light rounded p-4 mb-4">
                        <h5 class="text-primary mb-3">
                            <i class="bi bi-stars me-2"></i>Welcome to {{ config('app.name') }}!
                        </h5>
                        <p class="text-muted mb-0">
                            Thank you for joining us. Your registration details have been sent to your email.
                        </p>
                    </div>

                    <!-- Next Steps -->
                    <div class="bg-light rounded p-4 mb-4">
                        <h5 class="mb-3">Next Steps:</h5>
                        <ul class="list-unstyled mb-0">
                            <li class="d-flex align-items-center mb-3">
                                <i class="bi bi-envelope-check text-success me-3"></i>
                                Verify your email address
                            </li>
                            <li class="d-flex align-items-center mb-3">
                                <i class="bi bi-person-circle text-success me-3"></i>
                                Complete your profile
                            </li>
                            <li class="d-flex align-items-center">
                                <i class="bi bi-collection-play text-success me-3"></i>
                                Explore our content library
                            </li>
                        </ul>
                    </div>

                    <!-- Action Links -->
                    <div class="border-top pt-4 mt-4">
                        <div class="row g-3">
                            <div class="col-6">
                                <a href="#"
                                   class="btn btn-primary w-100">
                                    <i class="bi bi-columns-gap me-2"></i>Go to Dashboard
                                </a>
                            </div>
                            <div class="col-6">
                                <a href="{{ route('onboarding.form') }}"
                                   class="btn btn-outline-secondary w-100">
                                    <i class="bi bi-plus-circle me-2"></i>New Registration
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Support Section -->
            <div class="text-center mt-4">
                <p class="text-muted mb-2">Need help getting started?</p>
                <div class="d-flex justify-content-center gap-3">
                    <a href="#" class="text-decoration-none">
                        <i class="bi bi-question-circle me-1"></i>Help Center
                    </a>
                    <span class="text-muted">|</span>
                    <a href="#" class="text-decoration-none">
                        <i class="bi bi-envelope me-1"></i>Contact Support
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Bootstrap JS -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
