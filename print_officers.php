<?php
//set font to arial, bold, 14pt
include_once 'dbconnector.php';
	 $logdate = date("Y-m-d");
	 $logtime = date("h:i:s");


require('mc_table.php');

function GenerateWord()
{
    //Get a random word
    $nb=rand(3,10);
    $w='';
    for($i=1;$i<=$nb;$i++)
        $w.=chr(rand(ord('a'),ord('z')));
    return $w;
}

function GenerateSentence()
{
    //Get a random sentence
    $nb=rand(1,10);
    $s='';
    for($i=1;$i<=$nb;$i++)
        $s.=GenerateWord().' ';
    return substr($s,0,-1);
}

$pdf=new PDF_MC_Table();
	

	$pdf->AddPage('o');
	

$pdf->SetFont('Arial','B',12);
$pdf->Ln(25);
$pdf->Write(5,"Date:" . $logdate);
$pdf->Ln(5);
$pdf->Write(5,"Time:" . $logtime);
$pdf->Ln(5);
$pdf->Write(5,"Prepared by: Juan Santos Dela Cruz");
$pdf->Ln(10);
$pdf->Image('headerstats.jpg',0,0,300,);
$pdf->Cell(100 ,5,'List Of Police Officers',0,1);
//invoice contents
$pdf->SetFont('Arial','B',7);
$pdf->SetWidths(array(30,100,100,50,10,22,15,20,23));
$pdf->Row(array('ID','Police Officer Name','Station Name','Position'));
$pdf->SetFont('Arial','',7);
$sql = "SELECT *,a.c_no as officer_id FROM `tbl_officer` as a left join tbl_stations as b on a.station_id = b.c_no";
$result = $conn->query($sql);
while ($row = $result->fetch_assoc()) {
	$pdf->Row(array($row['officer_id'],$row['lastname'] . ", " . $row['firstname'] . " " . $row['middlename'],$row['police_station_name'],$row['position']));
}

$pdf->Output();
?>