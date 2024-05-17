<?php

namespace App\Http\Controllers;

use App\Models\AdsContent;
use Illuminate\Http\Request;

class AdsContentController extends Controller
{
    //
    public function index()
    {
        $ads_content = AdsContent::all();
        return json_encode($ads_content);
    }

    public function store(Request $request)
    {
        try {
            $request->validate([
                'title' => 'required',
                'content' => 'required',
                'image' => 'required',
                'url' => 'required',
                'modul_id' => 'required',
            ]);
            $data = new AdsContent;
            $data->title = $request->title;
            $data->content = $request->content;
            $data->url = $request->url;
            $data->modul_id = $request->modul_id;
            if ($request->hasFile('image')) {
                $image = $request->file('image');
                $image_extension = $image->getClientOriginalExtension();
                $image_name = 'koperasi_ads_' . time() . rand(1, 100) . '.' . $image_extension;;
                $image_folder = '/photo/ads/';
                $image_location = $image_folder . $image_name;
                try {
                    $image->move(public_path($image_folder), $image_name);
                    $data->image = $image_location;
                } catch (\Throwable $th) {
                    return response()->json([
                        'response_code' => "01",
                        'response_message' => $th->getMessage(),
                    ], 400);
                }
            }
            $data->save();
            return response()->json([
                'response_code' => '00',
                'response_message' => 'Berhasil tambah ads!',
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
            $request->validate([
                'title' => 'required',
                'content' => 'required',
                'image' => 'required',
                'url' => 'required',
                'modul_id' => 'required',
            ]);

            $ads_update = AdsContent::findOrFail($id);
            $ads_update->update(['title' => $request->title, 'content' => $request->content, 'url' => $request->url, $ads_update->modul_id = $request->modul_id]);
            if ($request->hasFile('image')) {
                $image = $request->file('image');
                $image_extension = $image->getClientOriginalExtension();
                $image_name = time() . '    .' . $image_extension;
                $image_folder = '/photo/campaign/';
                $image_location = $image_folder . $image_name;
                try {
                    $image->move(public_path($image_folder), $image_name);
                    $ads_update->image = $image_location;
                } catch (\Throwable $th) {
                    return response()->json([
                        'response_code' => "01",
                        'response_message' => $th->getMessage(),
                    ], 400);
                }
                $ads_update->save();
            }

            return response()->json([
                'response_code' => '00',
                'response_message' => 'Berhasil update ads',
                'data' => $ads_update
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
            $AdsContent = AdsContent::findOrFail($id);
            return response()->json([
                'response_code' => '00',
                'response_message' => 'Ambil detail data',
                'data' => $AdsContent
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
            AdsContent::destroy($id);
            return response()->json([
                'response_code' => "00",
                'response_message' => 'Berhasil delete id:' . ' ' . $id
            ], 200);
        } catch (\Throwable $th) {
            return response()->json([
                'response_code' => "01",
                'response_message' => $th->getMessage()
            ], 500);
        }
    }
}
