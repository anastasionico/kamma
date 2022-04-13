<?php

namespace App\Events;

use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Collection;

class FriendRegistered
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    public $data;

    /**
     * FriendRegistered constructor.
     * @param Collection $data
     */
    public function __construct(Collection $data)
    {
        $this->data = $data;
    }
}
