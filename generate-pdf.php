<?php
include_once('settings/master-class.php');
$con = new MasterClass;

$type = '';
if(isset($_GET['type'])){
	$type = $_GET['type'];
}

// Include the main TCPDF library (search for installation path).
require_once('tcpdf_include.php');

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
		}

		table tr{
			box-sizing: border-box;
		}

		table td{
			  padding: 15px;
			  vertical-align: top;
			  height: 20px;
		}
	</style>
';

/**************registered sacco************************/
if($type == 'sacco_list'){
	 $html .='<h1>REGISTERED SACCO</h1>';
	 $query = $con->getRows('sacco', array('order_by'=>'sacco_name'));
        if(!empty($query)){
            $i = 0;
            $html .='
			<table border="1">

			 <tr>	 
			  <td width="5%"><b>#</b></td>
			  <td width="20%"><b>Sacco Name</b></td>
			  <td width="15%"> <b>Sacco President</b></td>
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

/************ petty cash *****************/
if($type == 'petty_cash_details'){
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

//leave application request
if($type == 'leave_application_details'){
	 $html .='<h1>LEAVE APPLICATION REQUEST<br><small>'.date('d M, Y').'</small></h1>';
	 $row = $con->getRows('leave_applications a, leave_fy b, leave_types c, muscco_members d, positions e',
                    array('where'=>'a.application_id="'.$_GET['request_id'].'" and a.member_id=d.muscco_member_id 
                    	   and a.fy_id=b.fy_id and a.leave_type=c.type_id and d.position_id=e.position_id', 'return_type'=>'single'));
	
 	// define some HTML content with style
	$html .='<h1 style="padding:0px; margin:0px; float:left; text-align:left;"><br><small>LEAVE APPLICATION DETAILS</small></h1>';
	$html .= '
			<table border="1">
                <tr>
                  <th><b>Leave #</b></th>
                  <td>'.sprintf('%04d',$row['application_id']).'</td>
                  <th><b>Employee #</b></th>
                  <td>'.$row['employee_id'].'</td>
                </tr>  
                <tr>
                  <th><b>Employee Name</b></th>
                  <td>'.ucwords($row['first_name'])." ".ucwords($row['last_name']).'</td>
                  <th><b>Position</b></th>
                  <td>'.$row['position'].'</td>
                </tr>  
                <tr>
                  <th><b>Leave Type</b></th>
                  <td>'.$row['name'].'</td>
                  <th><b>Financial Year</b></th>
                  <td>'.$row['fy'].'</td>
                </tr>
                <tr>
                  <th><b>Status</b></th>
                  <td>';
                    switch ($row['leave_status']) {
                      case 0:
                        $html .='<span class="mb-1 badge rounded-pill bg-primary">Pending</span>';
                        break;
                      case 1:
                        $html .='<span class="mb-1 badge rounded-pill bg-info">Checked</span>';
                        break;
                      case 2:
                        $html .='<span class="mb-1 badge rounded-pill bg-warning">Verified</span>';
                        break;
                      
                      case 3:
                        $html .='<span class="mb-1 badge rounded-pill bg-success">Approved</span>';
                        break;

                      case 4:
                        $html .='<span class="mb-1 badge rounded-pill bg-danger">Declined</span>';
                        break;
                    }
                  $html .='
                  </td>
                  <th><b>Leave Days</b></th>
                  <td>'.$row['leave_days'].'</td>
                </tr>
                <tr>
                  <th><b>Date Start</b></th>
                  <td>'.$con->shortDate($row['date_start']).'</td>
                  <th><b>Date End</b></th>
                  <td>'.$con->shortDate($row['date_end']).'</td>
                  
                </tr>
                
                <tr>
                  
                  <th><b>Leave Grant</b></th>
                  <td>'.$row['leave_grant'].'</td>

                  <th><b>On Roaster?</b></th>
                  <td>'.$row['leave_roaster'].'</td>
                </tr>
                <tr>
                  <th><b>Date Applied</b></th>
                  <td>'.$con->shortDate($row['date_requested']).'</td>
                  <th><b>Reasons</b></th>
                  <td>'.$row['reason'].'</td>
                </tr>
              </table>	        
		';
		$html .='<h1 style="padding:0px; margin:0px; float:left; text-align:left;"><br><small>AUTHORIZATION</small></h1>';
		$html .= '
			<table border="1">
              <tbody class="border-top">
              ';  
                  $checker = $con->getRows('leave_applications a, muscco_members b', array('where'=>'a.checked_by=b.muscco_member_id and a.application_id="'.$_GET['request_id'].'"','return_type'=>'single'));
                    if(!empty($checker)){
               
                $html .='
                <tr>
                	<td colspan="3"><b>Checked By</b></td>
                </tr>
                <tr>
                	<td><b>Name</b></td>
                	<td><b>Remarks</b></td>
                	<td><b>Date</b></td>
                </tr>
                <tr>
                  <td>'.ucwords($checker['first_name'])." ".ucwords($checker['last_name']).'</td>
                  <td>'.$checker['check_reasons'].'</td>
                  <td>'.$con->shortDate($row['date_checked']).'
                  </td>
                </tr>';
                }  
                  $verify = $con->getRows('leave_applications a, muscco_members b', array('where'=>'a.verified_by=b.muscco_member_id and a.application_id="'.$_GET['request_id'].'"','return_type'=>'single'));
                    if(!empty($verify)){
                $html .='<tr>
                	<td colspan="3"></td>
                </tr>
                <tr>
                	<td colspan="3"><b>Verified By</b></td>
                </tr>
                <tr>
                	<td><b>Name</b></td>
                	<td><b>Remarks</b></td>
                	<td><b>Date</b></td>
                </tr>
                <tr>
                  <td>'.ucwords($verify['first_name'])." ".ucwords($verify['last_name']).'
                  </td>
                  <td>'.$checker['verify_reasons'].'</td>
                  <td>
                    <span>'.$con->shortDate($row['date_verified']).'</span>
                  </td>
                </tr>
                ';}
                 
                  $approve = $con->getRows('leave_applications a, muscco_members b', array('where'=>'a.approved_by=b.muscco_member_id and a.application_id="'.$_GET['request_id'].'"','return_type'=>'single'));
                    if(!empty($approve)){
                $html .='
                <tr>
                	<td colspan="3"></td>
                </tr>
                <tr>
                	<td colspan="3"><b>Approved By</b></td>
                </tr>
                <tr>
                	<td><b>Name</b></td>
                	<td><b>Remarks</b></td>
                	<td><b>Date</b></td>
                </tr>
                <tr>
                  <td class="ps-0">'.ucwords($approve['first_name'])." ".ucwords($approve['last_name']).'</td>
                  <td>'.$approve['approve_reasons'].'</td>
                  <td>'.$con->shortDate($row['date_approved']).'
                  </td>
                </tr>';
                } 
                 
                  $decline = $con->getRows('leave_applications a, muscco_members b', array('where'=>'a.declined_by=b.muscco_member_id and a.application_id="'.$_GET['request_id'].'"','return_type'=>'single'));
                    if(!empty($decline)){
                $html .='
                <tr>
                	<td colspan="3"></td>
                </tr>
                <tr>
                	<td colspan="3"><b>Declined By</b></td>
                </tr>
                <tr>
                	<td><b>Name</b></td>
                	<td><b>Remarks</b></td>
                	<td><b>Date</b></td>
                </tr>
                <tr>
                  <td class="ps-0">'.ucwords($decline['first_name'])." ".ucwords($decline['last_name']).'</td>
                  <td>'.$decline['decline_reason'].'</td>
                  <td>'.$con->shortDate($decline['date_declined']).'
                  </td>
                </tr>';
               } 
              $html .='</tbody>
            </table>
		';
	 
}

//travel advance request
if($type == 'travel_advance_details'){
	 $html .='<h1>TRAVEL ADVANCE REQUEST <br><small>'.date('d M, Y').'</small></h1>';
	 $row = $con->getRows('travel_advance_request a, pillars c, muscco_members b, departments d, band_rates e',
                        array('where'=>'a.travel_advance_id="'.$_GET['request_id'].'" and a.employee_id=b.muscco_member_id and a.pillar=c.pillar_id and b.department_id=d.department_id and b.band_id=e.band_id', 'return_type'=>'single'));
	 $logistics = '';
	 $checker_name = '';
	 $date_checked = '';
	 $approver_name = '';
	 $date_approved = '';
	 $approver_note = '';
	 $logistic = '';
	 $nights = '';
	 $allowances = '';
	 $rates = '';

	 $allowances = ($row['rate']*$row['nights']) + $row['day_meal'] + ($row['own_days']*$row['own_rate']);

	 if($row['logistics'] == 4){
      $days = $row['nights'] + $row['own_days'];
      $nights = $days.' ('.$row['nights'].' <small>Accomodated</small> / '.$row['own_days'].' <small>Own Accomodation</small>)';
      $rates = 'MK'.number_format($row['rate'], 2, '.',',').' <small>Accomodated</small><br/>MK'.number_format($row['own_rate'], 2, '.',',').' <small>Own Accomodation</small>';
    }else{
      $nights = $row['nights'];
      $rates = 'MK'.number_format($row['rate'], 2, '.',',');
    }

	 if(!empty($row)){
	 	$approver_note = $row['approver_note'];
	 	$logistic = $row['logistics'];
	 }
	 
	 if($logistic == 1){
	      $logistics = "Accomodated";
	    }else if($logistic == 2){
	      $logistics = "Look for own Accomodation";
	    }else if($logistic == 3){
	      $logistics = "One Day Return";
	    }else if($logistic == 4){
	      $logistics = "Accomodated / Own Accomodation";
	    }

	    $checker = $con->getRows('travel_advance_request a, muscco_members b',
                        array('where'=>'a.travel_advance_id="'.$_GET['request_id'].'" and a.checked_by=b.muscco_member_id', 'return_type'=>'single'));
	    if(!empty($checker)){
	    	$checker_name = ucwords($checker['first_name']).' '.ucwords($checker['last_name']);
	    	$date_checked = $con->shortDate($row['date_checked']);
	    }
	    $authorizer = $con->getRows('travel_advance_request a, muscco_members b',
                        array('where'=>'a.travel_advance_id="'.$_GET['request_id'].'" and a.approved_by=b.muscco_member_id', 'return_type'=>'single'));
	    if(!empty($authorizer)){
	    	$approver_name = ucwords($authorizer['first_name']).' '.ucwords($authorizer['last_name']);
	    	$date_approved = $con->shortDate($row['date_approved']);
	    }
 	// define some HTML content with style
	$html .='<h1 style="padding:0px; margin:0px; float:left; text-align:left;"><br><small>PEOPLE TRAVELLING </small></h1>';
	$html .= '
		<table border="1">
	        <tr>
				<td><b>Officer</b></td>
	            <td><b>Department</b></td>
	            <td><b>Band</b></td>	            
	        </tr>
	        <tr>	        	
	            <td><p>'.ucwords($row['first_name']).' '.ucwords($row['last_name']).'</p></td>
	            <td>'.$row['department'].'</td>
	            <td>'.$row['band_title'].'</td>				
	        </tr>
	        </table>
	        <br/><br/>
	        <table border="1">
		        <tr>
					<td><b>Pillar/Activity</b></td>
		            <td><b>Purpose</b></td>
		            <td><b>Logistics</b></td>	            
		        </tr>
		        <tr>	        	
		            <td><p>'.$row['pillar'].' </p></td>
		            <td>'.$row['purpose'].'</td>
		            <td>'.$logistics.'</td>				
		        </tr>
	        </table>
	         <h1 style="padding:0px; margin:0px; float:left; text-align:left;"><br><small>DAILY ITINERARY</small></h1>
	         <table border="1">
		        <tr>
					<td><b>Date</b></td>
		            <td><b>From</b></td>
		            <td><b>To</b></td>	            
		        </tr>';
		        	$daily = $con->getRows('daily_itinerary', array('where'=>'travel_advance_id="'.$_GET['request_id'].'"','order_by'=>'daily_id asc'));
		        	if(!empty($daily)){
		        		foreach($daily as $d){
		        			$html .='<tr><td><p>'.$con->shortDate($d['date']).' </p></td>
					            <td>'.$d['place_from'].'</td>
					            <td>'.$d['place_to'].'</td></tr>';
		        		}
		        	}

		            $liters = $row['mileage']/10;	
		            $html .='
	        </table>
	        <h1 style="padding:0px; margin:0px; float:left; text-align:left;"><br><small>BUDGET</small></h1>
	        <table border="1">
		        <tr>
								<td><b>Nights</b></td>
		            <td><b>Rate/Night</b></td>
		            <td><b>Day Allowance</b></td>            
		        </tr>
		        <tr>	        	
		            <td><p>'.$nights.' </p></td>
		            <td>'.$rates.'</td>
		            <td>MK'.number_format($row['day_meal'], 2, '.',',').'</td>				
		            				
		        </tr>
		        <tr>
		            <td><b>Total Allowance</b></td>	
		            <td><b>Tollgate Fees</b></td>	
								<td><b>Mileage</b></td>           
		        </tr>
		        ';
		        $f = ''; //fuel
		        $fp = 0;
		        if(!empty($row['fuel_price'])){
		        	$fp = $row['fuel_price'];
		        }
		        $fuel = $con->getRows('fuel_prices', array('where'=>'fuel_id="'.$row['fuel'].'"','return_type'=>'single')); if(!empty($fuel)){ $f= $fuel['fuel'];}else{$f= "-";}
		        $html .='
		        <tr>
		        		<td>MK'.number_format($allowances, 2, '.',',').'</td>	        	
		            <td><p>MK'.number_format($row['tollgate_fees'], 2, '.',',').'</p></td>
		            <td><p>'.$row['mileage'].' KMs</p></td>		
		        </tr>

		        <tr>
		            
		            <td><b>Fuel</b></td> 
		            <td><b>Rate/Litre</b></td>
		            <td><b>Total Fuel</b></td>	
		            	            
		        </tr>
		        <tr>		        		
		            <td>'.$f.' ('.$liters.'Ltrs)</td>		        
		            <td>MK'.number_format($fp, 2, '.',',').'</td>				
		            <td>MK'.number_format($row['total_fuel'], 2, '.',',').'</td>					
		        </tr>
		        <tr>
		        	<td></td>
		        	<td></td>
		        	<td><b>Total Budget</b></td>
		        </tr>
		        <tr>
		        	<td></td>
		        	<td></td>
		        	<td>MK'.number_format($row['total_budget'], 2, '.',',').'</td>
		        </tr>
	        </table>

	        <h1 style="padding:0px; margin:0px; float:left; text-align:left;"><br><small>AUTHORIZATION</small></h1>
	        <table border="1">
	        <tr>
	            <td><b>Approved By</b></td>	            
	            <td><b>Date</b></td>	            
	            <td colspan="2"><b>Approver Remarks</b></td>	            
	        </tr>
	        <tr>	        	
	            <td><p>'.$approver_name.'</p></td>
	            <td>'.$date_approved.'</td>				
	            <td colspan="2">'.$approver_note.'</td>				
	        </tr>
	        </table>
	        
		';
	 
}

//travel advance request liquidation
if($type == 'travel_advance_liquidation'){
	 $html .='<h1>TRAVEL ADVANCE LIQUIDATION <br><small>'.date('d M, Y').'</small></h1>';
	 $row = $con->getRows('travel_advance_request a, pillars c, muscco_members b, departments d, band_rates e, fuel_prices f, travel_advance_liquidations g',
                        array('where'=>'a.travel_advance_id=g.travel_advance_id and g.liquidation_id="'.$_GET['request_id'].'" and a.employee_id=b.muscco_member_id and a.pillar=c.pillar_id and b.department_id=d.department_id and b.band_id=e.band_id and a.fuel=f.fuel_id', 'return_type'=>'single'));
	 $logistics = '';
	 $checker_name = '';
	 $date_checked = '';
	 $approver_name = '';
	 $date_approved = '';
	 $approver_note = '';
	 if($row['logistics'] == 1){
	      $logistics = "Accomodated";
	    }else if($row['logistics'] == 2){
	      $logistics = "Look for own Accomodation";
	    }else if($row['logistics'] == 3){
	      $logistics = "One Day Return";
	    }
	    
	    $authorizer = $con->getRows('travel_advance_liquidations a, muscco_members b',
                        array('where'=>'a.liquidation_id="'.$_GET['request_id'].'" and a.liq_approved_by=b.muscco_member_id', 'return_type'=>'single'));
	    if(!empty($authorizer)){
	    	$approver_name = ucwords($authorizer['first_name']).' '.ucwords($authorizer['last_name']);
	    	$date_approved = $con->shortDate($authorizer['liq_date_approved']);
	    	$approver_note = $authorizer['liq_approval_remarks'];
	    }
 	// define some HTML content with style
	$html .='<h1 style="padding:0px; margin:0px; float:left; text-align:left;"><br><small>PEOPLE TRAVELLING </small></h1>';
	$html .= '
		<table border="1">
	        <tr>
				<td><b>Officer</b></td>
	            <td><b>Department</b></td>
	            <td><b>Band</b></td>	            
	        </tr>
	        <tr>	        	
	            <td><p>'.ucwords($row['first_name']).' '.ucwords($row['last_name']).'</p></td>
	            <td>'.$row['department'].'</td>
	            <td>'.$row['band_title'].'</td>				
	        </tr>
	        </table>
	        <br/><br/>
	        <table border="1">
		        <tr>
					<td><b>Pillar/Activity</b></td>
		            <td><b>Purpose</b></td>
		            <td><b>Logistics</b></td>	            
		        </tr>
		        <tr>	        	
		            <td><p>'.$row['pillar'].' </p></td>
		            <td>'.$row['purpose'].'</td>
		            <td>'.$logistics.'</td>				
		        </tr>
	        </table>
	         <h1 style="padding:0px; margin:0px; float:left; text-align:left;"><br><small>DAILY ITINERARY</small></h1>
	         <table border="1">
		        <tr>
					<td><b>Date</b></td>
		            <td><b>From</b></td>
		            <td><b>To</b></td>	            
		        </tr>';
		        	$daily = $con->getRows('daily_itinerary', array('where'=>'travel_advance_id="'.$row['travel_advance_id'].'"','order_by'=>'daily_id asc'));
		        	if(!empty($daily)){
		        		foreach($daily as $d){
		        			$html .='<tr><td><p>'.$con->shortDate($d['date']).' </p></td>
					            <td>'.$d['place_from'].'</td>
					            <td>'.$d['place_to'].'</td></tr>';
		        		}
		        	}

		            $liters = $row['mileage']/10;	
		            $liters_2 = $row['liq_mileage']/10;	
 		            $html .='
	        </table>
	        <h1 style="padding:0px; margin:0px; float:left; text-align:left;"><br><small>BUDGET</small></h1>
	        <table border="1">
		        <tr>
		        		<td></td>
								<td colspan="2"><b>Budget</b></td>
		            <td colspan="2"><b>Actuals</b></td>            
		        </tr>
		        <tr>
		        		<td></td>
								<td><b>QTY</b></td>
		            <td><b>Expenditure</b></td>
		            <td><b>QTY</b></td>
		            <td><b>Expenditure</b></td>            
		        </tr>
		        <tr>
		        		<td><b>Accomodation</b></td>	        	
		            <td><p>'.$row['nights'].' </p></td>
		            <td>MK'.number_format($row['rate']*$row['nights'], 2, '.',',').'</td>
		            <td>'.$row['liq_nights'].'</td>				
		            <td>MK'.number_format(($row['rate']*$row['liq_nights']), 2, '.',',').'</td>				
		        </tr>
		        <tr>	
		        		<td><b>Fuel</b></td>        	
		            <td><p>'.$row['fuel'].' ('.$liters.'Ltrs)</p></td>
		            <td>MK'.number_format($row['total_fuel'], 2, '.',',').'</td>
		            <td>'.$row['fuel'].' ('.$liters_2.'Ltrs)</td>				
		            <td>MK'.number_format($row['fuel_price']*$liters_2, 2, '.',',').'</td>				
		        </tr>

		        <tr>
		        		<td><b>Other Expenses</b></td>
								<td>-</td>
		            <td>-</td>
		            <td>'.$row['liq_other'].'</td>
		            <td>MK'.number_format($row['liq_other_amount'], 2, '.',',').'</td>	            
		        </tr>
		        <tr>
		        		<td><b>Day Allowance</b></td>	        	
		            <td>-</td>
		            <td>MK'.number_format($row['liq_day_meal'], 2, '.',',').'</td>
		            <td>-</td>				
		            <td>MK'.number_format($row['liq_day_meal'], 2, '.',',').'</td>				
		        </tr>
		        <tr>
		        		<td><b>Grand Total</b></td>	        	
		            <td>-</td>
		            <td>MK'.number_format($row['total_budget'], 2, '.',',').'</td>
		            <td>-</td>				
		            <td>MK'.number_format($row['total_liquidation'], 2, '.',',').'</td>				
		        </tr>
		        <tr>
		        		<td><b>Cash returned</b></td>	        	
		            <td>-</td>
		            <td>-</td>
		            <td>-</td>				
		            <td>MK'.number_format($row['balance_overage'], 2, '.',',').'</td>				
		        </tr>
		        <tr>
		        		<td colspan="5"><i>Balance due to MUSCCO (+) / Refunds to Employee (-)</i></td>	 			
		        </tr>
	        </table>

	        <h1 style="padding:0px; margin:0px; float:left; text-align:left;"><br><small>AUTHORIZATION</small></h1>
	        <table border="1">
	        <tr>
	            <td><b>Approved By</b></td>	            
	            <td><b>Date</b></td>	            
	            <td colspan="2"><b>Approver Remarks</b></td>	            
	        </tr>
	        <tr>	        	
	            <td><p>'.$approver_name.'</p></td>
	            <td>'.$date_approved.'</td>				
	            <td colspan="2">'.$approver_note.'</td>				
	        </tr>
	        </table>
	        
		';
	 
}

//custom issue
if($type == 'advance_details'){
	 $html .= '<h1>MUSCCO STAFF PERSONAL ADVANCE REQUEST<br><small>'.date('d M, Y').'</small></h1>';
	 $html .='<h1 style="padding:0px; margin:0px; float:left; text-align:left;"><br><small>ADVANCE DETAILS</small></h1>';
	 $advance = $con->getRows('advance_requests a, muscco_members b, positions c',
                  array('where'=>'a.requested_by=b.muscco_member_id and a.advance_id="'.$_GET['advance_id'].'" and b.position_id=c.position_id','return_type'=>'single'));

	 $html .= '
	 						<table border="1">
                <tr>
                	<th><b>Advance #</b></th>
                  <td>'.sprintf('%04d',$advance['advance_id']).'</td>
                  <th><b>Employee #</b></th>
                  <td>'.$advance['employee_id'].'</td>
                </tr>
                <tr>
                  <th><b>Employee Name</b></th>
                  <td>'.ucwords($advance['first_name'])." ".ucwords($advance['last_name']).'</td>
                  <th><b>Position</b></th>
                  <td>'.$advance['position'].'</td>
                </tr>  
                <tr>
                  <th><b>Advance Amount</b></th>
                  <td>MK'.number_format($advance['amount'],2,'.',',').'</td>
                  <th><b>Monthly Installment</b></th>
                  <td>MK'.number_format($advance['monthly_installment'],2,'.',',').'</td>
                </tr>
                <tr>
                  <th><b>Start Installment</b></th>
                  <td>'.$con->monthYear($advance['start']).'</td>
                  <th><b>End Installment</b></th>
                  <td>'.$con->monthYear($advance['end']).'</td>
                </tr>
                <tr>
                  <th><b>Number of Months</b></th>
                  <td>'.$advance['months'].'</td>
                  <th><b>Status</b></th>
                  <td>'; switch ($advance['advance_status']) {
                              case 0:
                                $html .='<span class="mb-1 badge rounded-pill bg-primary">Pending</span>';
                                break;
                              case 1:
                                $html .='<span class="mb-1 badge rounded-pill bg-info">Checked</span>';
                                break;
                              case 2:
                                $html .='<span class="mb-1 badge rounded-pill bg-danger">Declined</span>';
                                break;
                              case 3:
                                $html .='<span class="mb-1 badge rounded-pill bg-warning">Verified</span>';
                                break;
                              case 4:
                                $html .='<span class="mb-1 badge rounded-pill bg-success">Approved</span>';
                                break;
                              case 5:
                                $html .='<span class="mb-1 badge rounded-pill bg-success">Paid</span>';
                                break;
                            }
                  $html .='
                  </td>
                </tr>
                <tr>
                  <th><b>Date Posted</b></th>
                  <td>'.$con->shortDate($advance['date_posted']).'</td>
                  <th><b>Purpose</b></th>
                  <td>'.$advance['purpose'].'</td>
                </tr>
                </table>';
                $html .='<h1 style="padding:0px; margin:0px; float:left; text-align:left;"><br><small>AUTHORIZATION</small></h1>';
                $verify = $con->getRows('muscco_members', array('where'=>'muscco_member_id="'.$advance['verified_by'].'"',
                												'return_type'=>'single'));
                $checker = $con->getRows('muscco_members', array('where'=>'muscco_member_id="'.$advance['supervised_by'].'"',
                												'return_type'=>'single'));
                $approver = $con->getRows('muscco_members', array('where'=>'muscco_member_id="'.$advance['approved_by'].'"',
                												'return_type'=>'single'));
                $html .='
                			<table border="1">
                			';
                			if(!empty($verify)){
                			$html .='
                				<tr><td colspan="3">Supervisor’s comment and recommendation </td></tr>
                				<tr>
                					<td><b>Checked By</b></td>
                					<td><b>Date</b></td>
                					<td><b>Comments</b></td>
                				</tr>
                				<tr>
                					<td>'.ucwords($verify['first_name']).' '.ucwords($verify['last_name']).'</td>
                					<td>'.$con->shortDate($advance['verified_date']).'</td>
                					<td>'.$advance['verified_comment'].'</td>
                				</tr>
                				';
                			}

                			if(!empty($checker)){
                			$html .='
                				<tr><td colspan="3"></td></tr>
                				<tr><td colspan="3"> Accountant’s verification and comments on the status of previous advances</td></tr>
                				<tr>
                					<td><b>Verified by</b></td>
                					<td><b>Date</b></td>
                					<td><b>Comments</b></td>
                				</tr>
                				<tr>
                					<td>'.ucwords($checker['first_name']).' '.ucwords($checker['last_name']).'</td>
                					<td>'.$con->shortDate($advance['date_supervised']).'</td>
                					<td>'.$advance['supervisor_comment'].'</td>
                				</tr>
                				<tr><td colspan="3"></td></tr>
                				';
                			}
                			if(!empty($approver)){
                			$html .='
                				<tr><td colspan="3">CE’s comment and recommendation</td></tr>
                				<tr>
                					<td><b>Approved by</b></td>
                					<td><b>Date</b></td>
                					<td><b>Comments</b></td>
                				</tr>
                				<tr>
                					<td>'.ucwords($approver['first_name']).' '.ucwords($approver['last_name']).'</td>
                					<td>'.$con->shortDate($advance['date_approved']).'</td>
                					<td>'.$advance['approval_remark'].'</td>
                				</tr>
                				';
                			}

                $html .='

              </table>
	 					';

}




// output the HTML content
$pdf->writeHTML($html, true, false, true, false, '');

//Close and output PDF document
$pdf->Output($type.'_'.date('dmyhis').'.pdf', 'I');

//============================================================+
// END OF FILE
//============================================================+
