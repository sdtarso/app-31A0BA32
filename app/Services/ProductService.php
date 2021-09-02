<?php

namespace App\Services;

use App\Models\{Product, ProductLog};

class ProductService extends BaseService
{

    public function __construct()
    {
        $this->entity = Product::class;
        $this->rules = [
			'pro_name' => 'required',
			'pro_sku' => 'required|unique:product,pro_sku',
			'pro_quantity' => 'integer',
		];

    }
}
