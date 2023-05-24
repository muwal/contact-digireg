<?php

namespace App\Http\Controllers;

use App\Models\Contact;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class AddressBookController extends Controller
{
    public function add_contact(Request $request)
    {
        $validator = Validator::make(
            $request->all(),
            [
                'name' => 'required|unique:contacts,name',
                'phone_number' => 'required',
            ],
            [
                'name' => 'You must filled this field',
                'phone_number' => 'You must filled this field',
            ]
        );

        if ($validator->fails()) {

            return response()->json([
                'success' => false,
                'message' => 'Please check again your forms!',
                'data'    => $validator->errors()
            ], 400);
        } else {

            $contact = Contact::create([
                'name' => $request->input('name'),
                'phone_number' => $request->input('phone_number')
            ]);

            if ($contact) {
                return response()->json([
                    'success' => true,
                    'message' => 'Success Create Data!',
                ], 200);
            } else {
                return response()->json([
                    'success' => false,
                    'message' => 'Failed to Create Data!',
                ], 400);
            }
        }
    }

    public function remove_contact($name, Request $request)
    {
        $contact = Contact::where('name', $name)->first();
        $contact->delete();

        if ($contact) {
            return response()->json([
                'success' => true,
                'message' => 'Success Delete Data!',
            ], 200);
        } else {
            return response()->json([
                'success' => false,
                'message' => 'Failed Delete Data!',
            ], 500);
        }
    }

    public function search_contact($name, Request $request)
    {
        $contact = Contact::where('name', $name)->first();

        if ($contact) {
            return response()->json([
                'success' => true,
                'message' => 'Your number phone is ' . $contact->phone_number . '',
                'phone_number' => $contact->phone_number,
                'data' => $contact
            ], 200);
        } else {
            return response()->json([
                'success' => false,
                'message' => 'Kontak tidak ditemukan',
            ], 500);
        }
    }
}
