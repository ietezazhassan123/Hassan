<?php

namespace App\Exceptions;

use Exception;

class CheckUser4Deletion extends Exception
{
    public function render()
    {
    	return response()->json([
            'error'=>'Sorry Dear ! You are not allowed to delete this Product. This is not your Product'
    	]);
    }
}
