# Flow Digital Test App

This app uses Laravel's built in web server.

It is important to have PHP and Composer installed on your machine. As well as Node.js and NPM. Ideally install using node version manager for easy node version switching.

## How to run the app

1. Open terminal
1. Clone the repository
1. Run composer install
1. Ensure your node version is new enough above version 18.
1. Run npm install
1. Run cp .env.example .env
1. Update the .env file with your database credentials
1. Run php artisan migrate
1. Run php artisan key:generate
1. Run php artisan serve
1. Visit the displayed URL in your browser.

To login or register, click the link on the top right of the page.

## Caveats

Some features are still not available or being built.

Such as the comments, search and ability to view posts by category and tags.
