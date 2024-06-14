<main id="main">

    <!-- ======= Breadcrumbs ======= -->
    <div class="breadcrumbs">
        <div class="container">

            <div class="d-flex justify-content-between align-items-center">
                <h2>Galeri</h2>
                <ol>
                    <li><a href="<?= base_url() ?>">Home</a></li>
                    <li>Galeri</li>
                </ol>
            </div>

        </div>
    </div><!-- End Breadcrumbs -->

    <!-- ======= Blog Section ======= -->
    <section id="blog" class="blog">
        <div class="container" data-aos="fade-up">

            <div class="row g-5">
                <div class="col-lg-12">
                    <div class="row gy-4 posts-list">
                        <?php foreach ($artikel as $k) : ?>
                        <div class="col-lg-4">
                            <article class="d-flex flex-column">
                                <div class="post-img">
                                    <img src="<?= base_url('/_temp/uploads/img/' . $k->cover) ?>" alt="<?= $k->slug ?>"
                                        class="img-fluid">
                                </div>
                                <div class="post-body">
                                    <h3 class="post-title"><a
                                            href="<?= base_url('detail_kegiatan/' . $k->slug) ?>"><?= $k->nama_galeri ?></a>
                                    </h3>

                                    <p class="post-description">
                                        <?= substr(strip_tags($k->deskripsi_kegiatan), 0, 200) . '...' ?>
                                    </p>
                                    <div class="read-more mt-auto d-flex justify-content-end">
                                        <a href="<?= base_url('detail_kegiatan/' . $k->slug) ?>">Selengkapnya</a>
                                    </div>
                                </div>
                            </article>
                        </div>
                        <?php endforeach; ?>
                    </div>
                    <!-- pagination -->

                    <?= $pagination_links ?>

                </div>
            </div>

        </div>
    </section><!-- End Blog Section -->
</main><!-- End #main -->