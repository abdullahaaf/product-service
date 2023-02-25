<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Models\Product;
use App\Models\Category;
use App\Models\Image;
use App\Models\CategoryProduct;
use App\Models\ProductImage;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $categoryProductModel = new CategoryProduct();
        $productImageModel = new ProductImage();

        $products = Product::all();
        $productCategoryImage = [];
        foreach ($products as $product) {
            $productImage = $productImageModel->getProductImageByProductId($product['id']);
            $categoryProduct = $categoryProductModel->getProductCategoryByProductId($product['id']);

            $data = [
                'product_name' => $product['name'],
                'product_description' => $product['description'],
                'product_category' => $categoryProduct[0]->name,
                'product_image' => [
                    'image_name' => $productImage[0]->name,
                    'image_file' => $productImage[0]->file
                ]
            ];
            array_push($productCategoryImage, $data);
        }

        return $this->apiResponse('Success get product data', 200, $productCategoryImage);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $productModel = new Product();
        $categoryProductModel = new CategoryProduct();
        $productImageModel = new ProductImage();
        $payload = $request->all();

        $this->validatePayload($payload);

        $product = $this->redefineProductData($payload, $productModel);

        $store = $productModel::create($product);
        if ($store) {
            $payload['product_id'] = $store->id;
            $categoryProduct = $this->redefineCategoryProductData($payload, $categoryProductModel);
            $productImage = $this->redefineProductImageData($payload, $productImageModel);

            $categoryProductModel::create($categoryProduct);
            $productImageModel::create($productImage);

            return $this->apiResponse('Success add new product', 201, $product);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $categoryProductModel = new CategoryProduct();
        $productImageModel = new ProductImage();

        $product = Product::find($id);
        if (is_null($product)) {
            return $this->apiResponse("No data", 204);
        }

        $productImage = $productImageModel->getProductImageByProductId($product->id);
        $categoryProduct = $categoryProductModel->getProductCategoryByProductId($product->id);
        $productCategoryImage = [
            'product_name' => $product->name,
            'product_description' => $product->description,
            'product_category' => $categoryProduct[0]->name,
            'product_image' => [
                'image_name' => $productImage[0]->name,
                'image_file' => $productImage[0]->file
            ]
        ];

        return $this->apiResponse('Success get product data', 200, $productCategoryImage);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        if (!isset($id)) {
            return $this->apiResponseError("Id must be set", 400);
        }

        $productModel = new Product();
        $categoryProductModel = new CategoryProduct();
        $productImageModel = new ProductImage();
        $product = $productModel::find($id);
        $category = $categoryProductModel::where('product_id', $id)->first();
        $image = $productImageModel::where('product_id', $id)->first();
        $payload = $request->all();

        if (is_null($product)) {
            return $this->apiResponseError("No product available", 400);
        }

        // update product
        $product->name = $payload['name'] ?? $product->name;
        $product->description = $payload['description'] ?? $product->description;
        $product->enable = $payload['enable'] ?? $product->enable;
        $category->category_id = $payload['category'] ?? $category->category_id;
        $image->image_id = $payload['image'] ?? $image->image_id;

        if ($product->save() && $category->save() && $image->save()) {
            return $this->apiResponse("Success update product", 201, $payload);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        if (!isset($id)) {
            return $this->apiResponseError("Id must be set", 400);
        }

        $productImage = ProductImage::where('product_id', $id);
        $categoryProduct = CategoryProduct::where('product_id', $id);
        $product = Product::find($id);

        if (is_null($product)) {
            return $this->apiResponseError("No product available", 400);
        }

        $productImage->delete();
        $categoryProduct->delete();
        $product->delete();

        return $this->apiResponse("Success delete product", 200);
    }

    private function redefineProductData($payload, $productModel)
    {
        return $productModel->assertProductData($payload);
    }

    private function redefineCategoryProductData($payload, $categoryProductModel)
    {
        return $categoryProductModel->assertCategoryProductData($payload);
    }

    private function redefineProductImageData($payload, $productImageModel)
    {
        return $productImageModel->assertProductImageData($payload);
    }

    private function validatePayload($payload)
    {
        $validator = Validator::make($payload, config('validation.validateProduct'));
        if ($validator->fails()) {
            return $this->apiResponseErrorValidation($validator->errors());
        }

        $category = Category::find($payload['category']);
        $image = Image::find($payload['image']);
        if (is_null($category)) {
            return $this->apiResponseError('no category available for given category_id', 400);
        }
        if (is_null($image)) {
            return $this->apiResponseError('no image available for given image_id', 400);
        }
    }
}
