<main id="main">

<!-- ======= About Section ======= -->
<section id="sambutan" class="about">
<div class="section-header">
                <h2>Tentang Kami</h2>
                <h3><?= $namaweb->value; ?></h3>
            </div>

            <div class="container" data-aos="fade-up">
                <div class="row g-4 g-lg-5" data-aos="fade-up" data-aos-delay="200">
                <div class="col-lg-4">
                <img src="<?php echo base_url('/_temp/uploads/img/' . $sambutan->foto_diri); ?>" class="img-fluid" alt="Foto Ketua RW">
                </div>    
                <div class="col-lg-8">                    
                        <h4 class="pt-0 pt-lg-5">Sambutan Ketua RW</h4>
                        <p><?= $sambutan->sambutan_teks ?></p>
                    </div>

                </div>

            </div>
        </section><!-- End About Section -->

    <section id="profil" class="about">
        <div class="container" data-aos="fade-up">

            <div class="row g-4 g-lg-5" data-aos="fade-up" data-aos-delay="200">
                <div class="col-lg-12">
                    <div class="about-img text-center">
                        <img src="<?php echo base_url('/_temp/uploads/img/' . $foto->lokasi_foto); ?>"
                            alt="<?= $foto->judul_foto ?>" class="img-fluid">
                    </div>
                </div>
            </div>
            <div class="row my-5">
                <div class="col-lg-12">
                    <div class="accordion" id="accordionExample">
                        <?php foreach ($fotofoto as $index => $foto) : ?>
                        <div class="accordion-item">
                            <h2 class="accordion-header" id="accordion-heading<?= $index; ?>">
                                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                                    data-bs-target="#collapse<?= $index; ?>" aria-expanded="false"
                                    aria-controls="collapse<?= $index; ?>">
                                    <?= $foto->judul_foto; ?>
                                </button>
                            </h2>
                            <div id="collapse<?= $index; ?>" class="accordion-collapse collapse"
                                aria-labelledby="accordion-heading<?= $index; ?>" data-bs-parent="#accordionExample">
                                <div class="accordion-body">
                                    <img src="<?php echo base_url('/_temp/uploads/img/' . $foto->lokasi_foto); ?>"
                                        class="img-fluid">
                                    <div class="text-center">
                                        <a href="<?= $foto->link_berkas ?>" target="_blank" rel="noopener noreferrer"
                                            class="btn btn-info mt-1"><i class="bi bi-cloud-download mx-1"></i>Lihat
                                            Selengkapnya</a>
                                    </div>
                                </div>
                            </div>


                        </div>
                        <?php endforeach; ?>
                    </div>
                </div>
            </div>
    </section>

    <!-- ======= F.A.Q Section ======= -->
    <section id="faq" class="faq">
        <div class="container-fluid" data-aos="fade-up">

            <div class="row gy-4">

                <div
                    class="col-lg-10 offset-md-1 d-flex flex-column justify-content-center align-items-stretch order-2 order-lg-1">

                    <div class="content px-xl-5">
                        <h3>Tentang Kami</h3>
                    </div>

                    <div class="accordion accordion-flush px-xl-5" id="faqlist">

                        <div class="accordion-item" data-aos="fade-up" data-aos-delay="100">
                            <h3 class="accordion-header">
                                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                                    data-bs-target="#faq-content-1">
                                    <i class="bi bi-check-all"></i>
                                    Deskripsi Website
                                </button>
                            </h3>
                            <div id="faq-content-1" class="accordion-collapse collapse" data-bs-parent="#faqlist">
                                <div class="accordion-body">
                                    <p style="margin: 0;  text-align: justify;"><?= $pengaturan->deskripsi_web ?></p>
                                </div>
                            </div>
                        </div><!-- # Faq item-->

                        <div class="accordion-item" data-aos="fade-up" data-aos-delay="200">
                            <h3 class="accordion-header">
                                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                                    data-bs-target="#faq-content-2">
                                    <i class="bi bi-check-all"></i>
                                    Visi
                                </button>
                            </h3>
                            <div id="faq-content-2" class="accordion-collapse collapse" data-bs-parent="#faqlist">
                                <div class="accordion-body">
                                    <p style="margin: 0;  text-align: justify;"><?= $pengaturan->visi ?></p>
                                </div>
                            </div>
                        </div><!-- # Faq item-->

                        <div class="accordion-item" data-aos="fade-up" data-aos-delay="300">
                            <h3 class="accordion-header">
                                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                                    data-bs-target="#faq-content-3">
                                    <i class="bi bi-check-all"></i>
                                    Misi
                                </button>
                            </h3>
                            <div id="faq-content-3" class="accordion-collapse collapse" data-bs-parent="#faqlist">
                                <div class="accordion-body">
                                    <p style="margin: 0;  text-align: justify;">
                                        <?= str_replace('.', '.<br>', $pengaturan->misi) ?></p>
                                </div>
                            </div>
                        </div><!-- # Faq item-->
                        
                        <div class="accordion-item" data-aos="fade-up" data-aos-delay="400">
                            <h3 class="accordion-header">
                                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                                    data-bs-target="#faq-content-4">
                                    <i class="bi bi-check-all"></i>
                                    Tujuan
                                </button>
                            </h3>
                            <div id="faq-content-4" class="accordion-collapse collapse" data-bs-parent="#faqlist">
                                <div class="accordion-body">
                                    <p style="margin: 0;  text-align: justify;">
                                        <?= str_replace('.', '.<br>', $pengaturan->tujuan) ?></p>
                                </div>
                            </div>
                        </div><!-- # Faq item-->
                        
                        <div class="accordion-item" data-aos="fade-up" data-aos-delay="500">
                            <h3 class="accordion-header">
                                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                                    data-bs-target="#faq-content-5">
                                    <i class="bi bi-check-all"></i>
                                    Motto dan Tagline
                                </button>
                            </h3>
                            <div id="faq-content-5" class="accordion-collapse collapse" data-bs-parent="#faqlist">
                                <div class="accordion-body">
                                    <p style="margin: 0;  text-align: justify;">
                                        <?= str_replace('.', '.<br>', $pengaturan->motto) ?>
                                    </p>
                                    <br>
                                    <p style="margin: 0;  text-align: justify;">
                                        <?= str_replace('.', '.<br>', '"'.$pengaturan->tagline.'"') ?>
                                    </p>
                                </div>
                            </div>
                        </div><!-- # Faq item-->

                    </div>

                </div>

                <!-- <div class="col-lg-4 align-items-stretch order-1 order-lg-2 img"> <img
                        src="<?php echo base_url('/_temp/uploads/img/' . $pengaturan->foto); ?>" class="img-fluid"
                        alt=""></div> -->
            </div>

        </div>
    </section><!-- End F.A.Q Section -->


</main>