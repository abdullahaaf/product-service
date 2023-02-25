<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Models\Category;
use App\Models\CategoryProduct;

class CategoryController extends Controller
{
    //

    public function index()
    {
        $categories = Category::all();
        if ($categories->isEmpty()) {
            $statusCode = 204;
            $message = "No available categories";
            $data = [];
        } else {
            $statusCode =  200;
            $message = "Success get category data";
            $data = $categories;
        }

        return $this->apiResponse($message, $statusCode, $data);
    }

    public function show($id)
    {
        $category = Category::find($id);

        if (is_null($category)) {
            $statusCode = 204;
            $message = "No available categories";
            $data = [];
        } else {
            $statusCode =  200;
            $message = "Success get category data";
            $data = $category;
        }

        return $this->apiResponse($message, $statusCode, $data);
    }

    public function store(Request $request)
    {
        $categoryModel = new Category();
        $payload = $request->all();

        $validator = Validator::make($payload, config('validation.validateCategory'));
        if ($validator->fails()) {
            return $this->apiResponseErrorValidation($validator->errors());
        }

        $categoryData = $this->redefinedefineCategoryData($payload, $categoryModel);
        $store = $categoryModel::create($categoryData);

        if ($store) {
            return $this->apiResponse("success create category", 201, $categoryData);
        }
    }

    public function update(Request $request, $id)
    {
        if (!isset($id)) {
            return $this->apiResponseError("Id must be set", 400);
        }

        $categoryModel = new Category();
        $category = $categoryModel::find($id);

        if (is_null($category)) {
            return $this->apiResponse("No category available", 204);
        }

        $newCategory = $request->all();
        $category->name = $newCategory['name'] ?? $category->name;
        $category->enable = $newCategory['enable'] ?? $category->enable;

        $update = $category->save();
        if ($update) {
            return $this->apiResponse("Success update category", 201, $category);
        }
    }

    public function destroy($id)
    {
        if (!isset($id)) {
            return $this->apiResponseError("Id must be set", 400);
        }

        $category = Category::find($id);
        if (is_null($category)) {
            return $this->apiResponse("No category available", 204);
        }

        $categoryProduct = CategoryProduct::where('category_id', $id)->first();
        $categoryProduct->delete();

        $category->delete();

        return $this->apiResponse("Success delete category", 200);
    }

    private function redefinedefineCategoryData($payload, $categoryModel)
    {
        return $categoryModel->assertCategoryData($payload);
    }
}
