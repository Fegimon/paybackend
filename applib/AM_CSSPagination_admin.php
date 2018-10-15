<?php
class AM_CSSPagination_admin extends AM_Exceptions
{
	public $totalrows;
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
	public function retrunTotalRows()
	{
		return $this->totalrows;
	}
	private function getLastPage()
	{
		return ceil($this->totalrows / $this->rowsperpage);
	}
	
	public function showPage()
	{
		$this->getTotalRows();
			
		$pagination = "";
		$last = $this->getLastPage();
		$lpm1 = $this->getLastPage() - 1;
		$page = $this->page;
		$prev = $this->page - 1;
		$next = $this->page + 1;
		
		
		$pagination .= "<div class=\"pagination\"";
		if($margin || $padding)
		{
			$pagination .= " style=\"";
			if($margin)
				$pagination .= "margin: $margin;";
			if($padding)
				$pagination .= "padding: $padding;";
			$pagination .= "\"";
		}
		$pagination .= ">";
		
		if ($this->getLastPage() > 1)
		{
			if ($page > 1) 
				$pagination .= "<a href=$this->website&page=$prev>&laquo; prev</a>";
			else
				$pagination .= "<span class=\"disabled\">&laquo; prev</span>";
			
			
			if ($this->getLastPage() < 9)
			{	
				for ($counter = 1; $counter <= $this->getLastPage(); $counter++)
				{
					if ($counter == $page)
						$pagination .= "<span class=\"current\">".$counter."</span>";
					else
						$pagination .= "<a href=$this->website&page=$counter>".$counter."</a>";					
				}
			}
			elseif($this->getLastPage() >= 9)
			{
				if($page < 4)		
				{
					for ($counter = 1; $counter < 6; $counter++)
					{
						if ($counter == $page)
							$pagination .= "<span class=\"current\">".$counter."</span>";
						else
							$pagination .= "<a href=$this->website&page=$counter>".$counter."</a>";					
					}
					$pagination .= "...";
					$pagination .= "<a href=$this->website&page=$lpm1>".$lpm1."</a>";
					$pagination .= "<a href=$this->website&page=$last>".$last."</a>";		
				}
				elseif($last - 3 > $page && $page > 1)
				{
					$pagination .= "<a href=$this->website&page=1>1</a>";
					$pagination .= "<a href=$this->website&page=2>2</a>";
					$pagination .= "...";
					for ($counter = $page - 1; $counter <= $page + 1; $counter++)
					{
						if ($counter == $page)
							$pagination .= "<span class=\"current\">".$counter."</span>";
						else
							$pagination .= "<a href=$this->website&page=$counter>".$counter."</a>";					
					}
					$pagination .= "...";
					$pagination .= "<a href=$this->website&page=$lpm1>$lpm1</a>";
					$pagination .= "<a href=$this->website&page=$last>".$last."</a>";		
				}
				else
				{
					$pagination .= "<a href=$this->website&page=1>1</a>";
					$pagination .= "<a href=$this->website&page=2>2</a>";
					$pagination .= "...";
					for ($counter = $last - 4; $counter <= $last; $counter++)
					{
						if ($counter == $page)
							$pagination .= "<span class=\"current\">".$counter."</span>";
						else
							$pagination .= "<a href=$this->website&page=$counter>".$counter."</a>";					
					}
				}
			}
		
		if ($page < $counter - 1) 
			$pagination .= "<a href=$this->website&page=$next>next &raquo;</a>";
		else
			$pagination .= "<span class=\"disabled\">next &raquo;</span>";
		$pagination .= "</div>\n";			
		}	
					
		return $pagination;
	}
}
class CSSPagination1
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
	
	private function getLastPage()
	{
		return ceil($this->totalrows / $this->rowsperpage);
	}
	
	public function showPage()
	{
		$this->getTotalRows();
			
		$pagination = "";
		$last = $this->getLastPage();
		$lpm1 = $this->getLastPage() - 1;
		$page = $this->page;
		$prev = $this->page - 1;
		$next = $this->page + 1;
		
		$pagination .= "<div class=\"navigation\"";
		if($margin || $padding)
		{
			$pagination .= " style=\"";
			if($margin)
				$pagination .= "margin: $margin;";
			if($padding)
				$pagination .= "padding: $padding;";
			$pagination .= "\"";
		}
		$pagination .= "><ul>";
		
		if ($this->getLastPage() > 1)
		{
				for ($counter = 1; $counter <= $this->getLastPage(); $counter++)
				{
					if ($counter <= $page)
						$pagination .= "<li>".$counter."</li>\n";
					else
						$pagination .= "<li class=\"next-posts\"><a href=$this->website&page1=$counter>".$counter."</a></li>\n";					
				}
//		if ($page < $counter - 1) 
//			$pagination .= "<li class=\"next-posts\"><a href=$this->website&page1=$next>next &raquo;</a>";
//		else
//			$pagination .= "<span class=\"disabled\">next &raquo;</span>";
//		$pagination .= "</ul></div>\n";			
		}	
		$pagination .= "</ul></div>\n";					
		return $pagination;
	}
}
?>