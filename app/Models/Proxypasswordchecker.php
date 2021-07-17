<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Model;
use App\Models\ProxyFirstStatement;

class Proxypasswordchecker extends Model implements IProxy
{
    private $proxyFirstStatement;

    public function __construct(ProxyFirstStatement $proxyFirstStatement)
    {
        $this->proxyFirstStatement = $proxyFirstStatement;
    }

    public function checkpass($password=NULL)
    {
        if ($this->checkSpecialChars($password)) {
            // Pełnomocnik pobiera podmiot ProxyFirstStatement oraz ustawia jego instancję (dostęp do metody checkpass).
            // Żądanie checkpass klasy Proxypasswordchecker nadpisuję implementację podmiotu ProxyFirstStatement oraz dodaje 2 warunek sprawdzający (sprawdza znaki specjalne - metoda checkSpeciaChars).
            //Jeśli wykona się poprawnie, to wtedy wykonuje się checkpass z klasy ProxyFirstStatement (sprawdzanie długości hasła >= 6 )
            $this->proxyFirstStatement->checkpass($password);
        }
        else
            echo redirect('/bad_password?specialchar=1');
    }
    private function checkSpecialChars($password=NULL)
    {
        if (str_contains($password,'!') || str_contains($password,'@') || str_contains($password,'?'))
            return true;
        else
            return false;
    }
}
