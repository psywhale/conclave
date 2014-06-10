<?php

function makePass()
{
    $cons = "bcdfghjklmnpqrstvwxyz";
    $vocs = "aeiou";
    for ($x=0; $x < 8; $x++)
    {
        mt_srand ((double) microtime() * 1000000);
        $con[$x] = substr($cons, mt_rand(0, strlen($cons)-1), 1);
        $voc[$x] = substr($vocs, mt_rand(0, strlen($vocs)-1), 1);
    }
    $makepass = $con[0] . $voc[0] .$con[2] . $con[1] . $voc[1] . $con[3] . $voc[3] . $con[4];
    return(md5($makepass));
}

 //function getLimitsandSeats($conference = "")
 function getLimitsandSeats()
 {
 	global $CFG;
 	mysql_start();
 	$event_cls = new stdClass;
 	$query = "select * from conferences order by date;";
 	$event_results = mysql_query($query) or die("helps");
 	$x=0;
 	while($events = mysql_fetch_array($event_results))
 	 {
 	 	$event_cls->event[$x]->name = $events[title];
 	 	$event_cls->event[$x]->price = $events[price];
 	 	$event_cls->event[$x]->time = $events[time];
 	 	$event_cls->event[$x]->date = $events[date];

 	 	$event_cls->event[$x]->event_code = $events[event_code];
 	 	$event_cls->event[$x]->billing_code = $events[billing_code];
 	 	//var_dump($events);
 	 	$query = "select capacity from limits where event_code = '$events[event_code]';";
 	 	$capacity_results = mysql_query($query);
 	 	$row = mysql_fetch_row($capacity_results);
 	 	$event_cls->event[$x]->capacity = $row[0];

 	 	$query = "select count(*) from attendance where event_code = $events[event_code] and (paid = \"Y\" or paid = \"S\");";
 	 	$seatcount_results = mysql_query($query) or die("$query\n" . mysql_error());
 	 	$row = mysql_fetch_row($seatcount_results);
 	 	$event_cls->event[$x]->seats_taken = $row[0];
                $event_cls->event[$x]->seats_available = $event_cls->event[$x]->capacity - $event_cls->event[$x]->seats_taken;
                $query = "select count(*) from attendance where event_code = $events[event_code] and paid = \"N\";";
 	 	$seatcount_results = mysql_query($query) or die("$query\n" . mysql_error());
                $row = mysql_fetch_row($seatcount_results);
 	 	$event_cls->event[$x]->seats_askedfor = $row[0];
                
 	 	$x++;
 	 };




 	/*$query = "select capacity from limits where event =\"$conference\";";
 	$capacity_results = mysql_query($query);
 	$row = mysql_fetch_row($capacity_results);
 	$capacity[]=$row[0];
 	*/
 	mysql_stop();
 	//return($capacity);
 	return $event_cls;
 }
 
/******************
*
*
*******************/
function getEventCode($event="") {
   global $CFG;
    mysql_start();
    $query = "select event_code from conferences where billing_code = \"$event\" limit 1;";
    //echo $query;
    $results = mysql_query($query);
    $row = mysql_fetch_array($results) or die(mysql_error());
    //mysql_stop();
    mysql_stop();
    return $row[0];
}

function getEventName($event=0){
    global $CFG;
    mysql_start();
    if($event) {
     $query = "select title from conferences where event_code = \"$event\" limit 1";
     $results = mysql_query($query);
     $row = mysql_fetch_array($results) or die(mysql_error());
    }
    mysql_stop();
    return $row[0];
}

function getEventLimit($event_code=0){
    global $CFG;
    mysql_start();
    if($event_code) {
     $query = "select capacity from limits where event_code = \"$event_code\" limit 1";
     $results = mysql_query($query);
     $row = mysql_fetch_array($results);
    }
    mysql_stop();
    return $row[0];

}


function getAttendance($user_code="") {
    global $CFG;
    mysql_start();
    $query = "select conferences.title as title, conferences.event_code as event_code,attendance.ndx as ndx from conferences, attendance where attendance.user_code = \"$user_code\" and attendance.event_code = conferences.event_code";
    $results = mysql_query($query) or die(mysql_error());
    $events = array();
    $x =0;
    while($row = mysql_fetch_object($results)){
      $events[$x] = $row;
      $x++;
      }
      mysql_stop();
    return $events;
    
}

function getEvents() {
  global $CFG;
  mysql_start();
  $query = "select * from conferences;";
  $results = mysql_query($query) or die(mysql_error());
  $events=array();
  $x=0;
    while($row = mysql_fetch_object($results)){
      $events[$x] = $row;
      $x++;
      }
      mysql_stop();
    return $events;
}

function getEventPrice($event_code="") {
  
  if($event_code != "") {
 global $CFG;
mysql_start();
     $query = "select price from conferences where event_code = $event_code";
     $results = mysql_query($query) or die(mysql_error());
     $row = mysql_fetch_array($results);
     $price = preg_replace("/[^0-9]/","",$row[0]);
     mysql_stop();
     return $price;
  }
}


function getSeatsTaken($event_code=""){
  global $CFG;
mysql_start();
   if($event_code != "")
   {
     $query = "select count(*) as seats from attendance where event_code = $event_code and paid != \"N\" and paid !=\"D\";";
     $results = mysql_query($query) or die(mysql_error());
   //$seats = array();
   //$x =0;
    $row = mysql_fetch_array($results);
    mysql_stop();  
    return $row[0];
   }
}

function getEventsNotAttending($user_code="") {
   global $CFG;
mysql_start();
    //$query = "select conferences.title, conferences.event_code from conferences, attendance where attendance.user_code = \"$user_code\" and attendance.event_code != conferences.event_code";
    $query = "select * from (select conferences.title,conferences.date,conferences.time, conferences.event_code,regex_replace('[0-9:]','',conferences.time) as sorter,attendance.user_code from conferences left join attendance on attendance.event_code = conferences.event_code) as t1 where t1.user_code is null or t1.user_code !=\"$user_code\" group by t1.event_code order by t1.date,t1.sorter ";
    $results = mysql_query($query) or die(mysql_error());
    $events = array();
    $x =0;
    while($row = mysql_fetch_object($results)){
      $events[$x] = $row;
      $x++;
      }
      mysql_stop();
    return $events;
    
}

function getStats($field="",$cast=false) {
   global $CFG;
mysql_start();
    if($field) {
    $query = "select $field as name,count($field) as number from registration group by $field order by";
        if($cast){
        $query .= " cast($field as signed)";
        }
        else {
        $query .= " $field";
        }
    $results = mysql_query($query);
    $stats = array();
    $x =0;
    while($row = mysql_fetch_object($results)){
      $stats[$x] = $row;
      $x++;
      }
      mysql_stop();
    return $stats;

    }
}

function getUser($user_code="") {
   global $CFG;
mysql_start();
    $query = "select * from registration where security = \"$user_code\" limit 1;";
    $results = mysql_query($query);
    $row = mysql_fetch_array($results);
    mysql_stop();
    return $row;
}

function isPaid($user_code="",$event_code=0) {
   global $CFG;
mysql_start();
    $query = "select paid from attendance where user_code = \"$user_code\" and event_code = $event_code limit 1;";
    $results = mysql_query($query);
    $row = mysql_fetch_array($results);
    return $row[0];
    
}

function dropPaidEvent($user_code="",$event_code=0) {
   global $CFG;

    $isUser = getUser($user_code);
    mysql_start();
    if($isUser) {
       $query = "update attendance set paid = \"D\" where user_code = \"$user_code\" and event_code = \"$event_code\" limit 1;";
       $results = mysql_query($query);
       
    }
    else {
       die("user code not valid   CODE: $user_code");
    }
    
 }
 
function removeUserfromEvent($user_code="",$event_code=0,$ndx=null) {
   global $CFG;
    $isUser = getUser($user_code);
    if($isUser) {
      if($ndx){
       $query = "delete from attendance where user_code = \"$user_code\" and event_code = \"$event_code\" and ndx = $ndx limit 1;";
       mysql_start();
       $results = mysql_query($query);
       mysql_stop();
       }
       else {
        die("reg code not valid   CODE: $ndx");
       }
    }
    else {
       die("user code not valid   CODE: $user_code");
    }
    
 }


function addUsertoEvent($user_code="",$event_code=0) {
   global $CFG;
    $isUser = getUser($user_code);
    if($isUser) {
       $query = "insert into attendance values (\"\",\"$user_code\",\"$event_code\",\"N\");";
       mysql_start();
       $results = mysql_query($query);
       mysql_stop();
       
    }
    else {
       die("user code not valid   CODE: $user_code");
    }
    

}

function writeLog($text="") {
   if($text){
   global $CFG;
mysql_start();
    $ip = $_SERVER["REMOTE_ADDR"];
     $text = mysql_real_escape_string($text);
     $query = "insert into Log values(null,now(),\"$ip\",\"$text\");";
     $results = mysql_query($query) or die(mysql_error());
     mysql_stop();
   }
   else{
   die("no text dude");
   }
   
}

/*******
*
*********/
function isSpecialCode($code="") {
   
   if($code !="") {
       $query = "select * from SpecialCodes where code = \'$code\';";
      global $CFG;
mysql_start();
       $results = mysql_query($query);
       $fetchedCode = mysql_fetch_object($results);
       mysql_stop();
       if($fetchedCode){
         return $fetchedCode->codeid;
         }
       else {
         return false;
        }     
   }
   else {
    return false;
   }
   
}


/**
* addConferenceEvent($title,$presenter,$price,$date,$time,$age,$limit=20,$description)
*
* Adds an event to the list of available events. called from admin backend
*/
function addConferenceEvent($title="",$presenter="",$price,$date,$time,$age,$limit=20,$description="",$location="") {
    global $CFG;
        if($title != "" && $presenter != ""){
        
           mysql_start();
           $billcode = "$title" . time();
           
           $billcode = md5($billcode);
           $billcode = substr($billcode, 0, 14);
           $title = mysql_real_escape_string($title);
           $presenter = mysql_real_escape_string($presenter);
           $price = mysql_real_escape_string($price);
           $date = mysql_real_escape_string($date);
           $time = mysql_real_escape_string($time);
           $age = mysql_real_escape_string($age);
           $limit = mysql_real_escape_string($limit);
           $location = mysql_real_escape_string($location);
           $query = "insert into conferences values('','$title','$presenter',$price,'$date','$time','$age','$billcode','$location')";
           mysql_query($query) or die(mysql_error());
           
           $event_code = getEventCode($billcode);
           mysql_start();
           $description = strip_tags($description,"<p><a><br><strong><b>");
           $description = mysql_real_escape_string($description);
           $query = "insert into descriptions values('',$event_code,\"$description\");";
           mysql_query($query) or die(mysql_error()."<br/>$query");
           $query = "insert into limits values($event_code,$limit);";
           mysql_query($query) or die(mysql_error()."<br/>$query");
          
           mysql_stop();
           return true;
        }
        else{ 
        //die("$title  $presenter");
        return false;
        }
}


/**
 * getConferenceEventData($billcode,$orderby)
 * gets all relevant data for all or one event(s) for editing purposes
 * @param string billcode [optional] omitting billcode will grab all events
 * @param string orderby [optional] order conference data by ....
 * @return array of object(s) 
 */
function getConferenceEventData($billcode="",$orderby = " order by conferences.date") {
    global $CFG;
    $sql = "select conferences.*,descriptions.description,limits.capacity from conferences"
        . " left join (descriptions,limits) on (conferences.event_code = descriptions.event_code"
        .  " and conferences.event_code = limits.event_code)";
    
    if($billcode != "") {
        
        $sql .= " where conferences.billing_code = $billcode";
        
    }
    $sql .= "$orderby";
    mysql_start();
    $data = array();
    $results = mysql_query($sql)or die(mysql_error());
    $x=0;
    while($row = mysql_fetch_object($results)) {
        $data[$x] = $row;
        $x++;
    }
    //var_dump($data);
    
    mysql_stop();
    if($data) {
        return $data;
    }
}


/**
 *function editConferenceEventData($billcode) 
 */
function editConferenceEventData($eventid = NULL) {
    global $CFG;
    
    if($eventid) {
        $sql = "select conferences.*,descriptions.description as description,limits.capacity as capacity from conferences"
        . " left join (descriptions,limits) on (conferences.event_code = descriptions.event_code"
        .  " and conferences.event_code = limits.event_code) where conference.event_code = $eventid";
        
        
        
        
        
    }
    else {
        return false;
    }
    
    
    
    
}


/**
*
*/
function getSpecialCodelimit($codeid) {
   
}



?>
