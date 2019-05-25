<?php
$numbers = range(1, 5);
shuffle($numbers);
foreach ($numbers as $number) {
	if ($number == 1)
	{
		$href = 'http://1.com';
	}
	if ($number == 2)
	{
		$href = 'http://2.com';
	}
	if ($number == 3)
	{
		$href = 'http://3.com';
	}
	if ($number == 4)
	{
		$href = 'http://4.com';
	}
	if ($number == 5)
	{
		$href = 'http://5.com';
	}
	echo "<a href='".$href."' target='_blank' onclick='_gaq.push(['_trackEvent', 'sponsorClick', '".$number."']);' ><img class='affiliates' src='../images/".$number.".png' ></a>";
}
?>

		<hr />