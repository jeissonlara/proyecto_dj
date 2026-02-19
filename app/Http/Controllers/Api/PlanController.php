<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Plan;

class PlanController extends Controller
{
    public function index()
    {
        $planes = Plan::all();
        
        return response()->json([
            'success' => true,
            'message' => 'Planes obtenidos correctamente',
            'data' => $planes
        ], 200);
    }
}
