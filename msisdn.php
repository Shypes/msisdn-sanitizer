<?php

function msisdn_sanitizer($msisdn, $phone_code, $leading_zero=false, $plus=true){
	$msisdn = trim($msisdn);
	$msisdn = str_replace('+', '', $msisdn);
	$msisdn = preg_replace("/[^0-9]/", '', $msisdn);
	$phone_code = str_replace('+', '', $phone_code);
	$regex = "/^(${phone_code})+/i";
	$msisdn = preg_replace($regex, $phone_code, $msisdn);
    $regex = "/^$phone_code/i";
	if(preg_match($regex,$msisdn) == true){
		$msisdn = substr($msisdn, strlen($phone_code));	
	}
	if(!$leading_zero){
		$msisdn = preg_replace("/^0+/", '', $msisdn);
	}
	$msisdn = "${phone_code}${msisdn}";
	if(!$plus == false){
		if(strpos($msisdn,'+') == false) 
			$msisdn = "+${msisdn}";	
	}
	return $msisdn;
}

var_dump(msisdn_sanitizer("+2348030000000", "+234")); // +2348030000000s 
var_dump(msisdn_sanitizer("+2348030000000", "+234")); // +2348030000000
var_dump(msisdn_sanitizer("08030000000", "+234")); // +2348030000000
var_dump(msisdn_sanitizer("8030000000", "+234")); // +2348030000000
var_dump(msisdn_sanitizer("+234803000#!*()%,^&0000", "+234")); // +2348030000000
var_dump(msisdn_sanitizer("+234803000kddskdskf0000", "+234")); // +2348030000000
var_dump(msisdn_sanitizer("+234000000080 3000 00 00","+234")); // +2348030000000
var_dump(msisdn_sanitizer("+234234234234 80 3000 00 00","+234")); // +2348030000000
?>