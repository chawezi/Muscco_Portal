<?php

// Include the main TCPDF library (search for installation path).
require_once('tcpdf_include.php');

// create new PDF document
$pdf = new TCPDF(PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);

// set document information
$pdf->setCreator(PDF_CREATOR);
$pdf->setAuthor('Nicola Asuni');
$pdf->setTitle('Malawi Council for the Handicapped(MACOHA)');
$pdf->setSubject('Stores Report');
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
$pdf->setFont('helvetica', '', 10);

// add a page
$pdf->AddPage();

// define some HTML content with style
$html = <<<EOF
<!-- EXAMPLE OF CSS STYLE -->
<style>
	h1 {
		color: navy;
		font-family: times;
		font-size: 16pt;
		text-decoration: underline;
		text-align:center;
	}
	table{
		clear: both;
		margin-top: 6px !important;
		margin-bottom: 6px !important;
		max-width: none !important;
		border-collapse: separate !important;
		border: 1px solid #ccc;
		width:100%;
	}

	table tr{
		box-sizing: border-box;
	}

	table td{
		  border-bottom-width: 0;
		  border: 1px solid #ccc;

		  padding: .3rem;
		  padding: .75rem;
		  vertical-align: top;
	}
</style>

<h1 class="title">REPORT FOR THE MONTH OF APRIL, 2023</h1>


<table>

 <tr>
  <td width="5%" height="20" align="center"><b>#</b></td>
  <td width="30%" align="center"><b>Product</b></td>
  <td width="8%" align="center"><b>QTY</b></td>
  <td width="10%" align="center"> <b>Color</b></td>
  <td width="10%" align="center"><b>Size</b></td>
  <td width="15%" align="center"><b>Unit Price</b></td>
  <td width="15%" align="center"><b>Total</b></td>
  <td width="7%" align="center"><b>Date</b></td>
 </tr>

 
</table>
EOF;

// output the HTML content
$pdf->writeHTML($html, true, false, true, false, '');

//Close and output PDF document
$pdf->Output('example_061.pdf', 'I');

//============================================================+
// END OF FILE
//============================================================+
