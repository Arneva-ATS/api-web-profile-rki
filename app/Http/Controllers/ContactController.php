<?php

namespace App\Http\Controllers;

use App\Models\Contact;
use Illuminate\Http\Request;

class ContactController extends Controller
{
    //
    public function index()
    {
        try {
            $contact = Contact::all();
            return json_encode($contact);
        } catch (\Throwable $err) {
            return response()->json([
                'response_code' => '01',
                'response_message' => $err->getMessage()
            ], 500);
        }
    }

    public function store(Request $request)
    {
        try {
            $request->validate([
                'modul_id' => 'required',
                'contact_name' => 'required',
                'email' => 'required',
                'phone' => 'required',
                'address' => 'required',
            ]);
            $data = Contact::create(['modul_id' => $request->modul_id, 'contact_name' => $request->contact_name, 'email' => $request->email, 'phone' => $request->phone, 'address' => $request->address]);
            return response()->json([
                'response_code' => '00',
                'response_message' => 'Berhasil tambah kontak!',
                'data' => $data
            ], 200);
        } catch (\Throwable $err) {
            return response()->json([
                'response_code' => '01',
                'response_message' => $err->getMessage()
            ], 500);
        }
    }

    public function update(Request $request, $id)
    {
        try {
            $contact_update = Contact::findOrFail($id);
            $contact_update->update(['modul_id' => $request->modul_id, 'contact_name' => $request->contact_name, 'email' => $request->email, 'phone' => $request->phone, 'address' => $request->address]);
            $contact_update->save();
            return response()->json([
                'response_code' => '00',
                'response_message' => 'Berhasil update pusat koperasi',
                'data' => $contact_update
            ], 200);
        } catch (\Throwable $err) {
            return response()->json([
                'response_code' => '01',
                'response_message' => $err->getMessage()
            ], 500);
        }
    }

    public function show($id)
    {
        try {
            $contact = Contact::findOrFail($id);
            return response()->json([
                'response_code' => '00',
                'response_message' => 'Ambil detail data',
                'data' => $contact
            ], 200);
        } catch (\Throwable $th) {
            return response()->json([
                'response_code' => '01',
                'response_message' => $th->getMessage()
            ], 400);
        }
    }

    public function destroy($id)
    {
        try {
            Contact::destroy($id);
            return response()->json([
                'response_code' => "00",
                'response_message' => 'Berhasil delete id:' . ' ' . $id
            ]);
        } catch (\Throwable $th) {
            return response()->json([
                'response_code' => "01",
                'response_message' => $th->getMessage()
            ]);
        }
    }
}
