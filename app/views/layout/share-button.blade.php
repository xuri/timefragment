<div id="share-button">分享
	<a href="https://www.facebook.com/sharer.php?u={{ URL::current() }}" target="_blank">
		<img title="分享到 Facebook" src="{{ route('home') }}/images/share/Facebook-icon.png" alt="Facebook"/>
	</a>
	<a href="https://twitter.com/share?url={{ URL::current() }}" target="_blank">
		<img title="分享到 Twitter" src="{{ route('home') }}/images/share/Twitter-icon.png" alt="Twitter"/>
	</a>
	<a href="https://plus.google.com/share?url={{ URL::current() }}" target="_blank">
		<img title="分享到 Google+" src="{{ route('home') }}/images/share/Google-plus-icon.png" alt="Google+"/>
	</a>
	<a href="http://reddit.com/submit?url={{ URL::current() }}" target="_blank">
		<img title="分享到 Reddit" src="http://xuri.me/wp-content/uploads/2014/01/Reddit-icon.png" alt="Reddit"/>
	</a>
	<a href="http://www.linkedin.com/shareArticle?mini=true&url={{ URL::current() }}" target="_blank">
		<img title="分享到 LinkedIn" src="{{ route('home') }}/images/share/Linkedin-icon.png" alt="LinkedIn"/>
	</a>
	<a href="http://widget.weibo.com/dialog/PublishWeb.php?default_text=%E5%88%86%E4%BA%AB%E5%86%85%E5%AE%B9%EF%BC%9Ahttp%3A%2F%2Fwww.timefragment.com%2Ftravel%2F17.10.44-db06c78d1e24cf708a14ce81c9b617ec.html%20%EF%BC%88%E6%9D%A5%E8%87%AA%20%40%E6%97%B6%E5%85%89%E7%A2%8E%E7%89%87%E7%BD%91%EF%BC%89&refer=y&language=zh_cn&app_src=2ohpjs&button=pubilish" target="_blank">
		<img title="分享到 新浪微博" src="{{ route('home') }}/images/share/Weibo-icon.png" alt="新浪微博"/>
	</a>
	<a href="http://sns.qzone.qq.com/cgi-bin/qzshare/cgi_qzshare_onekey?url={{ URL::current() }}&showcount=0&desc=&summary=%E6%9D%A5%E8%87%AA%E6%97%B6%E5%85%89%E7%A2%8E%E7%89%87%E7%BD%91&title=%E5%88%86%E4%BA%AB%E5%86%85%E5%AE%B9%EF%BC%9A&site=%E6%97%B6%E5%85%89%E7%A2%8E%E7%89%87&pics=&style=203&width=98&height=22&otype=share" target="_blank">
		<img title="分享到 QQ空间" src="{{ route('home') }}/images/share/Qzone-icon.png" alt="QQ空间"/>
	</a>
	<a href="javascript:void(0)" onclick="modal()">
		<img title="分享到 微信" src="{{ route('home') }}/images/share/Wechat-icon.png" alt="微信"/>
	</a>

</div>

<?php
$modalData['modal'] = array(
    'id'      => 'myModal',
    'title'   => '<script>document.write("<center><img src=\"http://qr.liantu.com/api.php?text="+encodeURI(window.location.href)+"\" /></img></center>");</script>',
    'message' => '<center>打开微信，点击底部的“发现”，使用“扫一扫”即可将网页分享至朋友圈。</center>',
    'footer'  => ''
);
?>
@include('layout.modal', $modalData)
<script>
    function modal(href) {
        $('#myModal').modal();
    }
</script>