<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Model;

class NewprodPrototype extends Model
{
    public $name = '';
    public $kcal = 0;

    public function generateRandomStringWithCalories($calories = 0) {
        return substr(str_shuffle(str_repeat($x='0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ', ceil(8/strlen($x)) )),1,8)."_".$calories;
    }

    public function __construct($name,$kcal)
    {
        $this->name = $name;
        $this->kcal = $kcal;
    }

    public function setNameAndKcalToSession($newName=NULL)
    {
        if(isset($newName))
            $this->name = $newName;

        $_SESSION['PROD_ARRAY'][$this->generateRandomStringWithCalories($this->kcal)] = $this->name;
    }
}
