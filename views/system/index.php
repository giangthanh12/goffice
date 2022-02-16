<div class="app-content content">
    <div class="content-overlay"></div>
    <div class="header-navbar-shadow"></div>
    <div class="content-wrapper container-xxl p-0">
        <div class="content-header row"></div>
        <div class="content-body">
            <!-- users list start -->
            <section class="app-user-list">
                <!-- list section start -->
                <div class="card">
                    <div class="card-body">
                        <form class="form-validate" enctype="multipart/form-data" id="fm">
                            <?php
                            foreach ($this->data as $item) {
                                if ($item['id'] == 7 || $item['id'] == 8) {
                            ?>
                                    <div class="form-group">
                                        <label for="ten" id="ten"><?= $item['name'] ?></label></br>
                                        <img src="<?= $item['value'] ?>" name="gia_tri<?= $item['id'] ?>" width="200px" /></br>
                                        <input type="file" name="gia_tri<?=$item['id']?>" id="logo" />
                                    </div>
                                <?php
                                } else {
                                ?>
                                    <div class="form-group">
                                        <label for="ten" id="ten"><?= $item['name'] ?></label>
                                        <input type="text" class="form-control " name="gia_tri<?= $item['id'] ?>" value="<?= $item['value'] ?>" placeholder="Nhập <?= $item['name'] ?>" name="gia_tri" required />
                                    </div>
                            <?php
                                } 
                            }
                            ?>

                            <div class="d-flex flex-sm-row flex-column mt-2">
                                <button type="button" onclick="save()" class="btn btn-primary mb-1 mb-sm-0 mr-0 mr-sm-1">Cập nhật</button>
                            </div>
                        </form>
                    </div>
                </div>
            </section>
        </div>
    </div>
</div>
<script>
    var funAdd = <?= $this->funAdd ?>,
        funEdit = <?= $this->funEdit ?>,
        funDel = <?= $this->funDel ?>;
</script>
<script src="<?= HOME ?>/js/system.js"></script>