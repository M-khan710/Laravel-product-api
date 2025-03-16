<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Purchaser;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\ValidationException;

class PurchaseApiController extends Controller
{
    // Show all purchases with pagination
    public function index(Request $request)
    {
        try {
            $purchases = Purchaser::paginate(10);
            return response()->json([
                'message' => 'Purchases retrieved successfully',
                'data' => $purchases
            ], 200);

        } catch (\Exception $e) {
            return response()->json([
                'error' => 'Something went wrong while retrieving purchases. Please try again later.'
            ], 500);
        }
    }
    
    // Add new purchase (order)
    public function purchase(Request $request)
    {
        try {
            // Validate the incoming request
            $validator = Validator::make($request->all(), [
                'name'              => 'required|string|max:255',
                'email'             => 'required|email|max:255',
                'shipping_address'  => 'required|string|max:255',
                'product_id'        => 'required|integer|exists:products,id',
               
                'payments'          => 'required|numeric',
                'payment_status'    => 'required|string|max:255',
                'payment_mode'      => 'required|string|max:255',
                'status'            => 'required|string|max:255',
                'quantity'          => 'required|integer|min:1'
                
            ]);
            if ($validator->fails()) {
                throw new ValidationException($validator);
            }
            $product = Product::find($request->product_id);

            if (!$product) {
                return response()->json(['error' => 'Product not found'], 404);
            }
            if ($product->stock_quantity < $request->quantity) {
                return response()->json(['error' => 'Not enough stock available'], 400);
            }
            $price = $request->payments / $request->quantity;
            if ($product->price != $price) {
                return response()->json(['error' => 'Price should be fixed'], 400);
            }
            $uuid = Str::uuid()->toString();
            $purchase = new Purchaser();
            $purchase->name = $request->name;
            $purchase->email = $request->email;
            $purchase->shipping_address = $request->shipping_address;
            $purchase->product_id = $request->product_id;
            $purchase->product_name = $product->name;
            $purchase->payments = $request->payments;
            $purchase->payment_status = $request->payment_status;
            $purchase->payment_mode = $request->payment_mode;
            $purchase->status = $request->status;
            $purchase->quantity = $request->quantity;
            $purchase->purchaser_uuid =  $uuid;
            $purchase->save();
            $product->stock_quantity -= $request->quantity;
            $product->save();
            return response()->json(['message' => 'Purchase successful', 'purchase' => $purchase], 201);
        } catch (ValidationException $e) {
            return response()->json(['errors' => $e->errors()], 400);
        } catch (\Exception $e) {
            return response()->json(['error' => 'Something went wrong. Please try again later.'], 500);
        }
    }
    //  update purchase order status just like delivered, shipped, cancel
    public function updateStatus(Request $request, $uuid)
    {
        try {
            $request->validate([
                'status' => 'required|string|max:255|in:pending,shipped,delivered,canceled'
            ]);
            $purchase = Purchaser::where('purchaser_uuid',$uuid)->first();
            if (!$purchase) {
                return response()->json(['error' => 'Purchaser not found'], 404);
            }
            $purchase->status = $request->status;
            $purchase->save();
            return response()->json([
                'message' => 'Purchase status updated successfully',
                'purchase' => $purchase
            ], 200);

        } catch (\Exception $e) {
            return response()->json([
                'error' => 'Something went wrong while updating the status. Please try again later.'
            ], 500);
        }
    }

   //  Display Single purchase (order)
    public function singlePurchase($uuid)
    {
        $purchase = Purchaser::where('purchaser_uuid', $uuid)->first();
        if (!$purchase) {
            return response()->json(['error' => 'Purchase not found'], 404);
        }
        return response()->json([
            'message' => 'Purchase retrieved successfully',
            'purchase' => $purchase
        ], 200);
    }
}
