<html>
<head>
<title>ระบบขออนุมัติเพิ่มโควต้าการพิมพ์ผ่านระบบเครือข่าย</title>
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
    $db = new PDO('mysql:host=localhost;dbname=mydb','root','');
    $db->query("set NAMES'UTF8'");
	define('FPDF_FONTPATH','font/');
   
	class PDF extends FPDF
	{
		function Header(){
            
			$this->AddFont('angsa','','angsa.php');
			$this->SetFont('angsa','',22);
            $this->Cell(0,10,iconv( 'UTF-8','TIS-620','ระบบให้คำปรึกษางานวิจัย'),0,1,"C");
            $this->SetFont('angsa','',18);
            $this->Cell(0,10,iconv( 'UTF-8','TIS-620','ข้อมูลสรุปผู้ใช้งานระบบ เดือน '.DateThaiasss($_POST["month"]).' '),0,1,"C");
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
            $this->Cell(55,10,iconv( 'UTF-8','TIS-620','ชื่อ-สกุล'),1,0,'C');
            $this->Cell(55,10,iconv( 'UTF-8','TIS-620','อีเมลล์'),1,0,'C');
            $this->Cell(40,10,iconv( 'UTF-8','TIS-620','สถานะ'),1,0,'C');
            $this->Cell(35,10,iconv( 'UTF-8','TIS-620','วันที่เข้าใช้งาน'),1,0,'C');
            $this->Ln();
        }
        function viewTable($db){
            $month=$_POST["month"];
            $this->AddFont('angsa','','angsa.php');
            $this->SetFont('angsa','',15);
            $stmt = $db->query("SELECT * FROM `log` INNER JOIN user ON log.user_iduser = user.iduser WHERE log.log_date LIKE '%".$month."%' AND user_level != '1'");
            $num=1;
            while($data = $stmt->fetch(PDO::FETCH_OBJ)){
                if($data->user_level=="2"){
                    $level = "ผู้เชี่ยวชาญ";
                }else if($data->user_level=="3"){
                    $level = "นักวิจัย";
                }else if($data->user_level=="4"){
                    $level = "ผู้ประสานงาน";
                }
                $this->Cell(15,10,$num,1,0,'C');
                $this->Cell(55,10,iconv( 'UTF-8','TIS-620',$data->user_pre.$data->user_name."   ".$data->user_lname),1,0,'L');
                $this->Cell(55,10,iconv( 'UTF-8','TIS-620',$data->user_email),1,0,'L');
                $this->Cell(40,10,iconv( 'UTF-8','TIS-620',$level),1,0,'L');
                $this->Cell(35,10,iconv( 'UTF-8','TIS-620',$data->log_date),1,0,'C');
                $num++;
                $this->Ln();
            }
        }
	 
	}

	$pdf=new PDF( 'P' , 'mm' , 'A4' );
	$pdf->SetMargins( 5,5,5 );
	$pdf->AddPage();
	$pdf->AddFont('angsa','','angsa.php');
	$pdf->SetFont('angsa','',15);
//    $pdf->Header();
    $pdf->headerTable();
    $pdf->viewTable($db);
//    $pdf->Footer();
	$pdf->Output("MyPDF/MyPDF.pdf","F");
    
    header("Location: MyPDF/MyPDF.pdf");
?>
<!--	PDF Created Click <a href="MyPDF/MyPDF.pdf">here</a> to Download-->
</body>
</html>