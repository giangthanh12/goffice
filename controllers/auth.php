<?php

class auth extends Controller
{
    // private $_Data;
    function __construct()
    {
        parent::__construct();
        // $this->_Data = new Model();
    }

    function index(){

    }

    function login()
    {
        if (isset($_REQUEST['username']) && isset($_REQUEST['password'])) {
            $username = md5($_REQUEST['username']);
            $password = md5(md5($_REQUEST['password']));
            $data = $this->model->checkIn($username, $password);
            if (isset($data['id'])) {
                $jsonObj['code'] = 200;
                $jsonObj['data'] = $data;
                $_SESSION[SID] = true;
                $_SESSION['user'] = $data;
                $this->model->updateDeadline();
            } else {
                $jsonObj['message'] = "Thông tin đăng nhập không chính xác";
                $jsonObj['code'] = 401;
            }
        } else {
            $jsonObj['message'] = "Chưa nhập tài khoản hoặc mật khẩu ";
            $jsonObj['code'] = 402;
        }
        $jsonObj = json_encode($jsonObj);
        echo $jsonObj;
    }

    function logout()
    {
        session_destroy();
        http_response_code(200);
        $jsonObj['message'] = "Goodbye";
        $jsonObj['code'] = 200;
        $jsonObj = json_encode($jsonObj);
        echo $jsonObj;
    }

    function resetPassword() {
        $code = $_REQUEST['code'];
        $name = $_REQUEST['name'];
        $date = date("Y-m-d",strtotime( $_REQUEST['date']));
        $email = $_REQUEST['email'];
        $phone = $_REQUEST['phone'];
 
        if(empty($code) || empty($name) || empty($date) || empty($email) || empty($phone)) {
         $jsonObj['msg'] = "Không hợp lệ";
         $jsonObj['success'] = false;
        }
        else {
            if($this->model->checkInfoUser($code,$name,$date,$email,$phone)) {
               $data = $this->model->checkInfoUser($code,$name,$date,$email,$phone);
               $email = $data['email'];
               $username = $data['user']['username'];
               $password = functions::generateRandomString();
                // cập nhật customer, password
                $passwordUpdate = md5(md5($password));
                $this->model->updatePassword($data['user']['id'], $passwordUpdate);
                $subject = 'Kích hoạt mật khẩu GOFFICE';
                $from = ['Email' => 'info@gemstech.com.vn','Name' => 'GOFFICE'];
                $tolist = [['Email' => $email, 'Name' => 'Chia sẻ']];
                $cclist = [];
                $bcc = [];
                $textpart = 'Chia sẻ bài viết từ trang GOFFICE';
                $noidung =  $this->getContentMail($username,$password);
              
                functions::sendmail($from, $tolist, $cclist, $bcc, $subject, $noidung,$textpart);
                 $jsonObj['msg'] = "Vui lòng kiểm tra email để tiến hành lấy lại mật khẩu";
                 $jsonObj['success'] = true;
            }
            else {
             $jsonObj['msg'] = "Thông tin của bạn không chính xác";
             $jsonObj['success'] = false;
            }
 
         
        }
        echo json_encode($jsonObj);
     }

    function check_token()
    {
        if (isset($_REQUEST['token'])) {
            $token = $_REQUEST['token'];
            if ($this->model->check_token($token) > 0) {
                $jsonObj['msg'] = "Token có tồn tại";
                $jsonObj['success'] = true;
            } else {
                $jsonObj['msg'] = "Token không tồn tại";
                $jsonObj['success'] = false;
            }
            echo json_encode($jsonObj);
        }
    }


    function getContentMail($username, $password) {
        return '<div style="margin:0;padding:0;background-color:#f9f9f9;color:#000000">
        <table style="border-collapse:collapse;table-layout:fixed;border-spacing:0;vertical-align:top;min-width:320px;Margin:0 auto;background-color:#f9f9f9;width:100%" cellpadding="0" cellspacing="0">
          <tbody>
            <tr style="vertical-align:top">
              <td style="word-break:break-word;border-collapse:collapse!important;vertical-align:top">
                <div class="m_2025568036990400068u-row-container" style="padding:0px;background-color:transparent">
                  <div class="m_2025568036990400068u-row" style="Margin:0 auto;min-width:320px;max-width:600px;word-wrap:break-word;word-break:break-word;background-color:transparent">
                    <div style="border-collapse:collapse;display:table;width:100%;background-color:transparent">
                      <div class="m_2025568036990400068u-col m_2025568036990400068u-col-100" style="max-width:320px;min-width:600px;display:table-cell;vertical-align:top">
                        <div style="width:100%!important">
                          <div style="padding:0px;border-top:0px solid transparent;border-left:0px solid transparent;border-right:0px solid transparent;border-bottom:0px solid transparent">
                            <table style="font-family:Cabin,sans-serif" role="presentation" cellpadding="0" cellspacing="0" width="100%" border="0">
                              <tbody>
                                <tr>
                                  <td style="word-break:break-word;padding:10px;font-family:Cabin,sans-serif" align="left">
                                    <div style="color:#afb0c7;line-height:170%;text-align:center;word-wrap:break-word">
                                      <p style="font-size:14px;line-height:170%"><span style="font-size:14px;line-height:23.8px">View Email in Browser</span></p>
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
                <div class="m_2025568036990400068u-row-container" style="padding:0px;background-color:transparent">
                  <div class="m_2025568036990400068u-row" style="Margin:0 auto;min-width:320px;max-width:600px;word-wrap:break-word;word-break:break-word;background-color:#ffffff">
                    <div style="border-collapse:collapse;display:table;width:100%;background-color:transparent">
                      <div class="m_2025568036990400068u-col m_2025568036990400068u-col-100" style="max-width:320px;min-width:600px;display:table-cell;vertical-align:top">
                        <div style="width:100%!important">
                          <div style="padding:0px;border-top:0px solid transparent;border-left:0px solid transparent;border-right:0px solid transparent;border-bottom:0px solid transparent">
                            <table style="font-family:Cabin,sans-serif" role="presentation" cellpadding="0" cellspacing="0" width="100%" border="0">
                              <tbody>
                                <tr>
                                  <td style="word-break:break-word;padding:20px;font-family:Cabin,sans-serif" align="left">
                                    <table width="100%" cellpadding="0" cellspacing="0" border="0">
                                      <tbody><tr>
                                        <td style="padding-right:0px;padding-left:0px" align="center">
                                          <img align="center" border="0" src="https://ci4.googleusercontent.com/proxy/-zgV-cYCPYdGfRIGIogVGgS2k1ALIwEoOEEjz0uf0qJSABQzljUwMUmin8HWTW56XaLRZ5pCju9d4mNZjsn1neZqEkXTIUehE1_BXQFRYnzUA7yzsP7fT5OhX7AF2Lid9h9-kwa7MZGc7uJ9BRTRwoGBhXJ4VW8ebv1F=s0-d-e1-ft#https://s3.amazonaws.com/unroll-images-production/projects%2F53466%2F1639464553282-Logo+G-Office-200.png" alt="Image" title="Image" style="outline:none;text-decoration:none;clear:both;display:inline-block!important;border:none;height:auto;float:none;width:32%;max-width:179.2px" width="179.2" class="CToWUd">
                                        </td>
                                      </tr>
                                    </tbody></table>
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
                <div class="m_2025568036990400068u-row-container" style="padding:0px;background-color:transparent">
                  <div class="m_2025568036990400068u-row" style="Margin:0 auto;min-width:320px;max-width:600px;word-wrap:break-word;word-break:break-word;background-color:#003399">
                    <div style="border-collapse:collapse;display:table;width:100%;background-color:transparent">
                      <div class="m_2025568036990400068u-col m_2025568036990400068u-col-100" style="max-width:320px;min-width:600px;display:table-cell;vertical-align:top">
                        <div style="width:100%!important">
                          <div style="padding:0px;border-top:0px solid transparent;border-left:0px solid transparent;border-right:0px solid transparent;border-bottom:0px solid transparent">
                            <table style="font-family:Cabin,sans-serif" role="presentation" cellpadding="0" cellspacing="0" width="100%" border="0">
                              <tbody>
                                <tr>
                                  <td style="word-break:break-word;padding:40px 10px 10px;font-family:Cabin,sans-serif" align="left">
                                    <table width="100%" cellpadding="0" cellspacing="0" border="0">
                                      <tbody><tr>
                                        <td style="padding-right:0px;padding-left:0px" align="center">
                                          <img align="center" border="0" src="https://ci4.googleusercontent.com/proxy/HSFHzYcQq9U1UQlXLsBgUD-twop5t3KtATKiwljuxdxb3cOgbdYWnjfZbj_5TwW7xc-fvTvnvb5vtXoq5QjGf3jB2R1dY5CV3LGo0potgE1qSKY=s0-d-e1-ft#https://cdn.templates.unlayer.com/assets/1597218650916-xxxxc.png" alt="Image" title="Image" style="outline:none;text-decoration:none;clear:both;display:inline-block!important;border:none;height:auto;float:none;width:26%;max-width:150.8px" width="150.8" class="CToWUd">
                                        </td>
                                      </tr>
                                    </tbody></table>
                                  </td>
                                </tr>
                              </tbody>
                            </table>
                            <table style="font-family:Cabin,sans-serif" role="presentation" cellpadding="0" cellspacing="0" width="100%" border="0">
                              <tbody>
                                <tr>
                                  <td style="word-break:break-word;padding:10px;font-family:Cabin,sans-serif" align="left">
                                    <div style="color:#e5eaf5;line-height:140%;text-align:center;word-wrap:break-word">
                                      <p style="font-size:14px;line-height:140%"><strong>T H A N K S&nbsp; &nbsp;F O R&nbsp; &nbsp;R E S E T&nbsp; &nbsp;P A S S W O R D</strong></p>
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
                <div class="m_2025568036990400068u-row-container" style="padding:0px;background-color:transparent">
                  <div class="m_2025568036990400068u-row" style="Margin:0 auto;min-width:320px;max-width:600px;word-wrap:break-word;word-break:break-word;background-color:#ffffff">
                    <div style="border-collapse:collapse;display:table;width:100%;background-color:transparent">
                      <div class="m_2025568036990400068u-col m_2025568036990400068u-col-100" style="max-width:320px;min-width:600px;display:table-cell;vertical-align:top">
                        <div style="width:100%!important">
                          <div style="padding:0px;border-top:0px solid transparent;border-left:0px solid transparent;border-right:0px solid transparent;border-bottom:0px solid transparent">
                            <table style="font-family:Cabin,sans-serif" role="presentation" cellpadding="0" cellspacing="0" width="100%" border="0">
                              <tbody>
                                <tr>
                                  <td style="word-break:break-word;padding:33px 55px;font-family:Cabin,sans-serif" align="left">
                                    <div style="line-height:160%;text-align:center;word-wrap:break-word">
                                      <p style="font-size:14px;line-height:160%"><span style="font-size:22px;line-height:35.2px">Chúc mừng quý khách lấy lại tài khoản thành công  </span></p>
                                      <p style="font-size:14px;line-height:160%"><span style="font-size:18px;line-height:28.8px">Thông tin tài khoản của bạn<br></span></p>
                                      <p style="font-size:14px;line-height:160%"><span style="font-size:18px;line-height:28.8px">Username: '.$username.' </span></p>
                                      <p style="font-size:14px;line-height:160%"><span style="font-size:18px;line-height:28.8px">Password: '.$password.'</span></p>
                                    </div>
                                  </td>
                                </tr>
                              </tbody>
                            </table>
                            <table style="font-family:Cabin,sans-serif" role="presentation" cellpadding="0" cellspacing="0" width="100%" border="0">
                              <tbody>
                                <tr>
                                  <td style="word-break:break-word;padding:10px;font-family:Cabin,sans-serif" align="left">
                                    <div align="center">
                                      <a href="'.HOME.'" style="box-sizing:border-box;display:inline-block;font-family:Cabin,sans-serif;text-decoration:none;text-align:center;color:#ffffff;background-color:#ff6600;border-radius:4px;width:auto;max-width:100%;word-break:break-word;word-wrap:break-word" target="_blank" data-saferedirecturl="https://www.google.com/url?q=http://xww2h.mjt.lu/lnk/CAAAAmi6LQ4AAAAAAAAAALGx71AAAYCsDusAAAAAAAxc9QBhwpi8X30rSG8eSi2cVMGtgi6YKgAMYe0/1/nI2FDfr3ulRiuWUStunoBA/aHR0cHM6Ly9nZW1zdGVjaC5jb20udm4vYWN0aXZlL2VhYWNmZTQ3ZDY1YzdlNjk5M2UwOTg1NDIzZjQzZTYw&amp;source=gmail&amp;ust=1640837836750000&amp;usg=AOvVaw0OM_dMKERh_XmVmdKMkkJL">
                                        <span style="display:block;padding:14px 44px 13px;line-height:120%"><span style="font-size:16px;line-height:19.2px"><strong><span style="line-height:19.2px;font-size:16px">Đăng nhập ngay</span></strong>
                                        </span>
                                        </span>
                                      </a>
                                    </div>
                                  </td>
                                </tr>
                              </tbody>
                            </table>
                            <table style="font-family:Cabin,sans-serif" role="presentation" cellpadding="0" cellspacing="0" width="100%" border="0">
                              <tbody>
                                <tr>
                                  <td style="word-break:break-word;padding:33px 55px 60px;font-family:Cabin,sans-serif" align="left">
                                    <div style="line-height:160%;text-align:center;word-wrap:break-word">
                                      <p style="line-height:160%;font-size:14px"><span style="font-size:18px;line-height:28.8px">Thanks,</span></p>
                                      <p style="line-height:160%;font-size:14px"><span style="font-size:18px;line-height:28.8px">Team phát triển từ G-office<br></span></p>
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
                <div class="m_2025568036990400068u-row-container" style="padding:0px;background-color:transparent">
                  <div class="m_2025568036990400068u-row" style="Margin:0 auto;min-width:320px;max-width:600px;word-wrap:break-word;word-break:break-word;background-color:#e5eaf5">
                    <div style="border-collapse:collapse;display:table;width:100%;background-color:transparent">
                      <div class="m_2025568036990400068u-col m_2025568036990400068u-col-100" style="max-width:320px;min-width:600px;display:table-cell;vertical-align:top">
                        <div style="width:100%!important">
                          <div style="padding:0px;border-top:0px solid transparent;border-left:0px solid transparent;border-right:0px solid transparent;border-bottom:0px solid transparent">
                            <table style="font-family:Cabin,sans-serif" role="presentation" cellpadding="0" cellspacing="0" width="100%" border="0">
                              <tbody>
                                <tr>
                                  <td style="word-break:break-word;padding:41px 55px 18px;font-family:Cabin,sans-serif" align="left">
                                    <div style="color:#003399;line-height:160%;text-align:center;word-wrap:break-word">
                                      <p style="font-size:14px;line-height:160%"><span style="font-size:20px;line-height:32px"><strong>Hotline há»— trá»£<br></strong></span></p>
                                      <p style="font-size:14px;line-height:160%"><span style="font-size:16px;line-height:25.6px;color:#000000">034-678-8118</span></p>
                                      <p style="font-size:14px;line-height:160%"><span style="font-size:16px;line-height:25.6px;color:#000000"><a href="mailto:Info@gemstech.com.vn" target="_blank">Info@gemstech.com.vn</a></span></p>
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
                <div class="m_2025568036990400068u-row-container" style="padding:0px;background-color:transparent">
                  <div class="m_2025568036990400068u-row" style="Margin:0 auto;min-width:320px;max-width:600px;word-wrap:break-word;word-break:break-word;background-color:#003399">
                    <div style="border-collapse:collapse;display:table;width:100%;background-color:transparent">
                      <div class="m_2025568036990400068u-col m_2025568036990400068u-col-100" style="max-width:320px;min-width:600px;display:table-cell;vertical-align:top">
                        <div style="width:100%!important">
                          <div style="padding:0px;border-top:0px solid transparent;border-left:0px solid transparent;border-right:0px solid transparent;border-bottom:0px solid transparent">
                            <table style="font-family:Cabin,sans-serif" role="presentation" cellpadding="0" cellspacing="0" width="100%" border="0">
                              <tbody>
                                <tr>
                                  <td style="word-break:break-word;padding:10px;font-family:Cabin,sans-serif" align="left">
                                    <div style="color:#fafafa;line-height:180%;text-align:center;word-wrap:break-word">
                                      <p style="font-size:14px;line-height:180%"><span style="font-size:16px;line-height:28.8px">Copyrights © Gemstech All Rights Reserved</span></p>
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
      
<br><img src="https://ci4.googleusercontent.com/proxy/ehFgkwgRYLK4C2HkE-7rWfgtj8SlMopTorpqcTdk67Fv1_PBaFQSy4LFrFutEjVQyJqWsyNdET5gDJrb59Elav_5YrNLDTrlBH96xFrYRmxvbSlcT1koNIUMfrXq5EyEAixEx3fmIorVNo-TOcZ34gkd6CWJTGGs3IUz20MufB4G5gk4l490jA=s0-d-e1-ft#http://xww2h.mjt.lu/oo/CAAAAmi6LQ4AAAAAAAAAALGx71AAAYCsDusAAAAAAAxc9QBhwpi8X30rSG8eSi2cVMGtgi6YKgAMYe0/20db343d/e.gif" height="1" width="1" alt="" border="0" style="height:1px;width:1px;border:0" class="CToWUd" jslog="138226; u014N:xr6bB; 53:W2ZhbHNlXQ..">
</div>';
    }

}

?>
