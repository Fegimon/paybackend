<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class AM_Paging
{
	private $totalrows;
	private $rowsperpage;
	private $website;
	private $page;
	private $sql;
		
	public function __construct($sql, $rowsperpage, $website)
	{
		$this->sql = $sql;
		$this->website = $website;
		$this->rowsperpage = $rowsperpage;
	}
	
	public function setPage($page)
	{
		if (!$page) { $this->page=1; } else  { $this->page = $page; }
	}
	
	public function getLimit()
	{
		return ($this->page - 1) * $this->rowsperpage;
	}
	
	private function getTotalRows()
	{
		
		$result = @mysql_query($this->sql) or die ("query failed!");	
		$this->totalrows = mysql_num_rows($result);
	}
	
	public function getLastPage()
	{
		return ceil($this->totalrows / $this->rowsperpage);
	}
	
	public function urls($s)
	{
		$r=@explode("/",$this->website);
		$r1['slug']=$r[0];
		$r1['filter']=$r[1];
		$r1['pricefrm']=$r[2];
		$r1['priceto']=$r[3];
		$r1['paging']=$s;
		$r1['sortby']=$r[5];
		$r1['optional']=$r[6];
		return http_build_query($r1);
	}	
	
	public function showPage()
	{
		$this->getTotalRows();
		$margin="";
		$padding="";			
		$pagination = "";
		$last = $this->getLastPage();
		$lpm1 = $this->getLastPage() - 1;
		$page = $this->page;
		$prev = $this->page - 1;
		$next = $this->page + 1;
		
		$pagination .= "<div class=\"navigation\"";
		$pagination .= " style=\"display:none;";
		if($margin || $padding)
		{
			if($margin)
				$pagination .= "margin: $margin;";
			if($padding)
				$pagination .= "padding: $padding;";
		}
		$pagination .= "\"";
		$pagination .= ">";
		for ($counter = 1; $counter <= $this->getLastPage(); $counter++)
		{
			if($counter == $page){
//				$pagination .= "<span class=\"current\">".$counter."</span>";
				}
			elseif($counter == ($page+1)){
				$pagination .= "<a id=\"next\" href=http://localumaiyal.com/product-json.php?".$this->urls($counter).">".$counter."</a>";
			}elseif($counter<=$page){
//				$pagination .= "<a href=".$this->urls($counter).">".$counter."</a>";	
			}else{
//				$pagination .= "<a href=".$this->urls($counter).">".$counter."</a>";	
			}
		}
		$pagination .= "</div>\n";			
		return $pagination;
	}
}
?>