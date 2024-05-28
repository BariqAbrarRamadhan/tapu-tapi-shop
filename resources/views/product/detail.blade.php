@extends('layouts.app')
@section('style')
    <link rel="stylesheet" href="{{ url('assets/css/plugins/nouislider/nouislider.css')}}">
@endsection
@section('content')

<main class="main">
            <nav aria-label="breadcrumb" class="breadcrumb-nav border-0 mb-0">
                <div class="container d-flex align-items-center">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{ url('') }}">Home</a></li>
                        <li class="breadcrumb-item"><a href="{{ url($getProduct->getCategory->slug) }}">{{  $getProduct->getCategory->name }}</a></li>
                        <li class="breadcrumb-item active" aria-current="page">{{ $getProduct->title }}</li>
                    </ol>
                </div><!-- End .container -->
            </nav><!-- End .breadcrumb-nav -->

            <div class="page-content">
                <div class="container">
                    <div class="product-details-top mb-2">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="product-gallery">
                                    <figure class="product-main-image">
                                        @php
                                            $getProductImage = $getProduct->getImageSingle($getProduct->id);
                                        @endphp
                                        @if(!empty($getProductImage) && !empty($getProductImage->getLogo()))
                                        <img id="product-zoom" src="{{ $getProductImage->getLogo() }}" data-zoom-image="{{ $getProductImage->getLogo() }}" alt="product image">

                                        <a href="#" id="btn-product-gallery" class="btn-product-gallery">
                                            <i class="icon-arrows"></i>
                                        </a>
                                        @endif
                                    </figure><!-- End .product-main-image -->

                                    <div id="product-zoom-gallery" class="product-image-gallery">
                                        @foreach($getProduct->getImage as $image)
                                        <a class="product-gallery-item" href="#" data-image="{{ $image->getLogo() }}" data-zoom-image="{{ $image->getLogo() }}">
                                            <img src="{{ $image->getLogo() }}" alt="product side">   
                                        </a>
                                        @endforeach
                                    </div><!-- End .product-image-gallery -->
                                </div><!-- End .product-gallery -->
                            </div><!-- End .col-md-6 -->

                            <div class="col-md-6">
                                <div class="product-details">
                                    <h1 class="product-title">{{ $getProduct->title }}</h1><!-- End .product-title -->

                                    <div class="product-price">
                                        Rp. <span id="getTotalPrice">{{ number_format($getProduct->price, 0, ',', '.') }}</span> 
                                    </div><!-- End .product-price -->

                                    <div class="product-content">
                                        <p>{{ $getProduct->short_description }}</p>
                                    </div><!-- End .product-content -->
                                    <form action="{{ url('product/add-to-cart') }}" method="post">
                                        {{ csrf_field() }}
                                        <input type="hidden" name="product_id" value="{{ $getProduct->id }}">
                                        @if(!empty($getProduct->getColor->count()))
                                        <div class="details-filter-row details-row-size">
                                            <label for="color">Color:</label>
                                            <div class="select-custom">
                                                <select name="color_id" id="color" required class="form-control">
                                                    <option value="">Select a color</option>
                                                    @foreach($getProduct->getColor as $color)
                                                    <option value="{{ $color->getColor->id }}">{{ $color->getColor->name }}</option>
                                                    @endforeach
                                                </select>
                                            </div><!-- End .select-custom -->
                                        </div><!-- End .details-filter-row -->
                                        @endif
                                        @if(!empty($getProduct->getSize->count()))
                                        <div class="details-filter-row details-row-size">
                                            <label for="size">Size:</label>
                                            <div class="select-custom">
                                                <select name="size_id" id="size" required class="form-control getSizePrice">
                                                    <option data-price="0" value="">Select a size</option>
                                                    @foreach($getProduct->getSize as $size)
                                                    <option data-price="{{ !empty($size->price) ? $size->price : 0 }}" value="{{ $size->id }}">{{ $size->name }}
                                                        @if(!empty($size->price))
                                                            (Rp. {{ number_format($size->price, 0, ',', '.') }})
                                                        @endif
                                                    </option>
                                                    @endforeach
                                                </select>
                                            </div><!-- End .select-custom -->
                                        </div><!-- End .details-filter-row -->
                                        @endif
                                        <div class="details-filter-row details-row-size">
                                            <label for="qty">Qty:</label>
                                            <div class="product-details-quantity">
                                                <input type="number" id="qty" class="form-control" value="1" min="1" max="100" name="qty" required step="1" data-decimals="0" required>
                                            </div><!-- End .product-details-quantity -->
                                        </div><!-- End .details-filter-row -->

                                        <div class="product-details-action">
                                            <button style="background: #fff; color:#c96" class="btn-product btn-cart" type="submit">add to cart</button>
                                        </div><!-- End .product-details-action -->
                                    </form>
                                    <div class="product-details-footer">
                                        <div class="product-cat">
                                            <span>Category:</span>
                                            <a href="{{ url($getProduct->getCategory->slug) }}">{{ $getProduct->getCategory->name }}</a>,
                                        </div><!-- End .product-cat -->

                                        <!-- <div class="social-icons social-icons-sm">
                                            <span class="social-label">Share:</span>
                                            <a href="#" class="social-icon" title="Facebook" target="_blank"><i class="icon-facebook-f"></i></a>
                                            <a href="#" class="social-icon" title="Twitter" target="_blank"><i class="icon-twitter"></i></a>
                                            <a href="#" class="social-icon" title="Instagram" target="_blank"><i class="icon-instagram"></i></a>
                                            <a href="#" class="social-icon" title="Pinterest" target="_blank"><i class="icon-pinterest"></i></a>
                                        </div> -->
                                    </div><!-- End .product-details-footer -->
                                </div><!-- End .product-details -->
                            </div><!-- End .col-md-6 -->
                        </div><!-- End .row -->
                    </div><!-- End .product-details-top -->
                </div><!-- End .container -->
            </div><!-- End .page-content -->
        </main><!-- End .main -->

@endsection
@section('script')
    <script src="{{ url('assets/js/jquery.elevateZoom.min.js')}}"></script>
    <script src="{{ url('assets/js/bootstrap-input-spinner.js')}}"></script>

    <script type="text/javascript">
        $('.getSizePrice').change(function() {
            var product_price = {{ $getProduct->price }};
            var price = $('option:selected', this).attr('data-price');
            var total = parseFloat(price);
            $('#getTotalPrice').html(total.toFixed(0).replace(/(\d)(?=(\d{3})+(?!\d))/g, '$1.'));
        });
    </script>
@endsection