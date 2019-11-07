<?php

namespace App\Exceptions;

use Exception;

class Reviewdelete extends Exception
{
    public function render()
    {
    	return response()->json([
            'error'=>'The Review you are Deleting does not belongs to this product'
    	]);
    }
}
