<html>
<head>
<title>Show</title>
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
<div align="center">
<a name="top"></a><br>

<?php  
  $oa=$_GET['oa'];
  $code=$_GET['code'];
  $page=$_GET['page'];
  $oa=trim($oa);
  $code=trim($code);

  $category="";
  switch($code){
	case 'J':
		$category="Translation, ribosomal structure and biogenesis";break;
	case 'K':
		$category="Transcription";break;
	case 'L':
	    $category="Replication, recombination and repair";break;
	case 'D':
	    $category="Cell cycle control, cell division, chromosome partitioning";break;
	case 'F':
	    $category="Nucleotide transport and metabolism";break;
  }
 	
  #connect to the database
  $link=mysql_pconnect("localhost","ohy","OHY7638")or
           die("Unable to connect to MySQL");
  mysql_select_db("egdb",$link) or
           die("Unable to select default database");
    
# $sql= "select t1.acc, t1.ac, t1.code, t1.gnb, t1.oi, t1.cog, t1.deb, t1.os, t1.oa from coreannotation as t1 where trim(t1.oa)=\"$oa\" and trim(t1.code)=\"$code\"";
# $sql= "select t1.acc, t1.ac, t1.code, t1.gnb, t1.oi, t1.cog, t1.deb, t1.os, t1.oa from coreannotation as t1 where trim(t1.oa)=\"NC_005966\" and trim(t1.code)=\"D\"";
 $sql= "select t1.acc, t1.ac, t1.code, t1.oi, t1.cog, t1.deb, t1.os, t1.oa, t2.ac, t2.gn from coreannotation as t1, degannotation5p as t2 where trim(t1.oa)=\"$oa\" and trim(t1.code)=\"$code\" and trim(t1.ac)=trim(t2.ac)";
    
  $result=mysql_query($sql,$link);
  $resultos=mysql_query($sql,$link);
  $rows=mysql_num_rows($result);
  $display_max_rows=60;

  if($rows < 1){
	  echo "<div align='center'>
      <img src='image/construct.gif' width='40' height='40'></div>\n";
  }else{
      #reset the number of page.
	  $page_number=ceil($rows/$display_max_rows);
	  $current_page=$page; 
	  $current_row_min= ($current_page-1)*$display_max_rows +1;
	  $current_row_max=($current_page-1)*$display_max_rows +$display_max_rows;
	  if($current_row_max>$rows) $current_row_max=$rows;

	  $arros=mysql_fetch_array($resultos);
	  $myos=trim($arros[os]);
  }#end if ($rows < 1)
?>

<? ################ the table contains the full information ?>

<table width="900" border="0" cellpadding="4">
  <tr>
    <td width="50%">
     <? echo "<B>Organsim: </B>&nbsp;$myos\n"; ?>
    </td>
	<td>
     <? echo "<B>Category: </B>&nbsp;$category\n"; ?>
	</td>
  </tr>
</table>

<table width="900" border="0" cellpadding="4">
  <tr> 
    <td>	 
     <? echo "Items $current_row_min - $current_row_max of $rows"; ?>
    </td>
    <td><div align="right">
     <? echo "Page $current_page of $page_number"; ?>
	 </div>
    </td>
    <td width="20%"><div align="right">
     <? #display "Previous page".
		if(($current_page-1)>= 1){
			$previous_page=$current_page -1;
			echo "<a href=\"show.php?oa=$oa&code=$code&page=$previous_page\">";
			echo "<img src=\"image/bu_previous.gif\" border=\"0\">";
			echo "</a>\n";
		}
		echo " ";
		#select page.
		if($page_number>1){
			for($j=1; $j <= $page_number; $j++){
				if($j==$current_page){
					echo "<font color=\"#FF0000\"><b>$j</b></font>";
					echo " ";
				}else{
					echo "<a href=\"show.php?oa=$oa&code=$code&page=$j\">";
					echo "<body vlink=\"black\">$j</body>";
					echo "</a>";
					echo " ";
				}
			}
		}
		#display "next page".
		if(($current_page+1)<=$page_number){
			$next_page=$current_page+1;
			echo "<a href=\"show.php?oa=$oa&code=$code&page=$next_page\">";
			echo "<img src=\"image/bu_next.gif\" border=\"0\">";
			echo "</a>\n";
		}
	 ?>
	 </div>
    </td>
  </tr>
</table>

<table width="900" border="0" cellpadding="4" cellspacing="0">
  <tr bgcolor="#9999CC"> 
    <td height=30 width="6%"><b><font color="#FFFFFF" size="-1">#NO</font></b></td>
    <td width="15%"><b><font size="-1" color="#FFFFFF"><a href="showac.php?page=1" title="Click to sort by AC_DEG">AC</a></font></b></td>
    <td width="12%"><b><font size="-1" color="#FFFFFF"><a href="showgn.php?page=1" title="Click to sort by Gene Name">Gene Name</a></font></b></td>
	<td width="12%"><b><font size="-1" color="#FFFFFF"><a href="showgn.php?page=1" title="Click to sort by Gene Name">ORF ID</a></font></b></td>
	<td width="15%"><b><font size="-1" color="#FFFFFF"><a href="showgn.php?page=1" title="Click to sort by Gene Name">COG</a></font></b></td>
    <td width="40%"><b><font color="#FFFFFF" size="-1"><a href="showde.php?page=1" title="Click to sort by Function">Function</a></font></b></td>    
  </tr>
 
  <? #set two background color to the context rows
     $colorflag=1;
     $line=0;	  
	 while($line<$rows){
       $arr=mysql_fetch_array($result);
       $line++;
	   if($line >= $current_row_min and $line <= $current_row_max){ 
		 #col start
 	     if ($colorflag==1){
           echo "<tr height=25 bgcolor='#FFFFFF'>\n";
           $colorflag=0;
         }else{
           echo "<tr height=25 bgcolor='#ebebf5'>\n";
           $colorflag=1;
	     }
	     #col1
         echo "<td><font size='-1'>\n";
         echo $line;
	     echo "</font></td>\n";
         #col2
	     echo "<td><font size='-1'>\n";
	     $myacc=trim($arr[acc]);
	     echo "<a href=\"information.php?acc=$myacc\">";
	     echo trim($arr[ac]);
	     echo "</a>";
	     echo "</font></td>\n";
         #col3
         echo "<td><font size='-1'>\n";
	     # echo trim($arr[gnb]);
		 echo trim($arr[gn]);
	     echo "</font></td>\n";
	     #col4
	     echo "<td><font size='-1'>\n";
	     echo trim($arr[oi]);
	     echo "</font></td>\n";    
	     #col5
	     echo "<td><font size='-1'>\n";
	     echo trim($arr[cog]);
	     echo "</font></td>\n";
	     #col6
		 echo "<td><font size='-1'>\n";
	     echo trim($arr[deb]);
	     echo "</font></td>\n";   
	     #col end
         echo "</tr>\n";
	   }# end if($line >= $current_row_min and $line <= $current_row_max)
	 }#end while
 
	 mysql_close();
  ?>
  <tr bgcolor="#9999CC">
    <td height="22" colspan="6"></td>
  </tr>
</table>

<table width="900" border="0" cellpadding="4">
  <tr> 
    <td>
	  <? echo "Items $current_row_min - $current_row_max of $rows"; ?>
    </td>
    <td><div align="right">
      <? echo "Page $current_page of $page_number"; ?>
	  </div>
    </td>
    <td width="20%"><div align="right">
      <? #display "Previous page".
		 if(($current_page-1)>= 1){
			$previous_page=$current_page -1;
			echo " <a href=\"show.php?oa=$oa&code=$code&page=$previous_page\">";
			echo "<img src=\"image/bu_previous.gif\" border=\"0\">";
			echo "</a>\n";
		 }
		 echo " ";
		 #select page.
		 if($page_number>1){
			for($j=1; $j <= $page_number; $j++){
				if($j==$current_page){
					echo "<font color=\"#FF0000\"><b>$j</b></font>";
					echo " ";
				}else{
					echo "<a href=\"show.php?oa=$oa&code=$code&page=$j\">";
					echo "<body vlink=\"black\">$j</body>";
					echo "</a>";
					echo " ";
				}
			}
		 }
		 #display "next page".
		 if(($current_page+1)<=$page_number){
			$next_page=$current_page+1;
			echo "<a href=\"show.php?oa=$oa&code=$code&page=$next_page\">";
			echo "<img src=\"image/bu_next.gif\" border=\"0\">";
			echo "</a>\n";
		 }
	  ?>
	  </div>
    </td>
  </tr>
  <tr> 
    <td height="20" colspan="3">
      [<a href="#top">TOP</a>]<br>
    </td>
  </tr>
</table>

</div>
</body>
</html>
