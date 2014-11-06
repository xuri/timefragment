@include('layout.authority-header')
@yield('content')
	<body class="dark">
		<div id="fb-root"></div>
		<header>
		@include('layout.navigation')
		@yield('content')
		</header>

		<form id="signupForm" method="post" action="/signup" class="" autocomplete="off" data-reservation-mode="" data-auto-submit="" data-user="" data-signup-redirect="" >
			<h1>账号激活成功</h1>
			<fieldset id="message" class="message">
				<p class="center">欢迎加入时光碎片</p></fieldset>
			<fieldset id="quotes">
				<p>时光不老，我们不散
					<cite>&ndash; TimeFragment</cite>
				</p>
			</fieldset>
		</form>

	</body>
</html>