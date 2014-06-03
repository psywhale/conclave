<?php

echo '
<!--  end of content start of footer -->
</div>
</div>
<script src="http://www.google-analytics.com/urchin.js" type="text/javascript">
</script>
<script type="text/javascript">
_uacct = "UA-273017-1";
urchinTracker();
</script>
';
echo '        <script src="http://maps.google.com/maps?file=api&v=2&key=ABQIAAAABCY4svSly2pLinPZJ2yw1hQGO_pa-xH2j672nYyfWEkUVvBFGRTJyLEWErmTVOrZxcdiYbv1dsJ2zg" type="text/javascript"></script>
    <script type="text/javascript">
    //<![CDATA[

    var map = new GMap(document.getElementById("map"));
	map.centerAndZoom(new GPoint(-99.30529117, 34.90456888), 4);
	var markerpoint = new GPoint(-99.30529117, 34.90456888);
	var golfcoursept = new GPoint(-99.30387496948242, 34.878326713257394);
	var campgroundpt = new GPoint(-99.29898262023926, 34.89029601271247);
	var golficon = new GIcon();
	golficon.image="http://moot.wosc.edu/images/golf.png";
	golficon.iconSize = new GSize(20,20);
	golficon.iconAnchor = new GPoint(6,20);
	golficon.infoWindowAnchor = new GPoint(5,1);
	var golfmarker = new GMarker(golfcoursept,golficon);
	var campicon = new GIcon();
	campicon.image="http://moot.wosc.edu/images/tent.png";
	campicon.iconSize = new GSize(21,15);
	campicon.iconAnchor = new GPoint(4,15);
	campicon.infoWindowAnchor = new GPoint(4,1);
	var campmarker = new GMarker(campgroundpt,campicon);

	var marker = new GMarker(markerpoint);
	var quartzhtml = \'<div style="width: 450px;">Quartz Mountain Resort and Hotel<br><img src="http://quartz.wosc.edu/images/Lake-View-lg.jpg" alt="lakeview"><br><a href="http://www.quartzmountainresort.com"> Quartz Mountain Resort.com</a></div>\';
	var camphtml = \'Campground and Picnic Area\';
	var golfhtml = \'Quartz Mtn. Golf Course\';
	GEvent.addListener(marker,\'click\',function() { marker.openInfoWindowHtml(quartzhtml);});
	GEvent.addListener(campmarker,\'click\',function() { campmarker.openInfoWindowHtml(camphtml);});
	GEvent.addListener(golfmarker,\'click\',function() { golfmarker.openInfoWindowHtml(golfhtml);});
	GEvent.addListener(map,\'infowindowclose\',function() {map.recenterOrPanToLatLng(new GPoint(-99.30529117, 34.90456888),4);});
	map.addControl(new GLargeMapControl());
	map.addControl(new GMapTypeControl());
	map.addOverlay(campmarker);
	map.addOverlay(marker);
	map.addOverlay(golfmarker);

    //]]>
    </script>

</body>
</html>
';
?>
