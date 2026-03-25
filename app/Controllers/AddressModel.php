<?php

namespace App\Models;

use CodeIgniter\Model;

class AddressModel extends Model
{
    protected $table = 'user_address';
    protected $primaryKey = 'addressID';
    protected $useAutoIncrement = true;
    protected $returnType = 'array';

    protected $allowedFields = [
        'userID',
        'street',
        'city',
        'state',
        'zip'
    ];
}