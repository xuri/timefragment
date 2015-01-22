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
				<p>Copyright &copy; <?php echo date('Y');?> <a href="{{ route('home') }}" target="_blank">TimeFragment.com</a> All rights reserved. ♥ Lovingly made by <a href="https://xuri.me" target="_blank">Luxurioust</a> <a href="http://www.miitbeian.gov.cn/" target="_blank">黑ICP备14007596号-2</a></p>
				<p>
					<a href="{{ route('home') }}" target="_blank">关于我们</a> | <a href="{{ route('home') }}" target="_blank">合作伙伴</a> | <a href="{{ route('home') }}" target="_blank">联系我们</a> | <a href="{{ route('home') }}/article/users-terms.html" target="_blank">服务条款</a> | <a href="{{ route('home') }}/article/users-privacy.html" target="_blank">隐私权政策</a><a  key ="54bdad2defbfb01423063308"  logo_size="83x30"  logo_type="personal"  href="http://www.anquan.org" ><script src="http://static.anquan.org/static/outer/js/aq_auth.js"></script></a>
				</p>
			</div>
		</footer>

		{{-- Js Library --}}

		{{ Minify::javascript(array(
			'/assets/js/jquery/jquery.sticky.js',
			'/assets/js/jquery/jquery.fitvids.js',
			'/assets/js/jquery/jquery.easing-1.3.pack.js',
			'/assets/js/jquery/jquery.parallax-1.1.3.js',
			'/assets/js/jquery/jquery-countTo.js',
			'/assets/js/jquery/jquery.appear.js',
			'/assets/js/jquery/jquery.easy-pie-chart.js',
			'/assets/js/jquery/jquery.cycle.all.js',
			'/assets/js/jquery/jquery.maximage.js',
			'/assets/js/jquery/jquery.isotope.js',
			'/assets/js/jquery/jquery.hoverdir.js',
			'/assets/js/jquery/jquery.validate.js',

			'/assets/flexslider-2.2/jquery.flexslider-min.js',
			'/assets/bootstrap-3.3.1/js/bootstrap.min.js',

			'/assets/js/bootstrap-modal.min.js',
			'/assets/modernizr-2.8.1/modernizr-2.8.1.min.js',
			'/assets/js/skrollr.min.js',
			'/assets/js/portfolio_custom.min.js',
			'/assets/js/script.min.js',
			'/assets/js/retina-1.3.0.min.js'

		)) }}

		{{-- Js Library --}}

		@include('system.analitycs')
    	@yield('content')
	</body>
</html>