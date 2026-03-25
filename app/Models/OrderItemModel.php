<?php

namespace App\Models;

use CodeIgniter\Model;

class OrderItemModel extends Model
{
    protected $table      = 'order_items';
    protected $primaryKey = 'orderedItemsID';
    protected $allowedFields    = [
        'quantity',
        'subTotal',
        'productID',
        'orderID',
    ];
}
