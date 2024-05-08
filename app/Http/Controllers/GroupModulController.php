<?php

namespace App\Http\Controllers;

use App\Models\Group_Modul;
use Illuminate\Http\Request;

class GroupModulController extends Controller
{
    //
    public function index()
    {
        try {
            $group_modul = Group_Modul::all();
            return json_encode($group_modul);
        } catch (\Throwable $err) {
            return response()->json([
                'response_code' => '01',
                'response_message' => $err->getMessage()
            ], 400);
        }
    }
    public function store(Request $request)
    {
        try {
            $request->validate([
                'group_modul_name' => 'required',
            ]);
            Group_Modul::create(['group_modul_name' => $request->group_modul_name]);
            return response()->json([
                'response_code' => '00',
                'response_message' => 'Berhasil tambah group modul!'
            ], 200);
        } catch (\Throwable $err) {
            return response()->json([
                'response_code' => '01',
                'response_message' => $err->getMessage()
            ], 400);
        }
    }

    public function update(Request $request, Group_Modul $group_modul)
    {
        try {
            $request->validate([
                'group_modul_name' => 'required'
            ]);

            $group_modul_update = Group_Modul::findOrFail($group_modul->id);
            $group_modul_update->update(['group_modul_name' => $request->group_modul_name,]);
            return response()->json([
                'response_code' => '00',
                'response_message' => 'Berhasil update modul',
            ], 200);
        } catch (\Throwable $err) {
            return response()->json([
                'response_code' => '01',
                'response_message' => $err->getMessage()
            ], 400);
        }
    }

    public function show($id)
    {
        try {
            $group_modul = Group_Modul::findOrFail($id);
            return response()->json([
                'response_code' => '00',
                'response_message' => 'Ambil detail data',
                'data' => $group_modul
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
            Group_Modul::destroy($id);
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
