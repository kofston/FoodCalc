<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Model;

//Prototyp (służy do sklonowania danego obiektu bez potrzeby referencji do klasy, wykorzystam go do liczenia kalorii (wiele obiektów Nazwa Kcal, całość przekaze przez "referencje") )
class Prototype extends Model{
    public $primitive;
    public $component;
    public $circularReference;

    public function __clone()
    {
        $this->component = clone $this->component;
        $this->circularReference = clone $this->circularReference;
        $this->circularReference->prototype = $this;
    }
}
