<main id="main">

    <!-- ======= Breadcrumbs ======= -->
    <div class="breadcrumbs">
        <div class="container">

            <div class="d-flex justify-content-between align-items-center">
                <h2>Artikel</h2>
                <ol>
                    <li><a href="<?= base_url() ?>">Home</a></li>
                    <li>Artikel</li>
                </ol>
            </div>

        </div>
    </div><!-- End Breadcrumbs -->

    <!-- ======= Blog Section ======= -->
    <section id="blog" class="blog">
        <div class="container" data-aos="fade-up">

            <div class="row g-5">

                <div class="col-lg-8">
                    <div class="row gy-4 posts-list">
                        <?php foreach ($artikel as $k) : ?>
                        <div class="col-lg-6">
                            <article class="d-flex flex-column">
                                <div class="post-img">
                                    <img src="<?= base_url('/_temp/uploads/img/' . $k->cover) ?>" alt="<?= $k->slug ?>"
                                        class="img-fluid">
                                </div>
                                <div class="post-body">
                                    <h3 class="post-title"><a
                                            href="<?= base_url('detail/' . $k->slug) ?>"><?= $k->judul ?></a></h3>
                                    <div class="meta-top">
                                        <ul>
                                            <li class="d-flex align-items-center"><i
                                                    class="bi bi-tag-fill"></i><?= $k->nama_kategori ?></li>
                                            <li class="d-flex align-items-center"><i
                                                    class="bi bi-clock"></i><time><?= date('d M Y', strtotime($k->tanggal_dibuat)) ?></time>
                                            </li>
                                        </ul>
                                    </div>
                                    <p class="post-description"><?= substr(strip_tags($k->konten), 0, 100) . '...' ?>
                                    </p>
                                    <div class="read-more mt-auto d-flex justify-content-end">
                                        <a href="<?= base_url('detail/' . $k->slug) ?>">Selengkapnya</a>
                                    </div>
                                </div>
                            </article>
                        </div>
                        <?php endforeach; ?>
                    </div>
                    <!-- pagination -->

                    <?= $pagination_links ?>

                </div>

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
                            <h3 class="sidebar-title">Pengumuman Terbaru</h3>

                            <div class="mt-3">
                                <?php if (empty($recent_post)) : ?>
                                <p><em>Belum ada pengumuman.</em></p>
                                <?php else : ?>
                                <?php foreach ($recent_post as $recent) : ?>
                                <div class="post-item mt-3">
                                    <img src="<?= base_url('/_temp/uploads/img/' . $recent->cover) ?>"
                                        alt="<?= $recent->slug ?>" class="flex-shrink-0">
                                    <div>
                                        <h4><a
                                                href="<?= base_url('detail/' . $recent->slug) ?>"><?= substr(strip_tags($recent->judul), 0, 25) . '...' ?></a>
                                        </h4>
                                        <time
                                            datetime="<?= date('Y-m-d', strtotime($recent->tanggal_dibuat)) ?>"><?= date('M d, Y', strtotime($recent->tanggal_dibuat)) ?></time>
                                    </div>
                                </div><!-- End recent post item-->
                                <?php endforeach; ?>
                                <?php endif; ?>
                            </div>

                        </div><!-- End sidebar recent posts-->

                        <div class="sidebar-item recent-posts">
                            <h3 class="sidebar-title">Artikel Terbaru</h3>

                            <div class="mt-3">
                                <?php if (empty($artikel_post)) : ?>
                                <p><em>Belum ada artikel.</em></p>
                                <?php else : ?>
                                <?php foreach ($artikel_post as $recent) : ?>
                                <div class="post-item mt-3">
                                    <img src="<?= base_url('/_temp/uploads/img/' . $recent->cover) ?>"
                                        alt="<?= $recent->slug ?>" class="flex-shrink-0">
                                    <div>
                                        <h4><a
                                                href="<?= base_url('detail/' . $recent->slug) ?>"><?= substr(strip_tags($recent->judul), 0, 25) . '...' ?></a>
                                        </h4>
                                        <time
                                            datetime="<?= date('Y-m-d', strtotime($recent->tanggal_dibuat)) ?>"><?= date('M d, Y', strtotime($recent->tanggal_dibuat)) ?></time>
                                    </div>
                                </div><!-- End recent post item-->
                                <?php endforeach; ?>
                                <?php endif; ?>
                            </div>

                        </div><!-- End sidebar recent posts-->
                    </div><!-- End Blog Sidebar -->

                </div>


            </div>

        </div>
    </section><!-- End Blog Section -->

</main><!-- End #main -->