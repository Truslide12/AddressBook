<?php

use Illuminate\Database\Seeder;
use App\Models\Contact;
use App\Models\Address;
class ContactSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(App\Contact::class, 50)->create()
            ->each(function($contact) {
                $contact->addresses()->save(
                    (factory(App\Address::class)->make())
                );
        });
    }
}
