# PHP RESTful API for Testing

This project is a **local RESTful API** built with PHP and MySQL. It is designed to help QA engineers practice API testing using **Postman**. The API supports **authentication (JWT-based)** and **CRUD operations**.

## 📌 Features
- ✅ User authentication (**Register & Login**) using JWT tokens.
- ✅ CRUD operations (**Create, Read, Update, Delete**) for users.
- ✅ Secure password storage (**bcrypt encryption**).
- ✅ Structured project with separate files for **database, authentication, and API logic**.
- ✅ Uses MySQL as the database.

---

## 📂 Project Structure
```sql
CREATE DATABASE api_testing;
USE api_testing;

CREATE TABLE users (
    id INT AUTO_INCREMENT PRIMARY KEY,
    username VARCHAR(50) UNIQUE NOT NULL,
    password VARCHAR(255) NOT NULL
);
```

## 🚀 Getting Started

### Prerequisites
- PHP 7.4 or higher
- MySQL
- Composer

### Installation
1. Clone the repository:
    ```sh
    git clone https://github.com/yourusername/php_api.git
    cd php_api
    ```

2. Install dependencies:
    ```sh
    composer install
    ```

3. Import the database schema:
    ```sh
    mysql -u root -p api_testing < database/schema.sql
    ```

4. Update the database configuration in [db.php](http://_vscodecontentref_/1) if necessary.

### Running the API
Start the PHP built-in server:
```sh
php -S localhost:8000