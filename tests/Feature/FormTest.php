<?php


namespace Tests\Feature;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class FormTest extends TestCase
{
    use RefreshDatabase;

    public function test_api_form_works () {
        $users = User::factory()->count(2)->make();

        $data = collect([
            'name' => $users[0]->name,
            'friend_name' => $users[1]->name,
            'friend_email' => $users[1]->email,
        ]);

        $response = $this->postJson('/api/sendrequest', $data->toArray());
        $response
            ->assertStatus(200)
            ->assertJson([
                'message' => 'Friend saved and Email sent',
                'success' => true,
            ]);
    }

    public function test_api_form_does_not_work_with_longer_name () {
        $users = User::factory()->count(2)->make();

        $data = collect([
            'name' => 'thisIsAVeryLongNamethisIsAVeryLongNamethisIsAVeryLongNamethisIsAVeryLongNamethisIsAVeryLongNamethisIsAVeryLongNamethisIsAVeryLongNamethisIsAVeryLongNamethisIsAVeryLongNamethisIsAVeryLongNamethisIsAVeryLongNamethisIsAVeryLongNamethisIsAVeryLongNamethisIsAVeryLongNamethisIsAVeryLongNamethisIsAVeryLongNamethisIsAVeryLongNamethisIsAVeryLongNamethisIsAVeryLongNamethisIsAVeryLongNamethisIsAVeryLongNamethisIsAVeryLongNamethisIsAVeryLongNamethisIsAVeryLongNamethisIsAVeryLongNamethisIsAVeryLongNamethisIsAVeryLongNamethisIsAVeryLongNamethisIsAVeryLongNamethisIsAVeryLongNamethisIsAVeryLongNamethisIsAVeryLongNamethisIsAVeryLongNamethisIsAVeryLongNamethisIsAVeryLongNamethisIsAVeryLongNamethisIsAVeryLongNamethisIsAVeryLongNamethisIsAVeryLongNamethisIsAVeryLongNamethisIsAVeryLongNamethisIsAVeryLongNamethisIsAVeryLongNamethisIsAVeryLongNamethisIsAVeryLongNamethisIsAVeryLongNamethisIsAVeryLongNamethisIsAVeryLongNamethisIsAVeryLongNamethisIsAVeryLongNamethisIsAVeryLongNamethisIsAVeryLongNamethisIsAVeryLongNamethisIsAVeryLongNamethisIsAVeryLongNamethisIsAVeryLongNamethisIsAVeryLongNamethisIsAVeryLongNamethisIsAVeryLongNamethisIsAVeryLongNamethisIsAVeryLongNamethisIsAVeryLongNamethisIsAVeryLongNamethisIsAVeryLongNamethisIsAVeryLongNamethisIsAVeryLongNamethisIsAVeryLongNamethisIsAVeryLongNamethisIsAVeryLongNamethisIsAVeryLongNamethisIsAVeryLongNamethisIsAVeryLongNamethisIsAVeryLongNamethisIsAVeryLongNamethisIsAVeryLongNamethisIsAVeryLongNamethisIsAVeryLongNamethisIsAVeryLongNamethisIsAVeryLongNamethisIsAVeryLongNamethisIsAVeryLongNamethisIsAVeryLongNamethisIsAVeryLongNamethisIsAVeryLongNamethisIsAVeryLongNamethisIsAVeryLongNamethisIsAVeryLongNamethisIsAVeryLongName',
            'friend_name' => $users[1]->name,
            'friend_email' => $users[1]->email,
        ]);

        $response = $this->postJson('/api/sendrequest', $data->toArray());
        $response
            ->assertStatus(422)
            ->assertJson([
                "message" => "The given data was invalid.",
                "errors" => [
                    "name" => [
                        "The name must not be greater than 255 characters."
                    ]
                ]
            ]);
    }

    public function test_api_form_does_not_work_with_invalid_email () {
        $users = User::factory()->count(2)->make();

        $data = collect([
            'name' => $users[0]->name,
            'friend_name' => $users[1]->name,
            'friend_email' => 'email',
        ]);

        $response = $this->postJson('/api/sendrequest', $data->toArray());
        $response
            ->assertStatus(422)
            ->assertJson([
             "message" => "The given data was invalid.",
             "errors" => [
                 "friend_email" => [
                     "The friend email must be a valid email address."
                 ]
             ]
         ]);
    }
}
