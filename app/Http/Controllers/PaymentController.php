<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ProductModel;
use App\Models\ProductSizeModel;
use App\Models\ShippingChargeModel;
use App\Models\OrderModel;
use App\Models\OrderItemModel;
use App\Models\ColorModel;
use Cart;

class PaymentController extends Controller
{
    public function checkout(Request $request)
    {
        $data['meta_title'] = 'Checkout';
        $data['meta_description'] = '';
        $data['meta_keywords'] = '';
        $data['getShipping'] = ShippingChargeModel::getRecordActive();
        return view('payment.checkout', $data);
    }

    public function cart(Request $request)
    {
        $data['meta_title'] = 'Cart';
        $data['meta_description'] = '';
        $data['meta_keywords'] = '';
        return view('payment.cart', $data);
    }

    public function cart_delete($id)
    {
        Cart::remove($id);
        return redirect()->back();
    }

    public function add_to_cart(Request $request)
    {
        $getProduct = ProductModel::getSingle($request->product_id);
        $total = $getProduct->price;
        if(!empty($request->size_id)) {
            $size_id = $request->size_id;
            $getSize = ProductSizeModel::getSingle($size_id);

            $size_price = !empty($getSize->price) ? $getSize->price : 0;
            $total = $total + $size_price;
        } else {
            $size_id = 0;
        }

        $color_id = !empty($request->color_id) ? $request->color_id : 0;

        Cart::add([
            'id' => $getProduct->id,
            'name' => 'Product',
            'price' => $total,
            'quantity' => $request->qty,
            'attributes' => [
                'size_id' => $size_id,
                'color_id' => $color_id,
            ]
        ]);

        return redirect()->back();
    }

    public function update_cart(Request $request)
    {
        foreach($request->cart as $cart) {
            Cart::update($cart['id'], array (
                'quantity' => array (
                    'relative' => false,
                    'value' => $cart['qty']
                )
            ));
        }
        return redirect()->back();
    }

    public function place_order(Request $request)
    {
        $order = new OrderModel;
        $order->name = trim($request->name);
        $order->address = trim($request->address);
        $order->phone = trim($request->phone);
        $order->email = trim($request->email);
        $order->shipping_id = trim($request->shipping_id);
        $order->payment_method = trim($request->payment_method);
        $order->save();

        foreach(Cart::getContent() as $key => $cart) {
            $order_item = new OrderItemModel;
            $order_item->order_id = $order->id;
            $order_item->product_id = $cart->id;
            $order_item->quantity = $cart->quantity;
            $order_item->price = $cart->price;

            $color_id = $cart->attributes->color_id;
            if(!empty($color_id))
            {
                $getColor = ColorModel::getSingle($color_id);
                $order_item->color_name = $getColor->name;
            }
            $size_id = $cart->attributes->size_id;
            if(!empty($size_id))
            {
                $getSize = ProductSizeModel::getSingle($size_id);
                $order_item->size_name = $getSize->name;
                $order_item->size_amount = $getSize->price;
            }
            $order_item->total_price = $cart->price;
            $order_item->save();
        }
        
    }
}
