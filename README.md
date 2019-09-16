# Base Full API Rest Symfony
Project base for make a profesional API with Symfony PHP framework. I'm currently working for improve day by day the repository for get a professional base.

Included:
- Doctrine ORM
- Authentification Security
- Swagger API Doc
- PHPUnit


### Get Started
##### 1. Clone the repository:
`git clone https://github.com/edgarramal/base-full-api-rest-symfony.git`

##### 2. Install Composer dependencies:
*Depending if you have local composer or not*

`composer install` or `php composer.phar install`

##### 3. Configure Database connection:
*Update this constant with your mysql connection database on `.env` file*

api/.env
`DATABASE_URL=mysql://username:password@127.0.0.1:3306/database_name`

##### 4. Run migrations:

`php bin/console doctrine:migrations:migrate`

##### 5. Run Symfony Server:
`symfony server:start`

------------


### Run tests
Run tests with PHPUnit
`php bin/phpunit tests`

------------


### Swagger Doc
path to look it:
`http://server:port/doc`
