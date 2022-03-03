<link rel="stylesheet" type="text/css" href="<?=HOME?>/styles/app-assets/css/pages/app-email.css">

<div class="app-content content email-application">
    <div class="content-overlay"></div>
    <div class="header-navbar-shadow"></div>
    <div class="content-area-wrapper container-xxl p-0">
        <div class="sidebar-left">
            <div class="sidebar">
                <div class="sidebar-content email-app-sidebar">
                    <div class="email-app-menu">
                        <div class="form-group-compose text-center compose-btn">
                            <button type="button" class="compose-email btn btn-primary btn-block" data-backdrop="false" data-toggle="modal" data-target="#compose-mail">
                                Soạn tin nhắn
                            </button>
                        </div>
                        <div class="sidebar-menu-list">
                            <div class="list-group list-group-messages" id="listType">
                                <input type="hidden" id="selectedType" name="selectedType" value="inbox">
                                <a href="javascript:void(0)" onclick="listInbox()" class="item-filter1 list-group-item list-group-item-action active">
                                <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-mail font-medium-3 mr-50"><path d="M4 4h16c1.1 0 2 .9 2 2v12c0 1.1-.9 2-2 2H4c-1.1 0-2-.9-2-2V6c0-1.1.9-2 2-2z"></path><polyline points="22,6 12,13 2,6"></polyline></svg>
                                    <span id="countInbox" class="align-middle">Hộp thư (<?=$this->count['inbox']?>)</span>
                                    <span id="countnotsee" class="badge badge-light-primary badge-pill float-right"><?=$this->count['notseen']?></span>
                                </a>
                                <a href="javascript:void(0)" onclick="listSent()"class="item-filter2 list-group-item list-group-item-action">
                                <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-send font-medium-3 mr-50"><line x1="22" y1="2" x2="11" y2="13"></line><polygon points="22 2 15 22 11 13 2 9 22 2"></polygon></svg>
                                    <span id="countSent" class="align-middle">Đã gửi (<?=$this->count['sent']?>)</span>
                                </a>
                                <a href="javascript:void(0)" onclick="listTrash()" class="item-filter3 list-group-item list-group-item-action">
                                <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-trash font-medium-3 mr-50"><polyline points="3 6 5 6 21 6"></polyline><path d="M19 6v14a2 2 0 0 1-2 2H7a2 2 0 0 1-2-2V6m3 0V4a2 2 0 0 1 2-2h4a2 2 0 0 1 2 2v2"></path></svg>
                                    <span id="countTrash" class="align-middle">Thùng rác (<?=$this->count['trash']?>)</span>
                                </a>
                            </div>
                            <!-- <hr /> -->
                            <!--  -->
                        </div>
                    </div>
                </div>

            </div>
        </div>
        <div class="content-right">
            <div class="content-wrapper container-xxl p-0">
                <div class="content-header row">
                </div>
                <div class="content-body">
                    <div class="body-content-overlay"></div>
                    <!-- Email list Area -->
                    <div class="email-app-list">
                        <!-- Email search starts -->
                        <div class="app-fixed-search d-flex align-items-center">
                            <div class="sidebar-toggle d-block d-lg-none ml-1">
                                <i data-feather="menu" class="font-medium-5"></i>
                            </div>
                            <div class="d-flex align-content-center justify-content-between w-100">
                                <div class="input-group input-group-merge">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text"><i data-feather="search" class="text-muted"></i></span>
                                    </div>
                                    <input type="text" class="form-control" id="email-search" placeholder="Tìm kiếm" aria-label="Search..." aria-describedby="email-search" />
                                </div>
                            </div>
                        </div>
                        <!-- Email search ends -->

                        <!-- Email actions starts -->
                        <div class="app-action">
                            <div class="action-left">
                                <div class="custom-control custom-checkbox selectAll">
                                    <!-- <input type="checkbox" class="custom-control-input" id="selectAllCheck" />
                                    <label class="custom-control-label font-weight-bolder pl-25" for="selectAllCheck">Select All</label> -->
                                </div>
                            </div>
                            <div class="action-right">
                                <ul class="list-inline m-0">
                                    <!-- <li class="list-inline-item">
                                        <div class="dropdown">
                                            <a href="javascript:void(0);" class="dropdown-toggle" id="folder" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                <i data-feather="folder" class="font-medium-2"></i>
                                            </a>
                                            <div class="dropdown-menu dropdown-menu-right" aria-labelledby="folder">
                                                <a class="dropdown-item d-flex align-items-center" href="javascript:void(0);">
                                                    <i data-feather="edit-2" class="font-small-4 mr-50"></i>
                                                    <span>Draft</span>
                                                </a>
                                                <a class="dropdown-item d-flex align-items-center" href="javascript:void(0);">
                                                    <i data-feather="info" class="font-small-4 mr-50"></i>
                                                    <span>Spam</span>
                                                </a>
                                                <a class="dropdown-item d-flex align-items-center" href="javascript:void(0);">
                                                    <i data-feather="trash" class="font-small-4 mr-50"></i>
                                                    <span>Trash</span>
                                                </a>
                                            </div>
                                        </div>
                                    </li>
                                    <li class="list-inline-item">
                                        <div class="dropdown">
                                            <a href="javascript:void(0);" class="dropdown-toggle" id="tag" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                <i data-feather="tag" class="font-medium-2"></i>
                                            </a>
                                            <div class="dropdown-menu dropdown-menu-right" aria-labelledby="tag">
                                                <a href="javascript:void(0);" class="dropdown-item"><span class="mr-50 bullet bullet-success bullet-sm"></span>Personal</a>
                                                <a href="javascript:void(0);" class="dropdown-item"><span class="mr-50 bullet bullet-primary bullet-sm"></span>Company</a>
                                                <a href="javascript:void(0);" class="dropdown-item"><span class="mr-50 bullet bullet-warning bullet-sm"></span>Important</a>
                                                <a href="javascript:void(0);" class="dropdown-item"><span class="mr-50 bullet bullet-danger bullet-sm"></span>Private</a>
                                            </div>
                                        </div>
                                    </li>
                                    <li class="list-inline-item mail-unread">
                                        <span class="action-icon"><i data-feather="mail" class="font-medium-2"></i></span>
                                    </li> -->
                                    <li class="list-inline-item mail-delete">
                                        <span class="action-icon" onclick="deleteMsg()"><i data-feather="trash-2" class="font-medium-2"></i></span>
                                    </li>
                                </ul>
                            </div>
                        </div>
                        <!-- Email actions ends -->

                        <!-- Email list starts -->
                        <div class="email-user-list" id="my-task-list">
                        <input type="hidden" id="page" name="page" value="1">    
                        <ul class="email-media-list">
                                <?php
                                foreach ($this->list AS $item) {
                                    if ($item['avatar']!='')
                                        $avatar = HOME.'/users/gemstech/uploads/nhanvien/'.$item['avatar'];
                                    else
                                        $avatar = HOME.'/users/gemstech/uploads/useravatar.png';
                                    if ($item['status']==1 && $this->type != 'sent')
                                        $new = 'bullet-success';
                                    elseif ($item['status']==2)
                                        $new = 'bullet-primary';
                                    else
                                        $new = '';
                                    // $dnone = ($item['status']==0)?'d-none':'';
                                    echo '
                                    <li class="media" onclick="toggleEmail('.$item['id'].')" id="'.$item['id'].'">
                                        <div class="media-left pr-50">
                                            <div class="avatar">
                                                <img onerror='."this.src='https://velo.vn/goffice-test/layouts/useravatar.png'".' src="'.$avatar.'" alt="avatar" />
                                            </div>
                                            <div class="user-action">
                                                <div class="custom-control custom-checkbox">
                                                    <input type="checkbox" class="custom-control-input" id="customCheck'.$item['id'].'" />
                                                    <label class="custom-control-label" for="customCheck'.$item['id'].'"></label>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="media-body">
                                            <div class="mail-details">
                                                <div class="mail-items">
                                                    <h5 class="mb-25">'.$item['senderName'].'</h5>
                                                    <span class="text-truncate">'.$item['title'].'</span>
                                                </div>
                                                <div class="mail-meta-item">
                                                    <span id="alertInbox'.$item['id'].'" class="mr-50 bullet '.$new.' bullet-sm"></span>
                                                    <span class="mail-date">'.$item['dateTime'].'</span>
                                                </div>
                                            </div>
                                            <div class="mail-message">
                                                <p class="mb-0 text-truncate">'.strip_tags($item['subContent']).'</p>
                                            </div>
                                        </div>
                                    </li>
                                    ';
                                }
                                ?>
                            </ul>
                            <div class="no-results">
                                <h5>Không tìm thấy bảng tin</h5>
                            </div>
                        </div>
                        <!-- Email list ends -->
                    </div>
                    <!--/ Email list Area -->
                    <!-- Detailed Email View -->
                    <div class="email-app-details">
                        <!-- Detailed Email Header starts -->
                        <div class="email-detail-header">
                            <div class="email-header-left d-flex align-items-center">
                                <span class="go-back mr-1"><i data-feather="chevron-left" class="font-medium-4"></i>
                                <h4 class="email-subject mb-0" style="float:right">Quay lại inbox</h4></span>
                            </div>
                            <div class="email-header-right ml-2 pl-1">
                          
                            </div>
                        </div>
                        <!-- Detailed Email Header ends -->

                        <!-- Detailed Email Content starts -->
                        <div class="email-scroll-area">
                            <!-- <div class="row">
                                <div class="col-12">
                                    <div class="email-label">
                                      <span class="mail-label badge badge-pill badge-light-primary">Company</span>
                                    </div>
                                </div>
                            </div> -->
                            <div class="row" style="margin-top:10px">
                                <div class="col-12">
                                    <div class="card">
                                        <div class="card-body">
                                            <div class="d-flex justify-content-between">
                                                <h5 class="mb-0">
                                                    <a href="javascript:void(0);" onclick="replyMsg()"><i data-feather='corner-up-left'></i> Trả lời</a>
                                                    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                                    <a href="javascript:void(0);" onclick="forwardMsg()">Gửi tiếp<i data-feather='corner-up-right'></i></a>
                                                    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                                    <a id="delMsgButton" href="javascript:void(0);" onclick="removeMsg()">Thùng rác<i data-feather='trash-2'></i></a>
                                                </h5>
                                                <input type="hidden" id="msgId">
                                                <input type="hidden" id="msgSender">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                           
                            <div class="row">
                                <div class="col-12">
                                    <div class="card">
                                        <div class="card-header email-detail-head">
                                            <div class="user-details d-flex justify-content-between align-items-center flex-wrap">
                                                <div class="avatar mr-75">
                                                    <img src="" id="senderImg" onerror="this.src='<?=HOME?>/layouts/useravatar.png'"   alt="avatar img holder" width="48" height="48" />
                                                </div>
                                                <div class="mail-items">
                                                    <h5 class="mb-0" id="senderName"></h5>
                                                    <div class="email-info-dropup dropdown">
                                                        <!-- <span role="button" class="dropdown-toggle font-small-3 text-muted" id="dropdownMenuButton200" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"> -->
                                                        <span role="button" class="font-small-3" id="msgSubject" >

                                                        </span>
                                                     
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="mail-meta-item d-flex align-items-center">
                                                <small class="mail-date-time text-muted" id="dateTime"></small>
                                                
                                            </div>
                                        </div>
                                        <div class="card-body mail-message-wrapper pt-2">
                                            <div class="mail-message" id="msgContent"></div>
                                        </div>
                                        <div class="card-footer" id="attachedFiles">
                                    
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- Detailed Email Content ends -->
                    </div>
                    <!--/ Detailed Email View -->

                    <!-- compose email -->
                    <div class="modal modal-sticky" id="compose-mail">
                        <div class="modal-dialog modal-lg modal-dialog-scrollable">
                            <div class="modal-content p-0">
                                <div class="modal-header">
                                    <h5 class="modal-title">Soạn tin nhắn</h5>
                                    <div class="modal-actions">
                                        <!-- <a href="javascript:void(0);" class="text-body mr-75"><i data-feather="minus"></i></a>
                                        <a href="javascript:void(0);" class="text-body mr-75"><i data-feather="maximize-2"></i></a> -->
                                        <a class="text-body" href="javascript:void(0);" data-dismiss="modal" aria-label="Close"><i data-feather="x"></i></a>
                                    </div>
                                </div>
                                <div class="modal-body flex-grow-1 p-0">
                                    <form class="compose-form" id="form-send" enctype="multipart/form-data">
                                        <div class="compose-mail-form-field select2-primary">
                                            <label for="email-to" class="form-label">Đến: </label>
                                            <div class="flex-grow-1">
                                                <select class="select2 form-control w-100" id="email-to" name="email-to[]" multiple>
                                                    <option value="0">All</option>
                                                    <?php foreach($this->employee AS $item)
                                                        echo '<option data-avatar="'.$item['avatar'].'" value="'.$item['id'].'">'.$item['name'].'</option>';
                                                    ?>
                                                    <!-- <option data-avatar="1-small.png" value="Jane Foster">Jane Foster</option>
                                                    <option data-avatar="3-small.png" value="Donna Frank">Donna Frank</option>
                                                    <option data-avatar="5-small.png" value="Gabrielle Robertson">Gabrielle Robertson</option>
                                                    <option data-avatar="7-small.png" value="Lori Spears">Lori Spears</option> -->
                                                </select>
                                            </div>
                                            <!-- <div>
                                                <a class="toggle-cc text-body mr-1" href="javascript:void(0);">Cc</a>
                                                <a class="toggle-bcc text-body" href="javascript:void(0);">Bcc</a>
                                            </div> -->
                                        </div>
                                        <div class="compose-mail-form-field cc-wrapper">
                                            <label for="emailCC">Cc: </label>
                                            <div class="flex-grow-1">
                                                <!-- <input type="text" id="emailCC" class="form-control" placeholder="CC"/> -->
                                                <select class="select2 form-control w-100" id="emailCC" multiple>
                                                    <option data-avatar="1-small.png" value="Jane Foster">Jane Foster</option>
                                                    <option data-avatar="3-small.png" value="Donna Frank">Donna Frank</option>
                                                    <option data-avatar="5-small.png" value="Gabrielle Robertson">Gabrielle Robertson</option>
                                                    <option data-avatar="7-small.png" value="Lori Spears">Lori Spears</option>
                                                </select>
                                            </div>
                                            <a class="text-body toggle-cc" href="javascript:void(0);"><i data-feather="x"></i></a>
                                        </div>
                                        <div class="compose-mail-form-field bcc-wrapper">
                                            <label for="emailBCC">Bcc: </label>
                                            <div class="flex-grow-1">
                                                <!-- <input type="text" id="emailBCC" class="form-control" placeholder="BCC"/> -->
                                                <select class="select2 form-control w-100" id="emailBCC" multiple>
                                                    <option data-avatar="1-small.png" value="Jane Foster">Jane Foster</option>
                                                    <option data-avatar="3-small.png" value="Donna Frank">Donna Frank</option>
                                                    <option data-avatar="5-small.png" value="Gabrielle Robertson">Gabrielle Robertson</option>
                                                    <option data-avatar="7-small.png" value="Lori Spears">Lori Spears</option>
                                                </select>
                                            </div>
                                            <a class="text-body toggle-bcc" href="javascript:void(0);"><i data-feather="x"></i></a>
                                        </div>
                                        <div class="compose-mail-form-field">
                                            <label style="width: 60px;" for="emailSubject">Chủ đề: </label>
                                            <input type="text" id="emailSubject" class="form-control"  name="emailSubject" />
                                        </div>
                                        <div id="message-editor">
                                            <div class="editor" id="msgBody" data-placeholder=""></div>
                                            <div class="compose-editor-toolbar">
                                                <!-- <span class="ql-formats mr-0">
                                                    <select class="ql-font">
                                                        <option selected>Sailec Light</option>
                                                        <option value="sofia">Sofia Pro</option>
                                                        <option value="slabo">Slabo 27px</option>
                                                        <option value="roboto">Roboto Slab</option>
                                                        <option value="inconsolata">Inconsolata</option>
                                                        <option value="ubuntu">Ubuntu Mono</option>
                                                    </select>
                                                </span> -->
                                                <span class="ql-formats mr-0">
                                                    <button class="ql-bold"></button>
                                                    <button class="ql-italic"></button>
                                                    <button class="ql-underline"></button>
                                                    <button class="ql-link"></button>
                                                </span>
                                            </div>
                                        </div>
                                        <div class="compose-footer-wrapper">
                                            <div class="btn-wrapper d-flex align-items-center">
                                                <div class="btn-group dropup mr-1">
                                                    <button type="submit" class="btn btn-primary" >Gửi</button>
                                                    <!-- <button type="button" class="btn btn-primary dropdown-toggle dropdown-toggle-split" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" data-reference="parent">
                                                        <span class="sr-only">Toggle Dropdown</span>
                                                    </button>
                                                    <div class="dropdown-menu">
                                                        <a class="dropdown-item" href="javascript:void(0);"> Schedule Send</a>
                                                    </div> -->
                                                </div>
                                                <!-- add attachment -->
                                                <div class="email-attachement">
                                                    <label for="file-input">
                                                        <i data-feather="paperclip" width="17" height="17" class="ml-50"></i>
                                                    </label>
                                                    <input id="file-input" name="files[]" type="file" class="d-none" multiple />
                                                </div>
                                                <ul id="listfile" style="list-style:none"></ul>
                                            </div>
                                            <div class="footer-action d-flex align-items-center">
                                                <!-- <div class="dropup d-inline-block">
                                                    <i class="font-medium-2 cursor-pointer mr-50" data-feather="more-vertical" role="button" id="composeActions" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                    </i>
                                                    <div class="dropdown-menu dropdown-menu-right" aria-labelledby="composeActions">
                                                        <a class="dropdown-item" href="javascript:void(0);">
                                                            <span class="align-middle">Add Label</span>
                                                        </a>
                                                        <a class="dropdown-item" href="javascript:void(0);">
                                                            <span class="align-middle">Plain text mode</span>
                                                        </a>
                                                        <div class="dropdown-divider"></div>
                                                        <a class="dropdown-item" href="javascript:void(0);">
                                                            <span class="align-middle">Print</span>
                                                        </a>
                                                        <a class="dropdown-item" href="javascript:void(0);">
                                                            <span class="align-middle">Check Spelling</span>
                                                        </a>
                                                    </div>
                                                </div> -->
                                                <i data-feather="trash" class="font-medium-2 cursor-pointer" data-dismiss="modal"></i>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!--/ compose email -->

                </div>
            </div>
        </div>
    </div>
</div>
<script src="<?=HOME?>/js/inbox.js"></script>
