<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Model;

class NewprodPrototype extends Model
{
    public $name = '';
    public $kcal = 0;

    public function __construct($name,$kcal)
    {
        $this->name = $name;
        $this->kcal = $kcal;
    }

    public function setNameAndKcalToSession($newName=NULL)
    {
        if(isset($newName))
            $this->name = $newName;

        echo $this->kcal;
        echo "<br>".$this->name;
    }
}
