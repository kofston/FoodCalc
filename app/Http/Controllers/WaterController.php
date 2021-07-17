<?php
namespace App\Http\Controllers;

use App\Main;
use Faker\Extension\Helper;
use Illuminate\Database\Eloquent\Model;
use Request;
use DB;
use Singletondatabase;
use App\Models\Ownhelper;
use App\Models;
class WaterController extends Controller
{
    //Liczenie nadownienia
    public function countWater()
    {
        if(isset($_POST['weight']) && isset($_POST['sex']) && isset($_POST['water']))
        {
            $weight = $_POST['weight'];
            $sex = $_POST['sex'];
            $water = $_POST['water'];

            $need_water = $weight*35;
            if($sex=="man")
                $need_water += 150;
            else
                $need_water -= 150;

            $cup = $need_water / 250;
            $cup = number_format($cup,2,',','.');

            $cupDrink = $water / 250;
            $cupDrink = number_format($cupDrink,2,',','.');

            return redirect('/?shouldDrink='.$need_water.'&drink='.$water.'&cupNeed='.$cup.'&cupDrink='.$cupDrink.'');
        }
    }
    public function drink_email($should='')
    {
        if(isset($_POST['email']))
        {
            $to      = $_POST['email'];
            $subject = 'Pij więcej wody! - FoodCalc ';
            $message = 'Witaj! Pamiętaj o piciu większej ilości wody, powinieneś wypić łącznie: '.$should.' ml.';
            mail($to, $subject, $message);
            return redirect('/');
        }
    }
    //
}
