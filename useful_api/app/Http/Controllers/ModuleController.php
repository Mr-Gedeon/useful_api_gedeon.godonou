<?php

namespace App\Http\Controllers;

use App\Models\Module;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class ModuleController extends Controller
{
    
    public function show(): JsonResponse {

        $modules = Module::all();
        return response()->json([$modules]);
    }
}
