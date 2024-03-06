# Recipe-Finder

Welcome to Recipe Finder, a web application designed to help you manage and save your favorite recipes! With Recipe Finder, you can log in to save your recipes for future reference or browse as a guest to discover new recipes.

## Features

- **User Authentication**: Securely log in to your account to access the full functionality of Recipe Finder.
- **Guest Mode**: Browse and view all recipes without needing to create an account, but without the ability to save recipes.
- **Save Recipes**: Once logged in, users can save their favorite recipes for easy access later.
- **Encrypted Credentials**: User credentials are securely encrypted to ensure privacy and security.

## Technologies Used

- **Backend**: PHP is used to handle server-side logic, user authentication, and interaction with the database.
- **Database**: SQL (Structured Query Language) is used to store and retrieve recipe data.
- **Frontend**: HTML, CSS, and JavaScript are used to create a user-friendly interface for interacting with the application.

## Getting Started

To run Recipe Finder locally, follow these steps:

1. Clone this repository to your local machine.
2. Set up a web server environment with PHP support (e.g., Apache, Nginx).
3. Import the provided SQL database schema to set up the necessary tables.
4. Configure the database connection in the PHP files to match your local environment.
5. Open the application in your web browser.

## Usage

1. **Register/Login**: If you're a new user, register for an account. Existing users can log in with their credentials.
2. **Browse Recipes**: Explore the collection of recipes available on the website.
3. **Save Recipes**: When logged in, you can save recipes to your account for later reference.
4. **Logout**: Safely log out of your account when you're done using the application.

## Security

- User credentials are securely encrypted using encryption function to protect user privacy.
- Access to certain features is restricted based on user authentication status to prevent unauthorized actions.