<?php

namespace src\Client\Domain;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class ClientPointEntity extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $table = 'client_point';

    protected $primaryKey = 'id';

    public function client()
    {
        return $this->belongsTo(ClientEntity::class, 'client_id');
    }
}
