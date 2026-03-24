<?php

namespace App\Models;
use CodeIgniter\Model;

class CatalogModel extends Model
{
    protected $table      = 'product';
    protected $primaryKey = 'productID';
    protected $useAutoIncrement = true;
    protected $returnType       = 'array';
    protected $allowedFields    = [
        'productID',
        'productSize',
        'productImage',
        'productName',
        'productStock',
        'productPrice',
        'productCategory',
        'productType',
        'productDescription',
        'productMaterial',
        'productDimension',
        'productWeightCapacity',
    ];
}
