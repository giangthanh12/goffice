<?php
require_once 'libs/phpexcel/phpexcel copy/PHPExcel.php';
$arrayString = [
    '0'=>'A',
     '1'=>'B',
     '2'=>'C',
     '3'=>'D',
     '4'=>'E',
     '5'=>'F',
     '6'=>'G',
     '7'=>'H',
     '8'=>'I',
     '9'=>'J',
     '10'=>'K',
     '11'=>'L',
     '12'=>'M',
     '13'=>'N',
     '14'=>'O',
     '15'=>'P',
     '16'=>'Q',
     '17'=>'R',
     '18'=>'S',
     '19'=>'T',
     '20'=>'U',
     '21'=>'V',
     '22'=>'W',
     '23'=>'X',
     '24'=>'Y',
     '25'=>'Z',
     '26'=>'AA',
     '27'=>'AB',
     '28'=>'AC',
     '29'=>'AD',
     '30'=>'AE',
     '31'=>'AF',
     '32'=>'AG',
     '33'=>'AH',
     '34'=>'AI'
];
// $sql = new Model();
$objPHPExcel = new PHPExcel();
$objPHPExcel->getProperties()->setCreator("Bảng chấm công")
    ->setLastModifiedBy("Bảng chấm công")
    ->setTitle("Office 2007 XLSX Test Document")
    ->setSubject("Office 2007 XLSX Test Document")
    ->setDescription("Test document for Office 2007 XLSX, generated using PHP classes.")
    ->setKeywords("office 2007 openxml php")
    ->setCategory("Test result file");
$sheet = $objPHPExcel->getActiveSheet ();
//formatting
$center=array('horizontal' => PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
$sheet->getColumnDimension('A')->setWidth(7);
$sheet->getColumnDimension('B')->setWidth(30);
$sheet->getColumnDimension('C')->setWidth(15);
$sheet->getColumnDimension('D')->setWidth(15);
$sheet->getColumnDimension('E')->setWidth(15);
$sheet->getColumnDimension('F')->setWidth(15);
$sheet->getColumnDimension('G')->setWidth(15);
$sheet->getColumnDimension('H')->setWidth(15);
$sheet->getColumnDimension('J')->setWidth(15);
$sheet->getColumnDimension('K')->setWidth(15);
$sheet->getColumnDimension('L')->setWidth(15);
$sheet->getColumnDimension('M')->setWidth(15);
$sheet->getColumnDimension('N')->setWidth(15);
$sheet->getColumnDimension('O')->setWidth(15);
$sheet->getColumnDimension('P')->setWidth(15);
$sheet->getColumnDimension('Q')->setWidth(15);
$sheet->getColumnDimension('R')->setWidth(15);
$sheet->getColumnDimension('S')->setWidth(15);
$sheet->getColumnDimension('T')->setWidth(15);
$sheet->getColumnDimension('U')->setWidth(15);
$sheet->getColumnDimension('V')->setWidth(15);
$sheet->getColumnDimension('W')->setWidth(15);
$sheet->getColumnDimension('X')->setWidth(15);
$sheet->getColumnDimension('Y')->setWidth(15);
$sheet->getColumnDimension('Z')->setWidth(15);
$sheet->getColumnDimension('AA')->setWidth(15);
$sheet->getColumnDimension('AB')->setWidth(15);
$sheet->getColumnDimension('AC')->setWidth(15);
$sheet->getColumnDimension('AD')->setWidth(15);
$sheet->getColumnDimension('AE')->setWidth(15);
$sheet->getColumnDimension('AF')->setWidth(15);
$sheet->getColumnDimension('AG')->setWidth(15);
$sheet->getColumnDimension('AH')->setWidth(15);
$sheet->getColumnDimension('AI')->setWidth(15);

$sheet->getStyle("E")->getAlignment()->applyFromArray($center);
$sheet->setCellValue('A1', 'BẢNG CHẤM CÔNG');
$sheet->mergeCells('A1:F1');
$sheet->getStyle('A1')->getAlignment()->applyFromArray($center);
$sheet->setCellValue('A2', 'GEMSTECH');
$sheet->mergeCells('A2:F2');
$sheet->getStyle('A2')->getAlignment()->applyFromArray($center);
$sheet->setCellValue('A3', '' );
$sheet->mergeCells('A3:F3');
$sheet->getStyle('A3')->getAlignment()->applyFromArray($center);
$sheet->setCellValue('A4', '');
$sheet->mergeCells('A4:F4');

$year = $this->year;
$month = $this->month;


$sheet->setCellValue('A5','STT');
$sheet->setCellValue('B5','Nhân viên');
$sheet->setCellValue('C5','Công chuẩn');
$sheet->setCellValue('D5','Ngày công');
for ($i = 1; $i <= 31; $i++) {
  
    if ($i < 10) { $i = '0'.$i; }
    
    $dt =  date($year.'-'.$month.'-'.$i);
  
    $day = date('D', strtotime($dt));
  

if($day == 'Sun'){
    $thu = 'Chủ nhật -'.$i;
} else if($day == "Mon") {
    $thu = 'Thứ 2 -'.$i;
}
else if($day == "Tue") {
    $thu = 'Thứ 3 -'.$i;
}
else if($day == "Wed") {
    $thu = 'Thứ 4 -'.$i;
}
else if($day == "Thu") {
    $thu = 'Thứ 5 -'.$i;
}
else if($day == "Fri") {
    $thu = 'Thứ 6 -'.$i;
}
else if($day == "Sat") {
    $thu = 'Thứ 7 -'.$i;
}


$sheet->setCellValue($arrayString[$i+3].'5',$thu);

}


$i=6;
$data = $this->timesheets;

foreach($data['data'] as $row){
    $sheet->setCellValue('A' . $i, $i-5);
    $sheet->setCellValue('B' . $i, $row['staffName']); 
    $sheet->setCellValue('C' . $i, $row['workMonth']);
    $sheet->getStyle('C' . $i)->getNumberFormat()->setFormatCode('0.00');
    $sheet->setCellValue('D' . $i, $row['totalWorkDate']);
    $sheet->getStyle('D' . $i)->getNumberFormat()->setFormatCode('0.00');
    $sheet->setCellValue('E' . $i, $row['date_01']);
    $sheet->getStyle('E' . $i)->getNumberFormat()->setFormatCode('0.00');
    $sheet->setCellValue('F' . $i, $row['date_02']);
    $sheet->getStyle('F' . $i)->getNumberFormat()->setFormatCode('0.00');
    $sheet->setCellValue('G' . $i, $row['date_03']);
    $sheet->getStyle('G' . $i)->getNumberFormat()->setFormatCode('0.00');
    $sheet->setCellValue('H' . $i, $row['date_04']);
    $sheet->getStyle('H' . $i)->getNumberFormat()->setFormatCode('0.00');
    $sheet->setCellValue('I' . $i, $row['date_05']);
    $sheet->getStyle('I' . $i)->getNumberFormat()->setFormatCode('0.00');
    $sheet->setCellValue('J' . $i, $row['date_06']);
    $sheet->getStyle('J' . $i)->getNumberFormat()->setFormatCode('0.00');
    $sheet->setCellValue('K' . $i, $row['date_07']);
    $sheet->getStyle('K' . $i)->getNumberFormat()->setFormatCode('0.00');
    $sheet->setCellValue('L' . $i, $row['date_08']);
    $sheet->getStyle('L' . $i)->getNumberFormat()->setFormatCode('0.00');
    $sheet->setCellValue('M' . $i, $row['date_09']);
    $sheet->getStyle('M' . $i)->getNumberFormat()->setFormatCode('0.00');
    $sheet->setCellValue('N' . $i, $row['date_10']);
    $sheet->getStyle('N' . $i)->getNumberFormat()->setFormatCode('0.00');
    $sheet->setCellValue('O' . $i, $row['date_11']);
    $sheet->getStyle('O' . $i)->getNumberFormat()->setFormatCode('0.00');
    $sheet->setCellValue('P' . $i, $row['date_12']);
    $sheet->getStyle('P' . $i)->getNumberFormat()->setFormatCode('0.00');
    $sheet->setCellValue('Q' . $i, $row['date_13']);
    $sheet->getStyle('Q' . $i)->getNumberFormat()->setFormatCode('0.00');
    $sheet->setCellValue('R' . $i, $row['date_14']);
    $sheet->getStyle('R' . $i)->getNumberFormat()->setFormatCode('0.00');
    $sheet->setCellValue('S' . $i, $row['date_15']);
    $sheet->getStyle('S' . $i)->getNumberFormat()->setFormatCode('0.00');
    $sheet->setCellValue('T' . $i, $row['date_16']);
    $sheet->getStyle('T' . $i)->getNumberFormat()->setFormatCode('0.00');
    $sheet->setCellValue('U' . $i, $row['date_17']);
    $sheet->getStyle('U' . $i)->getNumberFormat()->setFormatCode('0.00');
    $sheet->setCellValue('V' . $i, $row['date_18']);
    $sheet->getStyle('V' . $i)->getNumberFormat()->setFormatCode('0.00');
    $sheet->setCellValue('W' . $i, $row['date_19']);
    $sheet->getStyle('W' . $i)->getNumberFormat()->setFormatCode('0.00');
    $sheet->setCellValue('X' . $i, $row['date_20']);
    $sheet->getStyle('X' . $i)->getNumberFormat()->setFormatCode('0.00');
    $sheet->setCellValue('Y' . $i, $row['date_21']);
    $sheet->getStyle('Y' . $i)->getNumberFormat()->setFormatCode('0.00');
    $sheet->setCellValue('Z' . $i, $row['date_22']);
    $sheet->getStyle('Z' . $i)->getNumberFormat()->setFormatCode('0.00');
    $sheet->setCellValue('AA' . $i, $row['date_23']);
    $sheet->getStyle('AA' . $i)->getNumberFormat()->setFormatCode('0.00');
    $sheet->setCellValue('AB' . $i, $row['date_24']);
    $sheet->getStyle('AB' . $i)->getNumberFormat()->setFormatCode('0.00');
    $sheet->setCellValue('AC' . $i, $row['date_25']);
    $sheet->getStyle('AC' . $i)->getNumberFormat()->setFormatCode('0.00');
    $sheet->setCellValue('AD' . $i, $row['date_26']);
    $sheet->getStyle('AD' . $i)->getNumberFormat()->setFormatCode('0.00');
    $sheet->setCellValue('AE' . $i, $row['date_27']);
    $sheet->getStyle('AE' . $i)->getNumberFormat()->setFormatCode('0.00');
    $sheet->setCellValue('AF' . $i, $row['date_28']);
    $sheet->getStyle('AF' . $i)->getNumberFormat()->setFormatCode('0.00');
    $sheet->setCellValue('AG' . $i, $row['date_29']);
    $sheet->getStyle('AG' . $i)->getNumberFormat()->setFormatCode('0.00');
    $sheet->setCellValue('AH' . $i, $row['date_30']);
    $sheet->getStyle('AH' . $i)->getNumberFormat()->setFormatCode('0.00');
    $sheet->setCellValue('AI' . $i, $row['date_31']);
    $sheet->getStyle('AI' . $i)->getNumberFormat()->setFormatCode('0.00');
    $i++;
}
$sheet->getStyle("A5:AI".$i)->applyFromArray(
    array(
        'borders' => array(
            'allborders' => array(
                'style' => PHPExcel_Style_Border::BORDER_THIN
            )
        )
    )
);

// Rename worksheet
$sheet->setTitle('Bảng Chấm công');

// Set active sheet index to the first sheet, so Excel opens this as the first sheet
$objPHPExcel->setActiveSheetIndex(0);

// Redirect output to a client’s web browser (Excel2007)
header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
header('Content-Disposition: attachment;filename="chamcong('.$this->view->month.'_'.$this->view->year.')('.date("d_m_Y").').xlsx"');
header('Cache-Control: max-age=0');
// If you're serving to IE 9, then the following may be needed
header('Cache-Control: max-age=1');
// If you're serving to IE over SSL, then the following may be needed
header ('Expires: Mon, 26 Jul 1997 05:00:00 GMT'); // Date in the past
header ('Last-Modified: '.gmdate('D, d M Y H:i:s').' GMT'); // always modified
header ('Cache-Control: cache, must-revalidate'); // HTTP/1.1
//header ('Pragma: public'); // HTTP/1.0

$objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel2007');
ob_end_clean();  //xóa các định dạng html trước khi ghi file excel để loại trừ lỗi format or file extension not valid  khi mở file
$objWriter->save('php://output');
exit;
?>