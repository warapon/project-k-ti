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
        $this->Cell(0,10,iconv( 'UTF-8','TIS-620','ข้อมูลของ '.$_POST["pd_prefix"].$_POST["pd_name"].'   '.$_POST["pd_lastname"].''),0,1,"C");
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
        $this->Cell(70,10,iconv( 'UTF-8','TIS-620','ชื่อสวน'),1,0,'C');
        $this->Cell(20,10,iconv( 'UTF-8','TIS-620','ประเภท'),1,0,'C');
        $this->Cell(20,10,iconv( 'UTF-8','TIS-620','พื้นที่/ไร'),1,0,'C');
        $this->Cell(20,10,iconv( 'UTF-8','TIS-620','กำลังผลิต/ปี'),1,0,'C');
        $this->Ln();
    }
    function viewTable($db){
//        $month=$_POST["month"];
        $this->AddFont('angsa','','angsa.php');
        $this->SetFont('angsa','',15);
        $stmt = $db->query("SELECT * FROM garden INNER JOIN fruittype ON garden.fruittype_ft_id = fruittype.ft_id 
                    INNER JOIN producers ON garden.producers_pd_id = producers.pd_id WHERE producers.pd_id = '".$_POST["garden"]."'");
        $num=1;
        while($data = $stmt->fetch(PDO::FETCH_OBJ)){
            $this->Cell(15,10,$num,1,0,'C');
            $this->Cell(70,10,iconv( 'UTF-8','TIS-620',$data->gd_name),1,0,'L');
            $this->Cell(20,10,iconv( 'UTF-8','TIS-620',$data->ft_nametype),1,0,'L');
            $this->Cell(20,10,iconv( 'UTF-8','TIS-620',$data->gd_area_number),1,0,'L');
            $this->Cell(20,10,iconv( 'UTF-8','TIS-620',$data->gd_productivity),1,0,'L');
            $num++;
            $this->Ln();
        }
    }

}

$pdf=new PDF( 'P' , 'mm' , 'A4' );
$pdf->SetMargins( 30,5,30 );
$pdf->AddPage();
$pdf->AddFont('angsa','','angsa.php');
$pdf->SetFont('angsa','',15);
//    $pdf->Header($db);
$pdf->headerTable();
$pdf->viewTable($db);
//    $pdf->Footer();
$pdf->Output("user.pdf","F");

header("Location: user.pdf");
?>
<!--	PDF Created Click <a href="producer.pdf">here</a> to Download-->
</body>
</html>