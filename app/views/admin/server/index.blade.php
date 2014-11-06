<?php
error_reporting(0); // Suppress All Error Messages
@header("content-Type: text/html; charset=utf-8"); // Language compulsory
ob_start();
date_default_timezone_set('Asia/Shanghai');// This sentence is used to eliminate the time difference
define('HTTP_HOST', preg_replace('~^www\.~i', '', $_SERVER['HTTP_HOST']));
$time_start = microtime_float();
function GetCoreInformation() {$data = file('/proc/stat');$cores = array();foreach( $data as $line ) {if( preg_match('/^cpu[0-9]/', $line) ){$info = explode(' ', $line);$cores[]=array('user'=>$info[1],'nice'=>$info[2],'sys' => $info[3],'idle'=>$info[4],'iowait'=>$info[5],'irq' => $info[6],'softirq' => $info[7]);}}return $cores;}
function GetCpuPercentages($stat1, $stat2) {if(count($stat1)!==count($stat2)){return;}$cpus=array();for( $i = 0, $l = count($stat1); $i < $l; $i++) {   $dif = array(); $dif['user'] = $stat2[$i]['user'] - $stat1[$i]['user'];$dif['nice'] = $stat2[$i]['nice'] - $stat1[$i]['nice'];  $dif['sys'] = $stat2[$i]['sys'] - $stat1[$i]['sys'];$dif['idle'] = $stat2[$i]['idle'] - $stat1[$i]['idle'];$dif['iowait'] = $stat2[$i]['iowait'] - $stat1[$i]['iowait'];$dif['irq'] = $stat2[$i]['irq'] - $stat1[$i]['irq'];$dif['softirq'] = $stat2[$i]['softirq'] - $stat1[$i]['softirq'];$total = array_sum($dif);$cpu = array();foreach($dif as $x=>$y) $cpu[$x] = round($y / $total * 100, 2);$cpus['cpu' . $i] = $cpu;}return $cpus;}
$stat1 = GetCoreInformation();sleep(1);$stat2 = GetCoreInformation();$data = GetCpuPercentages($stat1, $stat2);
$cpu_show = $data['cpu0']['user']."%us,  ".$data['cpu0']['sys']."%sy,  ".$data['cpu0']['nice']."%ni, ".$data['cpu0']['idle']."%id,  ".$data['cpu0']['iowait']."%wa,  ".$data['cpu0']['irq']."%irq,  ".$data['cpu0']['softirq']."%softirq";
// CPU-related information obtained in accordance with the different systems
switch(PHP_OS)
{
	case "Linux":
		$sysReShow = (false !== ($sysInfo = sys_linux()))?"show":"none";
	break;
	case "FreeBSD":
		$sysReShow = (false !== ($sysInfo = sys_freebsd()))?"show":"none";
	break;
/*
	case "WINNT":
		$sysReShow = (false !== ($sysInfo = sys_windows()))?"show":"none";
	break;
*/
	default:
	break;
}
$uptime = $sysInfo['uptime']; // Online Time
$stime = date('Y-m-d H:i:s'); // Current System Time
// HDD
$dt = round(@disk_total_space(".")/(1024*1024*1024),3); // Total
$df = round(@disk_free_space(".")/(1024*1024*1024),3); // Available
$du = $dt-$df; // Usage
$hdPercent = (floatval($dt)!=0)?round($du/$dt*100,2):0;
$load = $sysInfo['loadAvg'];    // System Load
// Determine if the memory is less than 1G, on display M, otherwise display G Unit.
if($sysInfo['memTotal']<1024)
{
	$memTotal = $sysInfo['memTotal']." M";
	$mt = $sysInfo['memTotal']." M";
	$mu = $sysInfo['memUsed']." M";
	$mf = $sysInfo['memFree']." M";
	$mc = $sysInfo['memCached']." M";   // Cached Memory
	$mb = $sysInfo['memBuffers']." M";  // Cache
	$st = $sysInfo['swapTotal']." M";
	$su = $sysInfo['swapUsed']." M";
	$sf = $sysInfo['swapFree']." M";
	$swapPercent = $sysInfo['swapPercent'];
	$memRealUsed = $sysInfo['memRealUsed']." M"; // Real Memory Usage
	$memRealFree = $sysInfo['memRealFree']." M"; // Real Memory Free
	$memRealPercent = $sysInfo['memRealPercent']; // Real Memory Usage Ratio
	$memPercent = $sysInfo['memPercent']; // Total Memory Usage Ratio
	$memCachedPercent = $sysInfo['memCachedPercent']; // Cached Memory Usage Ratio
}
else
{
	$memTotal = round($sysInfo['memTotal']/1024,3)." G";
	$mt = round($sysInfo['memTotal']/1024,3)." G";
	$mu = round($sysInfo['memUsed']/1024,3)." G";
	$mf = round($sysInfo['memFree']/1024,3)." G";
	$mc = round($sysInfo['memCached']/1024,3)." G";
	$mb = round($sysInfo['memBuffers']/1024,3)." G";
	$st = round($sysInfo['swapTotal']/1024,3)." G";
	$su = round($sysInfo['swapUsed']/1024,3)." G";
	$sf = round($sysInfo['swapFree']/1024,3)." G";
	$swapPercent = $sysInfo['swapPercent'];
	$memRealUsed = round($sysInfo['memRealUsed']/1024,3)." G"; // Real Memory Usage
	$memRealFree = round($sysInfo['memRealFree']/1024,3)." G"; // Real Memory Free
	$memRealPercent = $sysInfo['memRealPercent']; // Real Memory Usage Ratio
	$memPercent = $sysInfo['memPercent']; // Total Memory Usage Ratio
	$memCachedPercent = $sysInfo['memCachedPercent']; // Cached Memory Usage Ratio
}
// LAN Traffic
$strs = @file("/proc/net/dev");
for ($i = 2; $i < count($strs); $i++ )
{
	preg_match_all( "/([^\s]+):[\s]{0,}(\d+)\s+(\d+)\s+(\d+)\s+(\d+)\s+(\d+)\s+(\d+)\s+(\d+)\s+(\d+)\s+(\d+)\s+(\d+)\s+(\d+)/", $strs[$i], $info );
	$NetOutSpeed[$i] = $info[10][0];
	$NetInputSpeed[$i] = $info[2][0];
	$NetInput[$i] = formatsize($info[2][0]);
	$NetOut[$i]  = formatsize($info[10][0]);
}
// Ajax Call Real-time Refresh
if ($_GET['act'] == "rt")
{
	$arr=array('useSpace'=>"$du",'freeSpace'=>"$df",'hdPercent'=>"$hdPercent",'barhdPercent'=>"$hdPercent%",'TotalMemory'=>"$mt",'UsedMemory'=>"$mu",'FreeMemory'=>"$mf",'CachedMemory'=>"$mc",'Buffers'=>"$mb",'TotalSwap'=>"$st",'swapUsed'=>"$su",'swapFree'=>"$sf",'loadAvg'=>"$load",'uptime'=>"$uptime",'freetime'=>"$freetime",'bjtime'=>"$bjtime",'stime'=>"$stime",'memRealPercent'=>"$memRealPercent",'memRealUsed'=>"$memRealUsed",'memRealFree'=>"$memRealFree",'memPercent'=>"$memPercent%",'memCachedPercent'=>"$memCachedPercent",'barmemCachedPercent'=>"$memCachedPercent%",'swapPercent'=>"$swapPercent",'barmemRealPercent'=>"$memRealPercent%",'barswapPercent'=>"$swapPercent%",'NetOut2'=>"$NetOut[2]",'NetOut3'=>"$NetOut[3]",'NetOut4'=>"$NetOut[4]",'NetOut5'=>"$NetOut[5]",'NetOut6'=>"$NetOut[6]",'NetOut7'=>"$NetOut[7]",'NetOut8'=>"$NetOut[8]",'NetOut9'=>"$NetOut[9]",'NetOut10'=>"$NetOut[10]",'NetInput2'=>"$NetInput[2]",'NetInput3'=>"$NetInput[3]",'NetInput4'=>"$NetInput[4]",'NetInput5'=>"$NetInput[5]",'NetInput6'=>"$NetInput[6]",'NetInput7'=>"$NetInput[7]",'NetInput8'=>"$NetInput[8]",'NetInput9'=>"$NetInput[9]",'NetInput10'=>"$NetInput[10]",'NetOutSpeed2'=>"$NetOutSpeed[2]",'NetOutSpeed3'=>"$NetOutSpeed[3]",'NetOutSpeed4'=>"$NetOutSpeed[4]",'NetOutSpeed5'=>"$NetOutSpeed[5]",'NetInputSpeed2'=>"$NetInputSpeed[2]",'NetInputSpeed3'=>"$NetInputSpeed[3]",'NetInputSpeed4'=>"$NetInputSpeed[4]",'NetInputSpeed5'=>"$NetInputSpeed[5]");
	$jarr=json_encode($arr);
	$_GET['callback'] = htmlspecialchars($_GET['callback']);
	echo $_GET['callback'],'(',$jarr,')';
	exit;
}
?>
@include('layout.account-header')
@yield('content')
<script>
$(document).ready(function(){getJSONData();});
var OutSpeed2=<?php echo floor($NetOutSpeed[2]) ?>;
var OutSpeed3=<?php echo floor($NetOutSpeed[3]) ?>;
var OutSpeed4=<?php echo floor($NetOutSpeed[4]) ?>;
var OutSpeed5=<?php echo floor($NetOutSpeed[5]) ?>;
var InputSpeed2=<?php echo floor($NetInputSpeed[2]) ?>;
var InputSpeed3=<?php echo floor($NetInputSpeed[3]) ?>;
var InputSpeed4=<?php echo floor($NetInputSpeed[4]) ?>;
var InputSpeed5=<?php echo floor($NetInputSpeed[5]) ?>;
function getJSONData()
{
	setTimeout("getJSONData()", 1000);
	$.getJSON('?act=rt&callback=?', displayData);
}
function ForDight(Dight,How)
{
  if (Dight<0){
	var Last=0+"B/s";
  }else if (Dight<1024){
	var Last=Math.round(Dight*Math.pow(10,How))/Math.pow(10,How)+"B/s";
  }else if (Dight<1048576){
	Dight=Dight/1024;
	var Last=Math.round(Dight*Math.pow(10,How))/Math.pow(10,How)+"K/s";
  }else{
	Dight=Dight/1048576;
	var Last=Math.round(Dight*Math.pow(10,How))/Math.pow(10,How)+"M/s";
  }
	return Last;
}
function displayData(dataJSON)
{
	$("#useSpace").html(dataJSON.useSpace);
	$("#freeSpace").html(dataJSON.freeSpace);
	$("#hdPercent").html(dataJSON.hdPercent);
	$("#barhdPercent").width(dataJSON.barhdPercent);
	$("#TotalMemory").html(dataJSON.TotalMemory);
	$("#UsedMemory").html(dataJSON.UsedMemory);
	$("#FreeMemory").html(dataJSON.FreeMemory);
	$("#CachedMemory").html(dataJSON.CachedMemory);
	$("#Buffers").html(dataJSON.Buffers);
	$("#TotalSwap").html(dataJSON.TotalSwap);
	$("#swapUsed").html(dataJSON.swapUsed);
	$("#swapFree").html(dataJSON.swapFree);
	$("#swapPercent").html(dataJSON.swapPercent);
	$("#loadAvg").html(dataJSON.loadAvg);
	$("#uptime").html(dataJSON.uptime);
	$("#freetime").html(dataJSON.freetime);
	$("#stime").html(dataJSON.stime);
	$("#bjtime").html(dataJSON.bjtime);
	$("#memRealUsed").html(dataJSON.memRealUsed);
	$("#memRealFree").html(dataJSON.memRealFree);
	$("#memRealPercent").html(dataJSON.memRealPercent);
	$("#memPercent").html(dataJSON.memPercent);
	$("#barmemPercent").width(dataJSON.memPercent);
	$("#barmemRealPercent").width(dataJSON.barmemRealPercent);
	$("#memCachedPercent").html(dataJSON.memCachedPercent);
	$("#barmemCachedPercent").width(dataJSON.barmemCachedPercent);
	$("#barswapPercent").width(dataJSON.barswapPercent);
	$("#NetOut2").html(dataJSON.NetOut2);
	$("#NetOut3").html(dataJSON.NetOut3);
	$("#NetOut4").html(dataJSON.NetOut4);
	$("#NetOut5").html(dataJSON.NetOut5);
	$("#NetOut6").html(dataJSON.NetOut6);
	$("#NetOut7").html(dataJSON.NetOut7);
	$("#NetOut8").html(dataJSON.NetOut8);
	$("#NetOut9").html(dataJSON.NetOut9);
	$("#NetOut10").html(dataJSON.NetOut10);
	$("#NetInput2").html(dataJSON.NetInput2);
	$("#NetInput3").html(dataJSON.NetInput3);
	$("#NetInput4").html(dataJSON.NetInput4);
	$("#NetInput5").html(dataJSON.NetInput5);
	$("#NetInput6").html(dataJSON.NetInput6);
	$("#NetInput7").html(dataJSON.NetInput7);
	$("#NetInput8").html(dataJSON.NetInput8);
	$("#NetInput9").html(dataJSON.NetInput9);
	$("#NetInput10").html(dataJSON.NetInput10);
	$("#NetOutSpeed2").html(ForDight((dataJSON.NetOutSpeed2-OutSpeed2),3)); OutSpeed2=dataJSON.NetOutSpeed2;
	$("#NetOutSpeed3").html(ForDight((dataJSON.NetOutSpeed3-OutSpeed3),3)); OutSpeed3=dataJSON.NetOutSpeed3;
	$("#NetOutSpeed4").html(ForDight((dataJSON.NetOutSpeed4-OutSpeed4),3)); OutSpeed4=dataJSON.NetOutSpeed4;
	$("#NetOutSpeed5").html(ForDight((dataJSON.NetOutSpeed5-OutSpeed5),3)); OutSpeed5=dataJSON.NetOutSpeed5;
	$("#NetInputSpeed2").html(ForDight((dataJSON.NetInputSpeed2-InputSpeed2),3));   InputSpeed2=dataJSON.NetInputSpeed2;
	$("#NetInputSpeed3").html(ForDight((dataJSON.NetInputSpeed3-InputSpeed3),3));   InputSpeed3=dataJSON.NetInputSpeed3;
	$("#NetInputSpeed4").html(ForDight((dataJSON.NetInputSpeed4-InputSpeed4),3));   InputSpeed4=dataJSON.NetInputSpeed4;
	$("#NetInputSpeed5").html(ForDight((dataJSON.NetInputSpeed5-InputSpeed5),3));   InputSpeed5=dataJSON.NetInputSpeed5;
}
</script>
<body class="bg-gray-light">
	@include('layout.admin-navigation')
	@yield('content')
	@include('layout.admin-sidebar')
	@yield('content')
	<div class="preloader">
		<div class="timer"></div>
	</div>
	<div id="container" class="main-content p-30 tp-t-60 tp-lr-10">
		<button class="menu-btn btn btn-bordered text-gray-alt text-bold top-left-corner">&#9776; 菜单</button>
		<div class="row">
			<div class="col-sm-12">
				<div class="bg-white p-tb-30">
					<div class="btn-group">
						<div class="iconmelon m-r-10 m-l-30">
							<svg viewBox="0 0 32 32">
								<g filter="">
									<use xlink:href="#speech-talk-user"></use>
								</g>
							</svg>
						</div>
						<span class="text-gray-dark text-large align-with-button m-r-30">
							{{ $resourceName }}运行状态
						</span>
					</div>
					<div class="pull-right m-r-30 mail-nav text-gray">
							<?php $run_time = sprintf('%0.4f', microtime_float() - $time_start);?>Processed in <?php echo $run_time?> seconds. <?php echo memory_usage();?> memory usage.
					</div>
					<div class="p-lr-30 p-tb-10 pm-lr-10">
						@include('layout.notification')
					</div>
					<div class="p-lr-30 p-tb-10 pm-lr-10">
							<ul class="nav nav-tabs">
								<li class="active">
									<a href="#tab-general" data-toggle="tab">
										<div class="text-small">Server Info</div>
										<span class="text-uppercase">{{ $resourceName }}参数</span>
									</a>
								</li>
								<li>
									<a href="#php" data-toggle="tab">
										<div class="text-small">PHP Info</div>
										<span class="text-uppercase">PHP参数</span>
									</a>
								</li>
								<li>
									<a href="#module" data-toggle="tab">
										<div class="text-small">Module Support</div>
										<span class="text-uppercase">组件支持</span>
									</a>
								</li>
								<li>
									<a href="#database" data-toggle="tab">
										<div class="text-small">Database Support</div>
										<span class="text-uppercase">数据库支持</span>
									</a>
								</li>
							</ul>
							<form class="form-horizontal"  autocomplete="off" style="padding:1em;border:1px solid #ddd;border-top:0;">
							{{-- Tabs Content --}}
							<div class="tab-content">
								{{-- General tab --}}
								<div class="tab-pane active fade in" id="tab-general" style="margin:0 1em;">
									<div class="table-responsive p-tb-10">
										<table class="table table-striped table-bordered table-hover">
											<tr>
												<td width="15%">{{ $resourceName }}域名/IP地址</td>
												<td><?php echo @get_current_user();?> - <?php echo $_SERVER['SERVER_NAME'];?>(<?php if('/'==DIRECTORY_SEPARATOR){echo $_SERVER['SERVER_ADDR'];}else{echo @gethostbyname($_SERVER['SERVER_NAME']);} ?>)&nbsp;&nbsp;你的IP地址是：<?php echo @$_SERVER['REMOTE_ADDR'];?></td>
											</tr>
											<tr>
												<td>{{ $resourceName }}标识</td>
												<td><?php if($sysInfo['win_n'] != ''){echo $sysInfo['win_n'];}else{echo @php_uname();};?></td>
											</tr>
											<tr>
												<td>{{ $resourceName }}操作系统</td>
												<td><?php $os = explode(" ", php_uname()); echo $os[0];?> &nbsp;内核版本：<?php if('/'==DIRECTORY_SEPARATOR){echo $os[2];}else{echo $os[1];} ?></td>
											</tr>
											<tr>
												<td>{{ $resourceName }}解译引擎</td>
												<td><?php echo $_SERVER['SERVER_SOFTWARE'];?></td>
											</tr>
											<tr>
												<td>{{ $resourceName }}语言</td>
												<td><?php echo getenv("HTTP_ACCEPT_LANGUAGE");?></td>
											</tr>
											<tr>
												<td>{{ $resourceName }}端口</td>
												<td><?php echo $_SERVER['SERVER_PORT'];?></td>
											</tr>
											<tr>
												<td>{{ $resourceName }}主机名</td>
												<td><?php if('/'==DIRECTORY_SEPARATOR ){echo $os[1];}else{echo $os[2];} ?></td>
											</tr>
											<tr>
												<td>绝对路径</td>
												<td><?php echo $_SERVER['DOCUMENT_ROOT']?str_replace('\\','/',$_SERVER['DOCUMENT_ROOT']):str_replace('\\','/',dirname(__FILE__));?></td>
											</tr>
											<tr>
												<td>管理员邮箱</td>
												<td><?php echo $_SERVER['SERVER_ADMIN'];?></td>
											</tr>
											<tr>
												<td>探针路径</td>
												<td><?php echo str_replace('\\','/',__FILE__)?str_replace('\\','/',__FILE__):$_SERVER['SCRIPT_FILENAME'];?></td>
											</tr>
										</table>
										<?if("show"==$sysReShow){?>
										<table class="table table-striped table-bordered table-hover">
											<tr>
												<th colspan="2">{{ $resourceName }}实时数据</th>
											</tr>
											<tr>
												<td width="15%">{{ $resourceName }}当前时间</td>
												<td><span id="stime"><?php echo $stime;?></span>
												</td>
											</tr>
											<tr>
												<td>{{ $resourceName }}已运行时间</td>
												<td><span id="uptime"><?php echo $uptime;?></span>
												</td>
											</tr>
											<tr>
												<td>CPU型号 [<?php echo $sysInfo['cpu']['num'];?>核]</td>
												<td><?php echo $sysInfo['cpu']['model'];?></td>
											</tr>
											<tr>
												<td>CPU使用状况</td>
												<td><?php if('/'==DIRECTORY_SEPARATOR){echo $cpu_show." ";}else{echo "暂时只支持Linux系统";}?>
												</td>
											</tr>
											<tr>
												<td>硬盘使用状况</td>
												<td>
													总空间 <?php echo $dt;?>&nbsp;G，
													已用 <font color='#333333'><span id="useSpace"><?php echo $du;?></span></font>&nbsp;G，
													空闲 <font color='#333333'><span id="freeSpace"><?php echo $df;?></span></font>&nbsp;G，
													使用率 <span id="hdPercent"><?php echo $hdPercent;?></span>%

													<div class="progress progress-striped" style="margin: 10px 0 5px 0;">
														<div class="progress-bar progress-bar-info" role="progressbar" aria-valuenow="<?php echo $hdPercent;?>" aria-valuemin="0" aria-valuemax="100" style="width:<?php echo $hdPercent;?>%">
															<span class="sr-only"><?php echo $hdPercent;?>% Complete (success)</span>
														</div>
													</div>
												</td>
											</tr>
											<tr>
												<td>内存使用状况</td>
												<td>
													<?php
													$tmp = array(
														'memTotal', 'memUsed', 'memFree', 'memPercent',
														'memCached', 'memRealPercent',
														'swapTotal', 'swapUsed', 'swapFree', 'swapPercent'
													);
													foreach ($tmp AS $v) {
														$sysInfo[$v] = $sysInfo[$v] ? $sysInfo[$v] : 0;
													}
													?>
													物理内存：共
													<font color='#CC0000'><?php echo $memTotal;?> </font>
													, 已用
													<font color='#CC0000'><span id="UsedMemory"><?php echo $mu;?></span></font>
													, 空闲
													<font color='#CC0000'><span id="FreeMemory"><?php echo $mf;?></span></font>
													, 使用率
													<span id="memPercent"><?php echo $memPercent;?></span>
													<div class="progress progress-striped" style="margin: 10px 0 5px 0;">
														<div class="progress-bar progress-bar-success" role="progressbar" aria-valuenow="<?php echo $memPercent?>" aria-valuemin="0" aria-valuemax="100" style="width:<?php echo $memPercent?>%">
															<span class="sr-only"><?php echo $memPercent?>% Complete (success)</span>
														</div>
													</div>
													<?php
													// Determine if the cache is 0, don't show
													if($sysInfo[ 'memCached']>0) { ?> Cache化内存为 <span id="CachedMemory"><?php echo $mc;?></span>
													, 使用率
													<span id="memCachedPercent"><?php echo $memCachedPercent;?></span>
													% | Buffers缓冲为 <span id="Buffers"><?php echo $mb;?></span>
													<div class="progress progress-striped" style="margin: 10px 0 5px 0;">
														<div class="progress-bar progress-bar-success" role="progressbar" aria-valuenow="<?php echo $memCachedPercent?>" aria-valuemin="0" aria-valuemax="100" style="width:<?php echo $memCachedPercent?>%">
															<span class="sr-only"><?php echo $memCachedPercent?>% Complete (success)</span>
														</div>
													</div>
													真实内存使用
													<span id="memRealUsed"><?php echo $memRealUsed;?></span>
													, 真实内存空闲
													<span id="memRealFree"><?php echo $memRealFree;?></span>
													, 使用率
													<span id="memRealPercent"><?php echo $memRealPercent;?></span>
													%
													<div class="progress progress-striped" style="margin: 10px 0 5px 0;">
														<div class="progress-bar progress-bar-success" role="progressbar" aria-valuenow="<?php echo $memRealPercent?>" aria-valuemin="0" aria-valuemax="100" style="width:<?php echo $memRealPercent?>%">
															<span class="sr-only"><?php echo $memRealPercent?>% Complete (success)</span>
														</div>
													</div>
													<?php }
													// Determine if the SWAP is 0, don't show
													if($sysInfo[ 'swapTotal']>0)
													{
													?>
													SWAP区：共
													<?php echo $st;?>, 已使用
													<span id="swapUsed"><?php echo $su;?></span>
													, 空闲
													<span id="swapFree"><?php echo $sf;?></span>
													, 使用率
													<span id="swapPercent"><?php echo $swapPercent;?></span>
													%
													<div class="progress progress-striped" style="margin: 10px 0 5px 0;">
														<div class="progress-bar progress-bar-success" role="progressbar" aria-valuenow="<?php echo $swapPercent?>" aria-valuemin="0" aria-valuemax="100" style="width:<?php echo $swapPercent?>%">
															<span class="sr-only"><?php echo $swapPercent?>% Complete (success)</span>
														</div>
													</div>
													<?php } ?>
												</td>
											</tr>
											<tr>
												<td>系统平均负载</td>
												<td class="w_number"><span id="loadAvg"><?php echo $load;?></span>
												</td>
											</tr>
										</table>
										<?}?>
										<?php if (false !== ($strs = @file("/proc/net/dev"))) : ?>
										<table class="table table-striped table-bordered table-hover">
											<tr><th colspan="5">网络使用状况</th></tr>
											<?php for ($i = 2; $i < count($strs); $i++ ) : ?>
											<?php preg_match_all( "/([^\s]+):[\s]{0,}(\d+)\s+(\d+)\s+(\d+)\s+(\d+)\s+(\d+)\s+(\d+)\s+(\d+)\s+(\d+)\s+(\d+)\s+(\d+)\s+(\d+)/", $strs[$i], $info );?>
											<tr>
												<td><?php echo $info[1][0]?> : </td>
												<td width="29%">入网: <font color='#CC0000'><span id="NetInput<?php echo $i?>"><?php echo $NetInput[$i]?></span></font></td>
												<td width="14%">实时: <font color='#CC0000'><span id="NetInputSpeed<?php echo $i?>">0B/s</span></font></td>
												<td width="29%">出网: <font color='#CC0000'><span id="NetOut<?php echo $i?>"><?php echo $NetOut[$i]?></span></font></td>
												<td width="14%">实时: <font color='#CC0000'><span id="NetOutSpeed<?php echo $i?>">0B/s</span></font></td>
											</tr>
											<?php endfor; ?>
										</table>
										<?php endif; ?>
										<table class="table table-striped table-bordered table-hover">
											<tr>
												<th colspan="4">PHP已编译模块检测</th>
											</tr>
											<tr>
												<td colspan="4">
													<?php
													$able=get_loaded_extensions();
													foreach ($able as $key=>$value) {
													if ($key!=0 && $key%13==0) {
														echo '<br />';
													}
														echo "$value&nbsp;&nbsp;";
													}
													?>
												</td>
											</tr>
										</table>
									</div>
								</div>
								{{-- Meta Data tab --}}
								<div class="tab-pane fade" id="php" style="margin:0 1em;">
									<div class="table-responsive p-tb-10">
										<table class="table table-striped table-bordered table-hover">
											<tr>
												<td>PHP信息（phpinfo）：</td>
												<td><a href="#">PHPINFO</a></td>
											</tr>
											<tr>
												<td>PHP版本（php_version）：</td>
												<td><?php echo PHP_VERSION;?></td>
											</tr>
											<tr>
												<td>PHP运行方式：</td>
												<td><?php echo strtoupper(php_sapi_name());?></td>
											</tr>
											<tr>
												<td>脚本占用最大内存（memory_limit）：</td>
												<td><?php echo show("memory_limit");?></td>
											</tr>
											<tr>
												<td>PHP安全模式（safe_mode）：</td>
												<td><?php echo show("safe_mode");?></td>
											</tr>
											<tr>
												<td>POST方法提交最大限制（post_max_size）：</td>
												<td><?php echo show("post_max_size");?></td>
											</tr>
											<tr>
												<td>上传文件最大限制（upload_max_filesize）：</td>
												<td><?php echo show("upload_max_filesize");?></td>
											</tr>
											<tr>
												<td>浮点型数据显示的有效位数（precision）：</td>
												<td><?php echo show("precision");?></td>
											</tr>
											<tr>
												<td>脚本超时时间（max_execution_time）：</td>
												<td><?php echo show("max_execution_time");?>秒</td>
											</tr>
											<tr>
												<td>socket超时时间（default_socket_timeout）：</td>
												<td><?php echo show("default_socket_timeout");?>秒</td>
											</tr>
											<tr>
												<td>PHP页面根目录（doc_root）：</td>
												<td><?php echo show("doc_root");?></td>
											</tr>
											<tr>
												<td>用户根目录（user_dir）：</td>
												<td><?php echo show("user_dir");?></td>
											</tr>

											<tr>
												<td>dl()函数（enable_dl）：</td>
												<td><?php echo show("enable_dl");?></td>
											</tr>
											<tr>
												<td>指定包含文件目录（include_path）：</td>
												<td><?php echo show("include_path");?></td>
											</tr>
											<tr>
												<td>显示错误信息（display_errors）：</td>
												<td><?php echo show("display_errors");?></td>
											</tr>
											<tr>
												<td>自定义全局变量（register_globals）：</td>
												<td><?php echo show("register_globals");?></td>
											</tr>
											<tr>
												<td>数据反斜杠转义（magic_quotes_gpc）：</td>
												<td><?php echo show("magic_quotes_gpc");?></td>
											</tr>
											<tr>
												<td>"&lt;?...?&gt;"短标签（short_open_tag）：</td>
												<td><?php echo show("short_open_tag");?></td>
											</tr>
											<tr>
												<td>"&lt;% %&gt;"ASP风格标记（asp_tags）：</td>
												<td><?php echo show("asp_tags");?></td>
											</tr>
											<tr>
												<td>忽略重复错误信息（ignore_repeated_errors）：</td>
												<td><?php echo show("ignore_repeated_errors");?></td>
											</tr>
											<tr>
												<td>报告内存泄漏（report_memleaks）：</td>
												<td><?php echo show("report_memleaks");?></td>
											</tr>
											<tr>
												<td>忽略重复的错误源（ignore_repeated_source）：</td>
												<td><?php echo show("ignore_repeated_source");?></td>
											</tr>

											<tr>
												<td>自动字符串转义（magic_quotes_gpc）：</td>
												<td><?php echo show("magic_quotes_gpc");?></td>
											</tr>
											<tr>
												<td>外部字符串自动转义（magic_quotes_runtime）：</td>
												<td><?php echo show("magic_quotes_runtime");?></td>
											</tr>
											<tr>
												<td>打开远程文件（allow_url_fopen）：</td>
												<td><?php echo show("allow_url_fopen");?></td>
											</tr>
											<tr>
												<td>声明argv和argc变量（register_argc_argv）：</td>
												<td><?php echo show("register_argc_argv");?></td>
											</tr>
											<tr>
												<td>Cookie 支持：</td>
												<td><?php echo isset($_COOKIE)?'<font color="#45bf7b">√</font>' : '<font color="red">×</font>';?></td>
											</tr>
											<tr>
												<td>拼写检查（ASpell Library）：</td>
												<td><?php echo isfun("aspell_check_raw");?></td>
											</tr>
											<tr>
												<td>高精度数学运算（BCMath）：</td>
												<td><?php echo isfun("bcadd");?></td>
											</tr>
											<tr>
												<td>PREL相容语法（PCRE）：</td>
												<td><?php echo isfun("preg_match");?></td>
											</tr>
											<tr>
												<td>PDF文档支持：</td>
												<td><?php echo isfun("pdf_close");?></td>
											</tr>
											<tr>
												<td>SNMP网络管理协议：</td>
												<td><?php echo isfun("snmpget");?></td>
											</tr>
											<tr>
												<td>VMailMgr邮件处理：</td>
												<td><?php echo isfun("vm_adduser");?></td>
											</tr>
											<tr>
												<td>Curl支持：</td>
												<td><?php echo isfun("curl_init");?></td>
											</tr>
											<tr>
												<td>SMTP支持：</td>
												<td><?php echo get_cfg_var("SMTP")?'<font color="#45bf7b">√</font>' : '<font color="red">×</font>';?></td>
											</tr>
											<tr>
												<td>SMTP地址：</td>
												<td><?php echo get_cfg_var("SMTP")?get_cfg_var("SMTP"):'<font color="red">×</font>';?></td>
											</tr>
											<tr>
												<td>被禁用的函数（disable_functions）：</td>
												<td colspan="3" class="word">
													<?php
													$disFuns=get_cfg_var("disable_functions");
													if(empty($disFuns)){
														echo '<font color=red>×</font>';
													} else {
															//echo $disFuns;
															$disFuns_array =  explode(',',$disFuns);
															foreach ($disFuns_array as $key=>$value){
																if ($key!=0 && $key%5==0) {
															echo '<br />';
															}
															echo "$value&nbsp;&nbsp;";
														}
													}
													?>
												</td>
											</tr>
										</table>
									</div>
								</div>
								{{-- Meta Data tab --}}
								<div class="tab-pane fade" id="module" style="margin:0 1em;">
									<div class="table-responsive p-tb-10">
										<table class="table table-striped table-bordered table-hover">
											<tr>
												<td>FTP支持：</td>
												<td><?php echo isfun("ftp_login");?></td>
											</tr>
											<tr>
												<td>XML解析支持：</td>
												<td><?php echo isfun("xml_set_object");?></td>
											</tr>
											<tr>
												<td>Session支持：</td>
												<td><?php echo isfun("session_start");?></td>
											</tr>
											<tr>
												<td>Socket支持：</td>
												<td><?php echo isfun("socket_accept");?></td>
											</tr>
											<tr>
												<td>Calendar支持</td>
												<td><?php echo isfun('cal_days_in_month');?></td>
											</tr>
											<tr>
												<td>允许URL打开文件：</td>
												<td><?php echo show("allow_url_fopen");?></td>
											</tr>
											<tr>
												<td>GD库支持：</td>
												<td>
													<?php
													if(function_exists(gd_info)) {
													  $gd_info = @gd_info();
													echo $gd_info["GD Version"];
													}else{echo '<font color="red">×</font>';}
													?>
												</td>
											</tr>
											<tr>
												<td>压缩文件支持(Zlib)：</td>
												<td><?php echo isfun("gzclose");?></td>
											</tr>
											<tr>
												<td>IMAP电子邮件系统函数库：</td>
												<td><?php echo isfun("imap_close");?></td>
											</tr>
											<tr>
												<td>历法运算函数库：</td>
												<td><?php echo isfun("JDToGregorian");?></td>
											</tr>
											<tr>
												<td>正则表达式函数库：</td>
												<td><?php echo isfun("preg_match");?></td>
											</tr>
											<tr>
												<td>WDDX支持：</td>
												<td><?php echo isfun("wddx_add_vars");?></td>
											</tr>
											<tr>
												<td>Iconv编码转换：</td>
												<td><?php echo isfun("iconv");?></td>
											</tr>
											<tr>
												<td>mbstring：</td>
												<td><?php echo isfun("mb_eregi");?></td>
											</tr>
											<tr>
												<td>高精度数学运算：</td>
												<td><?php echo isfun("bcadd");?></td>
											</tr>
											<tr>
												<td>LDAP目录协议：</td>
												<td><?php echo isfun("ldap_close");?></td>
											</tr>
											<tr>
												<td>MCrypt加密处理：</td>
												<td><?php echo isfun("mcrypt_cbc");?></td>
											</tr>
											<tr>
												<td>哈稀计算：</td>
												<td><?php echo isfun("mhash_count");?></td>
											</tr>
										</table>
									</div>
								</div>
								{{-- Meta Data tab --}}
								<div class="tab-pane fade" id="database" style="margin:0 1em;">
									<div class="table-responsive p-tb-10">
										<table class="table table-striped table-bordered table-hover">
											<tr>
												<td>MySQL 数据库：</td>
												<td>
												<?php echo isfun("mysql_close");?>
												<?php
												if(function_exists("mysql_get_server_info")) {

													$s = @mysql_get_server_info();

													$s = $s ? '&nbsp; mysql_server 版本：'.$s : '';

													$c = '&nbsp; mysql_client 版本：'.@mysql_get_client_info();

													echo $s;

												}
												?>
												</td>
											</tr>
											<tr>
												<td>ODBC 数据库：</td>
												<td><?php echo isfun("odbc_close");?></td>
											</tr>
											<tr>
												<td>Oracle 数据库：</td>
												<td><?php echo isfun("ora_close");?></td>
											</tr>
											<tr>
												<td>SQL Server 数据库：</td>
												<td><?php echo isfun("mssql_close");?></td>
											</tr>
											<tr>
												<td>dBASE 数据库：</td>
												<td><?php echo isfun("dbase_close");?></td>
											</tr>
											<tr>
												<td>mSQL 数据库：</td>
												<td><?php echo isfun("msql_close");?></td>
											</tr>
											<tr>
												<td>SQLite 数据库：</td>
												<td><?php if(extension_loaded('sqlite3')) {$sqliteVer = SQLite3::version();echo '<font color="#45bf7b">√</font>　';echo "SQLite3　Ver ";echo $sqliteVer[versionString];}else {echo isfun("sqlite_close");if(isfun("sqlite_close") == '<font color="#45bf7b">√</font>') {echo "&nbsp; 版本： ".@sqlite_libversion();}}?></td>
											</tr>
											<tr>
												<td>Hyperwave 数据库：</td>
												<td><?php echo isfun("hw_close");?></td>
											</tr>
											<tr>
												<td>Postgre SQL 数据库：</td>
												<td><?php echo isfun("pg_close"); ?></td>
											</tr>
											<tr>
												<td>Informix 数据库：</td>
												<td><?php echo isfun("ifx_close");?></td>
											</tr>
											<tr>
												<td>DBA 数据库：</td>
												<td><?php echo isfun("dba_close");?></td>
												</tr>
											<tr>
												<td>DBM 数据库：</td>
												<td><?php echo isfun("dbmclose");?></td>
											</tr>
											<tr>
												<td>FilePro 数据库：</td>
												<td><?php echo isfun("filepro_fieldcount");?></td>
											</tr>
											<tr>
												<td>SyBase 数据库：</td>
												<td><?php echo isfun("sybase_close");?></td>
											</tr>
										</table>
									</div>
								</div>
							</form>
						</div>{{-- ./ Tabs Content --}}
					</div>
				</div>
			</div>
		</div>
	</div>
	{{-- /main content --}}
</body>
</html>