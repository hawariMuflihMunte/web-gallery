<?php

namespace Tests\Browser;

use App\Models\User;
use Illuminate\Foundation\Testing\DatabaseTruncation;
use Laravel\Dusk\Browser;
use Tests\DuskTestCase;

class LoginTest extends DuskTestCase
{
    use DatabaseTruncation;

    public function testUserCredentials(): void
    {
        $this->migrateFreshUsing();
        $this->seed();

        $user = User::first();

        $this->browse(function (Browser $browser) use ($user) {
            $browser->visit('/')
                    ->assertPathIs('/login')
                    ->type('#username', $user->Username)
                    ->type('#password', '12345678')
                    ->click('button[type="submit"]')
                    ->assertPathIs('/gallery');
        });
    }
}
