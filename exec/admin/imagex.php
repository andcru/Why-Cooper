<?php

function imageGrow($html) {
	while(@strpos($html,'<img',$offset) !== false) {
		unset($alt);
		unset($class);
		$st = @strpos($html,'<img',$offset);
		$en = strpos($html,'>',$st);
		$str = substr($html,$st,$en-$st+1);

		$path = explode(".",substr($str,strpos($str,"src=")+5,-2));
		$slash = strrpos($path[0],"/");
		$underscore = strrpos($path[0],"_");
		$x = strrpos($path[0],"x");

		if(strpos($str,'class=') !== false) {
			$pos = strpos($str,'class=');
			$class = str_replace('"',"",substr($str,$pos+6,strpos($str,'"',$pos+7)-($pos+6)+1));
		}

		if(strpos($str,'alt=') !== false) {
			$pos = strpos($str,'alt=');
			$alt = str_replace('"',"",substr($str,$pos+4,strpos($str,'"',$pos+5)-($pos+4)+1));
		}

		$filename = substr($path[0],$slash+1,$underscore-$slash-1);
		$img = $filename.'.'.$path[1];

		$width = substr($path[0],$underscore+1,$x-$underscore-1);
		$height = substr($path[0],$x+1);

		$fold = explode("/",$path[0]);

		array_pop($fold);
		array_pop($fold);
		$folder = implode("/",$fold);

		$class = 'class="'.$class.'"';

		$imgtag = '<img '.$class.' '.$alt.' src="'.$folder.'/'.$img.'" width="'.$width.'" height="'.$height.'">';	

		$offset = $st + strlen($imgtag)-1;

		$html = str_replace($str,$imgtag,$html);
	}
	return $html;
}

function imageShrink($html) {
	$offset = 0;
	while(@strpos($html,'<img',$offset) !== false) {
		unset($width);
		unset($height);
		unset($cl);
		unset($al);
		unset($class);
		unset($alt);
		$st = @strpos($html,'<img',$offset);
		$en = strpos($html,'>',$st);
		$str = substr($html,$st,$en-$st+1);

		$tag = explode(" ", $str);

		foreach($tag as $val) {
			$loc = strpos($val,'=');
			${substr($val,0,$loc)} = str_replace(array('"',"'"),"",substr($val,$loc+2,-1));
		}

		if(strpos($str,'class=') !== false) {
			$pos = strpos($str,'class=');
			$class = str_replace('"',"",substr($str,$pos+6,strpos($str,'"',$pos+7)-($pos+6)+1));
		}

		if(strpos($str,'alt=') !== false) {
			$pos = strpos($str,'alt=');
			$alt = str_replace('"',"",substr($str,$pos+4,strpos($str,'"',$pos+5)-($pos+4)+1));
		}

		$file = explode(".",$src);
		$urllen = sizeof($file)-1;
		if(strstr($file[$urllen],"?")) {
			$fi = explode("?",$file[$urllen]);
			$file[$urllen] = $fi[0];
		}
		$fil = explode("/",$file[$urllen-1]);
		$filename = array_pop($fil);
		$pat = implode("/",$fil);

		if(!$width || !$height) {
			if(!$width && !$height)
				die('Something went wrong with the photo import.');
			else {
				$arr = getSize($pat.'/'.$filename.'.'.$file[$urllen],$file[$urllen],$width,$height);
				$width = $arr[0];
				$height = $arr[1];
			}
			if(!$width || !$height) {
				die('<br/><br/>An error has occured during image conversion. The problem is with: "'.htmlspecialchars($html).'"<br/>Tried to load: '.$pat.'/'.$filename.'.'.$file[$urllen].'<br/> Please contact crudge@cooper.edu should this problem persist.');
			}
		}

		$newpath = $pat.'/i/'.$filename.'_'.$width.'x'.$height.'.'.$file[$urllen];

		if(!file_exists($_SERVER['DOCUMENT_ROOT'].$newpath)) {
			shrink($file[$urllen-1],$file[$urllen],$width,$height);
		}
		
		if($class)
			$cl = 'class="'.$class.'"';
		if($alt)
			$al = 'alt="'.$alt.'"';
		if($_SESSION['fid'] == 'crudge') {
		}

		$imgtag = '<img '.@$cl.' '.@$al.' src="'.$newpath.'">';
		$offset = $st + strlen($imgtag)-1;

		$html = str_replace($str,$imgtag,$html);
	}
	return $html;
}

function getSize($file,$ext,$width=0,$height=0) {

	switch(strtolower($ext)) {
		case 'jpg':
		case 'jpeg':
			$create_fn = 'imagecreatefromjpeg';
			$save_fn = 'imagejpeg';
			break;
		case 'png':
			$create_fn = 'imagecreatefrompng';
			$save_fn = 'imagepng';
			break;
		case 'gif':
			$create_fn = 'imagecreatefromgif';
			$save_fn = 'imagegif';
			break;
	}

	$source_image = $create_fn($_SERVER['DOCUMENT_ROOT'].$file);
	$wid = imagesx($source_image);
	$hei = imagesy($source_image);
	$w = $width ? $width : round($wid * $height / $hei);
	$h = $height ? $height : round($hei * $width / $wid);
	$arr = array($w,$h);
	return $arr;
}


?>
