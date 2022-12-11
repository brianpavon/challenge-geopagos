<?php
namespace Config;

use Illuminate\Database\Capsule\Manager as Capsule;
use Illuminate\Events\Dispatcher;
use Illuminate\Container\Container;

class Database{
    public function __constructor(){
        $capsule = new Capsule;
        
        $capsule->addConnection([
            'driver' => 'mysql',
            'host' => 'localhost',
            'database' => 'geopagos',
            'username' => 'root',
            'password' => '',
            'charset' => 'utf8',
            'collation' => 'utf8_unicode_ci',
            'prefix' => '',
        ]);
        
        $capsule->setEventDispatcher(new Dispatcher(new Container));
        
        // Make this Capsule instance available globally via static methods... (optional)
        $capsule->setAsGlobal();
        
        // Setup the Eloquent ORM... (optional; unless you've used setEventDispatcher())
        $capsule->bootEloquent();
    }
}
