@extends('admin.layouts.app')

@section('style')
<link rel="stylesheet" href="{{ url('public/assets/plugins/summernote/summernote-bs4.min.css') }}">
@endsection

@section('content')

<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Edit Product</h1>
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
        <div class="row">
          <div class="col-md-12">
          @include('admin.layouts._message')
          <div class="card card-primary">
              <form action="" method="post" enctype="multipart/form-data">
                {{ csrf_field() }}
                <div class="card-body">
                  <div class="row">
                    <div class="col-md-6">
                      <div class="form-group">
                        <label>Title<span style="color:red">*</span></label>
                        <input type="text" class="form-control" name="title" required value="{{ old('title', $product->title) }}" placeholder="Title">
                      </div>
                    </div>
                    <div class="col-md-6">
                      <div class="form-group">
                        <label>SKU<span style="color:red">*</span></label>
                        <input type="text" class="form-control" name="sku" required value="{{ old('sku', $product->sku) }}" placeholder="SKU">
                      </div>
                    </div>
                    <div class="col-md-6">
                      <div class="form-group">
                        <label>Category <span style="color:red">*</span></label>
                        <select class="form-control" id="ChangeCategory" name="category_id" required>
                          <option>Select Category</option>
                          @foreach($getCategory as $category)
                            <option {{ ($product->category_id == $category->id) ? 'selected' : '' }} value="{{ $category->id }}">{{ $category->name }}</option>
                          @endforeach
                        </select>
                      </div>
                    </div>
                    <div class="col-md-6">
                      <div class="form-group">
                        <label>Sub Category <span style="color:red">*</span></label>
                        <select class="form-control" id="getSubCategory" name="sub_category_id">
                          <option>Select Sub Category</option>
                          @foreach($getSubCategory as $sub_category)
                            <option {{ ($product->sub_category_id == $sub_category->id) ? 'selected' : '' }} value="{{ $sub_category->id }}">{{ $sub_category->name }}</option>
                          @endforeach
                        </select>
                      </div>
                    </div>
                    <div class="col-md-6">
                      <div class="form-group">
                        <label>Brand <span style="color:red">*</span></label>
                        <select class="form-control" name="brand_id" required>
                          <option>Select Brand</option>
                          @foreach($getBrand as $brand)
                            <option {{ ($product->brand_id == $brand->id) ? 'selected' : '' }} value="{{ $brand->id }}">{{ $brand->name }}</option>
                          @endforeach
                        </select>
                      </div>
                    </div>
                  </div>
                  <div class="row">
                    <div class="col-md-12">
                      <div class="form-group">
                        <label>Color<span style="color:red">*</span></label>
                          @foreach($getColor as $color)
                          @php
                            $checked = '';
                          @endphp
                          @foreach($product->getColor as $pcolor)
                            @if($pcolor->color_id == $color->id)
                            @php
                              $checked = 'checked';
                            @endphp
                            @endif
                          @endforeach
                            <div>
                              <label><input {{ $checked }} type="checkbox" name="color_id[]" value="{{ $color->id }}"> {{ $color->name }}</label>
                            </div>
                          @endforeach
                      </div>
                    </div>
                  </div>
                  <hr>
                  <div class="row">
                    <div class="col-md-6">
                      <div class="form-group">
                        <label>Price<span style="color:red">*</span></label>
                        <input type="text" class="form-control" name="price" required value="{{ !empty($product->price) ? $product->price : '' }}" placeholder="Price">
                      </div>
                    </div>
                    <div class="col-md-6">
                      <div class="form-group">
                        <label>Old price<span style="color:red">*</span></label>
                        <input type="text" class="form-control" name="old_price" required value="{{ !empty($product->old_price) ? $product->old_price : '' }}" placeholder="Old price">
                      </div>
                    </div>
                  </div>
                  <div class="row">
                    <div class="col-md-12">
                      <div class="form-group">
                        <label>Size<span style="color:red">*</span></label>
                        <div>
                          <table class="table table-striped">
                            <thead>
                              <tr>
                                <th>Name</th>
                                <th>Price</th>
                                <th>Action</th>
                              </tr>
                            </thead>
                            <tbody id="AppendSize">
                              @php
                              $i_s = 1;
                              @endphp
                              @foreach($product->getSize as $size)
                              <tr id="DeleteSize{{ $i_s }}">
                                <td>
                                  <input type="text" class="form-control" name="size[{{$i_s}}][name]" value="{{ $size->name }}" placeholder="Size Name">
                                </td>
                                <td>
                                  <input type="text" class="form-control" name="size[{{$i_s}}][price]" value="{{ $size->price }}" placeholder="Size Price">
                                </td>
                                <td style="width: 160px">
                                  <button type="button" id="{{ $i_s }}" class="btn btn-danger btn-sm DeleteSize">Delete</button>
                                </td>
                              </tr>
                              @php
                                $i_s++;
                              @endphp
                              @endforeach
                              <tr>
                                <td>
                                  <input type="text" class="form-control" name="size[100][name]" value="" placeholder="Size Name">
                                </td>
                                <td>
                                  <input type="text" class="form-control" name="size[100][price]" value="" placeholder="Size Price">
                                </td>
                                <td style="width: 160px">
                                  <button type="button" class="btn btn-primary btn-sm AddSize">Add</button>
                                </td>
                              </tr>
                            </tbody>
                          </table>
                        </div>
                      </div>
                    </div>
                  </div>
                  <hr>
                  <div class="row">
                    <div class="col-md-12">
                      <div class="form-group">
                        <label>Image<span style="color:red"></span></label>
                        <input type="file" name="image[]" class="form-control" style="padding: 5px" multiple accept="image/*">
                      </div>
                    </div>
                  </div>
                  @if(!empty($product->getImage->count()))
                  <div class="row">
                    @foreach($product->getImage as $image)
                    @if(!empty($image->getLogo()))
                      <div class="" style="text-align: center" id="{{ $image->id }}">
                        <img style="width: 50%; height: 100%" src="{{ $image->getLogo() }}" alt="">
                        <a onclick="return confirm('Are you sure yuo want to delete?')" href="{{ url('admin/product/image_delete/'.$image->id) }}" style="margin-bottom: 10px" class="btn btn-danger btn-sm">Delete</a>
                      </div>
                    @endif
                    @endforeach
                  </div>
                  @endif
                  <hr>
                  <div class="row">
                    <div class="col-md-12">
                      <div class="form-group">
                        <label>Short Description<span style="color:red">*</span></label>
                        <textarea class="form-control" name="short_description" placeholder="Short Description">{{ $product->short_description }}</textarea>
                      </div>
                    </div>
                  </div>
                  <hr>
                  <div class="row">
                    <div class="col-md-12">
                      <div class="form-group">
                        <label>Description<span style="color:red">*</span></label>
                        <textarea class="form-control editor" name="description" placeholder="Description">{{ $product->description }}</textarea>
                      </div>
                    </div>
                  </div>
                  <div class="row">
                    <div class="col-md-12">
                      <div class="form-group">
                        <label>Additional Information<span style="color:red">*</span></label>
                        <textarea class="form-control editor" name="additional_information" placeholder="Additional Information">{{ $product->additional_information }}</textarea>
                      </div>
                    </div>
                  </div>
                  <div class="row">
                    <div class="col-md-12">
                      <div class="form-group">
                        <label>Shipping Returns<span style="color:red">*</span></label>
                        <textarea class="form-control editor" name="shipping_returns" placeholder="Shipping Returns">{{ $product->shipping_returns }}</textarea>
                      </div>
                    </div>
                  </div>
                  <hr>
                  <div class="row">
                    <div class="col-md-12">
                      <div class="form-group">
                        <label>Status <span style="color:red">*</span></label>
                        <select class="form-control" name="status" required>
                          <option {{ ($product->status == 0) ? 'selected' : '' }} value="0">Active</option>
                          <option {{ ($product->status == 1) ? 'selected' : '' }} value="1">Inactive</option>
                        </select>
                      </div>
                    </div>
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
<script src="{{ url('public/assets/plugins/summernote/summernote-bs4.min.js') }}"></script>
<script type="text/javascript">
  var i = 101;
  $('body').delegate('.AddSize', 'click', function() {
    var html = '<tr id="DeleteSize'+i+'">\n\
                  <td>\n\
                    <input type="text" class="form-control" name="size['+i+'][name]" required value="" placeholder="Size Name">\n\
                  </td>\n\
                  <td>\n\
                    <input type="text" class="form-control" name="size['+i+'][price]" required value="" placeholder="Size Price">\n\
                  </td>\n\
                  <td>\n\
                    <button type="button" id="'+i+'" class="btn btn-danger btn-sm DeleteSize">Delete</button>\n\
                  </td>\n\
                </tr>';
    i++;
    $('#AppendSize').append(html);
  })

  $('.editor').summernote({
    height: 200
  });

  $('body').delegate('.DeleteSize', 'click', function() {
      var id = $(this).attr('id');
      $('#DeleteSize'+id).remove();
  })

  $('body').delegate('#ChangeCategory', 'change', function(e) {
    var id = $(this).val();
    $.ajax({
        type: "POST",
        url: "{{ url('admin/get_sub_category') }}",
        data: {
            id: id,
            _token: "{{ csrf_token() }}"
        },
        dataType: "json",
        success: function(data) {
            $('#getSubCategory').html(data.html);
        },
        error: function(data) {
            console.error("Error fetching sub categories:", data);
        }
    });
});

</script>

@endsection