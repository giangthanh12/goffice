<?php
class Auth_Model extends Model
{
  function __construst()
  {
    parent::__construst();
  }

  function checkIn($username, $password)
  {
    $query = $this->db->query("SELECT id, username, staffId,classify,groupId,token, extNum, sipPass,
          (SELECT name FROM staffs WHERE id=staffId) AS staffName,
       (SELECT email FROM staffs WHERE id=staffId) AS email,
          (SELECT IF(avatar='',CONCAT('" . URLFILE . "','/uploads/useravatar.png'),CONCAT('" . URLFILE . "/',avatar)) FROM staffs WHERE id=staffId) AS avatar
        /*(SELECT ip FROM branch WHERE branch.id=(SELECT branch FROM laborcontract
        WHERE laborcontract.staffId=users.staffId LIMIT 1)) AS ipBranch */
          FROM users WHERE status=1 AND usernameMd5 = '$username' AND password = '$password'");
    $row = $query->fetchAll(PDO::FETCH_ASSOC);
    if (isset($row[0]))
      return $row[0];
    else
      return [];
  }

  function updateDeadline()
  {
    $today = date('Y-m-d', strtotime('+ 2 day'));
    $query = $this->update("task", ['status' => 3, 'label' => 'Deadline'], " status IN (1,2) AND deadline<'$today' ");
    return $query;
  }

  function checkEmail($email)
  {
    $query = $this->db->query("SELECT id,name,COUNT(id) total FROM staffs WHERE email='$email' AND status>0");
    $temp = $query->fetchAll(PDO::FETCH_ASSOC);
    if ($temp[0]['total'] > 0) {
      $result = array();
      $staffId = $temp[0]['id'];
      $result['name'] = $temp[0]['name'];
      $query = $this->db->query("SELECT id FROM users WHERE staffId=$staffId AND status>0");
      $temp = $query->fetchAll(PDO::FETCH_ASSOC);
      $result['userId'] = $temp[0]['id'];
      return $result;
    } else
      return 0;
  }

  function addActiveCode($id, $data)
  {
    $result = $this->update('users', $data, " id=$id ");
    return $result;
  }

  function checkActiveCode($activeCode)
  {
    $query = $this->db->query("SELECT id,COUNT(id) AS total
        FROM users WHERE MD5(MD5(activeCode)) = '$activeCode' AND status > 0 ");
    if ($query) {
      $result = $query->fetchAll(PDO::FETCH_ASSOC);
      $total = $result[0]['total'];
      if ($total > 0)
        return $result[0]['id'];
      else
        return 0;
    }
  }

  function changePass($id, $data)
  {
    $result = $this->update('users', $data, " id=$id ");
    if ($result)
      return 1;
    else
      return 0;
  }

  function sendEmail($email, $name, $activeCode)
  {
    if ($name == '')
      $name = 'bạn';
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
                                        <p style="font-size: 14px; line-height: 160%;"><span style="font-size: 18px; line-height: 28.8px;">Click vào link sau đây để đặt lại mật khẩu: <br/> </span></p>
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
    $subject = 'Xác nhận đổi mật khẩu tài khoản phần mềm G-office';
    $textpart = 'Email from GOFFICE';
    $result = $this->sendmail($from, $tolist, [], [], $subject, $noidung, $textpart);
    if ($result)
      return 1;
    else
      return 0;
  }
}
