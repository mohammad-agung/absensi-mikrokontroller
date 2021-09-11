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
                        <a href="#">Menu</a>
                    </li>
                    <li class="separator">
                        <i class="flaticon-right-arrow"></i>
                    </li>
                    <li class="nav-item">
                        <a href="#">Sub Menu Management</a>
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
                                    <h4 class="card-title">Sub Menu Management</h4>
                                </div>
                                <div class="col-md-6">
                                    <div class="d-flex justify-content-end">
                                        <a class="btn btn-primary text-white" role="button" data-toggle="modal" data-target="#addSubMenu">
                                            <span class="btn-label">
                                                <i class="fa fa-plus"></i>
                                            </span>
                                            Add Sub Menu
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
                                            <th style="width: 5%;">#</th>
                                            <th>Title</th>
                                            <th>Menu</th>
                                            <th>Url</th>
                                            <th>Icon</th>
                                            <th>Status</th>
                                            <th style="width: 10%;">Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php $i = 1; ?>
                                        <?php foreach ($subMenu as $_subMenu) : ?>
                                            <tr>
                                                <th scope="row"><?= $i++; ?></th>
                                                <td><?= $_subMenu['title']; ?></td>
                                                <td><?= $_subMenu['menu']; ?></td>
                                                <td><?= $_subMenu['url']; ?></td>
                                                <td><?= $_subMenu['icon']; ?></td>
                                                <td>
                                                    <?php if ($_subMenu['is_active'] == 1) : ?>
                                                        <div class="badge badge-success">Active</div>
                                                    <?php else : ?>
                                                        <div class="badge badge-danger">Disactived</div>
                                                    <?php endif; ?>
                                                </td>
                                                <td>
                                                    <div class="form-button-action">
                                                        <a title="" class="btn btn-link btn-primary btn-lg" data-original-title="Edit" data-toggle="modal" data-target="#editSubMenu<?= $_subMenu['id']; ?>">
                                                            <i class="fa fa-edit"></i>
                                                        </a>
                                                        <a title="" class="btn btn-link btn-danger" data-original-title="Remove" data-toggle="modal" data-target="#removeSubMenu<?= $_subMenu['id']; ?>">
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

    <!-- Modal Add New SubMenu-->
    <div class="modal fade" id="addSubMenu" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Add New Menu</h5>
                    <button type="button" class="close text-white" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form action="<?= base_url('menu/addsubmenu') ?>" method="POST">
                    <div class="modal-body">
                        <div class="form-group">
                            <label for="title">Sub Menu Title</label>
                            <input type="text" class="form-control" id="title" name="title" placeholder="Sub Menu Title" required autocomplete="off">
                        </div>
                        <div class="form-group">
                            <label for="title">Menu Parent</label>
                            <select name="menu_id" id="menu_id" class="form-control">
                                <option value="" disabled selected>Choose Option...</option>
                                <?php foreach ($menu as $_menu) : ?>
                                    <option value="<?= $_menu['id']; ?>"><?= $_menu['menu']; ?></option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="url">Url</label>
                            <input type="text" class="form-control" id="url" name="url" placeholder="Url" required autocomplete="off">
                        </div>
                        <div class="form-group">
                            <label for="icon">Icon</label>
                            <input type="text" class="form-control" id="icon" name="icon" placeholder="Menu Icon" required autocomplete="off">
                        </div>
                        <div class="form-check">
                            <label class="form-check-label">
                                <input class="form-check-input" type="checkbox" class="custom-control-input" id="is_active" name="is_active" value="1" checked>
                                <span class="form-check-sign">Active ?</span>
                            </label>
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

    <?php foreach ($subMenu as $_subMenu) : ?>
        <!-- Modal Delete SubMenu-->
        <div class="modal fade" id="removeSubMenu<?= $_subMenu['id']; ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Remove SubMenu</h5>
                        <button type="button" class="close text-white" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <form action="<?= base_url('menu/deletesubmenu') ?>" method="POST">
                        <div class="modal-body">
                            <p>Are You Sure Want To Remove <?= $_subMenu['title']; ?> ?</p>
                            <input type="hidden" name="id" value="<?= $_subMenu['id']; ?>">
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
  

    <?php foreach ($subMenu as $_subMenu) : ?>
        <!-- Modal Update SubMenu-->
        <div class="modal fade" id="editSubMenu<?= $_subMenu['id']; ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Update SubMenu</h5>
                        <button type="button" class="close text-white" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <form action="<?= base_url('menu/updatesubmenu') ?>" method="POST">
                        <input type="hidden" name="id" value="<?= $_subMenu['id']; ?>">
                        <div class="modal-body">
                            <div class="form-group">
                                <label for="title">Sub Menu Title</label>
                                <input type="text" class="form-control" id="title" name="title" placeholder="Sub Menu Title" required autocomplete="off" value="<?= $_subMenu['title']; ?>">
                            </div>
                            <div class="form-group">
                                <label for="title">Menu Parent</label>
                                <select name="menu_id" id="menu_id" class="form-control">
                                    <option value="<?= $_subMenu['menu_id']; ?>"><?= $_subMenu['menu']; ?></option>
                                    <?php foreach ($menu as $_menu) : ?>
                                        <option value="<?= $_menu['id']; ?>"><?= $_menu['menu']; ?></option>
                                    <?php endforeach; ?>
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="url">Url</label>
                                <input type="text" class="form-control" id="url" name="url" placeholder="Url" required autocomplete="off" value="<?= $_subMenu['url']; ?>">
                            </div>
                            <div class="form-group">
                                <label for="icon">Icon</label>
                                <input type="text" class="form-control" id="icon" name="icon" placeholder="Menu Icon" required autocomplete="off" value="<?= $_subMenu['icon']; ?>">
                            </div>
                            <div class="form-check">
                                <label class="form-check-label">
                                    <input class="form-check-input" type="checkbox" class="custom-control-input" id="is_active" name="is_active" value="1"
                                    <?php if($_subMenu['is_active'] == "1"){ ?>
                                        checked
                                    <?php } ?>>
                                    <span class="form-check-sign">Active ?</span>
                                </label>
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