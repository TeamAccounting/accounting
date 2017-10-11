<?php

//============================================================+
// File name   : example_001.php
// Begin       : 2008-03-04
// Last Update : 2013-05-14
//
// Description : Example 001 for TCPDF class
//               Default Header and Footer
//
// Author: Nicola Asuni
//
// (c) Copyright:
//               Nicola Asuni
//               Tecnick.com LTD
//               www.tecnick.com
//               info@tecnick.com
//============================================================+

/**
 * Creates an example PDF TEST document using TCPDF
 * @package com.tecnick.tcpdf
 * @abstract TCPDF - Example: Default Header and Footer
 * @author Nicola Asuni
 * @since 2008-03-04
 */

// Include the main TCPDF library (search for installation path).
require_once('../plugins/TCPDF/tcpdf.php');
//echo "asdas";
// create new PDF document
$pdf = new TCPDF(PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);

// set document information
$pdf->SetCreator(PDF_CREATOR);
//$pdf->SetAuthor('Nicola Asuni');
//$pdf->SetTitle('TCPDF Example 001');
//$pdf->SetSubject('TCPDF Tutorial');
//$pdf->SetKeywords('TCPDF, PDF, example, test, guide');

// set default header data
//$pdf->SetHeaderData(PDF_HEADER_LOGO, PDF_HEADER_LOGO_WIDTH, PDF_HEADER_TITLE.' 001', PDF_HEADER_STRING, array(0,64,255), array(0,64,128));
//$pdf->setFooterData(array(0,64,0), array(0,64,128));

// set header and footer fonts
//$pdf->setHeaderFont(Array(PDF_FONT_NAME_MAIN, '', PDF_FONT_SIZE_MAIN));
//$pdf->setFooterFont(Array(PDF_FONT_NAME_DATA, '', PDF_FONT_SIZE_DATA));

// set default monospaced font
$pdf->SetDefaultMonospacedFont(PDF_FONT_MONOSPACED);

// set margins
//$pdf->SetMargins(PDF_MARGIN_LEFT, PDF_MARGIN_TOP, PDF_MARGIN_RIGHT);
//$pdf->SetHeaderMargin(PDF_MARGIN_HEADER);
//$pdf->SetFooterMargin(PDF_MARGIN_FOOTER);

// set auto page breaks
//$pdf->SetAutoPageBreak(TRUE, PDF_MARGIN_BOTTOM);

// set image scale factor
$pdf->setImageScale(PDF_IMAGE_SCALE_RATIO);

// set some language-dependent strings (optional)
if (@file_exists(dirname(__FILE__).'/lang/eng.php')) {
	require_once(dirname(__FILE__).'/lang/eng.php');
	$pdf->setLanguageArray($l);
}

// ---------------------------------------------------------

// set default font subsetting mode
$pdf->setFontSubsetting(true);

// Set font
// dejavusans is a UTF-8 Unicode font, if you only need to
// print standard ASCII chars, you can use core fonts like
// helvetica or times to reduce file size.
$pdf->SetFont('dejavusans', '', 14, '', true);

// Add a page
// This method has several options, check the source code documentation for more information.
$pdf->AddPage();

// set text shadow effect
//$pdf->setTextShadow(array('enabled'=>true, 'depth_w'=>0.2, 'depth_h'=>0.2, 'color'=>array(196,196,196), 'opacity'=>1, 'blend_mode'=>'Normal'));

// Set some content to print
$html = "
<table id='table' class='table responsive-table table-bordered table-striped'>
			<thead>
				<tr class='tableheader'>
					<th></th>
					<th></th>
					<th></th>
					<th></th>
				</tr>
			</thead>
			<tbody>
				
				<tr>
					<td><b>REVENUE</b></td>
					<td></td>
					<td></td>
					<td></td>
				</tr>"
				
				<?php
				$query = $connection -> myQuery("Select account_name, Sum(amount) as total, date_of_entry From journal_details 
													INNER JOIN accounts on accounts.acc_id = journal_details.account_id
													INNER JOIN journal_entries on journal_entries.journal_entry_no = journal_details.journal_entry_no
													Where (journal_entries.journal_id between $fromdate and $todate) AND (type = 1 OR type = 2) AND (is_debit = 0) 
													group by accounts.account_name"); // QUERY FOR REVENUE
				$total = 0;
				while($row=$query->fetch(PDO::FETCH_ASSOC)){
					$total = $total + $row['total'];
			
				$html.="<tr>
					<td><p style='text-indent:10vh;'><?php echo $row['account_name'];?></td>
					<td><?php echo number_format( $row['total']);?></td>
					<td></td>
					<td></td>
				</tr>"
			
				}
			?>
				<tr>
					<td><p style='text-indent:10vh;'><b>TOTAL REVENUE</b></td>
					<td></td>
					<td><?php echo number_format( $total);?></td>
					<td></td>
				</tr>
			
				
			<tr>
					<td><b>EXPENSES</b></td>
					<td></td>
					<td></td>
					<td></td>
				</tr>
				<?php
			if(isset($_POST['from_date'])&&isset($_POST['to_date'])){
				$query = $connection -> myQuery("Select account_name, Sum(amount) as total, date_of_entry From journal_details 
													INNER JOIN accounts on accounts.acc_id = journal_details.account_id
													INNER JOIN journal_entries on journal_entries.journal_entry_no = journal_details.journal_entry_no
													Where (journal_entries.journal_id between $fromdate and $todate) AND (type = 3) AND (is_debit = 1) 
													group by accounts.account_name"); // QUERY FOR EXPENSES
				$totalExpense = 0;
				while($row=$query->fetch(PDO::FETCH_ASSOC)){
					$totalExpense = $totalExpense + $row['total'];
			?>
				<tr>
					<td><p style='text-indent:10vh;'><?php echo $row['account_name'];?></td>
					<td><?php echo number_format($row['total']);?></td>
					<td></td>
					<td></td>
				</tr>
			<?php
				}
			?>
				<tr>
					<td><p style='text-indent:10vh;'><b>TOTAL EXPENSES</b></td>
					<td></td>
					<td><?php echo number_format( $totalExpense);?></td>
					<td></td>
				</tr>
			<?php	
			}
			?>
			
			<tr>
				<td><b>NET INCOME</b></td>
				<td></td>
				<td></td>
				<td><?php echo $total - $totalExpense;?></td>
			</tr>
			
			<?php	
			}
			?>
				
					
			</tbody>
		</table>


// Print text using writeHTMLCell()
$pdf->writeHTMLCell(0, 0, '', '', $html, 0, 1, 0, true, '', true);

// ---------------------------------------------------------
  ob_end_clean();
// Close and output PDF document
// This method has several options, check the source code documentation for more information.
$pdf->Output('C:\xampp\htdocs\SGTSI_AccountingSystem\plugins\TCPDF\examples\L.pdf', 'I');

//============================================================+
// END OF FILE
//============================================================+
