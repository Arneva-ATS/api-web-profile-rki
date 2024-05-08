<?php

namespace App\Http\Controllers;

use App\Models\Cooperative_Branch;
use Illuminate\Http\Request;

class CooperativeBranchController extends Controller
{
    //
    public function index()
    {
        $cooperativeBranch = Cooperative_Branch::all();
        return json_encode($cooperativeBranch);
    }

    public function store(Request $request)
    {
        try {
            $request->validate([
                'coop_name' => 'required',
                'user_id' => 'required',
                'koperasi_id' => 'required',
            ]);
            $data = Cooperative_Branch::create(['coop_name' => $request->coop_name, 'user_id' => $request->user_id, 'koperasi_id' => $request->koperasi_id]);
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
                'user_id' => '',
                'koperasi_id' => ''
            ]);

            $cb_update = Cooperative_Branch::findOrFail($id);
            $cb_update->update(['coop_name' => $request->coop_name]);
            if ($request->has('user_id')) {
                $cb_update->user_id = $request->user_id;
            }
            if ($request->has('koperasi_id')) {
                $cb_update->koperasi_id = $request->koperasi_id;
            }
            $cb_update->save();
            return response()->json([
                'response_code' => '00',
                'response_message' => 'Berhasil update pusat koperasi',
                'data' => $cb_update
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
            $cooperative_branch = Cooperative_Branch::findOrFail($id);
            return response()->json([
                'response_code' => '00',
                'response_message' => 'Ambil detail data',
                'data' => $cooperative_branch
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
            Cooperative_Branch::destroy($id);
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
