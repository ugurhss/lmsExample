<?php

use App\Http\Controllers\Api\QuizController;
use Illuminate\Support\Facades\Route;

//resource de kullanmak istemedigimiz kısımları except ile belirtebiliriz mesela create ve edit gibi 
//yada sadece belirli fonksiyonları kullanmak istersek only ile belirtebiliriz mesela index ve show gibi
Route::apiResource('quizzes', QuizController::class);
