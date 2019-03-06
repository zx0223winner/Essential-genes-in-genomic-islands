<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
<title>Core-Essential Gene Information</title>
<link rel="stylesheet" href="image/master.css" type="text/css">
</head>
<body>
<div class="skipLinks">Skip to: <a href="#main">Content</a></div>
<a id="top" name="top"></a>
<div id="container">  
  <div id="header">
    <h1 id="siteName">Core-Essential Genes</h1> 
    <div id="mainNav"> 
      <a href="index.html">Home</a> | <a href="table.php">Table</a> | <a href="figure.htm">Figure</a> | <a href="/deg/" target="_blank">DEG</a> | <a href="/" target="_blank">TUBIC</a>
    </div>	
  </div>
  <!-- end header -->
  <div id="main">

  <?php
    $acc=$_GET['acc'];
    #connect to the database
    $link=mysql_pconnect("localhost","ohy","OHY7638")or
                die("Unable to connect to MySQL");
    mysql_select_db("egdb",$link)
         or die("Unable to select default database");
    $sql= "select t1.acc, t1.code, t1.ac, t1.oi, t1.loc, t1.gc, t1.fra, t1.str, t1.gi, t1.cog, t1.deb, t1.os, t1.oa, t2.gn, t3.sq, t4.aa, t5.oa, t5.ncgi, t5.tax, t5.osftp, t5.lineage, t5.gsmn, t5.disease, t6.up, t6.ec, t6.ko, t6.path, t6.koi from coreannotation as t1, degannotation5p as t2, degseq5p as t3, degaa5p as t4, coreorganism as t5, core_kegg as t6 where trim(t1.ac)=trim(t2.ac) and trim(t2.ac)=trim(t3.ac) and trim(t3.ac)=trim(t4.ac) and trim(t1.acc)=trim(t6.acc) and trim(t1.acc)=\"".trim($acc)."\" and trim(t1.oa)=trim(t5.oa)";             

    $result=mysql_query($sql,$link);
    $rows=mysql_num_rows($result);
    if($rows < 1){
      echo "<div align='center'>
       <img src='image/construct.gif' width='40' height='40'></div>\n";
    }else{
      $arr=mysql_fetch_array($result);
    }
  ?>

    <div id="breadcrumb">
      » <a href="index.html">Home</a> » <a href="table.php">Data table</a> » 
	  <?
		$myoa = trim($arr[oa]);
		$mycode = trim($arr[code]);
		echo "<a href=\"show.php?oa=$myoa&code=$mycode&page=1\">";
		echo "Gene list";
		echo "</a>\n";
	  ?>
	  » Gene information
    </div>
	<div id="contentData">

<table id="geneInfo" cellspacing="2" cellpadding="2">
  <tr> 
    <td class="tableHeader">&nbsp;&nbsp;Information of the core-essential gene</td>
  </tr>
  
  <tr>
    <td>
      <table width="100%" border="0" cellspacing="2" cellpadding="4">
	    <colgroup class="col1"></colgroup>
		<colgroup class="col2"></colgroup>
		<colgroup class="col3"></colgroup>
		<tr class="genomeFont">
          <td width="10%" rowspan="8">Genome resource</td>
          <td width="15%">Organism</td>
          <td width="75%">
            <? echo trim($arr[os]); ?>            
          </td>
        </tr>	
		<tr class="genomeFont"> 
          <td>RefSeq</td>
          <td>
		    <? 
			   $osftp = trim($arr[osftp]);
			   $oa = trim($arr[oa]);
			   $ncgi = trim($arr[ncgi]);
			   echo "<a href=\"http://www.ncbi.nlm.nih.gov/genomes/framik.cgi?db=Genome&gi=$ncgi\" target='_blank'>";
			   echo $oa;
			   echo "</a>\n";
			   echo "; ";
		       echo "<a href=\"ftp://ftp.ncbi.nih.gov/genomes/Bacteria/$osftp/\" target='_blank'>";
			   echo "Sequence FTP";
			   echo "</a>\n";
			?>			
		  </td>
        </tr>
		<tr class="genomeFont"> 
          <td>COG assignment</td>
          <td>
		    <? 
		       echo "<a href=\"http://www.ncbi.nlm.nih.gov/sutils/coxik.cgi?gi=$ncgi\" target='_blank'>";
			   echo "Distribution of all proteins";
			   echo "</a>\n";
			?>			
		  </td>
        </tr>
		<tr class="genomeFont"> 
          <td>Replication origin</td>
          <td>
		    <? 
		       echo "<a href=\"http://tubic.tju.edu.cn/doric/query.php?selfield=oa&term=$oa&page=1\" target='_blank'>";
			   echo "DoriC";
			   echo "</a>\n";
			?>			
		  </td>
        </tr>
		<tr class="genomeFont"> 
          <td>Taxonomy</td>
          <td>TAX: 
		    <? 
			   $tax = trim($arr[tax]);
		       echo "<a href=\"http://www.ncbi.nih.gov/Taxonomy/Browser/wwwtax.cgi?id=$tax\" target='_blank'>";
			   echo $tax;
			   echo "</a>\n";
			?>			
		  </td>
        </tr>
		<tr class="genomeFont"> 
          <td>Lineage</td>
          <td>
		    <? echo trim($arr[lineage]); ?>			
		  </td>
        </tr>
		<tr class="genomeFont"> 
          <td>Disease</td>
          <td>
		    <? echo trim($arr[disease]); ?>			
		  </td>
        </tr>
		<tr class="genomeFont"> 
          <td>Metabolic network</td>
          <td>
		    <? 
			   $gsmnos="";
			   switch($oa){
					case 'NC_005966':
						$gsmnos="-Acinetobacter baylyi";break;
					case 'NC_000964':
						$gsmnos="-Bacillus subtilis";break;
					case 'NC_000913':
					    $gsmnos="-Escherichia coli";break;
					case 'NC_000907':
					    $gsmnos="-Haemophilus influenzae";break;
					case 'NC_000915':
					    $gsmnos="-Helicobacter pylori";break;
					case 'NC_000908':
						$gsmnos="-Mycoplasma genitalium";break;
					case 'NC_002771':
						$gsmnos="-";break;
					case 'NC_000962':
					    $gsmnos="-Mycobacterium tuberculosis";break;
					case 'NC_002745':
					    $gsmnos="-Staphylococcus aureus";break;
					case 'NC_003197':
					    $gsmnos="-Salmonella typhimurium";break;
			   }
			   $gsmn = trim($arr[gsmn]);
			   if($gsmn!='-'){
				 $gsmn = strtok($gsmn, ",");
				 while($gsmn){				
					echo "<a href=\"http://synbio.tju.edu.cn/GSMNDB/Models/$gsmn$gsmnos.htm\" target='_blank'>";
					echo $gsmn;
					echo "</a>\n";
					$gsmn = strtok(",");
				 }
			   }
			   else{
				 echo "$gsmn ";
			   }			 		   
			?>			
		  </td>
        </tr> 
		<tr id="nullLine"><td colspan="3" height="1"></td></tr>
		<tr> 
		  <td width="10%" rowspan="19">Gene information</td>
          <td width="15%">Accession number</td>
          <td width="75%">     
            <? echo trim($arr[ac]); ?>
          </td>
        </tr>
		<tr> 
          <td>Gene name</td>
          <td> 
            <? echo trim($arr[gn]); ?>            
          </td>
        </tr>
		<tr> 
          <td>ORF ID</td>
          <td> 
            <? echo trim($arr[oi]); ?>            
          </td>
        </tr>
		<tr> 
          <td>Location</td>
          <td> 
            <? echo trim($arr[loc]); ?>            
          </td>
        </tr>
		<tr> 
          <td>Gi</td>
          <td>
		    <? 
			   $gi = trim($arr[gi]);
		       echo "<a href=\"http://www.ncbi.nlm.nih.gov/genomes/altvik.cgi?gi=$ncgi&db=Genome&gene=$gi\" target='_blank'>";
			   echo $gi;
			   echo "</a>\n";
			?>			
		  </td>
        </tr>
		<tr> 
          <td>COG</td>
          <td> 
            <? 
			  $accessNumber=trim($arr[cog]);
			  if($accessNumber!='-'){
				$accessNumber = strtok($accessNumber, ",");
				while($accessNumber){				
					echo "<a href=\"http://www.ncbi.nlm.nih.gov/COG/grace/wiew.cgi?$accessNumber\" target='_blank'>";
					echo $accessNumber;
					echo "</a>\n";
					$accessNumber = strtok(",");
				}
			  }
			  else{
				echo "$accessNumber ";
			  }
			?>            
		  </td>
        </tr>		
		<tr> 
          <td>GC content</td>
          <td> 
            <? echo trim($arr[gc]); ?>
          </td>
        </tr>
		<tr> 
          <td>Frame</td>
          <td> 
            <? echo trim($arr[fra]); ?>
          </td>
        </tr>
		<tr> 
          <td>Strand</td>
          <td> 
            <? echo trim($arr[str]); ?> strand
          </td>
        </tr>
		<tr> 
          <td>UniProt</td>
          <td> 
            <? echo trim($arr[up]); ?>
          </td>
        </tr>
		<tr> 
          <td>KO</td>
          <td> 
            <? 
			  $ko=trim($arr[ko]);
			  if($ko!='-'){
				$ko = strtok($ko, ",");
				while($ko){				
					echo "<a href=\"http://www.genome.jp/dbget-bin/www_bget?$ko\" target='_blank'>";
					echo $ko;
					echo "</a>\n";
					$ko = strtok(",");
				}
			  }
			  else{
				echo "$ko ";
			  }
			?>            
		  </td>
        </tr>
		<tr> 
          <td>EC</td>
          <td> 
            <? 
			  $ec=trim($arr[ec]);
			  if($ec!='-'){
				$ec = strtok($ec, ",");
				while($ec){				
					echo "<a href=\"http://www.genome.jp/dbget-bin/www_bget?$ec\" target='_blank'>";
					echo $ec;
					echo "</a>\n";
					$ec = strtok(",");
				}
			  }
			  else{
				echo "$ec ";
			  }
			?>            
		  </td>
        </tr>		
		<tr> 
          <td>PATH</td>
          <td> 
            <? 
			  $koi=trim($arr[koi]);
			  $path=trim($arr[path]);
			  if($path!='-'){
				$path = strtok($path, ",");
				while($path){				
					echo "<a href=\"http://www.genome.jp/kegg-bin/show_pathway?$path+$koi\" target='_blank'>";
					echo $path;
					echo "</a>\n";
					$path = strtok(",");
				}
			  }
			  else{
				echo "$path ";
			  }
			?>            
		  </td>
        </tr>		
		<tr> 
          <td>Functional class</td>
          <td> 
            <? 
			    $code=trim($arr[code]);
				$category="";
				switch($code){
					case 'J':
						$category="(J) Translation, ribosomal structure and biogenesis";break;
					case 'K':
						$category="(K) Transcription";break;
					case 'L':
					    $category="(L) Replication, recombination and repair";break;
					case 'D':
					    $category="(D) Cell cycle control, cell division, chromosome partitioning";break;
					case 'M':
					    $category="(M) Cell wall/membrane/envelope biogenesis";break;
					case 'O':
						$category="(O) Posttranslational modification, protein turnover, chaperones";break;
					case 'C':
						$category="(C) Energy production and conversion";break;
					case 'G':
					    $category="(G) Carbohydrate transport and metabolism";break;
					case 'E':
					    $category="(E) Amino acid transport and metabolism";break;
					case 'F':
					    $category="(F) Nucleotide transport and metabolism";break;
				}	
				echo $category;
			?>            
          </td>
        </tr>
		<tr> 
          <td>Description</td>
          <td> 
            <? echo trim($arr[deb]); ?>            
          </td>
        </tr>				
        <tr>
          <td>Nucleotide sequence</td>
          <td>     
            <? # the sequence
			   $seq=$arr[sq];
			   
			   $seqfasta=explode("\n", $seq);
			   $lines=count($seqfasta);

               $seqlen=0;
			   for($i=0;$i<=$lines;$i++){
			      $seqlen += strlen($seqfasta[$i]); 				
			   }
			   # $n= $seqlen - ($a +$c +$g +$t);
			   echo "Length: ".$seqlen." bp";
			?>            
		  </td>
        </tr>
        <tr> 
          <td></td>
          <td> 
            <?
			  echo "<PRE>\n";
		    # echo strtoupper(nl2br($seq));
			  echo strtoupper($seq);
			  echo "</PRE>\n";			 
		    ?>
            </td>
        </tr>
		<tr>
          <td>Amino acid sequence</td>
          <td>     
            <? # the sequence
			   $saa=$arr[aa];
			   
			   $saafasta=explode("\n", $saa);
			   $lines=count($saafasta);

               $saalen=0;
			   for($i=0;$i<=$lines;$i++){
			      $saalen += strlen($saafasta[$i]); 				
			   }
			   # $n= $saalen - ($a +$c +$g +$t);
			   echo "Length: ".$saalen." aa";
			?>            
		  </td>
        </tr>
        <tr> 
          <td></td>
          <td> 
            <?
			  echo "<PRE>\n";
		    # echo strtoupper(nl2br($saa));
			  echo strtoupper($saa);
			  echo "</PRE>\n";
			?>
          </td>
        </tr>
      </table>
    </td>
  </tr>
</table>
<table id="geneInfo2">
  <tr><td height="20">[<a href="#top">TOP</a>]</td></tr>
</table>

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
