<?php

namespace Tests\Feature;

use App\Models\Contact;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class StoreContactTest extends TestCase
{
    use RefreshDatabase;
    
    public function test_contact_can_be_successfully_stored_with_provided_whatsapp_number()
    {
        //Send a request with the given whatsapp number to the database
        $response = $this->postJson('/api/contacts/store', [
            'cell_phone' => '0813435219',
            'whatsapp' => '0813435219',
            'preffered_contact_method' => 'whatsapp'
        ]);
        
        //Assert that the record was stored in the database
        $this->assertCount(1, Contact::all());
    }

    public function test_contact_can_be_successfully_stored_with_provided_email()
    {
        //Send a request with the given email address to the database
        $response = $this->postJson('/api/contacts/store', [
            'cell_phone' => '0813435219',
            'email' => 'testmail@gmail.com',
            'preffered_contact_method' => 'email'
        ]);
        
        //Assert that the record was stored in the database
        $this->assertCount(1, Contact::all());
    }

    public function test_contact_can_be_successfully_stored_with_both_provided_whatsapp_and_email()
    {
        //Send a valid request to the database
        $this->postJson('/api/contacts/store', [
            'cell_phone' => '0813435219',
            'whatsapp' => '0813435219',
            'email' => 'testmail@gmail.com',
            'preffered_contact_method' => 'both'
        ]);
        
        //Assert that the record was stored in the database
        $this->assertCount(1, Contact::all());
    }

    public function test_contact_cannot_be_stored_without_either_whatsapp_or_email()
    {
        //Send a request with both whatsapp and email missing
        $response = $this->postJson('/api/contacts/store', [
            'cell_phone' => '0813435219',
            'preffered_contact_method' => 'whatsapp'
        ]);
        
        //Assert that the record failed to be stored in the database as validation did not pass
        $response->assertInvalid(['whatsapp', 'email']);
    }

    public function test_contact_cannot_be_stored_with_whatsapp_selected_but_email_given()
    {
        //Send a request with email address given where else whatsapp contact is selected
        $response = $this->postJson('/api/contacts/store', [
            'cell_phone' => '0813435219',
            'email' => 'testmail@gmail.com',
            'preffered_contact_method' => 'whatsapp'
        ]);

        //Assert that the request is invalid and whatsapp contact is required.
        $response->assertInvalid(['whatsapp']);
    }

    public function test_contact_cannot_be_stored_with_email_selected_but_whatsapp_given()
    {
        //Send a request with whatsapp contact given where else email is selected
        $response = $this->postJson('/api/contacts/store', [
            'cell_phone' => '0813435219',
            'whatsapp' => '0813435219',
            'preffered_contact_method' => 'email'
        ]);
        
        //Assert that the request is invalid and an email address is required
        $response->assertInvalid(['email']);
    }
}
