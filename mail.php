<?php

require_once("config.php");

printHeader();

echo '
<!-- Begin MailChimp Signup Form -->
<!--[if IE]>
<style type="text/css" media="screen">
	#mc_embed_signup fieldset {position: relative;}
	#mc_embed_signup legend {position: absolute; top: -1em; left: .2em;}
</style>
<![endif]--> 

<!--[if IE 7]>
<style type="text/css" media="screen">
	.mc-field-group {overflow:visible;}
</style>
<![endif]--><script type="text/javascript">
// delete this script tag and use a "div.mce_inline_error{ XXX !important}" selector
// or fill this in and it will be inlined when errors are generated
var mc_custom_error_style = \'\';
</script>
<script type="text/javascript" src="http://wosc.us1.list-manage.com/js/jquery-1.2.6.min.js"></script>
<script type="text/javascript" src="http://wosc.us1.list-manage.com/js/jquery.validate.js"></script>
<script type="text/javascript" src="http://wosc.us1.list-manage.com/js/jquery.form.js"></script>
<script type="text/javascript" src="http://wosc.us1.list-manage.com/subscribe/xs-js?u=dc05d4d5fd3071b5940e5d553&amp;id=729765e66b"></script>
<div id="mc_embed_signup">
<form action="http://wosc.us1.list-manage1.com/subscribe/post?u=dc05d4d5fd3071b5940e5d553&amp;id=729765e66b" method="post" id="mc-embedded-subscribe-form" name="mc-embedded-subscribe-form" class="validate" target="_blank">
	<fieldset>
	<legend>Join our mailing list</legend>
<div class="indicate-required">* indicates required</div>
<div class="mc-field-group">
<label for="mce-EMAIL">Email Address <strong class="note-required">*</strong>
</label>
<input type="text" value="" name="EMAIL" class="required email" id="mce-EMAIL">
</div>
<div class="mc-field-group">
    <label class="input-group-label">Email Format </label>
    <div class="input-group">
    <ul><li><input type="radio" value="html" name="EMAILTYPE" id="mce-EMAILTYPE-0"><label for="mce-EMAILTYPE-0">html</label></li>
<li><input type="radio" value="text" name="EMAILTYPE" id="mce-EMAILTYPE-1"><label for="mce-EMAILTYPE-1">text</label></li>
<li><input type="radio" value="mobile" name="EMAILTYPE" id="mce-EMAILTYPE-2"><label for="mce-EMAILTYPE-2">mobile</label></li>
</ul>
    </div>
</div>
<p><a href="http://us1.campaign-archive.com/home/?u=dc05d4d5fd3071b5940e5d553&id=729765e66b" title="View previous Messages">View previous messages.</a></p>
		<div id="mce-responses">
			<div class="response" id="mce-error-response" style="display:none"></div>
			<div class="response" id="mce-success-response" style="display:none"></div>
		</div>
		<div><input type="submit" value="Subscribe" name="subscribe" id="mc-embedded-subscribe" class="btn"></div>
	</fieldset>	
	
</form>
</div>
<!--End mc_embed_signup-->';
printFooter();


?>
