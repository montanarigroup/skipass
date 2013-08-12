<?php

/* uso:
*
*		proxy.php?url=news				piglia le news sulla neve
*/

$dir_news="news";
$sito="http://www.skiinfo.it/";
$sito_nostro="http://www.montanarigroup.it/skipass/".$dir_news;
$url1="index.html";


$url1="/news.rss";			// feed rss

if($_GET['url']=="news") {

	if (!function_exists('curl_init')){
        die('Sorry cURL is not installed!');
    }

    $uri=$sito.$url1;

    $output=download_link($uri);

/* da fare: usare regexp

	if(preg_match_all('/\<div class="module latest_news">(.*?\s*)\<div class="module_header">(.*?\s*)/', $output, $matches, PREG_SET_ORDER)) {
	    foreach($matches as $match) {
	        echo $match[0]; 
	    }
	} else {
		print "<h3>Impossibile accedere alla sezione news</h3>";
	}
*/
	$inizio=false;
	$fine=false;
	$conta=0;
	$news = array();

	$html_tag_on='<div data-role="collapsible-set" data-theme="c" data-content-theme="d" data-mini="true">';
	$html_tag_off='</div>';

	preg_match_all('/<title>(.*?)<\/title>/', $output, $tit);
	preg_match_all('/<description>(.*?)<\/description>/', $output, $descr);

	$riga_out = $html_tag_on;

	$max = count($descr[1]);
	if($max>10) $max=10;

	for($idx=1; $idx<$max; $idx++) {
		$n=$tit[1][$idx+1];
		$riga_out .= '<div data-role="collapsible"><h3>'.$n.'</h3>';

		$n=$descr[1][$idx];
		$riga_out .= '<p>'.$n.'</p></div>';
	}
	$riga_out .= $html_tag_off;
	print $riga_out;

}

/* ok funziona su homepage: $sito="http://www.skiinfo.it/"
**

	$out = explode("\n", $output);

	foreach($out as $riga) {
		if(preg_match('/\<div class="module latest_news">/i',$riga)) {
			$inizio=true;
		}

		if($inizio && preg_match('/\<!-- \/.module -->/', $riga)) {
			$fine=true;
			break;
		}
		if($inizio && !$fine) {
			if(preg_match('/\<h2>/', $riga)) continue;
			if(preg_match('/http\:\/\/www\.skiinfo\.it\/news/', $riga)) continue;

			if(preg_match('/\<ul>/', $riga)) $riga=preg_replace('/\<ul>/', '<ul id="ul-news" data-role="listview" data-inset="true">', $riga);

			$riga=preg_replace('/href="\/news(.*?)/', $sito_nostro, $riga);

			array_push($news, $riga);
		}
	}

	foreach($news as $n) print $n;

}
*/



function download_link($url) {
	$ch=curl_init();

	// Set URL to download
    curl_setopt($ch, CURLOPT_URL, $url);

	// Set a referer
    curl_setopt($ch, CURLOPT_REFERER, "http://www.unimo.it");
	
	// User agent
    curl_setopt($ch, CURLOPT_USERAGENT, "Mozilla99/1.0");
 
    // Include header in result? (0 = yes, 1 = no)
    curl_setopt($ch, CURLOPT_HEADER, 0);
 
    // Should cURL return or print out the data? (true = return, false = print)
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
 
    // Timeout in seconds
    curl_setopt($ch, CURLOPT_TIMEOUT, 10);
 
    // Download the given URL, and return output
    $output = curl_exec($ch);

	curl_close($ch);

	return $output;
}

/*
function parse_pagina_news($output) {

	$inizio=false;
	$fine=false;

	$out = explode("\n", $output);
	$riga_news="";
	$news=array();

	foreach($out as $riga) {
		

		if(preg_match('/\<h1>', $riga)) {
			$riga_news.=$riga.'\n';
			continue;
		}

		// da saltare
		if(preg_match('/\<img src=(.*?)/', $riga)) {
			$riga_news.=$riga.'\n';
			continue;
		}

		if(preg_match('/\<div id="articleBody" class="articleBody">/',$riga)) {
			$inizio=true;
		}

		if($inizio && preg_match('/\<\/div>/', $riga)) {
			$fine=true;
			array_push($news, $riga_news);
			$riga_news="";
			break;
		}

		if($inizio && !$fine) {
			$riga_news.='\n'.$riga;
		}
	}

	return $news;
}
*/
?>