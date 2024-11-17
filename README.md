# StreamPlus Multi-Step User Onboarding Form

A Laravel/PHP application that implements a dynamic multi-step onbaording form for StreamPlus streaming service, handling user registration, address collection, and premium subscription payment details.

## Features

- Multi-step Onboarding form with dynamic steps based on subscription choice
- Comprehensive validation for all user inputs
- Country-specific address field validation
- Secure payment information collection
- Session-based form state management
- Responsive Bootstrap 5 UI
- Database persistence with proper relationships

## Prerequisites

- PHP 8.1 or higher
- Composer
- MySQL 5.7 or higher
- Node.js and npm (for frontend assets)
- Git

## Installation

1. Clone the repository:
```bash
git clone https://github.com/shafeekbs/streamplus.git
cd streamplus
```

2. Install PHP dependencies:
```bash
composer install
```

4. Configure environment:
```bash
cp .env.example .env
php artisan key:generate
```

5. Configure your database in the `.env` file:
```
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=streamplus
DB_USERNAME=your_username
DB_PASSWORD=your_password
```

6. Run database migrations:
```bash
php artisan migrate
```

7. Seed the database with required data (countries list):
```bash
php artisan db:seed
```
## Configuration

**Country Configuration**
- Address fields in the country can be configured. Remove deafult fields and update rules for the fields
- Config path - config/countries/[country_code].php
- Create a new config file for a country with the following format. If not default config will be used.
```php
return [
    'fields' => [
        'address_line_1' => 'address.address_line_1',
        'address_line_2'=> 'address.address_line_2',
        'city' => 'address.city',
        'state' => 'address.state',
        'postal_code' => 'address.postal_code',
        'country' => 'address.country'
    ],
    'rules' => [

        'address_line_1' => 'required|string|max:255',
        'address_line_2' => 'nullable|string|max:255',
        'city' => 'required|string|max:255',
        'postal_code' => 'required|string|max:20',
        'state' => 'required|string|max:255',
        'country' => 'required',
    ]
];

```

## Running the Application

1. Start the development server:
```bash
php artisan serve
```

2. Access the application at `http://localhost:8000`

## Project Structure

```
app/
├── Livewire/
│   └── OnboardingForm.php
│       └── Steps/
│           ├── PersonalInfo.php
│           ├── Address.php
│           ├── Payment.php
│           └── Review.php
└── Services/
    ├── CountryConfig/
    │    ├── CountryConfigInterface.php
    │    └── CountryConfigService.php
    ├── FormProcessor/
    │   ├── FormProcessorInterface.php
    │   └── FormProcessor.php   
    └── Payment/
        ├── PaymentProcessorInterface.php
        └── PaymentProcessor.php


resources/
└── views/
    ├── livewire/
    │    ├── onbaording.blade.php
    │    └── steps/
    │        ├── personal-info.blade.php
    │        ├── address.blade.php
    │        ├── payment.blade.php
    │        └── review.blade.php
    └── success.blade.php
```




## Services

- **FormProcessor**: Handles form data processing
- **PaymentProcessor**: Handles payment processing
- **CountryConfigService**: Return country specific config for address fields based on the selected country



## Database Schema

The application uses the following main tables:

- `members`: Stores basic member information and subscription type
- `addresses`: Stores user address details
- `payment_details`: Stores payment information for premium subscribers
- `countries`: Have the list of countries

## Improvement Considerations
- **Connecting members with user data**: Since the task was to onbaording members members and users tables are not connected. Users table can be used to hold name, email and members table can hold addtional data
- **To integrate payment gateways**, create new service implementing PaymentServiceInterface


## Security Considerations

- All user inputs are validated and sanitized
- Payment information is stored securely (encrypted)
- CSRF protection is enabled
- Session data is properly managed
- Form steps are protected against unauthorized access


## Support

For support, please email [your-email@example.com](mailto:shafeekbs786@gmail.com)
