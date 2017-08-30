## PHP Dependecy
`apt-get install php7.0-curl php7.0-xml php7.0-zip`

## Setup
On application root:

1 `composer install`

2 `bin/console doctrine:database:create`

3 `bin/console doctrine:schema:create`

4 `bin/console doctrine:migrations:migrate -n`

## Update
On application root:

1 `git pull --rebase origin master`

2 `composer update`

3 `bin/console doctrine:schema:update --force`

4 `bin/console d:m:m -n`