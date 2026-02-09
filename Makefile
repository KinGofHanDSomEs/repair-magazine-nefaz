.SILENCE:

# main commands for work with project

optimize:
	php artisan optimize

serve: optimize
	php artisan serve


# npm commands

build: optimize
	npm run build

dev: build
	npm run dev


# work with cache

cache: optimize
	php artisan cache:clear


# work with migrations

migration: optimize
	php artisan migrate:refresh --seed

wipe: optimize
	php artisan db:wipe

migrate: optimize
	php artisan migrate

seed: optimize
	php artisan db:seed
