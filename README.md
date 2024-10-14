# Bill Payments API

## Overview

This is a simple RESTful API built using Laravel for managing bill payments. It consists of two main resources: `users` and `transactions`.

## Requirements

- PHP >= 7.4
- Composer
- MySQL
- Laravel >= 8.x

## Setup Instructions

1. **Clone the repository:**

    ```bash
    git clone https://github.com/username/SimpleBillPaymentsApi.git
    cd SimpleBillPaymentsApi
    ```

2. **Install dependencies:**

    ```bash
    composer install
    ```

3. **Configure the `.env` file:**

    ```bash
    cp .env.example .env
    ```

    Update the `.env` file with your database details:

    ```plaintext
    DB_CONNECTION=mysql
    DB_HOST=127.0.0.1
    DB_PORT=3306
    DB_DATABASE=SimpleBillPaymentsApi
    DB_USERNAME=root
    DB_PASSWORD=
    ```

4. **Run migrations:**

    ```bash
    php artisan migrate
    ```

5. **Run the Laravel development server:**

    ```bash
    php artisan serve
    ```

    The API will be available at `http://127.0.0.1:8000`.

## Endpoints

### Users

- `GET /api/users` - List all users
- `POST /api/users` - Create a new user
- `GET /api/users/{id}` - Get a user by ID
- `PUT /api/users/{id}` - Update a user
- `DELETE /api/users/{id}` - Delete a user

### Transactions

- `GET /api/transactions` - List all transactions
- `POST /api/transactions` - Create a new transaction
- `GET /api/transactions/{id}` - Get a transaction by ID
- `PUT /api/transactions/{id}` - Update a transaction
- `DELETE /api/transactions/{id}` - Delete a transaction

## Postman Collection

You can download the Postman Collection to test the API from [Postman Collection](link-to-collection).

## Running Tests

To run the tests, use the following command:

```bash
php artisan test

Test Outcome
 PASS  Tests\Feature\TransactionTest
  ✓ it can create a transaction                                                                                            10.97s  
  ✓ it can read a transaction                                                                                               0.12s  
  ✓ it can update a transaction                                                                                             0.18s  
  ✓ it can delete a transaction                                                                                             0.11s  

   PASS  Tests\Feature\UserTest
  ✓ it can create a user                                                                                                    0.12s  
  ✓ it can read a user                                                                                                      0.13s  
  ✓ it can update a user                                                                                                    0.11s  
  ✓ it can delete a user                                                                                                    0.10s  

  Tests:    8 passed (20 assertions)
  Duration: 12.18s