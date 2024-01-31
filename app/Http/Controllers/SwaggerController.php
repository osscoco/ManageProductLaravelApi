<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Artisan;

class SwaggerController extends Controller
{
    /**
     * Swagger Generate
     * 
     * @return JSONResponse - Json
     * 
     * @OA\Get(
     *     path="/api/swagger-generate",
     *     description="Swagger Generate",
     *     tags={"SWAGGER"},
     *     security={{"bearerAuth": {}}},
     * 
     *     @OA\Response(response="200", description="Regénérer Swagger")
     * )
     */
    public function generate()
    {
        Artisan::call('l5-swagger:generate');

        return $this->sendResponse([], 'Swagger regénéré avec succès');
    }
}
