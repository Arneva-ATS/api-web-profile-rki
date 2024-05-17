<?php

namespace App\Http\Controllers;

use App\Models\Modul;
use Illuminate\Http\Request;

class ModulController extends Controller
{
    //
    public function index()
    {
        try {
            $modul = Modul::all();
            return json_encode($modul);
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
                'modul_name' => 'required',
                'group_modul_id' => 'required'
            ]);
            Modul::create(['modul_name' => $request->modul_name, 'group_modul_id' => $request->group_modul_id]);
            return response()->json([
                'response_code' => '00',
                'response_message' => 'Berhasil tambah modul!'
            ], 200);
        } catch (\Throwable $err) {
            return response()->json([
                'response_code' => '01',
                'response_message' => $err->getMessage()
            ], 400);
        }
    }

    public function update(Request $request, Modul $modul)
    {
        try {
            $request->validate([
                'modul_name' => 'required',
                'group_modul_id' => ''
            ]);

            $modul_update = Modul::findOrFail($modul->id);
            $modul_update->update(['modul_name' => $request->modul_name]);
            if ($request->has('group_modul_id')) {
                $modul_update->group_modul_id = $request->group_modul_id;
            }
            $modul_update->save();
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
            $modul = Modul::findOrFail($id);
            return response()->json([
                'response_code' => '00',
                'response_message' => 'Ambil detail data',
                'data' => $modul
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
            Modul::destroy($id);
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
