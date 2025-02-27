<?php

namespace App\Repositories\Local\Concretes\Dispensers;

use App\Repositories\Local\Contracts\Dispensers\DispenserRepositoryInterface;
use App\Traits\HasResponse;

class DispenserRepository implements DispenserRepositoryInterface
{
    use HasResponse;

    public function getDispensers($request)
    {
        //
    }

    public function getDispenser($id)
    {
        //
    }

    public function createDispenser($data)
    {
        //
    }

    public function updateDispenser($id, $data)
    {
        //
    }

    public function deleteDispenser($id)
    {
        //
    }
}
