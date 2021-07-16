<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Model;

//Iterator ( u mnie będzie poruszał się po obiektach (dodanych szklankach wody) i wskaże czy osoba jest poprawnie nawodniona
interface IIterator
{
    function TakenextFood();
    function isOver();
    function actualFood();
    function isNextFood();
}
//Klasa pomocnicza w implementacji wzorca iteratora ( korzysta z interfejsu IIterator )
class CaloriesIterator extends Model implements IIterator
{
    private $position;
    private $items;

    function __construct($items)
    {
        $this->items   = $items;
        $this->position    = -1;
    }

    public function TakenextFood()
    {
        return $this->items[++$this->position];
    }

    public function isNextFood()
    {
        return isset($this->items[$this->position + 1]);
    }

    public function isOver()
    {
        return count($this->items) == $this->position - 1;
    }

    public function actualFood()
    {
        $this->items[$this->position];
    }
}
//
