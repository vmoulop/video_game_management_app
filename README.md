Description : This Video Game Management System is designed to help users manage their personal video game collections. Built using Laravel, this system offers a simple and intuitive API for interacting with users’ game libraries. 

Users Roles : Admin, Regular (Default)

Versions Used for the implementation (Prerequisites)

PHP : 8.1.31

Composer : 2.6.0

Laravel : 10.48.28

MySQL : 8.0.41

Installation Guide (the commands below should be executed in bash terminal)

1. Clone the Repository

git clone https://github.com/vmoulop/video_game_management_app.git

cd video_game_management_app

2. Install PHP Dependencies

composer install

Note : In case you face any issues try to execute 

composer install --ignore-platform-reqs

3. Configure Environment Variables

cp .env.example .env

Next, configure your database connection in the .env file, e.g.

DB_CONNECTION=mysql

DB_HOST=127.0.0.1

DB_PORT=3306

DB_DATABASE=video_game_db

DB_USERNAME=root

DB_PASSWORD=

Make sure to adjust the DB_DATABASE, DB_USERNAME, and DB_PASSWORD to reflect your actual MySQL setup.

4. Create the Database

- Log in to MySQL:

mysql -u root -p

- Create a new database:

CREATE DATABASE video_game_db;

- Exit MySQL:

exit

Note : Make sure the database name in the .env file matches the one you created above.

5. Run Database Migrations

php artisan migrate

This command will create all required tables, including those for users, video games, and review/ratings.
Note : The database will not initialized with sample data. Users can start adding user,video games and review/ratings once
the application starts and its accessible (see next step).

6. Serve the Application

php artisan serve

By default, the application will be accessible at http://127.0.0.1:8000.

API Endpoints

POST /api/register : Create a new user

POST /api/login : Log in and obtain an authentication token

GET /api/games : Get a list of video games

POST /api/games/{game ID} : View a single video game

POST /api/games : Add a new video game (authentication required)

PUT /api/games/{id} : Edit an existing video game (authentication required)

GET /api/dashboardview : User's game dashboard (view format)

GET /api/dashboardjson : User's game dashboard (json format)

DELETE /api/games/{id} : Delete a game (authentication required. Only Admin User can delete video games of other users)

POST /api/games/review/{id} : Create a new rating and review for existing video game
