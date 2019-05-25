<?php
require ("../accounts/connect.php");
$vidid = $_POST['vidid'];
$query = mysql_query("SELECT info, links, date FROM videos WHERE id='".$vidid."'");
while ($row = mysql_fetch_array($query))
{
	$info = nl2br($row['info']);
	$links = $row['links'];
	$timestamp = $row['date'];
}
echo "<div class='left'>";
echo (!isset($info) || $info != '')? '<strong>Info:</strong> <br>'  :   '' ;
echo "</div>";
echo "<div class='right'>";
$date = strtotime($timestamp);
echo "<strong>".date("d-m-Y", $date)."</strong>";
echo "</div>";
echo (isset($info) && $info != '')? ''.$info.'' : '' ;

echo "<center>";
$linkslist = preg_split('/ /', $links);
foreach ($linkslist as $link)
{
	echo "<br><a href='".$link."' target='_blank' >";
	$cleanlink = preg_replace('#^[^:/.]*[:/]+#i', '', $link);
	echo $cleanlink;
	echo "</a>";
}
echo "</center>";
?>



			