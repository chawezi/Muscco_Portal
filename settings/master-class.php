<?php
class MasterClass{
	private $host="localhost";
	private $user="root";
	private $pass="";
	private $dbName="muscco";
	private $db;
	public $suffix;

	//_construct
	public function __construct(){
		if(!isset($this->db)){
			try {
			  $con = new PDO("mysql:host=".$this->host.";dbname=".$this->dbName, $this->user, $this->pass);
			  $con ->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
			  $this->db=$con;
			}
			catch(PDOException $e) {
			    echo $e->getMessage();
			}
			$this->suffix = date('Ymd_His');
		}
	}

	//cleans form data to avoid sql injections
	function clean($str) {
	    $str = trim($str);
	    if (!empty($str)) {
	        $str = stripslashes($str);
	    }
	    $str = htmlspecialchars($str, ENT_QUOTES | ENT_HTML5, 'UTF-8');
	    return $str;
	}

	//sellect data from tables
	public function getRows($table, $conditions){
		$sql ='select';
		$sql.=array_key_exists("select", $conditions)?$conditions['select']:'*';
		$sql.=' from '.$table;

		//if where condition is used
		if(array_key_exists("where", $conditions) && is_array($conditions['where'])){
			$sql.=' where ';
			$i   =0;
			foreach ($conditions["where"] as $key => $value) {
				$pre =($i > 0)?' and ':'';
				$sql.=$pre.$key." ='".$value."'";
				$i++;
			}
		}
		elseif(array_key_exists("where", $conditions) && !is_array($conditions['where'])){
			$sql.=' where '.$conditions['where'];
		}


		//if sorting is specified
		if(array_key_exists("order_by", $conditions)){
			$sql.=' order by '.$conditions['order_by'];
		}

		//we may include the limit, max or start for pagination
		if(array_key_exists("start",$conditions) && array_key_exists("limit",$conditions)){
            $sql .= ' limit '.$conditions['start'].','.$conditions['limit'];
        }elseif(!array_key_exists("start",$conditions) && array_key_exists("limit",$conditions)){
            $sql .= ' limit '.$conditions['limit'];
        }

		//prepare and execute query
		$query=$this->db->prepare($sql);
		$query->execute();

		//return options
		if(array_key_exists("return_type", $conditions) && $conditions['return_type'] !='all'){
			switch ($conditions['return_type']) {
				case 'count':
					$data =$query->rowCount();
					break;

				case 'single':
					$data =$query->fetch(PDO::FETCH_ASSOC);
					break;

				default:
					$data ='';
					break;
			}
		}
		else{
			if($query->rowCount() > 0){
				$data =$query->fetchAll();
			}
		}

		return !empty($data)?$data:false;

	}

	//insert data into a single table
	public function insert($table, $data){
		if(!empty($table) && is_array($data)){
			$columns	=implode(',', array_keys($data));
			$values		=":".implode(',:', array_keys($data));
			$sql		="insert into ".$table."(".$columns.") values(".$values.")";
			$query		=$this->db->prepare($sql);
			foreach($data as $key=>$val){
				$query->bindValue(':'.$key,$val);
			}
			$insert		=$query->execute();
			return $insert?$this->db->lastInsertId():false;
		}
		else{
			return false;
		}
    }

    //update data
    public function update($table, $data, $conditions){
    	if(!empty($data) && is_array($data)){
    		$colSet='';
    		$where ='';
    		$i =0;

    		foreach ($data as $key => $value) {
    			$pre=($i > 0)?', ':'';
    			$colSet.=$pre.$key." ='".$value."'";
    			$i++;
    		}

    		if(!empty($conditions) && is_array($conditions)){
    			$where.=' where ';
    			$i =0;
    			foreach ($conditions as $key => $value) {
    				$pre=($i > 0)?' and ':'';
    				$where.=$pre.$key." ='".$value."'";
    				$i++;
    			}
    		}

    		$sql="update ".$table." set ".$colSet.$where;
    		$query=$this->db->prepare($sql);
    		$update=$query->execute();
    		return $update?$query->rowCount():false;
    	}
    	else{
    		return false;
    	}
    }

    //delete data
    public function delete($table, $conditions){
    	$whereSql = '';
        if(!empty($conditions)&& is_array($conditions)){
            $whereSql .= ' where ';
            $i = 0;
            foreach($conditions as $key => $value){
                $pre = ($i > 0)?' and ':'';
                $whereSql .= $pre.$key." = '".$value."'";
                $i++;
            }
        }
        $sql = "delete from ".$table.$whereSql;
        $delete = $this->db->exec($sql);
        return $delete?$delete:false;
    }

    public function shortDate($date){
		$date = date_create($date); return date_format($date,"d/m/y");
	}

	public function DTT($date){
		$date = date_create($date); return date_format($date,"d/m/y (H:i:s)");
	}

	public function monthYear($date){
		$date = date_create($date); return date_format($date,"m/y");
	}

	public function Year($date){
		$date = date_create($date); return date_format($date,"Y");
	}

    //changes date/time format
	public function dateFormat($datetime, $full = false) {
	    $now = new DateTime;
	    $ago = new DateTime($datetime);
	    $diff = $now->diff($ago);

	    $diff->w = floor($diff->d / 7);
	    $diff->d -= $diff->w * 7;

	    $string = array(
	        'y' => 'year',
	        'm' => 'month',
	        'w' => 'week',
	        'd' => 'day',
	        'h' => 'hour',
	        'i' => 'minute',
	        's' => 'second',
	    );
	    foreach ($string as $k => &$v) {
	        if ($diff->$k) {
	            $v = $diff->$k . ' ' . $v . ($diff->$k > 1 ? 's' : '');
	        } else {
	            unset($string[$k]);
	        }
	    }

	    if (!$full) $string = array_slice($string, 0, 1);
	    return $string ? implode(', ', $string) . ' ago ' : 'just now';
	}

	public function countWeekends($startDate, $endDate) {
    // Convert the input dates to DateTime objects
    $start = new DateTime($startDate);
    $end = new DateTime($endDate);

    // Initialize a counter for weekends
    $weekendCount = 0;

    // Iterate through the dates from start to end
    $current = $start;
    while ($current <= $end) {
        // Check if the current day is a Saturday (6) or Sunday (0)
        if ($current->format('N') == 6 || $current->format('N') == 7) {
            $weekendCount++;
        }
        // Move to the next day
        $current->modify('+1 day');
    }

    return $weekendCount;
	}

	public function fDate($date){
		$dbdate=  substr($date,0,10);
			
		$now = time(); // or your date as well
		$your_date = strtotime($date);
		$datediff = $now - $your_date;
			
			
		$Agelable="";
			
			if (round($datediff / (60 * 60 * 24)) ==1){
				
				$Agelable= "Today";
				return($Agelable);
			}
			
			elseif(round($datediff / (60 * 60 * 24))==0){
				$Agelable= "Yesterday";
				return($Agelable);
				
				
			}
			
			elseif(round($datediff / (60 * 60 * 24))<5){
				$Agelable=date("l",strtotime($dbdate));
				return($Agelable);
				
				
			}
			elseif(round($datediff / (60 * 60 * 24))>=5){
				$Agelable= date("d-M-Y", strtotime($dbdate));
				return($Agelable);
				
				
			}
	}

	function TimeAgo ($oldTime) {
		$newTime = date("Y-m-d H:i:s");
		$timeCalc = time() - strtotime($oldTime);
		//$now = new DateTime;
	    //$ago = new DateTime($oldTime);
		//return $now." - ".$ago;
		if ($timeCalc >= (60*60*24*30*12*2)){
			$timeCalc = intval($timeCalc/60/60/24/30/12) . " years ago";
		}else if ($timeCalc >= (60*60*24*30*12)){
			$timeCalc = intval($timeCalc/60/60/24/30/12) . " year ago";
		}else if ($timeCalc >= (60*60*24*30*2)){
			$timeCalc = intval($timeCalc/60/60/24/30) . " months ago";
		}else if ($timeCalc >= (60*60*24*30)){
			$timeCalc = intval($timeCalc/60/60/24/30) . " month ago";
		}else if ($timeCalc >= (60*60*24*2)){
			$timeCalc = intval($timeCalc/60/60/24) . " days ago";
		}else if ($timeCalc >= (60*60*24)){
			$timeCalc = " Yesterday";
		}else if ($timeCalc >= (60*60*2)){
			$timeCalc = intval($timeCalc/60/60) . " hours ago";
		}else if ($timeCalc >= (60*60)){
			$timeCalc = intval($timeCalc/60/60) . " hour ago";
		}else if ($timeCalc >= 60*2){
			$timeCalc = intval($timeCalc/60) . " minutes ago";
		}else if ($timeCalc >= 60){
			$timeCalc = intval($timeCalc/60) . " minute ago";
		}else if ($timeCalc > 0){
			$timeCalc .= " seconds ago";
		}
		return $timeCalc;
		
	}

	//generates random numbers
	function get_random_string_max($length) {

		$array = array(0,1,2,3,4,5,6,7,8,9,'a','b','c','d','e','f','g','h','i','j','k','l','m','n','o','p','q','r','s','t','u','v','w','x','y','z','A','B','C','D','E','F','G','H','I','J','K','L','M','N','O','P','Q','R','S','T','U','V','W','X','Y','Z');
		$text = "";

		$length = rand(4,$length);

		for($i=0;$i<$length;$i++) {

			$random = rand(0,61);
			
			$text .= $array[$random];

		}

		return $text;
	}

	//changes date/time format
	public function formatDate($date){
		$dbdate=  substr($date,0,10);

		$now = time(); // or your date as well
		$your_date = strtotime($dbdate);
		$datediff = $now - $your_date;


		$Agelable="";

			if (round($datediff / (60 * 60 * 24)) ==1){

				$Agelable= "Today";
				return($Agelable);
			}

			elseif(round($datediff / (60 * 60 * 24))==0){
				$Agelable= "Yesterday";
				return($Agelable);


			}

			elseif(round($datediff / (60 * 60 * 24))<5){
				$Agelable=date("l",strtotime($dbdate));
				return($Agelable);


			}
			elseif(round($datediff / (60 * 60 * 24))>=5){
				$Agelable= date("d-M-Y", strtotime($dbdate));
				return($Agelable);


			}
	}

	//user login redirects
	public function userRedirect($user_role){
		switch ($user_role){
			case 0:
				// super user
				echo "1";
				break;

			case 1:
				// sacco user
				echo "2";
				break;

			case 2:
				// muscco user
				echo "3";
				break;

			case 3:
				// sacco user
				echo "4";
				break;
			
			case 4:
				// des user
				echo "5";
				break;
		}
	}

	public function sendNotification($to,$from,$subject,$message){
		$details=array(
				'posted_by'	  =>$this->clean($from),
				'received_by' =>$this->clean($to),
				'subject' 	  =>$this->clean($subject),
				'message'     =>$this->clean($message)
				);
		return $this->insert('notifications',$details)?$this->db->lastInsertId():false;
	}

	public function getMonths($date1, $date2){
	    $begin = new DateTime( $date1 );
	    $end = new DateTime( $date2 );
	    $end = $end->modify( '+1 month' );

	    $interval = DateInterval::createFromDateString('1 month');

	    $period = new DatePeriod($begin, $interval, $end);
	    $counter = iterator_count($period);
	    /*foreach($period as $dt) {
	        $counter++;
	    }*/

	    return $counter;
	}

	//get days from the given dates
	public function dateTimesToDays($start,$end){
       // calulating the difference in timestamps 
	    $diff = strtotime($start) - strtotime($end);
	      
	    // 1 day = 24 hours 
	    // 24 * 60 * 60 = 86400 seconds
	    return ceil(abs($diff / 86400))+1;
    }

    public function backup($tables = '*'){
	   $output = "-- database backup - ".date('Y-m-d H:i:s').PHP_EOL;
	   $output .= "SET NAMES utf8;".PHP_EOL;
	   $output .= "SET sql_mode = 'NO_AUTO_VALUE_ON_ZERO';".PHP_EOL;
	   $output .= "SET foreign_key_checks = 0;".PHP_EOL;
	   $output .= "SET AUTOCOMMIT = 0;".PHP_EOL;
	   $output .= "START TRANSACTION;".PHP_EOL;
	   //get all table names
	   if($tables == '*') {
	     $tables = [];
	     $query = $this->db->prepare('SHOW TABLES');
	     $query->execute();
	     while($row = $query->fetch(PDO::FETCH_NUM)) {
	       $tables[] = $row[0];
	     }
	     $query->closeCursor();
	   }
	   else {
	     $tables = is_array($tables) ? $tables : explode(',',$tables);
	   }

	   foreach($tables as $table) {

	     $query = $this->db->prepare("SELECT * FROM `$table`");
	     $query->execute();
	     $output .= "DROP TABLE IF EXISTS `$table`;".PHP_EOL;

	     $query2 = $this->db->prepare("SHOW CREATE TABLE `$table`");
	     $query2->execute();
	     $row2 = $query2->fetch(PDO::FETCH_NUM);
	     $query2->closeCursor();
	     $output .= PHP_EOL.$row2[1].";".PHP_EOL;

	       while($row = $query->fetch(PDO::FETCH_NUM)) {
	         $output .= "INSERT INTO `$table` VALUES(";
	         for($j=0; $j<count($row); $j++) {
	           //$row[$j] = addslashes($row[$j]);
	           //$row[$j] = str_replace("\n","\\n",$row[$j]);
	           if (isset($row[$j]))
	             $output .= "'".$row[$j]."'";
	           else $output .= "''";
	           if ($j<(count($row)-1))
	            $output .= ',';
	         }
	         $output .= ");".PHP_EOL;
	       }
	     }
	     $output .= PHP_EOL.PHP_EOL;

	   $output .= "COMMIT;";
	   //save filename

	   $DIR = '../../db/'; //saving directory
	   $filename = '../db/muscco_backup_'.$this->suffix.'.sql';
	   $this->writeUTF8filename($filename,$output);

	   return $filename;
	   	
	 }


 private function writeUTF8filename($fn,$c){  /* save as utf8 encoding */
   $f=fopen($fn,"w+");
   # Now UTF-8 - Add byte order mark
   fwrite($f, pack("CCC",0xef,0xbb,0xbf));
   fwrite($f,$c);
   fclose($f);
 }

 //get current url
 function curPageURL() {
	 $pageURL = '';
	 
	 if ($_SERVER["SERVER_PORT"] != "80") {
	  $pageURL = $_SERVER["PHP_SELF"];
	 } else {
	  $pageURL = $_SERVER["PHP_SELF"];
	 }
	 return $pageURL;
	}

 //send email notification
//
public function SendMail( $email, $message, $subject){
	
	
		
	// Email address verification, do not edit.
	/*function isEmail($email) {
	    return(preg_match("/^[-_.[:alnum:]]+@((([[:alnum:]]|[[:alnum:]][[:alnum:]-]*[[:alnum:]])\.)+(ad|ae|aero|af|ag|ai|al|am|an|ao|aq|ar|arpa|as|at|au|aw|az|ba|bb|bd|be|bf|bg|bh|bi|biz|bj|bm|bn|bo|br|bs|bt|bv|bw|by|bz|ca|cc|cd|cf|cg|ch|ci|ck|cl|cm|cn|co|com|coop|cr|cs|cu|cv|cx|cy|cz|de|dj|dk|dm|do|dz|ec|edu|ee|eg|eh|er|es|et|eu|fi|fj|fk|fm|fo|fr|ga|gb|gd|ge|gf|gh|gi|gl|gm|gn|gov|gp|gq|gr|gs|gt|gu|gw|gy|hk|hm|hn|hr|ht|hu|id|ie|il|in|info|int|io|iq|ir|is|it|jm|jo|jp|ke|kg|kh|ki|km|kn|kp|kr|kw|ky|kz|la|lb|lc|li|lk|lr|ls|lt|lu|lv|ly|ma|mc|md|me|mg|mh|mil|mk|ml|mm|mn|mo|mp|mq|mr|ms|mt|mu|museum|mv|mw|mx|my|mz|na|name|nc|ne|net|nf|ng|ni|nl|no|np|nr|nt|nu|nz|om|org|pa|pe|pf|pg|ph|pk|pl|pm|pn|pr|pro|ps|pt|pw|py|qa|re|ro|ru|rw|sa|sb|sc|sd|se|sg|sh|si|sj|sk|sl|sm|sn|so|sr|st|su|sv|sy|sz|tc|td|tf|tg|th|tj|tk|tm|tn|to|tp|tr|tt|tv|tw|tz|ua|ug|uk|um|us|uy|uz|va|vc|ve|vg|vi|vn|vu|wf|ws|ye|yt|yu|za|zm|zw)$|(([0-9][0-9]?|[0-1][0-9][0-9]|[2][0-4][0-9]|[2][5][0-5])\.){3}([0-9][0-9]?|[0-1][0-9][0-9]|[2][0-4][0-9]|[2][5][0-5]))$/i",$email));
	}

	*/

	if (!defined("PHP_EOL")) define("PHP_EOL", "\r\n");

	// Configuration option.
	// Enter the email address that you want to emails to be sent to.
	// Example $address = "joe.doe@yourdomain.com";

	//$address = "example@themeforest.net";
	$address = $email;


	// Configuration option.
	// i.e. The standard subject will appear as, "You've been contacted by John Doe."

	// Example, $e_subject = '$name . ' has contacted you via Your Website.';

	$e_subject = $subject;


	// Configuration option.
	// You can change this if you feel that you need to.
	// Developers, you may wish to add more fields to the form, in which case you must be sure to add them here.

	$e_body = $message . PHP_EOL . PHP_EOL;
	$e_content = "\"$message\"" . PHP_EOL . PHP_EOL;
	$e_reply = "This email is generated by www.muscco.org";

	$msg = wordwrap( $e_body . $e_reply, 70 );

	$headers = "From: info@muscco.org" . PHP_EOL;
	$headers .= "Reply-To: info@muscco.org" . PHP_EOL;
	$headers .= "MIME-Version: 1.0" . PHP_EOL;
	$headers .= "Content-type: text/plain; charset=utf-8" . PHP_EOL;
	$headers .= "Content-Transfer-Encoding: quoted-printable" . PHP_EOL;

	if(mail($address, $e_subject, $msg, $headers)) {
	    // Email has sent successfully, echo a success page. 
	} else { }

}


}
?>
