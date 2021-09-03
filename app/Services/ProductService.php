<?php

namespace App\Services;

use App\Models\{Product, ProductLog};
use Exception;
use Illuminate\Support\Facades\DB;

class ProductService extends BaseService
{

    public function __construct()
    {
        $this->entity = Product::class;
        $this->rules = [
			'pro_name' => 'required',
			'pro_sku' => 'required|unique:product,pro_sku',
			'pro_quantity' => 'required|integer',
		];
        $this->rulesUpdate = [
            'pro_name' => 'prohibited',
            'pro_sku' => 'required',
            'pro_quantity' => 'required|integer',
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

    private function registerProductUpdate($data)
    {
        $product = $this->entity::where('pro_sku', $data['pro_sku'])->first();
        
        if(is_null($product))
            throw new Exception("There is not product with such SKU in our database", 400);
        
        $pl = new ProductLog([
            'product_id' => $product->product_id,
            'prl_quantity' => $data['pro_quantity']
        ]);
        $pl->save();
    }

    public function patchQuantity($data) {

        $this->registerProductUpdate($data);

        return $this->entity::where('pro_sku', $data['pro_sku'])
            ->increment('pro_quantity', $data['pro_quantity']);
    }
}
