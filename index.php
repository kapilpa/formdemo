<?php
//form demo
error_reporting(E_NONE);
include './xajax_core/xajax.inc.php';

$xajax = new xajax();

$xajax->register(XAJAX_FUNCTION, 'doAdd');
$xajax->register(XAJAX_FUNCTION, 'doReset');
$xajax->register(XAJAX_FUNCTION, 'doCalc');

$xajax->processRequest();

function doAdd($a, $b)
{
    $response = new xajaxResponse();
    $response->assign('answer', 'innerHTML', $a + $b);
    $response->assign('reset', 'style.display', 'block');
    return $response;
}

function doReset()
{
		$htmlin = '<table width="100%"><tr>
	  				<td width="15%"><input id="" name="" size="15"></td>
	  				<td width="5%"><input id="" name="" size="10"></td>
	  				<td width="5%"><input id="" name="" size="10"></td>
	  				<td width="5%"><input id="" name="" size="10"></td>
	  				<td width="5%"><input id="" name="" size="10"></td>
	  				<td width="5%"><input id="" name="" size="10"></td>
	  				<td width="5%"><input id="" name="" size="10"></td>
	  				<td width="5%"><input id="" name="" size="10"></td>
	  				<td width="5%"><input id="" name="" size="15"></td>
	  				<td width="25%"><textarea></textarea></td>
	  			</tr></table>';
    $response = new xajaxResponse();
    //$response->clear('answer', 'innerHTML');
    //$response->assign('reset', 'style.display', 'none');
    $response->append('morerows', 'innerHTML', $htmlin);
    return $response;
}

function doCalc($frm){
	$response = new xajaxResponse();

	$response->assign('sqftg', 'value', round(($frm['inwidth']*$frm['inheight'])/144, 2));
	$response->assign('tsqftg', 'value', round( (($frm['inwidth']*$frm['inheight'])/144)*$frm['inqty'], 2));
	$response->assign('subtot', 'value', round( (($frm['inwidth']*$frm['inheight'])/144)*$frm['inqty']*$frm['ppsf'], 2));


	$response->assign('pdfdown', 'innerHTML', '<div><a href="">Pdf Download</a></div>');
	return $response;
}

?>
<html>
<head>
	<?php $xajax->printJavascript(); ?>
	
</head>
<body>
	<form id="subform" action="#" method="post" onsubmit="return false;">
	  <!--<input type="button" onclick="xajax_doAdd(10,600);" id="btnAdd" value="Click Me" />
	  <input type="button" onclick="xajax_doReset();" id="btnReset" value="Reset" />
	  <p id="answer"></p>-->
	  <div>
	  <table width="100%" cellpadding="0" cellspacing="2">
	  <tr>
	  	<td colspan="2" align="center"><img src="americanfils.png" style="border:0;"></td>
	  </tr>
	  <tr>
	  	<td>Company:</td><td><input type="text" id="cname" name="cname"></td>
	  </tr>	
	  <tr>
	  	<td>Address:</td><td><textarea id="address" name="address">&nbsp;</textarea></td>
	  </tr>	
	  <tr>
	  	<td>Phone:</td><td><input type="text" id="phone" name="phone"></td>
	  </tr>	
	  <tr>
	  	<td>Mail:</td><td><input type="text" id="mail" name="mail"> <input type="checkbox"> Copy Me</td>
	  </tr>
	  <tr>
	  	<td colspan="2">
	  		<table width="100%"  border="1"  cellpadding="0" cellspacing="2">
	  			<tr>
	  				<td width="15%">ACTUAL SIZE<br>Width x Height</td>
	  				<td width="5%">Width</td>
	  				<td width="5%">Height</td>
	  				<td width="5%">Qty</td>
	  				<td width="5%">Sq. Footage</td>
	  				<td width="5%">Total Sq. footage</td>
	  				<td width="5%">Price Per Sq Ft</td>
	  				<td width="5%">Sub Total</td>
	  				<td width="15%">Floor to top pane</td>
	  				<td width="35%">Film Type / Notes</td>
	  			</tr>
	  			<tr>
	  				<td><input id="actsize" name="actsize" size="15"></td>
	  				<td><input id="inwidth" name="inwidth" size="10"></td>
	  				<td><input id="inheight" name="inheight" size="10"></td>
	  				<td><input id="inqty" name="inqty" size="10"></td>
	  				<td><input id="sqftg" name="sqftg" size="10" readonly="readonly" style="background-color:yellow;"></td>
	  				<td><input id="tsqftg" name="tsqftg" size="10" readonly="readonly" style="background-color:yellow;"></td>
	  				<td><input id="ppsf" name="ppsf" size="10"></td>
	  				<td><input id="subtot" name="subtot" size="10" readonly="readonly" style="background-color:yellow;"></td>
	  				<td><input id="fttp" name="fttp" size="15"></td>
	  				<td><textarea id="notes" name="notes" cols="35" rows="4" style="background-color:#FFE1FF;"></textarea></td>
	  			</tr>
	  			<tr><td colspan="10"><span id="morerows">&nbsp;</span></td></tr>
	  			<tr><td colspan="10" align="right"><a href="javascript:void(0);" onclick="xajax_doReset();" id="btnReset" >Add More</a></td></tr>
	  			<tr><td colspan="10" align="center"><br><textarea maxlength="200" style="background-color:#FFE1FF;" id="comment" name="commentnote" cols="175" rows="4" placeholder="Directions / Notes:"></textarea></td></tr>
	  			<tr><td colspan="10" align="left">Char Limit:<div id="chars">200</div></td></tr>
	  			<tr><td colspan="10" align="center"><a href="javascript:void(0);" onclick="xajax_doCalc(xajax.getFormValues('subform'));" id="btnCalc">Calculate</a><span id="pdfdown"></span></td></tr>
	  		</table>
	  	</td>
	  </tr>	 
	  	 
	  	 
	  	</table>
	  </div>
	</form>
	<script src="js/jquery.min.js"></script>
	<script src="js/jquery.tinylimiter.js"></script>
	<script>
	$(document).ready( function() {
		var elem = $("#chars");
		$("#comment").limiter(200, elem);
	});
	</script>
</body>
</html>