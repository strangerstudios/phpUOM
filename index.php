<?php
include "class.uom.php";
?>

<html>
<head>
<title>Unit of Measure Class</title>
<link href="style.css" rel="stylesheet" type="text/css">
</head>
<body>
<div id="wrapper">
<center><h1>Unit of Measure Demo</h1></center>
<form method="post" action="<?php echo $PHP_SELF;?>">
<table><tr><td>Measurement (ex: 2.56kg):</td>
<td>
<input type="text" name="measure" value="<?php 
if (empty($_POST["measure"]))
	echo "2.56kg";
else
	echo $_POST["measure"];?>"/>
</td></tr>
<tr><td>Convert To (ex: lb):</td>
<td><input type="text" name="convertTo" value="<?php 
if (empty($_POST["measure"])) 
	echo "lb";
else
	echo $_POST["convertTo"];?>"/></td></tr>
<tr><td colspan=2><center><input type="submit" value="Submit"></center></td></tr></table>
</form>

<?php
//include "class.uom.php";
if (isset($_POST["measure"])) {
	$str = $_POST["measure"];

	echo "<div class='code'><h2>PHP Code</h2>";
	echo "include 'class.uom.php';<br /><br />";
	echo '$uom = new UOM("' . $str . '");<br /><br />';
	echo 'echo $uom->numpart . $uom->display_uom;<br />';
	echo 'echo $uom->size . $uom->uom;<br />';
	if (!empty($_POST["convertTo"])) {
		echo 'echo $uom->inMeasure("' . $_POST["convertTo"] . '") . "' . $_POST["convertTo"] . '";';
	}
	
	echo "</div>";
	echo "<div class='output'><h2>Output</h2>";
	$uom = new UOM($str);
	echo $uom->numpart . $uom->display_uom . "<br />";
	echo $uom->size . $uom->uom . "<br />";
	if (!empty($_POST["convertTo"])) {
		echo $uom->inMeasure($_POST["convertTo"]) . $_POST["convertTo"] . "<br />";
	}
	echo "</div>";
}
?>
</div>
</body>
</html>



