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
                        <a href="#">Class</a>
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
                                    <h4 class="card-title">Add Class</h4>
                                </div>
                            </div>
                        </div>
                        <form action="<?= base_url('academics/addclass') ?>" method="POST">
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label for="class">Class</label>
                                            <input type="class" class="form-control" id="class" name="class" placeholder="Class" autocomplete="off" value="<?= set_value('class'); ?>" required>
                                        </div>
                                    </div>
                                    <div class="col-sm-12">
                                        <div class="form-group">
                                            <label for="section">Section</label>
                                            <?php foreach ($section as $_section) : ?>
                                                <div class="custom-control custom-switch">
                                                    <input type="checkbox" class="custom-control-input changed" id="changed_<?= $_section['id']; ?>" name="checked[]" value="<?= $_section['id']; ?>">
                                                    <label class=" custom-control-label" for="changed_<?= $_section['id']; ?>"><?= $_section['nama_bagian']; ?></label>
                                                </div>
                                            <?php endforeach; ?>
                                        </div>
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
                                    <h4 class="card-title">Class List</h4>
                                </div>
                            </div>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-hover">
                                    <thead>
                                        <tr>
                                            <th style="width: 10%;">#</th>
                                            <th>Class</th>
                                            <th>Section</th>
                                            <th style="width: 10%;">Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php $i = 1; ?>
                                        <?php foreach ($class as $_class) : ?>
                                            <tr>
                                                <th scope="row"><?= $i++; ?></th>
                                                <td><?= $_class['nama_kelas']; ?></td>
                                                <td>
                                                    <?php
                                                    foreach ($section_class as $_sectionclass) :
                                                        if ($_class['nama_kelas'] == $_sectionclass['nama_kelas']) :
                                                    ?><div><?= $_sectionclass['nama_bagian']; ?></div>
                                                    <?php
                                                        endif;
                                                    endforeach;
                                                    ?>
                                                </td>
                                                <td>
                                                    <div class="form-button-action">
                                                        <a title="" class="btn btn-link btn-primary btn-lg" data-original-title="Edit" data-toggle="modal" data-target="#editClass<?= $_class['id']; ?>">
                                                            <i class="fa fa-edit"></i>
                                                        </a>
                                                        <a title="" class="btn btn-link btn-danger" data-original-title="Remove" data-toggle="modal" data-target="#removeClass<?= $_class['id']; ?>">
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

    <?php foreach ($class as $_class) : ?>
        <!-- Modal Delete Class-->
        <div class="modal fade" id="removeClass<?= $_class['id']; ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Remove Class</h5>
                        <button type="button" class="close text-white" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <form action="<?= base_url('academics/deleteclass') ?>" method="POST">
                        <div class="modal-body">
                            <p>Are You Sure Want To Remove Class <?= $_class['nama_kelas']; ?> ?</p>
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

    <?php foreach ($class as $_class) : ?>
        <!-- Modal Edit Class-->
        <div class="modal fade" id="editClass<?= $_class['id']; ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Update Class</h5>
                        <button type="button" class="close text-white" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <form action="<?= base_url('academics/updateclass') ?>" method="POST">
                        <div class="modal-body">
                            <div class="form-group">
                                <label for="class">Class</label>
                                <input type="class" class="form-control" id="class" name="class" placeholder="Class" autocomplete="off" value="<?= $_class['nama_kelas']; ?>">
                                <input type="hidden" name="id_class" value="<?= $_class['nama_kelas']; ?>">
                            </div>
                            <div class="form-group">
                                <label for="section">Section</label>
                                <?php foreach ($section as $_section) : ?>
                                    <div class="custom-control custom-switch">
                                        <input type="checkbox" class="custom-control-input changed" id="changed_<?= $_section['id']; ?>" name="checked[]" value="<?= $_section['id']; ?>" <?php foreach ($section_class as $_sectionclass) : ?> <?php if ($_class['nama_kelas'] == $_sectionclass['nama_kelas']) { ?> <?php if ($_section['id'] == $_sectionclass['id_bagian']) { ?> checked <?php } ?> <?php } ?> <?php endforeach; ?>> <label class=" custom-control-label" for="changed_<?= $_section['id']; ?>"><?= $_section['nama_bagian']; ?></label>
                                    </div>
                                <?php endforeach; ?>
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