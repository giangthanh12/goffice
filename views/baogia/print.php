<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>GOFFICE Printing...</title>
	<style>
        body {
            font-family: Arial, Helvetica, sans-serif;
            font-size: 14px;
            width: 900px;
            margin: auto;
            line-height: 1.5;
        }
        .letter-head {
            width: 100%;
            float: left;
            margin-bottom: 15px;
            text-align: center;
        }
        .letter-head table {
            border-collapse: collapse;
            border: none;
            width: 100%;
        }
        .letter-head table .col-left {
            text-align: left;
            padding: 3px;
            width:70%;
        }
        .letter-head table .col-right {
            text-align: left;
            padding: 3px;
            width:30%;
        }
        .title {
            float: left;
            width: 100%;
            border-top: #999 1px solid;
            padding-top: 10px;
            margin-bottom: 15px;
        }
        .title  h1{
            text-align: center;
        }


        .indam {
            font-weight: bold;
        }
        /* .head-left {width:70%; float:left}
              .head-right {width:30%; text-align:right; float:left}

          .tieude { text-align:center; margin-bottom:20px; width:100%;}
          .thongtin {margin-bottom:15px; float:left; width:100%;  }
              .tin-left { width:50%; float:left}
              .tin-right {width:50%; float:left} */
        .noidung {
            float: left;
            margin-bottom: 15px;
            width: 100%;
        }
        table.main {
            border-collapse: collapse;
            border: #666 1px solid;
            width: 100%;
        }
        table.main th,
        table.main td {
            text-align: left;
            padding: 3px;
            border: 1px solid #666;
        }
        table.main tr.title {
            background-color: #ccc;
        }

        /*table.main tr:nth-child(even){background-color: #f2f2f2}*/

        .footer {
            float: left;
            margin-bottom: 15px;
            width: 100%;
        }
        .chuky {
            float: left;
            margin-bottom: 15px;
            width: 100%;
        }
        .noprint {
            float: left;
            text-align: center;
            width: 100%;
        }
        .linkbutton {
            height: 30px;
        }
        @media print {
            .noprint {
                display: none;
            }
            @page {
                margin: 0;
            }
            body {
                margin: 1.6cm;
            }
        }
    </style>
</head>
<body>
    <div class="letter-head">
        <table>
            <tr>
                <td class="col-left">
                    <img src="https://gemstech.com.vn/uploads/home/logo-2.png" height="40"><br>
                    Số 2, Vương Thừa Vũ<br>
                    Quận Thanh Xuân, Tp Hà Nội<br>
                    034 678 8118
                </td>
                <td class="col-right">
                    Báo giá số: 011<br>
                    Ngày tạo: 29/11/2021<br>
                    Có giá trị đến: 29/12/2021
                </td>
            </tr>
        </table>
    </div>
    <div class="title">
        <h1>BÁO GIÁ</h1>
    </div>
    <div class="noidung">
        <p>
            Hôm nay, ngày....tháng .... năm 2020, Hợp đồng Dịch vụ được thành lập bởi và giữa:
        </p>
        <p>
            <span class="indam">Bên A: CÔNG TY CỔ PHẦN ROLATEX</span><br />
            Trụ sở chính tại Hà Nội: Tầng 7, tòa nhà SeaProdex, số 20 Láng Hạ,Đống Đa, Hà Nội <br />
            Chi nhánh Hồ Chí Minh: Tầng 8, tòa nhà Loyal, 151 Võ Thị Sáu, Quận 3, Hồ Chí Minh <br />
            Chi nhánh Đà Nẵng: Số 1254 Xô Viết Nghệ Tĩnh, Quận Hải Châu, Đà Nẵng <br />
            Mã số thuế: 0108432485 Điện thoại: 024 8586 9856 <br />
            Đại diện bởi: Ông Lê Phước Quang Huy &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; Chức vụ: Phó Giám Đốc <br />
            (Giấy ủy quyền số: 01/2019/RLT-UQ ký ngày 20/06/2019) <br />
            (Dưới đây gọi tắt là Bên A)
        </p>
        <p>
            <span class="indam">
                Bên B:
                <?php echo $this->donhang['khachhang']; ?>
            </span>
            <br />
            Địachỉ:
            <?php echo $this->donhang['diachi']; ?><br />
            Số điện thoại:
            <?php echo $this->donhang['dienthoai']; ?><br />
            Đại diện bởi:
            <?php echo $this->donhang['daidien']; ?> &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; Chức vụ:
            <?php echo $this->donhang['chucvu']; ?><br />
            (Dưới đây gọi tắt là Bên B)
        </p>
        <p>
            Hai bên đã thống nhất thoả thuận và ký kết Hợp đồng nguyên tắc cung cấp dịch vụ nhân sự này (dưới đây gọi tắt là “Hợp đồng”) với những điều kiện và điều khoản như sau:
        </p>
        <p>
            <span class="indam">ĐIỀU 1: PHẠM VI DỊCH VỤ</span>
            <br />
            1.1. Theo bản Hợp đồng này, Bên B đồng ý để Bên A cung cấp dịch vụ tư vấn cung cấp nhân sự (gọi tắt là “Dịch vụ”) cho Bên B trong thời hạn 12 (mười hai) tháng kể từ ngày ký Hợp đồng. <br />
            1.2. Mỗi khi có nhu cầu sử dụng dịch vụ của Bên A, Bên B thông báo đến Bên A bằng Văn bản Yêu cầu Cung cấp dịch vụ qua văn bản chính thức, điện thoại, thư điện tử, hoặc fax, trong đó nêu cụ thể các chi tiết về vị trí cần tuyển,
            bao gồm: <br />
            a. Chức danh và mô tả côngviệc <br />
            b. Mức lương và các chế độ chính sách <br />
            c. Các yêu cầu đối với các ứng viên <br />
            d. Thời hạn dự kiến ứng viên sẽ bắt đầu đi làm <br />
            1.3. Văn bản yêu cầu Dịch vụ được Bên B gửi đến Bên A được xem như phụ lục Hợp đồng và là một phần không thể tách rời của Hợp đồng này. <br />
            1.4. Trên cơ sở Dịch Vụ mà Bên A cung cấp, Bên B sẽ thanh toán phí Dịch Vụ theo quy định tại Điều 5 của Hợp đồng này <br />
            1.5. Bên A sẽ thực hiện việc tìm kiếm, phỏng vấn, đánh giá và giới thiệu những ứng viên phù hợp với yêu cầu của Bên B trong vòng 05 – 07 ngày làm việc kể từ ngày nhận được đầy đủ thông tin yêu cầu để tiến hành quy trình tuyển
            dụng cho Bên B.
        </p>
        <p>
            <span class="indam">ĐIỀU 2: QUYỀN VÀ NGHĨA VỤ CỦA BÊN A</span>
            <br />
            2.1. Bên A cam kết không giới thiệu công việc khác cho ứng viên trúng tuyển đang làm việc tại công ty Bên B, trừ khi ứng viên đã nghỉ việc hoặc đã từ chức, và/hoặc ứng viên trực tiếp và chủ động tiếp cận nhà tuyển dụng cho công
            việc khác. <br />
            2.2. Bên A cam kết cung cấp nhân sự đúng yêu cầu và chế độ theo Điều 1.2 của Hợp đồng này <br />
            2.3. Sau thời hạn tối đa 07 ngày kể từ ngày nhận được đầy đủ yêu cầu cung cấp dịch vụ của Bên B, nếu Bên A không tìm được ứng viên theo yêu cầu thì Bên A phải gửi thông báo bằng văn bản đến Bên B. Hai Bên sẽ trao đổi trên tinh
            thần hỗ trợ lẫn nhau để hoàn thành Dịch vụ <br />
            2.4. Quy trình xác nhận ứng viên của Bên A giới thiệu cho Bên B: Bên A sẽ gửi thông tin sơ bộ của ứng viên đến Bên B bao gồm họ tên đầy đủ, ngày tháng năm sinh, kinh nghiệm làm việc của ứng viên trong vòng 05 – 07 ngày làm việc
            ngay sau khi nhận được yêu cầu từ Bên B. <br />
            2.5. Sau khi ứng viên Bên A đi làm, Bên A có trách hợp nhiệm theo dõi ứng viên trong suốt quá trình bảo hành. Nếu hết thời hạn bảo hành, Bên A sẽ đẩy tiếp hồ sơ phù hợp qua Bên B nếu ứng viên đó nghỉ dựa trên tình thần hỗ trợ
            giữa hai Bên và phí dịch vụ vẫn tính cho ứng tuyển thành công cho Bên A.
        </p>
        <p>
            <span class="indam">ĐIỀU 3: QUYỀN VÀ NGHĨA VỤ CỦA BÊN B:</span>
            <br />
            3.1. Bên B phải thông báo đầy đủ đến Bên A thông tin về kết quả đánh giá của Bên B đối với các ứng viên mà Bên A chuyển cho Bên B kiểm tra và phỏng vấn chậm nhất là 03 (ba) ngày làm việc sau khi kiểm tra và phỏng vấn với Bên B.
            <br />
            3.2. Trong suốt quá trình tuyển dụng, Bên B có quyền giữ lại hồ sơ của những ứng viên của Bên A chưa đạt yêu cầu cho vị trí đang cần tuyển. Tuy nhiên, nếu các ứng viên của Bên A đã gửi Bên B chưa đạt yêu cầu tuyển dụng cho các
            vị trí trước, nhưng sau đó được Bên B mời tham gia dự tuyển cho bất kỳ các vị trí khác và được đỗ tuyển thì Bên B sẽ vẫn phải trả phí tuyển dụng cho Bên A theo quy định nêu ở điều 4 dưới đây. Thời gian áp dụng quy định là 24
            tháng kể từ ngày Bên A gửi hồ sơ của ứng viên cho Bên B. <br />
            3.3. Hợp tác và hỗ trợ Bên A điều chỉnh lại yêu cầu ứng viên nếu chế độ của Bên B chưa phù hợp với thị trường tuyển dụng hiện tại hoặc ứng viên không đồng ý đi làm Bên B mặc dù ứng viên Đạt; <br />
            3.4. Thanh toán đầy đủ và đúng hạn cho Bên A theo điều 4 của Hợp đồng này; <br />
            3.5. Cam kết trao đổi với ứng viên theo đúng yêu cầu công việc mà Bên B đã gửi sang Bên A. Nếu Bên B thay đổi yêu cầu khác dẫn đến ứng viên không đồng ý làm việc cho Bên B thì quá trình tuyển dụng sẽ dừng lại cho đến khi hai Bên
            thống nhất yêu cầu dịch vụ thì Dịch vụ sẽ tiếp tục triển khai. <br />
            3.6. Sau khi Bên B nhận ứng viên Bên A, Bên B có trách nhiệm hướng dẫn, đào tạo và giữ ứng viên làm việc lâu dài
        </p>
        <p>
            <span class="indam">ĐIỀU 4: PHÍ DỊCH VỤ VÀ THANH TOÁN</span>
            <br />
            4.1. Phí dịch vụ cụ thể như sau: 1.500.000 VNĐ/01 ứng viên (chưa bao gồm thuế GTGT 10%). <br />
            4.2. Hình thức thanh toán. Bên B có thể thanh toán trực tiếp bằng tiền mặt hoặc chuyển khoản vào tài khoản Bên B theo hai giai đoạn sau: <br />
            - Thanh toán 50% ngay sau khi ký hơp đồng. <br />
            - Thanh toán phí còn lại khi sau 03 ngày kể từ ngày đầu tiên ứng viên đi làm <br />
            4.3. Phí dịch vụ sẽ được tính bằng VNĐ tại thời điểm phát hành phiếu Yêu Cầu Thanh Toán Bên A gửi đến Bên B. Phí dịch vụ sẽ được thanh toán bằng tiền mặt hoặc chuyển khoản đến tài khoản Đối với Bên B tại Hà Nội <br />
            Số tài khoản: 700570406001539 <br />
            Tên ngân hàng: TMCP Sài Gòn Công Thương - Chi nhánh Long Biên <br />
            Đối với Bên B tại Hồ Chí Minh <br />
            Số tài khoản: 0251002770688 <br />
            Tên ngân hàng: TMCP Ngoại Thương Việt Nam - Chi nhánh Bình Tây - Hồ Chí Minh <br />
            Đối với Bên B tại Đà Nẵng <br />
            Số tài khoản: 0041000355904 <br />
            Tên ngân hàng: TMCP Ngoại Thương Việt Nam - Chi nhánh Đà Nẵng
        </p>
        <p>
            <span class="indam">ĐIỀU 5: BẢO HÀNH</span>
            <br />
            5.1. Bên A có trách nhiệm làm việc chặt chẽ cả với ứng viên trúng tuyển và Bên B trong thời gian bảo hành. <br />
            5.2. Tổng thời gian bảo hành dành cho Bên B về ứng viên trúng tuyển của Bên A là 01(Một) tháng. Trong quá trình 01 tháng bảo hành, nếu ứng viên được tuyển thành công đó không đáp ứng được yêu cầu công việc hoặc tự ý nghỉ việc,
            Bên A có trách nhiệm thay thế miễn phí tối đa 01(một) ứng viên thành công khác cho Bên B với điều kiện Bên A đã nhận được thanh toán đầy đủ và đúng hạn từ Bên B. <br />
            5.3. Nếu trong quá trình bảo hành Bên A đã đổi người thay thế mà ứng viên đi làm rồi nghỉ thì Bên A gửi hồ sơ thêm ứng viên nếu phù hợp với Bên B dựa trên tinh thần hỗ trợ hoặc hai Bên sẽ thỏa thuận. <br />
            5.4. Điều khoản bảo hành không được áp dụng cho trường hợp khi ứng viên được tuyển bị sa thải do sự thay đổi cơ cấu nhân sự của Bên B, không bao gồm nhưng không giới hạn bởi việc tái cơ cấu, giảm biên chế, tiếp quản hoặc thay
            đổi bản chất về trách nhiệm của công việc. Trong trường hợp Bên B thay đổi yêu cầu tuyển dụng và không có nhu cầu tuyển người thay thế thì Bên A sẽ không hoàn lại Phí dịch vụ. Nếu Bên B đơn phương hủy đơn hàng sẽ bị mất khoản
            tiền cọc đã tạm ứng cho Bên A.
        </p>
        <p>
            <span class="indam">ĐIỀU 6: PHẠT VI PHẠM HỢP DỒNG</span>
            <br />
            6.1. Phạt không thực hiện đúng nội dung Hợp đồng: Trừ trường hợp bất khả kháng hoặc, nếu một trong các Bên không thực hiện đúng theo nội dung đã được thỏa thuận trong Hợp đồng này thì Bên vi phạm phải ngay lập tức dừng hành vi
            vi phạm, khắc phục các hậu quả của hành vi vi phạm trong một khoảng thời gian nhất định do Bên còn lại đưa ra và số tiền phạt cho một ngày vi phạm thời hạn báo trước là 8% phí dịch vụ hàng được quy định chi tiết trong Phụ lục
            Hợp đồng. Bên vi phạm có nghĩa vụ bồi thường thiệt hại phát sinh do hành vi vi phạm của mình. <br />
            6.2. Nếu trong quá trình thực hiện Hợp đồng, Bên B tự ý thay đổi yêu cầu so với Hợp đồng và phụ luc Hợp đồng mà không có sự đồng thuận của Bên A hoặc không thanh toán đúng hạn như cam kết tại điều 4 hoặc dừng dịch vụ mà không
            phải lỗi bên A, thì bên B phải chịu hoàn toàn trách nhiệm đồng thời chịu mức phạt cho những ngày vi phạm của Bên B gây ra cho Bên A. Số tiền phạt cho một ngày vi phạm thời hạn báo trước là 8% trên tổng giá phí dịch vụ <br />
            6.3. Nếu trong quá trình thực hiện Hợp đồng, Bên A không thể tìm kiếm ứng viên thay thế đạt yêu cầu của Bên B trong thời hạn tối đa là 30 ngày làm việc kể từ khi nhận được yêu cầu thay thế từ Bên B thì Bên A sẽ hoàn trả 100% của
            tổng chi phí mà Bên B đã chi trả cho Bên A. Bên B sẽ nhận được hoàn phí trong vòng 10 (mười) ngày làm việc sau khi Bên A gửi văn bản xác nhận không thể tìm kiếm ứng viên thay thế đạt yêu cầu và nhận được yêu cầu hoàn phí từ Bên
            B. <br />
            6.4. Đơn phương chấm dứt Hợp đồng: Nếu hết thời hạn thỏa thuận mà Bên vi phạm vẫn không chấm dứt hành vi vi phạm và/hoặc không khắc phục các hậu quả của hành vi vi phạm thì Bên còn lại có quyền ngay lập tức chấm dứt Hợp đồng
            này. Bên vi phạm phải chịu khoản tiền phạt là 8% giá trị phần dịch vụ bị vi phạm và có nghĩa vụ bồi thường mọi thiệt hại phát sinh do hành vi vi phạm của Bên vi phạm gây ra.
        </p>
        <p>
            <span class="indam">ĐIỀU 7: BẢO MẬT</span>
            <br />
            7.1. Bên A tuân thủ bảo mật thông tin cung cấp bởi Bên B để thực hiện nhiệm vụ được quy định trong các điều khoản và điều kiện của Hợp đồng này. Với sự đồng ý của Bên B, Bên A sẽ chỉ tiết lộ những thông tin bảo mật này với những
            người có liên quan trọng công việc tuyển dụng hoặc với những ứng viên thích hợp/tiềm năng có nhu cầu nắm được thông tin về Bên B để ứng tuyển. <br />
            7.2. Ngược lại, Bên A yêu cầu Bên B đảm bảo tính bảo mật tương tự liên quan đến những điều khoản và điều kiện của Hợp đồng này, và thông tin cá nhân của ứng viên được cung cấp bởi Bên A và/ hoặc ứng viên của Bên A
        </p>
        <p>
            <span class="indam">ĐIỀU 8: HIỆU LỰC HỢP ĐỒNG</span>
            <br />
            8.1. Hợp đồng này có hiệu lực kể từ ngày ký./. <br />
            8.2. Hợp đồng này gồm 04 trang được lập thành 02 (hai) bản. Mỗi bên giữ một 01 (một) bản có giá trị pháp lý như nhau. <br />
            8.3. Hợp đồng này sẽ tự động được gia hạn và tiếp tục có hiệu lực nếu một trong hai Bên không có thông báo chấm dứt bằng văn bản chính thức cho Bên kia trước khi hết hạn Hợp đồng 30 ngày <br />
            8.4. Tất cả các sửa đổi đều không có giá trị trừ khi thực hiện bằng văn bản và được ký kết bởi các Bên.
        </p>
        <p>
            <span class="indam">ĐIỀU 9: ĐIỀU KHOẢN KHÁC</span>
            Trong trường hợp có bất kỳ sự bất đồng ý kiến nào phát sinh theo Hợp đồng này, các Bên cam kết giải quyết vấn đề trên thương lương. Nếu vẫn không thể đạt được sự thống nhất trong vòng 30 ngày, vấn đề sẽ được gửi đến Trung tâm
            Trọng tài Quốc tế Việt Nam bên cạnh Phòng Thương mại và Công nghiệp Việt Nam gồm ba trọng tài viên. Mỗi Bên sẽ đề cử một trọng tài viên, người sẽ lần lượt đồng ý việc chỉ định trọng tài viên thứ ba, là trọng tài phân xử.
        </p>
        <br />
        <p><span style="margin-left: 200px;">ĐẠI DIỆN BÊN A</span><span style="float: right; margin-right: 200px;">ĐẠI DIỆN BÊN B</span></p>
    </div>
    <div class="footer"></div>
    <div class="chuky"></div>
    <div class="noprint">
        <button class="linkbutton" onClick="window.print();">In ra</button>
        <button class="linkbutton" onClick="window.location.href = 'baogia'">Quay lại danh sách báo giá</button>
    </div>
</body>
</html>
