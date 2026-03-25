<?php

namespace App\Models;

use CodeIgniter\Model;

class OrderModel extends Model
{
    protected $table = 'orders';
    protected $primaryKey = 'orderID';
    protected $useAutoIncrement = true;
    protected $returnType = 'array';

    protected $allowedFields = [
        'userID',
        'addressID',
        'totalAmount',
        'shippingMethod',
        'shippingCost',
        'paymentMethod',
        'status'
    ];
}