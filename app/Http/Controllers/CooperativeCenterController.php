<?php

namespace App\Http\Controllers;

use App\Models\Cooperative_Center;
use Illuminate\Http\Request;

class CooperativeCenterController extends Controller
{
    //
    public function index()
    {
        try {
            $cooperativeCenter = Cooperative_Center::all();
            return json_encode($cooperativeCenter);
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
                'coop_name' => 'required',
                'user_id' => 'required',

            ]);
            $data = Cooperative_Center::create(['coop_name' => $request->coop_name, 'user_id' => $request->user_id]);
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
            $request->validate([
                'coop_name' => 'required',
                'user_id' => ''
            ]);

            $cc_update = Cooperative_Center::findOrFail($id);
            $cc_update->update(['coop_name' => $request->coop_name]);
            if ($request->has('user_id')) {
                $cc_update->user_id = $request->user_id;
            }
            $cc_update->save();
            return response()->json([
                'response_code' => '00',
                'response_message' => 'Berhasil update pusat koperasi',
                'data' => $cc_update
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
            $cooperative_center = Cooperative_Center::findOrFail($id);
            return response()->json([
                'response_code' => '00',
                'response_message' => 'Ambil detail data',
                'data' => $cooperative_center
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
            Cooperative_Center::destroy($id);
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
