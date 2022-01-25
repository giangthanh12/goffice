<?php

class request extends Controller
{
    function __construct()
    {
        parent::__construct();

    }

    function index()
    {
        require "layouts/header.php";
        $this->view->render("request/index");
        require "layouts/footer.php";
    }

    function getAllRequests()
    {
        $jsonObj = '[
  {
    "id": "1",
    "title": "Bước 1",
    "item": [
      {
        "id": "1",
        "title": "Research FAQ page UX",
        "comments": "3",
     "badge-text": "UX",
       "badge": "",
        "due-date": "5 April",
        "attachments": "2",
        "assigned": [
          "avatar-s-1.jpg",
          "avatar-s-2.jpg"
        ],
        "members": ["Bruce", "Dianna"]
      },
      {
        "id": "2",
        "title": "Find new images for pages",
        "comments": "1",
        "badge-text": "Images",
        "image": "04.jpg",
        "badge": "warning",
        "due-date": "2",
        "attachments": "5",
        "assigned": [
          "avatar-s-3.jpg",
          "avatar-s-4.jpg"
        ],
        "members": ["Laurel", "Oliver"]
      }
    ]
  },
  {
    "id": "2",
    "title": "In Review",
    "item": [
      {
        "id": "3",
        "title": "Review completed Apps",
        "comments": "6",
        "badge-text": "App",
        "badge": "info",
        "due-date": "8 April",
        "attachments": "2",
        "assigned": [
          "avatar-s-5.jpg",
          "avatar-s-6.jpg"
        ],
        "members": ["Arthur", "Harley"]
      },
      {
        "id": "4",
        "title": "Review Javascript code",
        "comments": "2",
        "badge-text": "Code Review",
        "badge": "danger",
        "attachments": "4",
        "due-date": "10 April",
        "assigned": [
          "avatar-s-7.jpg",
          "avatar-s-8.jpg"
        ],
        "members": ["Helena", "Jordan"]
      }
    ]
  },
  {
    "id": "3",
    "title": "Done",
    "item": [
      {
        "id": "5",
        "title": "Forms & Tables section",
        "comments": "2",
        "badge-text": "Forms",
        "badge": "success",
        "due-date": "7 April",
        "attachments": "1",
        "assigned": [
          "avatar-s-8.jpg",
          "avatar-s-9.jpg"
        ],
        "members": ["Barry", "Victor"]
      },
      {
        "id": "6",
        "title": "Completed Charts & Maps",
        "comments": "2",
        "badge-text": "Charts & Maps",
        "badge": "primary",
        "due-date": "7 April",
        "attachments": "3",
        "assigned": [
          "avatar-s-10.jpg",
          "avatar-s-11.jpg"
        ],
        "members": ["Lois", "Clark"]
      }
    ]
  }
]
';
        echo $jsonObj;
    }
}

?>
