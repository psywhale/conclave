<?php
require_once("config.php");
printHeader();
echo <<<END
<h1>Travel/Accomodations</h1>
<p>
<a href="http://quartzmountainresort.com/" class="external" target="blank">Quartz Mountain Resort</a> is the host of Oklahoma Global Education Consortium 2009.
</p>
<p>
The following is a list of nearby accomodations.
  <table id="hotels">
  <caption> Table: Nearby Accomodations </caption>
  <colgroup>
     <col/>
     <col/>
     <col/>
     <col id="Rooms" />
     <col/>
  </colgroup>
  <thead>
    <tr>
      <th>Name</th><th>Address</th><th>Phone</th><th>Rate**</th>
    </tr>
   </thead>
   <tbody>

    <tr>
      <td><a href="http://www.microtelinn.com" class="external" target="blank">Microtel</a></td><td>3210 N Main<br/>Altus, OK <br/> </td><td>580-379-9400</td><td>69.30 Double</td>
    </tr>

    <tr>
      <td><a href="http://www.daysinn.com" class="external" target="blank">Days Inn</a></td><td>3202 N. Main Street<br/> Altus, OK <br/> </td><td>580-846-9049</td><td>$50 single<br/>$55 double</td>
    </tr>

    <tr>
      <td><a href="http://www.bestwestern.com" class="external" target="blank">Best Western</a></td><td>2400 N. Main<br/>Altus, OK</td><td>580-482-9300</td><td>$60</td>
    </tr>
    <tr>
      <td><a href="http://www.ramada.com" class="external" target="blank">Ramada Inn</a></td><td>2515 E. Broadway<br/>Altus, OK </td><td>1-800-272-6232<br/>580-477-3000</td><td>$58 single<br/>$68 double</td>
    </tr>
    <tr>
      <td><a href="http://www.travelok.com/toStay/stayDetail.asp?id=1+5U+5066" class="external" target="blank">Country Charm <br>Bed and Breakfast</a></td><td>Rt 1 Box 21A<br>Lonewolf, OK <br> [<a href="http://maps.google.com/maps?saddr=34.899307040589754,-99.2817735671997&amp;daddr=2801 North Main, Altus, OK&amp;hl=en">Directions to Moot</a>]</td><td>580-846-9049</td><td>$59</td>
    </tr>
    </tbody>
    <tfoot>
    <td colspan=5>**Government Room Rates available upon presentation of ID<br/>

    </td>
    </tfoot>
  </table>
</p>
END;
printFooter();


?>
