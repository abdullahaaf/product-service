<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Models\Image;
use App\Models\ProductImage;
use Illuminate\Support\Facades\Storage;

class ImageController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        $images = Image::all();
        if ($images->isEmpty()) {
            $statusCode = 204;
            $message = "No available images";
            $data = [];
        } else {
            $statusCode =  200;
            $message = "Success get images data";
            $data = $images;
        }

        return $this->apiResponse($message, $statusCode, $data);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $imageModel = new Image();
        $payload = $request->all();
        $imageData = $this->redefineImageData($payload, $imageModel);
        $store = $imageModel::create($imageData);
        if ($store) {
            return $this->apiResponse("success add new image", 201, $payload);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $image = Image::find($id);

        if (is_null($image)) {
            $statusCode = 204;
            $message = "No available image";
            $data = [];
        } else {
            $statusCode =  200;
            $message = "Success get image data";
            $data = $image;
        }
        return $this->apiResponse($message, $statusCode, $data);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        if (!isset($id)) {
            return $this->apiResponseError("Id must be set", 400);
        }

        $imageModel = new Image();
        $image = $imageModel::find($id);

        if (is_null($image)) {
            return $this->apiResponse("No image available", 204);
        }

        $newimage = $request->all();
        $image->name = $newimage['name'] ?? $image->name;
        $image->enable = $newimage['enable'] ?? $image->enable;

        if ($newimage['file'] != $image->file) {
            Storage::delete($image->file);
            $image->file = $newimage['file'];
        }

        $update = $image->save();
        if ($update) {
            return $this->apiResponse("Success update image", 201, $image);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        if (!isset($id)) {
            return $this->apiResponseError("Id must be set", 400);
        }

        $image = Image::find($id);
        if (is_null($image)) {
            return $this->apiResponse("No category available", 204);
        }

        $productImage = ProductImage::where('image_id', $id)->first();
        $productImage->delete();

        Storage::delete($image->file);
        $image->delete();

        return $this->apiResponse("Success delete category", 200);
    }

    private function redefineImageData($payload, $imageModel)
    {
        $validator = Validator::make($payload, config('validation.validateImage'));
        if ($validator->fails()) {
            return $this->apiResponseErrorValidation($validator->errors());
        } else {
            return $imageModel->assertImageData($payload);
        }
    }
}
