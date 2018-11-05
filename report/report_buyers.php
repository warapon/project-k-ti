<html>
<head>
    <title>ฐานข้อมูลผู้ผลิตผลไม้จังหวัดสุราษฎร์ธานี</title>
</head>
<body>
<?php
function DateThaiasss($strDate)
{
    $strYear = date("Y", strtotime($strDate)) + 543;
    $strMonth = date("n", strtotime($strDate));
    $strMonthCut = Array("", "มกราคม", "กุมภาพันธ์", "มีนาคม.", "เมษายน", "พฤษภาคม", "มิถุนายน.", "กรกฏาคม", "สิงหาคม", "กันยายน", "ตุลาคม", "พฤษศจิกายน", "ธันวาคม");
    $strMonthThai = $strMonthCut[$strMonth];
    return "$strMonthThai $strYear";
}

date_default_timezone_set('Asia/Bangkok');

require('fpdf.php');
$db = new PDO('mysql:host=localhost;dbname=agricultural','root','');
$db->query("set NAMES'UTF8'");
define('FPDF_FONTPATH','font/');

class PDF extends FPDF
{
    function Header(){

        $this->AddFont('angsa','','angsa.php');
        $this->SetFont('angsa','',22);
        $this->Cell(0,10,iconv( 'UTF-8','TIS-620','ฐานข้อมูลผู้ผลิตผลไม้จังหวัดสุราษฎร์ธานี'),0,1,"C");
        $this->SetFont('angsa','',18);
        $this->Cell(0,10,iconv( 'UTF-8','TIS-620','ข้อมูลผู้ซื้อ'),0,1,"C");
    }

    function Footer(){
        $this->AddFont('angsa','','angsa.php');
        $this->SetFont('angsa','',13);
        $this->SetY(-16);
        $this->Cell(0,10,iconv( 'UTF-8','TIS-620','   หน้า '.$this->PageNo()),0,1,"R");
    }


    function headerTable(){
        $this->AddFont('angsa','','angsa.php');
        $this->SetFont('angsa','',15);
        $this->Cell(15,10,iconv( 'UTF-8','TIS-620','ลำดับ'),1,0,'C');
        $this->Cell(45,10,iconv( 'UTF-8','TIS-620','ชื่อ-สกุล'),1,0,'C');
        $this->Cell(45,10,iconv( 'UTF-8','TIS-620','ชื่อบริษัท'),1,0,'C');
        $this->Cell(20,10,iconv( 'UTF-8','TIS-620','ที่อยู่เลขที่'),1,0,'C');
        $this->Cell(10,10,iconv( 'UTF-8','TIS-620','หมู่'),1,0,'C');
        $this->Cell(27,10,iconv( 'UTF-8','TIS-620','ตำบล'),1,0,'C');
        $this->Cell(27,10,iconv( 'UTF-8','TIS-620','อำเภอ'),1,0,'C');
        $this->Cell(30,10,iconv( 'UTF-8','TIS-620','จังหวัด'),1,0,'C');
        $this->Cell(25,10,iconv( 'UTF-8','TIS-620','เบอร์โทรศัพท์'),1,0,'C');
        $this->Cell(45,10,iconv( 'UTF-8','TIS-620','อีเมล์'),1,0,'C');
        $this->Ln();
    }
    function viewTable($db){
//        $month=$_POST["month"];
        $this->AddFont('angsa','','angsa.php');
        $this->SetFont('angsa','',15);
        $stmt = $db->query("SELECT * FROM `buyers` ORDER BY by_id DESC");
        $num=1;
        while($data = $stmt->fetch(PDO::FETCH_OBJ)){
            $this->Cell(15,10,$num,1,0,'C');
            $this->Cell(45,10,iconv( 'UTF-8','TIS-620',$data->by_prefix.$data->by_name."   ".$data->by_lastname),1,0,'L');
            $this->Cell(45,10,iconv( 'UTF-8','TIS-620',$data->by_company),1,0,'L');
            $this->Cell(20,10,iconv( 'UTF-8','TIS-620',$data->by_addass_number),1,0,'L');
            $this->Cell(10,10,iconv( 'UTF-8','TIS-620',$data->by_m),1,0,'L');
            $this->Cell(27,10,iconv( 'UTF-8','TIS-620',$data->by_district),1,0,'L');
            $this->Cell(27,10,iconv( 'UTF-8','TIS-620',$data->by_citty),1,0,'L');
            $this->Cell(30,10,iconv( 'UTF-8','TIS-620',$data->by_province),1,0,'L');
            $this->Cell(25,10,iconv( 'UTF-8','TIS-620',$data->by_tel),1,0,'L');
            $this->Cell(45,10,iconv( 'UTF-8','TIS-620',$data->by_email),1,0,'L');
            $num++;
            $this->Ln();
        }
    }

}

$pdf=new PDF( 'L' , 'mm' , 'A4' );
$pdf->SetMargins( 5,5,5 );
$pdf->AddPage();
$pdf->AddFont('angsa','','angsa.php');
$pdf->SetFont('angsa','',15);
//    $pdf->Header();
$pdf->headerTable();
$pdf->viewTable($db);
//    $pdf->Footer();
$pdf->Output("buyers.pdf","F");

header("Location: buyers.pdf");
?>
<!--	PDF Created Click <a href="producer.pdf">here</a> to Download-->
</body>
</html>