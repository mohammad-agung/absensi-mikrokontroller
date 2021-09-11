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
                        <a href="#">Setting App</a>
                    </li>
                    <li class="separator">
                        <i class="flaticon-right-arrow"></i>
                    </li>
                    <li class="nav-item">
                        <a href="#">Role Access</a>
                    </li>
                </ul>
            </div>
            <div class="row">
                <div class="col-md-12">
                    <?= $this->session->flashdata('message'); ?>
                    <div class="card">
                        <div class="card-header">
                            <div class="row">
                                <div class="col-md-6">
                                    <h4 class="card-title">Role Access</h4>
                                </div>
                                <div class="col-md-6">
                                    <div class="d-flex justify-content-end">
                                        <a class="btn btn-primary text-white" role="button" data-toggle="modal" data-target="#addRole">
                                            <span class="btn-label">
                                                <i class="fa fa-plus"></i>
                                            </span>
                                            Add Role
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table id="basic-datatables" class="display table table-striped table-hover">
                                    <thead>
                                        <tr>
                                            <th style="width: 10%;">#</th>
                                            <th>Role</th>
                                            <th style="width: 10%;">Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php $i = 1; ?>
                                        <?php foreach ($user_role as $_user_role) : ?>
                                            <tr>
                                                <th scope="row"><?= $i++; ?></th>
                                                <td><?= $_user_role['role']; ?></td>
                                                <td>
                                                    <div class="form-button-action">
                                                        <a href="<?= base_url('settings/roleaccess/') . $_user_role['id']; ?>" title="" class="btn btn-link btn-warning" data-original-title="Access">
                                                            <i class="fa fa-check-square"></i>
                                                        </a>
                                                        <a title="" class="btn btn-link btn-primary btn-lg" data-original-title="Edit" data-toggle="modal" data-target="#editRole<?= $_user_role['id']; ?>">
                                                            <i class="fa fa-edit"></i>
                                                        </a>
                                                        </a>
                                                        <a title="" class="btn btn-link btn-danger" data-original-title="Remove" data-toggle="modal" data-target="#removeRole<?= $_user_role['id']; ?>">
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

    <!-- Modal Add New Menu-->
    <div class="modal fade" id="addRole" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Add New Role</h5>
                    <button type="button" class="close text-white" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form action="<?= base_url('settings/addrole') ?>" method="POST">
                    <div class="modal-body">
                        <div class="form-group">
                            <label for="role">Role</label>
                            <input type="text" class="form-control" id="role" name="role" placeholder="Role Name" required autocomplete="off">
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">Add</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
 
    <?php foreach ($user_role as $_user_role) : ?>
        <!-- Modal Delete role-->
        <div class="modal fade" id="removeRole<?= $_user_role['id']; ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Remove Role</h5>
                        <button type="button" class="close text-white" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <form action="<?= base_url('settings/deleterole') ?>" method="POST">
                        <div class="modal-body">
                            <p>Are You Sure Want To Remove <?= $_user_role['role']; ?> ?</p>
                            <input type="hidden" name="id" value="<?= $_user_role['id']; ?>">
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
