<?php

/*
|--------------------------------------------------------------------------
| 复写官方函数
|--------------------------------------------------------------------------
|
| 官方函数库路径
| Illuminate/Support/helpers.php
|
*/

/**
 * Generate a URL to a named route.
 *
 * @param  string  $route
 * @param  string  $parameters
 * @return string
 */
function route($route, $parameters = array())
{
	if (Route::getRoutes()->hasNamedRoute($route))
		return app('url')->route($route, $parameters);
	else
		return 'javascript:void(0)';
}

/**
 * Generate a HTML link to a named route.
 *
 * @param  string  $name
 * @param  string  $title
 * @param  array   $parameters
 * @param  array   $attributes
 * @return string
 */
function link_to_route($name, $title = null, $parameters = array(), $attributes = array())
{
	if (Route::getRoutes()->hasNamedRoute($name))
		return app('html')->linkRoute($name, $title, $parameters, $attributes);
	else
		return '<a href="javascript:void(0)"'.HTML::attributes($attributes).'>'.$name.'</a>';
}


/*
|--------------------------------------------------------------------------
| 延伸自拓展配置文件
|--------------------------------------------------------------------------
|
*/

/**
 * 样式别名加载（支持批量加载）
 * @param  string|array $aliases    配置文件中的别名
 * @param  array        $attributes 标签中需要加入的其它参数的数组
 * @return string
 */
function style($aliases, $attributes = array(), $interim = '')
{
	if (is_array($aliases)) {
		foreach ($aliases as $key => $value) {
			$interim .= (is_int($key)) ? style($value, $attributes, $interim) : style($key, $value, $interim);
		}
		return $interim;
	}
	$cssAliases = Config::get('extend.webAssets.cssAliases');
	$url        = isset($cssAliases[$aliases]) ? $cssAliases[$aliases] : $aliases;
	return HTML::style($url, $attributes);
}

/**
 * 脚本别名加载（支持批量加载）
 * @param  string|array $aliases    配置文件中的别名
 * @param  array        $attributes 标签中需要加入的其它参数的数组
 * @return string
 */
function script($aliases, $attributes = array(), $interim = '')
{
	if (is_array($aliases)) {
		foreach ($aliases as $key => $value) {
			$interim .= (is_int($key)) ? script($value, $attributes, $interim) : script($key, $value, $interim);
		}
		return $interim;
	}
	$jsAliases = Config::get('extend.webAssets.jsAliases');
	$url       = isset($jsAliases[$aliases]) ? $jsAliases[$aliases] : $aliases;
	return HTML::script($url, $attributes);
}

/**
 * 脚本别名加载（补充）用于 js 的 document.write(）中
 * @param  string $aliases    配置文件中的别名
 * @param  array  $attributes 标签中需要加入的其它参数的数组
 * @return string
 */
function or_script($aliases, $attributes = array())
{
	$jsAliases         = Config::get('extend.webAssets.jsAliases');
	$url               = isset($jsAliases[$aliases]) ? $jsAliases[$aliases] : $aliases;
	$attributes['src'] = URL::asset($url);
	return "'<script".HTML::attributes($attributes).">'+'<'+'/script>'";
}

/*
|--------------------------------------------------------------------------
| 自定义核心函数
|--------------------------------------------------------------------------
|
*/

/**
 * 批量定义常量
 * @param  array  $define 常量和值的数组
 * @return void
 */
function define_array($define = array())
{
	foreach ($define as $key => $value)
		defined($key) OR define($key, $value);
}

/**
 * 友好的日期输出
 * @param  string|\Carbon\Carbon $theDate 待处理的时间字符串 | \Carbon\Carbon 实例
 * @return string                         友好的时间字符串
 */
function friendly_date($theDate)
{
	// 获取待处理的日期对象
	if (! $theDate instanceof \Carbon\Carbon)
		$theDate = \Carbon\Carbon::createFromTimestamp(strtotime($theDate));
	// 取得英文日期描述
	$friendlyDateString = $theDate->diffForHumans(\Carbon\Carbon::now());
	// 本地化
	$friendlyDateArray  = explode(' ', $friendlyDateString);
	$friendlyDateString = $friendlyDateArray[0]
		.Lang::get('friendlyDate.'.$friendlyDateArray[1])
		.Lang::get('friendlyDate.'.$friendlyDateArray[2]);
	// 数据返回
	return $friendlyDateString;
}

/**
 * 拓展分页输出，支持临时指定分页模板
 * @param  Illuminate\Pagination\Paginator $paginator 分页查询结果的最终实例
 * @param  string                          $viewName  分页视图名称
 * @return \Illuminate\View\View
 */
function pagination(Illuminate\Pagination\Paginator $paginator, $viewName = null)
{
	$viewName = $viewName ?: Config::get('view.pagination');
	$paginator->getFactory()->setViewName($viewName);
	return $paginator->links();
}

/**
 * 反引用一个经过 e（htmlentities）和 addslashes 处理的字符串
 * @param  string $string 待处理的字符串
 * @return 转义后的字符串
 */
function strip($string)
{
	return stripslashes(HTML::decode($string));
}


/*
|--------------------------------------------------------------------------
| Public Function Library
|--------------------------------------------------------------------------
|
*/

/**
 * Closing HTML tag (this function is still flawed, unable to process incomplete labels, there is no better plan, caution)
 * @param  string $html HTML String
 * @return string
 */
function close_tags($html)
{
	// Labels needn't to complete
	$arr_single_tags = array('meta', 'img', 'br', 'link', 'area');
	// Match the start tag
	preg_match_all('#<([a-z1-6]+)(?: .*)?(?<![/|/ ])>#iU', $html, $result);
	$openedtags = $result[1];
	// Match the close tag
	preg_match_all('#</([a-z]+)>#iU', $html, $result);
	$closedtags = $result[1];
	// Close opened tab quantity is calculated, and if the same return HTML data
	if (count($closedtags) === count($openedtags)) return $html;
	// Reverse sort the array, the last open tab at the top
	$openedtags = array_reverse($openedtags);
	// Traversing the open tags array
	foreach ($openedtags as $key => $value) {
		// Skip without closing tags
		if (in_array($value, $arr_single_tags)) continue;
		// Started complete
		if (in_array($value, $closedtags)) {
			unset($closedtags[array_search($value, $closedtags)]);
		} else {
			$html .= '</'.$value.'>';
		}
	}
	return $html;
}

/**
 * Resources list sort
 * @param  string $columnName Column name
 * @param  string $default    If the default sort column，up Default Ascending, down Default descending
 * @return string             a Tag sort icon
 */
function order_by($columnName = '', $default = null)
{
	$sortColumnName = Input::get('sort_up', Input::get('sort_down', false));
	if (Input::get('sort_up')) {
		$except = 'sort_up'; $orderType = 'sort_down';
	} else {
		$except = 'sort_down' ; $orderType = 'sort_up';
	}
	if ($sortColumnName == $columnName) {
		$parameters = array_merge(Input::except($except), array($orderType => $columnName));
		$icon       = Input::get('sort_up') ? 'chevron-up' : 'chevron-down' ;
	} elseif ($sortColumnName === false && $default == 'asc') {
		$parameters = array_merge(Input::all(), array('sort_down' => $columnName));
		$icon       = 'chevron-up';
	} elseif ($sortColumnName === false && $default == 'desc') {
		$parameters = array_merge(Input::all(), array('sort_up' => $columnName));
		$icon       = 'chevron-down';
	} else {
		$parameters = array_merge(Input::except($except), array('sort_up' => $columnName));
		$icon       = 'random';
	}
	$a  = '<a href="';
	$a .= action(Route::current()->getActionName(), $parameters);
	$a .= '" class="glyphicon glyphicon-'.$icon.'"></a>';
	return $a;
}

/*
|--------------------------------------------------------------------------
| Server Function
|--------------------------------------------------------------------------
|
*/

/**
 * @param  memory usage
 * @return string
 */

function memory_usage()
{
	$memory  = ( ! function_exists('memory_get_usage')) ? '0' : round(memory_get_usage()/1024/1024, 2).'MB';
	return $memory;
}

/**
 * @param  Timing
 * @return string
 */

function microtime_float()
{
	$mtime = microtime();
	$mtime = explode(' ', $mtime);
	return $mtime[1] + $mtime[0];
}

/**
 * @param  Unit Conversion
 * @return string
 */

function formatsize($size)
{
	$danwei=array(' B ',' K ',' M ',' G ',' T ');
	$allsize=array();
	$i=0;
	for($i = 0; $i <5; $i++)
	{
		if(floor($size/pow(1024,$i))==0){break;}
	}
	for($l = $i-1; $l >=0; $l--)
	{
		$allsize1[$l]=floor($size/pow(1024,$l));
		$allsize[$l]=$allsize1[$l]-$allsize1[$l+1]*1024;
	}
	$len=count($allsize);
	for($j = $len-1; $j >=0; $j--)
	{
		$fsize=$fsize.$allsize[$j].$danwei[$j];
	}
	return $fsize;
}

function valid_email($str)
{
	return ( ! preg_match("/^([a-z0-9\+_\-]+)(\.[a-z0-9\+_\-]+)*@([a-z0-9\-]+\.)+[a-z]{2,6}$/ix", $str)) ? FALSE : TRUE;
}

/**
 * @param  Detection PHP setting parameters
 * @return string
 */

function show($varName)
{
	switch($result = get_cfg_var($varName))
	{
		case 0:
			return '<font color="red">×</font>';
		break;
		case 1:
			return '<font color="#45bf7b">√</font>';
		break;
		default:
			return $result;
		break;
	}
}

/**
 * @param Detection Function Support
 * @return string
 */

function isfun($funName = '')
{
	if (!$funName || trim($funName) == '' || preg_match('~[^a-z0-9\_]+~i', $funName, $tmp)) return '错误';
	return (false !== function_exists($funName)) ? '<font color="#45bf7b">√</font>' : '<font color="red">×</font>';
}

function isfun1($funName = '')
{
	if (!$funName || trim($funName) == '' || preg_match('~[^a-z0-9\_]+~i', $funName, $tmp)) return '错误';
	return (false !== function_exists($funName)) ? '<font color="#45bf7b">√</font>' : '×';
}

/**
 * @param  Linux Detects
 * @return string
 */

function sys_linux()
{
	// CPU
	if (false === ($str = @file("/proc/cpuinfo"))) return false;
	$str = implode("", $str);
	@preg_match_all("/model\s+name\s{0,}\:+\s{0,}([\w\s\)\(\@.-]+)([\r\n]+)/s", $str, $model);
	@preg_match_all("/cpu\s+MHz\s{0,}\:+\s{0,}([\d\.]+)[\r\n]+/", $str, $mhz);
	@preg_match_all("/cache\s+size\s{0,}\:+\s{0,}([\d\.]+\s{0,}[A-Z]+[\r\n]+)/", $str, $cache);
	@preg_match_all("/bogomips\s{0,}\:+\s{0,}([\d\.]+)[\r\n]+/", $str, $bogomips);
	if (false !== is_array($model[1]))
	{
		$res['cpu']['num'] = sizeof($model[1]);
		/*
		for($i = 0; $i < $res['cpu']['num']; $i++)
		{
			$res['cpu']['model'][] = $model[1][$i].'&nbsp;('.$mhz[1][$i].')';
			$res['cpu']['mhz'][] = $mhz[1][$i];
			$res['cpu']['cache'][] = $cache[1][$i];
			$res['cpu']['bogomips'][] = $bogomips[1][$i];
		}*/
		if($res['cpu']['num']==1)
			$x1 = '';
		else
			$x1 = ' ×'.$res['cpu']['num'];
		$mhz[1][0] = ' | 频率:'.$mhz[1][0];
		$cache[1][0] = ' | 二级缓存:'.$cache[1][0];
		$bogomips[1][0] = ' | Bogomips:'.$bogomips[1][0];
		$res['cpu']['model'][] = $model[1][0].$mhz[1][0].$cache[1][0].$bogomips[1][0].$x1;
		if (false !== is_array($res['cpu']['model'])) $res['cpu']['model'] = implode("<br />", $res['cpu']['model']);
		if (false !== is_array($res['cpu']['mhz'])) $res['cpu']['mhz'] = implode("<br />", $res['cpu']['mhz']);
		if (false !== is_array($res['cpu']['cache'])) $res['cpu']['cache'] = implode("<br />", $res['cpu']['cache']);
		if (false !== is_array($res['cpu']['bogomips'])) $res['cpu']['bogomips'] = implode("<br />", $res['cpu']['bogomips']);
	}
	// Network
	// Uptime
	if (false === ($str = @file("/proc/uptime"))) return false;
	$str = explode(" ", implode("", $str));
	$str = trim($str[0]);
	$min = $str / 60;
	$hours = $min / 60;
	$days = floor($hours / 24);
	$hours = floor($hours - ($days * 24));
	$min = floor($min - ($days * 60 * 24) - ($hours * 60));
	if ($days !== 0) $res['uptime'] = $days."天";
	if ($hours !== 0) $res['uptime'] .= $hours."小时";
	$res['uptime'] .= $min."分钟";
	// MEMORY
	if (false === ($str = @file("/proc/meminfo"))) return false;
	$str = implode("", $str);
	preg_match_all("/MemTotal\s{0,}\:+\s{0,}([\d\.]+).+?MemFree\s{0,}\:+\s{0,}([\d\.]+).+?Cached\s{0,}\:+\s{0,}([\d\.]+).+?SwapTotal\s{0,}\:+\s{0,}([\d\.]+).+?SwapFree\s{0,}\:+\s{0,}([\d\.]+)/s", $str, $buf);
	preg_match_all("/Buffers\s{0,}\:+\s{0,}([\d\.]+)/s", $str, $buffers);
	$res['memTotal'] = round($buf[1][0]/1024, 2);
	$res['memFree'] = round($buf[2][0]/1024, 2);
	$res['memBuffers'] = round($buffers[1][0]/1024, 2);
	$res['memCached'] = round($buf[3][0]/1024, 2);
	$res['memUsed'] = $res['memTotal']-$res['memFree'];
	$res['memPercent'] = (floatval($res['memTotal'])!=0)?round($res['memUsed']/$res['memTotal']*100,2):0;
	$res['memRealUsed'] = $res['memTotal'] - $res['memFree'] - $res['memCached'] - $res['memBuffers']; // Real Memory Usage
	$res['memRealFree'] = $res['memTotal'] - $res['memRealUsed']; // Real Memory Free
	$res['memRealPercent'] = (floatval($res['memTotal'])!=0)?round($res['memRealUsed']/$res['memTotal']*100,2):0; // Real Memory Usage Ratio
	$res['memCachedPercent'] = (floatval($res['memCached'])!=0)?round($res['memCached']/$res['memTotal']*100,2):0; // Cached Memory Usage Ratio
	$res['swapTotal'] = round($buf[4][0]/1024, 2);
	$res['swapFree'] = round($buf[5][0]/1024, 2);
	$res['swapUsed'] = round($res['swapTotal']-$res['swapFree'], 2);
	$res['swapPercent'] = (floatval($res['swapTotal'])!=0)?round($res['swapUsed']/$res['swapTotal']*100,2):0;
	// Load Avg
	if (false === ($str = @file("/proc/loadavg"))) return false;
	$str = explode(" ", implode("", $str));
	$str = array_chunk($str, 4);
	$res['loadAvg'] = implode(" ", $str[0]);
	return $res;
}

/**
 * @param  FreeBSD Detects
 * @return string
 */

function sys_freebsd()
{
	// CPU
	if (false === ($res['cpu']['num'] = get_key("hw.ncpu"))) return false;
	$res['cpu']['model'] = get_key("hw.model");
	// Load Avg
	if (false === ($res['loadAvg'] = get_key("vm.loadavg"))) return false;
	// Uptime
	if (false === ($buf = get_key("kern.boottime"))) return false;
	$buf = explode(' ', $buf);
	$sys_ticks = time() - intval($buf[3]);
	$min = $sys_ticks / 60;
	$hours = $min / 60;
	$days = floor($hours / 24);
	$hours = floor($hours - ($days * 24));
	$min = floor($min - ($days * 60 * 24) - ($hours * 60));
	if ($days !== 0) $res['uptime'] = $days."天";
	if ($hours !== 0) $res['uptime'] .= $hours."小时";
	$res['uptime'] .= $min."分钟";
	// Memory
	if (false === ($buf = get_key("hw.physmem"))) return false;
	$res['memTotal'] = round($buf/1024/1024, 2);
	$str = get_key("vm.vmtotal");
	preg_match_all("/\nVirtual Memory[\:\s]*\(Total[\:\s]*([\d]+)K[\,\s]*Active[\:\s]*([\d]+)K\)\n/i", $str, $buff, PREG_SET_ORDER);
	preg_match_all("/\nReal Memory[\:\s]*\(Total[\:\s]*([\d]+)K[\,\s]*Active[\:\s]*([\d]+)K\)\n/i", $str, $buf, PREG_SET_ORDER);
	$res['memRealUsed'] = round($buf[0][2]/1024, 2);
	$res['memCached'] = round($buff[0][2]/1024, 2);
	$res['memUsed'] = round($buf[0][1]/1024, 2) + $res['memCached'];
	$res['memFree'] = $res['memTotal'] - $res['memUsed'];
	$res['memPercent'] = (floatval($res['memTotal'])!=0)?round($res['memUsed']/$res['memTotal']*100,2):0;
	$res['memRealPercent'] = (floatval($res['memTotal'])!=0)?round($res['memRealUsed']/$res['memTotal']*100,2):0;
	return $res;
}

/**
 * @param  Obtain parameter values FreeBSD
 * @return string
 */

function get_key($keyName)
{
	return do_command('sysctl', "-n $keyName");
}
// Determine the location of the executable file FreeBSD
function find_command($commandName)
{
	$path = array('/bin', '/sbin', '/usr/bin', '/usr/sbin', '/usr/local/bin', '/usr/local/sbin');
	foreach($path as $p)
	{
		if (@is_executable("$p/$commandName")) return "$p/$commandName";
	}
	return false;
}

/**
 * @param  Execute System Commands FreeBSD
 * @return string
 */

function do_command($commandName, $args)
{
	$buffer = "";
	if (false === ($command = find_command($commandName))) return false;
	if ($fp = @popen("$command $args", 'r'))
	{
		while (!@feof($fp))
		{
			$buffer .= @fgets($fp, 4096);
		}
		return trim($buffer);
	}
	return false;
}

/**
 * @param  Windows Detects
 * @return string
 */

function sys_windows()
{
	if (PHP_VERSION >= 5)
	{
		$objLocator = new COM("WbemScripting.SWbemLocator");
		$wmi = $objLocator->ConnectServer();
		$prop = $wmi->get("Win32_PnPEntity");
	}
	else
	{
		return false;
	}
	// CPU
	$cpuinfo = GetWMI($wmi,"Win32_Processor", array("Name","L2CacheSize","NumberOfCores"));
	$res['cpu']['num'] = $cpuinfo[0]['NumberOfCores'];
	if (null == $res['cpu']['num'])
	{
		$res['cpu']['num'] = 1;

	}/*
	for ($i=0;$i<$res['cpu']['num'];$i++)
	{
		$res['cpu']['model'] .= $cpuinfo[0]['Name']."<br />";
		$res['cpu']['cache'] .= $cpuinfo[0]['L2CacheSize']."<br />";
	}*/
	$cpuinfo[0]['L2CacheSize'] = ' ('.$cpuinfo[0]['L2CacheSize'].')';
	if($res['cpu']['num']==1)
		$x1 = '';
	else
		$x1 = ' ×'.$res['cpu']['num'];
	$res['cpu']['model'] = $cpuinfo[0]['Name'].$cpuinfo[0]['L2CacheSize'].$x1;
	// SYSINFO
	$sysinfo = GetWMI($wmi,"Win32_OperatingSystem", array('LastBootUpTime','TotalVisibleMemorySize','FreePhysicalMemory','Caption','CSDVersion','SerialNumber','InstallDate'));
	$sysinfo[0]['Caption']=iconv('GBK', 'UTF-8',$sysinfo[0]['Caption']);
	$sysinfo[0]['CSDVersion']=iconv('GBK', 'UTF-8',$sysinfo[0]['CSDVersion']);
	$res['win_n'] = $sysinfo[0]['Caption']." ".$sysinfo[0]['CSDVersion']." 序列号:{$sysinfo[0]['SerialNumber']} 于".date('Y年m月d日H:i:s',strtotime(substr($sysinfo[0]['InstallDate'],0,14)))."安装";
	// Uptime
	$res['uptime'] = $sysinfo[0]['LastBootUpTime'];
	$sys_ticks = 3600*8 + time() - strtotime(substr($res['uptime'],0,14));
	$min = $sys_ticks / 60;
	$hours = $min / 60;
	$days = floor($hours / 24);
	$hours = floor($hours - ($days * 24));
	$min = floor($min - ($days * 60 * 24) - ($hours * 60));
	if ($days !== 0) $res['uptime'] = $days."天";
	if ($hours !== 0) $res['uptime'] .= $hours."小时";
	$res['uptime'] .= $min."分钟";
	// Memory
	$res['memTotal'] = round($sysinfo[0]['TotalVisibleMemorySize']/1024,2);
	$res['memFree'] = round($sysinfo[0]['FreePhysicalMemory']/1024,2);
	$res['memUsed'] = $res['memTotal']-$res['memFree']; // 1024 has been divided by two lines of the above, in addition to this line no longer.
	$res['memPercent'] = round($res['memUsed'] / $res['memTotal']*100,2);
	$swapinfo = GetWMI($wmi,"Win32_PageFileUsage", array('AllocatedBaseSize','CurrentUsage'));
	// LoadPercentage
	$loadinfo = GetWMI($wmi,"Win32_Processor", array("LoadPercentage"));
	$res['loadAvg'] = $loadinfo[0]['LoadPercentage'];
	return $res;
}

function GetWMI($wmi,$strClass, $strValue = array())
{
	$arrData = array();
	$objWEBM = $wmi->Get($strClass);
	$arrProp = $objWEBM->Properties_;
	$arrWEBMCol = $objWEBM->Instances_();
	foreach($arrWEBMCol as $objItem)
	{
		@reset($arrProp);
		$arrInstance = array();
		foreach($arrProp as $propItem)
		{
			eval("\$value = \$objItem->" . $propItem->Name . ";");
			if (empty($strValue))
			{
				$arrInstance[$propItem->Name] = trim($value);
			}
			else
			{
				if (in_array($propItem->Name, $strValue))
				{
					$arrInstance[$propItem->Name] = trim($value);
				}
			}
		}
		$arrData[] = $arrInstance;
	}
	return $arrData;
}