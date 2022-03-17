<?php $laborcontract = $this->laborcontract; ?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>GOFFICE Printing...</title>
    <link rel="stylesheet" type="text/css" href="<?= HOME ?>/layouts/printquote.css">
</head>
<body>
    <div class="letter-head">
        <table class="tablehead">
            <tr>
                <td class="col-left" >
                    CÔNG TY CỔ PHẦN ĐẦU TƯ VÀ <br>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;CÔNG NGHỆ GEMSTECH
                </td>
                <td class="col-right">
                    <p style="text-align: center;">CỘNG HÒA XÃ HỘI CHỦ NGHĨA VIỆT NAM</p> 
                    <p style="text-align: center;">Độc lập - Tự do - Hạnh phúc</p> 
                </td>
            </tr>
        </table>
    </div>
    <div class="title">
        <h1>HƠP ĐỒNG LAO ĐỘNG</h1>
    </div>
    <div class="noidung">
    <table class="tablehead">
            <tr>
                <td class="col-left" style="font-size: 20px;">
                    Tên hợp đồng: <?= $laborcontract['name'] ?>
                </td>
            </tr>
            <tr style="font-size: 20px;">
                <td class="col-left">
                    Loại hợp đồng: <?= $laborcontract['typeName'] ?>
                </td>
            </tr>
            <tr style="font-size: 20px;">
                <td class="col-left">
                    Nhân viên:  <?= $laborcontract['staffName'] ?>
                </td>
            </tr>
            <tr style="font-size: 20px;">
                <td class="col-left">
                    Phòng ban: <?= $laborcontract['nameDepartment'] ?>
                </td>
            </tr>
            <tr style="font-size: 20px;">
                <td class="col-left">
                    Chức vụ: <?= $laborcontract['namePosition'] ?>
                </td>
            </tr>
            <tr style="font-size: 20px;">
                <td class="col-left">
                    Chi nhánh: <?= $laborcontract['branchName'] ?>
                </td>
            </tr>
            <tr style="font-size: 20px;">
                <td class="col-left">
                    Địa điểm làm việc: <?= $laborcontract['nameWorkplace'] ?>
                </td>
            </tr>
            <tr style="font-size: 20px;">
                <td class="col-left">
                    Phân ca:  <?= $laborcontract['nameShift'] ?>
                </td>
            </tr>
            <tr style="font-size: 20px;">
                <td class="col-left">
                    Lương cơ bản: <?= number_format($laborcontract['basicSalary'],0,'.','.') ?>
                </td>
            </tr>
            <tr style="font-size: 20px;">
                <td class="col-left">
                    Phụ cấp: <?= number_format($laborcontract['allowance'],0,'.','.') ?>
                </td>
            </tr>
            <tr style="font-size: 20px;">
                <td class="col-left">
                    Ngày bắt đầu: <?= date('d-m-Y', strtotime($laborcontract['startDate'])) ?>
                </td>
            </tr>
            <tr style="font-size: 20px;">
                <td class="col-left">
                    Ngày kết thúc:  <?= date('d-m-Y', strtotime($laborcontract['stopDate'])) ?>
                </td>
            </tr>
        </table>
    </div>
    <div class="letter-head">
    <table class="tablehead">
            <tr>
                <td class="col-left" >
                    <p><b>Người lao động</b></p>
                    <p>(Ký, ghi rõ họ tên)</p>
                </td>
                <td class="col-right" style="text-align:center">
                    <p><b>Người sử dụng lao động</b></p>
                    <p>(Ký, ghi rõ họ tên)</p>
                </td>
            </tr>
        </table>

    </div>
    <div class="chuky"></div>
    <div class="noprint">
        <button class="linkbutton" onClick="window.print();">In ngay</button>
        <button class="linkbutton" onClick="window.location.href = '<?=HOME?>/baogia'">Quay lại danh sách hợp đồng</button>
    </div>
</body>
</html>
