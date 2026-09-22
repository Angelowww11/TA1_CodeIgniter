<?php

namespace App\Models;

use CodeIgniter\Model;

class CustomerModel extends Model
{
    protected $table = 'customer_accounts';
    protected $primaryKey = 'customer_id';
    protected $returnType = 'array';
    protected $useAutoIncrement = true;
    protected $allowedFields = [
        'first_name',
        'last_name',
        'email',
        'phone',
        'address',
        'account_status',
    ];
}
