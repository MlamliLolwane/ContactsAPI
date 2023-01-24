<?php

namespace Tests\Feature;

use Tests\TestCase;
use App\Models\Contact;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class GetContactTest extends TestCase
{
    use RefreshDatabase;

    //Test that all contacts can be retrieved from the database
    public function test_all_contacts_can_be_retrieved_from_the_database()
    {
        //Store 10 contacts on the database
        Contact::factory(10)->create();

        //Fetch the newly created contacts from the database
        $contacts = $this->getJson('/api/contacts/index');

        //Assert that there is a total of 10 contacts in the database
        $this->assertCount(10, Contact::all());
    }

    //Test that only one contact with the provided id can be retrieved from the database
    public function test_that_only_the_contact_with_the_provided_id_can_be_retrieved_from_the_database()
    {
        //Store 10 contacts on the database
        Contact::factory(10)->create();

        //Create the 11th contact with custom data
        Contact::factory()->create([
            'cell_phone' => '0813435219',
            'whatsapp' => '0813435219',
            'email' => 'mrlolwane96@gmail.com',
            'preffered_contact_method' => 'email'
        ]);

        //Fetch the contact with the specified id
        $contact = $this->getJson('/api/contacts/show/11');
            
        //Assert that the created contact matches the one fetched from the database
        $contact->assertJson([
            'cell_phone' => '0813435219',
            'whatsapp' => '0813435219',
            'email' => 'mrlolwane96@gmail.com',
            'preffered_contact_method' => 'email'
        ]);
    }

    //Test that no contact is returned when an invalid id is provided
    public function test_that_invalid_id_provided_results_in_not_found()
    {
         //Store 10 contacts on the database
         Contact::factory(10)->create();

         //Fetch a contact with an invalid id
        $contact = $this->getJson('/api/contacts/show/11');
        //dd($contact);
        $contact->assertStatus(404);
    }   

    //Test that contacts can be retrieved by grade. This will have to be done on the API aggregator.

    //Test that contacts can be retrieved by class. This will have to be done on the API aggregator.
}
