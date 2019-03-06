<html>
<head>
<title></title>
<style type="text/css">

   <!--

   body,td,font{ font-family: "Arial", "Times New Roman"; font-size: 11pt; font-style: normal;}

   a:hover { font-family: "Arial", "Times New Roman"; font-size: 11pt; font-style: normal; color: #ff99ff; text-decoration: underline}

   a:link { font-family: "Arial", "Times New Roman"; font-size: 11pt; font-style: normal; color: #0000ff; text-decoration: none}

   a:active { font-family: "Arial", "Times New Roman"; font-size: 11pt; font-style: normal; color: #ff0000; text-decoration: underline}

   a:visited { font-family: "Arial", "Times New Roman"; font-size: 11pt; font-style: normal; color: #0066cc; text-decoration: none}

      -->

</style>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
</head>

<body bgcolor="#FFFEF0">
<div align="center"><br>

<table width="800" border="1" cellspacing="1" cellpadding="4" bordercolor="#9999CC" rules=none>
  <tr bgcolor="#9999CC"> 
     <td height="20" colspan="12"><b><font color="#FFFF00">DEG 
       5.4</font></b><font color="#FFFFFF"> contains the essential genes 
       in the following Organisms (Prokaryotes).</font></td>
  </tr>
  <tr bgcolor="#ebebf5">
     <td width="6%" rowspan="2"><b>No</b></td>
     <td width="18%" rowspan="2"><b>Organism</b></td>
     <td width="38%" colspan="5"><div align="center"><b>COG (Leading strand)</b></div></td>
     <td width="38%" colspan="5"><div align="center"><b>COG (Lagging strand)</b></div></td>
  </tr>
  <tr bgcolor="#ebebf5"> 
     <td ><div align="center"><b>D</b></div></td>
     <td ><div align="center"><b>F</b></div></td>
     <td ><div align="center"><b>J</b></div></td>
     <td ><div align="center"><b>K</b></div></td>
     <td ><div align="center"><b>L</b></div></td>
     <td ><div align="center"><b>D</b></div></td>
     <td ><div align="center"><b>F</b></div></td>
     <td ><div align="center"><b>J</b></div></td>
     <td ><div align="center"><b>K</b></div></td>
     <td ><div align="center"><b>L</b></div></td>
  </tr>
  <?
	################################################  
	#connect to the database
	$link=mysql_pconnect("localhost","ohy","OHY7638")or
           die("Unable to connect to MySQL");
	mysql_select_db("egdb",$link) or
           die("Unable to select default database");
    #select the records which belong to the same class
	$sql= "select t1.osab, t1.numD1, t1.numF1, t1.numJ1, t1.numK1, t1.numL1, t1.numD2, t1.numF2, t1.numJ2, t1.numK2, t1.numL2, t1.oa from coreorganism as t1 order by trim(t1.osab)";
	$result=mysql_query($sql,$link);
	$rows=mysql_num_rows($result);
	
	#set two background color to the context rows
    $colorflag=1;
    $line=0;
	while($line<$rows){
		$arr=mysql_fetch_array($result);
		$line++;
		#col start
 		if ($colorflag==1){
			echo "<tr height=25 bgcolor='#FFFFFF'>\n";
			$colorflag=0;
		}else{
			echo "<tr height=25 bgcolor='#ebebf5'>\n";
			$colorflag=1;
		}
		$myoa=trim($arr[oa]);
		#col1
		echo "<td width=\"6%\"><font size='-1'>\n";
		echo $line;
		echo "</font></td>\n";
		#col2
		echo "<td width=\"18%\"><font size='-1'><em>\n";
		$myos=trim($arr[osab]);
		echo $myos;
		echo "</em></td>\n";
		#col3
		echo "<td><font size='-1'>\n";
		echo "<div align=\"center\">";	
		echo "<a href=\"show.php?oa=$myoa&code=D&page=1\">";
		# http://www.ncbi.nlm.nih.gov/COG/grace/cogenome.cgi?g=1423
		# http://www.ncbi.nlm.nih.gov/COG/grace/wiew.cgi?fun=J
		# http://www.ncbi.nlm.nih.gov/COG/grace/cogenome.cgi?g=1423&fun=J
		# http://www.ncbi.nlm.nih.gov/sutils/coxik.cgi?cut=45&gi=27
		# http://www.ncbi.nlm.nih.gov/sutils/cogtik.cgi?gi=27&cog=J
		echo $arr[numD1];
		echo "</a>";
		echo "</div>";
		echo "</font></td>\n";
		#col4
		echo "<td><font size='-1'>\n";
		echo "<div align=\"center\">";	
		echo "<a href=\"show.php?oa=$myoa&code=F&page=1\">";
		echo $arr[numF1];
		echo "</a>";
		echo "</div>";
		echo "</font></td>\n";
		#col5
		echo "<td><font size='-1'>\n";
		echo "<div align=\"center\">";	
		echo "<a href=\"show.php?oa=$myoa&code=J&page=1\">";
		echo $arr[numJ1];
		echo "</a>";
		echo "</div>";
		echo "</font></td>\n";
		#col6
		echo "<td><font size='-1'>\n";
		echo "<div align=\"center\">";	
		echo "<a href=\"show.php?oa=$myoa&code=K&page=1\">";
		echo $arr[numK1];
		echo "</a>";
		echo "</div>";
		echo "</font></td>\n";
		#col7
		echo "<td><font size='-1'>\n";
		echo "<div align=\"center\">";	
		echo "<a href=\"show.php?oa=$myoa&code=L&page=1\">";
		echo $arr[numL1];
		echo "</a>";
		echo "</div>";
		echo "</font></td>\n";
		#col8
		echo "<td><font size='-1'>\n";
		echo "<div align=\"center\">";	
		echo $arr[numD2];
		echo "</div>";
		echo "</font></td>\n";
		#col9
		echo "<td><font size='-1'>\n";
		echo "<div align=\"center\">";	
		echo $arr[numF2];
		echo "</div>";
		echo "</font></td>\n";
		#col10
		echo "<td><font size='-1'>\n";
		echo "<div align=\"center\">";	
		echo $arr[numJ2];
		echo "</div>";
		echo "</font></td>\n";
		#col11
		echo "<td><font size='-1'>\n";
		echo "<div align=\"center\">";	
		echo $arr[numK2];
		echo "</div>";
		echo "</font></td>\n";
		#col12
		echo "<td><font size='-1'>\n";
		echo "<div align=\"center\">";	
		echo $arr[numL2];
		echo "</div>";
		echo "</font></td>\n";	
		#col end
		echo "</tr>\n";   
	}#end while($line<$rows)
	mysql_close();
  ?>
</table>

</div>
<p align="center">&nbsp;</p>
</body>
</html>
