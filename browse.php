<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
<title>Browse Core-Essential Gene List</title>
<link rel="stylesheet" href="image/master.css" type="text/css">
</head>
<body>
<div class="skipLinks">Skip to: <a href="#main">Content</a></div>
<a id="top" name="top"></a>
<div id="container">  
  <div id="header">
    <h1 id="siteName">Core-Essential Genes</h1> 
    <div id="mainNav"> 
      <a href="index.html">Home</a> | <a href="table.php">Table</a> | <a href="figure.htm">Figure</a> | <a href="method.htm">Method</a> | <a href="/deg/" target="_blank">DEG</a>
    </div>	
  </div>
  <!-- end header -->
  <div id="main">
    <div id="breadcrumb">
      » <a href="index.html">Home</a> » <a href="table.php">Data table</a> » Gene list
    </div>
	<div id="contentData"> 

<?php    
  #connect to the database
  $link=mysql_pconnect("localhost","ohy","OHY7638")or
           die("Unable to connect to MySQL");
  mysql_select_db("egdb",$link) or
           die("Unable to select default database");
    
# $sql= "select t1.acc, t1.ac, t1.code, t1.gnb, t1.oi, t1.cog, t1.deb, t1.os, t1.oa from coreannotation as t1 where trim(t1.oa)=\"$oa\" and trim(t1.code)=\"$code\"";
# $sql= "select t1.acc, t1.ac, t1.code, t1.gnb, t1.oi, t1.cog, t1.deb, t1.os, t1.oa from coreannotation as t1 where trim(t1.oa)=\"NC_005966\" and trim(t1.code)=\"D\"";
 $sql= "select t1.acc, t1.ac, t1.code, t1.oi, t1.cog, t1.deb, t1.os, t1.oa, t2.ac, t2.gn from coreannotation as t1, degannotation5p as t2 where trim(t1.ac)=trim(t2.ac)";
    
  $result=mysql_query($sql,$link);
  $rows=mysql_num_rows($result);
  $display_max_rows=60;

  if($rows < 1){
	  echo "<div align='center'>
      <img src='image/construct.gif' width='40' height='40'></div>\n";
  }else{
      #reset the number of page.
	  $page_number=ceil($rows/$display_max_rows);
	  $page=$_GET['page'];
	  $current_page=$page; 
	  $current_row_min= ($current_page-1)*$display_max_rows +1;
	  $current_row_max=($current_page-1)*$display_max_rows +$display_max_rows;
	  if($current_row_max>$rows) $current_row_max=$rows;

  }#end if ($rows < 1)
?>

<? ################ the table contains the full information ?>

<table class="geneList" cellpadding="4">
  <tr> 
    <td>	 
     <? echo "Items $current_row_min - $current_row_max of $rows"; ?>
    </td>
    <td>
     <? echo "Page $current_page of $page_number"; ?>
    </td>
    <td width="40%">
     <? #display "Previous page".
		if(($current_page-1)>= 1){
			$previous_page=$current_page -1;
			echo "<a href=\"browse.php?page=$previous_page\">";
			echo "<img src=\"image/bu_previous.gif\" border=\"0\">";
			echo "</a>\n";
		}
		echo " ";
		#select page.
		if($page_number>1){
			for($j=1; $j <= $page_number; $j++){
				if($j==$current_page){
					echo "<span class='currentPage'>$j</span>";
					echo " ";
				}else{
					echo "<a href=\"browse.php?page=$j\">";
					echo "<body vlink=\"black\">$j</body>";
					echo "</a>";
					echo " ";
				}
			}
		}
		#display "next page".
		if(($current_page+1)<=$page_number){
			$next_page=$current_page+1;
			echo "<a href=\"browse.php?page=$next_page\">";
			echo "<img src=\"image/bu_next.gif\" border=\"0\">";
			echo "</a>\n";
		}
	 ?>
    </td>
  </tr>
</table>

<table class="geneList" cellpadding="4" cellspacing="0">
  <tr class="tableHeader"> 
    <td width="6%">#NO</td>
    <td width="15%"><a href="browseac.php?page=1" title="Click to sort by AC_DEG">AC</a></td>
    <td width="12%"><a href="browsegn.php?page=1" title="Click to sort by Gene Name">Gene Name</a></td>
	<td width="12%"><a href="browseoi.php?page=1" title="Click to sort by ORF ID">ORF ID</a></td>
	<td width="15%"><a href="browsecog.php?page=1" title="Click to sort by COG">COG</a></td>
    <td width="40%"><a href="browsede.php?page=1" title="Click to sort by Function">Function</a></td>    
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
           echo "<tr class='dataLineOdd'>\n";
           $colorflag=0;
         }else{
           echo "<tr class='dataLineEven'>\n";
           $colorflag=1;
	     }
	     #col1
         echo "<td>\n";
         echo $line;
	     echo "</td>\n";
         #col2
	     echo "<td>\n";
	     $myacc=trim($arr[acc]);
	     echo "<a href=\"info.php?acc=$myacc\">";
	     echo trim($arr[ac]);
	     echo "</a>";
	     echo "</td>\n";
         #col3
         echo "<td>\n";
	     # echo trim($arr[gnb]);
		 echo trim($arr[gn]);
	     echo "</td>\n";
	     #col4
	     echo "<td>\n";
	     echo trim($arr[oi]);
	     echo "</td>\n";    
	     #col5
	     echo "<td>\n";
	     echo trim($arr[cog]);
	     echo "</td>\n";
	     #col6
		 echo "<td>\n";
	     echo trim($arr[deb]);
	     echo "</td>\n";   
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

<table class="geneList" cellpadding="4">
  <tr> 
    <td>
	  <? echo "Items $current_row_min - $current_row_max of $rows"; ?>
    </td>
    <td>
      <? echo "Page $current_page of $page_number"; ?>
    </td>
    <td width="40%">
      <? #display "Previous page".
		 if(($current_page-1)>= 1){
			$previous_page=$current_page -1;
			echo " <a href=\"browse.php?page=$previous_page\">";
			echo "<img src=\"image/bu_previous.gif\" border=\"0\">";
			echo "</a>\n";
		 }
		 echo " ";
		 #select page.
		 if($page_number>1){
			for($j=1; $j <= $page_number; $j++){
				if($j==$current_page){
					echo "<span class='currentPage'>$j</span>";
					echo " ";
				}else{
					echo "<a href=\"browse.php?page=$j\">";
					echo "<body vlink=\"black\">$j</body>";
					echo "</a>";
					echo " ";
				}
			}
		 }
		 #display "next page".
		 if(($current_page+1)<=$page_number){
			$next_page=$current_page+1;
			echo "<a href=\"browse.php?page=$next_page\">";
			echo "<img src=\"image/bu_next.gif\" border=\"0\">";
			echo "</a>\n";
		 }
	  ?>
    </td>
  </tr>
  <tr> 
    <td height="20" colspan="3">
      [<a href="#top">TOP</a>]
    </td>
  </tr>
</table>

    </div>
	<!-- end contentData -->
  </div>
  <!-- end main -->
  <div id="footer">
    Topic revision: r2 - July 26, 2009 | <a href="/" target="_blank">TUBIC</a>
  </div>
</div>
<!-- end container -->
</body>
</html>
