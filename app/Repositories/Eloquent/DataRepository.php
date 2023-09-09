<?php

namespace App\Repositories\Eloquent;

use App\Models\Data;
use App\Repositories\Interfaces\DataInterface;

class DataRepository extends EloquentRepository implements DataInterface
{
    /**
     * @param Data $data
     */
    public function __construct(Data $data)
    {
        $this->model = $data;
    }

}
