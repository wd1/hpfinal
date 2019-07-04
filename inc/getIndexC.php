<?php
  include 'conCouch.php';
  $count = $_GET['conte'];
  $sixcount = $_GET['sixconte'];
  $section = $_GET['section'];
  $final='';

$final=$final."<ul class='btop'>";

//A1
$count++;
$temp=0;
$aes = mysqli_query($con,"SELECT id FROM couch_pages WHERE template_id=11 AND publish_date <> '0000-00-00 00:00:00' ORDER BY publish_date DESC");
while($aow = mysqli_fetch_array($aes)){ 
	
	$id=$aow['id'];
	
	$bes = mysqli_query($con,"SELECT value FROM couch_data_text WHERE page_id=$id AND field_id=174");
	while($bow = mysqli_fetch_array($bes)){ 
		$value=$bow['value'];
	}

	if($value==0){
		$temp++;
	}

	if( ($temp==$count) ){
		$pageid=$id;
		break;
	} 
}

$aes = mysqli_query($con,"SELECT search_value FROM couch_data_text WHERE page_id=$pageid AND field_id=160");
while($aow = mysqli_fetch_array($aes)){ 
	$type=$aow['search_value'];
}

$aes = mysqli_query($con,"SELECT search_value FROM couch_data_text WHERE page_id=$pageid AND field_id=162");
while($aow = mysqli_fetch_array($aes)){ 
	$subtitle=$aow['search_value'];
}

$aes = mysqli_query($con,"SELECT search_value FROM couch_data_text WHERE page_id=$pageid AND field_id=164");
while($aow = mysqli_fetch_array($aes)){ 
	$img=$aow['search_value'];
}

$aes = mysqli_query($con,"SELECT search_value FROM couch_data_text WHERE page_id=$pageid AND field_id=176");
while($aow = mysqli_fetch_array($aes)){ 
	$url=$aow['search_value'];
}

$aes = mysqli_query($con,"SELECT search_value FROM couch_data_text WHERE page_id=$pageid AND field_id=177");
while($aow = mysqli_fetch_array($aes)){ 
	$offset=$aow['search_value'];
}

$aes = mysqli_query($con,"SELECT search_value FROM couch_data_text WHERE page_id=$pageid AND field_id=179");
while($aow = mysqli_fetch_array($aes)){ 
	$hidetitle=$aow['search_value'];
}

$aes = mysqli_query($con,"SELECT search_value FROM couch_data_text WHERE page_id=$pageid AND field_id=184");
while($aow = mysqli_fetch_array($aes)){ 
    $hidedate=$aow['search_value'];
}



$aes = mysqli_query($con,"SELECT search_value FROM couch_data_text WHERE page_id=$pageid AND field_id=175");
while($aow = mysqli_fetch_array($aes)){ 
	$background=$aow['search_value'];
}

$res = mysqli_query($con,"SELECT page_title,publish_date FROM couch_pages WHERE id='$pageid'");
while($row = mysqli_fetch_array($res)){ 
    $pagetitle= $row['page_title'];
    $date = $row['publish_date'];
}
$year = substr($date,0,4);
$mon = substr($date,5,2);
$day = substr($date,8,2);
if($mon=='01'){$month='January';}
if($mon=='02'){$month='February';}
if($mon=='03'){$month='March';}
if($mon=='04'){$month='April';}
if($mon=='05'){$month='May';}
if($mon=='06'){$month='June';}
if($mon=='07'){$month='July';}
if($mon=='08'){$month='August';}
if($mon=='09'){$month='September';}
if($mon=='10'){$month='October';}
if($mon=='11'){$month='November';}
if($mon=='12'){$month='December';}
$dater=$month.' '.$day.', '.$year;

if($type=='News'){
	$color='#ff6d00';
	$colgb='rgba(255,109,0,.8)';
	$colas='cnews';
} else if($type=='Exclusive'){
	$color='#3a98b4';
	$colgb='rgba(58,152,180,.8)';
	$colas='cexclusive';
} else if($type=='Visualization'){
	$color='#5ca41a';
	$colgb='rgba(92,164,26,.8)';
	$colas='cdata';
} else if($type=='Video'){
	$color='#157d9a';
	$colgb='rgba(243,60,55,.8)';
	$colas='cvideo';
} else if($type=='Life in numbers'){
	$color='#635c4c';
	$colgb='rgba(99,92,76,.8)';
	$colas='clife';
} else if($type=='Announcement'){
	$color='#445eb2';
	$colgb='rgba(68,94,178,.8)';
	$colas='cannouncement';
} else if($type=='Support'){
	$color='#c60033';
	$colgb='rgba(198,0,51,.8)';
	$colas='csupport';
} else if($type=='Quiz'){
	$color='#c60033';
	$colgb='rgba(198,0,51,.8)';
	$colas='cquiz';
} else if($type=='Quote'){
	$color='#98b4b3';
	$colgb='rgba(152,180,179,.8)';
	$colas='cquote';
} 



if($background=='image'){
	if($type=='Video'){
		$final=$final."<li class='vidclick have' data-id='//www.youtube.com/embed/".$url."?enablejsapi=1&amp;html5=1&rel=0'><a><img src='admin/uploads/image/".$img."'/><img class='draft' src='img/draf.png'/><div class='".$hidetitle." title-block' style='background:".$colgb."'>".$type."</div><div class='".$colas." lip-block'><div class='lip-txt hnews'>".$pagetitle."</div><div class='lip-date ".$hidedate."'>".$dater."</div></div></a></li>";	
	}else if($type=='Life in numbers'||$type=='Visualization'||$type=='Support'||$type=='Quiz'||$type=='Quote'){
		$final=$final."<li class='have'><a href='".$url."'><img src='admin/uploads/image/".$img."'/><img class='draft' src='img/draft.png'/><div class='".$hidetitle." title-block' style='background:".$colgb."'>".$type."</div><div class='".$colas." lip-block'><div class='lip-txt hnews'>".$pagetitle."</div><div class='lip-date ".$hidedate."'>".$dater."</div></div></a></li>";
	}else if($type=='News'){
		$final=$final."<li class='have'><a href='i?url=".$url."&o=".$offset."'><img src='admin/uploads/image/".$img."'/><img class='draft' src='img/draft.png'/><div class='".$hidetitle." title-block' style='background:".$colgb."'>".$type."</div><div class='".$colas." lip-block'><div class='lip-txt hnews'>".$pagetitle."</div><div class='lip-date ".$hidedate."'>".$dater."</div></div></a></li>";
	}else if($type=='Announcement'||$type=='Exclusive'){
		$final=$final."<li class='have'><a href='article.php?p=".$pageid."'><img src='admin/uploads/image/".$img."'/><img class='draft' src='img/draft.png'/><div class='".$hidetitle." title-block' style='background:".$colgb."'>".$type."</div><div class='".$colas." lip-block'><div class='lip-txt hnews'>".$pagetitle."</div><div class='lip-date ".$hidedate."'>".$dater."</div></div></a></li>";	
	}	
} else{
	if($type=='Video'){
		$final=$final."<li style='background:".$color."' class='vidclick have' data-id='//www.youtube.com/embed/".$url."?enablejsapi=1&amp;html5=1&rel=0'><a><img style='visibility:hidden' class='draft' src='img/draf.png'/><div class='".$hidetitle." title-sblock'>".$type."</div><div class='lip-sblock'><div class='lip-stit'>".$pagetitle."</div><div class='lip-subtit'>".$subtitle."</div><div class='lip-sdate ".$hidedate."'>".$dater."</div></div></a></li>";	
	}else if($type=='Life in numbers'||$type=='Visualization'||$type=='Support'||$type=='Quiz'||$type=='Quote'){
		$final=$final."<li style='background:".$color."' class='have'><a href='".$url."'><img class='draft' style='visibility:hidden' src='img/draft.png'/><div class='".$hidetitle." title-sblock'>".$type."</div><div class='lip-sblock'><div class='lip-stit'>".$pagetitle."</div><div class='lip-subtit'>".$subtitle."</div><div class='lip-sdate ".$hidedate."'>".$dater."</div></div></a></li>";
	}else if($type=='News'){
		$final=$final."<li style='background:".$color."' class='have'><a href='i?url=".$url."&o=".$offset."'><img class='draft' style='visibility:hidden' src='img/draft.png'/><div class='".$hidetitle." title-sblock'>".$type."</div><div class='lip-sblock'><div class='lip-stit'>".$pagetitle."</div><div class='lip-subtit'>".$subtitle."</div><div class='lip-sdate ".$hidedate."'>".$dater."</div></div></a></li>";
	}else if($type=='Announcement'||$type=='Exclusive'){
		$final=$final."<li style='background:".$color."' class='have'><a href='article.php?p=".$pageid."'><img class='draft' style='visibility:hidden' src='img/draft.png'/><div class='".$hidetitle." title-sblock'>".$type."</div><div class='lip-sblock'><div class='lip-stit'>".$pagetitle."</div><div class='lip-subtit'>".$subtitle."</div><div class='lip-sdate ".$hidedate."'>".$dater."</div></div></a></li>";
	}	
}







//A2
$count++;
$temp=0;
$aes = mysqli_query($con,"SELECT id FROM couch_pages WHERE template_id=11 AND publish_date <> '0000-00-00 00:00:00' ORDER BY publish_date DESC");
while($aow = mysqli_fetch_array($aes)){ 
	
	$id=$aow['id'];
	
	$bes = mysqli_query($con,"SELECT value FROM couch_data_text WHERE page_id=$id AND field_id=174");
	while($bow = mysqli_fetch_array($bes)){ 
		$value=$bow['value'];
	}

	if($value==0){
		$temp++;
	}

	if( ($temp==$count) ){
		$pageid=$id;
		break;
	} 
}

$aes = mysqli_query($con,"SELECT search_value FROM couch_data_text WHERE page_id=$pageid AND field_id=160");
while($aow = mysqli_fetch_array($aes)){ 
	$type=$aow['search_value'];
}

$aes = mysqli_query($con,"SELECT search_value FROM couch_data_text WHERE page_id=$pageid AND field_id=162");
while($aow = mysqli_fetch_array($aes)){ 
	$subtitle=$aow['search_value'];
}

$aes = mysqli_query($con,"SELECT search_value FROM couch_data_text WHERE page_id=$pageid AND field_id=164");
while($aow = mysqli_fetch_array($aes)){ 
	$img=$aow['search_value'];
}

$aes = mysqli_query($con,"SELECT search_value FROM couch_data_text WHERE page_id=$pageid AND field_id=176");
while($aow = mysqli_fetch_array($aes)){ 
	$url=$aow['search_value'];
}

$aes = mysqli_query($con,"SELECT search_value FROM couch_data_text WHERE page_id=$pageid AND field_id=177");
while($aow = mysqli_fetch_array($aes)){ 
	$offset=$aow['search_value'];
}

$aes = mysqli_query($con,"SELECT search_value FROM couch_data_text WHERE page_id=$pageid AND field_id=179");
while($aow = mysqli_fetch_array($aes)){ 
	$hidetitle=$aow['search_value'];
}

$aes = mysqli_query($con,"SELECT search_value FROM couch_data_text WHERE page_id=$pageid AND field_id=184");
while($aow = mysqli_fetch_array($aes)){ 
    $hidedate=$aow['search_value'];
}


$aes = mysqli_query($con,"SELECT search_value FROM couch_data_text WHERE page_id=$pageid AND field_id=175");
while($aow = mysqli_fetch_array($aes)){ 
	$background=$aow['search_value'];
}

$res = mysqli_query($con,"SELECT page_title,publish_date FROM couch_pages WHERE id='$pageid'");
while($row = mysqli_fetch_array($res)){ 
    $pagetitle= $row['page_title'];
    $date = $row['publish_date'];
}
$year = substr($date,0,4);
$mon = substr($date,5,2);
$day = substr($date,8,2);
if($mon=='01'){$month='January';}
if($mon=='02'){$month='February';}
if($mon=='03'){$month='March';}
if($mon=='04'){$month='April';}
if($mon=='05'){$month='May';}
if($mon=='06'){$month='June';}
if($mon=='07'){$month='July';}
if($mon=='08'){$month='August';}
if($mon=='09'){$month='September';}
if($mon=='10'){$month='October';}
if($mon=='11'){$month='November';}
if($mon=='12'){$month='December';}
$dater=$month.' '.$day.', '.$year;

if($type=='News'){
	$color='#ff6d00';
	$colgb='rgba(255,109,0,.8)';
	$colas='cnews';
} else if($type=='Exclusive'){
	$color='#3a98b4';
	$colgb='rgba(58,152,180,.8)';
	$colas='cexclusive';
} else if($type=='Visualization'){
	$color='#5ca41a';
	$colgb='rgba(92,164,26,.8)';
	$colas='cdata';
} else if($type=='Video'){
	$color='#157d9a';
	$colgb='rgba(243,60,55,.8)';
	$colas='cvideo';
} else if($type=='Life in numbers'){
	$color='#635c4c';
	$colgb='rgba(99,92,76,.8)';
	$colas='clife';
} else if($type=='Announcement'){
	$color='#445eb2';
	$colgb='rgba(68,94,178,.8)';
	$colas='cannouncement';
} else if($type=='Support'){
	$color='#c60033';
	$colgb='rgba(198,0,51,.8)';
	$colas='csupport';
} else if($type=='Quiz'){
	$color='#c60033';
	$colgb='rgba(198,0,51,.8)';
	$colas='cquiz';
} else if($type=='Quote'){
	$color='#98b4b3';
	$colgb='rgba(152,180,179,.8)';
	$colas='cquote';
} 



if($background=='image'){
	if($type=='Video'){
		$final=$final."<li class='vidclick have' data-id='//www.youtube.com/embed/".$url."?enablejsapi=1&amp;html5=1&rel=0'><a><img src='admin/uploads/image/".$img."'/><img class='draft' src='img/draf.png'/><div class='".$hidetitle." title-block' style='background:".$colgb."'>".$type."</div><div class='".$colas." lip-block'><div class='lip-txt hnews'>".$pagetitle."</div><div class='lip-date ".$hidedate."'>".$dater."</div></div></a></li>";	
	}else if($type=='Life in numbers'||$type=='Visualization'||$type=='Support'||$type=='Quiz'||$type=='Quote'){
		$final=$final."<li class='have'><a href='".$url."'><img src='admin/uploads/image/".$img."'/><img class='draft' src='img/draft.png'/><div class='".$hidetitle." title-block' style='background:".$colgb."'>".$type."</div><div class='".$colas." lip-block'><div class='lip-txt hnews'>".$pagetitle."</div><div class='lip-date ".$hidedate."'>".$dater."</div></div></a></li>";
	}else if($type=='News'){
		$final=$final."<li class='have'><a href='i?url=".$url."&o=".$offset."'><img src='admin/uploads/image/".$img."'/><img class='draft' src='img/draft.png'/><div class='".$hidetitle." title-block' style='background:".$colgb."'>".$type."</div><div class='".$colas." lip-block'><div class='lip-txt hnews'>".$pagetitle."</div><div class='lip-date ".$hidedate."'>".$dater."</div></div></a></li>";
	}else if($type=='Announcement'||$type=='Exclusive'){
		$final=$final."<li class='have'><a href='article.php?p=".$pageid."'><img src='admin/uploads/image/".$img."'/><img class='draft' src='img/draft.png'/><div class='".$hidetitle." title-block' style='background:".$colgb."'>".$type."</div><div class='".$colas." lip-block'><div class='lip-txt hnews'>".$pagetitle."</div><div class='lip-date ".$hidedate."'>".$dater."</div></div></a></li>";	
	}	
} else{
	if($type=='Video'){
		$final=$final."<li style='background:".$color."' class='vidclick have' data-id='//www.youtube.com/embed/".$url."?enablejsapi=1&amp;html5=1&rel=0'><a><img style='visibility:hidden' class='draft' src='img/draf.png'/><div class='".$hidetitle." title-sblock'>".$type."</div><div class='lip-sblock'><div class='lip-stit'>".$pagetitle."</div><div class='lip-subtit'>".$subtitle."</div><div class='lip-sdate ".$hidedate."'>".$dater."</div></div></a></li>";	
	}else if($type=='Life in numbers'||$type=='Visualization'||$type=='Support'||$type=='Quiz'||$type=='Quote'){
		$final=$final."<li style='background:".$color."' class='have'><a href='".$url."'><img class='draft' style='visibility:hidden' src='img/draft.png'/><div class='".$hidetitle." title-sblock'>".$type."</div><div class='lip-sblock'><div class='lip-stit'>".$pagetitle."</div><div class='lip-subtit'>".$subtitle."</div><div class='lip-sdate ".$hidedate."'>".$dater."</div></div></a></li>";
	}else if($type=='News'){
		$final=$final."<li style='background:".$color."' class='have'><a href='i?url=".$url."&o=".$offset."'><img class='draft' style='visibility:hidden' src='img/draft.png'/><div class='".$hidetitle." title-sblock'>".$type."</div><div class='lip-sblock'><div class='lip-stit'>".$pagetitle."</div><div class='lip-subtit'>".$subtitle."</div><div class='lip-sdate ".$hidedate."'>".$dater."</div></div></a></li>";
	}else if($type=='Announcement'||$type=='Exclusive'){
		$final=$final."<li style='background:".$color."' class='have'><a href='article.php?p=".$pageid."'><img class='draft' style='visibility:hidden' src='img/draft.png'/><div class='".$hidetitle." title-sblock'>".$type."</div><div class='lip-sblock'><div class='lip-stit'>".$pagetitle."</div><div class='lip-subtit'>".$subtitle."</div><div class='lip-sdate ".$hidedate."'>".$dater."</div></div></a></li>";
	}	
}




//A3
$count++;
$temp=0;
$aes = mysqli_query($con,"SELECT id FROM couch_pages WHERE template_id=11 AND publish_date <> '0000-00-00 00:00:00' ORDER BY publish_date DESC");
while($aow = mysqli_fetch_array($aes)){ 
	
	$id=$aow['id'];
	
	$bes = mysqli_query($con,"SELECT value FROM couch_data_text WHERE page_id=$id AND field_id=174");
	while($bow = mysqli_fetch_array($bes)){ 
		$value=$bow['value'];
	}

	if($value==0){
		$temp++;
	}

	if( ($temp==$count) ){
		$pageid=$id;
		break;
	} 
}
$aes = mysqli_query($con,"SELECT search_value FROM couch_data_text WHERE page_id=$pageid AND field_id=160");
while($aow = mysqli_fetch_array($aes)){ 
	$type=$aow['search_value'];
}

$aes = mysqli_query($con,"SELECT search_value FROM couch_data_text WHERE page_id=$pageid AND field_id=162");
while($aow = mysqli_fetch_array($aes)){ 
	$subtitle=$aow['search_value'];
}

$aes = mysqli_query($con,"SELECT search_value FROM couch_data_text WHERE page_id=$pageid AND field_id=164");
while($aow = mysqli_fetch_array($aes)){ 
	$img=$aow['search_value'];
}

$aes = mysqli_query($con,"SELECT search_value FROM couch_data_text WHERE page_id=$pageid AND field_id=176");
while($aow = mysqli_fetch_array($aes)){ 
	$url=$aow['search_value'];
}

$aes = mysqli_query($con,"SELECT search_value FROM couch_data_text WHERE page_id=$pageid AND field_id=177");
while($aow = mysqli_fetch_array($aes)){ 
	$offset=$aow['search_value'];
}

$aes = mysqli_query($con,"SELECT search_value FROM couch_data_text WHERE page_id=$pageid AND field_id=179");
while($aow = mysqli_fetch_array($aes)){ 
	$hidetitle=$aow['search_value'];
}

$aes = mysqli_query($con,"SELECT search_value FROM couch_data_text WHERE page_id=$pageid AND field_id=184");
while($aow = mysqli_fetch_array($aes)){ 
    $hidedate=$aow['search_value'];
}


$aes = mysqli_query($con,"SELECT search_value FROM couch_data_text WHERE page_id=$pageid AND field_id=175");
while($aow = mysqli_fetch_array($aes)){ 
	$background=$aow['search_value'];
}

$res = mysqli_query($con,"SELECT page_title,publish_date FROM couch_pages WHERE id='$pageid'");
while($row = mysqli_fetch_array($res)){ 
    $pagetitle= $row['page_title'];
    $date = $row['publish_date'];
}
$year = substr($date,0,4);
$mon = substr($date,5,2);
$day = substr($date,8,2);
if($mon=='01'){$month='January';}
if($mon=='02'){$month='February';}
if($mon=='03'){$month='March';}
if($mon=='04'){$month='April';}
if($mon=='05'){$month='May';}
if($mon=='06'){$month='June';}
if($mon=='07'){$month='July';}
if($mon=='08'){$month='August';}
if($mon=='09'){$month='September';}
if($mon=='10'){$month='October';}
if($mon=='11'){$month='November';}
if($mon=='12'){$month='December';}
$dater=$month.' '.$day.', '.$year;

if($type=='News'){
	$color='#ff6d00';
	$colgb='rgba(255,109,0,.8)';
	$colas='cnews';
} else if($type=='Exclusive'){
	$color='#3a98b4';
	$colgb='rgba(58,152,180,.8)';
	$colas='cexclusive';
} else if($type=='Visualization'){
	$color='#5ca41a';
	$colgb='rgba(92,164,26,.8)';
	$colas='cdata';
} else if($type=='Video'){
	$color='#157d9a';
	$colgb='rgba(243,60,55,.8)';
	$colas='cvideo';
} else if($type=='Life in numbers'){
	$color='#635c4c';
	$colgb='rgba(99,92,76,.8)';
	$colas='clife';
} else if($type=='Announcement'){
	$color='#445eb2';
	$colgb='rgba(68,94,178,.8)';
	$colas='cannouncement';
} else if($type=='Support'){
	$color='#c60033';
	$colgb='rgba(198,0,51,.8)';
	$colas='csupport';
} else if($type=='Quiz'){
	$color='#c60033';
	$colgb='rgba(198,0,51,.8)';
	$colas='cquiz';
} else if($type=='Quote'){
	$color='#98b4b3';
	$colgb='rgba(152,180,179,.8)';
	$colas='cquote';
} 



if($background=='image'){
	if($type=='Video'){
		$final=$final."<li class='vidclick ' data-id='//www.youtube.com/embed/".$url."?enablejsapi=1&amp;html5=1&rel=0'><a><img src='admin/uploads/image/".$img."'/><img class='draft' src='img/draf.png'/><div class='".$hidetitle." title-block' style='background:".$colgb."'>".$type."</div><div class='".$colas." lip-block'><div class='lip-txt hnews'>".$pagetitle."</div><div class='lip-date ".$hidedate."'>".$dater."</div></div></a></li>";	
	}else if($type=='Life in numbers'||$type=='Visualization'||$type=='Support'||$type=='Quiz'||$type=='Quote'){
		$final=$final."<li class=''><a href='".$url."'><img src='admin/uploads/image/".$img."'/><img class='draft' src='img/draft.png'/><div class='".$hidetitle." title-block' style='background:".$colgb."'>".$type."</div><div class='".$colas." lip-block'><div class='lip-txt hnews'>".$pagetitle."</div><div class='lip-date ".$hidedate."'>".$dater."</div></div></a></li>";
	}else if($type=='News'){
		$final=$final."<li class=''><a href='i?url=".$url."&o=".$offset."'><img src='admin/uploads/image/".$img."'/><img class='draft' src='img/draft.png'/><div class='".$hidetitle." title-block' style='background:".$colgb."'>".$type."</div><div class='".$colas." lip-block'><div class='lip-txt hnews'>".$pagetitle."</div><div class='lip-date ".$hidedate."'>".$dater."</div></div></a></li>";
	}else if($type=='Announcement'||$type=='Exclusive'){
		$final=$final."<li class=''><a href='article.php?p=".$pageid."'><img src='admin/uploads/image/".$img."'/><img class='draft' src='img/draft.png'/><div class='".$hidetitle." title-block' style='background:".$colgb."'>".$type."</div><div class='".$colas." lip-block'><div class='lip-txt hnews'>".$pagetitle."</div><div class='lip-date ".$hidedate."'>".$dater."</div></div></a></li>";	
	}	
} else{
	if($type=='Video'){
		$final=$final."<li style='background:".$color."' class='vidclick ' data-id='//www.youtube.com/embed/".$url."?enablejsapi=1&amp;html5=1&rel=0'><a><img style='visibility:hidden' class='draft' src='img/draf.png'/><div class='".$hidetitle." title-sblock'>".$type."</div><div class='lip-sblock'><div class='lip-stit'>".$pagetitle."</div><div class='lip-subtit'>".$subtitle."</div><div class='lip-sdate ".$hidedate."'>".$dater."</div></div></a></li>";	
	}else if($type=='Life in numbers'||$type=='Visualization'||$type=='Support'||$type=='Quiz'||$type=='Quote'){
		$final=$final."<li style='background:".$color."' class=''><a href='".$url."'><img class='draft' style='visibility:hidden' src='img/draft.png'/><div class='".$hidetitle." title-sblock'>".$type."</div><div class='lip-sblock'><div class='lip-stit'>".$pagetitle."</div><div class='lip-subtit'>".$subtitle."</div><div class='lip-sdate ".$hidedate."'>".$dater."</div></div></a></li>";
	}else if($type=='News'){
		$final=$final."<li style='background:".$color."' class=''><a href='i?url=".$url."&o=".$offset."'><img class='draft' style='visibility:hidden' src='img/draft.png'/><div class='".$hidetitle." title-sblock'>".$type."</div><div class='lip-sblock'><div class='lip-stit'>".$pagetitle."</div><div class='lip-subtit'>".$subtitle."</div><div class='lip-sdate ".$hidedate."'>".$dater."</div></div></a></li>";
	}else if($type=='Announcement'||$type=='Exclusive'){
		$final=$final."<li style='background:".$color."' class=''><a href='article.php?p=".$pageid."'><img class='draft' style='visibility:hidden' src='img/draft.png'/><div class='".$hidetitle." title-sblock'>".$type."</div><div class='lip-sblock'><div class='lip-stit'>".$pagetitle."</div><div class='lip-subtit'>".$subtitle."</div><div class='lip-sdate ".$hidedate."'>".$dater."</div></div></a></li>";
	}	
}




$final=$final."</ul><ul class='bleft'> ";
//A4
$count++;
$temp=0;
$aes = mysqli_query($con,"SELECT id FROM couch_pages WHERE template_id=11 AND publish_date <> '0000-00-00 00:00:00' ORDER BY publish_date DESC");
while($aow = mysqli_fetch_array($aes)){ 
	
	$id=$aow['id'];
	
	$bes = mysqli_query($con,"SELECT value FROM couch_data_text WHERE page_id=$id AND field_id=174");
	while($bow = mysqli_fetch_array($bes)){ 
		$value=$bow['value'];
	}

	if($value==0){
		$temp++;
	}

	if( ($temp==$count) ){
		$pageid=$id;
		break;
	} 
}

$aes = mysqli_query($con,"SELECT search_value FROM couch_data_text WHERE page_id=$pageid AND field_id=160");
while($aow = mysqli_fetch_array($aes)){ 
	$type=$aow['search_value'];
}

$aes = mysqli_query($con,"SELECT search_value FROM couch_data_text WHERE page_id=$pageid AND field_id=162");
while($aow = mysqli_fetch_array($aes)){ 
	$subtitle=$aow['search_value'];
}

$aes = mysqli_query($con,"SELECT search_value FROM couch_data_text WHERE page_id=$pageid AND field_id=164");
while($aow = mysqli_fetch_array($aes)){ 
	$img=$aow['search_value'];
}

$aes = mysqli_query($con,"SELECT search_value FROM couch_data_text WHERE page_id=$pageid AND field_id=176");
while($aow = mysqli_fetch_array($aes)){ 
	$url=$aow['search_value'];
}

$aes = mysqli_query($con,"SELECT search_value FROM couch_data_text WHERE page_id=$pageid AND field_id=177");
while($aow = mysqli_fetch_array($aes)){ 
	$offset=$aow['search_value'];
}

$aes = mysqli_query($con,"SELECT search_value FROM couch_data_text WHERE page_id=$pageid AND field_id=179");
while($aow = mysqli_fetch_array($aes)){ 
	$hidetitle=$aow['search_value'];
}

$aes = mysqli_query($con,"SELECT search_value FROM couch_data_text WHERE page_id=$pageid AND field_id=184");
while($aow = mysqli_fetch_array($aes)){ 
    $hidedate=$aow['search_value'];
}


$aes = mysqli_query($con,"SELECT search_value FROM couch_data_text WHERE page_id=$pageid AND field_id=175");
while($aow = mysqli_fetch_array($aes)){ 
	$background=$aow['search_value'];
}

$res = mysqli_query($con,"SELECT page_title,publish_date FROM couch_pages WHERE id='$pageid'");
while($row = mysqli_fetch_array($res)){ 
    $pagetitle= $row['page_title'];
    $date = $row['publish_date'];
}
$year = substr($date,0,4);
$mon = substr($date,5,2);
$day = substr($date,8,2);
if($mon=='01'){$month='January';}
if($mon=='02'){$month='February';}
if($mon=='03'){$month='March';}
if($mon=='04'){$month='April';}
if($mon=='05'){$month='May';}
if($mon=='06'){$month='June';}
if($mon=='07'){$month='July';}
if($mon=='08'){$month='August';}
if($mon=='09'){$month='September';}
if($mon=='10'){$month='October';}
if($mon=='11'){$month='November';}
if($mon=='12'){$month='December';}
$dater=$month.' '.$day.', '.$year;

if($type=='News'){
	$color='#ff6d00';
	$colgb='rgba(255,109,0,.8)';
	$colas='cnews';
} else if($type=='Exclusive'){
	$color='#3a98b4';
	$colgb='rgba(58,152,180,.8)';
	$colas='cexclusive';
} else if($type=='Visualization'){
	$color='#5ca41a';
	$colgb='rgba(92,164,26,.8)';
	$colas='cdata';
} else if($type=='Video'){
	$color='#157d9a';
	$colgb='rgba(243,60,55,.8)';
	$colas='cvideo';
} else if($type=='Life in numbers'){
	$color='#635c4c';
	$colgb='rgba(99,92,76,.8)';
	$colas='clife';
} else if($type=='Announcement'){
	$color='#445eb2';
	$colgb='rgba(68,94,178,.8)';
	$colas='cannouncement';
} else if($type=='Support'){
	$color='#c60033';
	$colgb='rgba(198,0,51,.8)';
	$colas='csupport';
} else if($type=='Quiz'){
	$color='#c60033';
	$colgb='rgba(198,0,51,.8)';
	$colas='cquiz';
} else if($type=='Quote'){
	$color='#98b4b3';
	$colgb='rgba(152,180,179,.8)';
	$colas='cquote';
} 

if($section%10==0){
	$count--;
	$final=$final."<li class='newsletter' style='background:#2199bc;cursor:auto'><img class='draft' style='visibility:hidden' src='img/draft.png'/><div class='title-sblock'>newsletter</div><div class='lip-sblock'><div class='lip-stit'>Get optimistic news delivered directly to your inbox.</div><!-- Begin MailChimp Signup Form --><div id='mc_embed_signup'><form action='//intridea.us7.list-manage.com/subscribe/post?u=060e9ce478d4bf4b205da26b9&amp;id=8bc45b6260' method='post' id='mc-embedded-subscribe-form' name='mc-embedded-subscribe-form' class='validate' novalidate><div id='mc_embed_signup_scroll'>
<div class='mc-field-group'>
	<input type='email' placeholder='Your email' value='' name='EMAIL' class='required email' id='mce-EMAIL'>
	<input type='submit' value='Subscribe' name='subscribe' id='mc-embedded-subscribe' class='button subbb'>
</div>
	<div id='mce-responses' class='clear'>
		<div class='response' id='mce-error-response' style='display:none'></div>
		<div class='response' id='mce-success-response' style='display:none'></div>
	</div>    <!-- real people should not fill this in and expect good things - do not remove this or risk form bot signups-->
    <div style='position: absolute; left: -5000px;' aria-hidden='true'><input type='text' name='b_060e9ce478d4bf4b205da26b9_8bc45b6260' tabindex='-1' value=''></div>
    
    </div>
</form>
</div>
<script type='text/javascript' src='//s3.amazonaws.com/downloads.mailchimp.com/js/mc-validate.js'></script><script type='text/javascript'>(function($) {window.fnames = new Array(); window.ftypes = new Array();fnames[0]='EMAIL';ftypes[0]='email';fnames[1]='FNAME';ftypes[1]='text';fnames[2]='LNAME';ftypes[2]='text';}(jQuery));</script>
<!--End mc_embed_signup--></div></li>";
} else{
	if($background=='image'){
		if($type=='Video'){
			$final=$final."<li class='vidclick ' data-id='//www.youtube.com/embed/".$url."?enablejsapi=1&amp;html5=1&rel=0'><a><img src='admin/uploads/image/".$img."'/><img class='draft' src='img/draf.png'/><div class='".$hidetitle." title-block' style='background:".$colgb."'>".$type."</div><div class='".$colas." lip-block'><div class='lip-txt hnews'>".$pagetitle."</div><div class='lip-date ".$hidedate."'>".$dater."</div></div></a></li>";	
		}else if($type=='Life in numbers'||$type=='Visualization'||$type=='Support'||$type=='Quiz'||$type=='Quote'){
			$final=$final."<li class=''><a href='".$url."'><img src='admin/uploads/image/".$img."'/><img class='draft' src='img/draft.png'/><div class='".$hidetitle." title-block' style='background:".$colgb."'>".$type."</div><div class='".$colas." lip-block'><div class='lip-txt hnews'>".$pagetitle."</div><div class='lip-date ".$hidedate."'>".$dater."</div></div></a></li>";
		}else if($type=='News'){
			$final=$final."<li class=''><a href='i?url=".$url."&o=".$offset."'><img src='admin/uploads/image/".$img."'/><img class='draft' src='img/draft.png'/><div class='".$hidetitle." title-block' style='background:".$colgb."'>".$type."</div><div class='".$colas." lip-block'><div class='lip-txt hnews'>".$pagetitle."</div><div class='lip-date ".$hidedate."'>".$dater."</div></div></a></li>";
		}else if($type=='Announcement'||$type=='Exclusive'){
			$final=$final."<li class=''><a href='article.php?p=".$pageid."'><img src='admin/uploads/image/".$img."'/><img class='draft' src='img/draft.png'/><div class='".$hidetitle." title-block' style='background:".$colgb."'>".$type."</div><div class='".$colas." lip-block'><div class='lip-txt hnews'>".$pagetitle."</div><div class='lip-date ".$hidedate."'>".$dater."</div></div></a></li>";	
		}	
	} else{
		if($type=='Video'){
			$final=$final."<li style='background:".$color."' class='vidclick ' data-id='//www.youtube.com/embed/".$url."?enablejsapi=1&amp;html5=1&rel=0'><a><img style='visibility:hidden' class='draft' src='img/draf.png'/><div class='".$hidetitle." title-sblock'>".$type."</div><div class='lip-sblock'><div class='lip-stit'>".$pagetitle."</div><div class='lip-subtit'>".$subtitle."</div><div class='lip-sdate ".$hidedate."'>".$dater."</div></div></a></li>";	
		}else if($type=='Life in numbers'||$type=='Visualization'||$type=='Support'||$type=='Quiz'||$type=='Quote'){
			$final=$final."<li style='background:".$color."' class=''><a href='".$url."'><img class='draft' style='visibility:hidden' src='img/draft.png'/><div class='".$hidetitle." title-sblock'>".$type."</div><div class='lip-sblock'><div class='lip-stit'>".$pagetitle."</div><div class='lip-subtit'>".$subtitle."</div><div class='lip-sdate ".$hidedate."'>".$dater."</div></div></a></li>";
		}else if($type=='News'){
			$final=$final."<li style='background:".$color."' class=''><a href='i?url=".$url."&o=".$offset."'><img class='draft' style='visibility:hidden' src='img/draft.png'/><div class='".$hidetitle." title-sblock'>".$type."</div><div class='lip-sblock'><div class='lip-stit'>".$pagetitle."</div><div class='lip-subtit'>".$subtitle."</div><div class='lip-sdate ".$hidedate."'>".$dater."</div></div></a></li>";
		}else if($type=='Announcement'||$type=='Exclusive'){
			$final=$final."<li style='background:".$color."' class=''><a href='article.php?p=".$pageid."'><img class='draft' style='visibility:hidden' src='img/draft.png'/><div class='".$hidetitle." title-sblock'>".$type."</div><div class='lip-sblock'><div class='lip-stit'>".$pagetitle."</div><div class='lip-subtit'>".$subtitle."</div><div class='lip-sdate ".$hidedate."'>".$dater."</div></div></a></li>";
		}	
	}

}




//A5
$count++;
$temp=0;
$aes = mysqli_query($con,"SELECT id FROM couch_pages WHERE template_id=11 AND publish_date <> '0000-00-00 00:00:00' ORDER BY publish_date DESC");
while($aow = mysqli_fetch_array($aes)){ 
	
	$id=$aow['id'];
	
	$bes = mysqli_query($con,"SELECT value FROM couch_data_text WHERE page_id=$id AND field_id=174");
	while($bow = mysqli_fetch_array($bes)){ 
		$value=$bow['value'];
	}

	if($value==0){
		$temp++;
	}

	if( ($temp==$count) ){
		$pageid=$id;
		break;
	} 
}

$aes = mysqli_query($con,"SELECT search_value FROM couch_data_text WHERE page_id=$pageid AND field_id=160");
while($aow = mysqli_fetch_array($aes)){ 
	$type=$aow['search_value'];
}

$aes = mysqli_query($con,"SELECT search_value FROM couch_data_text WHERE page_id=$pageid AND field_id=162");
while($aow = mysqli_fetch_array($aes)){ 
	$subtitle=$aow['search_value'];
}

$aes = mysqli_query($con,"SELECT search_value FROM couch_data_text WHERE page_id=$pageid AND field_id=164");
while($aow = mysqli_fetch_array($aes)){ 
	$img=$aow['search_value'];
}

$aes = mysqli_query($con,"SELECT search_value FROM couch_data_text WHERE page_id=$pageid AND field_id=176");
while($aow = mysqli_fetch_array($aes)){ 
	$url=$aow['search_value'];
}

$aes = mysqli_query($con,"SELECT search_value FROM couch_data_text WHERE page_id=$pageid AND field_id=177");
while($aow = mysqli_fetch_array($aes)){ 
	$offset=$aow['search_value'];
}

$aes = mysqli_query($con,"SELECT search_value FROM couch_data_text WHERE page_id=$pageid AND field_id=179");
while($aow = mysqli_fetch_array($aes)){ 
	$hidetitle=$aow['search_value'];
}

$aes = mysqli_query($con,"SELECT search_value FROM couch_data_text WHERE page_id=$pageid AND field_id=184");
while($aow = mysqli_fetch_array($aes)){ 
    $hidedate=$aow['search_value'];
}


$aes = mysqli_query($con,"SELECT search_value FROM couch_data_text WHERE page_id=$pageid AND field_id=175");
while($aow = mysqli_fetch_array($aes)){ 
	$background=$aow['search_value'];
}

$res = mysqli_query($con,"SELECT page_title,publish_date FROM couch_pages WHERE id='$pageid'");
while($row = mysqli_fetch_array($res)){ 
    $pagetitle= $row['page_title'];
    $date = $row['publish_date'];
}
$year = substr($date,0,4);
$mon = substr($date,5,2);
$day = substr($date,8,2);
if($mon=='01'){$month='January';}
if($mon=='02'){$month='February';}
if($mon=='03'){$month='March';}
if($mon=='04'){$month='April';}
if($mon=='05'){$month='May';}
if($mon=='06'){$month='June';}
if($mon=='07'){$month='July';}
if($mon=='08'){$month='August';}
if($mon=='09'){$month='September';}
if($mon=='10'){$month='October';}
if($mon=='11'){$month='November';}
if($mon=='12'){$month='December';}
$dater=$month.' '.$day.', '.$year;

if($type=='News'){
	$color='#ff6d00';
	$colgb='rgba(255,109,0,.8)';
	$colas='cnews';
} else if($type=='Exclusive'){
	$color='#3a98b4';
	$colgb='rgba(58,152,180,.8)';
	$colas='cexclusive';
} else if($type=='Visualization'){
	$color='#5ca41a';
	$colgb='rgba(92,164,26,.8)';
	$colas='cdata';
} else if($type=='Video'){
	$color='#157d9a';
	$colgb='rgba(243,60,55,.8)';
	$colas='cvideo';
} else if($type=='Life in numbers'){
	$color='#635c4c';
	$colgb='rgba(99,92,76,.8)';
	$colas='clife';
} else if($type=='Announcement'){
	$color='#445eb2';
	$colgb='rgba(68,94,178,.8)';
	$colas='cannouncement';
} else if($type=='Support'){
	$color='#c60033';
	$colgb='rgba(198,0,51,.8)';
	$colas='csupport';
} else if($type=='Quiz'){
	$color='#c60033';
	$colgb='rgba(198,0,51,.8)';
	$colas='cquiz';
} else if($type=='Quote'){
	$color='#98b4b3';
	$colgb='rgba(152,180,179,.8)';
	$colas='cquote';
} 

if($background=='image'){
	if($type=='Video'){
		$final=$final."<li class='last vidclick' data-id='//www.youtube.com/embed/".$url."?enablejsapi=1&amp;html5=1&rel=0'><a><img src='admin/uploads/image/".$img."'/><img class='draft' src='img/draf.png'/><div class='".$hidetitle." title-block' style='background:".$colgb."'>".$type."</div><div class='".$colas." lip-block'><div class='lip-txt hnews'>".$pagetitle."</div><div class='lip-date ".$hidedate."'>".$dater."</div></div></a></li>";	
	}else if($type=='Life in numbers'||$type=='Visualization'||$type=='Support'||$type=='Quiz'||$type=='Quote'){
		$final=$final."<li class='last '><a href='".$url."'><img src='admin/uploads/image/".$img."'/><img class='draft' src='img/draft.png'/><div class='".$hidetitle." title-block' style='background:".$colgb."'>".$type."</div><div class='".$colas." lip-block'><div class='lip-txt hnews'>".$pagetitle."</div><div class='lip-date ".$hidedate."'>".$dater."</div></div></a></li>";
	}else if($type=='News'){
		$final=$final."<li class='last '><a href='i?url=".$url."&o=".$offset."'><img src='admin/uploads/image/".$img."'/><img class='draft' src='img/draft.png'/><div class='".$hidetitle." title-block' style='background:".$colgb."'>".$type."</div><div class='".$colas." lip-block'><div class='lip-txt hnews'>".$pagetitle."</div><div class='lip-date ".$hidedate."'>".$dater."</div></div></a></li>";
	}else if($type=='Announcement'||$type=='Exclusive'){
		$final=$final."<li class='last'><a href='article.php?p=".$pageid."'><img src='admin/uploads/image/".$img."'/><img class='draft' src='img/draft.png'/><div class='".$hidetitle." title-block' style='background:".$colgb."'>".$type."</div><div class='".$colas." lip-block'><div class='lip-txt hnews'>".$pagetitle."</div><div class='lip-date ".$hidedate."'>".$dater."</div></div></a></li>";	
	}	
} else{
	if($type=='Video'){
		$final=$final."<li style='background:".$color."' class='vidclick last' data-id='//www.youtube.com/embed/".$url."?enablejsapi=1&amp;html5=1&rel=0'><a><img style='visibility:hidden' class='draft' src='img/draf.png'/><div class='".$hidetitle." title-sblock'>".$type."</div><div class='lip-sblock'><div class='lip-stit'>".$pagetitle."</div><div class='lip-subtit'>".$subtitle."</div><div class='lip-sdate ".$hidedate."'>".$dater."</div></div></a></li>";	
	}else if($type=='Life in numbers'||$type=='Visualization'||$type=='Support'||$type=='Quiz'||$type=='Quote'){
		$final=$final."<li style='background:".$color."' class='last'><a href='".$url."'><img class='draft' style='visibility:hidden' src='img/draft.png'/><div class='".$hidetitle." title-sblock'>".$type."</div><div class='lip-sblock'><div class='lip-stit'>".$pagetitle."</div><div class='lip-subtit'>".$subtitle."</div><div class='lip-sdate ".$hidedate."'>".$dater."</div></div></a></li>";
	}else if($type=='News'){
		$final=$final."<li style='background:".$color."' class='last'><a href='i?url=".$url."&o=".$offset."'><img class='draft' style='visibility:hidden' src='img/draft.png'/><div class='".$hidetitle." title-sblock'>".$type."</div><div class='lip-sblock'><div class='lip-stit'>".$pagetitle."</div><div class='lip-subtit'>".$subtitle."</div><div class='lip-sdate ".$hidedate."'>".$dater."</div></div></a></li>";
	}else if($type=='Announcement'||$type=='Exclusive'){
		$final=$final."<li style='background:".$color."' class='last'><a href='article.php?p=".$pageid."'><img class='draft' style='visibility:hidden' src='img/draft.png'/><div class='".$hidetitle." title-sblock'>".$type."</div><div class='lip-sblock'><div class='lip-stit'>".$pagetitle."</div><div class='lip-subtit'>".$subtitle."</div><div class='lip-sdate ".$hidedate."'>".$dater."</div></div></a></li>";
	}	
}





//A6
$sixcount++;
$temp=0;
$aes = mysqli_query($con,"SELECT id FROM couch_pages WHERE template_id=11 AND publish_date <> '0000-00-00 00:00:00' ORDER BY publish_date DESC");
while($aow = mysqli_fetch_array($aes)){ 
	
	$id=$aow['id'];
	
	$bes = mysqli_query($con,"SELECT value FROM couch_data_text WHERE page_id=$id AND field_id=174");
	while($bow = mysqli_fetch_array($bes)){ 
		$value=$bow['value'];
	}

	if($value==6){
		$temp++;
	}

	if( ($temp==$sixcount) ){
		$pageid=$id;
		break;
	} 
}

if($temp<$sixcount){
	$count++;
	$aes = mysqli_query($con,"SELECT id FROM couch_pages WHERE template_id=11 AND publish_date <> '0000-00-00 00:00:00' ORDER BY publish_date DESC");
	while($aow = mysqli_fetch_array($aes)){ 
		
		$id=$aow['id'];
		
		$bes = mysqli_query($con,"SELECT value FROM couch_data_text WHERE page_id=$id AND field_id=174");
		while($bow = mysqli_fetch_array($bes)){ 
			$value=$bow['value'];
		}

		$bes = mysqli_query($con,"SELECT value FROM couch_data_text WHERE page_id=$id AND field_id=175");
		while($bow = mysqli_fetch_array($bes)){ 
			$type=$bow['value'];
		}

		if($value==0&&$type=='image'){
			$temp++;
		}

		if( ($temp==$count) ){
			$pageid=$id;
			break;
		} 
	}
	$count++;
}

$aes = mysqli_query($con,"SELECT search_value FROM couch_data_text WHERE page_id=$pageid AND field_id=160");
while($aow = mysqli_fetch_array($aes)){ 
	$type=$aow['search_value'];
}

$aes = mysqli_query($con,"SELECT search_value FROM couch_data_text WHERE page_id=$pageid AND field_id=162");
while($aow = mysqli_fetch_array($aes)){ 
	$subtitle=$aow['search_value'];
}

$aes = mysqli_query($con,"SELECT search_value FROM couch_data_text WHERE page_id=$pageid AND field_id=164");
while($aow = mysqli_fetch_array($aes)){ 
	$img=$aow['search_value'];
}

$aes = mysqli_query($con,"SELECT search_value FROM couch_data_text WHERE page_id=$pageid AND field_id=176");
while($aow = mysqli_fetch_array($aes)){ 
	$url=$aow['search_value'];
}

$aes = mysqli_query($con,"SELECT search_value FROM couch_data_text WHERE page_id=$pageid AND field_id=177");
while($aow = mysqli_fetch_array($aes)){ 
	$offset=$aow['search_value'];
}

$aes = mysqli_query($con,"SELECT search_value FROM couch_data_text WHERE page_id=$pageid AND field_id=179");
while($aow = mysqli_fetch_array($aes)){ 
	$hidetitle=$aow['search_value'];
}

$aes = mysqli_query($con,"SELECT search_value FROM couch_data_text WHERE page_id=$pageid AND field_id=184");
while($aow = mysqli_fetch_array($aes)){ 
    $hidedate=$aow['search_value'];
}


$aes = mysqli_query($con,"SELECT search_value FROM couch_data_text WHERE page_id=$pageid AND field_id=175");
while($aow = mysqli_fetch_array($aes)){ 
	$background=$aow['search_value'];
}

$res = mysqli_query($con,"SELECT page_title,publish_date FROM couch_pages WHERE id='$pageid'");
while($row = mysqli_fetch_array($res)){ 
    $pagetitle= $row['page_title'];
    $date = $row['publish_date'];
}
$year = substr($date,0,4);
$mon = substr($date,5,2);
$day = substr($date,8,2);
if($mon=='01'){$month='January';}
if($mon=='02'){$month='February';}
if($mon=='03'){$month='March';}
if($mon=='04'){$month='April';}
if($mon=='05'){$month='May';}
if($mon=='06'){$month='June';}
if($mon=='07'){$month='July';}
if($mon=='08'){$month='August';}
if($mon=='09'){$month='September';}
if($mon=='10'){$month='October';}
if($mon=='11'){$month='November';}
if($mon=='12'){$month='December';}
$dater=$month.' '.$day.', '.$year;

if($type=='News'){
	$color='#ff6d00';
	$colgb='rgba(255,109,0,.8)';
	$colas='cnews';
} else if($type=='Exclusive'){
	$color='#3a98b4';
	$colgb='rgba(58,152,180,.8)';
	$colas='cexclusive';
} else if($type=='Visualization'){
	$color='#5ca41a';
	$colgb='rgba(92,164,26,.8)';
	$colas='cdata';
} else if($type=='Video'){
	$color='#157d9a';
	$colgb='rgba(243,60,55,.8)';
	$colas='cvideo';
} else if($type=='Life in numbers'){
	$color='#635c4c';
	$colgb='rgba(99,92,76,.8)';
	$colas='clife';
} else if($type=='Announcement'){
	$color='#445eb2';
	$colgb='rgba(68,94,178,.8)';
	$colas='cannouncement';
} else if($type=='Support'){
	$color='#c60033';
	$colgb='rgba(198,0,51,.8)';
	$colas='csupport';
} else if($type=='Quiz'){
	$color='#c60033';
	$colgb='rgba(198,0,51,.8)';
	$colas='cquiz';
} else if($type=='Quote'){
	$color='#98b4b3';
	$colgb='rgba(152,180,179,.8)';
	$colas='cquote';
} 

if($background=='image'){
	if($type=='Video'){
		$final=$final."</ul><ul class='bright'><li class='righter vidclick' data-id='https://www.youtube.com/embed/".$url."?enablejsapi=1&amp;html5=1&rel=0'><a><img src='admin/uploads/image/".$img."'/><img class='draft bigdraft' src='img/draf.png'/><div class='".$hidetitle." title-block bigtitle' style='background:".$colgb."'>".$type."</div><div class='".$colas." lip-block biglip'><div class='lip-txt hnews'>".$pagetitle."</div><div class='lip-date ".$hidedate."'>".$dater."</div></div></a></li></ul>";	
	}else if($type=='Life in numbers'||$type=='Visualization'||$type=='Support'||$type=='Quiz'||$type=='Quote'){
		$final=$final."</ul><ul class='bright'><li class='righter'><a href='".$url."'><img src='admin/uploads/image/".$img."'/><img class='draft bigdraft' src='img/draft.png'/><div class='".$hidetitle." title-block bigtitle' style='background:".$colgb."'>".$type."</div><div class='".$colas." lip-block biglip'><div class='lip-txt hnews'>".$pagetitle."</div><div class='lip-date ".$hidedate."'>".$dater."</div></div></a></li></ul>";
	}else if($type=='News'){
		$final=$final."</ul><ul class='bright'><li class='righter'><a href='i?url=".$url."&o=".$offset."'><img src='admin/uploads/image/".$img."'/><img class='draft bigdraft' src='img/draft.png'/><div class='".$hidetitle." title-block bigtitle' style='background:".$colgb."'>".$type."</div><div class='".$colas." lip-block biglip'><div class='lip-txt hnews'>".$pagetitle."</div><div class='lip-date ".$hidedate."'>".$dater."</div></div></a></li></ul>";
	}else if($type=='Announcement'||$type=='Exclusive'){
		$final=$final."</ul><ul class='bright'><li class='righter'><a href='article.php?p=".$pageid."'><img src='admin/uploads/image/".$img."'/><img class='draft bigdraft' src='img/draft.png'/><div class='".$hidetitle." title-block bigtitle' style='background:".$colgb."'>".$type."</div><div class='".$colas." lip-block biglip'><div class='lip-txt hnews'>".$pagetitle."</div><div class='lip-date ".$hidedate."'>".$dater."</div></div></a></li></ul>";	
	}	
} else{
	if($type=='Video'){
		$final=$final."</ul><ul class='bright'><li style='background:".$color."' class='righter vidclick' data-id='//www.youtube.com/embed/".$url."?enablejsapi=1&amp;html5=1&rel=0'><a><img style='visibility:hidden' class='draft bigdraft' src='img/draf.png'/><div class='".$hidetitle." title-sblock bigstitle'>".$type."</div><div class='lip-sblock bigsblock'><div class='lip-stit'>".$pagetitle."</div><div class='lip-subtit'>".$subtitle."</div><div class='lip-sdate ".$hidedate."'>".$dater."</div></div></a></li></ul>";	
	}else if($type=='Life in numbers'||$type=='Visualization'||$type=='Support'||$type=='Quiz'||$type=='Quote'){
		$final=$final."</ul><ul class='bright'><li style='background:".$color."' class='righter'><a href='".$url."'><img class='draft bigdraft' style='visibility:hidden' src='img/draf.png'/><div class='".$hidetitle." title-sblock bigstitle'>".$type."</div><div class='lip-sblock bigsblock'><div class='lip-stit'>".$pagetitle."</div><div class='lip-subtit'>".$subtitle."</div><div class='lip-sdate ".$hidedate."'>".$dater."</div></div></a></li></ul>";
	}else if($type=='News'){
		$final=$final."</ul><ul class='bright'><li style='background:".$color."' class='righter'><a href='i?url=".$url."&o=".$offset."'><img class='draft bigdraft' style='visibility:hidden' src='img/draf.png'/><div class='".$hidetitle." title-sblock bigstitle'>".$type."</div><div class='lip-sblock bigsblock'><div class='lip-stit'>".$pagetitle."</div><div class='lip-subtit'>".$subtitle."</div><div class='lip-sdate ".$hidedate."'>".$dater."</div></div></a></li></ul>";
	}else if($type=='Announcement'||$type=='Exclusive'){
		$final=$final."</ul><ul class='bright'><li style='background:".$color."' class='righter'><a href='article.php?p=".$pageid."'><img class='draft bigdraft' style='visibility:hidden' src='img/draf.png'/><div class='".$hidetitle." title-sblock bigstitle'>".$type."</div><div class='lip-sblock bigsblock'><div class='lip-stit'>".$pagetitle."</div><div class='lip-subtit'>".$subtitle."</div><div class='lip-sdate ".$hidedate."'>".$dater."</div></div></a></li></ul>";
	}	
}



  $data[0]=$count;
  $data[1]=$sixcount;
  $data[2]=$final;
  echo $_GET['callback'] . '('.json_encode($data).')';
  mysqli_close($con);
?>