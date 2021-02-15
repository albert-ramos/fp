<?php

namespace src\Client\Domain;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class ClientEntity extends Model
{
    use HasFactory;
    use SoftDeletes;
    
    protected $table = 'clients';

    protected $primaryKey = 'id';

    public function points()
    {
        return $this->hasMany(ClientPointEntity::class, 'point_id');
    }
}
