<?php

namespace App\Http\Controllers;

use App\Models\News;
use Illuminate\Http\Request;

class NewsController extends Controller
{
    //
    public function index()
    {
        try {
            $news = News::all();
            return json_encode($news);
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
                'title' => 'required',
                'content' => 'required',
                'image_title' => 'required',
                'publisher' => 'required',
                'image_section1' => '',
                'image_section2' => '',
                'image_section3' => '',
                'category_id' => 'required',
                'modul_id' => 'required',
            ]);
            $data = News::create(['title' => $request->title, 'content' => $request->content, 'publisher' => $request->publisher, 'category_id' => $request->category_id, 'modul_id' => $request->modul_id]);
            $imageFields = ['image_title', 'image_section1', 'image_section2', 'image_section3'];
            foreach ($imageFields as $imageField) {
                if ($request->hasFile($imageField)) {
                    $image = $request->file($imageField);
                    $image_extension = $image->getClientOriginalExtension();
                    $image_name = 'koperasi_news_' . time() . rand(1, 100) . '.' . $image_extension;
                    $image_folder = '/photo/news/';
                    $image_location = $image_folder . $image_name;
                    try {
                        $image->move(public_path($image_folder), $image_name);
                        $data->$imageField = $image_location;
                    } catch (\Throwable $th) {
                        return response()->json([
                            'response_code' => "01",
                            'response_message' => $th->getMessage(),
                        ], 400);
                    }
                }
            }
            $data->save();
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

    public function show($id)
    {
        try {
            $news = News::findOrFail($id);
            return response()->json([
                'response_code' => '00',
                'response_message' => 'Ambil detail data',
                'data' => $news
            ], 200);
        } catch (\Throwable $th) {
            return response()->json([
                'response_code' => '01',
                'response_message' => $th->getMessage()
            ], 500);
        }
    }

    public function update(Request $request, $id)
    {
        try {
            $News_update = News::findOrFail($id);
            // $News_update->update(['title' => $request->title, 'content' => $request->content, 'publisher' => $request->publisher, 'category_id' => $request->category_id, 'modul_id' => $request->modul_id]);
            $request->title ? $News_update->title = $request->title : '';
            $request->content ? $News_update->content = $request->content : '';
            $request->publisher  ? $News_update->publisher = $request->publisher : '';
            $request->category_id ? $News_update->category_id = $request->category_id : '';
            $request->modul_id ? $News_update->modul_id = $request->modul_id : '';
            $imageFields = ['image_title', 'image_section1', 'image_section2', 'image_section3'];
            foreach ($imageFields as $imageField) {
                if ($request->hasFile($imageField)) {
                    $image = $request->file($imageField);
                    $image_extension = $image->getClientOriginalExtension();
                    $image_name = 'koperasi_news_' . time() . rand(1, 100) . '.' . $image_extension;
                    $image_folder = '/photo/news/';
                    $image_location = $image_folder . $image_name;
                    try {
                        $image->move(public_path($image_folder), $image_name);
                        $News_update->$imageField = $image_location;
                    } catch (\Throwable $th) {
                        return response()->json([
                            'response_code' => "01",
                            'response_message' => $th->getMessage(),
                        ], 400);
                    }
                }
            }
            $News_update->save();
            return response()->json([
                'response_code' => '00',
                'response_message' => 'Berhasil update pusat koperasi',
                'data' => $News_update
            ], 200);
        } catch (\Throwable $err) {
            return response()->json([
                'response_code' => '01',
                'response_message' => $err->getMessage()
            ], 500);
        }
    }
}
