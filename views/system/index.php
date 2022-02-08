<!-- <link rel="stylesheet" type="text/css" href="<?= HOME ?>/styles/app-assets/css/pages/app-kanban.css"> -->


<div class="app-content content">
    <div class="content-overlay"></div>
    <div class="header-navbar-shadow"></div>
    <div class="content-wrapper container-xxl p-0">
        <div class="content-header row"></div>
        <div class="content-body">
            <!-- users list start -->
            <section class="app-user-list">
                <!-- list section start -->
               <div class="row">
               <div class="col-md-12">
                        <div class="card">
                            <div class="card-body">
                                <div class="tab-content">
                                    <!-- general tab -->
                                    <div role="tabpanel" class="tab-pane active" id="account-vertical-general" aria-labelledby="account-pill-general" aria-expanded="true">
                                        <!-- header media -->
                                     
                                        <!--/ header media -->
                                        <h4 class="">Thông tin công ty</h4>
                                        <!-- form -->
                                        <form class="validate-form mt-2" id="formInfoCompany">
                                            <div class="row">
                                                <?php foreach( $this->system as $item ) { ?>
                                                <div class="col-12 col-sm-12">
                                                    <div class="form-group">
                                                        <label for="tt<?=$item['id']?>"><?=$item['name']?></label>
                                                        <input type="text" required class="form-control" data-msg-required="Bạn chưa nhập <?= $item['name'] ?>" id="tt<?=$item['id']?>" value="<?=$item['value']?>" name="tt<?=$item['id']?>"   />
                                                    </div>
                                                </div>
                                                <?php } ?>
                                               
                                                <div class="col-12">
                                                    <button type="submit" class="btn btn-primary mt-2 mr-1" >Cập nhật</button>
                                                </div>
                                            </div>
                                        </form>
                                        <!--/ form -->
                                    </div>
                             
                                </div>
                            </div>
                        </div>
                    </div>
               </div>
            </section>
        </div>
    </div>
</div>
<!--  -->
<script src="<?= HOME ?>/js/system.js"></script>