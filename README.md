# Quizzit

Revolutionizing quiz experiences with intuitive creation tools, diverse question formats, timed challenges, and premium access for unlimited quizzes.

## Installation
Clone the repo
```
    git clone https://github.com/FatefulNur/quizzit.git
```

## Usage

Follow the instructions
- Go to your project root.
- Open terminal and run `cd testing` command.
- Run `composer install` on your cmd or terminal
- Copy `.env.example` file to `.env` on the root folder.
- Run `php artisan key:generate`.
- Run `php artisan migrate --seed`.
- Run `npm run dev`.
- Run `php artisan serve`.
- Go to http://localhost:8000/ for login with credentials such as 
    - email: `admin@test.com`
    - password: `password`.

## Mail Configuration
You can use **mailtrap** to set you email configuration testing email in this application. [Here](https://mailtrap.io/blog/send-email-in-laravel/) is the guideline of how to configure mailtrap for laravel.

To make this more simple, you can set `MAIL_MAILER=log` in your `.env` file. It will generate email markup and log that under `laravel.log` file.

## Payment Inegration 
We are utilizing payment features using [lemonsqueezy](https://www.lemonsqueezy.com/) service. You can create your own lemonsqueezy store by signin up there. ***Currently I am not providing any documents about that, as its related to api key and webhooks configuration that may includes sensitive secrets.***

## Testing
To run automated test of this application you may run command either:
- `.\vendor\bin\pest` or 
- `php artisan test`.

## Greetings
Thanks for reading.
