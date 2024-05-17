<?php

namespace App\Http\Controllers;

use App\Models\NewsCategory;
use Illuminate\Http\Request;

class NewsCategoryController extends Controller
{
    //
    public function index()
    {
        try {
            $NewsCategory = NewsCategory::all();
            return json_encode($NewsCategory);
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
                'category_name' => 'required',
            ]);
            $data = NewsCategory::create(['modul_id' => $request->modul_id, 'category_name' => $request->category_name]);
            return response()->json([
                'response_code' => '00',
                'response_message' => 'Berhasil tambah kategori!',
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
            $NewsCategory_update = NewsCategory::findOrFail($id);
            $request->modul_id ? $NewsCategory_update->modul_id = $request->modul_id : '';
            $request->category_name ? $NewsCategory_update->category_name = $request->category_name : '';

            // $NewsCategory_update->update(['modul_id' => $request->modul_id, 'category_name' => $request->category_name]);
            $NewsCategory_update->save();
            return response()->json([
                'response_code' => '00',
                'response_message' => 'Berhasil update pusat koperasi',
                'data' => $NewsCategory_update
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
            $NewsCategory = NewsCategory::findOrFail($id);
            return response()->json([
                'response_code' => '00',
                'response_message' => 'Ambil detail data',
                'data' => $NewsCategory
            ], 200);
        } catch (\Throwable $th) {
            return response()->json([
                'response_code' => '01',
                'response_message' => $th->getMessage()
            ], 500);
        }
    }

    public function destroy($id)
    {
        try {
            NewsCategory::destroy($id);
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
