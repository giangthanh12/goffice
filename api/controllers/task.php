<?php
class task extends Controller
{
    function __construct()
    {
        parent::__construct();
    }

    function listTaskLabels()
    {
        $json = $this->model->listTaskLabels();
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

    function listTaskStatus()
    {
        $json = $this->model->listTaskStatus();
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

    function reportTask()
    {
        $json = $this->model->reportTask();
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

    // function listTasks()
    // {
    //     $staffId = isset($_REQUEST['staffId']) ? $_REQUEST['staffId'] : '';
    //     if ($staffId == '') {
    //         $jsonObj['message'] = "Chưa nhập staffId";
    //         $jsonObj['code'] = 401;
    //         $jsonObj['data'] = [];
    //         http_response_code(401);
    //         echo json_encode($jsonObj);
    //         return false;
    //     } else {
    //         $json = $this->model->getData($staffId);
    //         if ($json == 0) {
    //             $jsonObj['message'] = "Lỗi lấy dữ liệu";
    //             $jsonObj['code'] = 402;
    //             $jsonObj['data'] = [];
    //             http_response_code(402);
    //             echo json_encode($jsonObj);
    //             return false;
    //         } else {
    //             $jsonObj['message'] = "Lấy dữ liệu thành công";
    //             $jsonObj['code'] = 200;
    //             $jsonObj['data'] = $json;
    //             http_response_code(200);
    //             echo json_encode($jsonObj);
    //             return true;
    //         }
    //         echo json_encode($json);
    //     }
    // }

    function listStaffProjects()
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
            $json = $this->model->listStaffProjects($staffId);
            if ($json == 0) {
                $jsonObj['message'] = "Lấy dữ liệu thành công";
                $jsonObj['code'] = 200;
                $jsonObj['data'] = [];
                http_response_code(200);
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

    function listProjectTasks()
    {
        $projectId = isset($_REQUEST['projectId']) ? $_REQUEST['projectId'] : '';
        if ($projectId == '') {
            $jsonObj['message'] = "Chưa nhập projectId";
            $jsonObj['code'] = 401;
            $jsonObj['data'] = [];
            http_response_code(401);
            echo json_encode($jsonObj);
            return false;
        }
        $json = $this->model->listProjectTasks($projectId);
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

    function listPersonalTasks()
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
            $json = $this->model->listPersonalTasks($staffId);
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

    function detailTask()
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
            $json = $this->model->detailTask($taskId);
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

    function listTaskComments()
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
            $json = $this->model->listTaskComments($taskId);
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

    function createTaskComment()
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
        $json = $this->model->createTaskComment($data);
        if ($json == 0) {
            $jsonObj['message'] = "Lỗi cập nhật dữ liệu";
            $jsonObj['code'] = 402;
            $jsonObj['data'] = [];
            http_response_code(402);
            echo json_encode($jsonObj);
        } else {
            $jsonObj['message'] = "Cập nhật dữ liệu thành công";
            $jsonObj['code'] = 200;
            $data = $this->model->detailTaskComment($json);
            $jsonObj['data'] = $data;
            http_response_code(200);
            echo json_encode($jsonObj);
        }
    }

    function listTaskFiles()
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
            $json = $this->model->listTaskFiles($taskId);
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

    // function detailTaskSubs()
    // {
    //     $taskId = isset($_REQUEST['taskId']) ? $_REQUEST['taskId'] : '';
    //     if ($taskId == '') {
    //         $jsonObj['message'] = "Chưa nhập taskId";
    //         $jsonObj['code'] = 401;
    //         $jsonObj['data'] = [];
    //         http_response_code(401);
    //         echo json_encode($jsonObj);
    //         return false;
    //     } else {
    //         $json = $this->model->detailTaskSubs($taskId);
    //         if ($json == 0) {
    //             $jsonObj['message'] = "Lỗi lấy dữ liệu";
    //             $jsonObj['code'] = 402;
    //             $jsonObj['data'] = [];
    //             http_response_code(402);
    //             echo json_encode($jsonObj);
    //             return false;
    //         } else {
    //             $jsonObj['message'] = "Lấy dữ liệu thành công";
    //             $jsonObj['code'] = 200;
    //             $jsonObj['data'] = $json;
    //             http_response_code(200);
    //             echo json_encode($jsonObj);
    //             return true;
    //         }
    //         echo json_encode($json);
    //     }
    // }

    // function addTaskSub()
    // {
    //     $staffId = isset($_REQUEST['staffId']) ? $_REQUEST['staffId'] : '';
    //     if ($staffId == '') {
    //         $jsonObj['message'] = "Chưa nhập staffId";
    //         $jsonObj['code'] = 401;
    //         $jsonObj['data'] = [];
    //         http_response_code(401);
    //         echo json_encode($jsonObj);
    //         return false;
    //     } else {
    //         $data['staffId'] = $staffId;
    //     }
    //     $taskId = isset($_REQUEST['taskId']) ? $_REQUEST['taskId'] : '';
    //     if ($taskId == '') {
    //         $jsonObj['message'] = "Chưa nhập taskId";
    //         $jsonObj['code'] = 401;
    //         $jsonObj['data'] = [];
    //         http_response_code(401);
    //         echo json_encode($jsonObj);
    //         return false;
    //     } else {
    //         $data['taskId'] = $taskId;
    //     }
    //     $title = isset($_REQUEST['title']) ? $_REQUEST['title'] : '';
    //     if ($title == '') {
    //         $jsonObj['message'] = "Chưa nhập title";
    //         $jsonObj['code'] = 401;
    //         $jsonObj['data'] = [];
    //         http_response_code(401);
    //         echo json_encode($jsonObj);
    //         return false;
    //     } else {
    //         $data['title'] = $title;
    //     }
    //     $data['status'] = 1;
    //     $json = $this->model->addTaskSub($data);
    //     if ($json == 0) {
    //         $jsonObj['message'] = "Lỗi cập nhật dữ liệu";
    //         $jsonObj['code'] = 402;
    //         $jsonObj['data'] = [];
    //         http_response_code(402);
    //         echo json_encode($jsonObj);
    //     } else {
    //         $jsonObj['message'] = "Cập nhật dữ liệu thành công";
    //         $jsonObj['code'] = 200;
    //         $jsonObj['data'] = [];
    //         http_response_code(200);
    //         echo json_encode($jsonObj);
    //     }
    // }

    function filterTask()
    {
        $staffId = isset($_REQUEST['staffId']) ? $_REQUEST['staffId'] : '';
        if ($staffId == '') {
            $jsonObj['message'] = "Chưa nhập staffId";
            $jsonObj['code'] = 401;
            $jsonObj['data'] = [];
            http_response_code(401);
            echo json_encode($jsonObj);
            return false;
        }
        $projectId = (isset($_REQUEST['projectId']) && $_REQUEST['projectId'] != '') ? $_REQUEST['projectId'] : 0;
        $statusId = isset($_REQUEST['statusId']) ? $_REQUEST['statusId'] : '';
        $json = $this->model->filterTask($staffId, $projectId, $statusId);
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
            $jsonObj['total'] = COUNT($json);
            $jsonObj['data'] = $json;
            http_response_code(200);
            echo json_encode($jsonObj);
            return true;
        }
        echo json_encode($json);
    }

    function createTask()
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
        $data['label'] = isset($_REQUEST['label']) ? $_REQUEST['label'] : 4;

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
        $data['projectId'] = isset($_REQUEST['projectId']) ? $_REQUEST['projectId'] : 0;
        // if (isset($_REQUEST['projectId']))
        //     $data['projectId'] = $_REQUEST['projectId'];
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
        else
            $data['status'] = 1;
        $data['updated'] = date('Y-m-d');
        $json = $this->model->createTask($data);
        if ($json == 0) {
            $jsonObj['message'] = "Lỗi cập nhật dữ liệu";
            $jsonObj['code'] = 402;
            $jsonObj['data'] = [];
            http_response_code(402);
            echo json_encode($jsonObj);
        } else {
            $jsonObj['message'] = "Cập nhật dữ liệu thành công";
            $jsonObj['code'] = 200;
            $data = $this->model->detailTask($json);
            $jsonObj['data'] = $data;
            http_response_code(200);
            echo json_encode($jsonObj);
        }
    }

    function createImageTask()
    {
        
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
        $data['projectId'] = isset($_REQUEST['projectId']) ? $_REQUEST['projectId'] : 0;
        // if (isset($_REQUEST['projectId']))
        //     $data['projectId'] = $_REQUEST['projectId'];
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
            $data = $this->model->detailTask($taskId);
            $jsonObj['data'] = $data;
            http_response_code(200);
            echo json_encode($jsonObj);
        }
    }

    function createTaskFile()
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
        if (isset($_FILES['linkToFile'])) {
            $filename = $_FILES['linkToFile']['name'];
            $fname = explode('.', $filename);
            if ($filename != '') {
                $dir = ROOT_DIR . '/uploads/task/file/';
                $file = functions::uploadfile('linkToFile', $dir, $fname[0]);
                if ($file != '')
                    $link =  'uploads/task/file/' . $file;
                $data['linkToFile'] = $link;
            }
        }
        $data['dateTime'] = date('Y-m-d H-i-s');
        $data['status'] = 1;
        $json = $this->model->createTaskFile($data);
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
            $jsonObj['data'] = $this->model->detailTaskFile($json);
            http_response_code(200);
            echo json_encode($jsonObj);
            return true;
        }
        echo json_encode($json);
    }

    function removeTask()
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
}
