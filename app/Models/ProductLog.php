<?php

namespace App\Models;

class ProductLog extends BaseModel
{
    protected $table = 'product_log';
    protected $primaryKey = 'product_log_id';

    public function product() {

        return $this->belongsTo(Product::class, 'product_id', 'product_id');
    }
}
