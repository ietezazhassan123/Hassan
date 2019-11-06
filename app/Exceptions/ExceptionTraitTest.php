<?php

namespace App\Exceptions;


use Exception;
use Symfony\Component\HttpFoundation\Response;


use Illuminate\Database\Eloquent\ModelNotFoundException;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

trait ExceptionTraitTest
{
	  public function ExcpetionByIetezazKhattak($request, Exception $exception)
	  {
            if($this->isNotRoute($exception))
            {
            	return $this->RouteException($exception);
            }

            if($this->isNotModel($exception))
            {
            	return $this->ModelException($exception);
            }
	  }


      
        public function isNotRoute($exception)
        {
            return $exception instanceof NotFoundHttpException;
        }

        public function isNotModel($exception)
        {
        	return  $exception instanceof ModelNotFoundException;
        }
            
        public function RouteException($exception)
        {
            return response()->json([
                  'error'=>'This is an Incorrect Route'
            ],Response::HTTP_NOT_FOUND);
        }

        public function ModelException($exception)
        {
        	return response()->json([
                   'error'=>'This Model is not Present' 
        	],Response::HTTP_NOT_FOUND);
        }
	 
}