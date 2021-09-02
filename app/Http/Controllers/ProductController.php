<?php

namespace App\Http\Controllers;

use App\Services\ProductService;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class ProductController extends Controller {

    public function create(Request $request) {

        try {

            $ps = new ProductService;
            $data = $request->all();
            
            $rules = $ps->getRulesCreate();
            $validator = Validator::make($data, $rules);
        
            if ($validator->fails()) {
                return response()->json([
                    'success' => false,
                    'product' => $validator->errors()
                ], 500);
            }
            
            return response()->json([
                'success' => true,
                'product' => $ps->storeData($data)
            ]);
        } catch(Exception $e) {

            return response()->json([
                'success' => false,
                'exception' => [
                    'message' => $e->getMessage(),
                    'code' => $e->getCode(),
                    'file' => $e->getFile(),
                    'line' => $e->getLine(),
                ]
            ], $e->getCode() ?? 500);
        }
    }
}