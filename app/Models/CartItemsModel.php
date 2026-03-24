<?php

namespace App\Models;

use CodeIgniter\Model;

class CartItemModel extends Model
{
    protected $table      = 'cart_items';
    protected $primaryKey = 'cartItemID';
    protected $allowedFields    = [
        'cartID',
        'productID',
        'quantity'
    ];
}