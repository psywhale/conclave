<?php
include_once("config.php");


printHeader();
echo '
<div class="art-post">
     <div class="art-post-body">
        <div class="art-post-inner art-article">

<h2 class="art-postheader">
'.$CFG->event_title.' 2014 </h2>
<div class="art-postcontent">
  <p>Welcome to Summer 2014 WOSC Kids College!<br/>
  </p>
 </div>
</div>
</div>
</div>';

postStart("Price Reduction!");
echo "<p>
To encourage enrollment in some selected classes we have decided to reduce the price to $65.00, <a href=\"/registration\">check it out</a>. There are a couple of people that have already paid for a few of the classes that we have reduced the price on. I will please ask that those people to let the dust settle with the change and <a href=\"/contact\">get a hold of me</a>, so I can verify the names I have and start the paperwork. Make sure you have a copy of your original invoice.
";
postEnd();

postStart("Registration is OPEN!");
echo "<p>Registration is now open for classes. Classes are filling up. <strong>Remember, your seat in a class
is not reserved until you have paid.</strong> We will make every effort to put every child into the classes they desire but seats are limited.</p>";
postEnd();

/*postStart("Registration Opening soon");
echo "<p>Kid's College registration will be open soon</p>";
postEnd();
*/
/*postStart("Check the Schedule");
echo '<p>We are adding still adding classes. Check the schedule often for changes.</p>';
postEnd();

postStart("Introduction");
echo '
   <p>Classes will take place Monday thru Thursday June 3rd thru Jun 27th. 
  </p>
  <p>Kids College at Western Oklahoma State College provides learning opportunities for the youth 
  in our service area. This unique program offers children and teens academic and enrichment workshops on a college campus.
  Kids College workshops are designed to teach new and meaningful skills,
  develop new interests and hobbies, excite students about learning, as well as provide an opportunity for them to explore possible careers.</p>
  <p>Kids College workshops (fee-based, not-for-credit) are provided during the summer term June 3rd through June 27th.   Each workshop is individually priced based on the total
   number of classroom hours and the maximum number of students.  They are scheduled based on the availability of 
   classroom facilities and teachers. Materials are generally figured into the cost of the program.</p>
  
';
 postEnd();
*/
/*
  postStart("What do you want to learn?");
  echo '<p><a href="'.$CFG->wwwsite.'/classrequest.php">We are asking students to give us ideas for classes.</a></p>
  ';
   postEnd();
  
  postStart("What do you want to Teach?");
  echo '<p><a href="'.$CFG->wwwsite.'/teachrequest.php">Have a class you want to teach? Tell us!</a></p>';
  postEnd();
*/
/*
 postStart("Registraton is Open!");
 echo '<p>Registration is now open! Classes are filling up! Please register for class sooner rather than 
     later. Remember, paid seats are guaranteed seats! Seats are not reserved until payment.</p>';
 postEnd();
 */

 printFooter(); 
 
 
 ?>
