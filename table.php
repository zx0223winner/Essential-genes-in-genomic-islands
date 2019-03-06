<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
<title>Data Table</title>
<link rel="stylesheet" href="image/master.css" type="text/css">
</head>
<body>
<div class="skipLinks">Skip to: <a href="#main">Content</a></div>
<a id="top" name="top"></a>
<div id="container">  
  <div id="header">
    <h1 id="siteName">Leading-Strand Essential Genes</h1> 
    <div id="mainNav"> 
      <a href="index.html">Home</a> | <a href="table.php">Table</a> | <a href="figure.htm">Figure</a> | <a href="/deg/" target="_blank">DEG</a> | <a href="/" target="_blank">TUBIC</a>
    </div>	
  </div>
  <!-- end header -->
  <div id="main">
    <div id="breadcrumb">
      » <a href="index.html">Home</a> » Data table
    </div>
	<div id="contentData"> 

<?
	#connect to the database
	$link=mysql_pconnect("localhost","ohy","OHY7638")or
           die("Unable to connect to MySQL");
	mysql_select_db("egdb",$link) or
           die("Unable to select default database");
?>

<br><a id="tabs1" name="tabs1"></a>
<table class="dataTableDownload" cellspacing="1" cellpadding="4">
<caption>Table S1.</caption>
<tr class="tableHeaderDownload">
   <td>The data of 3434 essential genes from ten bacterial genomes (<a href="table/Table_S1.xls">Table_S1.xls</a>)</td>
</tr>
</table>
<br><a id="tabs2" name="tabs2"></a>
<table class="dataTableDownload" cellspacing="1" cellpadding="4">
<caption>Table S2.</caption>
<tr class="tableHeaderDownload">
   <td>The data of 16772 nonessential genes from ten bacterial genomes (<a href="table/Table_S2.xls">Table_S2.xls</a>)</td>
</tr>
</table>
<br><a id="tabs3" name="tabs3"></a>
<table class="dataTable" cellspacing="1" cellpadding="4">
  <caption>Table S3 &nbsp;&nbsp;[<em><font color="#993333">Database of Leading-Strand Essential Genes</font></em>].</caption>
  <colgroup>
     <col align=left span=2>
  <colgroup>
     <col align=center span=10>
  <tr class="tableHeader"> 
     <td colspan="12">The 1818 (73.4% of 2477) essential genes with fundamental functions in the leading strand</td>
  </tr>
  <tr class="dataLineHeader">
     <td width="5%" rowspan="2">No</td>
     <td width="15%" rowspan="2">Organism</td>
     <td width="80%" colspan="10"><a href="http://www.ncbi.nlm.nih.gov/COG/grace/fiew.cgi" target="_blank">COG</a> (Leading strand)</td>
  </tr>
  <tr class="dataLineHeader"> 
     <td width="8%">J</td>
     <td width="8%">K</td>
     <td width="8%">L</td>
     <td width="8%">D</td>
     <td width="8%">M</td>
     <td width="8%">O</td>
     <td width="8%">C</td>
     <td width="8%">G</td>
     <td width="8%">E</td>
     <td width="8%">F</td>
  </tr>  
  <?
	#select the records which belong to the same class
	$sql= "select t1.osab, t1.numJ1, t1.numK1, t1.numL1, t1.numD1, t1.numM1, t1.numO1, t1.numC1, t1.numG1, t1.numE1, t1.numF1, t1.oa from coreorganism as t1 order by trim(t1.osab)";
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
			echo "<tr class='dataLineOdd'>\n";
			$colorflag=0;
		}else{
			echo "<tr class='dataLineEven'>\n";
			$colorflag=1;
		}
		$myoa=trim($arr[oa]);
		#col1
		echo "<td width=\"5%\">\n";
		echo $line;
		echo "</td>\n";
		#col2
		echo "<td width=\"15%\"><em>\n";
		$myos=trim($arr[osab]);
		echo $myos;
		echo "</em></td>\n";
		#col3
		echo "<td>\n";
		if (strlen($arr[numJ1]) == 1) echo "&nbsp;";
		echo "<a href=\"show.php?oa=$myoa&code=J&page=1\">";
		# http://www.ncbi.nlm.nih.gov/COG/grace/cogenome.cgi?g=1423
		# http://www.ncbi.nlm.nih.gov/COG/grace/wiew.cgi?fun=J
		# http://www.ncbi.nlm.nih.gov/COG/grace/cogenome.cgi?g=1423&fun=J
		# http://www.ncbi.nlm.nih.gov/sutils/coxik.cgi?cut=45&gi=27
		# http://www.ncbi.nlm.nih.gov/sutils/cogtik.cgi?gi=27&cog=J
		# http://www.ncbi.nlm.nih.gov/sutils/coxik.cgi?gi=183
		echo $arr[numJ1];
		echo "</a>";
		echo "</td>\n";
		#col4
		echo "<td>\n";
		if (strlen($arr[numK1]) == 1) echo "&nbsp;";
		echo "<a href=\"show.php?oa=$myoa&code=K&page=1\">";
		echo $arr[numK1];
		echo "</a>";
		echo "</td>\n";
		#col5
		echo "<td>\n";
		if (strlen($arr[numL1]) == 1) echo "&nbsp;";
		echo "<a href=\"show.php?oa=$myoa&code=L&page=1\">";
		echo $arr[numL1];
		echo "</a>";
		echo "</td>\n";
		#col6
		echo "<td>\n";
		if (strlen($arr[numD1]) == 1) echo "&nbsp;";
		echo "<a href=\"show.php?oa=$myoa&code=D&page=1\">";
		echo $arr[numD1];
		echo "</a>";
		echo "</td>\n";
		#col7
		echo "<td>\n";
		if (strlen($arr[numM1]) == 1) echo "&nbsp;";
		echo "<a href=\"show.php?oa=$myoa&code=M&page=1\">";
		echo $arr[numM1];
		echo "</a>";
		echo "</td>\n";
		#col8
		echo "<td>\n";
		if (strlen($arr[numO1]) == 1) echo "&nbsp;";
		echo "<a href=\"show.php?oa=$myoa&code=O&page=1\">";
		echo $arr[numO1];
		echo "</a>";
		echo "</td>\n";
		#col9
		echo "<td>\n";
		if (strlen($arr[numC1]) == 1) echo "&nbsp;";
		echo "<a href=\"show.php?oa=$myoa&code=C&page=1\">";
		echo $arr[numC1];
		echo "</a>";
		echo "</td>\n";
		#col10
		echo "<td>\n";
		if (strlen($arr[numG1]) == 1) echo "&nbsp;";
		echo "<a href=\"show.php?oa=$myoa&code=G&page=1\">";
		echo $arr[numG1];
		echo "</a>";
		echo "</td>\n";
		#col11
		echo "<td>\n";
		if (strlen($arr[numE1]) == 1) echo "&nbsp;";
		echo "<a href=\"show.php?oa=$myoa&code=E&page=1\">";
		echo $arr[numE1];
		echo "</a>";
		echo "</td>\n";
		#col12
		echo "<td>\n";
		if (strlen($arr[numF1]) == 1) echo "&nbsp;";
		echo "<a href=\"show.php?oa=$myoa&code=F&page=1\">";
		echo $arr[numF1];
		echo "</a>";
		echo "</td>\n";	
		#col end
		echo "</tr>\n";   
	}#end while($line<$rows)	
  ?>
</table>
<br><a id="tabs4" name="tabs4"></a>
<table class="dataTable" cellspacing="1" cellpadding="4">
  <caption>Table S4.</caption>
  <colgroup>
     <col align=left span=2>
  <colgroup>
     <col align=center span=10>  
  <tr class="tableHeader"> 
     <td colspan="12">The 659 (26.6% of 2477) essential genes with fundamental functions in the lagging strand</td>
  </tr>
  <tr class="dataLineHeader">  
     <td width="5%" rowspan="2">No</td>
     <td width="15%" rowspan="2">Organism</td>
     <td width="80%" colspan="10">COG (Lagging strand)</td>
  </tr>  
  <tr class="dataLineHeader"> 
     <td width="8%">J</td>
     <td width="8%">K</td>
     <td width="8%">L</td>
     <td width="8%">D</td>
     <td width="8%">M</td>
     <td width="8%">O</td>
     <td width="8%">C</td>
     <td width="8%">G</td>
     <td width="8%">E</td>
     <td width="8%">F</td>
  </tr>  
  <?
	#select the records which belong to the same class
	$sql2= "select t2.osab, t2.numJ2, t2.numK2, t2.numL2, t2.numD2, t2.numM2, t2.numO2, t2.numC2, t2.numG2, t2.numE2, t2.numF2, t2.oa from noncoreorganism as t2 order by trim(t2.osab)";
	$result2=mysql_query($sql2,$link);
	$rows=mysql_num_rows($result2);
	
	#set two background color to the context rows
    $colorflag=1;
    $line=0;
	while($line<$rows){
		$arr=mysql_fetch_array($result2);
		$line++;
		#col start
 		if ($colorflag==1){
			echo "<tr class='dataLineOdd'>\n";
			$colorflag=0;
		}else{
			echo "<tr class='dataLineEven'>\n";
			$colorflag=1;
		}
		$myoa=trim($arr[oa]);
		#col1
		echo "<td width=\"5%\">\n";
		echo $line;
		echo "</td>\n";
		#col2
		echo "<td width=\"15%\"><em>\n";
		$myos=trim($arr[osab]);
		echo $myos;
		echo "</em></td>\n";
		#col3
		echo "<td>\n";
		if (strlen($arr[numJ2]) == 1) echo "&nbsp;";
		echo $arr[numJ2];
		echo "</td>\n";
		#col4
		echo "<td>\n";
		if (strlen($arr[numK2]) == 1) echo "&nbsp;";
		echo $arr[numK2];
		echo "</td>\n";
		#col5
		echo "<td>\n";
		if (strlen($arr[numL2]) == 1) echo "&nbsp;";
		echo $arr[numL2];
		echo "</td>\n";
		#col6
		echo "<td>\n";
		if (strlen($arr[numD2]) == 1) echo "&nbsp;";
		echo $arr[numD2];
		echo "</td>\n";
		#col7
		echo "<td>\n";
		if (strlen($arr[numM2]) == 1) echo "&nbsp;";
		echo $arr[numM2];
		echo "</td>\n";
		#col8
		echo "<td>\n";
		if (strlen($arr[numO2]) == 1) echo "&nbsp;";
		echo $arr[numO2];
		echo "</td>\n";
		#col9
		echo "<td>\n";
		if (strlen($arr[numC2]) == 1) echo "&nbsp;";
		echo $arr[numC2];
		echo "</td>\n";
		#col10
		echo "<td>\n";
		if (strlen($arr[numG2]) == 1) echo "&nbsp;";
		echo $arr[numG2];
		echo "</td>\n";
		#col11
		echo "<td>\n";
		if (strlen($arr[numE2]) == 1) echo "&nbsp;";
		echo $arr[numE2];
		echo "</td>\n";
		#col12
		echo "<td>\n";
		if (strlen($arr[numF2]) == 1) echo "&nbsp;";
		echo $arr[numF2];
		echo "</td>\n";	
		#col end
		echo "</tr>\n";   
	}#end while($line<$rows)	
  ?>
</table>
<br><a id="tab1" name="tab1"></a>
<table class="dataTable" cellspacing="1" cellpadding="4">
  <caption>Table 1.</caption>
  <colgroup>
     <col align=left span=2>
  <colgroup>
     <col align=center span=9>  
  <tr class="tableHeader"> 
     <td colspan="11">Summary information of datasets</td>
  </tr>
  <tr class="dataLineHeader">  
     <td width="5%" rowspan="2">No</td>
     <td width="15%" rowspan="2">Organism</td>
	 <td width="13%" rowspan="2">Group</td>
	 <td width="10%" rowspan="2">Size (Mb)</td>
	 <td width="9%" rowspan="2">GC (%)</td>
     <td width="16%" colspan="2">Total</td>
	 <td width="16%" colspan="2">Essential</td>
	 <td width="16%" colspan="2">Nonessential</td>
  </tr>  
  <tr class="dataLineHeader"> 
     <td width="8%">Genes</td>
     <td width="8%">COGs</td>
     <td width="8%">Genes</td>
     <td width="8%">COGs</td>
     <td width="8%">Genes</td>
     <td width="8%">COGs</td>     
  </tr>
  <tr class="dataLineOdd"> 
     <td>1</td>
     <td><em>Acinetobacter baylyi</em></td>
     <td>Proteobacteria</td>
     <td>3.60</td>
     <td>40.4</td>
     <td>&nbsp;2261</td>
     <td>&nbsp;2577</td>
     <td>&nbsp;&nbsp;400</td>
     <td>&nbsp;&nbsp;441</td>
     <td>&nbsp;1861</td>
     <td>&nbsp;2136</td>	  
  </tr>
  <tr class="dataLineEven"> 
     <td>2</td>
     <td><em>Bacillus subtilis</em></td>
     <td>Firmicutes</td>
     <td>4.21</td>
     <td>43.5</td>
     <td>&nbsp;2677</td>
     <td>&nbsp;3066</td>
     <td>&nbsp;&nbsp;229</td>
     <td>&nbsp;&nbsp;250</td>
     <td>&nbsp;2448</td>
     <td>&nbsp;2816</td>	      
  </tr>
  <tr class="dataLineOdd"> 
     <td>3</td>
     <td><em>Escherichia coli</em></td>
     <td>Proteobacteria</td>    
	 <td>4.64</td>
     <td>50.8</td>
     <td>&nbsp;3558</td>
     <td>&nbsp;4247</td>
     <td>&nbsp;&nbsp;556</td>
     <td>&nbsp;&nbsp;617</td>
     <td>&nbsp;3002</td>
     <td>&nbsp;3630</td>	      
  </tr>
  <tr class="dataLineEven"> 
     <td>4</td>
     <td><em>Haemophilus influenzae</em></td>
     <td>Proteobacteria</td>
     <td>1.83</td>
     <td>38.1</td>
     <td>&nbsp;1306</td>
     <td>&nbsp;1435</td>
     <td>&nbsp;&nbsp;521</td>
     <td>&nbsp;&nbsp;574</td>
     <td>&nbsp;&nbsp;785</td>
     <td>&nbsp;&nbsp;861</td>    
  </tr>
  <tr class="dataLineOdd"> 
     <td>5</td>
     <td><em>Helicobacter pylori</em></td>
     <td>Proteobacteria</td>
	 <td>1.67</td>
     <td>38.9</td>
     <td>&nbsp;&nbsp;974</td>
     <td>&nbsp;1077</td>
     <td>&nbsp;&nbsp;196</td>
     <td>&nbsp;&nbsp;210</td>
     <td>&nbsp;&nbsp;778</td>
     <td>&nbsp;&nbsp;867</td>         
  </tr>
  <tr class="dataLineEven"> 
     <td>6</td>
     <td><em>Mycoplasma genitalium</em></td>
     <td>Firmicutes</td>
	 <td>0.58</td>
     <td>31.7</td>
     <td>&nbsp;&nbsp;305</td>
     <td>&nbsp;&nbsp;324</td>
     <td>&nbsp;&nbsp;246</td>
     <td>&nbsp;&nbsp;259</td>
     <td>&nbsp;&nbsp;&nbsp;59</td>
     <td>&nbsp;&nbsp;&nbsp;65</td>          
  </tr>
  <tr class="dataLineOdd"> 
     <td>7</td>
     <td><em>Mycoplasma pulmonis</em></td>
     <td>Firmicutes</td>
	 <td>0.96</td>
     <td>26.6</td>
     <td>&nbsp;&nbsp;454</td>
     <td>&nbsp;&nbsp;479</td>
     <td>&nbsp;&nbsp;237</td>
     <td>&nbsp;&nbsp;253</td>
     <td>&nbsp;&nbsp;217</td>
     <td>&nbsp;&nbsp;226</td>        
  </tr>
  <tr class="dataLineEven"> 
     <td>8</td>
     <td><em>Mycobacterium tuberculosis</em></td>
     <td>Actinobacteria</td>
     <td>4.41</td>
     <td>65.6</td>
     <td>&nbsp;2871</td>
     <td>&nbsp;3415</td>
     <td>&nbsp;&nbsp;534</td>
     <td>&nbsp;&nbsp;617</td>
     <td>&nbsp;2337</td>
     <td>&nbsp;2798</td>     
  </tr>
  <tr class="dataLineOdd"> 
     <td>9</td>
     <td><em>Staphylococcus aureus</em></td>
     <td>Firmicutes</td>
     <td>2.81</td>
     <td>32.8</td>
     <td>&nbsp;2105</td>
     <td>&nbsp;2456</td>
     <td>&nbsp;&nbsp;300</td>
     <td>&nbsp;&nbsp;319</td>
     <td>&nbsp;1805</td>
     <td>&nbsp;2137</td>     
  </tr>
  <tr class="dataLineEven"> 
     <td>10</td>
     <td><em>Salmonella typhimurium</em></td>
     <td>Proteobacteria</td>
     <td>4.86</td>
     <td>52.2</td>
     <td>&nbsp;3695</td>
     <td>&nbsp;4422</td>
     <td>&nbsp;&nbsp;215</td>
     <td>&nbsp;&nbsp;251</td>
     <td>&nbsp;3480</td>
     <td>&nbsp;4171</td>     
  </tr>
  <tr class="dataLineOdd"> 
     <td>11</td>
     <td>Ten Bacteria</td>
     <td>-</td>
     <td>-</td>
     <td>-</td>
     <td>20206</td>
     <td>23498</td>
     <td>&nbsp;3434</td>
     <td>&nbsp;3791</td>
     <td>16772</td>
     <td>19707</td>     
  </tr>  
</table>

<? mysql_close(); ?>

    </div>
	<!-- end contentData -->
  </div>
  <!-- end main -->
  <div id="footer">
    Topic revision: r4 - February 5, 2010 | <a href="/" target="_blank">TUBIC</a>
  </div>
</div>
<!-- end container -->
</body>
</html>
