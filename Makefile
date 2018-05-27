vendor/autoload.php:
	composer install --no-interaction --prefer-dist

test:
	vendor\bin\phpunit --verbose
