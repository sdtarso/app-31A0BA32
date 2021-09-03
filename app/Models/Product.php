<?php

namespace App\Models;

class Product extends BaseModel
{
    protected $table = 'product';
    protected $primaryKey = 'product_id';

    public function history() {

        return $this->hasMany(ProductLog::class, 'product_id', 'product_id');
    }
}
