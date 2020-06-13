<?php
defined('BASEPATH') or exit('No direct script access allowed');
$this->load->view('dist/_partials/header');
?>
<!-- Main Content -->
<div class="main-content">
    <section class="section">
        <div class="section-header">
            <h1><?= $page ?></h1>
            <div class="section-header-breadcrumb">
                <div class="breadcrumb-item"><a href="#">Forms</a></div>
                <div class="breadcrumb-item"><?= $page ?></div>
            </div>
        </div>

        <div class="section-body col-xs-12">
            <h2 class="section-title"><?= $page ?></h2>
            <p class="section-lead">

            </p>
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <form action="<?php echo $action; ?>" method="post">
                            <div class="col-12 col-sm-8 offset-sm-2 col-md-6 offset-md-3 col-lg-6 offset-lg-3 col-xl-4 offset-xl-4">
                                <div class="card-body">
                                    <div class="form-group">
                                        <label for="name">Name *</label>
                                        <input type="text" class="form-control" value="<?= $name ?>" name="name" id="name" required autofocus>
                                    </div>
                                    <div class="form-group">
                                        <label for="username">Username *</label>
                                        <input type="text" class="form-control" name="username" value="<?= $username ?>" id="username" required autofocus>
                                        <?= form_error('username', '<small class="text-danger">', '</small>'); ?>
                                    </div>
                                    <div class="form-group">
                                        <label for="password">Password *</label>
                                        <input type="password" class="form-control" name="password" id="password" required autofocus>
                                        <?= form_error('password', '<small class="text-danger">', '</small>'); ?>
                                    </div>
                                    <div class="form-group">
                                        <label for="passwordconf">Password Confirmation *</label>
                                        <input type="password" class="form-control" id="passwordconf" name="passwordconf" required autofocus>
                                    </div>
                                    <div class="form-group">
                                        <label for="level">Level *</label>
                                        <select name="level" class="form-control" required autofocus>
                                            <option value="">- Pilih -</option>
                                            <option value="1" <?= $level == 1 ? "selected" : null ?>>Admin</option>
                                            <option value="2" <?= $level == 2 ? "selected" : null ?>>Gudang</option>
                                            <option value="3" <?= $level == 3 ? "selected" : null ?>>Apoteker</option>
                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <label for="id_ruang">Ruang *</label>
                                        <select name="id_ruang" class="form-control" required autofocus>
                                            <option value="">--Pilih Ruang--</option>
                                            <?php foreach ($id_ruang as $key => $data) { ?>
                                                <option value="<?= $data->id ?>"><?= $data->nama_ruang ?></option>
                                            <?php } ?>
                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <label for="address">Alamat *</label>
                                        <textarea class="form-control" name="address" id="address"><?= $address ?></textarea>
                                    </div>
                                    <input type="hidden" name="id" value="<?php echo $id; ?>" />
                                    <button type="submit" class="btn btn-primary"><?php echo $button ?></button>
                                    <a href="<?php echo site_url('User') ?>" class="btn btn-default">Cancel</a>
                                </div>
                            </div>
                        </form>
                    </div>

                </div>
            </div>
        </div>

    </section>
</div>
<?php $this->load->view('dist/_partials/footer'); ?>