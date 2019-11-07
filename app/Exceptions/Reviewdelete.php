<?php

namespace App\Exceptions;

use Exception;

class Reviewdelete extends Exception
{
    public function render()
    {
    	return response()->json([
            'error'=>'This Review  does not belongs to this product'
    	]);
    }
}
