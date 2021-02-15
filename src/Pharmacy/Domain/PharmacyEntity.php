<?php

namespace src\Pharmacy\Domain;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class PharmacyEntity extends Model
{
    use HasFactory;
    use SoftDeletes;
    
    protected $table = 'pharmacies';
}
