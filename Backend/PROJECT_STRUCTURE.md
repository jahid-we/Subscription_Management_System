# Project Structure

This is the folder structure for a clean and organized project. The structure follows best practices for maintaining a well-structured application.

## Project Root Folder Structure

```plaintext
# Project Root
E:\Pet-Adoption\Backend\app\Http\Controllers\authentication\AuthController.php
├── app/
│   ├── Http/
│   │   ├── Controllers/        # Contains controller classes for handling HTTP requests
│   │   |   └── authentication/
│   │   |     └──AuthController.php #Manage Auth System
│   │   ├── Middleware/         # Custom middleware for handling requests
│   │   ├── Requests/           # For form validation request classes
│   │   └── Resources/          # For response formatting classes (like API Resources)
│   ├── Models/                 # Contains Eloquent models
│   │    └──User.php            #Manage Auth System
│   ├── Providers/              # Contains service providers
│   │   └── AppServiceProvider.php  # Main service provider for binding services
│   ├── Services/               # Service classes for business logic
│   │ └── UserService.php     # service class for user-related logic
│   └── Helper/                # Helper classes or functions
│       └── JWTToken.php          # This Helper generates a JWT token
|
├── database/
│   ├── migrations/             # Database migration files for schema changes
│   └── seeders/                # Seeder files for populating the database with test data
│
├── public/                     # Publicly accessible files (index.php, assets)
│   └── index.php               # Entry point for the application
│
├── routes/
│   ├── web.php                 # Routes for web requests (return views)
│   └── api.php                 # Routes for API requests (return JSON data)
│
├── vendor/                     # Composer dependencies
│
├── .env                        # Environment configuration file (database, mail, etc.)
├── composer.json               # Composer dependency file for PHP libraries
├── composer.lock               # Composer lock file for dependency versioning
├── package.json                # Node.js dependencies for frontend
