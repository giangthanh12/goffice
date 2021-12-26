<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Đơn hàng</title>
    <style>
        body {
            font-family: Arial, Helvetica, sans-serif;
            font-size: 14px;
            line-height: 20px;
        }

        .letter-head {
            width: 100%;
            float: left;
            margin-bottom: 20px;
        }

        .head-left {
            width: 70%;
            float: left
        }

        .head-right {
            width: 30%;
            text-align: right;
            float: left
        }

        .indam {
            font-weight: bold
        }

        .tieude {
            text-align: center;
            margin-bottom: 20px;
            width: 100%;
        }

        .thongtin {
            margin-bottom: 20px;
            float: left;
            width: 100%;
        }

        .tin-left {
            width: 50%;
            float: left
        }

        .tin-right {
            width: 50%;
            float: left
        }

        .noidung {
            float: left;
            margin-bottom: 20px;
            width: 100%;
        }

        table.main {
            border-collapse: collapse;
            border: #666 1px solid;
            width: 100%;
        }

        table.main th, table.main td {
            text-align: left;
            padding: 5px;
            border: 1px solid #666;
        }

        table.main tr.title {
            background-color: #CCC
        }

        /*table.main tr:nth-child(even){background-color: #f2f2f2}*/
        .footer {
            float: left;
            margin-bottom: 20px;
            width: 100%
        }

        .chuky {
            float: left;
            margin-bottom: 20px;
            width: 100%
        }

        .noprint {
            float: left;
            text-align: center;
            width: 100%
        }

        @media print {
            .noprint {
                display: none;
            }
        }
    </style>
</head>
<body>
<?php
if (empty($this->data))
    echo '<h1>LỖI KHI ĐỌC DỮ LIỆU</h1>';
else {
    $donhang = $this->data['donhang'];
    $donhangsub = $this->data['donhangsub'];
    $thongtin = $this->data['thongtin'];
    ?>
    <div class="letter-head">
        <div class="head-left">
            <span class="indam"><?php echo $thongtin['0']['value'] ?></span> <br/>
            Địa chỉ: <span class="indam"><?php echo $thongtin['2']['value'] ?></span> <br/>
            Số điện thoại: <span class="indam"><?php echo $thongtin['4']['value'] ?></span> <br/>
        </div>
        <!--    <div class="head-right">-->
        <!--        Mẫu số 02-VT<br />-->
        <!--        (Ban hành theo Thông tư số 133/2016/TT-BTC Ngày 26/08/2016 của Bộ Tài chính)-->
        <!--    </div>-->
    </div>
    <div class="tieude">
        <h1>ĐƠN HÀNG</h1>
        Ngày: <?= date('d/m/Y', strtotime($donhang['ngay_gio'])) ?><br>
        Số: <?php echo $donhang['id']; ?>
    </div>
    <div class="thongtin">
        <div class="tin-left">
            <?php if ($donhang['khach_hang'] > 0) { ?>
                <span class="indam">Khách hàng:</span> <?php echo $donhang['khachhang']; ?> <br/>
                <?php if ($donhang['diachi'] != '') { ?>
                    <span class="indam">Địa chỉ:</span> <?php echo $donhang['diachi']; ?> <br/>
                <?php } ?>
                <?php if ($donhang['dienthoai'] != '') { ?>
                    <span class="indam">Điện thoại:</span> <?php echo $donhang['dienthoai']; ?> <br/>
                <?php } ?>
                <!--            <span class="indam">Lý do xuất kho:</span> Xuất hàng theo đơn đặt hàng số --><?php //echo $donhang['id']; ?><!-- <br />-->
                <!--            <span class="indam">Xuất tại kho: Velo bán lẻ <br />-->
            <?php } else echo ' <span class="indam">Khách lẻ<br />' ?>
        </div>
        <div class="tin-right">
        </div>
    </div>
    <div class="noidung">
        <table class="main">
            <tr class="title">
                <th>STT</th>
                <th>Loại</th>
                <th>Dịch vụ, sản phẩm, thẻ liệu trình, thẻ trả trước</th>
                <th>Hạn dùng</th>
                <!--                <th>Mã sản phẩm</th>-->
                <th>ĐVT</th>
                <th>Số lượng</th>
                <!--                <th>Thực xuất</th>-->
                <th>Đơn giá</th>
                <th>Giảm giá</th>
                <th>Thành tiền</th>
            </tr>
            <?php
            $i = 1;
            $tong = 0;
            foreach ($donhangsub as $row) {
                $thanhtien = ($row['so_luong'] * $row['don_gia']) - $row['chiet_khau'];
                $tong = $tong + $thanhtien;
                ?>
                <tr>
                    <td style="text-align: center;"><?php echo $i ?></td>
                    <td style="text-align: left;"><?php
                        if ($row['loai'] == 1)
                            echo 'Dịch vụ';
                        if ($row['loai'] == 2)
                            echo 'Sản phẩm';
                        if ($row['loai'] == 3)
                            echo 'Thẻ liệu tình';
                        if ($row['loai'] == 4)
                            echo 'Thẻ thành viên';
                        ?></td>
                    <td style="text-align: left;"><?php echo $row['tenhang']; ?></td>
                    <td style="text-align: left;"><?php echo ($row['han_dung'] != '0000-00-00') ? date('d/m/Y', strtotime($row['han_dung'])) : ($row['loai'] == 3 || $row['loai'] == 4) ? ('Không giới hạn') : ''; ?></td>
                    <!--                    <td style="text-align: left;">-->
                    <?php //echo $row['ma_hang']; ?><!--</td>-->
                    <td style="text-align: center;"><?php echo $row['don_vi_tinh'] ?></td>
                    <td style="text-align: center;"><?php echo number_format($row['so_luong'], 0, '.', ',') ?></td>
                    <!--                    <td style="text-align: center;">-->
                    <?php //echo number_format($row['so_luong'],0,'.',',')
                    ?><!--</td>-->
                    <td style="text-align: right;"><?php echo number_format($row['don_gia'], 0, '.', ',') ?></td>
                    <td style="text-align: right;"><?php echo number_format($row['chiet_khau'], 0, '.', ',') ?></td>
                    <td style="text-align: right;"><?php echo number_format($thanhtien, 0, '.', ',') ?></td>
                </tr>
                <?php
                $i++;
            }
            ?>
            <tr>
                <td colspan="8" style="font-weight: bold;text-align: right;">Tạm tính</td>
                <td style="text-align: right;font-weight: bold;"><?php echo number_format(($tong), 0, '.', ',') ?></td>
            </tr>
            <tr>
                <td colspan="8" style="font-weight: bold;text-align: right;">Giảm giá</td>
                <td style="text-align: right;font-weight: bold;"><?php echo number_format($donhang['chiet_khau'], 0, '.', ',') ?></td>
            </tr>
            <tr>
                <td colspan="8" style="font-weight: bold;text-align: right;">Thuế GTGT</td>
                <td style="text-align: right;font-weight: bold;"><?php echo $donhang['vat'] ?>%</td>
            </tr>
            <tr>
                <td colspan="8" style="font-weight: bold;text-align: right;">Thành tiền</td>
                <td style="text-align: right;font-weight: bold;"><?php echo number_format($donhang['so_tien'], 0, '.', ',') ?></td>
            </tr>
            <tr>
                <td colspan="8" style="font-weight: bold;text-align: right;">Đã thanh toán</td>
                <td style="text-align: right;font-weight: bold;"><?php echo number_format($donhang['dathanhtoan'], 0, '.', ',') ?></td>
            </tr>
            <tr>
                <td colspan="8" style="font-weight: bold;text-align: right;">Còn nợ</td>
                <td style="text-align: right;font-weight: bold;"><?php echo number_format($donhang['so_tien']-$donhang['dathanhtoan'], 0, '.', ',') ?></td>
            </tr>
        </table>
    </div><!--end info-nnhapkho-->
    <div class="footer">
    </div>
    <div class="chuky" hidden>
        <table width="100%">
            <tr>
                <td style="text-align: center; width:33%"><b>Người lập phiếu</b></td>
                <td style="text-align: center; width:34%"><b>Người giao hàng</b></td>
                <td style="text-align: center; width:33%"><b>Người nhận hàng</b></td>
                <!--                <td style="text-align: center; width:20%"><b>Thủ kho</b></td>-->
                <!--                <td style="text-align: center; width:20%"><b>Kế toán trưởng</b></td>-->
                <!--                <td style="text-align: center; width:20%"><b>Giám đốc</b></td>-->
            </tr>
        </table>
    </div>
<?php } ?>
<script type="text/javascript">
    window.print();
</script>

<div class="noprint">
    <button style="height:50px; padding:10px; font-size:18px"
            onClick="window.print();window.location.href = '<?php echo URL; ?>/donhang'">In ra
    </button>
    <button style="height:50px; padding:10px; font-size:18px"
            onClick="window.location.href = '<?php echo URL; ?>/donhang'">Quay lại
    </button>
</div>
