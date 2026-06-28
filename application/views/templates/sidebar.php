<nav class="navbar-default navbar-static-side" role="navigation">
    <div class="sidebar-collapse">
        <ul class="nav metismenu" id="side-menu">
            <li class="nav-header">
                <div class="dropdown profile-element" align="center">
                    <img alt="image" class="rounded-circle" width="70" height="70" src="<?= base_url('assets/img/profile/') . $user['image'] ?>"/>
                    <a data-toggle="dropdown" class="dropdown-toggle" href="#">
                        <span class="block m-t-xs font-bold"><?= $user['name']; ?></span>
                    </a>
                </div>
                <div class="logo-element">
                    <i class="fa fa-code"></i>
                </div>
            </li>

            <?php
            $role_id = $this->session->userdata('role_id');

            $this->db->select('*');
            $this->db->from('user_role');
            $this->db->join('user_access_menu', 'user_access_menu.role_id = user_role.id');
            $this->db->join('user_menu', 'user_menu.id = user_access_menu.menu_id');
            $this->db->where('role_id', $role_id);
            $this->db->where('is_active', '1');
            $this->db->where('is_main_menu', '0');
            $this->db->order_by('user_menu.no_urut');
            $query = $this->db->get()->result();
            ?>





            <?php foreach ($query as $menu) : ?>
                <?php
                // Ambil data submenu dari database
                $this->db->select('*');
                $this->db->from('user_role');
                $this->db->join('user_access_menu', 'user_access_menu.role_id = user_role.id');
                $this->db->join('user_menu', 'user_menu.id = user_access_menu.menu_id');
                $this->db->where('role_id', $role_id);
                $this->db->where('is_active', '1');
                $this->db->where('is_main_menu', $menu->id);
                $this->db->order_by('user_menu.no_urut');
                $sub_menu = $this->db->get();

                // Tentukan apakah menu ini aktif
                $is_menu_active = $this->uri->segment(1) == $menu->url;

                // Tentukan apakah ada submenu yang aktif
                $is_submenu_active = false;
                foreach ($sub_menu->result() as $sub) {
                    if ($this->uri->segment(1) == $sub->url) {
                        $is_submenu_active = true;
                        break;
                    }
                }
                ?>

                <?php if ($sub_menu->num_rows() != 0) : ?>
                    <li class="<?= $is_menu_active || $is_submenu_active ? 'active' : '' ?>">
                        <a href="#">
                            <i class="<?= $menu->icon; ?>"></i>
                            <span class="nav-label"><?= $menu->title; ?></span>
                            <span class="fa arrow"></span>
                        </a>
                        <ul class="nav nav-second-level <?= $is_menu_active || $is_submenu_active ? 'collapse in' : 'collapse' ?>">
                            <?php foreach ($sub_menu->result() as $sub) : ?>
                                <li class="<?= $this->uri->segment(1) == $sub->url ? 'active' : '' ?>">
                                    <a href="<?= base_url($sub->url); ?>"><?= $sub->title; ?></a>
                                </li>
                            <?php endforeach; ?>
                        </ul>
                    </li>
                <?php else : ?>
                    <li class="<?= $is_menu_active ? 'active' : '' ?>">
                        <a href="<?= base_url($menu->url); ?>">
                            <i class="<?= $menu->icon; ?>"></i>
                            <span class="nav-label"><?= $menu->title; ?></span>
                        </a>
                    </li>
                <?php endif; ?>
            <?php endforeach; ?>



            <li>
                <a href="<?= base_url('auth/logout') ?>"><i class="fa fa-fw fa-sign-out"></i> <span class="nav-label">Logout</span></a>
            </li>
        </ul>
    </div>
</nav>