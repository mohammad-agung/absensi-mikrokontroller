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
                        <a href="#">Edit Profile</a>
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
                                    <h4 class="card-title">Edit Profile</h4>
                                </div>
                            </div>
                        </div>
                        <?= form_open_multipart('user/editprofile'); ?>
                        <div class="card-body">
                            <div class="row">
                                <input type="hidden" name="id" value="<?= $user['id']; ?>">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label for="email">Email</label>
                                        <input type="email" class="form-control" id="email" name="email" placeholder="email" value="<?= $user['email']; ?>">
                                    </div>
                                    <div class="form-group">
                                        <label for="name">Name</label>
                                        <input type="text" class="form-control" id="name" name="name" placeholder="Name" value="<?= $user['name']; ?>">
                                        <?= form_error('name', '<small class="form-text text-muted text-danger pl-2">', '</small>'); ?>
                                    </div>
                                    <div class="form-group row">
                                        <div class="col-sm-12">
                                            <label>Picture</label>
                                        </div>
                                        <div class="col-sm-12">
                                            <div class="row">
                                                <div class="col-sm-4">
                                                    <img src="<?= base_url('assets/app/profile/') . $user['image']; ?>" class="img-thumbnail">
                                                </div>
                                                <div class="col-sm-8">
                                                    <div class="custom-file">
                                                        <input type="file" class="custom-file-input image" id="image" name="image">
                                                        <label class="custom-file-label image-label" for="image">Choose file</label>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="card-action">
                            <button class="btn btn-success">Edit</button>
                            <button class="btn btn-danger">Cancel</button>
                        </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>