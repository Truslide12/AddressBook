<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Contact;
use App\Models\Address;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        factory(App\Models\Contact::class, 50)->create()
        ->each(function($contact) {
            $contact->addresses()->save(
                (factory(App\Models\Address::class)->make())
            );
    });
    }
}
