Laravel Task Management Application

This is a simple task management application built with Laravel. It allows users to create, edit, delete, and reorder tasks with drag-and-drop functionality. Tasks are prioritized automatically based on their order.

Features

- Create, edit, delete tasks
- Drag and drop to reorder tasks
- Task priority automatically updated based on order
- Associate tasks with projects

Installation

1. Clone the repository:
    git clone https://github.com/Egzonag/task-manager.git
    cd task-manager

2. Install dependencies:
   composer install
   npm install

3. Set up the environment:
    cp .env.example .env
    php artisan key:generate

4. Update `.env` with your database credentials
    DB_DATABASE=your_database
    DB_USERNAME=your_username
    DB_PASSWORD=your_password

5. Migrate the Database
    php artisan migrate

6. Run the Application
    php artisan serve

7. Compile Frontend Assets
    npm run dev

Testing

1. Navigate to the /projects page to create a few projects.
2. After adding projects, go to the Task Manager to manage tasks associated with those projects.