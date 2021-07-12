<?php

namespace App\Http\Controllers;

use App\Singletondatabase;
use Illuminate\Database\Eloquent\Model;
use Request;
use DB;

class SingletondatabaseController extends Controller
{
    /**
     * Our single database client instance.
     *
     * @var Database
     */
    private static $instance;

    /**
     * Disable instantiation.
     */
    private function __construct()
    {
        // Private to disabled instantiation.
    }

    /**
     * Create or retrieve the instance of our database client.
     *
     * @return Database
     */
    public static function getInstance()
    {
        if (is_null(static::$instance)) {
            static::$instance = new Database;
            static::$instance->setHost('127.0.0.1');
            static::$instance->setPort(3306);
            static::$instance->setUsername('root');
            static::$instance->setPassword('');
        }

        return static::$instance;
    }

    /**
     * Disable the cloning of this class.
     *
     * @return void
     */
    final public function __clone()
    {
        throw new Exception('Feature disabled.');
    }

    /**
     * Disable the wakeup of this class.
     *
     * @return void
     */
    final public function __wakeup()
    {
        throw new Exception('Feature disabled.');
    }
}
