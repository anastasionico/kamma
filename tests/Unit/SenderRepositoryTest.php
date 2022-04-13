<?php

namespace Tests\Unit;

use App\Http\Repositories\SenderRepository;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class SenderRepositoryTest extends TestCase
{
    use RefreshDatabase;

    public function test_friend_is_in_database ()
    {
        $users = User::factory()->count(2)->make();
        $data = collect([
            'name' => $users[0]->name,
            'friend_name' => $users[1]->name,
            'friend_email' => $users[1]->email,
        ]);

        $SenderRepository = new SenderRepository();
        $SenderRepository->insert($data);

        $this->assertDatabaseCount('send_job', 1);
        $this->assertDatabaseHas('send_job', [
            'name' => $users[0]->name,
            'friend_name' => $users[1]->name,
            'friend_email' => $users[1]->email,
        ]);
    }
}
