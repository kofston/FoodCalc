<?php

namespace App\Http\Controllers;

use App\Main;
use Faker\Extension\Helper;
use Illuminate\Database\Eloquent\Model;
use Request;
use DB;
use Singletondatabase;
use App\Models\Ownhelper;
use CaloriesIterator;
use Prototype;
use App\Models;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\WaterController;
use App\Models\NewprodPrototype;


class MainController extends Controller
{
    public function index()
    {
        $food_array = array(
            $this->generateRandomStringWithCalories(66)=>"Bób",
            $this->generateRandomStringWithCalories(27)=>"Brokuły",
            $this->generateRandomStringWithCalories(30)=>"Cebula",
            $this->generateRandomStringWithCalories(67)=>"Chrzan",
            $this->generateRandomStringWithCalories(13)=>"Cukinia",
            $this->generateRandomStringWithCalories(146)=>"Czosnek",
            $this->generateRandomStringWithCalories(28)=>"Dynia",
            $this->generateRandomStringWithCalories(288)=>"Fasola biała",
            $this->generateRandomStringWithCalories(293)=>"Groch",
            $this->generateRandomStringWithCalories(22)=>"Kalafior",
            $this->generateRandomStringWithCalories(29)=>"Kapusta biała",
            $this->generateRandomStringWithCalories(25)=>"Koper,",
            $this->generateRandomStringWithCalories(31)=>"Marchew",
            $this->generateRandomStringWithCalories(15)=>"Ogórek",
            $this->generateRandomStringWithCalories(35)=>"Papryka czerwona",
            $this->generateRandomStringWithCalories(35)=>"Pomidor",
            $this->generateRandomStringWithCalories(15)=>"Rzeżucha",
            $this->generateRandomStringWithCalories(20)=>"Sałata",
            $this->generateRandomStringWithCalories(25)=>"Szpinak",
            $this->generateRandomStringWithCalories(76)=>"Ziemniaki",
            $this->generateRandomStringWithCalories(213)=>"Chleb razowy",
            $this->generateRandomStringWithCalories(252)=>"Bułka grahamka",
            $this->generateRandomStringWithCalories(257)=>"Chelb biały",
            $this->generateRandomStringWithCalories(390)=>"Wafle ryżowe",
            $this->generateRandomStringWithCalories(24)=>"Melon",
            $this->generateRandomStringWithCalories(47)=>"Morele",
            $this->generateRandomStringWithCalories(52)=>"Jabłko",
            $this->generateRandomStringWithCalories(54)=>"Ananas",
            $this->generateRandomStringWithCalories(54)=>"Kiwi",
            $this->generateRandomStringWithCalories(53)=>"Granat",
            $this->generateRandomStringWithCalories(160)=>"Awokado",
            $this->generateRandomStringWithCalories(155)=>"Jajko",
            $this->generateRandomStringWithCalories(57)=>"Mleko",
            $this->generateRandomStringWithCalories(51)=>"Kefir",
            $this->generateRandomStringWithCalories(121)=>"Twaróg",
            $this->generateRandomStringWithCalories(357)=>"Ser żółty",
            $this->generateRandomStringWithCalories(900)=>"Olej",
            $this->generateRandomStringWithCalories(721)=>"Masło",
            $this->generateRandomStringWithCalories(84)=>"Filet z indyka",
            $this->generateRandomStringWithCalories(99)=>"Pierś z kurczaka",
            $this->generateRandomStringWithCalories(268)=>"Karkówka",
            $this->generateRandomStringWithCalories(480)=>"Boczek",
            $this->generateRandomStringWithCalories(100)=>"Ryba",
            $this->generateRandomStringWithCalories(405)=>"Salami",
            $this->generateRandomStringWithCalories(70)=>"Herbatniki",
            $this->generateRandomStringWithCalories(220)=>"Wafelek",
            $this->generateRandomStringWithCalories(530)=>"Czekolada",
            $this->generateRandomStringWithCalories(380)=>"Drożdżówka",
            $this->generateRandomStringWithCalories(350)=>"Makowiec",
            );

        //Dodanie tymczasowych, wcześniej dodanyc produktów
        if(!empty($_SESSION['PROD_ARRAY']))
            foreach ($_SESSION['PROD_ARRAY'] as $newProductInsert_KEY =>$newProductInsert_VAL)
            {
                $food_array[$newProductInsert_KEY] = $newProductInsert_VAL;
            }

        return view("header").view("login",['food'=>$food_array]).view("footer");
    }

    //Generowanie losowego hashu do array'a z produktami
    public function generateRandomStringWithCalories($calories = 0) {
        return substr(str_shuffle(str_repeat($x='0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ', ceil(8/strlen($x)) )),1,8)."_".$calories;
    }

    public function pre($string = '')
    {
        echo '<pre>' . print_r($string, TRUE) . '</pre>';
    }

    //Nowy produkt (przygotowanie do wzorca Prototyp)
    public function newprodadd()
    {
        $kcalnewprod = $_POST['kcalnewprod'];
        $namenewprod = $_POST['namenewprod'];

        //Tworze instancje obiektu klasy NewprodPrototype (dodawania nowego produktu do sesji), i dodaje nowy produkt (pierwszy)
        $NewProductObject = new NewprodPrototype($namenewprod[0],$kcalnewprod);
        $NewProductObject->setNameAndKcalToSession();


        //Sprawdzam czy jest ich więcej ( wtedy skopiuje produkt używając Prototypu)
        if(count($namenewprod)>1)
        {
            //jeśli tak usuń pierwszy element (dodany już) i za pomocą prototypu dodawaj następne
            array_shift($namenewprod);

            foreach ($namenewprod as $namenewPRD)
            {
                $newProduct_NewObject = clone $NewProductObject;
                //kopiuje obiekt i do skopiowanego obiektu zmieniam tylko nazwę ( bo kalorie pozostawiam takie same )
                $newProduct_NewObject->setNameAndKcalToSession($namenewPRD);
            }
        }

//        return redirect('/');
        //
    }
    //


    //Liczenie kalorii
    public function countCalories()
    {
        //Nazwa posiłku
        $FoodCal = $_POST['call'];
        $Portion = $_POST['portion'];

        $Sex = $_POST['sex'];
        $Age = $_POST['age'];
        $Weight = $_POST['weight'];
        $Height = $_POST['height'];

        //wzór Harrisa-Benedicta.
        if($Sex == 'woman')
        {
           $NeedCalories = 655 + (9.6 * $Weight) + (1.8 * $Height) - (4.7 * $Age);
        }
        else
        {
            $NeedCalories = 66 + (13.7 * $Weight) + (5 * $Height) - (6.8 * $Age);
        }

        //Implementacja iteratora (iterator działa "po arrayu", dopóki elementy array'a się nie skończą.
        $iterator = new Models\CaloriesIterator($FoodCal);
        $AllCalories = 0;
        $i = 0;
        //Używam własnego iteratora
        while($iterator->isNextFood())
        {
            $Calorie = $iterator->TakenextFood();
            //Kalorie produktu razy porcja (pozbywam się w kaloriach hashu z klucza tablicy)
            $AllCalories+=explode("_",$Calorie)[1]*$Portion[$i];
            $i++;
        }
        //

        return redirect('/?eat='.$AllCalories.'&shouldEat='.$NeedCalories.'');
    }
    //


}
