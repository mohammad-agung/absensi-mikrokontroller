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
                        <a href="#">Academic</a>
                    </li>
                    <li class="separator">
                        <i class="flaticon-right-arrow"></i>
                    </li>
                    <li class="nav-item">
                        <a href="#">Subject</a>
                    </li>
                </ul>
            </div>
            <div class="row">
                <div class="col-md-12">
                    <?= $this->session->flashdata('message'); ?>
                </div>
                <div class="col-md-6">
                    <div class="card">
                        <div class="card-header">
                            <div class="row">
                                <div class="col-md-6">
                                    <h4 class="card-title">Add Subject</h4>
                                </div>
                            </div>
                        </div>
                        <form action="<?= base_url('academics/addsubject') ?>" method="POST">
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label for="subject">Subject Name</label>
                                            <input type="subject" class="form-control" id="subject" name="subject" placeholder="Subject Name" autocomplete="off" value="<?= set_value('subject'); ?>">
                                            <span class="focus-input100"></span>
                                        </div>
                                        <?= form_error('subject', '<small class="text-danger pl-3 m-b-16 mt-10">', '</small>'); ?>
                                        <div class="form-group">
                                            <label for="code">Subject Code</label>
                                            <input type="code" class="form-control" id="code" name="code" placeholder="Subject Code" autocomplete="off" value="<?= set_value('code'); ?>">
                                            <span class="focus-input100"></span>
                                        </div>
                                        <?= form_error('code', '<small class="text-danger pl-3 m-b-16 mt-10">', '</small>'); ?>
                                    </div>
                                </div>
                            </div>
                            <div class="card-action">
                                <button class="btn btn-success">Add</button>
                            </div>
                        </form>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="card">
                        <div class="card-header">
                            <div class="row">
                                <div class="col-md-6">
                                    <h4 class="card-title">Subject List</h4>
                                </div>
                            </div>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-hover">
                                    <thead>
                                        <tr>
                                            <th style="width: 10%;">#</th>
                                            <th>Subject Name</th>
                                            <th>Subject Code</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php $i = 1; ?>
                                        <?php foreach ($subject as $_subject) : ?>
                                            <tr>
                                                <th scope="row"><?= $i++; ?></th>
                                                <td><?= $_subject['nama_mapel']; ?></td>
                                                <td><?= $_subject['kode_mapel']; ?></td>
                                                <td>
                                                    <div class="form-button-action">
                                                        <a title="" class="btn btn-link btn-primary btn-lg" data-original-title="Edit" data-toggle="modal" data-target="#editSubject<?= $_subject['id']; ?>">
                                                            <i class="fa fa-edit"></i>
                                                        </a>
                                                        <a title="" class="btn btn-link btn-danger" data-original-title="Remove" data-toggle="modal" data-target="#removeSubject<?= $_subject['id']; ?>">
                                                            <i class="fa fa-times"></i>
                                                        </a>
                                                    </div>
                                                </td>
                                            </tr>
                                        <?php endforeach; ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <?php foreach ($subject as $_subject) : ?>
        <!-- Modal Delete Subject-->
        <div class="modal fade" id="removeSubject<?= $_subject['id']; ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Remove Subject</h5>
                        <button type="button" class="close text-white" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <form action="<?= base_url('academics/deletesubject') ?>" method="POST">
                        <div class="modal-body">
                            <p>Are You Sure Want To Remove Subject <?= $_subject['nama_mapel']; ?> ?</p>
                            <input type="hidden" name="id" value="<?= $_subject['id']; ?>">
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-danger" data-dismiss="modal">Cancel</button>
                            <button type="submit" class="btn btn-primary">Remove</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    <?php endforeach; ?>