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
                <td class="col-left">
                    <img src="https://gemstech.com.vn/uploads/home/logo-2.png" height="40"><br>
                    Số 2, Vương Thừa Vũ<br>
                    Quận Thanh Xuân, Tp Hà Nội<br>
                    034 678 8118
                </td>
                <td class="col-right">
                    Báo giá số: <?=$this->quote['quote']['id']?><br>
                    Ngày tạo: <?=$this->quote['quote']['ngay_tao']?><br>
                    Có giá trị đến: <?=$this->quote['quote']['ngay_ket_thuc']?>
                </td>
            </tr>
        </table>
    </div>
    <div class="title">
        <h1>BÁO GIÁ</h1>
        <table>
            <tr>
                <td class="col-left">
                    Kính gửi quý khách hàng <?=$this->quote['quote']['khachhang']?><br>
                    <!-- G5 Thanh Xuân Bắc, Quận Thanh Xuân, Tp Hà Nội<br>
                    034 678 8118 -->
                </td>
                <td class="col-right">
                    <!-- <b style="margin-left:-30px">Thanh toán:</b>
                    <li>Thanh toán 100% khi giao hàng</li>
                    <li>Hình thức: chuyển khoản/COD</li>
                    <b style="margin-left:-30px">Giao hàng:</b>
                    <li>6 tuần sau khi đặt hàng</li>
                    <li>Miễn phí nội thành Hà Nội</li> -->
                </td>
            </tr>
        </table>
    </div>
    <div class="noidung">
        <table id="customers">
          <tr>
            <th>STT</th>
            <th>Hàng hóa/dịch vụ</th>
            <th>ĐVT</th>
            <th>Số lượng</th>
            <th>Đơn giá</th>
            <th>Giảm giá</th>
            <th>Chiết khấu %</th>
            <th>Thành tiền</th>
            <th>Thuế GTGT</th>
          </tr>
          <?php
            $i=1;
            $tongtien = 0;
            $tongthue = 0;
            foreach ($this->quote['items'] AS $item) {
                $thanhtien = ($item['price']-$item['reduce'])*(1-$item['discount']/100)*$item['quantity'];
                $vat = $thanhtien*($item['vat']/100);
                echo '<tr>';
                echo '<td>'.$i.'</td>';
                echo '<td>'.$item['product'].'<br>'.$item['description'].'</td>';
                echo '<td>'.$item['unit'].'</td>';
                echo '<td>'.$item['quantity'].'</td>';
                echo '<td style="text-align:right">'.number_format($item['price']).'</td>';
                echo '<td style="text-align:right">'.number_format($item['reduce']).'</td>';
                echo '<td style="text-align:center">'.$item['discount'].'</td>';
                echo '<td style="text-align:right">'.number_format($thanhtien).'</td>';
                echo '<td style="text-align:right">'.number_format($vat).'</td>';
                echo '</tr>';
                $i++;
                $tongtien = $tongtien + $thanhtien;
                $tongthue = $tongthue + $vat;
            }
          ?>
          <tr>
            <th>STT</th>
            <th>Tổng cộng:</th>
            <th></th>
            <th></th>
            <th></th>
            <th></th>
            <th></th>
            <th style="text-align:right"><?=number_format($tongtien)?></th>
            <th style="text-align:right"><?=number_format($tongthue)?></th>
          </tr>
        </table>
        <h4>Ghi chú</h4>
        <p><?=$this->quote['quote']['note']?><br></p>
    </div>
    <div class="footer">
        <!-- <table width="100%"><tr>
            <td width="50%">
                <b>Thanh toán:</b><br>
                - Thanh toán 100% khi giao hàng<br>
                - Hình thức: chuyển khoản/COD<br>
            </td>
            <td width="50%">
                <b>Giao hàng:</b><br>
                - 6 tuần sau khi đặt hàng<br>
                - Miễn phí nội thành Hà Nội<br>
            </td>
        </tr></table> -->


    </div>
    <div class="chuky"></div>
    <div class="noprint">
        <button class="linkbutton" onClick="window.print();">In ngay</button>
        <button class="linkbutton" onClick="window.location.href = '<?=HOME?>/baogia'">Quay lại danh sách báo giá</button>
    </div>
</body>
</html>
