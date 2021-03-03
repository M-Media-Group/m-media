<?php

namespace Tests\Unit;

use Tests\TestCase;

class UserTest extends TestCase
{

    public function testSeeNotificationsTest()
    {
        $response = $this->actingAs(\App\User::firstOrFail())->get('/notifications');
        $response->assertStatus(200);
        $response->assertSeeText(config('app.name'));
    }

    public function testSeeOwnPage()
    {
        $user = \App\User::firstOrFail();
        $response = $this->actingAs($user)->get('/users/' . $user->id);
        $response->assertStatus(200);
        $response->assertSeeText(config('app.name'));
    }

    public function testSeeCreateSepaBillingPage()
    {
        $user = \App\User::firstOrFail();
        $response = $this->actingAs($user)->get('/users/' . $user->id . '/billing/payment-methods/sepas/create');
        $response->assertStatus(200);
        $response->assertSeeText(config('app.name'));
    }

    public function testNotSeeSingleUserTest()
    {
        $user = \App\User::firstOrFail();
        $response = $this->get('/users/' . $user->id);
        $response->assertStatus(302);
    }

    public function testSeeAllfilesTest()
    {
        $user = \App\User::firstOrFail();
        $response = $this->actingAs($user);

        $response = $this->get('/files?user=' . $user->id);

        $response->assertStatus(200);
        $response->assertSeeText(config('app.name'));
    }

}
