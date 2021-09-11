<!-- Sidebar -->
<div class="sidebar sidebar-style-2" data-background-color="dark2">
    <div class="sidebar-wrapper scrollbar scrollbar-inner">
        <div class="sidebar-content">
            <div class="user">
                <div class="avatar-sm float-left mr-2">
                    <img src="<?= base_url('assets/app/profile/') . $user['image']; ?>" alt="..." class="avatar-img rounded-circle">
                </div>
                <div class="info">
                    <a data-toggle="collapse" href="#collapseExample" aria-expanded="true">
                        <span>
                            <?php
                            $name = explode(" ", $user['name']);
                            if (count($name) > 1) {
                                echo $name[0] . " " . $name[1];
                            } else {
                                echo $name[0];
                            }
                            ?>
                            <span class="user-level"><?= $role['role']; ?></span>
                            <span class="caret"></span>
                        </span>
                    </a>
                    <div class="clearfix"></div>

                    <div class="collapse in" id="collapseExample">
                        <ul class="nav">
                            <li>
                                <a href="<?= base_url('user'); ?>">
                                    <span class="link-collapse">My Profile</span>
                                </a>
                            </li>
                            <li>
                                <a href="<?= base_url('user/editprofile'); ?>">
                                    <span class="link-collapse">Edit Profile</span>
                                </a>
                            </li>
                            <li>
                                <a href="<?= base_url('user/changepassword'); ?>">
                                    <span class="link-collapse">Settings</span>
                                </a>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
            <?php
            $role_id = $this->session->userdata('role_id');
            $queryMenu = "SELECT `tbl_menu`.`id`,`menu`
                FROM `tbl_menu` JOIN `tbl_access`
                ON `tbl_menu`.`id` = `tbl_access`.`menu_id`
                WHERE `tbl_access`.`role_id` = $role_id
                ORDER BY `tbl_access`.`menu_id` ASC
                ";
            $menu = $this->db->query($queryMenu)->result_array();
            ?>
            <ul class="nav nav-primary">
                <?php foreach ($menu as $_menu) : ?>
                    <li class="nav-section">
                        <span class="sidebar-mini-icon">
                            <i class="fa fa-ellipsis-h"></i>
                        </span>
                        <h4 class="text-section"><?= $_menu['menu']; ?></h4>
                    </li>
                    <?php
                    $menuId = $_menu['id'];
                    $querySubMenu = "SELECT * FROM `tbl_sub_menu` WHERE `menu_id` = $menuId AND `is_active` = 1";
                    $subMenu = $this->db->query($querySubMenu)->result_array();
                    ?>
                    <?php foreach ($subMenu as $_subMenu) : ?>

                        <?php if ($title == $_subMenu['title']) : ?>
                            <li class="nav-item active">
                            <?php else : ?>
                            <li class="nav-item">
                            <?php endif; ?>
                            <a href="<?= base_url($_subMenu['url']); ?>" class="collapsed">
                                <i class="<?= $_subMenu['icon']; ?>"></i>
                                <p><?= $_subMenu['title']; ?></p>
                            </a>
                            </li>
                        <?php endforeach; ?>
                        <!-- <li class="nav-item">
                            <a data-toggle="collapse" href="#submenu">
                                <i class="fas fa-calendar-check"></i>
                                <p>Menu Levels</p>
                                <span class="caret"></span>
                            </a>
                            <div class="collapse" id="submenu">
                                <ul class="nav nav-collapse">
                                    <li>
                                        <a data-toggle="collapse" href="#subnav1">
                                            <span class="sub-item">Level 1</span>
                                            <span class="caret"></span>
                                        </a>
                                        <div class="collapse" id="subnav1">
                                            <ul class="nav nav-collapse subnav">
                                                <li>
                                                    <a href="#">
                                                        <span class="sub-item">Level 2</span>
                                                    </a>
                                                </li>
                                                <li>
                                                    <a href="#">
                                                        <span class="sub-item">Level 2</span>
                                                    </a>
                                                </li>
                                            </ul>
                                        </div>
                                    </li>
                                    <li>
                                        <a data-toggle="collapse" href="#subnav2">
                                            <span class="sub-item">Level 1</span>
                                            <span class="caret"></span>
                                        </a>
                                        <div class="collapse" id="subnav2">
                                            <ul class="nav nav-collapse subnav">
                                                <li>
                                                    <a href="#">
                                                        <span class="sub-item">Level 2</span>
                                                    </a>
                                                </li>
                                            </ul>
                                        </div>
                                    </li>
                                    <li>
                                        <a href="#">
                                            <span class="sub-item">Level 1</span>
                                        </a>
                                    </li>
                                </ul>
                            </div>
                        </li> -->
                    <?php endforeach; ?>
            </ul>
        </div>
    </div>
</div>
<!-- End Sidebar -->