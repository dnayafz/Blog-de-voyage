<?php

namespace App\Http\Controllers\Api;

use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\File;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Media;

class MediaController extends Controller{
    
    public function createMedia(Request $request){
        try {
            $path = Storage::disk('public')->put('media', $request->attachment);
            $media = Media::create([
                'image' => $path,
                'id_post' => $request->id_post
            ]);
            return response()->json([
                'status' => true,
                'message' => 'Media Created Successfully',
                'media' => $media
            ], 200);

        }catch(\Throwable $th){
            return response()->json([
                'status' => false,
                'message' => $th->getMessage()
            ], 500);
        }
    }

    public function getSingleMedia($id){
        try {
            $media = Media::where('id_post', $id)->first();
            return response()->json([
                'status' => true,
                'media' => $media
            ], 200);
        } catch (\Throwable $th) {
            return response()->json([
                'status' => false,
                'message' => $th->getMessage()
            ], 500);
        }
    }
    
    public function updateMedia(Request $request, $id){
        try {
            $media = Media::where('id_post', $id)->first();
            if (Storage::disk('public')->exists($media->image ?? 'null')) {
                File::delete(public_path('storage/' . $media->image));
            }
            $path = Storage::disk('public')->put('media', $request->attachment);
            if (empty($media)) {
                $media = Media::create([
                    'image' => $path,
                    'id_post' => $request->id_post
                ]);
            }else{
                $media = Media::where('id_post', $id)->update([
                    'image' => $path,
                    'id_post' => $request->id_post
                ]);
            }
            return response()->json([
                'status' => true,
                'message' => 'Media Updated Successfully',
            ], 200);

        }catch(\Throwable $th){
            return response()->json([
                'status' => false,
                'message' => $th->getMessage()
            ], 500);
        }
    }
    
    public function deleteSingleMedia($id){
        try {
            $media = Media::where('id_post', $id)->first();
            $media->delete();
            return response()->json([
                'status' => true,
                'message' => 'Media deleted Successfully'
            ], 200);
        } catch (\Throwable $th) {
            return response()->json([
                'status' => false,
                'message' => $th->getMessage()
            ], 500);
        }
    }
}
