#!/usr/bin/env bash

cp ./.env.example ./.env

composer install --no-interaction

php artisan key:generate

touch ./database/database.sqlite
php artisan migrate --seed

pnpm install
pnpm run build
