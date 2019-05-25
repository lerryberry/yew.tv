<?php
ob_start("ob_gzhandler");
require("../accounts/connect.php");
?>
<html>
<head>
</head>
<body>
<?php

require ('permission.php');

//email preferences---------------------------------------------------------------------------------------------------------------------
	
	$ch ='';
	
	if (isset($_POST['export']))
	{
		if (isset($_POST['check']))
		{
			$total = '';
			$check = $_POST['check'];
			foreach($check as $ch)
			{
				$total .= $ch;
			}
		}
		else
		{
			$total = '';	
		}
		if (preg_match('/a/', $total))
		{
			$cam = mysql_real_escape_string($_POST['camera']);
			$soft = mysql_real_escape_string($_POST['software']);
		}
		header( "location:download.php?total=".$total."&cam=".$cam."&soft=".$soft."");
	}
	
	if (preg_match("[a]", $ch))
	{
		$a = 'checked';
	}
	else 
		$a = 'unchecked';
	if (preg_match("[b]", $ch))
	{
		$b = 'checked';
	}
	else 
		$b = 'unchecked';
	if (preg_match("[c]", $ch))
	{
		$c = 'checked';
	}
	else 
		$c = 'unchecked';
	if (preg_match("[d]", $ch))
	{
		$d = 'checked';
	}
	else 
		$d = 'unchecked';
	if (preg_match("[e]", $ch))
	{
		$e = 'checked';
	}
	else 
		$e = 'unchecked';
		?><br>
		<form action ="export.php" method='POST'>
			Products(required for drop boxes): <Input type = 'Checkbox' Name ="check[]" value="a"  /><br />
			Newsletter: <Input type = 'Checkbox' Name ="check[]" value="b"  /><br />
			A request is made: <Input type = 'Checkbox' Name ="check[]" value="c"  /><br />
			Poll updates: <Input type = 'Checkbox' Name ="check[]" value="d"  /><br />
			Other: <Input type = 'Checkbox' Name ="check[]" value="e"  /><br />
            Camera <select name="camera">
            <option value="" selected="selected">
            <?php
            $query = mysql_query("SELECT * FROM products WHERE category='camera'");
            while ($row = mysql_fetch_array($query))
            {
                $title = $row['title'];
                // Print out the contents of each row
                print "<option value='".$title."'>".$title."";
            }
             ?>
            </select>
            Software <select name="software">
            <option value="" selected="selected">
            <?php
            $query = mysql_query("SELECT * FROM products WHERE category='software'");
            while ($row = mysql_fetch_array($query))
            {
                $title = $row['title'];
                // Print out the contents of each row
                print "<option value='".$title."'>".$title."";
            }
             ?>
             </select>
             <br/>
             <br/>
             <input type ='submit' value='export' name='export' />
            
        </form>