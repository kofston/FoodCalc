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

class LoginController extends Controller
{
//    Singleton (połączenie z bazą danych)
    public $db = "";
    public function __construct()
    {
        $this->db = Models\Singletondatabase::getConnectionWithDatabase();
    }
//

    // Logowanie i rejestracja

    public function register()
    {
        if(isset($_POST['login']) && isset($_POST['password']))
        {
            $login = $_POST['login'];
            $password = $_POST['password'];
            $insert_data = array('user_login'=>$login,'user_password'=>sha1($password));
            $QUERY = $this->db->query("SELECT * FROM is_user WHERE user_login='$login'");
            $QUERY = $QUERY->fetch_assoc();

            if(is_array($QUERY))
            {
                //rejestracja user istnieje
                return redirect('/?exist=1');
            }
            else
            {
                $pass = sha1($password);
                $QUERY2 = $this->db->query("INSERT INTO is_user (user_id,user_login,user_password) VALUES (NULL,$login,$pass)");
                $QUERY2 = $QUERY2->fetch_assoc();
                return redirect('/?ok=1');
            }
        }
        else
            return redirect('/');
    }

    public function login()
    {
        if(isset($_POST['login']) && isset($_POST['password']))
        {
            $login = $_POST['login'];
            $password = sha1($_POST['password']);
            $insert_data = array('user_login'=>$login,'user_password'=>$password);
            $QUERY = $this->db->query("SELECT * FROM is_user WHERE user_login='$login' AND user_password='$password' ");
            $QUERY = $QUERY->fetch_assoc();
            if(is_array($QUERY))
            {
                //logowanie
                $_SESSION['login'] = array('id'=>$QUERY['user_id'],'login'=>$QUERY['user_login']);
                return redirect('/?login_ok');
            }
            else
            {
                //do głównej
                $_SESSION['login'] = NULL;
                return redirect('/?baddata');
            }
        }
        else
            return redirect('/');
    }

    public function logout(){
        if(isset($_SESSION['login']))
            $_SESSION['login'] = NULL;
        return redirect('/');
    }

    //
}
