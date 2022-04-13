<?php

namespace App\Http\Services;

use App\Events\FriendRegistered;
use App\Http\Processors\MailerProcessor;
use App\Http\Repositories\SenderRepository;
use Illuminate\Support\Collection;
use Exception;

class SenderService
{
    public $repository;

    /**
     * SenderService constructor.
     * @param SenderRepository $repository
     */
    public function __construct(SenderRepository $repository)
    {
        $this->repository = $repository;
    }

    /**
     * @param Collection $data
     * @return bool
     * @throws Exception
     */
    public function handle(Collection $data): bool
    {
        try {
            $this->repository->insert($data);
        } catch (Exception $exception) {
            throw new Exception('Can not save friend');
        }

        FriendRegistered::dispatch($data);

        return true;
    }
}
