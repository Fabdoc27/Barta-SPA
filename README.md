# Barta - SPA

Barta is a modern single-page application (SPA) built with Laravel and Livewire, offering real-time updates via WebSockets. It features an interactive, dynamic feed, instant notifications, and seamless user interactions with no page reloads, providing an optimized, smooth experience throughout.

## Features

-   **Dynamic Home Feed**: Infinite scrolling, user filtering, and stats for likes and comments.
-   **Real-Time Notifications**: Instant updates for likes and comments via WebSockets (Pusher & Laravel Echo).
-   **Live Search Bar**: Quickly find users with instant search results.
-   **User-Friendly SPA**: Built entirely with Livewire for smooth transitions and optimal performance.

## Getting Started

Follow these instructions to set up the project.

### Installation

1. **Clone the repository:**

    ```shell
    git@github.com:ashrafulbinharun/Barta-SPA.git
    ```

2. **Navigate to the project directory:**

    ```shell
    cd "Barta-SPA"
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

6. **Set up your `.env` file:**

    ```env
    BROADCAST_DRIVER=pusher
    PUSHER_APP_ID=your-app-id
    PUSHER_APP_KEY=your-app-key
    PUSHER_APP_SECRET=your-app-secret
    PUSHER_APP_CLUSTER=your-app-cluster
    ```

7. **Generate the application key:**

    ```shell
    php artisan key:generate
    ```

8. **Run database migrations:**

    ```shell
    php artisan migrate
    ```

9. **Seed the database (optional):**

    ```shell
    php artisan db:seed
    ```

10. **Start the local development server:**

    ```shell
    php artisan serve
    ```

11. **Compile front-end assets:**

    ```shell
    npm run dev
    ```

12. **Start the queue worker:**

    ```shell
    php artisan queue:work
    ```

13. **Clear livewire temporary files (additional):**

    ```shell
    php artisan clear-livewire-temp
    ```
