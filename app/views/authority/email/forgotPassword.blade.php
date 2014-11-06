<!DOCTYPE html>
<html>

<body>
	<div style="border:1px solid #CCC;background:#F4F4F4;width:100%;text-align:left">
		<div style="height:38px;padding:10px;">
			<h3>时光碎片 密码重置</h3>
		</div>
		<div style="border:none;background:#FCFCFC;padding:20px;color:#333;font-size:14px;">
			<p>亲爱的用户：</p>
			<p>您好！</p>
			<h3></h3>
			<p>请点击以下链接完成密码重置：</p>
			<p>
				<a href="{{ route('reset', $token) }}" target="_blank">{{ route('reset', $token) }}</a>
			</p>
			<p>感谢您的访问，祝您使用愉快！</p>
			<p style="height:20px; border-top:1px solid #CCC"></p>
			<p style="font-size:12px;">
				请注意：此封邮件发送地址只用于通知，不能够接收邮件，请不要直接回复。您收到这封邮件，是由于在 时光碎片 进行了用户密码找回，或用户修改 E-mail 使用 了这个邮箱地址。如果您并没有访问过 时光碎片，或没有进行上述操作，请忽 略这封邮件。您不需要退订或进行其他进一步的操作。
			</p>
		</div>
	</div>

</body>

</html>