<?php

namespace App\Http\Repositories;

use Illuminate\Support\Collection;
use Illuminate\Support\Facades\DB;

class SenderRepository
{
    /**
     * @param Collection $data
     * @return bool
     */
    public function insert(Collection $data): bool
    {
        return DB::table('send_job')->insert($data->toArray());
    }
}
