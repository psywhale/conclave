<?php
require_once("config.php");

if($_SERVER["REMOTE_ADDR"] == "164.58.169.16") {
//    $CFG->registration = true;
}

printHeader();
if($CFG->registration) {
 echo <<<END

<script type="text/javascript">
function changedesc() {
  if(document.regform.diet.checked) {
     document.regform.dietdesc.disabled = false;
     document.regform.dietdesc.style.backgroundColor = "#fff";
  }
  else {
     document.regform.dietdesc.disabled = true;
     document.regform.dietdesc.value = "";
     document.regform.dietdesc.style.backgroundColor = "#aaa";

  }

}
</script>

<h1>Registration</h1>
<p>Registration <u><b>Does Not</b></u> include lunch. Please bring a box lunch. </p>
<p>Please complete the following form to complete your registration. </p>
<p> <strong>Your seat will not be reserved until payment has been rendered.</strong> 
<p/>


<form action="reg.php" method="post" name="regform">
<table id="nohl" >
  <tr><td colspan=2 align="center">
END;

      if($_REQUEST["error"]) {
  	    	  	    echo '<strong><font style="color:red">There was a problem with your submitted information<br>The highlighted fields in yellow are required.</font></strong>';
  	    	  	    if(preg_match('/m/',$_REQUEST["error"])) {
  	    	  	       echo '<br/><strong><font style="color:red">You did not Choose an event.</font></strong>';
  	    	  	       }
      }

echo <<<END
  </td></tr>
  <tr><td colspan=2 align="center">
  <table width="100%" align="left">
  <tr><td align="left" colspan=3></td></tr>

END;

// user data form START
echo '<TR>
<!--<TD align="right">Child\'s First Name</TD><td align="left">-->
<td colspan=2>
<label for="first">Child\'s First Name</label>
<input name="first" type="text" id="first" placeholder="Child\'s First Name"
';

      if(preg_match('/f/',$_REQUEST["error"])) {
  	  	    echo 'style="background-color: #ffd700;"';
  	  }
  	  echo 'value="'.$_REQUEST["first"].'"';
echo '/></td></TR><tr><TD colspan=2><label for="last">Child\'s Last Name</label><input name="last" type="text" maxlength="50" size="30"placeholder="Child\'s Last Name"';


      if(preg_match('/l/',$_REQUEST["error"])) {
  	  	    echo 'style="background-color: #ffd700;"';
  	  }
  	  echo 'value="'.$_REQUEST["last"].'"';
echo '/></td></tr><tr><TD colspan=2><label for="age">Child\'s Age</label><input name="age" type="number" maxlength="40" size="30" placeholder="Age" min="1" max="18"';


      if(preg_match('/t/',$_REQUEST["error"])) {
  	  	    echo 'style="background-color: #ffd700;"';
  	  }
  	  echo 'value="'.$_REQUEST["age"].'"';

echo'  /></td></tr>';
if($_REQUEST["gender"] == "Male") {
   $checkedMale = "checked";
   $checkedFemale = "";
   }
else {
   $checkedMale = "";
   $checkedFemale = "checked";
   }
   
echo '
  <tr><TD colspan=2><label for="gender">Child\'s Gender</label><input name="gender" type="radio" maxlength="40" size="30" value="Male" '.$checkedMale.'>Male <input name="gender" type="radio" maxlength="40" size="30" value="Female" '.$checkedFemale.'>Female';

      /*if(preg_match('/c/',$_REQUEST["error"])) {
  	  	    echo 'style="background-color: #ffd700;"';
  	  }
  	  echo 'value="'.$_REQUEST["company"].'"';*/
echo '
  </TD></tr>
  <tr><TD colspan=2><label for="address">Address</label><input name="address" type="text" maxlength="40" size="30" placeholder="Street"';

      if(preg_match('/a/',$_REQUEST["error"])) {
  	  	    echo 'style="background-color: #ffd700;"';
  	  }
  	  echo 'value="'.$_REQUEST["address"].'"';

echo '  /></td></tr><tr><TD colspan=2><label for="city">City</label><input name="city" type="text" maxlength="30" size="30" placeholder="City" ';

      if(preg_match('/y/',$_REQUEST["error"])) {
  	  	    echo 'style="background-color: #ffd700;"';
  	  }
  	  echo 'value="'.$_REQUEST["city"].'"';

echo '  /></td></tr><tr><TD colspan=2><label for="state">State</label><select name="state"';

      if(preg_match('/s/',$_REQUEST["error"])) {
  	  	    echo 'style="background-color: #ffd700;"';
  	  }
echo <<<END
    >
<option value="AL">Alabama</option>
<option value="AK">Alaska</option>
<option value="AZ">Arizona</option>
<option value="AR">Arkansas</option>
<option value="CA">California</option>
<option value="CO">Colorado</option>
<option value="CT">Connecticut</option>
<option value="DE">Delaware</option>
<option value="FL">Florida</option>
<option value="GA">Georgia</option>
<option value="HI">Hawaii</option>
<option value="ID">Idaho</option>
<option value="IL">Illinois</option>
<option value="IN">Indiana</option>
<option value="IA">Iowa</option>
<option value="KS">Kansas</option>
<option value="KY">Kentucky</option>
<option value="LA">Louisiana</option>
<option value="ME">Maine</option>
<option value="MD">Maryland</option>
<option value="MA">Massachusetts</option>
<option value="MI">Michigan</option>
<option value="MN">Minnesota</option>
<option value="MS">Mississippi</option>
<option value="MO">Missouri</option>
<option value="MT">Montana</option>
<option value="NE">Nebraska</option>
<option value="NV">Nevada</option>
<option value="NH">New Hampshire</option>
<option value="NJ">New Jersey</option>
<option value="NM">New Mexico</option>
<option value="NY">New York</option>
<option value="NC">North Carolina</option>
<option value="ND">North Dakota</option>
<option value="OH">Ohio</option>
<option value="OK" selected>Oklahoma</option>
<option value="OR">Oregon</option>
<option value="PA">Pennsylvania</option>
<option value="RI">Rhode Island</option>
<option value="SC">South Carolina</option>
<option value="SD">South Dakota</option>
<option value="TN">Tennessee</option>
<option value="TX">Texas</option>
<option value="UT">Utah</option>
<option value="VT">Vermont</option>
<option value="VA">Virginia</option>
<option value="WA">Washington</option>
<option value="WV">West Virginia</option>
<option value="WI">Wisconsin</option>
<option value="WY">Wyoming</option>
</select>

 </td></tr>
  <tr><TD colspan=2><label for="zip">Zip</label><input name="zip" type="number" maxlength="10" size="12" placeholder="00000"
END;

      if(preg_match('/z/',$_REQUEST["error"])) {
  	  	    echo 'style="background-color: #ffd700;"';
  	  }
  	  echo 'value="'.$_REQUEST["zip"].'"';

echo '/></td></tr><tr><TD colspan=2><label>Parent\'s Email</label><input name="email" type="email" maxlength="50" size="30" placeholder="something@example.com" ';

      if(preg_match('/e/',$_REQUEST["error"])) {
  	  	    echo 'style="background-color: #ffd700;"';
  	  }
  	  echo 'value="'.$_REQUEST["email"].'"';
echo <<<END
  /></TD></tr>
  <tr><td colspan=2><label for="phone">Phone</label> <input name="phone" type="tel" maxlength="20" size="10" placeholder="555-555-5555"
END;

      if(preg_match('/p/',$_REQUEST["error"])) {
  	  	    echo 'style="background-color: #ffd700;"';
  	  }
  	  echo 'value="'.$_REQUEST["phone"].'"';

echo <<<END
     </td></tr>
  <tr><td colspan=2><label>Parent's Work Phone </label><input name="workphone" type="tel" maxlength="20" size="10" placeholder="555-555-5555"></td></tr>
  <tr><td colspan=2><label for="emergphone">Emergency Phone </label><input name="emergphone" type="tel" maxlength="20" size="10" placeholder="555-555-5555"></td></tr>
  <tr><td colspan=2><label for="specialneeds">Please list any special needs for your child. EX: Food Allergies, Medications, etc</label></td></tr>
  <tr><td colspan=2><textarea rows=3  name="specialneeds"></textarea></td></tr>
  <tr><TD></TD><TD></TD></tr>
  
  


</table>
END;
// end of user data form END
echo "<tr><td colspan=2>";

$events = getLimitsandSeats();
foreach($events->event as $bucket){
	if($bucket->seats_taken >= $bucket->capacity){
	       if(preg_match("/Night\ Class/",$bucket->name)) $styleold="style=background-color:lightblue";
		echo "<tr><td align=\"right\"><input type=\"checkbox\" name=\"none\" value=\"yes\" disabled/></td><td align=\"left\" $styleold><font size=\"-1\" style=\"text-decoration: line-through\">$bucket->name $bucket->time  $ $bucket->price</font> Sorry Full!</td></tr>";
	}
	else {
	    if(preg_match("/Night\ Class/",$bucket->name)) $styleold="style=background-color:lightblue";
            $seat_diff = $bucket->capacity - $bucket->seats_taken;
	    if($_REQUEST[$bucket->billing_code] == "yes") 
	      {$checked = "checked";
	      }
	      else{
	      $checked="";
	      }
            if($bucket->price > 65 || $bucket->price == 35) { $salegif = ""; }
              else { $salegif = '<img alt="Sale" title="sale" src="/images/sale.gif" />';}
            if($date !== $bucket->date) {echo "<tr><td colspan=2><hr/>Week of $bucket->date</td></tr>";} 
             $date=$bucket->date;
  	    echo "<tr ><td align=\"right\" id=\"$bucket->billing_code".bg."\" onclick=\"javascript:Checkit('$bucket->billing_code');\"><input type=\"checkbox\" id=\"$bucket->billing_code\" name=\"$bucket->billing_code\" value=\"yes\" $checked onclick=\"javascript:Checkit('$bucket->billing_code');\"/></td><td id=\"$bucket->billing_code".bg2."\" align=\"left\" $styleold onclick=\"javascript:Checkit('$bucket->billing_code');\">$bucket->name $bucket->date $bucket->time $ $bucket->price $salegif<br/><font size=\"-3\"> Seats Available: $seat_diff of $bucket->capacity </font></td></tr>";
	}
}

echo '<tr><td></td><td >&nbsp;</td></tr>';
//echo     '<tr><td align="right">Special Code </td><td align="left"><input name="specialcode" type="text" maxlength="10" size="10"></td></tr>';


echo '<tr><td></td><td align="center"><input name="Register" type="submit" value="Register" class="button"/></TD></tr></form></table>';
}

else {
    postStart("Registration Closed");
    postEnd();
}


echo "
<script>
function Checkit(elementor) 
{
    var e = document.getElementById(elementor);
    if(e.checked == true) {
       e.checked = false;
        var e = document.getElementById(elementor+'bg');
	var e2 = document.getElementById(elementor+'bg2');
       e.style.backgroundColor = \"transparent\";
       e2.style.backgroundColor = \"transparent\";
       e2.style.color = \"#AEA098\";
    }
    else {
      e.checked = true;
       var e = document.getElementById(elementor+'bg');
       var e2 = document.getElementById(elementor+'bg2');
      e.style.backgroundColor = \"lightgreen\";
      e2.style.backgroundColor = \"lightgreen\";
      e2.style.color=\"black\";
    }
}
</script>
";


printFooter();





?>
