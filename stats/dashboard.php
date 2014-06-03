<?php

mysql_start();



$charturl="http://chart.apis.google.com/chart?";


$agedata = getStats("age",true);
$agechart = barGraph("360x140","Ages of Participants",$agedata,0,20);
$genderdata = getStats("gender");
$genderchart = get3dPieChart(140,"Gender",$genderdata);

mysql_start();
$paid_data = array(); // array to be filled with data objects 
$paidq = mysql_query("select count(*) as number, \"Unpaid\" as name from attendance where paid=\"N\";");
$paid_data[] = mysql_fetch_object($paidq);
$paidq = mysql_query("select count(*) as number, \"Paid\" as name from attendance where paid=\"Y\";");
$paid_data[] = mysql_fetch_object($paidq);

$paidchart = get3dPieChart(140,"Sales",$paid_data);



// print charts
$date = date("m/d/Y H:i:s");
postStart("Dashboard $date");
echo "<table id=dash><tr><td><div id=agechart_div></td>";
echo "<td><div id=genderchart_div></div></td></tr>";
echo "<tr><td><img src=$paidchart></td><td><div id=saleschart_div></td></tr>";

//$chartsize="720";
//$chart = getClassAttend_bar($chartsize,"Seats Reserved vs Seats Available");
//echo "<tr><td colspan=2><img src=$chart border=0></td></tr>";
echo "<tr><td colspan=2><div id=seatchart_div></div></td></tr>";


echo "</table>";
echo <<<TOM
<script type="text/javascript" src="https://www.google.com/jsapi"></script>
    <script type="text/javascript">

      // Load the Visualization API and the piechart package.
      google.load('visualization', '1.0', {'packages':['corechart']});

      // Set a callback to run when the Google Visualization API is loaded.
      google.setOnLoadCallback(drawChart);

      // Callback that creates and populates a data table,
      // instantiates the pie chart, passes in the data and
      // draws it.
      function drawChart() {

        // Create the data table.
TOM;
        echo "\n"
            ."var Genderdata = new google.visualization.DataTable();"
            ."Genderdata.addColumn('string', 'Sex');"
            ."Genderdata.addColumn('number', 'Students');";
        foreach($genderdata as $item){
            echo "Genderdata.addRow(['$item->name',$item->number]);";
        }
        echo "var genderoptions = {'title':'Gender Breakdown',is3D:true};";
        
        echo "\n"
            ."var Agedata = new google.visualization.DataTable();"
            ."Agedata.addColumn('string', 'Age');"
            ."Agedata.addColumn('number', 'Total');";
        foreach($agedata as $item){
            echo "Agedata.addRow(['$item->name',$item->number]);";
        }
        echo "var Ageoptions = {title:'Age of Participants', haxis: {title:'Ages'}};";
        
        echo "\n"
            ."var Salesdata = new google.visualization.DataTable();"
            ."Salesdata.addColumn('string', 'Paid/Unpaid');"
            ."Salesdata.addColumn('number', 'Total');";
        foreach($paid_data as $item){
            echo "Salesdata.addRow(['$item->name',$item->number]);";
        }
        echo "var Salesoptions = {'title':'Sales',is3D:true};";
        
        echo "\n"
            ."var Seatdata = new google.visualization.DataTable();"
            ."Seatdata.addColumn('string', 'Class');"
            ."Seatdata.addColumn('number', 'Seats Paid');"
            ."Seatdata.addColumn('number', 'Seats Unpaid');"
            ."Seatdata.addColumn('number', 'Seats Available');";
        $events = getLimitsandSeats();
        foreach($events->event as $item){
            echo "Seatdata.addRow(['$item->name',$item->seats_taken,$item->seats_askedfor,$item->seats_available]);";
        }
        echo "var Seatoptions = {'title':'Verified Enrollments',isStacked:true,height:800,chartArea:{height:700}};";        

echo <<<TOM2

        // Instantiate and draw our chart, passing in some options.
        var genderchart = new google.visualization.PieChart(document.getElementById('genderchart_div'));
        genderchart.draw(Genderdata, genderoptions);        

             
 

        var saleschart = new google.visualization.PieChart(document.getElementById('saleschart_div'));
        saleschart.draw(Salesdata, Salesoptions);

        var agechart = new google.visualization.ColumnChart(document.getElementById('agechart_div'));
        agechart.draw(Agedata, Ageoptions);
        
        var seatchart = new google.visualization.BarChart(document.getElementById('seatchart_div'));
        seatchart.draw(Seatdata, Seatoptions);   
      }
    </script>
TOM2;
postEnd();

function get3dPieChart($y=300,$title="",$dataset) {
   global $charturl;
   $chart_type = "&cht=p3";
   $x = $y*2;
   $size = "chs=".$x."x".$y."";
   $data = "&chd=t:";
   $label = "&chl=";
   $chart_title = "&chtt=".urlencode(preg_replace("/\n/","",$title));
   foreach($dataset as $item) {
       $data .= "$item->number,";
       $label .= "$item->name|";
   }
   $url = "$charturl"."$size"."$chart_type"."$data"."$label"."$chart_title";
   
   $url = cleanUrl($url);
   return $url;    
   
}

function cleanUrl($url="") {
  $url = preg_replace("/\,\|/","|",$url);
  $url = preg_replace("/\,\&/","&",$url);
  $url = preg_replace("/\|$/","",$url);
  return $url;
  
}

function barGraph($size="200x200",$title="",$dataset,$min=0,$max=100) {
   global $charturl;
   $chart_type = "&cht=bvs";
   $x = $y*2;
   $size = "chs=$size";
   $data = "&chd=t:";
   $label = "&chl=";
   $scale =  "&chds=$min,$max";
   $axis = "&chxt=x,y";
   $axisrange= "&chxr=1,0,$max";
   $datapoint_labels = "&chm=N*f0*,000000,0,-1,11";
   $grid="&chg=0,25";
   $chart_title = "&chtt=".urlencode(preg_replace("/\n/","",$title));
   foreach($dataset as $item) {
       $data .= "$item->number,";
       $label .= "$item->name|";
   }
   $url = "$charturl"."$size"."$chart_type"."$data"."$scale"."$label"."$chart_title"."$axis"."$axisrange"."$datapoint_labels"."$grid";
   
   $url = cleanUrl($url);
   return $url;    
   
}






function getClassAttend_bar($chart_x="1000",$title="") {
   global $charturl;
   $chart_type="&cht=bhs";
   $chart_y = 10;
   $imgsrc= $charturl;
   $chart_title = "&chtt=".urlencode(preg_replace("/\n/","",$title));
   $chartdata = "&chd=t:";
   $events = getLimitsandSeats();
   $seats_left = array();
   $label = array();
   $legend = "&chdl=Seats%20Taken|Seats%20Available";
   $scale = "&chds=0,20,0,20";
   //var_dump($events);
   $chart_label = "&chxl=0:";
   $x=0;
   foreach($events->event as $class){
      //$seats_taken[$x] = $class->seats_taken;
      if($class->seats_taken > 0){
        $seats_left[$x] = $class->capacity - $class->seats_taken;
        $chartdata .= "$class->seats_taken,";
        $label[$x] = urlencode(preg_replace("/\n/","",$class->name));
        $x++;
        $chart_y +=30;
      }
      
   }
   $x = sizeof($label) -1;
   $chartdata .= "|";
   foreach($seats_left as $blah) {
      $chartdata .= "$blah,";
   }
   
   while($x >= 0 ){
      $chart_label .= "|$label[$x]";
      $x--;
   }
   $chart_size ="chs=".$chart_x."x".$chart_y;
   
   $imgsrc .= "$chart_size$chart_type&chco=4D89F9,C6D9FD$chartdata&chxt=y$chart_label"."$chart_title"."$legend"."$scale";
   
   $imgsrc = cleanUrl($imgsrc);
   
   return $imgsrc;  
   
}
?>
