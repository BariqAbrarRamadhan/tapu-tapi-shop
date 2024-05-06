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
            <h1>Edit Sub Category</h1>
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
                    <label>Category Name <span style="color:red">*</span></label>
                    <select name="category_id" class="form-control" id="">
                      <option value="">
                        @foreach($getCategory as $value)
                        <option {{ ($value->id == $getRecord->category_id) ? 'selected' : '' }} value="{{ $value->id }}">{{ $value->name }}</option>
                        @endforeach
                      </option>
                    </select>
                  </div>
                  <div class="form-group">
                    <label>Sub Category Name <span style="color:red">*</span></label>
                    <input type="text" class="form-control" name="name" required value="{{ old('name', $getRecord->name) }}" placeholder="Sub Category Name">
                  </div>
                  <div class="form-group">
                    <label>Slug <span style="color:red">*</span></label>
                    <input type="text" class="form-control" name="slug" required value="{{ old('slug', $getRecord->slug) }}" placeholder="Slug Ex. URL">
                  </div>
                  <div style="color:red">{{ $errors->first('slug') }}</div>
                  <div class="form-group">
                    <label>Status <span style="color:red">*</span></label>
                    <select class="form-control" name="status" required>
                      <option {{ (old('status', $getRecord->status) == 0) ? 'selected' : '' }} value="0">Active</option>
                      <option {{ (old('status', $getRecord->status) == 1) ? 'selected' : '' }} value="1">Inactive</option>
                    </select>
                  </div>
                  <hr>
                  <div class="form-group">
                    <label>Meta title <span style="color:red">*</span></label>
                    <input type="text" class="form-control" name="meta_title" required value="{{ old('meta_title', $getRecord->meta_title) }}" placeholder="Meta Title">
                  </div>
                  <div class="form-group">
                    <label>Meta Description</label>
                    <textarea type="text" class="form-control" name="meta_description" placeholder="Meta Description">{{ old('meta_description', $getRecord->meta_description) }}</textarea>
                  </div>
                  <div class="form-group">
                    <label>Meta Keywords</label>
                    <input type="text" class="form-control" name="meta_keywords" value="{{ old('meta_keywords', $getRecord->meta_keywords) }}" placeholder="Meta Keywords">
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