# Testing

## Backend testing (PHP Laravel)

run `php artisan test` for run manual testing (not required migration file)

run `php artisan test --parallel` for better performance (required migration file)

## How to create migration from existing database

### Package name

- [laravel-migrations-generator](https://github.com/kitloong/laravel-migrations-generator)

### Step

- run this command everytime before start write the test
```
php artisan migrate:generate --tables="table_name"
----------------------------
```


## Remind
Every `feature` Every `function` Every `exception` must have test case :) 
