<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta content="width=device-width, initial-scale=1.0" name="viewport">
    <title><?= $namaweb->value ?></title>
    <meta content="<?= $pengaturan->deskripsi_web ?>" name="description">
    <meta content="RW13 Cipinang Melayu, Universitas Nusa Mandiri, Faservice" name="keywords">
    <link href="<?= base_url('/_temp/uploads/img/' . $favicon->value) ?>" rel="icon">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link
        href="https://fonts.googleapis.com/css2?family=Open+Sans:ital,wght@0,300;0,400;0,500;0,600;0,700;1,300;1,400;1,500;1,600;1,700&family=Poppins:ital,wght@0,300;0,400;0,500;0,600;0,700;1,300;1,400;1,500;1,600;1,700&family=Source+Sans+Pro:ital,wght@0,300;0,400;0,600;0,700;1,300;1,400;1,600;1,700&display=swap"
        rel="stylesheet">
    <link href="<?= base_url('/_temp/frontend/') ?>vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <link href="<?= base_url('/_temp/frontend/') ?>vendor/bootstrap-icons/bootstrap-icons.css" rel="stylesheet">
    <link href="<?= base_url('/_temp/frontend/') ?>vendor/aos/aos.css" rel="stylesheet">
    <link href="<?= base_url('/_temp/frontend/') ?>vendor/glightbox/css/glightbox.min.css" rel="stylesheet">
    <link href="<?= base_url('/_temp/frontend/') ?>vendor/swiper/swiper-bundle.min.css" rel="stylesheet">
    <link href="<?= base_url('/_temp/frontend/') ?>css/variables-red.css" rel="stylesheet">
    <link href="<?= base_url('/_temp/frontend/') ?>css/main.css" rel="stylesheet">
    <link href="<?= base_url('/_temp/frontend/') ?>vendor/fancybox/jquery.fancybox.min.css" rel="stylesheet">
</head>

<body>

    <div class="faserv">
        <div class="banner text-center">
            <img src="<?= base_url('/_temp/uploads/img/' . $pengaturan->header); ?>" height="15%" class="img-fluid w-100">
        </div>
        <div class="marquee">
            <marquee direction="left"><?= $pengaturan->marquee ?></marquee>
        </div>
    </div>
    <header id="header" class="header fixed-top" data-scrollto-offset="0">
        <div class="container-fluid d-flex align-items-center justify-content-between">
            <a href="<?= base_url() ?>" class="logo d-flex align-items-center scrollto me-auto me-lg-0">
                <!-- <img src="<?= base_url('/_temp/frontend/') ?>img/logo.png" alt=""> -->
                <h1>RW<span>.</span>013 BERSINERGI</h1>
            </a>
            <nav id="navbar" class="navbar">
                <ul>
                    <li><a href="<?= base_url() ?>">Home</a></li>
                    <li><a href="<?= base_url('profil') ?>">Profil</a></li>
                    <li><a href="<?= base_url('pengumuman') ?>">Pengumuman</a></li>
                    <li><a href="<?= base_url('artikel') ?>">Artikel</a></li>
                    <li><a href="<?= base_url('galeri') ?>">Galeri</a></li>
                    <?php
                    $menus = $this->db->get('menu_frontend')->result_array();
                    $menu_halaman = $this->db->get('menu_halaman')->result_array();
                    $total_rows = count($menus);
                    $total_rows_halaman = count($menu_halaman);
                    if ($total_rows_halaman > 3) {
                        echo '<li class="dropdown"><a href="#"><span>Lainnya</span> <i class="bi bi-chevron-down dropdown-indicator"></i></a><ul>';
                        foreach ($menu_halaman as $menu) {							
							echo '<li class="dropdown"><a href="'.$menu['tautan_menu'].'"><span>' . $menu['nama_halaman'] . '</span> <i class="bi bi-chevron-down dropdown-indicator"></i></a><ul>';
							foreach ($menus as $submenu) {
								if ($submenu['id_halaman'] == $menu['id']) {
									echo '<li><a href="' . $submenu['tautan_menu'] . '">' . $submenu['nama_menu'] . '</a></li>';
								}
							}							
							echo '</ul></li>';							
                        }
                        echo '</ul></li>';
                    } else {
                        foreach ($menu_halaman as $menu) {
                            echo '<li class="dropdown"><a href="'.$menu['tautan_menu'].'"><span>' . $menu['nama_halaman'] . '</span> <i class="bi bi-chevron-down dropdown-indicator"></i></a><ul>';
                            foreach ($menus as $submenu) {
                                if ($submenu['id_halaman'] == $menu['id']) {
                                    echo '<li><a href="' . $submenu['tautan_menu'] . '">' . $submenu['nama_menu'] . '</a></li>';
                                }
                            }
                            echo '</ul></li>';
                        }
                    }
                    ?>
                    <li><a href="<?= base_url('aspirasi') ?>">Aspirasi</a></li>
                    <li><a href="<?= base_url(LOGIN_ROUTE) ?>">Login</a></li>
                </ul>
                <i class="bi bi-list mobile-nav-toggle d-none"></i>
            </nav>
        </div>
    </header>
    <div id="gabutaja"></div>