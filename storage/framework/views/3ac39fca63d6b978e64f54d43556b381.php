<style>
    .dropdown>.dropdown-menu>.dropdown>.dropdown-menu {
        position: absolute;
        left: 100%;
        top: 10%;
    }

    .dropdown>.dropdown-menu>.dropdown>.dropdown-menu {
        display: none;
        background-color: #E64946;
        color: #FFF;
        font-size: large;
    }

    /* Sembunyikan submenu secara default */
    .dropdown-menu {
        visibility: hidden;
        opacity: 0;
        transition: visibility 0s linear 0.3s, opacity 0.3s ease-in-out;
    }

    /* Tampilkan submenu saat hover pada elemen utama */
    .dropdown:hover>.dropdown-menu {
        visibility: visible;
        opacity: 1;
        transition-delay: 0s;
    }

    /* Tampilkan submenu saat hover pada submenu */
    .dropdown-menu .dropdown:hover>.dropdown-menu {
        visibility: visible;
        opacity: 1;
        transition-delay: 0s;
    }
</style>

<nav class="navbar navbar-default" role="navigation">
    <div class="container-fluid">
        <div class="navbar-header">
            <div class="row visible-xs">
                <div class="col-xs-6 visible-xs">
                    <img src="<?php echo e(gambar_desa($desa['logo'])); ?>" class="cardz hidden-lg hidden-md" width="30" align="left" alt="<?php echo e($desa['nama_desa']); ?>" />
                </div>
                <div class="col-xs-6 visible-xs">
                    <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
                        <span class="sr-only">Toggle navigation</span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                    </button>
                </div>
            </div>
        </div>
        <div id="navbar" class="navbar-collapse collapse">
            <ul class="nav navbar-nav custom_nav">
                <li class="dropdown"><a href="<?php echo e(site_url()); ?>">Beranda</a></li>
                <?php echo createDropdownMenu(menu_tema()); ?>

            </ul>
        </div>
    </div>
</nav>
<?php /**PATH C:\xampp\htdocs\opensid\/storage/app/themes/natra/resources/views/partials/menu_head.blade.php ENDPATH**/ ?>