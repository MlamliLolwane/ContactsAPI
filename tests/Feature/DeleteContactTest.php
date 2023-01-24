<?php

namespace Tests\Feature;

use App\Models\Contact;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class DeleteContactTest extends TestCase
{
    use RefreshDatabase;

    public function test_contact_can_be_deleted_successfully(){
        //Contact::truncate();

        //Create 10 contacts
        Contact::factory()->count(10)->create();

        //Verify that exactly 10 contacts were created
        $this->assertCount(10, Contact::all());

        //Delete the 10th contact
        $this->deleteJson('/api/contacts/destroy/10');

        //Verify that only 9 contacts are remaining in the database
        $this->assertCount(9, Contact::all());
    }
}
