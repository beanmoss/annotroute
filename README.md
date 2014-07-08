#Annotroute: Laravel 4 Controller routing annotations.
==========

Allows you to use Route annotations on your laravel controllers.


To install annotroute as a Composer package to be used with Laravel 4, simply add this to your composer.json:

```json
"beanmoss/annotroute": "dev-master"
```

..and run `composer update`.  Once it's installed, you can register the service provider in `app/config/app.php` in the `providers` array.
I strongly suggest that it should be registeristered after the Router Provider:

```php
'providers' => array(
...
    'Beanmoss\Annotroute\AnnotrouteServiceProvider',
)
```

and for the Facade:

```php
...
'AnnotRoute'      => 'Beanmoss\Annotroute\Facade\AnnotRoute',
...
```

#Usage
```php
<?php
use Beanmoss\Annotroute\Annotation\Route as MyRoute;
/**
 * @MyRoute(group={"prefix" = "home", "before" = "auth"})
 */
class HomeController extends BaseController
{
    /*
      |--------------------------------------------------------------------------
      | Default Home Controller
      |--------------------------------------------------------------------------
      |
      | You may wish to use controllers instead of, or in addition to, Closure
      | based routes. That's great! Here is an example controller method to
      | get you started. To route to this controller, just add the route:
      |
      |	Route::get('/', 'HomeController@showWelcome');
      |
     */

    /**
     * @MyRoute(method="get", path="/")
     * @MyRoute(method="get", path="/welcome")
     */
    public function showWelcome()
    {
        return View::make('hello');
    }

    /**
     * @MyRoute(
     *  method="get", 
     *  path="/test/{id}/{name}", 
     *  before = "", 
     *  name="test", 
     *  where={"id" = "[0-9]+","name" = "[a-z]+"}
     * )
     */
    public function test($id, $name)
    {
        return 'test' . $id . $name;
    }
}


```

And somewhere in your routes.php
```php
<?php

/*
  |--------------------------------------------------------------------------
  | Application Routes
  |--------------------------------------------------------------------------
  |
  | Here is where you can register all of the routes for an application.
  | It's a breeze. Simply tell Laravel the URIs it should respond to
  | and give it the Closure to execute when that URI is requested.
  |
 */

AnnotRoute::generateRoute('HomeController');
```

Thats it! If you found some bugs, please let me know. Thank you!
Also, you can help me test this ;)
