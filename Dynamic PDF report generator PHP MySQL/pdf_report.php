<?php

include_once ("adodb/adodb.inc.php");
include_once("adodb/adodb-pager.inc.php");
include_once ("fpdf16/fpdf.php");

$conn = &ADONewConnection('mysql');
$conn->Connect('localhost', 'userdbname','userpassword', 'ourdatabase');
$conn->setFetchMode(ADODB_FETCH_ASSOC);


class PDF extends FPDF

 function Footer()
 {
     $date =  date("F j, Y");
     $this->SetY(2);
     $this->SetFont('Arial','I',8);
     $this->Cell(0,1,'Page '.$this->PageNo(),0,0,'C');
     $this->Cell(0,1,'Date '.Date("F j, Y"),0,0,'R');
 }



 function LoadDataContact($sql)
{

global $conn;
$rs=$conn->Execute($sql) or $conn->ErrorMsg();
$data=array();
$num=0;
while (!$rs->EOF){
$row = $rs->GetRowAssoc(false);
$data[$num]["firstname"] =$row["first_name"];
$data[$num]["lastname"] = $row["last_name"];
$data[$num]["email"] = $row["email"];
$day_phone_area_code =  $row["day_phone_area_code"];
$day_phone_prefix = $row["day_phone_prefix"];
$day_phone_number = $row["day_phone_number"];
$data[$num]["day_phone"] = $day_phone_area_code.$day_phone_prefix.$day_phone_number;
$evening_phone_area_code = $row["evening_phone_area_code"];
$evening_phone_prefix = $row["evening_phone_prefix"];
$evening_phone_number = $row["evening_phone_number"];
$data[$num]["evening_phone"] = $evening_phone_area_code.$evening_phone_prefix.$evening_phone_number;
$cell_phone_area_code = $row["cell_phone_area_code"];
$cell_phone_prefix = $row["cell_phone_prefix"];
$cell_phone_number = $row["cell_phone_number"];
$data[$num]["cell_phone"] = $cell_phone_area_code.$cell_phone_prefix.$$cell_phone_number;
$fax_area_code = $row["fax_area_code"];
$fax_number = $row["fax_number"];
$fax_prefix = $row["fax_prefix"];
$data[$num]["fax"] = $fax_area_code.$fax_prefix.$fax_number;
$num++;
$rs->MoveNext();
}
return $data;
}


function DataTableContact($header,$data)
{
    $this->Cell(0,1,'Contacts',0,0,'C');
    $this->Ln();
    $this->SetFillColor(115,167,76);
    $this->SetDrawColor(128,0,0);
    $this->SetLineWidth(.3);

   $w=array(25,25,35,25,25,25,25);

   for($i=0;$i<count($header);$i++)
        $this->Cell($w[$i],7,$header[$i],1,0,'C');
    $this->Ln();

    foreach ($data as $eachResult)
    {
        $this->Cell(25,6,$eachResult["firstname"],'LR',0,'C',1);
        $this->Cell(25,6,$eachResult["lastname"],'LR',0,'C',1);
        $this->Cell(35,6,$eachResult["email"],'LR',0,'C',1);
        $this->Cell(25,6,$eachResult["day_phone"],'LR',0,'C',1);
        $this->Cell(25,6,$eachResult["evening_phone"],'LR',0,'C',1);
        $this->Cell(25,6,$eachResult["cell_phone"],'LR',0,'C',1);
        $this->Cell(25,6,$eachResult["fax"],'LR',0,'C',1);
        $this->Ln();
    }
    $this->Ln();
}
}
 $pdf=new PDF();
$headercontact=array('First Name','Last Name','E-mail','Day Phone','Evening Phone','Cell Phone', 'Fax');


$pdf->SetFont('Arial','',7);
$sql='select * from contacts';
$datacontact=$pdf->LoadDataContact($sql);
$pdf->AddPage();
$pdf->Ln();
$pdf->DataTableContact($headercontact,$datacontact);
$pdf->Output();

?>

