<?php

namespace App\Http\Controllers;

use App\Services\ProductService;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class ProductController extends Controller {

    public function list(Request $request)
    {

        try {

            $ps = new ProductService;
            $items = $ps->paginate($request->get('itemsPerPage') ?? 20)->items();

            return response()->json([
                'success' => true,
                'items' => $items
            ]);
        } catch (Exception $e) {

            return response()->json([
                'success' => false,
                'exception' => [
                    'message' => $e->getMessage(),
                    'code' => $e->getCode(),
                    'file' => $e->getFile(),
                    'line' => $e->getLine(),
                ]
            ], $e->getCode() ?: 500);
        }
    }


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
        } catch (Exception $e) {

            return response()->json([
                'success' => false,
                'exception' => [
                    'message' => $e->getMessage(),
                    'code' => $e->getCode(),
                    'file' => $e->getFile(),
                    'line' => $e->getLine(),
                ]
            ], $e->getCode() ?: 500);
        }
    }

    public function update(Request $request) {

        try {

            $ps = new ProductService;
            $data = $request->all();

            $rules = $ps->getRulesUpdate();
            $validator = Validator::make($data, $rules);

            if ($validator->fails()) {
                return response()->json([
                    'success' => false,
                    'product' => $validator->errors()
                ], 500);
            }

            return response()->json([
                'success' => $ps->patchQuantity($data)
            ]);
        } catch (Exception $e) {

            return response()->json([
                'success' => false,
                'exception' => [
                    'message' => $e->getMessage(),
                    'code' => $e->getCode(),
                    'file' => $e->getFile(),
                    'line' => $e->getLine(),
                ]
            ], $e->getCode() ?: 500);
        }
    }

    public function history(Request $request, $sku)
    {

        try {

            $ps = new ProductService;
            $items = $ps->getProductHistory($sku, $request->get('itemsPerPage') ?? 20)->items();

            return response()->json([
                'success' => true,
                'items' => $items
            ]);
        } catch (Exception $e) {

            return response()->json([
                'success' => false,
                'exception' => [
                    'message' => $e->getMessage(),
                    'code' => $e->getCode(),
                    'file' => $e->getFile(),
                    'line' => $e->getLine(),
                ]
            ], $e->getCode() ?: 500);
        }
    }
}
