
<table align=center  border=1 style="margin-left: 35px; font-size: 13px; border: #449944 solid 2px;">
<tr>
<td  align=center>
<?php
$name = $_POST['fname'];
$rat = $_POST['rate'];
//echo "----$name";
//echo "---------------$rat";
$ser=$_SERVER['HTTP_HOST'];
$ref=$_SERVER['HTTP_REFERER'];
$host= parse_url($ref);
//echo "-------$host[host]-------";

$fname = $name;
$rip = $_SERVER['REMOTE_ADDR'];
$lines = file("./rateval.txt");
$rated = false;

if($ser == $host[host])
{
foreach ($lines as $line_num => $line)
{
	//echo $line."<br>";
	$firstPos = strpos($line,$rip);
	//echo($firstPos);
	if(!($firstPos === false))
	{
		$secPos = strpos($line,$fname);

		if(!($secPos === false))
		{
			//echo($secPos."-".$fname."-".$line);
			$rated=true;
			break;
		}
	}
}

if($rated === false && $name!='')
{
$open = fopen("./rateval.txt", "a");
fwrite($open,$fname."****".$rip."####"."0000"."%%%%".$rat);
fwrite($open,"\n");
fclose($open);
}

echo("<div align=left style=\"margin-left: 25px; font-size: 13px; border: #449944 solid 1px; padding: 12px;\">");
include "message.txt";
echo("</div>");

?>
</td>
</tr>
</table>

