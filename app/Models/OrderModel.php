<?php

namespace App\Models;

use CodeIgniter\Model;

class OrderModel extends Model
{
    protected $table      = 'orders';
    protected $primaryKey = 'orderID';
    protected $allowedFields    = [

        'userID',
        'addressID',
        'totalAmount',
        'orderDate',
        'status',

    ];
}
