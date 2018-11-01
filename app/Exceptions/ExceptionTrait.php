<?php

namespace App\Exceptions;

use Illuminate\Database\Eloquent\ModelNotFoundException;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

Trait ExceptionTrait{

    public function apiException($request, $exception){
        if($this->isModel($exception)){
            return $this->modelResponse($exception);
        }
        if($this->isHttp($exception)){
            return $this->httpResponse($exception);
        }

        return parent::render($request, $exception);
    }

    protected function isModel($exception){
        return $exception instanceof ModelNotFoundException;
    }
    protected function isHttp($exception){
        return $exception instanceof NotFoundHttpException;
    }
    protected function modelResponse($exception){
        return response()->json([
            'errors' => "Product Model Not Found"
        ], 404);
    }
    protected function httpResponse($exception){
        return response()->json([
            'errors' => "Incorrect Route"
        ], 404);
    }
}