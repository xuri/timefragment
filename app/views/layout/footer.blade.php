		{{-- Back to top --}}
		<a href="#" id="back-top"><i class="fa fa-angle-up fa-2x"></i></a>

		<footer class="text-center">
			<div class="social-icon">
				<a href="https://www.facebook.com/timebelief" target="_blank" title="关注时光碎片网Facebook专页" alt="关注时光碎片网Facebook专页">
					<i class="fa fa-facebook fa-3x"></i>
				</a>
				<a href="https://twitter.com/timefragment" target="_blank" title="关注时光碎片网的官方Twitter" alt="关注时光碎片网的官方Twitter">
					<i class="fa fa-twitter fa-3x"></i>
				</a>
				<a href="https://plus.google.com/110276394392356638418/" target="_blank" title="关注时光碎片网Google+" alt="关注时光碎片网Google+">
					<i class="fa fa-google-plus fa-3x"></i>
				</a>
				<a href="http://weibo.com/timebelief" target="_blank" title="关注时光碎片网新浪官方微博" alt="关注时光碎片网新浪官方微博">
					<i class="fa fa-weibo fa-3x"></i>
				</a>
			</div>
			<div class="copyright">
				Copyright &copy; 2013 - <?php echo date('Y');?> <a href="{{ route('home') }}" target="_blank">TimeFragment.com</a> All rights reserved. <a href="{{ route('home') }}" target="_blank">关于我们</a> | <a href="{{ route('home') }}" target="_blank">合作伙伴</a> | <a href="{{ route('home') }}" target="_blank">联系我们</a> | <a href="{{ route('home') }}/article/users-terms.html" target="_blank">服务条款</a> | <a href="{{ route('home') }}/article/users-privacy.html" target="_blank">隐私权政策</a>
			</div>
		</footer>

		{{-- Js Library --}}

		{{ script('jquery-2.1.1') }}

		{{ HTML::script('assets/js/jquery/jquery.sticky.js') }}
		{{ HTML::script('assets/js/jquery/jquery.fitvids.js') }}
		{{ HTML::script('assets/js/jquery/jquery.easing-1.3.pack.js') }}
		{{ HTML::script('assets/js/jquery/jquery.parallax-1.1.3.js') }}
		{{ HTML::script('assets/js/jquery/jquery-countTo.js') }}
		{{ HTML::script('assets/js/jquery/jquery.appear.js') }}
		{{ HTML::script('assets/js/jquery/jquery.easy-pie-chart.js') }}
		{{ HTML::script('assets/js/jquery/jquery.cycle.all.js') }}
		{{ HTML::script('assets/js/jquery/jquery.maximage.js') }}
		{{ HTML::script('assets/js/jquery/jquery.isotope.min.js') }}
		{{ HTML::script('assets/js/jquery/jquery.hoverdir.js') }}
		{{ HTML::script('assets/js/jquery/jquery.validate.min.js') }}

		{{ script('flexslider-2.2') }}
		{{ script('bootstrap-3.0.3') }}

		{{-- HTML::script('assets/js/eldarion-ajax.min.js') --}}

		{{ HTML::script('assets/js/bootstrap-modal.js') }}
		{{ script('modernizr-2.8.1') }}
		{{ HTML::script('assets/js/skrollr.js') }}
		{{ HTML::script('assets/js/portfolio_custom.js') }}
		{{ HTML::script('assets/js/script.js') }}
		{{ HTML::script('assets/js/retina-1.3.0.min.js') }}
		{{ HTML::script('assets/js/wb.js') }}

		{{-- Js Library --}}

		@include('system.analitycs')
    	@yield('content')
	</body>
</html>