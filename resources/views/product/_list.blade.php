
<div class="products mb-3">
						<div class="row justify-content-center">
							@foreach($getProduct as $value)
							@php
							$getProductImage = $value->getImageSingle($value->id);
							@endphp
							<div class="col-12 col-md-4 col-lg-4">
								<div class="product product-7 text-center">
									<figure class="product-media">
										<a href="{{ url($value->slug) }}">
											@if(!empty($getProductImage) && !empty($getProductImage->getLogo()))
											<img stytle="height: 280px; width: 100%; object-fit: cover;" src="{{$getProductImage->getLogo()}}" alt="{{$value->title}}" class="product-image">
											@endif
									</figure><!-- End .product-media -->

									<div class="product-body">
										<div class="product-cat">
											<a href="{{ url($value->category_slug . '/' . $value->sub_category_slug) }}">{{ $value->sub_category_name }}</a>
										</div><!-- End .product-cat -->
										<h3 class="product-title"><a href="{{ url($value->slug) }}">{{ $value->title }}</a></h3><!-- End .product-title -->
										<div class="product-price">
											Rp. {{ number_format($value->price, 0, ',', '.') }}
										</div><!-- End .product-price -->
									</div><!-- End .product-body -->
								</div><!-- End .product -->
							</div><!-- End .col-sm-6 col-lg-4 -->
							@endforeach
						</div><!-- End .row -->
					</div><!-- End .products -->
						