## OtakuThings

Otakuthings is a web application that use Public API of MAL (Jikan) to find and search information about anime or manga.

## Features

- Search & advanced search bar for finding information about anime/manga
- Top 50 Anime/Manga All time
- Anime On-Air schedule
- Seasonal Anime

## Requirements

OtakuThings use Laravel 7 as the Framework so it gonna requires:

- PHP 7 or higher
- MySQL/MariaDB/Other database (actually there is no activity on the database)
- Composer

## Installation

Clone current repository or download the repository [here](https://github.com/EnKuldes/OtakuThings.git).

Go to repository folder and run the following command
```bash
# install repo
composer install

# copy .env example and 
cp .env.example .env

# generate app key
php artisan key:generate

# run migration and seeder
php artisan migrate --seed
```

Edit .env file to your needed (ex. DB_HOST, DB_PASSWORD, APP_NAME, APP_ENV, etc) using your fav text editor.

## Usage

You can run it by deploying in using Virtual Host or running locally using following command
```bash
php artisan serve
```