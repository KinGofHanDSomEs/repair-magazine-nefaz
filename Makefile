.phony:

# To start makefile commands use: make <command> <flags>


# 1. Main Commands

# optimize files
optimize:
	php artisan optimize

# show list of routes
route: optimize
	php artisan route:list

# serve service
serve: route
	php artisan serve



# 2. NPM Commands

# building project
build: optimize
	npm run build

# run development mode for project
dev: build
	npm run dev



# 3. Make Component Commands

# create view (flag: v=<view>)
view:
	php artisan make:view $(v)

# create controller (without word "Controller", flag: c=<controller_name>)
controller:
	php artisan make:controller $(c)Controller

# create resource controller (without word "Controller", flag: c=<controller_name>)
controller-resource:
	php artisan make:controller $(c)Controller -r

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


# 4. Database Commands

# deleting tables, create tables and filling records
migrate-up: wipe migrate seed

# deleting tables
wipe: optimize
	php artisan db:wipe

# create tables
migrate: optimize
	php artisan migrate

# filling records
seed: optimize
	php artisan db:seed



# 5. Clear Cache Commands
# clear all caches
cache: config-clear route-clear view-clear

# clear config cache
config-clear: optimize
	php artisan config:clear

# clear route cache
route-clear: optimize
	php artisan route:clear

# clear view cache
view-clear: optimize
	php artisan view:clear
