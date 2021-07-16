<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Model;

class Singletondatabase extends Model
{
    private static $instance;
    private $dbConn;

    private function __construct() {}

    private static function getInstance(){
        //Zawsze weźmie tą samą instancję kiedy chcę pobrać nową
        if (self::$instance == null){
            $className = __CLASS__;
            self::$instance = new $className;
        }
        return self::$instance;
    }
    private static function initMyConnection(){
        $db = self::getInstance();
        $connection_ARRAY = array('db_host'=>'127.0.0.1','db_user'=>'root','db_pwd'=>'','db_name'=>'foodcalc');
        $db->dbConn = new \mysqli($connection_ARRAY['db_host'], $connection_ARRAY['db_user'], $connection_ARRAY['db_pwd'],$connection_ARRAY['db_name']);
        return $db;
    }
    public static function getConnectionWithDatabase() {
        try {
            $db = self::initMyConnection();
            return $db->dbConn;
        } catch (Exception $ex) {
            echo "Wystapił błąd połączenia";
            return null;
        }
    }
}
