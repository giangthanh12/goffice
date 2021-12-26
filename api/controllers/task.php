<?php
class task extends Controller
{
    function __construct()
    {
        parent::__construct();
    }

    function listTasks()
    {
        $staffId = isset($_REQUEST['staffId']) ? $_REQUEST['staffId'] : '';
        if ($staffId == '') {
            $jsonObj['message'] = "Chưa nhập staffId";
            $jsonObj['code'] = 401;
            $jsonObj['data'] = [];
            http_response_code(401);
            echo json_encode($jsonObj);
            return false;
        } else {
            $json = $this->model->getData($staffId);
            if ($json == 0) {
                $jsonObj['message'] = "Lỗi lấy dữ liệu";
                $jsonObj['code'] = 402;
                $jsonObj['data'] = [];
                http_response_code(402);
                echo json_encode($jsonObj);
                return false;
            } else {
                $jsonObj['message'] = "Lấy dữ liệu thành công";
                $jsonObj['code'] = 200;
                $jsonObj['data'] = $json;
                http_response_code(200);
                echo json_encode($jsonObj);
                return true;
            }
            echo json_encode($json);
        }
    }

    function getTask()
    {
        $taskId = isset($_REQUEST['taskId']) ? $_REQUEST['taskId'] : '';
        if ($taskId == '') {
            $jsonObj['message'] = "Chưa nhập taskId";
            $jsonObj['code'] = 401;
            $jsonObj['data'] = [];
            http_response_code(401);
            echo json_encode($jsonObj);
            return false;
        } else {
            $json = $this->model->getTask($taskId);
            if ($json == 0) {
                $jsonObj['message'] = "Lỗi lấy dữ liệu";
                $jsonObj['code'] = 402;
                $jsonObj['data'] = [];
                http_response_code(402);
                echo json_encode($jsonObj);
                return false;
            } else {
                $jsonObj['message'] = "Lấy dữ liệu thành công";
                $jsonObj['code'] = 200;
                $jsonObj['data'] = $json;
                http_response_code(200);
                echo json_encode($jsonObj);
                return true;
            }
            echo json_encode($json);
        }
    }

    function getCommentTasks()
    {
        $taskId = isset($_REQUEST['taskId']) ? $_REQUEST['taskId'] : '';
        if ($taskId == '') {
            $jsonObj['message'] = "Chưa nhập taskId";
            $jsonObj['code'] = 401;
            $jsonObj['data'] = [];
            http_response_code(401);
            echo json_encode($jsonObj);
            return false;
        } else {
            $json = $this->model->getCommentTasks($taskId);
            if ($json == 0) {
                $jsonObj['message'] = "Lỗi lấy dữ liệu";
                $jsonObj['code'] = 402;
                $jsonObj['data'] = [];
                http_response_code(402);
                echo json_encode($jsonObj);
                return false;
            } else {
                $jsonObj['message'] = "Lấy dữ liệu thành công";
                $jsonObj['code'] = 200;
                $jsonObj['data'] = $json;
                http_response_code(200);
                echo json_encode($jsonObj);
                return true;
            }
            echo json_encode($json);
        }
    }

    function commentTask()
    {
        $staffId = isset($_REQUEST['staffId']) ? $_REQUEST['staffId'] : '';
        if ($staffId == '') {
            $jsonObj['message'] = "Chưa nhập staffId";
            $jsonObj['code'] = 401;
            $jsonObj['data'] = [];
            http_response_code(401);
            echo json_encode($jsonObj);
            return false;
        } else {
            $data['staffId'] = $staffId;
        }
        $taskId = isset($_REQUEST['taskId']) ? $_REQUEST['taskId'] : '';
        if ($taskId == '') {
            $jsonObj['message'] = "Chưa nhập taskId";
            $jsonObj['code'] = 401;
            $jsonObj['data'] = [];
            http_response_code(401);
            echo json_encode($jsonObj);
            return false;
        } else {
            $data['taskId'] = $taskId;
        }
        $content = isset($_REQUEST['content']) ? $_REQUEST['content'] : '';
        if ($content == '') {
            $jsonObj['message'] = "Chưa nhập nội dung";
            $jsonObj['code'] = 401;
            $jsonObj['data'] = [];
            http_response_code(401);
            echo json_encode($jsonObj);
            return false;
        } else {
            $data['content'] = $content;
        }
        $data['dateTime'] = date('Y-m-d H-i-s');
        $data['status'] = 1;
        $json = $this->model->commentTask($data);
        if ($json == 0) {
            $jsonObj['message'] = "Lỗi cập nhật dữ liệu";
            $jsonObj['code'] = 402;
            $jsonObj['data'] = [];
            http_response_code(402);
            echo json_encode($jsonObj);
        } else {
            $jsonObj['message'] = "Cập nhật dữ liệu thành công";
            $jsonObj['code'] = 200;
            $jsonObj['data'] = [];
            http_response_code(200);
            echo json_encode($jsonObj);
        }
    }

    function getTaskFiles()
    {
        $taskId = isset($_REQUEST['taskId']) ? $_REQUEST['taskId'] : '';
        if ($taskId == '') {
            $jsonObj['message'] = "Chưa nhập taskId";
            $jsonObj['code'] = 401;
            $jsonObj['data'] = [];
            http_response_code(401);
            echo json_encode($jsonObj);
            return false;
        } else {
            $json = $this->model->getTaskFiles($taskId);
            if ($json == 0) {
                $jsonObj['message'] = "Lỗi lấy dữ liệu";
                $jsonObj['code'] = 402;
                $jsonObj['data'] = [];
                http_response_code(402);
                echo json_encode($jsonObj);
                return false;
            } else {
                $jsonObj['message'] = "Lấy dữ liệu thành công";
                $jsonObj['code'] = 200;
                $jsonObj['data'] = $json;
                http_response_code(200);
                echo json_encode($jsonObj);
                return true;
            }
            echo json_encode($json);
        }
    }

    function getTaskSubs()
    {
        $taskId = isset($_REQUEST['taskId']) ? $_REQUEST['taskId'] : '';
        if ($taskId == '') {
            $jsonObj['message'] = "Chưa nhập taskId";
            $jsonObj['code'] = 401;
            $jsonObj['data'] = [];
            http_response_code(401);
            echo json_encode($jsonObj);
            return false;
        } else {
            $json = $this->model->getTaskSubs($taskId);
            if ($json == 0) {
                $jsonObj['message'] = "Lỗi lấy dữ liệu";
                $jsonObj['code'] = 402;
                $jsonObj['data'] = [];
                http_response_code(402);
                echo json_encode($jsonObj);
                return false;
            } else {
                $jsonObj['message'] = "Lấy dữ liệu thành công";
                $jsonObj['code'] = 200;
                $jsonObj['data'] = $json;
                http_response_code(200);
                echo json_encode($jsonObj);
                return true;
            }
            echo json_encode($json);
        }
    }

    function addTaskSub()
    {
        $staffId = isset($_REQUEST['staffId']) ? $_REQUEST['staffId'] : '';
        if ($staffId == '') {
            $jsonObj['message'] = "Chưa nhập staffId";
            $jsonObj['code'] = 401;
            $jsonObj['data'] = [];
            http_response_code(401);
            echo json_encode($jsonObj);
            return false;
        } else {
            $data['staffId'] = $staffId;
        }
        $taskId = isset($_REQUEST['taskId']) ? $_REQUEST['taskId'] : '';
        if ($taskId == '') {
            $jsonObj['message'] = "Chưa nhập taskId";
            $jsonObj['code'] = 401;
            $jsonObj['data'] = [];
            http_response_code(401);
            echo json_encode($jsonObj);
            return false;
        } else {
            $data['taskId'] = $taskId;
        }
        $title = isset($_REQUEST['title']) ? $_REQUEST['title'] : '';
        if ($title == '') {
            $jsonObj['message'] = "Chưa nhập title";
            $jsonObj['code'] = 401;
            $jsonObj['data'] = [];
            http_response_code(401);
            echo json_encode($jsonObj);
            return false;
        } else {
            $data['title'] = $title;
        }
        $data['status'] = 1;
        $json = $this->model->addTaskSub($data);
        if ($json == 0) {
            $jsonObj['message'] = "Lỗi cập nhật dữ liệu";
            $jsonObj['code'] = 402;
            $jsonObj['data'] = [];
            http_response_code(402);
            echo json_encode($jsonObj);
        } else {
            $jsonObj['message'] = "Cập nhật dữ liệu thành công";
            $jsonObj['code'] = 200;
            $jsonObj['data'] = [];
            http_response_code(200);
            echo json_encode($jsonObj);
        }
    }

    function filterTask()
    {
        $search = isset($_REQUEST['search']) ? $_REQUEST['search'] : '';
        if ($search == '') {
            $jsonObj['message'] = "Chưa nhập nội dung tìm kiếm";
            $jsonObj['code'] = 401;
            $jsonObj['data'] = [];
            echo json_encode($jsonObj);
            return false;
        } else {
            $json = $this->model->filterTask($search);
            if ($json == 0) {
                $jsonObj['message'] = "Lỗi lấy dữ liệu";
                $jsonObj['code'] = 402;
                $jsonObj['data'] = [];
                http_response_code(402);
                echo json_encode($jsonObj);
                return false;
            } else {
                $jsonObj['message'] = "Tìm kiếm thành công";
                $jsonObj['code'] = 200;
                $jsonObj['total'] = $json['total'];
                $jsonObj['data'] = $json['data'];
                http_response_code(200);
                echo json_encode($jsonObj);
                return true;
            }
            echo json_encode($json);
        }
    }

    function addTask()
    {
        if (isset($_REQUEST['title']))
            $data['title'] = $_REQUEST['title'];
        $data['assignmentDate'] = date("Y-m-d");
        if (isset($_REQUEST['assignerId']))
            $data['assignerId'] = $_REQUEST['assignerId'];
        if (isset($_REQUEST['assigneeId']))
            $data['assigneeId'] = $_REQUEST['assigneeId'];
        if (isset($_REQUEST['description']))
            $data['description'] = $_REQUEST['description'];
        if (isset($_REQUEST['label']))
            $data['label'] = $_REQUEST['label'];

        if (isset($_FILES['image'])) {
            $filename = $_FILES['image']['name'];
            $fname = explode('.', $filename);
            if ($filename != '') {
                $dir = ROOT_DIR . '/uploads/task/';
                $file = functions::uploadfile('image', $dir, $fname[0]);
                if ($file != '')
                    $image =  'uploads/task/' . $file;
                $data['image'] = $image;
            }
        }

        $deadline = isset($_REQUEST['deadline']) ? $_REQUEST['deadline'] : '';
        if ($deadline != '')
            $data['deadline'] = date("Y-m-d", strtotime(str_replace('/', '-', $_REQUEST['deadline'])));
        if (isset($_REQUEST['process']))
            $data['process'] = $_REQUEST['process'];
        if (isset($_REQUEST['projectId']))
            $data['projectId'] = $_REQUEST['projectId'];
        if (isset($_REQUEST['groupId']))
            $data['groupId'] = $_REQUEST['groupId'];
        $startDate = isset($_REQUEST['startDate']) ? $_REQUEST['startDate'] : '';
        if ($startDate != '')
            $data['startDate'] = date("Y-m-d", strtotime(str_replace('/', '-', $_REQUEST['startDate'])));
        $endDate = isset($_REQUEST['endDate']) ? $_REQUEST['endDate'] : '';
        if ($endDate != '')
            $data['endDate'] = date("Y-m-d", strtotime(str_replace('/', '-', $_REQUEST['endDate'])));
        if (isset($_REQUEST['status']))
            $data['status'] = $_REQUEST['status'];
        $data['updated'] = date('Y-m-d');
        $json = $this->model->addTask($data);
        if ($json == 0) {
            $jsonObj['message'] = "Lỗi cập nhật dữ liệu";
            $jsonObj['code'] = 402;
            $jsonObj['data'] = [];
            http_response_code(402);
            echo json_encode($jsonObj);
        } else {
            $jsonObj['message'] = "Cập nhật dữ liệu thành công";
            $jsonObj['code'] = 200;
            $json = $this->model->getTask($json);
            $jsonObj['data'] = $json;
            http_response_code(200);
            echo json_encode($jsonObj);
        }
    }

    function updateTask()
    {
        $taskId = isset($_REQUEST['taskId']) ? $_REQUEST['taskId'] : '';
        if ($taskId == '') {
            $jsonObj['message'] = "Chưa nhập taskId";
            $jsonObj['code'] = 401;
            $jsonObj['data'] = [];
            http_response_code(401);
            echo json_encode($jsonObj);
            return false;
        }
        if (isset($_REQUEST['title']))
            $data['title'] = $_REQUEST['title'];
        if (isset($_REQUEST['assignerId']))
            $data['assignerId'] = $_REQUEST['assignerId'];
        if (isset($_REQUEST['assigneeId']))
            $data['assigneeId'] = $_REQUEST['assigneeId'];
        if (isset($_REQUEST['description']))
            $data['description'] = $_REQUEST['description'];
        if (isset($_REQUEST['label']))
            $data['label'] = $_REQUEST['label'];
        if (isset($_FILES['image'])) {
            $filename = $_FILES['image']['name'];
            $fname = explode('.', $filename);
            if ($filename != '') {
                $dir = ROOT_DIR . '/uploads/task/';
                $file = functions::uploadfile('image', $dir, $fname[0]);
                if ($file != '')
                    $image =  'uploads/task/' . $file;
                $data['image'] = $image;
            }
        }
        $deadline = isset($_REQUEST['deadline']) ? $_REQUEST['deadline'] : '';
        if ($deadline != '')
            $data['deadline'] = date("Y-m-d", strtotime(str_replace('/', '-', $_REQUEST['deadline'])));
        if (isset($_REQUEST['process']))
            $data['process'] = $_REQUEST['process'];
        if (isset($_REQUEST['projectId']))
            $data['projectId'] = $_REQUEST['projectId'];
        if (isset($_REQUEST['groupId']))
            $data['groupId'] = $_REQUEST['groupId'];
        $startDate = isset($_REQUEST['startDate']) ? $_REQUEST['startDate'] : '';
        if ($startDate != '')
            $data['startDate'] = date("Y-m-d", strtotime(str_replace('/', '-', $_REQUEST['startDate'])));
        $endDate = isset($_REQUEST['endDate']) ? $_REQUEST['endDate'] : '';
        if ($endDate != '')
            $data['endDate'] = date("Y-m-d", strtotime(str_replace('/', '-', $_REQUEST['endDate'])));
        if (isset($_REQUEST['status']))
            $data['status'] = $_REQUEST['status'];
        $data['updated'] = date('Y-m-d');
        $json = $this->model->updateTask($taskId, $data);
        if ($json == 0) {
            $jsonObj['message'] = "Lỗi cập nhật dữ liệu";
            $jsonObj['code'] = 402;
            $jsonObj['data'] = [];
            http_response_code(402);
            echo json_encode($jsonObj);
        } else {
            $jsonObj['message'] = "Cập nhật dữ liệu thành công";
            $jsonObj['code'] = 200;
            $json = $this->model->getTask($taskId);
            $jsonObj['data'] = $json;
            http_response_code(200);
            echo json_encode($jsonObj);
        }
    }

    function addTaskFile()
    {
        $taskId = isset($_REQUEST['taskId']) ? $_REQUEST['taskId'] : '';
        if ($taskId == '') {
            $jsonObj['message'] = "Chưa nhập taskId";
            $jsonObj['code'] = 401;
            $jsonObj['data'] = [];
            http_response_code(401);
            echo json_encode($jsonObj);
            return false;
        } else {
            $data['taskId'] = $taskId;
        }
        $linkToFile = isset($_REQUEST['file']) ? $_REQUEST['file'] : '';
        if ($linkToFile == '') {
            $jsonObj['message'] = "Không có file";
            $jsonObj['code'] = 401;
            $jsonObj['data'] = [];
            http_response_code(401);
            echo json_encode($jsonObj);
            return false;
        } else {
            if (isset($_FILES['file'])) {
                $filename = $_FILES['file']['name'];
                $fname = explode('.', $filename);
                if ($filename != '') {
                    $dir = ROOT_DIR . '/uploads/task/file/';
                    $file = functions::uploadfile('file', $dir, $fname[0]);
                    if ($file != '')
                        $link =  'uploads/task/file/' . $file;
                    $data['linkToFile'] = $link;
                }
            }
        }
        $data['status'] = 1;
        $json = $this->model->addTaskFile($data);
        if ($json == 0) {
            $jsonObj['message'] = "Lỗi cập nhật dữ liệu";
            $jsonObj['code'] = 402;
            $jsonObj['data'] = [];
            http_response_code(402);
            echo json_encode($jsonObj);
            return false;
        } else {
            $jsonObj['message'] = "Cập nhật dữ liệu thành công";
            $jsonObj['code'] = 200;
            $jsonObj['data'] = [];
            http_response_code(200);
            echo json_encode($jsonObj);
            return true;
        }
        echo json_encode($json);
    }

    // function addTask()
    // {
    //     $title = isset($_REQUEST['title']) ? $_REQUEST['title'] : '';
    //     if ($title == '') {
    //         $jsonObj['message'] = "Chưa nhập tên công việc";
    //         $jsonObj['code'] = 401;
    //         echo json_encode($jsonObj);
    //         return false;
    //     } else {
    //         $data['title'] = $title;
    //     }
    //     $assignmentDate = date('Y-m-d');
    //     $data['assignmentDate'] = $assignmentDate;
    //     $assignerId = isset($_REQUEST['assignerId']) ? $_REQUEST['assignerId'] : '';
    //     if ($assignerId == '') {
    //         $jsonObj['message'] = "Chưa chọn người giao";
    //         $jsonObj['code'] = 401;
    //         echo json_encode($jsonObj);
    //         return false;
    //     } else {
    //         $data['assignerId'] = $assignerId;
    //     }
    //     $assigneeId = isset($_REQUEST['assigneeId']) ? $_REQUEST['assigneeId'] : '';
    //     if ($assigneeId == '') {
    //         $jsonObj['message'] = "Chưa chọn người nhận";
    //         $jsonObj['code'] = 401;
    //         echo json_encode($jsonObj);
    //         return false;
    //     } else {
    //         $data['assigneeId'] = $assigneeId;
    //     }
    //     if (isset($_REQUEST['description']))
    //         $data['description'] = $_REQUEST['description'];
    //     if (isset($_REQUEST['label']))
    //         $data['label'] = $_REQUEST['label'];
    //     if (isset($_REQUEST['image']))
    //         $data['image'] = $_REQUEST['image'];
    //     $deadline = isset($_REQUEST['deadline']) ? date("Y-m-d", strtotime(str_replace('/', '-', $_REQUEST['deadline']))) : '';
    //     if ($deadline == '') {
    //         $jsonObj['message'] = "Chưa chọn deadline";
    //         $jsonObj['code'] = 401;
    //         echo json_encode($jsonObj);
    //         return false;
    //     } else {
    //         if (strtotime($deadline) < strtotime($assignmentDate)) {
    //             $jsonObj['message'] = "Deadline không được nhỏ hơn ngày hiện tại";
    //             $jsonObj['code'] = 402;
    //             $jsonObj['data'] = [];
    //             echo json_encode($jsonObj);
    //             return false;
    //         } else {
    //             $data['deadline'] = $deadline;
    //         }
    //     }
    //     if (isset($_REQUEST['projectId']))
    //         $data['projectId'] = $_REQUEST['projectId'];
    //     if (isset($_REQUEST['groupId']))
    //         $data['groupId'] = $_REQUEST['groupId'];
    //     $data['updated'] = date('Y-m-d');
    //     $data['status'] = 1;
    //     $json = $this->model->addTask($data);
    //     if ($json == 0) {
    //         $jsonObj['message'] = "Lỗi cập nhật dữ liệu";
    //         $jsonObj['code'] = 402;
    //         $jsonObj['data'] = [];
    //         echo json_encode($jsonObj);
    //     } else {
    //         $jsonObj['message'] = "Cập nhật dữ liệu thành công";
    //         $jsonObj['code'] = 200;
    //         $json = $this->model->getTask($json);
    //         $jsonObj['data'] = $json;
    //         echo json_encode($jsonObj);
    //     }
    // }

    // function updateTask()
    // {
    //     $taskId = isset($_REQUEST['taskId']) ? $_REQUEST['taskId'] : '';
    //     if ($taskId == '') {
    //         $jsonObj['message'] = "Chưa nhập taskId";
    //         $jsonObj['code'] = 401;
    //         $jsonObj['data'] = [];
    //         echo json_encode($jsonObj);
    //         return false;
    //     }
    //     $title = isset($_REQUEST['title']) ? $_REQUEST['title'] : '';
    //     if ($title == '') {
    //         $jsonObj['message'] = "Chưa nhập tên công việc";
    //         $jsonObj['code'] = 401;
    //         echo json_encode($jsonObj);
    //         return false;
    //     } else {
    //         $data['title'] = $title;
    //     }
    //     $assignerId = isset($_REQUEST['assignerId']) ? $_REQUEST['assignerId'] : '';
    //     if ($assignerId == '') {
    //         $jsonObj['message'] = "Chưa chọn người giao";
    //         $jsonObj['code'] = 401;
    //         echo json_encode($jsonObj);
    //         return false;
    //     } else {
    //         $data['assignerId'] = $assignerId;
    //     }
    //     $assigneeId = isset($_REQUEST['assigneeId']) ? $_REQUEST['assigneeId'] : '';
    //     if ($assigneeId == '') {
    //         $jsonObj['message'] = "Chưa chọn người nhận";
    //         $jsonObj['code'] = 401;
    //         echo json_encode($jsonObj);
    //         return false;
    //     } else {
    //         $data['assigneeId'] = $assigneeId;
    //     }
    //     if (isset($_REQUEST['description']))
    //         $data['description'] = $_REQUEST['description'];
    //     if (isset($_REQUEST['label']))
    //         $data['label'] = $_REQUEST['label'];
    //     if (isset($_REQUEST['image']))
    //         $data['image'] = $_REQUEST['image'];
    //     $deadline = isset($_REQUEST['deadline']) ? date("Y-m-d", strtotime(str_replace('/', '-', $_REQUEST['deadline']))) : '';
    //     if ($deadline == '') {
    //         $jsonObj['message'] = "Chưa chọn deadline";
    //         $jsonObj['code'] = 401;
    //         echo json_encode($jsonObj);
    //         return false;
    //     } else {
    //         if (strtotime($deadline) < strtotime(date('Y-m-d'))) {
    //             $jsonObj['message'] = "Deadline không được nhỏ hơn ngày hiện tại";
    //             $jsonObj['code'] = 402;
    //             $jsonObj['data'] = [];
    //             echo json_encode($jsonObj);
    //             return false;
    //         } else {
    //             $data['deadline'] = $deadline;
    //         }
    //     }
    //     if (isset($_REQUEST['process']))
    //         $data['process'] = $_REQUEST['process'];
    //     if (isset($_REQUEST['projectId']))
    //         $data['projectId'] = $_REQUEST['projectId'];
    //     if (isset($_REQUEST['groupId']))
    //         $data['groupId'] = $_REQUEST['groupId'];
    //     if (isset($_REQUEST['status']))
    //         $data['status'] = $_REQUEST['status'];
    //     $data['updated'] = date('Y-m-d');
    //     $json = $this->model->updateTask($taskId, $data);
    //     if ($json == 0) {
    //         $jsonObj['message'] = "Lỗi cập nhật dữ liệu";
    //         $jsonObj['code'] = 402;
    //         $jsonObj['data'] = [];
    //         echo json_encode($jsonObj);
    //     } else {
    //         $jsonObj['message'] = "Cập nhật dữ liệu thành công";
    //         $jsonObj['code'] = 200;
    //         $json = $this->model->getTask($taskId);
    //         $jsonObj['data'] = $json;
    //         echo json_encode($jsonObj);
    //     }
    // }



    function deleteTask()
    {
        $taskId = isset($_REQUEST['taskId']) ? $_REQUEST['taskId'] : '';
        if ($taskId == '') {
            $jsonObj['message'] = "Chưa nhập taskId";
            $jsonObj['code'] = 401;
            $jsonObj['data'] = [];
            echo json_encode($jsonObj);
            return false;
        } else {
            $data = [
                'updated' => date('Y-m-d'),
                'status' => 0
            ];
            $json = $this->model->updateTask($taskId, $data);
            if ($json == 0) {
                $jsonObj['message'] = "Lỗi cập nhật dữ liệu";
                $jsonObj['code'] = 402;
                $jsonObj['data'] = [];
                http_response_code(402);
                echo json_encode($jsonObj);
            } else {
                $jsonObj['message'] = "Cập nhật dữ liệu thành công";
                $jsonObj['code'] = 200;
                $jsonObj['data'] = [];
                http_response_code(200);
                echo json_encode($jsonObj);
            }
        }
    }


    // function getitem(){ // lay thong tin cong viec chi tiet vào form)
    //     $id = $_REQUEST['id'];
    //     $json = $this->model->getitem($_REQUEST['id']);
    //     echo json_encode($json);
    // }

    // function nhanvien(){
    //     $id = $_REQUEST['id'];
    //     $json = $this->model->get_nhanvien($id);
    //     echo json_encode($json);
    // }

    // function update(){
    //     $id = $_REQUEST['id'];
    //     $name = $_REQUEST['name'];
    //     $deadline = date("Y-m-d", strtotime($_REQUEST['deadline']));
    //     $label = $_REQUEST['label'];
    //     $nhanvien = $_REQUEST['nhanvien'];
    //     $file = $_REQUEST['file'];
    //     $comment = $_REQUEST['comment'];
    //     if ($nhanvien>0)
    //         $data = array('name'=>$name, 'deadline'=>$deadline, 'label'=>$label, 'nhan_vien'=>$nhanvien);
    //     else
    //         $data = array('name'=>$name, 'deadline'=>$deadline, 'label'=>$label);
    //     if ($this->model->capnhat($id, $data, $file, $comment)) {
    //         $jsonObj['msg'] = "Cập nhật thành công";
    //         $jsonObj['success'] = true;
    //     } else {
    //         $jsonObj['msg'] = "Cập nhật không thành công".$id;
    //         $jsonObj['success'] = false;
    //     }
    //     $jsonObj = json_encode($jsonObj);
    //     echo $jsonObj;
    // }

    // function move(){
    //     $id = $_REQUEST['id'];
    //     $tinhtrang = $_REQUEST['board'];
    //     // if ($board>0)
    //     $data = array('tinh_trang'=>$tinhtrang);
    //     if ($this->model->move($id, $data)) {
    //         $jsonObj['msg'] = "Cập nhật thành công";
    //         $jsonObj['success'] = true;
    //     } else {
    //         $jsonObj['msg'] = "Cập nhật không thành công";
    //         $jsonObj['success'] = false;
    //     }
    //     $jsonObj = json_encode($jsonObj);
    //     echo $jsonObj;
    // }

    // function del(){
    //     $id = $_REQUEST['id'];
    //     if ($this->model->delObj($id)) {
    //         $jsonObj['msg'] = "Đã xóa item";
    //         $jsonObj['success'] = true;
    //     } else {
    //         $jsonObj['msg'] = "Xóa không thành công";
    //         $jsonObj['success'] = false;
    //     }
    //     $jsonObj = json_encode($jsonObj);
    //     echo $jsonObj;

    // }
}
