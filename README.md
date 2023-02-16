# BindHq test project Symfony.

## Installation Steps (commands) :
- clone this repository using `git clone https://github.com/Jaldev09/bindHqTest.git`.
- `cd bindHqTest`
- `composer install`
- Set Database configuration in .env file.
- Create Database : `php bin/console doctrine:database:create`
- Make Migration to Database : `php bin/console doctrine:migrations:migrate`
- Run Project : `php -S localhost:8000 -t public`

## URLs for Web:
- Company List : http://localhost:8000/company
- Single Company : http://localhost:8000/company/1

## URLs for API
- Note: Make sure to pass `Content-Type:application/json` is headers of API.
- Company List : http://localhost:8000/company
- Single Company : http://localhost:8000/company/1
- Postman Collection : https://api.postman.com/collections/24574406-90c080e0-0d22-4522-993f-3dcb8c4e0acf?access_key=PMAT-01GSCT7CNREVB4TP357DKSXPCV
