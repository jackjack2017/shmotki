## About

Add admin interface in your LaravelProject

Also add in your project:

- support work with excell;
- auth;
- access managment for dashboard;
- assets managment for dashboard;
- HTML and Form builder


## Requirement

```
    "laravel/framework": "5.1.*",
    "roumen/asset": "2.5.5",
    "bican/roles": "2.1.*",
    "laravelcollective/html": "5.1.*",
    "maatwebsite/excel": "^2.1",
    "webmagic/users": "0.1.0"
```

## Installing guide

1. For install add to your composer.json:

 - in section "required":

 ```
 "require":{
        ...
    "webmagic/dashboard" : "0.1.3"
 }
 ```

 - in section "repositories":

 ```
 "repositories":[
         {
             "type":"vcs",
             "url":"https://bitbucket.org/laravel-components/module"
         }
 ]
 ```

2. Call in console `php composer update`. Composer may ask your username and password for access to repository

3. After installing add to `config/app.php` in section `providers`:

 ```
    'providers' => [
        ...
        LaravelComponents\Dashboard\DashboardServiceProvider::class,
    ]
 ```

4. Change in `config/auth.php`:

 `'model'=>'App\Users::class'` -> `'model'=>'LaravelComponents\Users\Models\User::class'`

5. Change in `app/Http/Middleware/Authenticate.php`:

 `return redirect()->guest('/auth/login');` -> `return redirect()->guest('/login');`

6. Change in `app/Http/Middleware/RedirectIfAuthenticated.php`:

  `return redirect('/home');` -> `return redirect('/dashboard');`

7. Remove from `app/` `User.php`

8. Remove from  `database/migrations` `..._create_users_table.php`

9. Than call in console `php artisan vendor:publish --provider=LaravelComponents\Dashboard\DashboardServiceProvider`. This will publish all needed files

10. Configure in `database/seed` `UsersSeeder.php` and add it into `DatabaseSeeder.php`

11. Than call `php artisan migrate --seed`

After all that you will seed login page on route `your.site/login`

