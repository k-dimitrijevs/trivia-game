# Trivia game

#### Game mechanics:

- User can login/register
- By starting a game, application generates 20 random trivia questions from [Numbers API](http://numbersapi.com/)
- Each question has given option to select correct answer from 3 options
- If selected option is incorrect, user get message with total questions answered and last question with the correct answer
- User wins trivia game if he has answered all the questions correctly

#### To run this project:

- Clone repository
- Create database and add that to `.env` (rename `.env.example`)
- Open terminal and go to project location
- Run `composer install`
- You need to migrate database with `php artisan migrate`
- To launch server run `php artisan serve`
