<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\TransactionItem;

class Product extends Model
{
    protected $guarded = [];

    public function transactionItems()
    {
        return $this->morphMany(TransactionItem::class, 'payable');
    }
}
