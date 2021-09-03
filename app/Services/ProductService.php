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

    public function paginate($itemsPerPage = 20)
    {
        $query = $this->entity::query();
        $itemsPerPage = min($itemsPerPage, 100);

        return $query
            ->orderBy('created_at', 'DESC')
            ->select([
                'product_id',
                'pro_name',
                'pro_sku',
                'pro_quantity',
                'created_at'
            ])->paginate($itemsPerPage);
    }
}
