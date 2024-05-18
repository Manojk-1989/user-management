# User Management Application

## Overview

The User Management Application is a Laravel 10-based project designed to manage user data efficiently. Users can be created, viewed, edited, and deleted. The application also includes management for departments and designations, ensuring a structured approach to handling user information.

## Features

- **User Management**: Create, edit, and delete users with details such as name, department, designation, and contact number.
- **Department and Designation Management**: Master data management for departments and designations.
- **Yajra Datatables**: View user data in a dynamic and interactive datatable.
- **Card Grid View**: Users can also be viewed as a grid of cards.
- **Search Functionality**: Search users based on name, designation, or department.

## Installation and Setup

Follow these steps to set up the application:

1. **Clone the Repository**

   ```bash
   git clone https://github.com/your-username/user-management.git
   ```

2. **Navigate to the Project Directory**

   ```bash
   cd user-management
   ```

3. **Install Dependencies**

   ```bash
   composer install
   ```

4. **Configure Environment Variables**

   - Copy the `.env.example` file to `.env`.

     ```bash
     cp .env.example .env
     ```

   - Update the `.env` file with your database information:

     ```dotenv
     DB_CONNECTION=mysql
     DB_HOST=127.0.0.1
     DB_PORT=3306
     DB_DATABASE=your_database_name
     DB_USERNAME=your_database_user
     DB_PASSWORD=your_database_password
     ```

5. **Generate Application Key**

   php artisan key:generate

6. **Run Migrations**

   php artisan migrate:fresh

7. **Serve the Application**

   php artisan serve

   The application will be accessible at `http://localhost:8000`.

## Usage

- **Creating a User**: Navigate to the user creation form and fill in the required details (name, department, designation, and contact number).
- **Viewing Users**:
  - **Datatable View**: View all users in a tabular format with sorting and searching functionalities.
  - **Card Grid View**: View users as cards, providing a quick visual overview.
- **Editing a User**: Click on the edit button next to a user's entry to modify their details.
- **Deleting a User**: Click on the delete button next to a user's entry to remove their details from the database.
- **Searching Users**: Use the search functionality to filter users by name, designation, or department.

## Contributing

If you wish to contribute to this project, please follow these steps:

1. Fork the repository.
2. Create a new branch for your feature or bugfix.
3. Commit your changes and push the branch to your fork.
4. Create a pull request with a detailed description of your changes.

## License

This project is open-source and available under the [MIT License](LICENSE).

---

For any additional questions or support, please contact [manojkumarka99@gmail.com](manojkumarka99@gmail.com).