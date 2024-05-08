<?php

namespace App\Http\Controllers;

use App\Models\ModulCooperative;
use Illuminate\Http\Request;

class ModulCooperativeController extends Controller
{
    //
    public function index()
    {
        try {
            $modul_cooperative = ModulCooperative::all();
            return json_encode($modul_cooperative);
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
                'modul_id' => 'required',
                'koperasi_id' => '',
                'c_koperasi_id' => ''

            ]);
            if ($request->koperasi_id) {
                $data = ModulCooperative::create(['modul_id' => $request->modul_id, 'koperasi_id' => $request->koperasi_id]);
            }
            if ($request->c_koperasi_id) {
                $data = ModulCooperative::create(['modul_id' => $request->modul_id, 'c_koperasi_id' => $request->c_koperasi_id]);
            }
            return response()->json([
                'response_code' => '00',
                'response_message' => 'Berhasil tambah pusat koperasi!',
                'data' => $data
            ], 200);
        } catch (\Throwable $err) {
            return response()->json([
                'response_code' => '01',
                'response_message' => $err->getMessage()
            ], 400);
        }
    }

    public function update(Request $request, $id)
    {
        try {
            $mc_update = ModulCooperative::findOrFail($id);
            $mc_update->update(['status' => $request->status]);
            if ($request->has('koperasi_id')) {
                $mc_update->koperasi_id = $request->koperasi_id;
            }
            if ($request->has('c_koperasi_id')) {
                $mc_update->c_koperasi_id = $request->c_koperasi_id;
            }
            $mc_update->save();
            return response()->json([
                'response_code' => '00',
                'response_message' => 'Berhasil update pusat koperasi',
                'data' => $mc_update
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
            $modul_cooperative = ModulCooperative::findOrFail($id);
            return response()->json([
                'response_code' => '00',
                'response_message' => 'Ambil detail data',
                'data' => $modul_cooperative
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
            ModulCooperative::destroy($id);
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
