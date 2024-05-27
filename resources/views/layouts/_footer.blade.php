<footer class="footer footer-dark">
	<div class="footer-middle">
		<div class="container">
			<div class="row">
				<div class="col-sm-6 col-lg-3">
					<div class="widget widget-about">
						<img src="{{ url('assets/images/tts.png')}}" class="footer-logo" alt="Footer Logo" width="105"
							height="25">
						<p>Praesent dapibus, neque id cursus ucibus, tortor neque egestas augue, eu vulputate magna eros eu erat.
						</p>
					</div><!-- End .widget about-widget -->
				</div><!-- End .col-sm-6 col-lg-3 -->

				<div class="col-sm-6 col-lg-3">
					<div class="widget">
						<h4 class="widget-title">Useful Links</h4><!-- End .widget-title -->

						<ul class="widget-list">
							@if(!empty(Auth::check()))
								<li><a href="{{ url('admin/logout') }}" data-toggle="modal">Logout</a></li>
							@else
								<li><a href="#signin-modal" data-toggle="modal">Log in</a></li>
							@endif
						</ul><!-- End .widget-list -->
					</div><!-- End .widget -->
				</div><!-- End .col-sm-6 col-lg-3 -->

				<div class="col-sm-6 col-lg-3">
					<div class="widget">
						<h4 class="widget-title">Customer Service</h4><!-- End .widget-title -->

						<ul class="widget-list">
							<li><a href="#">Payment Methods</a></li>
						</ul><!-- End .widget-list -->
					</div><!-- End .widget -->
				</div><!-- End .col-sm-6 col-lg-3 -->

				<div class="col-sm-6 col-lg-3">
					<div class="widget">
						<h4 class="widget-title">My Account</h4><!-- End .widget-title -->

						<ul class="widget-list">
							<li><a href="{{ url('cart') }}">View Cart</a></li>
						</ul><!-- End .widget-list -->
					</div><!-- End .widget -->
				</div><!-- End .col-sm-6 col-lg-3 -->
			</div><!-- End .row -->
		</div><!-- End .container -->
	</div><!-- End .footer-middle -->

	<div class="footer-bottom">
		<div class="container">
			<p class="footer-copyright">Copyright © 2024 Tapu Tapi Shop. All Rights Reserved.</p>
			<!-- End .footer-copyright -->
		</div><!-- End .container -->
	</div><!-- End .footer-bottom -->
</footer><!-- End .footer -->