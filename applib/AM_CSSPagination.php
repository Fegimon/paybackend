<?php
class AM_CSSPagination
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
	
	public function getTotalRows()
	{
		$result = @mysql_query($this->sql) or die ("query failed!");	
		$this->totalrows = mysql_num_rows($result);
	}
	
	public function getLastPage()
	{
		return ceil($this->totalrows / $this->rowsperpage);
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
				$pagination .= "<a href=$this->website&paging=$prev>&laquo; Prev</a>";
			else
				$pagination .= "<span class=\"disabled\">&laquo; Prev</span>";
			
			
			if ($this->getLastPage() < 9)
			{	
				for ($counter = 1; $counter <= $this->getLastPage(); $counter++)
				{
					if ($counter == $page)
						$pagination .= "<span class=\"current\">".$counter."</span>";
					else
						$pagination .= "<a href=$this->website&paging=$counter>".$counter."</a>";					
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
							$pagination .= "<a href=$this->website&paging=$counter>".$counter."</a>";					
					}
					$pagination .= "...";
					$pagination .= "<a href=$this->website&paging=$lpm1>".$lpm1."</a>";
					$pagination .= "<a href=$this->website&paging=$last>".$last."</a>";		
				}
				elseif($last - 3 > $page && $page > 1)
				{
					$pagination .= "<a href=$this->website&paging=1>1</a>";
					$pagination .= "<a href=$this->website&paging=2>2</a>";
					$pagination .= "...";
					for ($counter = $page - 1; $counter <= $page + 1; $counter++)
					{
						if ($counter == $page)
							$pagination .= "<span class=\"current\">".$counter."</span>";
						else
							$pagination .= "<a href=$this->website&paging=$counter>".$counter."</a>";					
					}
					$pagination .= "...";
					$pagination .= "<a href=$this->website&paging=$lpm1>$lpm1</a>";
					$pagination .= "<a href=$this->website&paging=$last>".$last."</a>";		
				}
				else
				{
					$pagination .= "<a href=$this->website&paging=1>1</a>";
					$pagination .= "<a href=$this->website&paging=2>2</a>";
					$pagination .= "...";
					for ($counter = $last - 4; $counter <= $last; $counter++)
					{
						if ($counter == $page)
							$pagination .= "<span class=\"current\">".$counter."</span>";
						else
							$pagination .= "<a href=$this->website&paging=$counter>".$counter."</a>";					
					}
				}
			}
		
		if ($page < $counter - 1) 
			$pagination .= "<a href=$this->website&paging=$next>Next &raquo;</a>";
		else
			$pagination .= "<span class=\"disabled\">Next &raquo;</span>";
		$pagination .= "</div>\n";			
		}	
					
		return $pagination;
	}
}
?>