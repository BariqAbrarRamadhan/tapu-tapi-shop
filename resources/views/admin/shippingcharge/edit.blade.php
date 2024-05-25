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
            <h1>Edit Shipping Charge</h1>
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
                    <label>Shipping Charge Name <span style="color:red">*</span></label>
                    <input type="text" class="form-control" name="name" required value="{{ old('name', $getRecord->name) }}" placeholder="Shipping Charge Name">
                  </div>
                  <div class="form-group">
                    <label>Shipping Charge Price <span style="color:red">*</span></label>
                    <input type="text" class="form-control" name="price" required value="{{ old('price', $getRecord->price) }}" placeholder="Shipping Charge Price">
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