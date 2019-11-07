<?php

namespace App\Exceptions;

use Exception;

class ProductUserNotMatch extends Exception
{
     public function render()
     {
         return [
             'data'=>'You are not allowed for this product'
         ]; 
     }
}
