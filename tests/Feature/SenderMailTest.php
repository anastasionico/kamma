<?php

namespace Tests\Feature;

use App\Mail\SenderMail;
use App\Models\User;
use Tests\TestCase;

class SenderMailTest extends TestCase
{
    public function test_mailable_content()
    {
        $users = User::factory()->count(2)->make();
        $data = collect([
            'name' => $users[0]->name,
            'friend_name' => $users[1]->name,
            'friend_email' => $users[1]->email,
        ]);

        $mailable = New SenderMail($data);

        $mailable->assertSeeInHtml($data->get('friend_name'));
        $mailable->assertSeeInHtml('Here is a great deal');
        $mailable->assertSeeInText($data->get('friend_name'));
        $mailable->assertSeeInText($data->get('name'));
        $mailable->assertSeeInText('Kamma');
    }

}
