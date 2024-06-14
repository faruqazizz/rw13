<section id="hero" class="hero carousel carousel-fade" data-bs-ride="carousel" data-bs-interval="5000">
    <div class="carousel-inner">
        <?php
        $i = 1;
        foreach ($slider as $slide) {
            $active = ($i == 1) ? 'active' : '';
        ?>
            <div class="carousel-item <?php echo $active; ?>">
                <img src="<?php echo base_url('/_temp/uploads/img/' . $slide->lokasi_foto); ?>" alt="<?php echo $slide->judul_foto; ?>" class="d-block w-100 slidernya_">
            </div><!-- End Carousel Item -->
        <?php
            $i++;
        }
        ?>
    </div>

    <a class="carousel-control-prev" href="#hero" role="button" data-bs-slide="prev">
        <span class="carousel-control-prev-icon bi bi-chevron-left" aria-hidden="true"></span>
    </a>

    <a class="carousel-control-next" href="#hero" role="button" data-bs-slide="next">
        <span class="carousel-control-next-icon bi bi-chevron-right" aria-hidden="true"></span>
    </a>
</section><!-- End Hero Section -->

    <main id="main">
        <!-- ======= About Section ======= -->
        <section id="about" class="about">
            <div class="container" data-aos="fade-up">

                <div class="section-header">
                    <h2>Tentang Kami</h2>
                </div>

                <div class="row g-4 g-lg-5" data-aos="fade-up" data-aos-delay="200">

                    <div class="col-lg-5">
                        <div class="about-img">
                            <img src="<?php echo base_url('/_temp/uploads/img/' . $sambutan->foto_diri); ?>" class="img-fluid" alt="">
                        </div>
                    </div>

                    <div class="col-lg-7">
                        <h3 class="pt-0 pt-lg-5">Sambutan Ketua RW</h3>
                        <p style="margin: 0;  text-align: justify;"><?= substr(strip_tags($sambutan->sambutan_teks), 0, 806) . '...' ?></p>
                        <br>
                        <a href="<?= base_url('profil') ?>"><span>Baca Selengkapnya</span> <i class="bi bi-arrow-right"></i></a>
                    </div>

                    <div class="col-lg-7">
                        <h3 class="pt-0 pt-lg-5"><?= $namaweb->value; ?></h3>

                        <!-- Tabs -->
                        <ul class="nav nav-pills mb-3">
                            <li><a class="nav-link active" data-bs-toggle="pill" href="#tab1">Visi</a></li>
                            <li><a class="nav-link" data-bs-toggle="pill" href="#tab2">Misi</a></li>
                            <li><a class="nav-link" data-bs-toggle="pill" href="#tab3">Tujuan</a></li>
                            <li><a class="nav-link" data-bs-toggle="pill" href="#tab4">Tagline</a></li>
                        </ul><!-- End Tabs -->

                        <!-- Tab Content -->
                        <div class="tab-content">

                            <div class="tab-pane fade show active" id="tab1">
                                <p style="margin: 0;  text-align: justify;"><?= $pengaturan->visi ?></p>
                            </div><!-- End Tab 1 Content -->

                            <div class="tab-pane fade show" id="tab2">
                                <p style="margin: 0; text-align: justify;"><?= str_replace('.', '.<br>', $pengaturan->misi) ?></p>
                            </div><!-- End Tab 2 Content -->

                            <div class="tab-pane fade show" id="tab3">
                                <p style="margin: 0; text-align: justify;"><?= str_replace('.', '.<br>', $pengaturan->tujuan) ?></p>
                            </div><!-- End Tab 3 Content -->

                            <div class="tab-pane fade show" id="tab4">
                                <p style="margin: 0; text-align: justify;"><?= str_replace('.', '.<br>', $pengaturan->tagline) ?></p>
                            </div><!-- End Tab 3 Content -->

                        </div>

                    </div>
                    <div class="col-lg-5">
                        <div class="about-img">
                            <img src="<?php echo base_url('/_temp/uploads/img/' . $pengaturan->foto); ?>" class="img-fluid" alt="">
                        </div>
                    </div>
                </div>

            </div>
        </section><!-- End About Section -->

        <!-- Pengumuman -->
        <section id="recent-pengumuman-posts" class="recent-blog-posts">
            <div class="container" data-aos="fade-up">
                <div class="section-header">
                    <h2>Pengumuman</h2>
                    <p>Pengumuman terbaru RW 13 Cipinang Melayu</p>
                </div>
                <div class="row">
                    <?php foreach ($konten as $k) : ?>
                        <div class="col-lg-4" data-aos="fade-up" data-aos-delay="200">
                            <div class="post-box">
                                <div class="post-img"><img src="<?= base_url('/_temp/uploads/img/' . $k->cover) ?>" class="img-fluid object-fit-cover h-100" alt="<?= $k->slug ?>"></div>
                                <div class="meta">
                                    <span class="post-date"><?= date('D, d F', strtotime($k->tanggal_dibuat)) ?></span>
                                    <span class="post-author"> / Pengumuman</span>
                                </div>
                                <h3 class="post-title"><?= $k->judul ?></h3>
                                <!-- <p><?= substr(strip_tags($k->konten), 0, 101) . '...' ?></p> -->
                                <a href="<?= base_url('detail/' . $k->slug) ?>" class="readmore stretched-link"><span>Baca Selengkapnya</span><i class="bi bi-arrow-right"></i></a>
                            </div>
                        </div>
                    <?php endforeach; ?>
                </div>
                <div class="text-end mt-3">
                    <a href="<?= base_url('pengumuman') ?>"><span>Semua Pengumuman</span><i class="bi bi-arrow-right"></i></a>
                </div>
            </div>
        </section>
        <!-- End Pengumuman -->

        <!-- artikel -->
        <section id="recent-artikel-posts" class="recent-blog-posts">
            <div class="container" data-aos="fade-up">
                <div class="section-header">
                    <h2>Artikel</h2>
                    <p>Artikel terbaru RW 13 Cipinang Melayu</p>
                </div>
                <div class="row">
                    <?php foreach ($artikel as $k) : ?>
                        <div class="col-lg-3" data-aos="fade-up" data-aos-delay="200">
                            <div class="post-box">
                                <div class="post-img" style="height: 200px;"><img src="<?= base_url('/_temp/uploads/img/' . $k->cover) ?>" class="img-fluid object-fit-cover h-100" alt="<?= $k->slug ?>"></div>
                                <div class="meta">
                                    <span class="post-date"><?= date('D, d F', strtotime($k->tanggal_dibuat)) ?></span>
                                    <span class="post-author"> / Jakarta Timur</span>
                                </div>
                                <h3 class="post-title"><?= $k->judul ?></h3>
                                <p><?= substr(strip_tags($k->konten), 0, 101) . '...' ?></p>
                                <a href="<?= base_url('detail/' . $k->slug) ?>" class="readmore stretched-link"><span>Baca Selengkapnya</span><i class="bi bi-arrow-right"></i></a>
                            </div>
                        </div>
                    <?php endforeach; ?>
                </div>
                <div class="text-end mt-3">
                    <a href="<?= base_url('artikel') ?>"><span>Semua Artikel</span><i class="bi bi-arrow-right"></i></a>
                </div>
            </div>
        </section>
        <!-- End artikel -->

        <!-- Galeri -->
        <section id="recent-kegiatan-posts" class="recent-blog-posts">
            <div class="container" data-aos="fade-up">
                <div class="section-header">
                    <h2>Kegiatan</h2>
                    <p>Kegiatan terbaru RW 13 Cipinang Melayu</p>
                </div>
                <div class="row">
                    <?php foreach ($kegiatan as $k) : ?>
                        <div class="col-lg-4" data-aos="fade-up" data-aos-delay="200">
                            <div class="post-box">
                                <div class="post-img" style="height: 200px;"><img src="<?= base_url('/_temp/uploads/img/' . $k->cover) ?>" class="img-fluid object-fit-cover h-100" alt="<?= $k->slug ?>"></div>
                                <div class="meta">
                                    <span class="post-date"><?= date('D, d F', strtotime($k->tanggal_dibuat)) ?></span>
                                    <span class="post-author"> / RW13 Cipinang Melayu</span>
                                </div>
                                <h3 class="post-title"><?= $k->judul ?></h3>
                                <p><?= substr(strip_tags($k->konten), 0, 101) . '...' ?></p>
                                <a href="<?= base_url('detail_kegiatan/' . $k->slug) ?>" class="readmore stretched-link"><span>Baca Selengkapnya</span><i class="bi bi-arrow-right"></i></a>
                            </div>
                        </div>
                    <?php endforeach; ?>
                </div>
                <div class="text-end mt-3">
                    <a href="<?= base_url('artikel') ?>"><span>Semua Kegiatan</span><i class="bi bi-arrow-right"></i></a>
                </div>
            </div>
        </section>
        <!-- End Galeri -->

        <section id="video" class="contact">
            <div class="container">

                <div class="section-header">
                    <h2>Video Kegiatan</h2>
                </div>

                <div class="row">
                    <div class='sk-ww-youtube-channel-videos' data-embed-id='243078'></div><script src='https://widgets.sociablekit.com/youtube-channel-videos/widget.js' async defer></script>
                    <!--<?php foreach ($links as $link) : ?>-->
                    <!--    <div class="col-md-4 mb-4">-->
                    <!--        <div class="card">-->
                    <!--            <div class="embed-responsive embed-responsive-16by9">-->
                    <!--                <iframe class="embed-responsive-item w-100" src="https://www.youtube.com/embed/<?= str_replace('https://youtu.be/', '', $link->lokasi_berkas) ?>"></iframe>-->
                    <!--            </div>-->
                    <!--            <h5 class="card-title text-center my-1"><?= $link->nama_berkas ?></h5>-->
                    <!--            <div class="text-center my-1">-->
                    <!--                <a href="<?= $link->lokasi_berkas ?>" class="btn teksnya" style="background-color: red;   color: white; box-shadow: 0px 3px 6px rgba(0, 0, 0, 0.3);"><i class="bi bi-play mr-1"></i>Tonton Video</a>-->
                    <!--            </div>-->
                    <!--        </div>-->
                    <!--    </div>-->
                    <!--<?php endforeach; ?>-->
                </div>

            </div>

        </section>

    </main><!-- End #main -->