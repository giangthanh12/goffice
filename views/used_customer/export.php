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
$data = $this->data;
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
$sheet->setCellValue('A1', 'DANH SÁCH KHÁCH HÀNG');
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
$sheet->setCellValue('B5','Tên khách hàng');
$sheet->setCellValue('C5','Mã số thuế');
$sheet->setCellValue('D5','Số điện thoại');
$sheet->setCellValue('E5','Email');
$sheet->setCellValue('F5','Website');
$sheet->setCellValue('G5','Địa chỉ ĐKKD');
$sheet->setCellValue('H5','Lĩnh vực kinh doanh');
$sheet->setCellValue('I5','Phân loại khách hàng');
$sheet->setCellValue('J5','Vị trí người đại diện');
$sheet->setCellValue('K5','Người cấp phép');
$sheet->setCellValue('L5','Trạng thái');

$i=6;
foreach($data['data'] as $row){
    if($row['field'] == 1) {
        $field = 'Công nghệ thông tin';
    } else if($row['field'] == 2) {
        $field = 'Chứng khoán đầu tư';
    }  else if($row['field'] == 3) {
        $field = 'Tài chính ngân hàng';
    }  else if($row['field'] == 4) {
        $field = 'Du lịch - khách hàng';
    }  else if($row['field'] == 5) {
        $field = 'Xây dựng - bất động sản';
    }  else if($row['field'] == 6) {
        $field = 'Sản xuất chế tạo';
    }  else if($row['field'] == 7) {
        $field = 'Dịch vụ ăn uống';
    }  else if($row['field'] == 8) {
        $field = 'Vận tải hành khách';
    }  else if($row['field'] == 9) {
        $field = 'Logistic';
    }  else if($row['field'] == 10) {
        $field = 'Khác';
    }

    if($row['classify'] == 1) {
        $classify = 'Khách hàng';
    } else if($row['classify'] == 2) {
        $classify = 'Nhà cung cấp';
    }  else if($row['classify'] == 3) {
        $classify = 'Cả hai';
    }
    if($row['status'] == 1) {
        $status = 'Khách hàng tiềm năng';
    } else if($row['status'] == 2) {
        $status = 'Khách hàng đang dùng dịch vụ';
    }  else if($row['status'] == 3) {
        $status = 'Khách hàng đã ngừng dùng dịch vụ';
    }
    $sheet->setCellValue('A' . $i, $i-5);
    $sheet->setCellValue('B' . $i, $row['fullName']); 
    $sheet->setCellValue('C' . $i, $row['taxCode']);
    $sheet->getStyle('C' . $i)->getNumberFormat()->setFormatCode('#,###0.00');
    $sheet->setCellValue('D' . $i, $row['phoneNumber']);
    $sheet->getStyle('D' . $i)->getNumberFormat()->setFormatCode('#,###0.00');
    $sheet->setCellValue('E' . $i, $row['email']);
    $sheet->setCellValue('F' . $i,$row['website']);
    $sheet->setCellValue('G' . $i, $row['businessAddress']);
    $sheet->setCellValue('H' . $i,  $field);
    $sheet->setCellValue('I' . $i, $classify);
    $sheet->setCellValue('J' . $i, $row['position']);
    $sheet->setCellValue('K' . $i,$row['authorized']);
    $sheet->setCellValue('L' . $i, $status);
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
header('Content-Disposition: attachment;filename="bang_luong_thang_'.$this->month.'_nam_'.$this->year.'('.date("d_m_Y").').xlsx"');
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