<?php

namespace App\Http\Controllers;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\ValidationException;


class ProductApiController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // Fetch Product in pagination
        try {
            $products = Product::paginate(10);
            return response()->json([
                'message' => 'Product retrieved successfully',
                'data' => $products
            ], 200);

        } catch (\Exception $e) {
            return response()->json([
                'error' => 'Something went wrong while retrieving purchases. Please try again later.'
            ], 500);
        }
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // save new product
        try {
            $validator = Validator::make($request->all(), [
                'name' => 'required|string|max:255',
                'description' => 'nullable|string',
                'price' => 'required|numeric|min:0',
                'stock_quantity' => 'required|integer|min:0',
                'category' => 'nullable|string|max:255',
                'image_url' => 'nullable|url',
            ]);
            if ($validator->fails()) {
                throw new ValidationException($validator);
            }
            $product = Product::create($validator->validated());
            return response()->json($product, 201);
        } catch (ValidationException $e) {
            return response()->json([
                'message' => 'Validation failed.',
                'errors' => $e->errors(),
            ], 422); 
        } catch (\Exception $e) {
            return response()->json([
                'message' => 'Something went wrong.',
                'error' => $e->getMessage(),
            ], 500); 
        }
    }

    /**
     * Display the specified product.
     */
    public function show(string $id)
    {
        // Find the product by ID
        $product = Product::find($id);
        if (!$product) {
            return response()->json([
                'message' => 'Product not found'
            ], 404);
        }
        return response()->json($product);
    }
    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        // update the product
        try {
           
            $product = Product::findOrFail($id);
            $validator = Validator::make($request->all(), [
                'name' => 'required|string|max:255',
                'description' => 'nullable|string',
                'price' => 'required|numeric|min:0',
                'stock_quantity' => 'required|integer|min:0',
                'category' => 'nullable|string|max:255',
                'image_url' => 'nullable|url',
            ]);

            if ($validator->fails()) {
                throw new ValidationException($validator);
            }

            $product->update($validator->validated());

            return response()->json($product);
        } catch (ValidationException $e) {
            return response()->json([
                'message' => 'Validation failed.',
                'errors' => $e->errors(),
            ], 422); 
        } catch (\Exception $e) {
            return response()->json([
                'message' => 'Something went wrong.',
                'error' => $e->getMessage(),
            ], 500); 
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
        try {
            $product = Product::findOrFail($id);
            $product->delete();
            return response()->json([
                'message' => 'Product deleted successfully.',
            ], 200); 
        } catch (\Illuminate\Database\Eloquent\ModelNotFoundException $e) {
          
            return response()->json([
                'message' => 'Product not found.',
                'error' => $e->getMessage(),
            ], 404); 
        } catch (\Exception $e) {
           
            return response()->json([
                'message' => 'Something went wrong.',
                'error' => $e->getMessage(),
            ], 500); 
        }
    }
}
