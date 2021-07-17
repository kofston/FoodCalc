<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Model;

interface IProxy
{
    public function checkpass();
}
//Definicja pierwszego obiektu (klasy).
class ProxyFirstStatement extends Model implements IProxy
{
    public function checkpass($password=NULL)
    {
        if(strlen($password)>=6)
            return true;
        else
            echo redirect('/bad_password?lenght=1');
    }
}
