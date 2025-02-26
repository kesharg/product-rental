# Product API Implementation

This repository contains the implementation of a simple API to fetch product data based on various filters (e.g., region, rental period). It is built using **Laravel** and follows best practices for API design, caching, and validation.

---

## Features

- **Fetch product details** along with attributes and pricing based on region and rental period filters.
- Uses **Laravel's Eloquent ORM** for querying and relationships.
- **Caching** product data for one hour to improve performance.
- Provides **validation** for query parameters like `region_id` and `rental_period_id`.

---

## Prerequisites

Before getting started, make sure you have the following installed on your system:

- **PHP** (8.2)
- **Composer** (for managing PHP dependencies)
- **MySQL** (or another database supported by Laravel)

---

## Setting Up the Project

### 1. Clone the Repository

Clone this repository to your local machine using Git:


git clone https://github.com/kesharg/product-rental.git
cd product-rental


### 2. Install the dependencies:
   
   composer install

### 3. Copy the .env.example file to .env:

    cp .env.example .env

### 4. Configure your database connection in .env. For example:

    DB_CONNECTION=mysql
    DB_HOST=127.0.0.1
    DB_PORT=3306
    DB_DATABASE=your_database_name
    DB_USERNAME=your_database_username
    DB_PASSWORD=your_database_password

### 5. Generate the application key:

   php artisan key:generate

### Running Migrations and Seeders

Run the migrations to create the necessary tables in the database, and seed the tables with initial data:

    php artisan migrate --seed

### Testing the API
1. Run the Laravel development server:

    php artisan serve

2. Use a tool like Postman or cURL to test the API endpoints. Example API request:

    GET http://127.0.0.1:8000/api/products/1?region_id=2&rental_period_id=3

Where {id} is the product ID, region_id is the region filter, and rental_period_id is the rental period filter.

Example Responses
    {
    "id": 1,
    "name": "Product 1",
    "description": "This is product 1 description.",
    "sku": "SKU001",
    "attributes": {
        "Color": [
            {
                "attribute_value_id": 5,
                "name": "Color",
                "value": "Green"
            },
            {
                "attribute_value_id": 1,
                "name": "Color",
                "value": "Red"
            }
        ],
        "Size": [
            {
                "attribute_value_id": 2,
                "name": "Size",
                "value": "Medium"
            }
        ]
    },
    "pricing": [
        {
            "region_id": 2,
            "region_name": "Malaysia",
            "rental_periods": [
                {
                    "rental_period_id": 3,
                    "rental_period_name": "12 months",
                    "price": "22.99"
                }
            ]
        }
    ]
}


### Contributing

Feel free to fork the repository and submit pull requests. Contributions are welcome!

### License

This project is licensed under the MIT License.

