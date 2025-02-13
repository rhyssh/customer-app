<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Testing\Fluent\Concerns\Has;

class Customer extends Model
{
    //
    use HasFactory, SoftDeletes;
    protected $fillable = ['image', 'first_name', 'last_name', 'email', 'phone', 'about', 'bank_account_number'];
}
