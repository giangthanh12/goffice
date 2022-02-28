<?php
require_once 'libs/phpexcel/PHPExcel.php';
// $sql = new Model();
$objPHPExcel = new PHPExcel();
$objPHPExcel->getProperties()->setCreator("Ứng viên")
    ->setLastModifiedBy("Ứng viên")
    ->setTitle("Office 2007 XLSX Test Document")
    ->setSubject("Office 2007 XLSX Test Document")
    ->setDescription("Test document for Office 2007 XLSX, generated using PHP classes.")
    ->setKeywords("office 2007 openxml php")
    ->setCategory("Test result file");
$sheet = $objPHPExcel->getActiveSheet ();
//formatting
$data = $this->data;
$center=array('horizontal' => PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
$sheet->getColumnDimension('A')->setWidth(7);
$sheet->getColumnDimension('B')->setWidth(30);
$sheet->getColumnDimension('C')->setWidth(30);
$sheet->getColumnDimension('D')->setWidth(30);
$sheet->getColumnDimension('E')->setWidth(30);
$sheet->getColumnDimension('F')->setWidth(30);
$sheet->getColumnDimension('G')->setWidth(30);

$sheet->getStyle("E")->getAlignment()->applyFromArray($center);
$sheet->setCellValue('A1', 'DANH SÁCH ỨNG VIÊN');
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

$sheet->setCellValue('A5','STT');
$sheet->setCellValue('B5','Tên ứng viên');
$sheet->setCellValue('C5','Giới tính');
$sheet->setCellValue('D5','Ngày sinh');
$sheet->setCellValue('E5','Số điện thoại');
$sheet->setCellValue('F5','Email');
$sheet->setCellValue('G5','CV');
$i=6;
foreach($data['data'] as $row){
   if($row['gender'] == 1) {
       $gender = 'Nam';
   } else if ($row['gender'] == 2) {
    $gender = 'Nữ';
   }
    $sheet->setCellValue('A' . $i, $i-5);
    $sheet->setCellValue('B' . $i, $row['fullName']); 
    $sheet->setCellValue('C' . $i, $gender);
    // $sheet->getStyle('C' . $i)->getNumberFormat()->setFormatCode('#,###0.00');
    $sheet->setCellValue('D' . $i, $row['dob']);
    // $sheet->getStyle('D' . $i)->getNumberFormat()->setFormatCode('#,###0.00');
    $sheet->setCellValue('E' . $i, $row['phoneNumber']);
    $sheet->setCellValue('F' . $i,$row['email']);
    $sheet->setCellValue('G' . $i,  HOME . '/uploads/ungvien/'.$row['cv']);

    $i++;
}
$sheet->getStyle("A5:G".$i)->applyFromArray(
    array(
        'borders' => array(
            'allborders' => array(
                'style' => PHPExcel_Style_Border::BORDER_THIN
            )
        )
    )
);

// Rename worksheet
$sheet->setTitle('Danh sách ứng viên');

// Set active sheet index to the first sheet, so Excel opens this as the first sheet
$objPHPExcel->setActiveSheetIndex(0);

// Redirect output to a client’s web browser (Excel2007)
header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
header('Content-Disposition: attachment;filename="ungvien_'.'('.date("d_m_Y").').xlsx"');
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