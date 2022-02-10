<?php
require_once 'libs/phpexcel/PHPExcel.php';
// $sql = new Model();
$objPHPExcel = new PHPExcel();
$objPHPExcel->getProperties()->setCreator("Bảng Lương")
    ->setLastModifiedBy("Bảng Lương")
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
$sheet->getColumnDimension('C')->setWidth(30);
$sheet->getColumnDimension('D')->setWidth(30);
$sheet->getColumnDimension('E')->setWidth(30);
$sheet->getColumnDimension('F')->setWidth(30);
$sheet->getColumnDimension('G')->setWidth(30);
$sheet->getColumnDimension('H')->setWidth(30);
$sheet->getColumnDimension('I')->setWidth(30);
$sheet->getColumnDimension('J')->setWidth(30);
$sheet->getColumnDimension('K')->setWidth(30);
$sheet->getColumnDimension('L')->setWidth(30);
$sheet->getColumnDimension('M')->setWidth(30);
$sheet->getColumnDimension('N')->setWidth(30);

$sheet->getStyle("E")->getAlignment()->applyFromArray($center);
$sheet->setCellValue('A1', 'DANH SÁCH LƯƠNG');
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
$sheet->setCellValue('B5','Nhân viên');
$sheet->setCellValue('C5','Công chuẩn');
$sheet->setCellValue('D5','Lương HĐ');
$sheet->setCellValue('E5','Ngày công');
$sheet->setCellValue('F5','Lương T/G');
$sheet->setCellValue('G5','Phụ cấp');
$sheet->setCellValue('H5','Thưởng DS');
$sheet->setCellValue('I5','Thưởng lễ');
$sheet->setCellValue('J5','Thưởng khác');
$sheet->setCellValue('K5','Tổng cộng');
$sheet->setCellValue('L5','Bảo hiểm');
$sheet->setCellValue('M5','Tạm ứng');
$sheet->setCellValue('N5','Thực lĩnh');

$i=6;
foreach($this->payrolls as $row){
    $sheet->setCellValue('A' . $i, $i-5);
    $sheet->setCellValue('B' . $i, $row['staffName']); 
    $sheet->setCellValue('C' . $i, $row['wokingDays']);
    $sheet->getStyle('C' . $i)->getNumberFormat()->setFormatCode('#,###0.00');
    $sheet->setCellValue('D' . $i, $row['basicSalary']);
    $sheet->getStyle('D' . $i)->getNumberFormat()->setFormatCode('#,###0.00');
    $sheet->setCellValue('E' . $i, $row['totalWorkDays']);
    $sheet->getStyle('E' . $i)->getNumberFormat()->setFormatCode('#,###0.00');
    $sheet->setCellValue('F' . $i,($row['basicSalary'] / $row['wokingDays']) * $row['totalWorkDays']);
    $sheet->getStyle('F' . $i)->getNumberFormat()->setFormatCode('#,###0.00');
    $sheet->setCellValue('G' . $i, $row['allowance']);
    $sheet->getStyle('G' . $i)->getNumberFormat()->setFormatCode('#,###0.00');
    $sheet->setCellValue('H' . $i, $row['revenueBonus']);
    $sheet->getStyle('H' . $i)->getNumberFormat()->setFormatCode('#,###0.00');
    $sheet->setCellValue('I' . $i, $row['tetBonus']);
    $sheet->getStyle('I' . $i)->getNumberFormat()->setFormatCode('#,###0.00');
    $sheet->setCellValue('J' . $i, $row['otherBonus']);
    $sheet->getStyle('J' . $i)->getNumberFormat()->setFormatCode('#,###0.00');
    $sheet->setCellValue('K' . $i, (($row['basicSalary'] / $row['wokingDays']) * $row['totalWorkDays']) +  $row['allowance'] + $row['revenueBonus'] + $row['tetBonus'] + $row['otherBonus']);
    $sheet->getStyle('K' . $i)->getNumberFormat()->setFormatCode('#,###0.00');
    $sheet->setCellValue('L' . $i, $row['insurance']);
    $sheet->getStyle('L' . $i)->getNumberFormat()->setFormatCode('#,###0.00');
    $sheet->setCellValue('M' . $i, $row['advance']);
    $sheet->getStyle('M' . $i)->getNumberFormat()->setFormatCode('#,###0.00');
    $sheet->setCellValue('N' . $i, (($row['basicSalary'] / $row['wokingDays']) * $row['totalWorkDays']) +  $row['allowance'] + $row['revenueBonus'] + $row['tetBonus'] + $row['otherBonus'] - $row['insurance'] - $row['advance']);
    $sheet->getStyle('N' . $i)->getNumberFormat()->setFormatCode('#,###0.00');
    $i++;
}
$sheet->getStyle("A5:N".$i)->applyFromArray(
    array(
        'borders' => array(
            'allborders' => array(
                'style' => PHPExcel_Style_Border::BORDER_THIN
            )
        )
    )
);

// Rename worksheet
$sheet->setTitle('Bảng Lương');

// Set active sheet index to the first sheet, so Excel opens this as the first sheet
$objPHPExcel->setActiveSheetIndex(0);

// Redirect output to a client’s web browser (Excel2007)
header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
header('Content-Disposition: attachment;filename="data('.date("d_m_Y").').xlsx"');
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