# 🛒 Product API (PHP & MySQL CRUD)

This is a robust, simple RESTful API built with plain PHP, designed to perform full CRUD (Create, Read, Update, Delete) operations on a product catalog stored in a MySQL database.

The project is structured using the Model-View-Controller (MVC) pattern principles, focusing on the **Model** (Product Class) and **Controller** (API Endpoints).

---


## 🛠️ Prerequisites

To run this API locally, you need a local server environment with PHP and MySQL support.

* **WAMP/XAMPP/MAMP:** A local development environment.
* **PHP 7.4+**
* **MySQL Database** (or MariaDB)
* **Postman/Insomnia:** For testing the endpoints.

---

## ⚙️ Installation and Setup

### 1. Database Setup

1.  Create a new MySQL database (e.g., `project_db`).
2.  Run the following SQL to create the necessary tables (`products`, `categories`, `brands`). *(Note: You may need to adjust table names based on your exact schema, e.g., if you are using 'posts' instead of 'products').*

    ```sql
    -- Example for the Products Table
    CREATE TABLE products (
        id INT PRIMARY KEY AUTO_INCREMENT,
        product_title VARCHAR(255) NOT NULL,
        product_description TEXT,
        product_keyword VARCHAR(255),
        category_id INT NOT NULL,
        brand_id INT NOT NULL,
        product_image VARCHAR(255),
        product_price DECIMAL(10, 2) NOT NULL,
        created_at DATETIME DEFAULT CURRENT_TIMESTAMP
    );

    CREATE TABLE categories (
        id INT PRIMARY KEY AUTO_INCREMENT,
        name VARCHAR(100) NOT NULL
    );

    CREATE TABLE brands (
        id INT PRIMARY KEY AUTO_INCREMENT,
        name VARCHAR(100) NOT NULL
    );
    ```

### 2. Configure Database Connection

Update the file `config/Database.php` with your local database credentials:

```php
// config/Database.php
private $host = 'localhost';
private $db_name = 'project_db'; // <--- CHANGE THIS
private $username = 'root';     // <--- CHANGE THIS
private $password = '';         // <--- CHANGE THIS
