<?php
class System_Model extends Model
{
  function __construct()
  {
    parent::__construct();
  }

  function checkId($id)
  {
    $query = $this->db->query("SELECT COUNT(1) AS total
        FROM staffs WHERE id=$id AND status > 0");
    if ($query) {
      $result = $query->fetchAll(PDO::FETCH_ASSOC);
      $total = $result[0]['total'];
      if ($total == 0)
        return 0;
      else
        return 1;
    }
  }

  function checkOldPassword($id, $password)
  {
    $password = md5(md5($password));
    $query = $this->db->query("SELECT COUNT(1) AS total
        FROM users WHERE staffId=$id AND password LIKE '$password' AND status > 0 ");
    if ($query) {
      $result = $query->fetchAll(PDO::FETCH_ASSOC);
      $total = $result[0]['total'];
      if ($total == 0)
        return 0;
      else
        return 1;
    }
  }

  function changePassword($id, $password)
  {
    $password = md5(md5($password));
    $query = $this->db->query("SELECT id
        FROM users WHERE staffId=$id AND status > 0 ");
    if ($query) {
      $result = $query->fetchAll(PDO::FETCH_ASSOC);
      $id = $result[0]['id'];
      if ($this->update("users", ['password' => $password], "id=$id"))
        return 1;
      else
        return 0;
    }
  }

  function checkEmail($email)
  {
    $query = $this->db->query("SELECT COUNT(1) AS total
        FROM staffs WHERE email LIKE '$email' AND status > 0 ");
    if ($query) {
      $result = $query->fetchAll(PDO::FETCH_ASSOC);
      $total = $result[0]['total'];
      if ($total > 0)
        return 1;
      else
        return 0;
    }
  }

  function updateActiveCode($email, $activeCode)
  {
    $query = $this->db->query("SELECT (SELECT id FROM users WHERE staffId = a.id AND status > 0) AS userid
        FROM staffs a WHERE email LIKE '$email' AND status > 0 ");
    $result = $query->fetchAll(PDO::FETCH_ASSOC);
    $userid = $result[0]['userid'];
    $result = $this->update("users", ['activeCode' => $activeCode], "id=$userid");
    if ($result)
      return 1;
    else
      return 0;
  }

  function sendEmail($email, $activeCode)
  {
    $query = $this->db->query("SELECT name
        FROM staffs WHERE email LIKE '$email' AND status > 0 ");
    $result = $query->fetchAll(PDO::FETCH_ASSOC);
    $name = $result[0]['name'];
    if ($name == '') {
      $name = 'bạn';
    }
    $noidung = '<!DOCTYPE">
        <html>
        <head>
          <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
          <meta name="viewport" content="width=device-width, initial-scale=1.0">
          <meta name="x-apple-disable-message-reformatting">
          <meta http-equiv="X-UA-Compatible" content="IE=edge">
          <title></title>
          <style type="text/css">
            table,
            td {color: #000000;}
            a {color: #0000ee;text-decoration: underline;}
            @media only screen and (min-width: 620px) {
              .u-row {width: 600px !important;}
              .u-row .u-col {vertical-align: top;}
              .u-row .u-col-100 {width: 600px !important;}
            }
            @media (max-width: 620px) {
              .u-row-container {
                max-width: 100% !important;
                padding-left: 0px !important;
                padding-right: 0px !important;
              }
              .u-row .u-col {
                min-width: 320px !important;
                max-width: 100% !important;
                display: block !important;
              }
              .u-row {width: calc(100% - 40px) !important;}
              .u-col {width: 100% !important;}
              .u-col>div {margin: 0 auto;}
            }
            body {margin: 0;padding: 0;}
            table,tr,td {vertical-align: top;border-collapse: collapse;}
            p {margin: 0;}
            .ie-container table,
            .mso-container table {table-layout: fixed;}
            * {line-height: inherit;}
            a[x-apple-data-detectors="true"] {
              color: inherit !important;
              text-decoration: none !important;
            }
            .box-active {
                width: 75px;
                margin: 0 auto;
                font-size: 11px;
                font-family: LucidaGrande,tahoma,verdana,arial,sans-serif;
                padding: 10px;
                background-color: #f2f2f2;
                border-left: 1px solid #ccc;
                border-right: 1px solid #ccc;
                border-top: 1px solid #ccc;
                border-bottom: 1px solid #ccc;
            }
            .active-code {
                font-family: Helvetica Neue,Helvetica,Lucida Grande,tahoma,verdana,arial,sans-serif;
                font-size: 16px;
                line-height: 21px;
                color: #141823;
            }
          </style>
          <link href="https://fonts.googleapis.com/css?family=Cabin:400,700" rel="stylesheet" type="text/css">
        </head>
        <body class="clean-body u_body" style="margin: 0;padding: 0;-webkit-text-size-adjust: 100%;background-color: #f9f9f9;color: #000000">
          <table style="border-collapse: collapse;table-layout: fixed;border-spacing: 0;mso-table-lspace: 0pt;mso-table-rspace: 0pt;vertical-align: top;min-width: 320px;Margin: 0 auto;background-color: #f9f9f9;width:100%" cellpadding="0" cellspacing="0">
            <tbody>
              <tr style="vertical-align: top">
                <td style="word-break: break-word;border-collapse: collapse !important;vertical-align: top">
                  <div class="u-row-container" style="padding: 0px;background-color: transparent">
                    <div class="u-row" style="Margin: 0 auto;min-width: 320px;max-width: 600px;overflow-wrap: break-word;word-wrap: break-word;word-break: break-word;background-color: transparent;">
                      <div style="border-collapse: collapse;display: table;width: 100%;background-color: transparent;">
                        <div class="u-col u-col-100" style="max-width: 320px;min-width: 600px;display: table-cell;vertical-align: top;">
                          <div style="width: 100% !important;">
                            <div style="padding: 0px;border-top: 0px solid transparent;border-left: 0px solid transparent;border-right: 0px solid transparent;border-bottom: 0px solid transparent;">
                              <table style="font-family:Cabin,sans-serif;" role="presentation" cellpadding="0" cellspacing="0" width="100%" border="0">
                                <tbody>
                                  <tr>
                                    <td style="overflow-wrap:break-word;word-break:break-word;padding:10px;font-family:Cabin,sans-serif;" align="left">
                                      <div style="color: #afb0c7; line-height: 170%; text-align: center; word-wrap: break-word;">
                                        <p style="font-size: 14px; line-height: 170%;"><span style="font-size: 14px; line-height: 23.8px;">View Email in Browser</span></p>
                                      </div>
                                    </td>
                                  </tr>
                                </tbody>
                              </table>
                            </div>
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>
                  <div class="u-row-container" style="padding: 0px;background-color: transparent">
                    <div class="u-row" style="Margin: 0 auto;min-width: 320px;max-width: 600px;overflow-wrap: break-word;word-wrap: break-word;word-break: break-word;background-color: #ffffff;">
                      <div style="border-collapse: collapse;display: table;width: 100%;background-color: transparent;">
                        <div class="u-col u-col-100" style="max-width: 320px;min-width: 600px;display: table-cell;vertical-align: top;">
                          <div style="width: 100% !important;">
                            <div style="padding: 0px;border-top: 0px solid transparent;border-left: 0px solid transparent;border-right: 0px solid transparent;border-bottom: 0px solid transparent;">
                              <table style="font-family:Cabin,sans-serif;" role="presentation" cellpadding="0" cellspacing="0" width="100%" border="0">
                                <tbody>
                                  <tr>
                                    <td style="overflow-wrap:break-word;word-break:break-word;padding:20px;font-family:Cabin,sans-serif;" align="left">
                                      <table width="100%" cellpadding="0" cellspacing="0" border="0">
                                        <tr>
                                          <td style="padding-right: 0px;padding-left: 0px;" align="center">
                                            <img align="center" border="0" src="https://s3.amazonaws.com/unroll-images-production/projects%2F53466%2F1639464553282-Logo+G-Office-200.png" alt="Image" title="Image" style="outline: none;text-decoration: none;-ms-interpolation-mode: bicubic;clear: both;display: inline-block !important;border: none;height: auto;float: none;width: 32%;max-width: 179.2px;"
                                              width="179.2" />
                                          </td>
                                        </tr>
                                      </table>
                                    </td>
                                  </tr>
                                </tbody>
                              </table>
                            </div>
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>
                  <div class="u-row-container" style="padding: 0px;background-color: transparent">
                    <div class="u-row" style="Margin: 0 auto;min-width: 320px;max-width: 600px;overflow-wrap: break-word;word-wrap: break-word;word-break: break-word;background-color: #ffffff;">
                      <div style="border-collapse: collapse;display: table;width: 100%;background-color: transparent;">
                        <div class="u-col u-col-100" style="max-width: 320px;min-width: 600px;display: table-cell;vertical-align: top;">
                          <div style="width: 100% !important;">
                            <div style="padding: 0px;border-top: 0px solid transparent;border-left: 0px solid transparent;border-right: 0px solid transparent;border-bottom: 0px solid transparent;">
                              <table style="font-family:Cabin,sans-serif;" role="presentation" cellpadding="0" cellspacing="0" width="100%" border="0">
                                <tbody>
                                  <tr>
                                    <td style="overflow-wrap:break-word;word-break:break-word;padding:33px 55px;font-family:Cabin,sans-serif;" align="left">
                                      <div style="line-height: 160%; text-align: center; word-wrap: break-word;">
                                        <p style="font-size: 14px; line-height: 160%;"><span style="font-size: 22px; line-height: 35.2px;">Xin ch&agrave;o ' . $name . ' </span></p>
                                        <p style="font-size: 14px; line-height: 160%;"><span style="font-size: 18px; line-height: 28.8px;">Chúng tôi đã nhận được yêu cầu đặt lại mật khẩu tài khoản G-office của bạn <br /></span></p>
                                        <p style="font-size: 14px; line-height: 160%;"><span style="font-size: 18px; line-height: 28.8px;">Nhập mã đặt lại mật khẩu sau đây: <br/> </span></p>
                                        <div class="box-active"><span class="active-code">' . $activeCode . '</span></div>
                                      </div>
                                    </td>
                                  </tr>
                                </tbody>
                              </table>
                              <table style="font-family:Cabin,sans-serif;" role="presentation" cellpadding="0" cellspacing="0" width="100%" border="0">
                                <tbody>
                                  <tr>
                                    <td style="overflow-wrap:break-word;word-break:break-word;padding:33px 55px 60px;font-family:Cabin,sans-serif;" align="left">
                                      <div style="line-height: 160%; text-align: center; word-wrap: break-word;">
                                        <p style="line-height: 160%; font-size: 14px;"><span style="font-size: 18px; line-height: 28.8px;">Thanks,</span></p>
                                        <p style="line-height: 160%; font-size: 14px;"><span style="font-size: 18px; line-height: 28.8px;">Team ph&aacute;t triển phần mềm G-office<br /></span></p>
                                      </div>
                                    </td>
                                  </tr>
                                </tbody>
                              </table>
                            </div>
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>
                  <div class="u-row-container" style="padding: 0px;background-color: transparent">
                    <div class="u-row" style="Margin: 0 auto;min-width: 320px;max-width: 600px;overflow-wrap: break-word;word-wrap: break-word;word-break: break-word;background-color: #e5eaf5;">
                      <div style="border-collapse: collapse;display: table;width: 100%;background-color: transparent;">
                        <div class="u-col u-col-100" style="max-width: 320px;min-width: 600px;display: table-cell;vertical-align: top;">
                          <div style="width: 100% !important;">
                            <div style="padding: 0px;border-top: 0px solid transparent;border-left: 0px solid transparent;border-right: 0px solid transparent;border-bottom: 0px solid transparent;">
                              <table style="font-family:Cabin,sans-serif;" role="presentation" cellpadding="0" cellspacing="0" width="100%" border="0">
                                <tbody>
                                  <tr>
                                    <td style="overflow-wrap:break-word;word-break:break-word;padding:41px 55px 18px;font-family:Cabin,sans-serif;" align="left">
                                      <div style="color: #003399; line-height: 160%; text-align: center; word-wrap: break-word;">
                                        <p style="font-size: 14px; line-height: 160%;"><span style="font-size: 20px; line-height: 32px;"><strong>Hotline hỗ trợ<br /></strong></span></p>
                                        <p style="font-size: 14px; line-height: 160%;"><span style="font-size: 16px; line-height: 25.6px; color: #000000;">034-678-8118</span></p>
                                        <p style="font-size: 14px; line-height: 160%;"><span style="font-size: 16px; line-height: 25.6px; color: #000000;">Info@gemstech.com.vn</span></p>
                                      </div>
                                    </td>
                                  </tr>
                                </tbody>
                              </table>
                            </div>
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>
                  <div class="u-row-container" style="padding: 0px;background-color: transparent">
                    <div class="u-row" style="Margin: 0 auto;min-width: 320px;max-width: 600px;overflow-wrap: break-word;word-wrap: break-word;word-break: break-word;background-color: #003399;">
                      <div style="border-collapse: collapse;display: table;width: 100%;background-color: transparent;">
                        <div class="u-col u-col-100" style="max-width: 320px;min-width: 600px;display: table-cell;vertical-align: top;">
                          <div style="width: 100% !important;">
                            <div style="padding: 0px;border-top: 0px solid transparent;border-left: 0px solid transparent;border-right: 0px solid transparent;border-bottom: 0px solid transparent;">
                              <table style="font-family:Cabin,sans-serif;" role="presentation" cellpadding="0" cellspacing="0" width="100%" border="0">
                                <tbody>
                                  <tr>
                                    <td style="overflow-wrap:break-word;word-break:break-word;padding:10px;font-family:Cabin,sans-serif;" align="left">
                                      <div style="color: #fafafa; line-height: 180%; text-align: center; word-wrap: break-word;">
                                        <p style="font-size: 14px; line-height: 180%;"><span style="font-size: 16px; line-height: 28.8px;">Copyrights &copy; Gemstech All Rights Reserved</span></p>
                                      </div>
                                    </td>
                                  </tr>
                                </tbody>
                              </table>
                            </div>
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>
                </td>
              </tr>
            </tbody>
          </table>
        </body>
        </html>';

    $from = ['Email' => 'info@gemstech.com.vn', 'Name' => 'G-office'];
    $tolist = [['Email' => $email, 'Name' => 'Khách hàng']];
    $subject = 'Mã khôi phục tài khoản G-office của bạn';
    $textpart = 'Email from GOFFICE';
    $result = $this->sendmail($from, $tolist, [], [], $subject, $noidung, $textpart);
    if ($result)
      return 1;
    else
      return 0;
  }

  function checkActiveCode($email, $activeCode)
  {
    $query = $this->db->query("SELECT id,(SELECT id FROM users WHERE staffId = a.id AND status > 0) AS userid
        FROM staffs a WHERE email LIKE '$email' AND status > 0 ");
    $result = $query->fetchAll(PDO::FETCH_ASSOC);
    $staffId = $result[0]['id'];
    $userid = $result[0]['userid'];
    $query = $this->db->query("SELECT COUNT(1) AS total
        FROM users WHERE id = $userid AND activeCode = $activeCode AND status > 0 ");
    if ($query) {
      $result = $query->fetchAll(PDO::FETCH_ASSOC);
      $total = $result[0]['total'];
      if ($total > 0)
        return $activeCode;
      else
        return 0;
    }
  }

  // function check_in($username, $password){
  //     $query = $this->db->query("SELECT id, email, nhan_vien, nhom,token,
  //       (SELECT name FROM staffs WHERE id=nhan_vien) AS hoten,
  //       (SELECT hinh_anh FROM staffs WHERE id=nhan_vien) AS hinhanh,
  //     (SELECT ip FROM chinhanh WHERE chinhanh.id=(SELECT chi_nhanh FROM hopdongld
  //     WHERE hopdongld.nhan_vien=users.nhan_vien LIMIT 1)) AS ip
  //       FROM users WHERE tinh_trang=1 AND name = '$username' AND mat_khau = '$password'");
  //     $row = $query->fetchAll(PDO::FETCH_ASSOC);
  //     if (isset($row[0]))
  //         return $row[0];
  //     else
  //         return [];
  // }

  // function check_in_token($token){
  //     $query = $this->db->query("SELECT id, email, nhan_vien, nhom,token,
  //       (SELECT name FROM staffs WHERE id=nhan_vien) AS hoten,
  //       (SELECT hinh_anh FROM staffs WHERE id=nhan_vien) AS hinhanh,
  //     (SELECT ip FROM chinhanh WHERE chinhanh.id=(SELECT chi_nhanh FROM hopdongld
  //     WHERE hopdongld.nhan_vien=users.nhan_vien LIMIT 1)) AS ip
  //       FROM users WHERE tinh_trang=1 AND token='$token'");
  //     $row = $query->fetchAll(PDO::FETCH_ASSOC);
  //     if (isset($row[0]))
  //         return $row[0];
  //     else
  //         return [];
  // }

  // function update_token($username, $password, $token){
  //     $query = $this->update("users", ['token'=>$token], "name = '$username' AND mat_khau = '$password' ");
  //     return $query;
  // }

  // function update_deadline(){
  //     $today = date('Y-m-d',strtotime('+ 2 day'));
  //     $query = $this->update("congviec", ['tinh_trang'=>3,'label'=>'Deadline'], " tinh_trang IN (1,2) AND deadline<'$today' ");
  //     return $query;
  // }

  // function logout($token){
  //     $id = $_SESSION['user']['id'];
  //     if($token!='') {
  //         $query = $this->update("users", ['token' => ''], "id = $id ");
  //         return $query;
  //     }
  //     return true;
  // }
}
