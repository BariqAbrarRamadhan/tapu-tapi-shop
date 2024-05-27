@extends('layouts.app')
@section('style')

@endsection
@section('content')

<main class="main">
    <div class="page-header text-center" style="background-image: url('assets/images/page-header-bg.jpg')">
        <div class="container">
            <h1 class="page-title">Checkout<span>Shop</span></h1>
        </div><!-- End .container -->
    </div><!-- End .page-header -->
    <nav aria-label="breadcrumb" class="breadcrumb-nav">
        <div class="container">
            <form id="checkout-form" action="{{ url('checkout/place_order') }}" method="post">
                {{ csrf_field() }}
                <div class="row">
                    <div class="col-lg-9">
                        <h2 class="checkout-title">Billing Details</h2><!-- End .checkout-title -->

                        <label>Name *</label>
                        <input type="text" name="name" class="form-control" required>

                        <label>Street address *</label>
                        <input type="text" name="address" class="form-control" placeholder="House number and Street name" required>

                        <label>Phone *</label>
                        <input type="tel" name="phone" class="form-control" required>

                        <label>Email address *</label>
                        <input type="email" name="email" id="email" class="form-control" required>
                    </div><!-- End .col-lg-9 -->
                    <aside class="col-lg-3">
                        <div class="summary">
                            <h3 class="summary-title">Your Order</h3><!-- End .summary-title -->

                            <table class="table table-summary">
                                <thead>
                                    <tr>
                                        <th>Product</th>
                                        <th>Total</th>
                                    </tr>
                                </thead>

                                <tbody>
                                    @foreach(Cart::getContent() as $key => $cart)
                                    @php
                                    $getCartProduct = App\Models\ProductModel::getSingle($cart->id)
                                    @endphp
                                    <tr>
                                        <td><a href="{{ url('$getCartProduct->slug') }}">{{ $getCartProduct->title }}</a></td>
                                        <td>Rp. {{ number_format($cart->price * $cart->quantity, 0, ',', '.') }}</td>
                                    </tr>
                                    @endforeach
                                    <tr class="summary-subtotal">
                                        <td>Subtotal:</td>
                                        <td>Rp. {{ number_format(Cart::getSubTotal(), 0, ',', '.') }}</td>
                                    </tr>
                                    <tr class="summary-total">
                                        <td>Total:</td>
                                        <td><span id="getPayableTotal">Rp. {{ number_format(Cart::getSubTotal(), 0, ',', '.') }}</span></td>
                                    </tr><!-- End .summary-total -->
                                </tbody>
                            </table><!-- End .table table-summary -->
                            <input type="hidden" id="getShippingChargeTotal" value="0">
                            <input type="hidden" id="PayableTotal" value="{{ Cart::getSubTotal() }}">
                            <div class="custom-control custom-radio">
                                <input type="radio" value="cod" id="Cashondelivey" required name="payment_method" class="custom-control-input">
                                <label class="custom-control-label" for="Cashondelivey">Cash On Delivery</label>
                            </div>
                            <div class="custom-control custom-radio">
                                <input type="radio" value="debit" id="Debitcard" required name="payment_method" class="custom-control-input">
                                <label class="custom-control-label" for="Debitcard">Kartu Debit</label>
                            </div>
                            <div class="accordion-summary" id="accordion-payment">
                            </div><!-- End .card -->
                        </div><!-- End .accordion -->
                        
                        <button type="submit" class="btn btn-outline-primary-2 btn-order btn-block" id="place-order-button">
                            <span class="btn-text">Place Order</span>
                            <span class="btn-hover-text">Proceed to Checkout</span>
                        </button>
                    </aside><!-- End .col-lg-3 -->
                </div><!-- End .row -->
            </form>
        </div><!-- End .container -->
    </nav><!-- End .breadcrumb-nav -->
</main><!-- End .main -->

@endsection
@section('script')
<script type="text/javascript">
    $('body').on('change', '.getShippingCharge', function () {
        var price = parseFloat($(this).data('price'));
        var subtotal = {{ Cart::getSubTotal() }};
        $('#getShippingChargeTotal').val(price);
        var total = subtotal + price;
        $('#getPayableTotal').html('Rp. ' + total.toLocaleString('id-ID'));
        console.log(price);
        console.log(total);
    });

    document.getElementById('place-order-button').addEventListener('click', function(e) {
        e.preventDefault();
        var email = document.getElementById('email').value;
        var whatsappLink = "https://api.whatsapp.com/send?phone=6287842235265&text=Saya%20ingin%20mengonfirmasi%20pembelian%20terbaru%20saya%20dengan%20email%20" + encodeURIComponent(email);
        window.open(whatsappLink, '_blank');
        document.getElementById('checkout-form').submit();
        
    });
</script>

@endsection
