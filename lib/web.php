<?php

function printHeader($menu=null,$print=false) {
        global $CFG;
        
        if($menu == null){
           $menu = $CFG->menu;
        }
        elseif($menu == "none"){
           $CFG->showmenu = false;
          }
        if($print) {
            $CFG->printpage = true;
           }
         else {
            $CFG->printpage = false;
         }  
        include_once("$CFG->themedir/header.html");
}

function postStart($headline="headline missing") {
echo '<div class="art-post">     <div class="art-post-body">      <div class="art-post-inner art-article">
<h2 class="art-postheader">
'.$headline.' </h2>
<div class="art-postcontent">';

}

function postEnd() {
 echo "</div></div></div></div>";
}

function printFooter() {
        global $CFG;
        include_once("$CFG->themedir/footer.html");
}
function htmlarea($htmlarea = "") {
    global $CFG;
    
    /*echo "    <script type=\"text/javascript\">
      _editor_url = \"$CFG->wwwsite/htmlarea/\";      _editor_lang = \"en\";
    </script>
    <script type=\"text/javascript\" src=\"$CFG->wwwsite/htmlarea/htmlarea.js\"></script>
    <script type=\"text/javascript\">
      HTMLArea.loadPlugin(\"ContextMenu\");
      HTMLArea.onload = function() {
        var editor = new HTMLArea(\"$htmlarea\");
        
        editor.generate();
      };
      HTMLArea.init();
    </script>
    <textarea id=\"$htmlarea\" name=\"$htmlarea\" rows=\"20\" cols=\"80\" style=\"width: 100%\"></textarea>";
    */
    echo '
    <script type="text/javascript" src="'.$CFG->wwwsite.'/tinymce/jscripts/tiny_mce/tiny_mce.js"></script>
    <script type="text/javascript">
	tinyMCE.init({
		mode : "textareas",
		theme : "simple"
	});
    </script>';
    echo "<textarea id=$htmlarea name=$htmlarea rows=\"20\" cols=\"80\" style=\"width: 100%\"></textarea>";
    
}

function error($errorcode,$string) {
	Header("Location: registration.php?error=$errorcode&$string");
	die;
}

?>
