<?php

namespace src\Shared\Domain;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Collection;
use src\Shared\Domain\EloquentRepositoryInterface;

class BaseRepository implements EloquentRepositoryInterface
{
    public function __construct(Model $model)
    {
        $this->model = $model;
    }
    
}
