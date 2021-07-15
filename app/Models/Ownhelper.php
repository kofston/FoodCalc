<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Model;

class Ownhelper extends Model
{
    public function pre($string = '') {
        echo '<pre>' . print_r($string, TRUE) . '</pre>';
    }
}
