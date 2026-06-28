<div id="page-wrapper">
    <div class="row border-bottom">
        <nav class="navbar navbar-static-top" role="navigation" style="margin-bottom: 0">
            <div class="navbar-header">
                <a class="navbar-minimalize minimalize-styl-2 btn btn-outline" href="#"><i class="fa fa-bars"></i> </a>
                <h3 style="display: inline-block; margin: 0; line-height: 58px; padding-left: 15px; vertical-align: middle;">
                    <span class="font-mono text-cyan">STRYX</span> <small class="text-muted d-none d-md-inline">Security Assessment</small>
                </h3>
            </div>

            <ul class="nav navbar-top-links navbar-right">
                <li style="padding: 10px">
                    <span class="m-r-sm text-muted welcome-message"><?= $user['name']; ?></span>
                </li>
                <li class="dropdown">
                    <a data-toggle="dropdown" class="dropdown-toggle" href="#">
                        <span class="text-muted text-xs block"><i class="fa fa-cogs"></i><b class="caret"></b></span>
                    </a>
                    <ul class="dropdown-menu animated fadeInRight m-t-xs dropdown-menu-right">
                        <li><a class="dropdown-item" href="<?= base_url('auth/logout'); ?>">Logout</a></li>
                    </ul>
                </li>
            </ul>
        </nav>
    </div>


    <div class="row wrapper border-bottom page-heading shadow">
        <div class="col-sm-4">
            <h2 class="font-mono"><?= $menus['desc']; ?></h2>
            <ol class="breadcrumb">
                <li class="breadcrumb-item">
                    <a href="#">
                        <?= $menus['main_menu'] === 'Home' ? 'Home' : $menus['main_menu']; ?>
                    </a>
                </li>
                <li class="breadcrumb-item active">
                    <strong>
                        <?= $menus['title']; ?>
                    </strong>
                </li>
            </ol>
        </div>
    </div>








