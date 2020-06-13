<?php
defined('BASEPATH') or exit('No direct script access allowed');
$this->load->view('dist/_partials/header');
?>
<!-- Main Content -->
<div class="main-content">
    <section class="section">
        <div class="section-header">
            <h1>User Data</h1>
            <div class="section-header-breadcrumb">
                <div class="breadcrumb-item active"><a href="#">User Data</a></div>
            </div>
        </div>

        <div class="section-body">


            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            <h4>User Data</h4>
                            <div>
                                <?php echo anchor(site_url('User/create'), 'Create', 'class="btn btn-primary"'); ?>
                            </div>
                        </div>
                        <div class="card-body">
                            <?= $this->session->flashdata('message'); ?>
                            <div class="table-responsive">
                                <table class="table table-striped" id="mytable" style="overflow-x:auto;">
                                    <thead>
                                        <tr>
                                            <th width="80px">No</th>
                                            <th>Username</th>
                                            <th>Name</th>
                                            <th>Address</th>
                                            <th>Level</th>
                                            <th>Ruang</th>
                                            <th width="200px">Action</th>
                                        </tr>
                                    </thead>

                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </section>
</div>

<?php $this->load->view('dist/_partials/footer'); ?>