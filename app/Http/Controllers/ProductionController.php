<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Artisan;

class ProductionController extends Controller
{
    /**
     * Production Step 3
     * 
     * @return JSONResponse - Json
     * 
     * @OA\Get(
     *     path="/api/production-step-3",
     *     description="Production Step 3",
     *     tags={"PRODUCTION"},
     *     security={{"bearerAuth": {}}},
     * 
     *     @OA\Response(response="200", description="Etape 3 Production terminée")
     * )
     */
    public function stepThree()
    {
        Artisan::call('config:clear');
        Artisan::call('cache:clear');
        Artisan::call('optimize:clear');

        return $this->sendResponse([], 'Etape 3 Production terminée');
    }

    /**
     * Production Step 7
     * 
     * @return JSONResponse - Json
     * 
     * @OA\Get(
     *     path="/api/production-step-7",
     *     description="Production Step 7",
     *     tags={"PRODUCTION"},
     *     security={{"bearerAuth": {}}},
     * 
     *     @OA\Response(response="200", description="Etape 7 Production terminée")
     * )
     */
    public function stepSeven()
    {
        Artisan::call('l5-swagger:generate');
        Artisan::call('config:cache');
        Artisan::call('event:cache');
        Artisan::call('route:cache');
        Artisan::call('view:cache');

        return $this->sendResponse([], 'Etape 7 Production terminée');
    }
}
