


<?php
$lines = file("./HRAT/rateval.txt");
$count = 0;
$ratc = 0;
$fname = $_SERVER['SCRIPT_NAME'];
//echo($fname);

foreach ($lines as $line_num => $line)
{
	//echo $line."<br>";
	$firstPos = strpos($line,'****');
	$id = substr($line,0,$firstPos);
	//echo($id."...<br>");
	//echo($fname."<br>");
	//echo("-----------");

	if($id == $fname)
	{
		$firstPos = strpos($line,'%%%%');
		$rat = substr($line,$firstPos+4,$line.length-1);
		$count = $count+1;
		$ratc = $ratc+$rat;
		//echo($rat."********");
	}
}

if($count==0)
{
$avg = 0;
}
else
{
$avg = round($ratc/$count*100)/100;
}

$perc = round( (100/5)*$avg);
$rem = 100-$perc;

?>
<table align=center valign=center style="background-color: #eaeeaa; border: 2px ridge #ddffdd;">
<tr><td align=center>

<tr><td>
<table id="dums" align=center width=150 height=25 bgcolor="#009900" cellpadding=0 cellspacing=0 style="font-size: 13px; border: #449944 solid 2px;">
<tr width=150>
<td bgcolor="red" width=<?php echo($perc); ?>>
</td>
<td bgcolor="#F89696"  width=<?php echo($rem); ?>>
</td>
<td bgcolor="#ffffff" align=center width=50 style="font-size: 12px; border: #449944 solid 4px; border-bottom-width: 1px; border-top-width: 1px; border-right-width: 1px;">
<?php echo($perc."%" ); ?>
</td>
</tr>
</table>

<table align=center width=150 height=25 bgcolor="#009900" cellpadding=0 cellspacing=0 style="font-size: 12px; border: #449944 solid 2px;">
<tr bgcolor="#ffffff" >
<td align=center width=80>Total Votes</td><td  align=center style="color: #752824;"><?php echo($count); ?></td>
</tr>
<tr bgcolor="#ffffff">
<td align=center width=70 >Avg Rating</td><td align=center style="color: red;"><?php echo($avg); ?></td>
</tr>
</table>
</td></tr><tr><td>
<form action="./HRAT/rating.php" method="POST" style="font-size: 13px; margin:0px;">
<input name=fname type="hidden" value=<?php echo($fname); ?>>
<input name=rate type="radio" value="1">1
<input name=rate type="radio" value="2">2
<input name=rate type="radio" value="3">3
<input name=rate type="radio" value="4">4
<input name=rate type="radio" value="5" checked>5
<input type="submit" value="Rate It" style="border: 1px solid green; cursor: pointer;">
</form>
</td></tr></table>



