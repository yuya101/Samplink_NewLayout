<?php
date_default_timezone_set('Asia/Bangkok');

class DateFunction
{	
	private $today;
	private $tmpDummy;
	
	
	public function __construct()
	{
		// Construction Method
	}
	
	
	public function getYearInt()  // Format YYYY on Bud
	{
		$today = getdate();
		if($today['year'] > 2500)
		{
			return $today['year'];
		}
		else
		{
			$tmpDummy = $today['year'] + 543;
			return $tmpDummy;
		}
	}
	
	
	public function getMonthYearChris() // Format MMYYYY on Chris
	{
		setlocale(LC_TIME, "th");
		$today = getdate();	
		if($today['year'] < 2500)
		{
			return (substr("0".strftime("%m"), -2, 2).strftime("%Y"));
		}
		else
		{
			return (substr("0".strftime("%m"), -2, 2).(strftime("%Y") - 543));
		}
	}
	
	
	public function getYearMonthChris() // Format YYYYMM This Year on Chris
	{
		setlocale (LC_TIME, "th");
		$today = getdate();	
		if($today['year'] < 2500)
		{
			return (strftime("%Y").substr("0".strftime("%m"), -2, 2));
		}
		else
		{
			return ((strftime("%Y") - 543).substr("0".strftime("%m"), -2, 2));
		}
	}
	
	
	public function getNextYearMonthChris() // Format YYYYMM Next Year on Chris
	{
		setlocale (LC_TIME, "th");
		$today = getdate();	
		
		if($today['month'] == "December")
		{
			if($today['year'] < 2500)
			{
				return ((strftime("%Y") + 1)."01");
			}
			else
			{
				return ((strftime("%Y") - 543 + 1)."01");
			}
		}
		else
		{
			if($today['year'] < 2500)
			{
				return (strftime("%Y").(substr("0".(strftime("%m") + 1), -2, 2)));
			}
			else
			{
				return ((strftime("%Y") - 543).(substr("0".(strftime("%m") + 1), -2, 2)));
			}
		}	
	}
	
	
	public function getDateChris() // Format YYYYMMDD on Chris
	{
		setlocale (LC_TIME, "th");
		$today = getdate();	
		if($today['year'] < 2500)
		{
			return (strftime("%Y").substr("0".strftime("%m"), -2, 2).substr("0".strftime("%d"), -2, 2));
		}
		else
		{
			return ((strftime("%Y") - 543).substr("0".strftime("%m"), -2, 2).substr("0".strftime("%d"), -2, 2));
		}
	}
	
	
	public function getTimeNow()  //  Format 01:08:35
	{
		setlocale (LC_TIME, "th");
		return strftime("%H:%M:%S");
	}
	
	
	public function getDateThaiFormat()  //  Format DDMMYYYY On Bud 
	{
		setlocale (LC_TIME, "th");
		$today = getdate();	
		if($today['year'] < 2500)
		{
			return (substr("0".strftime("%d"), -2, 2)."/".substr("0".strftime("%m"), -2, 2)."/".(strftime("%Y") + 543));
		}
		else
		{
			return (substr("0".strftime("%d"), -2, 2)."/".substr("0".strftime("%m"), -2, 2)."/".(strftime("%Y")));
		}
	}
	
	
	public function getDateChrisFormat()  //  Format DDMMYYYY On Chris 
	{
		setlocale (LC_TIME, "th");
		$today = getdate();	
		if($today['year'] < 2500)
		{
			return (substr("0".strftime("%d"), -2, 2)."/".substr("0".strftime("%m"), -2, 2)."/".(strftime("%Y")));
		}
		else
		{
			return (substr("0".strftime("%d"), -2, 2)."/".substr("0".strftime("%m"), -2, 2)."/".(strftime("%Y") - 543));
		}
	}
	
	
	public function getDateChrisFormatWithDetch()  //  Format YYYY-MM-DD On Chris 
	{
		setlocale (LC_TIME, "th");
		$today = getdate();	
		if($today['year'] < 2500)
		{
			return (strftime("%Y"))."-".substr("0".strftime("%m"), -2, 2)."-".(substr("0".strftime("%d"), -2, 2));
		}
		else
		{
			return (strftime("%Y") - 543)."-".substr("0".strftime("%m"), -2, 2)."-".(substr("0".strftime("%d"), -2, 2));
		}
	}
	
	
	public function dateThaiFormat($tempDate)  //  Format DDMMYYYY On Bud With Attribute
	{
		if(substr($tempDate,0, 4) < 2500)
		{
			return substr($tempDate, -2, 2)."/".substr($tempDate, -4, 2)."/".(substr($tempDate,0, 4) + 543);
		}
		else
		{
			return substr($tempDate, -2, 2)."/".substr($tempDate, -4, 2)."/".(substr($tempDate,0, 4));
		}
	}
	
	
	
	public function datePlusDay($tmpDate, $datePlusNo, $monthPlusNo, $yearPlusNo) // Format YYYYMMDD
	{
		$tmpDate = date("Ymd", mktime(date("H")+0, date("i")+0, date("s")+0, date("m")+$monthPlusNo , date("d")+$datePlusNo, date("Y")+$yearPlusNo));
		return $tmpDate;
	}
	
	
	public function changeDateFromDDMMYYYY($tmpDate) // Change From DDMMYYYY -> YYYYMMDD
	{
		$tmpDate = substr($tmpDate, -4, 4).substr($tmpDate, -6, 2).(substr($tmpDate,0, 2));
		return $tmpDate;
	}
	
	
	public function changeDateToDDMMYYYY($tmpDate) // Change From DD/MM/YYYY -> DDMMYYYY
	{
		$tmpDate = substr($tmpDate,0, 2).substr($tmpDate,3, 2).substr($tmpDate, -4, 4);
		return $tmpDate;
	}
	
	
	public function changeDateToDDMMYYYY2($tmpDate) // Change From YYYYMMDD -> DDMMYYYY
	{
		$tmpDate = substr($tmpDate,-2, 2).substr($tmpDate,4, 2).substr($tmpDate, 0, 4);
		return $tmpDate;
	}
	
	
	public function changeDateToDDMMYYYY3($tmpDate) // Change From YYYYMMDD -> DD/MM/YYYY
	{
		$tmpDate = substr($tmpDate,-2, 2)."/".substr($tmpDate,4, 2)."/".substr($tmpDate, 0, 4);
		return $tmpDate;
	}
	
	
	public function changeDateToDDMMYYYY2PlusOne($tmpDate) // Change From YYYYMMDD -> DDMMYYYY
	{
		$tmpDate = date("dmY", mktime(date("H")+0, date("i")+0, date("s")+0, date("m")+0 , date("d")+1, date("Y")+0));
		return $tmpDate;
	}
	
	
	public function changeTimeFromHHMMSS($tmpTime) // Change From HHMMSS -> HH:MM:SS
	{
		$tmpTime = substr($tmpTime, 0, 2).":".substr($tmpTime, -4, 2).":".(substr($tmpTime, -2, 2));
		return $tmpTime;
	}
	
	
	public function changeTimeToHHMMSS($tmpTime) // Change From HH:MM:SS -> HHMMSS 
	{
		$tmpTime = substr($tmpTime, 0, 2).substr($tmpTime, 3, 2).(substr($tmpTime, -2, 2));
		return $tmpTime;
	}
	
	
	public function chgDateChrisStyle($tmpDate) // Change From DD/MM/YYYY -> YYYYMMDD
	{
		if((int)substr($tmpDate, -4, 4) > 2500)
		{
			$tmpDate = (substr($tmpDate, -4, 4)  - 543).substr($tmpDate, 3, 2).substr($tmpDate, 0, 2);
		}
		else
		{
			$tmpDate = (substr($tmpDate, -4, 4) ).substr($tmpDate, 3, 2).substr($tmpDate, 0, 2);
		}
		
		return $tmpDate;
	}


	public function chgDateChrisStyleNewStyle($tmpDate) // Change From YYYY-MM-DD -> YYYYMMDD
	{
		if((int)substr($tmpDate, 0, 4) > 2500)
		{
			$tmpDate = (substr($tmpDate, 0, 4)  - 543).substr($tmpDate, 5, 2).substr($tmpDate, -2, 2);
		}
		else
		{
			$tmpDate = (substr($tmpDate, 0, 4) ).substr($tmpDate, 5, 2).substr($tmpDate, -2, 2);
		}
		
		return $tmpDate;
	}
	
	
	public function monthInThai($tempMonth) // Come in format YYYYMMDD
	{
		$tempMonth = intval(substr($tempMonth, -4, 2));
		
		switch ($tempMonth)
		{
			case 1 :
				return "มกราคม";
			case 2 :
				return "กุมภาพันธ์";
			case 3 :
				return "มีนาคม";
			case 4 :
				return "เมษายน";
			case 5 :
				return "พฤษภาคม";
			case 6 :
				return "มิถุนายน";
			case 7 :
				return "กรกฎาคม";
			case 8 :
				return "สิงหาคม";
			case 9 :
				return "กันยายน";
			case 10 :
				return "ตุลาคม";
			case 11 :
				return "พฤศจิกายน";
			case 12 :
				return "ธันวาคม";
		}
	}
	
	
	public function monthInThai2($tempMonth) // Come in format YYYYMM
	{
		$tempMonth = intval(substr($tempMonth, -2, 2));
		
		switch ($tempMonth)
		{
			case 1 :
				return "มกราคม";
			case 2 :
				return "กุมภาพันธ์";
			case 3 :
				return "มีนาคม";
			case 4 :
				return "เมษายน";
			case 5 :
				return "พฤษภาคม";
			case 6 :
				return "มิถุนายน";
			case 7 :
				return "กรกฎาคม";
			case 8 :
				return "สิงหาคม";
			case 9 :
				return "กันยายน";
			case 10 :
				return "ตุลาคม";
			case 11 :
				return "พฤศจิกายน";
			case 12 :
				return "ธันวาคม";
		}
	}
	
	
	public function monthInEnglish($tempMonth) // Come in format YYYYMMDD
	{
		$tempMonth = intval(substr($tempMonth, -4, 2));
		
		switch ($tempMonth)
		{
			case 1 :
				return "January";
			case 2 :
				return "February";
			case 3 :
				return "March";
			case 4 :
				return "April";
			case 5 :
				return "May";
			case 6 :
				return "June";
			case 7 :
				return "July";
			case 8 :
				return "August";
			case 9 :
				return "September";
			case 10 :
				return "October";
			case 11 :
				return "November";
			case 12 :
				return "December";
		}
	}
	
	
	public function showMonthYearInEnglish($tempMonth) // Come in format YYYYMM
	{
		$tempYear = substr($tempMonth, 0, 4);
		$tempMonth = intval(substr($tempMonth, -2, 2));
		
		switch ($tempMonth)
		{
			case 1 :
				return "January"." ".$tempYear;
			case 2 :
				return "February"." ".$tempYear;
			case 3 :
				return "March"." ".$tempYear;
			case 4 :
				return "April"." ".$tempYear;
			case 5 :
				return "May"." ".$tempYear;
			case 6 :
				return "June"." ".$tempYear;
			case 7 :
				return "July"." ".$tempYear;
			case 8 :
				return "August"." ".$tempYear;
			case 9 :
				return "September"." ".$tempYear;
			case 10 :
				return "October"." ".$tempYear;
			case 11 :
				return "November"." ".$tempYear;
			case 12 :
				return "December"." ".$tempYear;
		}
	}
	
	
	public function fullDateChris($tmpDate)     //  Come From format YYYYMMDD -->  DD Month YYYY
	{
		$tmpMonthText = $this->monthInEnglish($tmpDate);	
		
		if((int)substr($tmpDate, 0, 4) > 2500)
		{
			$tmpDateText = substr($tmpDate, -2, 2)."  ".$tmpMonthText."  ".(substr($tmpDate, 0, 4)  - 543);
		}
		else
		{
			$tmpDateText = substr($tmpDate, -2, 2)."  ".$tmpMonthText."  ".(substr($tmpDate, 0, 4));
		}
		
		return $tmpDateText;
	}
	
	
	public function fullMonthChris($tmpDate)     //  Come From format YYYYMM  -->  Month YYYY
	{
		$tmpMonthText = monthInEnglish($tmpDate."01");	
		
		if((int)substr($tmpDate, 0, 4) > 2500)
		{
			$tmpDateText = $tmpMonthText."  ".(substr($tmpDate, 0, 4)  - 543);
		}
		else
		{
			$tmpDateText = $tmpMonthText."  ".(substr($tmpDate, 0, 4));
		}
		
		return $tmpDateText;
	}
	
	
	
}  // ---- End Class

/*$dTest = new DateFunction();
$tmp = $dTest->getDateChris();
echo $tmp; */
?> 