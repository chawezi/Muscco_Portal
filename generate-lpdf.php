<?php
include_once('settings/master-class.php');
$con = new MasterClass;

$type = '';
if(isset($_GET['type'])){
	$type = $_GET['type'];
}

// Include the main TCPDF library (search for installation path).
require_once('tcpdf_include_landscape.php');

// create new PDF document
$pdf = new TCPDF(PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);

// set document information
$pdf->setCreator(PDF_CREATOR);
$pdf->setAuthor('Nicola Asuni');
$pdf->setTitle('MUSCCO');
$pdf->setSubject('Sacco List');
$pdf->setKeywords('TCPDF, PDF, example, test, guide');

// set default header data
$pdf->setHeaderData(PDF_HEADER_LOGO, PDF_HEADER_LOGO_WIDTH, PDF_HEADER_TITLE, PDF_HEADER_STRING);

// set header and footer fonts
$pdf->setHeaderFont(Array(PDF_FONT_NAME_MAIN, '', PDF_FONT_SIZE_MAIN));
$pdf->setFooterFont(Array(PDF_FONT_NAME_DATA, '', PDF_FONT_SIZE_DATA));

// set default monospaced font
$pdf->setDefaultMonospacedFont(PDF_FONT_MONOSPACED);

// set margins
$pdf->setMargins(PDF_MARGIN_LEFT, PDF_MARGIN_TOP, PDF_MARGIN_RIGHT);
$pdf->setHeaderMargin(PDF_MARGIN_HEADER);
$pdf->setFooterMargin(PDF_MARGIN_FOOTER);

// set auto page breaks
$pdf->setAutoPageBreak(TRUE, PDF_MARGIN_BOTTOM);

// set image scale factor
$pdf->setImageScale(PDF_IMAGE_SCALE_RATIO);

// ---------------------------------------------------------

// set font
$pdf->setFont('helvetica', '', 12);

// add a page
$pdf->AddPage();

$html ='
	<!-- EXAMPLE OF CSS STYLE -->
	<style>
		h1 {
			font-family: helvetica;
			font-size: 12pt;
			text-align:center;
			text-transform: uppercase;
		}
		table{
			clear: both;
			max-width: none !important;
			border-collapse: separate !important;
			width:100%;
			border:1px solid #000;
		}

		table tr{
			box-sizing: border-box;
		}

		table td, th{
			  padding: 15px;
			  vertical-align: top;
			  height: 20px;
			  border:1px solid #000;
		}
	</style>
';

/**************registered sacco************************/
if($type == 'sacco_report'){
	 $html .='<h1>SACCO REPORT  <br><small>Report on membership showing Assets, Shares, Deposits, Loans, Profits, and Membership (Male, Female, Youth, Others)</small></h1>';
    
    $html .='
	<table id="complex_head_col" class="table border table-striped table-bordered display" style="width: 100%">
        <thead>
          <!-- start row -->
          <tr style="font-weight:bold;">
            <th rowspan="2" width="15%">Sacco Name</th>
            <th rowspan="2" width="12%">Assets</th>
            <th rowspan="2" width="12%">Shares</th>
            <th rowspan="2" width="12%">Deposit</th>
            <th rowspan="2" width="12%">Loans</th>
            <th rowspan="2" width="12%">Profits</th>
            <th colspan="4" width="28%">Membership</th>
          </tr>
          <!-- end row -->
          <!-- start row -->
          <tr style="font-weight:bold;">                            
            <th width="7%">Male</th>
            <th width="7%">Female</th>
            <th width="7%">Youth</th>
            <th width="7%">Other</th>
          </tr>
          <!-- end row -->
        </thead>
        <tbody>
	 ';
    $assets = 0;
    $shares = 0;
    $deposits = 0;
    $loans = 0;
    $profits = 0;
    $male = 0;
    $female = 0;
    $youth = 0;
    $other = 0;
    $saccos = $con->getRows('sacco', array('order_by'=>'sacco_name asc'));
    if(!empty($saccos)){
      
      foreach($saccos as $sacco){ 
        $assets +=$sacco['assets'];
        $shares +=$sacco['shares'];
        $deposits +=$sacco['deposits'];
        $loans +=$sacco['loans'];
        $profits +=$sacco['profits'];
        $male +=$sacco['male_membership'];
        $female +=$sacco['female_membership'];
        $youth +=$sacco['youth_membership'];
        $other +=$sacco['other_membership'];

      	$html .='
        <tr>
            <td width="15%">'.ucwords($sacco['sacco_name']).'</td>
            <td width="12%">'.number_format($sacco['assets'],2,'.',',').'</td>
            <td width="12%">'.number_format($sacco['shares'],2,'.',',').'</td>
            <td width="12%">'.number_format($sacco['deposits'],2,'.',',').'</td>
            <td width="12%">'.number_format($sacco['loans'],2,'.',',').'</td>
            <td width="12%">'.number_format($sacco['profits'],2,'.',',').'</td>
            <td width="7%">'.$sacco['male_membership'].'</td>
            <td width="7%">'.$sacco['female_membership'].'</td>
            <td width="7%">'.$sacco['youth_membership'].'</td>
            <td width="7%">'.$sacco['other_membership'].'</td>
        </tr>
        ';
       
    }
    $html .="
    	</tbody>
                <tfoot style='font-weight:bold;'>
                  <!-- start row -->
                  <tr style='font-weight:bold;'>
                    <td><b>Total</b></td>
                    <td><b>".number_format($assets,2,'.',',')."</b></td>
                    <td><b>".number_format($shares,2,'.',',')."</b></td>
                    <td><b>".number_format($deposits,2,'.',',')."</b></td>
                    <td><b>".number_format($loans,2,'.',',')."</b></td>
                    <td><b>".number_format($profits,2,'.',',')."</b></td>
                    <td><b>".$male."</b></td>
                    <td><b>".$female."</b></td>
                    <td><b>".$youth."</b></td>
                    <td><b>".$other."</b></td>
                  </tr>
                  <!-- end row -->
                </tfoot>
              </table>
    	";
	}
}
/*****************************************/

/**************registered sacco************************/
else if($type == 'sacco_list'){
	 $html .='<h1>REGISTERED SACCO</h1>';
	 $query = $con->getRows('sacco', array('order_by'=>'sacco_name'));
        if(!empty($query)){
            $i = 0;
            $html .='
			<table border="1">

			 <tr>	 
			  <td width="5%"><b>#</b></td>
			  <td width="20%"><b>Sacco Name</b></td>
			  <td width="15%"> <b>Sacco Manager</b></td>
			  <td width="10%"><b>Location</b></td>	  
			  <td width="10%"><b>Phone</b></td>
			  <td width="15%"><b>Email</b></td>
			  <td width="25%"><b>Physical Address</b></td>
			 </tr>
			 ';
            foreach($query as $row){
                $i++;
              	$html .='
                <tr>
                    <td scope="row">'.$i.'</td>
                    <td>'.$row['sacco_name'].'</td>
                    <td>'.$row['sacco_president'].'</td>
                    <td>'.$row['location'].'</td>
                    <td>'.$row['phone_number'].'</td>
                    <td>'.$row['email_address'].'</td>
                    <td>'.$row['physical_address'].'</td>
                </tr>
                ';
               
            }
            $html .="</table>";
        }
}
/*****************************************/
else if($type == "advanced_all"){
	$html .='<h1>TRAVEL ADVANCE REQUESTS REPORT  <br><small>ALL REQUESTS </small></h1>';
	$html .='<h1><br><small>FINANCIAL SUMMARY </small></h1>';
	$html .='
				<table>
				  <tr>
				  	<th><b>Total Allowances</b></th>
				  	<th><b>Total Fuel</b></th>
				  	<th><b>Total</b></th>
				  </tr>
				  <tr>'; 

				        $allowances = 0;
				        $fuels = 0;
				        $total = 0;
				      $all = $con->getRows('travel_advance_request', array('where'=>'(request_status >=2 and request_status <=5)'));
				      if(!empty($all)){
				        foreach($all as $count){
				          $allowances +=($count['rate']*$count['nights'])+$count['day_meal'];
				          $fuels +=$count['total_fuel'];
				          $total +=$count['total_budget'];
				        }
				      }
				    
				    $html .=' 
				    <td>MK'.number_format($allowances,2,'.',',').'</td>
				    <td>MK'.number_format($fuels,2,'.',',').'</td>
				    <td>MK'.number_format($total,2,'.',',').'</td>
				  </tr>  
				</table>
			';

	$html .='<h1><small>ALL APPROVED REQUESTS </small></h1>';

	$html .='

				<table>
				    <tr>
				      <th><b>Officer</b></th>
				      <th><b>Department</b></th>
				      <th><b>Allowances</b></th>                        
				      <th><b>Fuel</b></th>
				      <th><b>Mileage</b></th>
				      <th><b>Total Budget</b></th>
				      <th><b>Date Approved</b></th>
				    </tr>';
      
        			$report = $con->getRows('travel_advance_request a, pillars b, muscco_members c, departments d',
                         array('where'=>'a.pillar=b.pillar_id and a.employee_id=c.muscco_member_id and c.department_id=d.department_id and (a.request_status >=2 and a.request_status <=5)', 'order_by'=>'a.date_posted desc'));
        if(!empty($report)){
          $i=0;
          foreach($report as $day){ 
            $i++;
      		$html .='
            <tr>              
              <td>
                '.ucwords($day['first_name']).' '.ucwords($day['last_name']).'
              </td>
              <td>'.$day['department'].'</td> 
              <td>MK'.number_format(($day['rate']*$day['nights'])+$day['day_meal'], 2, '.',',').'</td>
              <td>MK'.number_format($day['total_fuel'], 2, '.',',').'</td>
              <td>'.$day['mileage'].' KMs</td>
              <td>MK'.number_format($day['total_budget'], 2, '.',',').'</td>
              <td>'.$con->shortDate($day['date_approved']).' </td>
            </tr> 
            ';
            }}
            $html .='   
</table>
			';

}

else if($type == "advanced_today"){
	$html .='<h1>TRAVEL ADVANCE REQUESTS REPORT  <br><small>ALL REQUESTS APPROVED TODAY '.date("d M, Y").' </small></h1>';
	$html .='<h1><br><small>FINANCIAL SUMMARY </small></h1>';
	$date = date("Y-m-d");
	$html .='
				<table>
				  <tr>
				  	<th><b>Total Allowances</b></th>
				  	<th><b>Total Fuel</b></th>
				  	<th><b>Total</b></th>
				  </tr>
				  <tr>'; 

				        $allowances = 0;
				        $fuels = 0;
				        $total = 0;
				      $all = $con->getRows('travel_advance_request', array('where'=>'(request_status >=2 and request_status <=5) and date_approved="'.$date.'"'));
				      if(!empty($all)){
				        foreach($all as $count){
				          $allowances +=($count['rate']*$count['nights'])+$count['day_meal'];
				          $fuels +=$count['total_fuel'];
				          $total +=$count['total_budget'];
				        }
				      }
				    
				    $html .=' 
				    <td>MK'.number_format($allowances,2,'.',',').'</td>
				    <td>MK'.number_format($fuels,2,'.',',').'</td>
				    <td>MK'.number_format($total,2,'.',',').'</td>
				  </tr>  
				</table>
			';

	$html .='<h1><small>ALL APPROVED REQUESTS </small></h1>';

	$html .='

				<table>
				    <tr>
				      <th><b>Officer</b></th>
				      <th><b>Department</b></th>
				      <th><b>Allowances</b></th>                        
				      <th><b>Fuel</b></th>
				      <th><b>Mileage</b></th>
				      <th><b>Total Budget</b></th>
				      <th><b>Date Approved</b></th>
				    </tr>';
      
        			$report = $con->getRows('travel_advance_request a, pillars b, muscco_members c, departments d',
                         array('where'=>'a.pillar=b.pillar_id and a.employee_id=c.muscco_member_id and c.department_id=d.department_id and (a.request_status >=2 and a.request_status <=5) and a.date_approved="'.$date.'"', 'order_by'=>'a.date_posted desc'));
        if(!empty($report)){
          $i=0;
          foreach($report as $day){ 
            $i++;
      		$html .='
            <tr>              
              <td>
                '.ucwords($day['first_name']).' '.ucwords($day['last_name']).'
              </td>
              <td>'.$day['department'].'</td> 
              <td>MK'.number_format(($day['rate']*$day['nights'])+$day['day_meal'], 2, '.',',').'</td>
              <td>MK'.number_format($day['total_fuel'], 2, '.',',').'</td>
              <td>'.$day['mileage'].' KMs</td>
              <td>MK'.number_format($day['total_budget'], 2, '.',',').'</td>
              <td>'.$con->shortDate($day['date_approved']).' </td>
            </tr> 
            ';
            }}
            $html .='</table>';
}

else if($type == "advanced_week"){
	

	$monday = date('Y-m-d', strtotime('monday this week'));
    $saturday = date('Y-m-d', strtotime('sunday this week'));
    $mondays = strtotime("last monday");
    $mondays = date('w', $mondays)==date('w') ? $mondays+7*86400 : $mondays;

    $sunday = strtotime(date("Y-m-d",$mondays)." +6 days");

    $this_week_start = date("d M, Y",$mondays);
    $this_week_end = date("d M, Y",$sunday);

    $html .='<h1>TRAVEL ADVANCE REQUESTS REPORT  <br><small>ALL REQUESTS APPROVED THIS WEEK ('.$this_week_start.' to '.$this_week_end.')</small></h1>';
	$html .='<h1><br><small>FINANCIAL SUMMARY </small></h1>';

	$html .='
				<table>
				  <tr>
				  	<th><b>Total Allowances</b></th>
				  	<th><b>Total Fuel</b></th>
				  	<th><b>Total</b></th>
				  </tr>
				  <tr>'; 

				        $allowances = 0;
				        $fuels = 0;
				        $total = 0;
				      $all = $con->getRows('travel_advance_request', array('where'=>'(request_status >=2 and request_status <=5) and date_approved >="'.$monday.'" and date_approved <= "'.$saturday.'"'));
				      if(!empty($all)){
				        foreach($all as $count){
				          $allowances +=($count['rate']*$count['nights'])+$count['day_meal'];
				          $fuels +=$count['total_fuel'];
				          $total +=$count['total_budget'];
				        }
				      }
				    
				    $html .=' 
				    <td>MK'.number_format($allowances,2,'.',',').'</td>
				    <td>MK'.number_format($fuels,2,'.',',').'</td>
				    <td>MK'.number_format($total,2,'.',',').'</td>
				  </tr>  
				</table>
			';

	$html .='<h1><small>ALL APPROVED REQUESTS </small></h1>';

	$html .='

				<table>
				    <tr>
				      <th><b>Officer</b></th>
				      <th><b>Department</b></th>
				      <th><b>Allowances</b></th>                        
				      <th><b>Fuel</b></th>
				      <th><b>Mileage</b></th>
				      <th><b>Total Budget</b></th>
				      <th><b>Date Approved</b></th>
				    </tr>';
      
        			$report = $con->getRows('travel_advance_request a, pillars b, muscco_members c, departments d',
                         array('where'=>'a.pillar=b.pillar_id and a.employee_id=c.muscco_member_id and c.department_id=d.department_id and (a.request_status >=2 and a.request_status <=5)and date_approved >="'.$monday.'" and date_approved <= "'.$saturday.'"', 'order_by'=>'a.date_posted desc'));
        if(!empty($report)){
          $i=0;
          foreach($report as $day){ 
            $i++;
      		$html .='
            <tr>              
              <td>
                '.ucwords($day['first_name']).' '.ucwords($day['last_name']).'
              </td>
              <td>'.$day['department'].'</td> 
              <td>MK'.number_format(($day['rate']*$day['nights'])+$day['day_meal'], 2, '.',',').'</td>
              <td>MK'.number_format($day['total_fuel'], 2, '.',',').'</td>
              <td>'.$day['mileage'].' KMs</td>
              <td>MK'.number_format($day['total_budget'], 2, '.',',').'</td>
              <td>'.$con->shortDate($day['date_approved']).' </td>
            </tr> 
            ';
            }}
            $html .='</table>';
}

else if($type == "advanced_month"){
	

	$newDate = date('F, Y');
    $first_date = date('Y-m-d',strtotime('first day of this month'));
    $last_date = date('Y-m-d',strtotime('last day of this month'));

    $html .='<h1>TRAVEL ADVANCE REQUESTS REPORT  <br><small>ALL REQUESTS APPROVED THIS MONTH OF '.$newDate.'</small></h1>';
	$html .='<h1><br><small>FINANCIAL SUMMARY </small></h1>';

	$html .='
				<table>
				  <tr>
				  	<th><b>Total Allowances</b></th>
				  	<th><b>Total Fuel</b></th>
				  	<th><b>Total</b></th>
				  </tr>
				  <tr>'; 
				      $all = $con->getRows('travel_advance_request', array('where'=>'(request_status >=2 and request_status <=5) and date_approved >="'.$first_date.'" and date_approved <= "'.$last_date.'"'));

				        $allowances = 0;
				        $fuels = 0;
				        $total = 0;
				      if(!empty($all)){
				        foreach($all as $count){
				          $allowances +=($count['rate']*$count['nights'])+$count['day_meal'];
				          $fuels +=$count['total_fuel'];
				          $total +=$count['total_budget'];
				        }
				      }
				    
				    $html .=' 
				    <td>MK'.number_format($allowances,2,'.',',').'</td>
				    <td>MK'.number_format($fuels,2,'.',',').'</td>
				    <td>MK'.number_format($total,2,'.',',').'</td>
				  </tr>  
				</table>
			';

	$html .='<h1><small>ALL APPROVED REQUESTS </small></h1>';

	$html .='

				<table>
				    <tr>
				      <th><b>Officer</b></th>
				      <th><b>Department</b></th>
				      <th><b>Allowances</b></th>                        
				      <th><b>Fuel</b></th>
				      <th><b>Mileage</b></th>
				      <th><b>Total Budget</b></th>
				      <th><b>Date Approved</b></th>
				    </tr>';
      
        			$report = $con->getRows('travel_advance_request a, pillars b, muscco_members c, departments d',
                         array('where'=>'a.pillar=b.pillar_id and a.employee_id=c.muscco_member_id and c.department_id=d.department_id and (a.request_status >=2 and a.request_status <=5)and date_approved >="'.$first_date.'" and date_approved <= "'.$last_date.'"', 'order_by'=>'a.date_posted desc'));
        if(!empty($report)){
          $i=0;
          foreach($report as $day){ 
            $i++;
      		$html .='
            <tr>              
              <td>
                '.ucwords($day['first_name']).' '.ucwords($day['last_name']).'
              </td>
              <td>'.$day['department'].'</td> 
              <td>MK'.number_format(($day['rate']*$day['nights'])+$day['day_meal'], 2, '.',',').'</td>
              <td>MK'.number_format($day['total_fuel'], 2, '.',',').'</td>
              <td>'.$day['mileage'].' KMs</td>
              <td>MK'.number_format($day['total_budget'], 2, '.',',').'</td>
              <td>'.$con->shortDate($day['date_approved']).' </td>
            </tr> 
            ';
            }}
            $html .='</table>';
}

else if($type == "advanced_year"){
	

	$newDate = date('Y');
    $first_date =  date('Y-m-d', strtotime('first day of january this year'));
    $last_date =  date('Y-m-d', strtotime('last day of december this year'));

    $html .='<h1>TRAVEL ADVANCE REQUESTS REPORT  <br><small>ALL REQUESTS APPROVED THIS YEAR OF '.$newDate.'</small></h1>';
	$html .='<h1><br><small>FINANCIAL SUMMARY </small></h1>';

	$html .='
				<table>
				  <tr>
				  	<th><b>Total Allowances</b></th>
				  	<th><b>Total Fuel</b></th>
				  	<th><b>Total</b></th>
				  </tr>
				  <tr>'; 
				      $all = $con->getRows('travel_advance_request', array('where'=>'(request_status >=2 and request_status <=5) and date_approved >="'.$first_date.'" and date_approved <= "'.$last_date.'"'));
				      $allowances = 0;
				        $fuels = 0;
				        $total = 0;
				      if(!empty($all)){
				        
				        foreach($all as $count){
				          $allowances +=($count['rate']*$count['nights'])+$count['day_meal'];
				          $fuels +=$count['total_fuel'];
				          $total +=$count['total_budget'];
				        }
				      }
				    
				    $html .=' 
				    <td>MK'.number_format($allowances,2,'.',',').'</td>
				    <td>MK'.number_format($fuels,2,'.',',').'</td>
				    <td>MK'.number_format($total,2,'.',',').'</td>
				  </tr>  
				</table>
			';

	$html .='<h1><small>ALL APPROVED REQUESTS </small></h1>';

	$html .='

				<table>
				    <tr>
				      <th><b>Officer</b></th>
				      <th><b>Department</b></th>
				      <th><b>Allowances</b></th>                        
				      <th><b>Fuel</b></th>
				      <th><b>Mileage</b></th>
				      <th><b>Total Budget</b></th>
				      <th><b>Date Approved</b></th>
				    </tr>';
      
        			$report = $con->getRows('travel_advance_request a, pillars b, muscco_members c, departments d',
                         array('where'=>'a.pillar=b.pillar_id and a.employee_id=c.muscco_member_id and c.department_id=d.department_id and (a.request_status >=2 and a.request_status <=5)and date_approved >="'.$first_date.'" and date_approved <= "'.$last_date.'"', 'order_by'=>'a.date_posted desc'));
        if(!empty($report)){
          $i=0;
          foreach($report as $day){ 
            $i++;
      		$html .='
            <tr>              
              <td>
                '.ucwords($day['first_name']).' '.ucwords($day['last_name']).'
              </td>
              <td>'.$day['department'].'</td> 
              <td>MK'.number_format(($day['rate']*$day['nights'])+$day['day_meal'], 2, '.',',').'</td>
              <td>MK'.number_format($day['total_fuel'], 2, '.',',').'</td>
              <td>'.$day['mileage'].' KMs</td>
              <td>MK'.number_format($day['total_budget'], 2, '.',',').'</td>
              <td>'.$con->shortDate($day['date_approved']).' </td>
            </tr> 
            ';
            }}
            $html .='</table>';
}

else if($type == "advanced_custom"){
	
	$selection = $_GET['officer'];
    $first_date = $_GET['date_from'];
    $last_date  = $_GET['date_to'];
    $officer = $_GET['officer'];
    if($officer == 'All'){
      $selection = "All Officers";
      $all = $con->getRows('travel_advance_request', array('where'=>'(request_status >=2 and request_status <=5) and date_approved >="'.$first_date.'" and date_approved <= "'.$last_date.'"'));
      $report = $con->getRows('travel_advance_request a, pillars b, muscco_members c, departments d',
                         array('where'=>'a.pillar=b.pillar_id and a.employee_id=c.muscco_member_id and c.department_id=d.department_id and (a.request_status >=2 and a.request_status <=5)and a.date_approved >="'.$first_date.'" and a.date_approved <= "'.$last_date.'"', 'order_by'=>'a.date_posted desc'));
    }else{
      $off = $con->getRows('muscco_members', array('where'=>'muscco_member_id="'.$officer.'"', 'return_type'=>'single'));
      $selection = ucwords($off['first_name'])." ".ucwords($off['last_name']);
      $all = $con->getRows('travel_advance_request', array('where'=>'(request_status >=2 and request_status <=5) and date_approved >="'.$first_date.'" and date_approved <= "'.$last_date.'" and employee_id="'.$officer.'"'));
      $report = $con->getRows('travel_advance_request a, pillars b, muscco_members c, departments d',
                         array('where'=>'a.pillar=b.pillar_id and a.employee_id=c.muscco_member_id and c.department_id=d.department_id and (a.request_status >=2 and a.request_status <=5)and a.date_approved >="'.$first_date.'" and a.date_approved <= "'.$last_date.'"  and a.employee_id="'.$officer.'"', 'order_by'=>'a.date_approved desc'));
    }    

    $html .='<h1>TRAVEL ADVANCE REQUESTS REPORT  <br><small>ALL REQUESTS APPROVED FOR '.$selection.' FROM '.$con->shortDate($first_date).' TO '.$con->shortDate($last_date).'</small></h1>';

	$html .='<h1><br><small>FINANCIAL SUMMARY </small></h1>';

	$html .='
				<table>
				  <tr>
				  	<th><b>Total Allowances</b></th>
				  	<th><b>Total Fuel</b></th>
				  	<th><b>Total</b></th>
				  </tr>
				  <tr>'; 
				  	  $allowances = 0;
				        $fuels = 0;
				        $total = 0;
				      if(!empty($all)){
				        
				        foreach($all as $count){
				          $allowances +=($count['rate']*$count['nights'])+$count['day_meal'];
				          $fuels +=$count['total_fuel'];
				          $total +=$count['total_budget'];
				        }
				      }
				    
				    $html .=' 
				    <td>MK'.number_format($allowances,2,'.',',').'</td>
				    <td>MK'.number_format($fuels,2,'.',',').'</td>
				    <td>MK'.number_format($total,2,'.',',').'</td>
				  </tr>  
				</table>
			';

	$html .='<h1><small>ALL APPROVED REQUESTS </small></h1>';

	$html .='

				<table>
				    <tr>
				      <th><b>Officer</b></th>
				      <th><b>Department</b></th>
				      <th><b>Allowances</b></th>                        
				      <th><b>Fuel</b></th>
				      <th><b>Mileage</b></th>
				      <th><b>Total Budget</b></th>
				      <th><b>Date Approved</b></th>
				    </tr>';
      
        if(!empty($report)){
          $i=0;
          foreach($report as $day){ 
            $i++;
      		$html .='
            <tr>              
              <td>
                '.ucwords($day['first_name']).' '.ucwords($day['last_name']).'
              </td>
              <td>'.$day['department'].'</td> 
              <td>MK'.number_format(($day['rate']*$day['nights'])+$day['day_meal'], 2, '.',',').'</td>
              <td>MK'.number_format($day['total_fuel'], 2, '.',',').'</td>
              <td>'.$day['mileage'].' KMs</td>
              <td>MK'.number_format($day['total_budget'], 2, '.',',').'</td>
              <td>'.$con->shortDate($day['date_approved']).' </td>
            </tr> 
            ';
            }}
            $html .='</table>';
}
/************ petty cash *****************/
else if($type == 'petty_cash_details'){
	 $html .='<h1>PETTY CASH REQUISITION FORM</h1>';
	 $petty = $con->getRows('petty_cash_requisitions a, muscco_members b, departments c',
                      array('where'=>'a.requested_by=b.muscco_member_id and b.department_id=c.department_id 
                      		and a.requisition_id="'.$_GET['requisistion_id'].'"','return_type'=>'single')
                  );
 	// define some HTML content with style
	$html .= '
		<table>
			<tr>
				<td width="18%">NAME</td>
	            <td style="border-bottom:1px solid #000; width:31%;"><p>'.ucwords($petty['first_name']).' '.ucwords($petty['last_name']).'</p></td>
	            <td width="18%">DEPARTMENT</td>
	            <td style="border-bottom:1px solid #000; width:31%;">'.$petty['department'].'</td>
	        </tr>
	        <tr><td></td></tr>
	        <tr>
				<td>SUBJECT</td>
	            <td style="border-bottom:1px solid #000">'.$petty['subject'].'</td>
	            <td>SPONSOR</td>
	            <td style="border-bottom:1px solid #000">'.$petty['sponsor'].'</td>
	        </tr>
	        <tr><td></td></tr>
	        <tr>
	        	<td colspan="2"></td>
	            <td>AMOUNT</td>
	            <td style="border-bottom:1px solid #000">MK'.number_format($petty['amount'],2,'.',',').'</td>
	        </tr>
	        <tr><td></td></tr>
	        <tr>
	            <td colspan="4" rowspan="2" style="border:1px solid #000">'.$petty['description'].'</td>
	        </tr>
	        <tr><td></td></tr>
	        <tr><td></td></tr>
	        <tr>
				<td>SIGNATURE</td>
	            <td style="border-bottom:1px solid #000">'.ucwords($petty['first_name']).' '.ucwords($petty['last_name']).'</td>
	            <td>DATE</td>
	            <td style="border-bottom:1px solid #000">'.$con->shortDate($petty['date_posted']).'</td>
	        </tr>
	        <tr><td></td></tr>
	        ';
	        $approver = $con->getRows('muscco_members', array('where'=>'muscco_member_id="'.$petty['approved_by'].'"','return_type'=>'single'));
	        $html .='<tr>
				<td>APPROVED BY</td>
	            <td style="border-bottom:1px solid #000">'.ucwords($approver['first_name']).' '.ucwords($approver['last_name']).'</td>
	            <td>DATE</td>
	            <td style="border-bottom:1px solid #000">'.$con->shortDate($petty['date_posted']).'</td>
	        </tr>
	        <tr><td></td></tr>
	        <tr>
	            <td colspan="4" style="border-bottom:1px solid #000">'.$petty['remarks'].'</td>
	        </tr>
		';
 	
    $html .= "</table>";
	 
}
//petty cash reports
//todays
else if($type == "pettycash_all"){
	$html .='<h1>PETTY CASH REQUISITION REPORT  <br><small>ALL REQUISITIONS APPROVED</small></h1>';
	$html .='<h1><br><small>FINANCIAL SUMMARY </small></h1>';
	$date = date("Y-m-d");
	$html .='
				<table>
				  <tr><td><b>Total Petty Cash</b></td>'; 
				      $date = date("Y-m-d");
	      			$total = 0;
	      			$all = $con->getRows('petty_cash_requisitions', array('where'=>'requisition_status=1'));
	      			if(!empty($all)){
	       				 foreach($all as $count){
	          				$total +=$count['amount'];
	        				}
	      			}
				    
				    $html .=' 
				    <td>MK'.number_format($total,2,'.',',').'</td>
				  </tr>  
				</table>
			';

	$html .='<h1><small>ALL APPROVED REQUISITIONS </small></h1>';

	$html .='

				<table>
				    <tr>
	    <th><b>Officer</b></th>
	    <th><b>Department</b></th>
	    <th><b>Subject</b></th>
	    <th><b>Donor</b></th>
	    <th><b>Amount(MK)</b></th>
	    <th><b>Date</b></th>
				    </tr>';
      
        			$report = $con->getRows('petty_cash_requisitions a, muscco_members b, departments c',
                             array('where'=>'a.requested_by=b.muscco_member_id and b.department_id=c.department_id and a.requisition_status=1','order_by'=>'a.date_approved desc'));
        if(!empty($report)){
          $i=0;
          foreach($report as $day){ 
            $i++;
      		$html .='
            <tr>              
              <td>
                '.ucwords($day['first_name']).' '.ucwords($day['last_name']).'
              </td>
              <td>'.$day['department'].'</td> 
              <td>'.$day['subject'].'</td> 
              <td>'.$day['sponsor'].'</td> 
              <td>MK'.number_format($day['amount'], 2, '.',',').'</td>
              <td>'.$con->shortDate($day['date_approved']).' </td>
            </tr> 
            ';
            }}
            $html .='</table>';
}

else if($type == "pettycash_today"){
	$html .='<h1>PETTY CASH REQUISITION REPORT  <br><small>ALL REQUISITIONS APPROVED TODAY '.date("d M, Y").' </small></h1>';
	$html .='<h1><br><small>FINANCIAL SUMMARY </small></h1>';
	$date = date("Y-m-d");
	$html .='
				<table>
				  <tr><td><b>Total Petty Cash</b></td>'; 
				      $date = date("Y-m-d");
	      			$total = 0;
	      			$all = $con->getRows('petty_cash_requisitions', array('where'=>'requisition_status=1 and date_approved="'.$date.'"'));
	      			if(!empty($all)){
	       				 foreach($all as $count){
	          				$total +=$count['amount'];
	        				}
	      			}
				    
				    $html .=' 
				    <td>MK'.number_format($total,2,'.',',').'</td>
				  </tr>  
				</table>
			';

	$html .='<h1><small>ALL APPROVED REQUISITIONS </small></h1>';

	$html .='

				<table>
				    <tr>
	    <th><b>Officer</b></th>
	    <th><b>Department</b></th>
	    <th><b>Subject</b></th>
	    <th><b>Donor</b></th>
	    <th><b>Amount(MK)</b></th>
	    <th><b>Date</b></th>
				    </tr>';
      
        			$report = $con->getRows('petty_cash_requisitions a, muscco_members b, departments c',
                             array('where'=>'a.requested_by=b.muscco_member_id and b.department_id=c.department_id and a.requisition_status=1 and a.date_approved="'.$date.'"','order_by'=>'a.date_posted desc'));
        if(!empty($report)){
          $i=0;
          foreach($report as $day){ 
            $i++;
      		$html .='
            <tr>              
              <td>
                '.ucwords($day['first_name']).' '.ucwords($day['last_name']).'
              </td>
              <td>'.$day['department'].'</td> 
              <td>'.$day['subject'].'</td> 
              <td>'.$day['sponsor'].'</td> 
              <td>MK'.number_format($day['amount'], 2, '.',',').'</td>
              <td>'.$con->shortDate($day['date_approved']).' </td>
            </tr> 
            ';
            }}
            $html .='</table>';
}

else if($type == "pettycash_week"){
	$monday = date('Y-m-d', strtotime('monday this week'));
    $saturday = date('Y-m-d', strtotime('sunday this week'));
    $mondays = strtotime("last monday");
    $mondays = date('w', $mondays)==date('w') ? $mondays+7*86400 : $mondays;

    $sunday = strtotime(date("Y-m-d",$mondays)." +6 days");

    $this_week_start = date("d M, Y",$mondays);
    $this_week_end = date("d M, Y",$sunday);
	$html .='<h1>PETTY CASH REQUISITION REPORT  <br><small>ALL REQUISITIONS APPROVED THIS WEEK ('.$this_week_start.' to '.$this_week_end.') </small></h1>';
	$html .='<h1><br><small>FINANCIAL SUMMARY </small></h1>';
	$date = date("Y-m-d");
	$html .='
				<table>
				  <tr><td><b>Total Petty Cash</b></td>'; 
				      $date = date("Y-m-d");
	      			$total = 0;
	      			$all = $con->getRows('petty_cash_requisitions', array('where'=>'requisition_status=1 and date_approved >="'.$monday.'" and date_approved <= "'.$saturday.'"'));
	      			if(!empty($all)){
	       				 foreach($all as $count){
	          				$total +=$count['amount'];
	        				}
	      			}
				    
				    $html .=' 
				    <td>MK'.number_format($total,2,'.',',').'</td>
				  </tr>  
				</table>
			';

	$html .='<h1><small>ALL APPROVED REQUISITIONS </small></h1>';

	$html .='

				<table>
				    <tr>
	    <th><b>Officer</b></th>
	    <th><b>Department</b></th>
	    <th><b>Subject</b></th>
	    <th><b>Donor</b></th>
	    <th><b>Amount(MK)</b></th>
	    <th><b>Date</b></th>
				    </tr>';
      
        			$report = $con->getRows('petty_cash_requisitions a, muscco_members b, departments c',
                             array('where'=>'a.requested_by=b.muscco_member_id and b.department_id=c.department_id and a.requisition_status=1 and a.date_approved >="'.$monday.'" and a.date_approved <= "'.$saturday.'"','order_by'=>'a.date_posted desc'));
        if(!empty($report)){
          $i=0;
          foreach($report as $day){ 
            $i++;
      		$html .='
            <tr>              
              <td>
                '.ucwords($day['first_name']).' '.ucwords($day['last_name']).'
              </td>
              <td>'.$day['department'].'</td> 
              <td>'.$day['subject'].'</td> 
              <td>'.$day['sponsor'].'</td> 
              <td>MK'.number_format($day['amount'], 2, '.',',').'</td>
              <td>'.$con->shortDate($day['date_approved']).' </td>
            </tr> 
            ';
            }}
            $html .='</table>';
}

else if($type == "pettycash_month"){
	$newDate = date('F');
        $first_date = date('Y-m-d',strtotime('first day of this month'));
        $last_date = date('Y-m-d',strtotime('last day of this month'));
	$html .='<h1>PETTY CASH REQUISITION REPORT  <br><small>ALL REQUISITIONS APPROVED THIS MONTH OF '.$newDate.', '.date('Y').' </small></h1>';
	$html .='<h1><br><small>FINANCIAL SUMMARY </small></h1>';
	$date = date("Y-m-d");
	$html .='
				<table>
				  <tr><td><b>Total Petty Cash</b></td>'; 
				      $date = date("Y-m-d");
	      			$total = 0;
	      			$all = $con->getRows('petty_cash_requisitions', array('where'=>'requisition_status=1 and date_approved >="'.$first_date.'" and date_approved <= "'.$last_date.'"'));
	      			if(!empty($all)){
	       				 foreach($all as $count){
	          				$total +=$count['amount'];
	        				}
	      			}
				    
				    $html .=' 
				    <td>MK'.number_format($total,2,'.',',').'</td>
				  </tr>  
				</table>
			';

	$html .='<h1><small>ALL APPROVED REQUISITIONS </small></h1>';

	$html .='

				<table>
				    <tr>
	    <th><b>Officer</b></th>
	    <th><b>Department</b></th>
	    <th><b>Subject</b></th>
	    <th><b>Donor</b></th>
	    <th><b>Amount(MK)</b></th>
	    <th><b>Date</b></th>
				    </tr>';
      
        			$report = $con->getRows('petty_cash_requisitions a, muscco_members b, departments c',
                             array('where'=>'a.requested_by=b.muscco_member_id and b.department_id=c.department_id and a.requisition_status=1 and a.date_approved >="'.$first_date.'" and a.date_approved <= "'.$last_date.'"','order_by'=>'a.date_posted desc'));
        if(!empty($report)){
          $i=0;
          foreach($report as $day){ 
            $i++;
      		$html .='
            <tr>              
              <td>
                '.ucwords($day['first_name']).' '.ucwords($day['last_name']).'
              </td>
              <td>'.$day['department'].'</td> 
              <td>'.$day['subject'].'</td> 
              <td>'.$day['sponsor'].'</td> 
              <td>MK'.number_format($day['amount'], 2, '.',',').'</td>
              <td>'.$con->shortDate($day['date_approved']).' </td>
            </tr> 
            ';
            }}
            $html .='</table>';
}

else if($type == "pettycash_year"){
	$newDate = date('Y');
        $first_date =  date('Y-m-d', strtotime('first day of january this year'));
        $last_date =  date('Y-m-d', strtotime('last day of december this year'));
	$html .='<h1>PETTY CASH REQUISITION REPORT  <br><small>ALL REQUISITIONS APPROVED THIS YEAR OF '.date('Y').' </small></h1>';
	$html .='<h1><br><small>FINANCIAL SUMMARY </small></h1>';
	$date = date("Y-m-d");
	$html .='
				<table>
				  <tr><td><b>Total Petty Cash</b></td>'; 
				      $date = date("Y-m-d");
	      			$total = 0;
	      			$all = $con->getRows('petty_cash_requisitions', array('where'=>'requisition_status=1 and date_approved >="'.$first_date.'" and date_approved <= "'.$last_date.'"'));
	      			if(!empty($all)){
	       				 foreach($all as $count){
	          				$total +=$count['amount'];
	        				}
	      			}
				    
				    $html .=' 
				    <td>MK'.number_format($total,2,'.',',').'</td>
				  </tr>  
				</table>
			';

	$html .='<h1><small>ALL APPROVED REQUISITIONS </small></h1>';

	$html .='

				<table>
				    <tr>
	    <th><b>Officer</b></th>
	    <th><b>Department</b></th>
	    <th><b>Subject</b></th>
	    <th><b>Donor</b></th>
	    <th><b>Amount(MK)</b></th>
	    <th><b>Date</b></th>
				    </tr>';
      
        			$report = $con->getRows('petty_cash_requisitions a, muscco_members b, departments c',
                             array('where'=>'a.requested_by=b.muscco_member_id and b.department_id=c.department_id and a.requisition_status=1 and a.date_approved >="'.$first_date.'" and a.date_approved <= "'.$last_date.'"','order_by'=>'a.date_approved desc'));
        if(!empty($report)){
          $i=0;
          foreach($report as $day){ 
            $i++;
      		$html .='
            <tr>              
              <td>
                '.ucwords($day['first_name']).' '.ucwords($day['last_name']).'
              </td>
              <td>'.$day['department'].'</td> 
              <td>'.$day['subject'].'</td> 
              <td>'.$day['sponsor'].'</td> 
              <td>MK'.number_format($day['amount'], 2, '.',',').'</td>
              <td>'.$con->shortDate($day['date_approved']).' </td>
            </tr> 
            ';
            }}
            $html .='</table>';
}

else if($type == "pettycash_custom"){
	
	$selection = '';
    $first_date = $_GET['date_from'];
    $last_date  = $_GET['date_to'];
    $section = $_GET['section'];
    if($section == 'All'){
      $selection = "All Departments";
      $all = $con->getRows('petty_cash_requisitions', array('where'=>'requisition_status=1 and date_approved >="'.$first_date.'" and date_approved <= "'.$last_date.'"'));
      $requisitions = $con->getRows('petty_cash_requisitions a, muscco_members b, departments c',
                             array('where'=>'a.requested_by=b.muscco_member_id and b.department_id=c.department_id and a.requisition_status=1 and a.date_approved >="'.$first_date.'" and a.date_approved <= "'.$last_date.'"','order_by'=>'a.date_posted desc'));
    }else{
      $off = $con->getRows('departments', array('where'=>'department_id="'.$section.'"', 'return_type'=>'single'));
      $selection = $off['department'];
      $all = $con->getRows('petty_cash_requisitions a, muscco_members b, departments c', 
                          array('where'=>'a.requisition_status=1 and a.date_approved >="'.$first_date.'" and a.date_approved <= "'.$last_date.'" and a.requested_by=b.muscco_member_id and b.department_id=c.department_id and c.department_id="'.$section.'"'));
      $requisitions = $con->getRows('petty_cash_requisitions a, muscco_members b, departments c',
                             array('where'=>'a.requested_by=b.muscco_member_id and b.department_id=c.department_id and a.requisition_status=1 and a.date_approved >="'.$first_date.'" and a.date_approved <= "'.$last_date.'" and c.department_id="'.$section.'"','order_by'=>'a.date_posted desc'));
    }   

    $html .='<h1>PETTY CASH REQUISITIONS REPORT  <br><small>ALL REQUISITIONS APPROVED FOR '.$selection.' FROM '.$con->shortDate($first_date).' TO '.$con->shortDate($last_date).'</small></h1>';

	$html .='<h1><br><small>FINANCIAL SUMMARY </small></h1>';

	$html .='
				<table>
				  <tr><td><b>Total Petty Cash</b></td>'; 
				  	  $date = date("Y-m-d");
      $total = 0;
      if(!empty($all)){
        foreach($all as $count){
          $total +=$count['amount'];
        }
      }
				    
				    $html .=' 
				    <td>MK'.number_format($total,2,'.',',').'</td>
				  </tr>  
				</table>
			';

	$html .='<h1><small>ALL APPROVED REQUISITIONS </small></h1>';

	$html .='

				<table>
				    <tr>
	    <th><b>Officer</b></th>
	    <th><b>Department</b></th>
	    <th><b>Subject</b></th>
	    <th><b>Donor</b></th>
	    <th><b>Amount(MK)</b></th>
	    <th><b>Date</b></th>
				    </tr>';
      
        			
        if(!empty($requisitions)){
          $i=0;
          foreach($requisitions as $day){ 
            $i++;
      		$html .='
            <tr>              
              <td>
                '.ucwords($day['first_name']).' '.ucwords($day['last_name']).'
              </td>
              <td>'.$day['department'].'</td> 
              <td>'.$day['subject'].'</td> 
              <td>'.$day['sponsor'].'</td> 
              <td>MK'.number_format($day['amount'], 2, '.',',').'</td>
              <td>'.$con->shortDate($day['date_approved']).' </td>
            </tr> 
            ';
            }}
            $html .='</table>';
}

//custom issue
if($type == 'advance_details'){
	 $html .= '<h1>MUSCCO STAFF PERSONAL ADVANCE REQUEST FORM</h1>';
	 $advance = $con->getRows('advance_requests a, muscco_members b',
                  array('where'=>'a.requested_by=b.muscco_member_id and a.advance_id="'.$_GET['advance_id'].'"','return_type'=>'single'));
	 $html .= 'I, <b>'.ucwords($advance['first_name']).' '.ucwords($advance['last_name']).'</b>, request a personal advance of <b>K'.number_format($advance['amount'],2,'.',',').'</b> to be deducted/paid directly from my salary in <b>'.$advance['months'].'</b> instalments, the first to start on <b>'.$con->monthYear($advance['start']).'</b> and end in <b>'.$con->monthYear($advance['end']).'</b> <br><br> <b><u>STATUS:</u></b><br><br>I do not have advance from muscco, as my last personal advance payment was made from my month salary.<br><br>The purpose for the personal advance is:<b> '.$advance['purpose'].'</b><br><br> Signature: <b>'.ucwords($advance['first_name']).' '.ucwords($advance['last_name']).'</b> Date Posted: <b>'.$con->shortDate($advance['date_posted']).'</b><br><br>';

	 $verify = $con->getRows('muscco_members', array('where'=>'muscco_member_id="'.$advance['verified_by'].'"','return_type'=>'single'));
	 $html .= 'Accountant’s verification and comments on the status of previous advances:<br></br> Verified by: <b>'.ucwords($verify['first_name']).' '.ucwords($verify['last_name']).'</b> Date verified: <b>'.$con->shortDate($advance['verified_date']).'</b><br> Comments: <b>'.$advance['verified_comment'].'</b><br><br>';

	 $html .= 'Supervisor’s comment and recommendation: <br>Checked by:  Date checked: <b>'.$con->shortDate($advance['date_supervised']).'</b><br> Comments: <b>'.$advance['supervisor_comment'].'</b><br><br>';
}

/**********************Advance request reports******************/
//all advance requests
else if($type == "advance_request_all"){
	$html .='<h1>ADVANCE REQUEST REPORT  <br><small>ALL REQUEST APPROVED</small></h1>';
	$html .='<h1><br><small>FINANCIAL SUMMARY </small></h1>';
	$date = date("Y-m-d");
	$html .='
				<table>
				  <tr>
				  	<td><b>Advance Amount</b></td>
				  	<td><b>Amount Paid</b></td>
				  	<td><b>Balance</b></td>
				  </tr>'; 
				      $amounts = 0;
					    $balances = 0;
					    $paid = 0;
					    $all = $con->getRows('advance_requests', array('where'=>'advance_status >=4'));
					    if(!empty($all)){        
					      foreach($all as $count){
					        $amounts +=$count['amount'];
					        $balances +=$count['balance'];
					        $paid +=$count['total_paid'];
					      }
					    }
				    
				    $html .='
				    <tr> 
				    <td>MK'.number_format($amounts,2,'.',',').'</td>
    				<td>MK'.number_format($paid,2,'.',',').'</td>
    				<td>MK'.number_format($balances,2,'.',',').'</td>
				  </tr>  
				</table>
			';

	$html .='<h1><small>ALL APPROVED REQUESTS </small></h1>';

	$html .='

				<table>
				    <tr>
	    <th><b>Officer</b></th>
	    <th><b>Department</b></th>
	    <th><b>Advance Amount</b></th>
	    <th><b>Amount Paid</b></th>
	    <th><b>Balance</b></th>
	    <th><b>Date</b></th>
				    </tr>';
      
        			$report = $con->getRows('advance_requests a, muscco_members b, departments c', 
               array('where'=>'a.requested_by=b.muscco_member_id and b.department_id=c.department_id and a.advance_status >=4','order_by'=>'date_posted desc'));
        if(!empty($report)){
          $i=0;
          foreach($report as $day){ 
            $i++;
      		$html .='
            <tr>              
              <td>
                '.ucwords($day['first_name']).' '.ucwords($day['last_name']).'
              </td>
              <td>'.$day['department'].'</td> 
              <td>MK'.number_format($day['amount'],2,'.',',').'</td> 
              <td>MK'.number_format($day['total_paid'],2,'.',',').'</td> 
              <td>MK'.number_format($day['balance'],2,'.',',').'</td>
              <td>'.$con->shortDate($day['date_approved']).' </td>
            </tr> 
            ';
            }}
            $html .='</table>';
}

//today
else if($type == "advance_request_today"){
	$date = date("Y-m-d");
	$html .='<h1>ADVANCE REQUEST REPORT  <br><small>ALL REQUEST APPROVED TODAY '.date("d M, Y").'</small></h1>';
	$html .='<h1><br><small>FINANCIAL SUMMARY </small></h1>';
	$date = date("Y-m-d");
	$html .='
				<table>
				  <tr>
				  	<td><b>Advance Amount</b></td>
				  	<td><b>Amount Paid</b></td>
				  	<td><b>Balance</b></td>
				  </tr>'; 
				      $amounts = 0;
					    $balances = 0;
					    $paid = 0;					    
					    $all = $con->getRows('advance_requests', array('where'=>'advance_status >=4 and date_approved="'.$date.'"'));
					    if(!empty($all)){        
					      foreach($all as $count){
					        $amounts +=$count['amount'];
					        $balances +=$count['balance'];
					        $paid +=$count['total_paid'];
					      }
					    }
				    
				    $html .='
				    <tr> 
				    <td>MK'.number_format($amounts,2,'.',',').'</td>
    				<td>MK'.number_format($paid,2,'.',',').'</td>
    				<td>MK'.number_format($balances,2,'.',',').'</td>
				  </tr>  
				</table>
			';

	$html .='<h1><small>ALL APPROVED REQUESTS </small></h1>';

	$html .='

				<table>
				    <tr>
	    <th><b>Officer</b></th>
	    <th><b>Department</b></th>
	    <th><b>Advance Amount</b></th>
	    <th><b>Amount Paid</b></th>
	    <th><b>Balance</b></th>
	    <th><b>Date</b></th>
				    </tr>';
      
        			$report = $con->getRows('advance_requests a, muscco_members b, departments c', 
               array('where'=>'a.requested_by=b.muscco_member_id and b.department_id=c.department_id and a.advance_status >=4 and a.date_approved="'.$date.'"','order_by'=>'date_posted desc'));
        if(!empty($report)){
          $i=0;
          foreach($report as $day){ 
            $i++;
      		$html .='
            <tr>              
              <td>
                '.ucwords($day['first_name']).' '.ucwords($day['last_name']).'
              </td>
              <td>'.$day['department'].'</td> 
              <td>MK'.number_format($day['amount'],2,'.',',').'</td> 
              <td>MK'.number_format($day['total_paid'],2,'.',',').'</td> 
              <td>MK'.number_format($day['balance'],2,'.',',').'</td>
              <td>'.$con->shortDate($day['date_approved']).' </td>
            </tr> 
            ';
            }}
            $html .='</table>';
}

//this week
else if($type == "advance_request_week"){
	$monday = date('Y-m-d', strtotime('monday this week'));
  $saturday = date('Y-m-d', strtotime('sunday this week'));
  $mondays = strtotime("last monday");
  $mondays = date('w', $mondays)==date('w') ? $mondays+7*86400 : $mondays;

  $sunday = strtotime(date("Y-m-d",$mondays)." +6 days");

  $this_week_start = date("d M, Y",$mondays);
  $this_week_end = date("d M, Y",$sunday);
	$html .='<h1>ADVANCE REQUEST REPORT  <br><small>ALL REQUEST APPROVED THIS WEEK '.$this_week_start.' to '.$this_week_end.'</small></h1>';
	$html .='<h1><br><small>FINANCIAL SUMMARY </small></h1>';
	$date = date("Y-m-d");
	$html .='
				<table>
				  <tr>
				  	<td><b>Advance Amount</b></td>
				  	<td><b>Amount Paid</b></td>
				  	<td><b>Balance</b></td>
				  </tr>'; 
				      $amounts = 0;
					    $balances = 0;
					    $paid = 0;					    
					    $all = $con->getRows('advance_requests', array('where'=>'advance_status >=4 and date_approved >="'.$monday.'" and date_approved <= "'.$saturday.'"'));
					    if(!empty($all)){        
					      foreach($all as $count){
					        $amounts +=$count['amount'];
					        $balances +=$count['balance'];
					        $paid +=$count['total_paid'];
					      }
					    }
				    
				    $html .='
				    <tr> 
				    <td>MK'.number_format($amounts,2,'.',',').'</td>
    				<td>MK'.number_format($paid,2,'.',',').'</td>
    				<td>MK'.number_format($balances,2,'.',',').'</td>
				  </tr>  
				</table>
			';

	$html .='<h1><small>ALL APPROVED REQUESTS </small></h1>';

	$html .='

				<table>
				    <tr>
	    <th><b>Officer</b></th>
	    <th><b>Department</b></th>
	    <th><b>Advance Amount</b></th>
	    <th><b>Amount Paid</b></th>
	    <th><b>Balance</b></th>
	    <th><b>Date</b></th>
				    </tr>';
      
        			$report = $con->getRows('advance_requests a, muscco_members b, departments c', 
               array('where'=>'a.requested_by=b.muscco_member_id and b.department_id=c.department_id and a.advance_status >=4 and a.date_approved >="'.$monday.'" and a.date_approved <= "'.$saturday.'"','order_by'=>'date_posted desc'));
        if(!empty($report)){
          $i=0;
          foreach($report as $day){ 
            $i++;
      		$html .='
            <tr>              
              <td>
                '.ucwords($day['first_name']).' '.ucwords($day['last_name']).'
              </td>
              <td>'.$day['department'].'</td> 
              <td>MK'.number_format($day['amount'],2,'.',',').'</td> 
              <td>MK'.number_format($day['total_paid'],2,'.',',').'</td> 
              <td>MK'.number_format($day['balance'],2,'.',',').'</td>
              <td>'.$con->shortDate($day['date_approved']).' </td>
            </tr> 
            ';
            }}
            $html .='</table>';
}

//this month
else if($type == "advance_request_month"){
	$newDate = date('F');
  $first_date = date('Y-m-d',strtotime('first day of this month'));
  $last_date = date('Y-m-d',strtotime('last day of this month'));

	$html .='<h1>ADVANCE REQUEST REPORT  <br><small>ALL REQUEST APPROVED THIS MONTH OF '.$newDate.', '.date('Y').'</small></h1>';
	$html .='<h1><br><small>FINANCIAL SUMMARY </small></h1>';
	$date = date("Y-m-d");
	$html .='
				<table>
				  <tr>
				  	<td><b>Advance Amount</b></td>
				  	<td><b>Amount Paid</b></td>
				  	<td><b>Balance</b></td>
				  </tr>'; 
				      $amounts = 0;
					    $balances = 0;
					    $paid = 0;					    
					    $all = $con->getRows('advance_requests', array('where'=>'advance_status >=4 and date_approved >="'.$first_date.'" and date_approved <= "'.$last_date.'"'));
					    if(!empty($all)){        
					      foreach($all as $count){
					        $amounts +=$count['amount'];
					        $balances +=$count['balance'];
					        $paid +=$count['total_paid'];
					      }
					    }
				    
				    $html .='
				    <tr> 
				    <td>MK'.number_format($amounts,2,'.',',').'</td>
    				<td>MK'.number_format($paid,2,'.',',').'</td>
    				<td>MK'.number_format($balances,2,'.',',').'</td>
				  </tr>  
				</table>
			';

	$html .='<h1><small>ALL APPROVED REQUESTS </small></h1>';

	$html .='

				<table>
				    <tr>
	    <th><b>Officer</b></th>
	    <th><b>Department</b></th>
	    <th><b>Advance Amount</b></th>
	    <th><b>Amount Paid</b></th>
	    <th><b>Balance</b></th>
	    <th><b>Date</b></th>
				    </tr>';
      
        			$report = $con->getRows('advance_requests a, muscco_members b, departments c', 
               array('where'=>'a.requested_by=b.muscco_member_id and b.department_id=c.department_id and a.advance_status >=4 and a.date_approved >="'.$first_date.'" and a.date_approved <= "'.$last_date.'"','order_by'=>'date_posted desc'));
        if(!empty($report)){
          $i=0;
          foreach($report as $day){ 
            $i++;
      		$html .='
            <tr>              
              <td>
                '.ucwords($day['first_name']).' '.ucwords($day['last_name']).'
              </td>
              <td>'.$day['department'].'</td> 
              <td>MK'.number_format($day['amount'],2,'.',',').'</td> 
              <td>MK'.number_format($day['total_paid'],2,'.',',').'</td> 
              <td>MK'.number_format($day['balance'],2,'.',',').'</td>
              <td>'.$con->shortDate($day['date_approved']).' </td>
            </tr> 
            ';
            }}
            $html .='</table>';
}

//this year
else if($type == "advance_request_year"){
	$newDate = date('F');
  $first_date =  date('Y-m-d', strtotime('first day of january this year'));
  $last_date =  date('Y-m-d', strtotime('last day of december this year'));

	$html .='<h1>ADVANCE REQUEST REPORT  <br><small>ALL REQUEST APPROVED THIS YEAR OF '.date('Y').'</small></h1>';
	$html .='<h1><br><small>FINANCIAL SUMMARY </small></h1>';
	$date = date("Y-m-d");
	$html .='
				<table>
				  <tr>
				  	<td><b>Advance Amount</b></td>
				  	<td><b>Amount Paid</b></td>
				  	<td><b>Balance</b></td>
				  </tr>'; 
				      $amounts = 0;
					    $balances = 0;
					    $paid = 0;					    
					    $all = $con->getRows('advance_requests', array('where'=>'advance_status >=4 and date_approved >="'.$first_date.'" and date_approved <= "'.$last_date.'"'));
					    if(!empty($all)){        
					      foreach($all as $count){
					        $amounts +=$count['amount'];
					        $balances +=$count['balance'];
					        $paid +=$count['total_paid'];
					      }
					    }
				    
				    $html .='
				    <tr> 
				    <td>MK'.number_format($amounts,2,'.',',').'</td>
    				<td>MK'.number_format($paid,2,'.',',').'</td>
    				<td>MK'.number_format($balances,2,'.',',').'</td>
				  </tr>  
				</table>
			';

	$html .='<h1><small>ALL APPROVED REQUESTS </small></h1>';

	$html .='

				<table>
				    <tr>
	    <th><b>Officer</b></th>
	    <th><b>Department</b></th>
	    <th><b>Advance Amount</b></th>
	    <th><b>Amount Paid</b></th>
	    <th><b>Balance</b></th>
	    <th><b>Date</b></th>
				    </tr>';
      
        			$report = $con->getRows('advance_requests a, muscco_members b, departments c', 
               array('where'=>'a.requested_by=b.muscco_member_id and b.department_id=c.department_id and a.advance_status >=4 and a.date_approved >="'.$first_date.'" and a.date_approved <= "'.$last_date.'"','order_by'=>'date_posted desc'));
        if(!empty($report)){
          $i=0;
          foreach($report as $day){ 
            $i++;
      		$html .='
            <tr>              
              <td>
                '.ucwords($day['first_name']).' '.ucwords($day['last_name']).'
              </td>
              <td>'.$day['department'].'</td> 
              <td>MK'.number_format($day['amount'],2,'.',',').'</td> 
              <td>MK'.number_format($day['total_paid'],2,'.',',').'</td> 
              <td>MK'.number_format($day['balance'],2,'.',',').'</td>
              <td>'.$con->shortDate($day['date_approved']).' </td>
            </tr> 
            ';
            }}
            $html .='</table>';
}

//backmarket.com

//custom report
else if($type == "advance_request_custom"){
	$selection = '';
    $first_date = $_GET['date_from'];
    $last_date  = $_GET['date_to'];
    $section = $_GET['officer'];
    $all = '';
    $report = '';
    
    if($section == 'All'){
      $selection = "All Officers";
      $all = $con->getRows('advance_requests', array('where'=>'advance_status >=4 and date_approved >="'.$first_date.'" 
              and date_approved <= "'.$last_date.'"'));
      $report = $con->getRows('advance_requests a, muscco_members b, departments c', 
               array('where'=>'a.requested_by=b.muscco_member_id and b.department_id=c.department_id and a.advance_status >=4 and a.date_approved >="'.$first_date.'" and a.date_approved <= "'.$last_date.'"','order_by'=>'date_posted desc'));
    }else{
      $off = $con->getRows('muscco_members', array('where'=>'muscco_member_id="'.$section.'"', 'return_type'=>'single'));
      $selection = ucwords($off['first_name'])." ".ucwords($off['last_name']);
      $all = $con->getRows('advance_requests', array('where'=>'advance_status >=4 and date_approved >="'.$first_date.'" 
              and date_approved <= "'.$last_date.'" and requested_by="'.$section.'"'));
      $report = $con->getRows('advance_requests a, muscco_members b, departments c', 
               array('where'=>'a.requested_by=b.muscco_member_id and b.department_id=c.department_id and a.advance_status >=4 and a.date_approved >="'.$first_date.'" and a.date_approved <= "'.$last_date.'" and a.requested_by="'.$section.'"','order_by'=>'date_posted desc'));
    }   

	$html .='<h1>ADVANCE REQUEST REPORT  <br><small>ALL REQUEST APPROVED FOR '.$selection.' FROM '.$con->shortDate($first_date).' TO '.$con->shortDate($last_date).'</small></h1>';
	$html .='<h1><br><small>FINANCIAL SUMMARY </small></h1>';
	$date = date("Y-m-d");
	$html .='
				<table>
				  <tr>
				  	<td><b>Advance Amount</b></td>
				  	<td><b>Amount Paid</b></td>
				  	<td><b>Balance</b></td>
				  </tr>'; 
				      $amounts = 0;
					    $balances = 0;
					    $paid = 0;					    
					    if(!empty($all)){        
					      foreach($all as $count){
					        $amounts +=$count['amount'];
					        $balances +=$count['balance'];
					        $paid +=$count['total_paid'];
					      }
					    }
				    
				    $html .='
				    <tr> 
				    <td>MK'.number_format($amounts,2,'.',',').'</td>
    				<td>MK'.number_format($paid,2,'.',',').'</td>
    				<td>MK'.number_format($balances,2,'.',',').'</td>
				  </tr>  
				</table>
			';

	$html .='<h1><small>ALL APPROVED REQUESTS </small></h1>';

	$html .='

				<table>
				    <tr>
	    <th><b>Officer</b></th>
	    <th><b>Department</b></th>
	    <th><b>Advance Amount</b></th>
	    <th><b>Amount Paid</b></th>
	    <th><b>Balance</b></th>
	    <th><b>Date</b></th>
				    </tr>';
      
        if(!empty($report)){
          $i=0;
          foreach($report as $day){ 
            $i++;
      		$html .='
            <tr>              
              <td>
                '.ucwords($day['first_name']).' '.ucwords($day['last_name']).'
              </td>
              <td>'.$day['department'].'</td> 
              <td>MK'.number_format($day['amount'],2,'.',',').'</td> 
              <td>MK'.number_format($day['total_paid'],2,'.',',').'</td> 
              <td>MK'.number_format($day['balance'],2,'.',',').'</td>
              <td>'.$con->shortDate($day['date_approved']).' </td>
            </tr> 
            ';
            }}
            $html .='</table>';
}


/***************************************************************/
// output the HTML content
$pdf->writeHTML($html, true, false, true, false, '');

//Close and output PDF document
$pdf->Output($type.'_'.date('dmyhis').'.pdf', 'I');

//============================================================+
// END OF FILE
//============================================================+
