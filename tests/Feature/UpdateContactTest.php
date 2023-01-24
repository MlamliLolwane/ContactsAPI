<?php

namespace Tests\Feature;

use App\Models\Contact;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class UpdateContactTest extends TestCase
{
    use RefreshDatabase;

    public function test_preferred_contact_method_can_be_successfully_updated_from_email_to_whatsapp()
    {
        //Store a contact that uses email as the preferred contact method
        Contact::factory()->create([
            'preffered_contact_method' => 'email'
        ]);

        //Assert that the contact was created successfully
        $this->assertCount(1, Contact::all());

        //Update the first resource in the database from email preferred contact method to whatsapp
        $updatedContact = [
            'preffered_contact_method' => 'whatsapp',
            'whatsapp' => '0813435219'
        ];

        $response = $this->patchJson('/api/contacts/update/1', $updatedContact);
    
        //Assert that change was made
        
        $response->assertSuccessful();
    }

    public function test_preferred_contact_method_can_be_successfully_updated_from_whatsapp_to_email()
    {
        //Store a contact that uses both whatsapp as the preferred contact method
        $contact = Contact::factory()->create([
            'preffered_contact_method' => 'whatsapp'
        ]);

        //Assert that the contact was created successfully
        $this->assertCount(1, Contact::all());

        //Update the first resource in the database from whatsapp preferred contact method to email
        $updatedContact = [
            'preffered_contact_method' => 'email',
            'email' => 'testemail@gmail.com'
        ];

        $response = $this->patchJson('/api/contacts/update/1', $updatedContact);

        //Assert that change was made
        $response->assertSuccessful();
    }

    public function test_preferred_contact_method_can_be_successfully_updated_from_whatsapp_to_both()
    {
        //Store a contact that uses both whatsapp and email as the preferred contact method
        $contact = Contact::factory()->create([
            'preffered_contact_method' => 'whatsapp'
        ]);

        //Assert that the contact was created successfully
        $this->assertCount(1, Contact::all());

        //Update the first resource in the database from whatsapp preferred contact method to both whatsapp and email
        $updatedContact = [
            'preffered_contact_method' => 'both',
            'email' => 'testemail@gmail.com',
            'whatsapp' => '0813435219'
        ];

        $response = $this->patchJson('/api/contacts/update/1', $updatedContact);

        //Assert that change was made
        $response->assertOk();
    }
}
