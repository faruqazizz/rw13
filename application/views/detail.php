<main id="main">

    <!-- ======= Breadcrumbs ======= -->
    <div class="breadcrumbs">
        <div class="container">

            <div class="d-flex justify-content-between align-items-center">
                <h2>Detail</h2>
                <ol>
                    <li><a href="<?= base_url() ?>">Home</a></li>
                    <li>Detail</li>
                </ol>
            </div>

        </div>
    </div><!-- End Breadcrumbs -->
    <!-- ======= Blog Section ======= -->
    <section id="blog" class="blog">
        <div class="container" data-aos="fade-up">

            <div class="row g-5">

                <div class="col-lg-12">

                    <article class="blog-details">

                        <div class="post-img mt-1 mx-1">
                            <img src="<?= base_url('/_temp/uploads/img/' . $artikel->cover) ?>" alt="<?= $artikel->judul ?>" class="img-fluid">
                        </div>

                        <h2 class="title"><?= $artikel->judul ?></h2>

                        <div class="meta-top">
                            <div class="row">
                                <div class="col-md-6">
                                    <ul>
                                        <li class="d-flex align-items-center"><i class="bi bi-person"></i> <a href="blog-details.html">Administrator</a></li>
                                        <li class="d-flex align-items-center"><i class="bi bi-clock"></i> <a href="blog-details.html"><time><?= date('Y-m-d', strtotime($artikel->tanggal_dibuat)) ?></time></a></li>
                                    </ul>
                                </div>
                                <div class="col-md-6">
                                    <div class="d-grid gap-2 d-md-flex justify-content-md-end">
                                        <!-- AddToAny BEGIN -->
                                        <div class="a2a_kit a2a_kit_size_32 a2a_default_style mx-1" data-a2a-title="RW 13 Cipinang Melayu">
                                            <a class="a2a_button_whatsapp"></a>
                                            <a class="a2a_button_facebook"></a>
                                            <a class="a2a_button_copy_link"></a>
                                        </div>
                                        <script>
                                            var a2a_config = a2a_config || {};
                                            a2a_config.locale = "id";
                                        </script>
                                        <script async src="https://static.addtoany.com/menu/page.js"></script>
                                        <!-- AddToAny END -->
                                    </div>
                                </div>
                            </div>
                        </div><!-- End meta top -->

                        <div class="content">
                            <p style="max-width: 100%; margin: 0 auto;">
                                <?= $artikel->konten ?>
                            </p>

                        </div><!-- End post content -->

                        <div class="meta-bottom">
                            <i class="bi bi-folder"></i>
                            <ul class="cats">
                                <li><a href="#"><?= $artikel->nama_kategori ?></a></li>
                            </ul>

                            <i class="bi bi-tags"></i>
                            <ul class="tags">
                                <li><a href="#"><?= $artikel->kata_kunci ?></a></li>
                            </ul>
                        </div><!-- End meta bottom -->

                    </article><!-- End blog post -->



                </div>
                <!-- 
                <div class="col-lg-4">

                    <div class="sidebar">

                        <div class="sidebar-item search-form">
                            <h3 class="sidebar-title">Cari</h3>
                            <form action="<?= base_url('artikel') ?>" class="mt-3">
                                <input type="text" name="search_query" value="<?= html_escape($keyword) ?>" required>
                                <button type="submit"><i class="bi bi-search"></i></button>
                            </form>
                        </div>

                        <div class="sidebar-item recent-posts">
                            <h3 class="sidebar-title">Kegiatan Terbaru</h3>

                            <div class="mt-3">
                                <?php if (empty($recent_post)) : ?>
                                    <p><em>Belum ada kegiatan.</em></p>
                                <?php else : ?>
                                    <?php foreach ($recent_post as $recent) : ?>
                                        <div class="post-item mt-3">
                                            <img src="<?= base_url('/_temp/uploads/img/' . $recent->cover) ?>" alt="<?= $recent->slug ?>" class="flex-shrink-0">
                                            <div>
                                                <h4><a href="<?= base_url('artikel/' . $recent->slug) ?>"><?= substr(strip_tags($recent->judul), 0, 25) . '...' ?></a></h4>
                                                <time datetime="<?= date('Y-m-d', strtotime($recent->tanggal_dibuat)) ?>"><?= date('M d, Y', strtotime($recent->tanggal_dibuat)) ?></time>
                                            </div>
                                        </div>
                                    <?php endforeach; ?>
                                <?php endif; ?>
                            </div>

                        </div>

                        <div class="sidebar-item recent-posts">
                            <h3 class="sidebar-title">Artikel Terbaru</h3>

                            <div class="mt-3">
                                <?php if (empty($artikel_post)) : ?>
                                    <p><em>Belum ada artikel.</em></p>
                                <?php else : ?>
                                    <?php foreach ($artikel_post as $recent) : ?>
                                        <div class="post-item mt-3">
                                            <img src="<?= base_url('/_temp/uploads/img/' . $recent->cover) ?>" alt="<?= $recent->slug ?>" class="flex-shrink-0">
                                            <div>
                                                <h4><a href="<?= base_url('artikel/' . $recent->slug) ?>"><?= substr(strip_tags($recent->judul), 0, 25) . '...' ?></a></h4>
                                                <time datetime="<?= date('Y-m-d', strtotime($recent->tanggal_dibuat)) ?>"><?= date('M d, Y', strtotime($recent->tanggal_dibuat)) ?></time>
                                            </div>
                                        </div>
                                    <?php endforeach; ?>
                                <?php endif; ?>
                            </div>

                        </div>
                    </div>

                </div> -->


            </div>

        </div>
    </section><!-- End Blog Section -->

</main><!-- End #main -->