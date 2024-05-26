<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\OrderModel;
use Auth;

class OrderController extends Controller
{
    public function list()
    {
        $data ['getRecord'] = OrderModel::getRecord();
        $data ['header_title'] = 'Order List';
        return view('admin.order.list', $data);
    }

    // public function add()
    // {
    //     $data ['header_title'] = 'Color Add';
    //     return view('admin.color.add', $data);
    // }

    // public function insert(Request $request)
    // {   
    //     $color = new ColorModel();
    //     $color->name = trim($request->name);
    //     $color->code = trim($request->code);
    //     $color->status = trim($request->status);
    //     $color->created_by = Auth::user()->id;
    //     $color->save();

    //     return redirect('admin/color/list')->with('success', 'Color create successfully!');
    // }

    public function edit($id)
    {
        $data ['getRecord'] = OrderModel::getSingle($id);
        $data ['header_title'] = 'Edit Order';
        return view('admin.order.edit', $data);
    }

    public function update($id, Request $request)
    {
        $order = OrderModel::getSingle($id);
        $order->name = trim($request->name);
        $order->address = trim($request->address);
        $order->phone = trim($request->phone);
        $order->email = trim($request->email);
        $order->is_payment = trim($request->is_payment);
        $order->status = trim($request->status);
        $order->payment_method = trim($request->payment_method);
        $order->save();

        return redirect('admin/order/list')->with('success', 'Order update successfully!');
    }

    public function delete($id)
    {
        $order = OrderModel::getSingle($id);
        $order->is_deleted = 1;
        $order->save();

        return redirect()->back()->with('success', 'Order delete successfully!');
    }
}
