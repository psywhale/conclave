<?php
/*
 * Created on 19-Jun-06
 *
 * To change the template for this generated file go to
 * Window - Preferences - PHPeclipse - PHP - Code Templates
 */
 $linkage = "index.php?z=proposal";
 
 mysql_start();
 $results= mysql_query("select title,securekey,presenter_name from proposals;");
 echo  "<p>" .
			"<table class=\"special\">" .
			"<tr><th>Title</th><th>Author</th></tr>" .
			"";
 while($proposal_list = mysql_fetch_array($results))
 {
 	
    $titled = htmlize($proposal_list[0]); 
 	echo "<tr><td><a href=\"$linkage&d=$proposal_list[1]\">$titled</a></td><td>$proposal_list[2]</td></tr>";
 	
 }
 echo '</table></p><p>';
 
 if($d)
 {
 	
 
 	$results = mysql_query("select * from proposals where securekey =\"$d\";");
 	$proposal_details = array();
 	$proposal_details = mysql_fetch_array($results,MYSQL_NUM);
 	$htmled_output = array();
 	$la = " align=right valign=top";
 	$sw = " width=\"20%\"";
 	$lw = " width=\"80%\"";
 	$x=0;
 	foreach($proposal_details as $item )
 	{
 		
 		$htmled_output[$x] = htmlize($item);
 		
 		$x=$x+1;
 		
 	}
    
 	/*
 	  
 	 $htmled_outline = htmlize($proposal_details->outline);
 	$htmled_methods = htmlize($proposal_details->methods);
 	$htmled_description = htmlize($proposal_details->description);
 	$htmled_others = htmlize($proposal_details->other_presenters);
 	*/
 	echo "<p><strong>Proposal:</strong>" .
 			"<table width=\"100%\" border=1>" .
 			"<tr><td $la $sw>Title:</td><td $lw>$htmled_output[0]</td></tr>" .
 			"<tr><td $la $sw>Format:</td><td $lw>$htmled_output[1]</td> </tr>" .
 			"<tr><td $la $sw>Strand:</td><td $lw>$htmled_output[2]</td> </tr>" .
 			"<tr><td $la $sw>Description:</td><td $lw>$htmled_output[3]</td> </tr>" .
 			"<tr><td $la $sw>Outline:</td><td $lw>$htmled_output[4]  </td></tr>" .
 			"<tr><td $la $sw>Methods:</td><td $lw>$htmled_output[5] </td></tr>" .
 			"<tr><td $la $sw>Presenter: </td><td $lw>$htmled_output[6]<br/>" .
 			"$htmled_output[7]<br/>$htmled_output[8]<br/>$htmled_output[9]<br/>" .
 			"$htmled_output[10] $htmled_output[11] $htmled_output[12]" .
 			"<br/>$htmled_output[13]<br/>$htmled_output[14]</td></tr>" .
 			"<tr><td $la $sw>Other Presenters</td><td $lw>$htmled_output[15]</td></tr>" .
 			"<tr><td $la $sw>Selling Product?</td><td $lw>$htmled_output[16]</td></tr>" .
 			"<tr><td $la $sw>Priority</td><td $lw>$htmled_output[17]</td></tr>" .
 			"<tr><td $la $sw>Confirmed?</td><td $lw>$htmled_output[19]</td></tr>" .
 			"</table></p> ";
 			
 
 }
mysql_stop(); 	

function htmlize($string = "")
{
	$output = preg_replace("/\n/","<br/>",$string);
	$output = preg_replace("/\\\"/","&#34;",$output);
	$output = preg_replace("/\\\'/","&#39;",$output);
	$output = preg_replace("/\"/","&#34;",$output);
	$output = preg_replace("/\'/","&#39;",$output);
	return $output;
	
}




?>
