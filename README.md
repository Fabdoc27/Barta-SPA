## Getting Started

Follow these instructions to set up the project.

### Installation

1. **Clone the repository:**

    ```shell
    git clone "git@github.com:ashrafulbinharun/LCP_Assignment-11.git"
    ```

2. **Navigate to the project directory:**

    ```shell
    cd "LCP_Assignment-11"
    ```

3. **Install PHP dependencies:**

    ```shell
    composer install
    ```

4. **Install Node.js dependencies:**

    ```shell
    npm install
    ```

5. **Create the environment file:**

    ```shell
    cp .env.example .env
    ```

6. **Generate the application key:**

    ```shell
    php artisan key:generate
    ```

7. **Run database migrations:**

    ```shell
    php artisan migrate
    ```

8. **Seed the database (optional):**

    ```shell
    php artisan db:seed
    ```

9. **Start the local development server:**

    ```shell
    php artisan serve
    ```

10. **Compile front-end assets:**

    ```shell
    npm run dev
    ```
