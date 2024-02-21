# Job Application

## Installation Procedure:

### Laravel Standard Procedure:

1. Clone the repository:

    ```bash
    git clone https://github.com/Dzyfhuba/job-application.git
    ```

2. Change into the project directory:

    ```bash
    cd job-application
    ```

3. Install dependencies:

    ```bash
    composer install
    ```

4. Copy the .env.example file to .env:

    ```bash
    cp .env.example .env
    ```

5. Configure your database settings in the .env file.

6. Generate application key:

    ```bash
    php artisan key:generate
    ```

7. Run database migrations and seed the database:

    ```bash
    php artisan migrate --seed
    ```

8. Start the development server:
    ```bash
    php artisan serve
    ```

### Laravel Sail / Docker Procedure:

1. Clone the repository:

    ```bash
    git clone https://github.com/Dzyfhuba/job-application.git
    ```

2. Change into the project directory:

    ```bash
    cd job-application
    ```

3. Copy the .env.example file to .env:

    ```bash
    cp .env.example .env
    ```

4. Configure your database settings in the .env file.

5. Run Laravel Sail:

    ```bash
    sail up -d
    ```

6. Install dependencies within the Sail container:

    ```bash
    sail composer install
    ```

7. Generate application key within the Sail container:

    ```bash
    sail artisan key:generate
    ```

8. Run database migrations and seed the database within the Sail container:
    ```bash
    sail artisan migrate --seed
    ```

## API Documentation:

Access the API documentation (Swagger) at /api/documentation after running the application.  
To generate the API documentation, you can use either of the following commands:

-   Using Laravel Sail:
    ```bash
    sail artisan l5-swagger:generate
    ```
-   Using Laravel (without Sail):
    ```bash
    php artisan l5-swagger:generate
    ```

Make sure to run the respective command based on your environment.
