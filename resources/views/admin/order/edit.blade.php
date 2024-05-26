@extends('admin.layouts.app')

@section('style')

@endsection

@section('content')

<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Edit Order</h1>
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
        <div class="row">
          <div class="col-md-12">
          <div class="card card-primary">
              <form action="" method="post">
                {{ csrf_field() }}
                <div class="card-body">
                  <div class="form-group">
                    <label>Name <span style="color:red">*</span></label>
                    <input type="text" class="form-control" name="name" readonly required value="{{ old('name', $getRecord->name) }}">
                  </div>
                  <div class="form-group">
                    <label>Address <span style="color:red">*</span></label>
                    <input type="text" class="form-control" name="address" readonly required value="{{ old('address', $getRecord->address) }}">
                  </div>
                  <div class="form-group">
                    <label>Phone <span style="color:red">*</span></label>
                    <input type="text" class="form-control" name="phone" readonly required value="{{ old('phone', $getRecord->phone) }}">
                  </div>
                  <div class="form-group">
                    <label>Email <span style="color:red">*</span></label>
                    <input type="text" class="form-control" name="email" readonly required value="{{ old('email', $getRecord->email) }}">
                  </div>
                  <div class="form-group">
                    <label>Payment Method <span style="color:red">*</span></label>
                    <input type="text" class="form-control" name="payment_method" readonly required value="{{ old('payment_method', $getRecord->payment_method) }}">
                  </div>
                  <div class="card-body p-0">
                <table class="table table-striped">
                  <thead>
                    <tr>
                      <!-- <th>Image</th> -->
                      <th>Image</th>
                      <th>Product Name</th>
                      <th>Qty</th>
                      <th>Price</th>
                      <th>Color Name</th>
                      <th>Total Amount</th>
                    </tr>
                  </thead>
                  <tbody>
                    @foreach($getRecord->getItem as $value)
                    @php
                      $getProductImage = $value->getProduct->getImageSingle($value->getProduct->id);
                    @endphp
                    <tr>
                      <td>
                        <img src="{{ $getProductImage->getLogo() }}" style="width: 200px; heigth: auto">
                      </td>
                      <td>{{ $value->getProduct->title }}</td>
                      <td>{{ $value->quantity }}</td>
                      <td>{{ $value->price }}</td>
                      <td>{{ $value->color_name }}</td>
                      <td>{{ $value->total_price }}</td>
                    </tr>
                    @endforeach
                  </tbody>
                </table>
              </div>
                  <div class="form-group">
                    <label>Status Pembayaran <span style="color:red">*</span></label>
                    <select class="form-control" name="is_payment" required>
                      <option {{ (old('is_payment', $getRecord->is_payment) == 0) ? 'selected' : '' }} value="0">Proses</option>
                      <option {{ (old('is_payment', $getRecord->is_payment) == 1) ? 'selected' : '' }} value="1">Selesai</option>
                    </select>
                  </div>
                  <div class="form-group">
                    <label>Status <span style="color:red">*</span></label>
                    <select class="form-control" name="status" required>
                      <option {{ (old('status', $getRecord->status) == 0) ? 'selected' : '' }} value="0">Active</option>
                      <option {{ (old('status', $getRecord->status) == 1) ? 'selected' : '' }} value="1">Inactive</option>
                    </select>
                  </div>
                </div>

                <div class="card-footer">
                  <button type="submit" class="btn btn-primary">Update</button>
                </div>
              </form>
            </div>
        </div>
          </div>
      </div><!-- /.container-fluid -->
    </section>
    <!-- /.content -->
  </div>


@endsection

@section('script')

@endsection