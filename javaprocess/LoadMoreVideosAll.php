<?php
ob_start("ob_gzhandler");
require ("../accounts/connect.php");
$more = 0;
$input = $_GET['loadedVideo'];
$query = mysql_query("SELECT id, url, title, channel, username  FROM videos WHERE active > '1' AND id NOT IN (".$input.") ORDER BY RAND() LIMIT 1");
while ($row = mysql_fetch_array($query))
{
	$more = 1;
	$id = $row['id'];
	$input .= ",'".$id."'";
	
	echo "<div style='display: none;' class='exclude'>";
	print $input;
	echo "</div>";
	
	$url = $row['url'];
	$title = $row['title'];
	$channel = $row['channel'];
	$by = $row['username'];
	echo "
				<iframe frameborder='0' src='".$url."?rel=0&wmode=transparent' class='video'></iframe>
				<a href='http://".$channel.".yew.tv?autoplay=1' class='overlay'>
					<h2>
					<hr>
						<div  class='title'><i>".ucwords($title)."</i></div>
						<b>by:</b> ".ucwords($by)."<br>
						".$channel.".yew.tv
					<hr>
					</h2>
				</a>
			";

}
$query = mysql_query("SELECT id, url, title, channel, username  FROM videos WHERE active > '1' AND id NOT IN (".$input.") ORDER BY RAND() LIMIT 1");
while ($row = mysql_fetch_array($query))
{
	$more = 1;
	$id = $row['id'];
	$input .= ",'".$id."'";
	
	echo "<div style='display: none;' class='exclude'>";
	print $input;
	echo "</div>";
	
	$url = $row['url'];
	$title = $row['title'];
	$channel = $row['channel'];
	$by = $row['username'];
	
	echo "
				<iframe frameborder='0' src='".$url."?rel=0&wmode=transparent' class='video'></iframe>
				<a href='http://".$channel.".yew.tv?autoplay=1' class='overlay'>
					<h2>
					<hr>
						<div class='title'><i>".ucwords($title)."</i></div>
						<b>by:</b> ".ucwords($by)."<br>
						".$channel.".yew.tv
					<hr>
					</h2>
				</a>
			";
}
$query = mysql_query("SELECT id, url, title, channel, username  FROM videos WHERE active > '1' AND id NOT IN (".$input.") ORDER BY RAND() LIMIT 1");
while ($row = mysql_fetch_array($query))
{
	$more = 1;
	$id = $row['id'];
	$input .= ",'".$id."'";
	
	echo "<div style='display: none;' class='exclude'>";
	print $input;
	echo "</div>";
	
	$url = $row['url'];
	$title = $row['title'];
	$channel = $row['channel'];
	$by = $row['username'];
	
	echo "
				<iframe frameborder='0' src='".$url."?rel=0&wmode=transparent' class='video'></iframe>
				<a href='http://".$channel.".yew.tv?autoplay=1' class='overlay'>
					<h2>
					<hr>
						<div class='title'><i>".ucwords($title)."</i></div>
						<b>by:</b> ".ucwords($by)."<br>
						".$channel.".yew.tv
					<hr>
					</h2>
				</a>
			";
}
$query = mysql_query("SELECT id, url, title, channel, username  FROM videos WHERE active > '1' AND id NOT IN (".$input.") ORDER BY RAND() LIMIT 1");
while ($row = mysql_fetch_array($query))
{
	$more = 1;
	$id = $row['id'];
	$input .= ",'".$id."'";
	
	echo "<div style='display: none;' class='exclude'>";
	print $input;
	echo "</div>";
	
	$url = $row['url'];
	$title = $row['title'];
	$channel = $row['channel'];
	$by = $row['username'];
	
	echo "
				<iframe frameborder='0' src='".$url."?rel=0&wmode=transparent' class='video'></iframe>
				<a href='http://".$channel.".yew.tv?autoplay=1' class='overlay'>
					<h2>
					<hr>
						<div class='title'><i>".ucwords($title)."</i></div>
						<b>by:</b> ".ucwords($by)."<br>
						".$channel.".yew.tv
					<hr>
					</h2>
				</a>
		";

}
if ($more != 0)
{
	echo "<div id='ready' style='display:none;'></div>";
}
?>