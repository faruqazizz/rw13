<main id="main">
    <!-- ======= Contact Section ======= -->
    <section id="contact" class="contact mt-2">
        <div class="container">

            <div class="section-header">
                <h2>Hubungi Kami</h2>
            </div>

        </div>

        <div class="map">
            <iframe src="<?= $pengaturan->alamat_gmaps ?>" frameborder="0" allowfullscreen></iframe>
        </div><!-- End Google Maps -->

        <div class="container">

            <div class="row gy-5 gx-lg-5">

                <div class="col-lg-4">

                    <div class="info">
                        <h3><?= $namaweb->value ?></h3>
                        <p>Aspirasi Anda akan kami jadikan evaluasi</p>
                        <div class="info-item d-flex">
                            <i class="bi bi-geo-alt flex-shrink-0"></i>
                            <div>
                                <h4>Location:</h4>
                                <p><?= str_replace('.', '<br>', $alamat->value) ?></p>
                            </div>
                        </div><!-- End Info Item -->

                        <div class="info-item d-flex">
                            <i class="bi bi-envelope flex-shrink-0"></i>
                            <div>
                                <h4>Email:</h4>
                                <p><?= $email->value ?></p>
                            </div>
                        </div><!-- End Info Item -->

                        <div class="info-item d-flex">
                            <i class="bi bi-phone flex-shrink-0"></i>
                            <div>
                                <h4>Call:</h4>
                                <p><?= $telepon->value ?></p>
                            </div>
                        </div><!-- End Info Item -->

                    </div>

                </div>

                <div class="col-lg-8">
                    <?php echo form_open('submit', 'class="php-email-form"'); ?>
                    <?php if (validation_errors()) { ?>
                        <div class="alert alert-danger alert-dismissible fade show" role="alert">
                            <?php echo validation_errors(); ?>
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div> <?php } ?>
                    <?php if ($this->session->flashdata('berhasil')) { ?>
                        <div class="alert alert-success alert-dismissible fade show" role="alert">
                            <?php echo $this->session->flashdata('berhasil'); ?>
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div> <?php } ?>
                    <div class="row">
                        <div class="col-md-6 form-group">
                            <input type="text" name="name" class="form-control" id="name" placeholder="Masukkan Nama" required>
                        </div>
                        <div class="col-md-6 form-group mt-3 mt-md-0">
                            <input type="email" class="form-control" name="email" id="email" placeholder="Masukkan Email" required>
                        </div>
                    </div>
                    <div class="form-group mt-3">
                        <select class="form-select" name="subject" id="subject">
                            <option value="Saran">Saran</option>
                            <option value="Keluhan">Keluhan</option>
                            <option value="Aduan">Aduan</option>
                            <option value="Lainnya">Lainnya</option>
                        </select>
                    </div>
                    <div class="form-group mt-3">
                        <textarea class="form-control" name="message" placeholder="Isi Aspirasi" required></textarea>
                    </div>

                    <div class="text-center"><button type="submit">Kirim Aspirasi</button></div>
                    <?php echo form_close(); ?>
                    <div id="toast-container"></div>
                </div><!-- End Contact Form -->

            </div>

        </div>
    </section><!-- End Contact Section -->

</main><!-- End #main -->