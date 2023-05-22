<?php

namespace App\Http\Controllers;

use App\Models\Contact;
use Illuminate\Support\Facades\Crypt;
use App\Http\Requests\StoreContactRequest;
use App\Http\Requests\UpdateContactRequest;
use Illuminate\Http\Response;

class ContactController extends Controller
{
    /**
     * Display a listing of all contacts.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $contacts = Contact::all();

        return response()->json(['data' => $contacts], Response::HTTP_OK);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreContactRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreContactRequest $request)
    {
        $request->validated();

        $contact = Contact::create([
            'cell_phone' => $request->cell_phone,
            'whatsapp' => $request->whatsapp,
            'email' => $request->email,
            'preffered_contact_method' => $request->preffered_contact_method,
            'learner_id' => $request->learner_id
        ]);

        return response()->json($contact, Response::HTTP_CREATED);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Contact  $contact
     * @return \Illuminate\Http\Response
     */
    public function show($contact_id)
    {
        $contact = Contact::where('id', $contact_id)->get();
        //$contact = Contact::findOrFail($contact_id);

        return response()->json($contact);
    }

    public function last_contact()
    {
        $contact = Contact::orderBy('id', 'desc')->first();

        return response()->json(['data' => $contact], Response::HTTP_OK);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateContactRequest  $request
     * @param  \App\Models\Contact  $contact
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateContactRequest $request, $contact_id)
    {
        $request->validated();

        $updated_contact = Contact::where('id', $contact_id)->update($request->all());

        return response()->json($updated_contact, Response::HTTP_OK);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Contact  $contact
     * @return \Illuminate\Http\Response
     */
    public function destroy($contact_id)
    {
        $contact = Contact::where('id', $contact_id)->delete();

        return response()->json($contact, Response::HTTP_OK);
    }
}
