# Setup

1. Clone the project `git clone `
2. Run `cd billing-concepts`
3. Run `docker compose up -d`
4. Enter php container `docker compose exec php sh`
5. Install dependencies `composer install`
6. Run migrations `php bin/console doctrine:migrations:migrate`


# Usage

Once intalled, you can try it in `http://localhost:8080/`