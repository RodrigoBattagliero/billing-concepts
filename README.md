# Setup

**To correct instalation, you must have npm installed in you local machine.**

1. Clone the project `git clone https://github.com/RodrigoBattagliero/billing-concepts.git`
2. Run `cd billing-concepts`
3. Run `npm install`
4. Run `npm run build`
5. Run `docker compose up -d`
6. Enter php container `docker compose exec php sh`
7. Install dependencies `composer install`
8. Run migrations `php bin/console doctrine:migrations:migrate`


# Usage

Once intalled, you can try it in `http://localhost:8080/`