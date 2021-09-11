<div class="main-panel">
    <div class="content">
        <div class="page-inner">
            <div class="page-header">
                <ul class="breadcrumbs">
                    <li class="nav-home">
                        <a href="#">
                            <i class="flaticon-home"></i>
                        </a>
                    </li>
                    <li class="separator">
                        <i class="flaticon-right-arrow"></i>
                    </li>
                    <li class="nav-item">
                        <a href="#">User</a>
                    </li>
                    <li class="separator">
                        <i class="flaticon-right-arrow"></i>
                    </li>
                    <li class="nav-item">
                        <a href="#">Account Setting</a>
                    </li>
                </ul>
            </div>
            <div class="row">
                <div class="col-md-6">
                    <?= $this->session->flashdata('message'); ?>
                    <div class="card">
                        <div class="card-header">
                            <div class="row">
                                <div class="col-md-6">
                                    <h4 class="card-title">Change Password</h4>
                                </div>
                            </div>
                        </div>
                        <form action="<?= base_url('user/changepassword') ?>" method="POST">
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label for="currentPassword">Current password</label>
                                            <input type="password" class="form-control" id="currentPassword" name="currentpassword">
                                            <?= form_error('currentpassword', '<small class="form-text text-muted text-danger pl-2">', '</small>'); ?>
                                        </div>
                                        <div class="form-group">
                                            <label for="newPassword1">New password</label>
                                            <input type="password" class="form-control" id="newPassword1" name="newPassword1">
                                            <?= form_error('newPassword1', '<small class="form-text text-muted text-danger pl-2">', '</small>'); ?>
                                        </div>
                                        <div class="form-group">
                                            <label for="newPassword2">Repeat Password password</label>
                                            <input type="password" class="form-control" id="newPassword2" name="newPassword2">
                                            <?= form_error('newPassword2', '<small class="form-text text-muted text-danger pl-2">', '</small>'); ?>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="card-action">
                                <button class="btn btn-success">Update</button>
                                <button class="btn btn-danger">Cancel</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>