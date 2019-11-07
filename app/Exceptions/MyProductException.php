<?php

namespace App\Exceptions;

use Exception;

class MyProductException extends Exception
{
    public function render()
    {
    	return response()->json([
            'error'=>'You are Not allowed to update this Product . This Product is not created by You.'
    	]);
    }
}
