<main id="main">

    <!-- ======= Breadcrumbs ======= -->
    <div class="breadcrumbs">
        <div class="container">

            <div class="d-flex justify-content-between align-items-center">
                <h2><?= $kegiatan->nama_galeri ?></h2>
                <ol>
                    <li><a href="<?= base_url() ?>">Home</a></li>
                    <li>Dokumentasi</li>
                </ol>
            </div>

        </div>
    </div><!-- End Breadcrumbs -->

    <!-- ======= Blog Section ======= -->
    <section id="blog" class="blog animated fadeIn delay-2s">
        <div class="container" data-aos="fade-up">

            <div class="row g-5">
                <div class="col-lg-12">
                    <div class="row gy-4 posts-list">
                        <?php foreach ($detail as $k) : ?>
                        <div class="col-lg-4">
                            <?= is_image($k->file); ?>
                        </div>
                        <?php endforeach; ?>
                    </div>

                </div>
            </div>

        </div>
    </section><!-- End Blog Section -->
</main><!-- End #main -->