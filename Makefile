.phony:

# To start makefile commands use: make <command> <flags>



# 1. Main Commands

# optimize files
optimize:
	php artisan optimize

# serve service
serve: optimize
	php artisan serve

# show list of routes
route:
	php artisan route:list



# 2. NPM Commands

# building project
build: optimize
	npm run build

# run development mode for project
dev: build
	npm run dev



# 3. DataBase Commands

# create migration, factory and seeder for model (flag: m=<model>)
model-full:
	php artisan make:model $(m) -sfm

# create model (flag: m=<model>)
model:
	php artisan make:model $(m)

# create model (flag: f=<factory>)
factory:
	php artisan make:factory $(f)

# create migration (flag: m=<migration>)
migration:
	php artisan make:migration $(m)

# create seeder (flag: s=<seeder>)
seeder:
	php artisan make:seeder $(s)

# add foreign to table (flag: t=<table>)
foreign:
	php artisan make:migration add_foreign_to_$(t)_table

# deleting tables, create tables and filling records
migrate-up: optimize wipe migrate seed

# deleting tables
wipe: optimize
	php artisan db:wipe

# create tables
migrate: optimize
	php artisan migrate

# filling records
seed: optimize
	php artisan db:seed



# 4. Controller Commands

# create controller (without word "Controller": c=<controller_name>)
controller:
	php artisan make:controller $(c)Controller

# create resource controller (without word "Controller": c=<controller_name>)
controller-resource:
	php artisan make:controller $(c)Controller -r



# 5. Cache Commands

# clear cache
cache: optimize
	php artisan cache:clear
