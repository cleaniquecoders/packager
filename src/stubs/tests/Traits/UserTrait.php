<?php

namespace DummyNamespace\Tests\Traits;

trait UserTrait
{
    public $user;

    public function getAUser()
    {
        return $this->user = \DB::table('users')->first();
    }

    public function seedUsers()
    {
        $now = \Carbon\Carbon::now();
        \DB::table('users')->insert([
            'name'       => 'PHPUnit',
            'email'      => 'hello@phpunit.com',
            'password'   => \Hash::make('456'),
            'created_at' => $now,
            'updated_at' => $now,
        ]);

        \DB::table('users')->insert([
            'name'       => 'PHPUnit',
            'email'      => 'hi@phpunit.com',
            'password'   => \Hash::make('456'),
            'created_at' => $now,
            'updated_at' => $now,
        ]);
    }

    public function truncateUsersTable()
    {
        \DB::table('users')->truncate();
    }

    public function reseedUsers()
    {
        $this->truncateUsersTable();
        $this->seedUsers();
        $this->getAUser();
    }

    /** @test */
    public function it_has_users()
    {
        $this->truncateUsersTable();
        $this->seedUsers();

        $user = \DB::table('users')->where('id', '=', 2)->first();
        $this->assertEquals('hi@phpunit.com', $user->email);
        $this->assertTrue(\Hash::check('456', $user->password));

        $user = \DB::table('users')->where('id', '=', 1)->first();
        $this->assertEquals('hello@phpunit.com', $user->email);
        $this->assertTrue(\Hash::check('456', $user->password));
    }
}
