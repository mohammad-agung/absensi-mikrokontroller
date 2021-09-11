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
                        <a href="#">Section</a>
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
                                    <h4 class="card-title">Add Section</h4>
                                </div>
                            </div>
                        </div>
                        <form action="<?= base_url('academics/addsection') ?>" method="POST">
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label for="section">Section</label>
                                            <input type="section" class="form-control" id="section" name="section" placeholder="Section" autocomplete="off" value="<?= set_value('section'); ?>">
                                            <span class="focus-input100"></span>
                                        </div>
                                        <?= form_error('section', '<small class="text-danger pl-3 m-b-16 mt-10">', '</small>'); ?>
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
                                    <h4 class="card-title">Section List</h4>
                                </div>
                            </div>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-hover">
                                    <thead>
                                        <tr>
                                            <th style="width: 10%;">#</th>
                                            <th>Section</th>
                                            <th style="width: 10%;">Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php $i = 1; ?>
                                        <?php foreach ($section as $_section) : ?>
                                            <tr>
                                                <th scope="row"><?= $i++; ?></th>
                                                <td><?= $_section['nama_bagian']; ?></td>
                                                <td>
                                                    <div class="form-button-action">
                                                        <a title="" class="btn btn-link btn-primary btn-lg" data-original-title="Edit" data-toggle="modal" data-target="#editSection<?= $_section['id']; ?>">
                                                            <i class="fa fa-edit"></i>
                                                        </a>
                                                        <a title="" class="btn btn-link btn-danger" data-original-title="Remove" data-toggle="modal" data-target="#removeSection<?= $_section['id']; ?>">
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

    <?php foreach ($section as $_section) : ?>
        <!-- Modal Delete Section-->
        <div class="modal fade" id="removeSection<?= $_section['id']; ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Remove Section</h5>
                        <button type="button" class="close text-white" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <form action="<?= base_url('academics/deletesection') ?>" method="POST">
                        <div class="modal-body">
                            <p>Are You Sure Want To Remove Section <?= $_section['nama_bagian']; ?> ?</p>
                            <input type="hidden" name="id" value="<?= $_section['id']; ?>">
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

    <?php foreach ($section as $_section) : ?>
        <!-- Modal Edit Section-->
        <div class="modal fade" id="editSection<?= $_section['id']; ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Update Section</h5>
                        <button type="button" class="close text-white" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <form action="<?= base_url('academics/updatesection') ?>" method="POST">
                        <div class="modal-body">
                            <div class="form-group">
                                <input type="hidden" name="id" value="<?= $_section['id']; ?>">
                                <label for="section">Section</label>
                                <input type="section" class="form-control" id="section" name="section" placeholder="Section" autocomplete="off" value="<?= $_section['nama_bagian']; ?>">
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
                            <button type="submit" class="btn btn-primary">Update</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    <?php endforeach; ?>