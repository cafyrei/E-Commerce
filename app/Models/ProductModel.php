<?php

namespace App\Models;

use CodeIgniter\Model;

class ProductModel extends Model {

    protected $table      = 'product';
    protected $primaryKey = 'productID';
    protected $useAutoIncrement = true;
    protected $returnType       = 'array';
    protected $allowedFields    = [
        'productImage',
        'productName',
        'productStock',
        'productPrice',
        'productDescription',
        'productMaterial',
        'productDimension',
        'productWeightCapacity'
    ];
}