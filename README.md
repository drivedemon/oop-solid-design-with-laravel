# best practice design pattern

![Alt Text](https://media.giphy.com/media/v1.Y2lkPTc5MGI3NjExZTA2OXA3OGxqc2EyYndsMWJybTNpZnluN2YzNWU5aGxxcjVqbm04MCZlcD12MV9pbnRlcm5hbF9naWZfYnlfaWQmY3Q9Zw/SyP24XyDVsavNPECoR/giphy.gif)

## Framework & Tools used

- Laravel 10
- larastan
- pint

# Development

### Requirement

- PHP 8.1
- MariaDB
- Redis (for cache, queue)


### Installation (Laragon)

1. Clone project (https://github.com/drivedemon/oop-solid-design-with-laravel.git)
2. Create .env file by copy content from .env.example `cp .env.example .env`
3. (Laragon) Restart Laragon
4. (Auto by Laragon) Config custom DNS for your machine ([oop-solid-design-with-laravel.local](http://oop-solid-design-with-laravel.local)), Make sure url match
   **APP_URL** in .env
5. Run `composer install` (for Windows user,
   use `composer install --ignore-platform-req`)
6. Run `php artisan key:generate` to generate application key
7. Create your Database `PCP`, update `DB_USERNAME`, `DB_PASSWORD` in .env
8. (_optional_) Start queue worker, run `php artisan queue:work --queue=default,low` (For local dev only, Use
   `supervisor` in the test and production server)
9. Go to [http://oop-solid-design-with-laravel.local](http://oop-solid-design-with-laravel.local) to test your local website.
10. Create new feature branch to start working.

### Testing

see [testing.md](testing.md)
