<footer id="footer" class="footer">
    <div class="footer-content">
        <div class="container">
            <div class="row">
                <div class="col-lg-5 col-md-6">
                    <div class="footer-info">
                        <h3><?= $namaweb->value ?></h3>
                        <p>
                            <?= str_replace('.', '<br>', $alamat->value) ?><br>
                            <strong>Email:</strong> <?= $email->value ?><br>
                        </p>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6 footer-links">
                    <h4>Menu</h4>
                    <ul>
                        <li><i class="bi bi-chevron-right"></i> <a href="<?= base_url() ?>">Home</a></li>
                        <li><i class="bi bi-chevron-right"></i> <a href="<?= base_url('profil') ?>">Profil</a></li>
                        <li><i class="bi bi-chevron-right"></i> <a href="<?= base_url('pengumuman') ?>">Pengumuman</a>
                        </li>
                        <li><i class="bi bi-chevron-right"></i> <a href="<?= base_url('artikel') ?>">Artikel</a></li>
                        <li><i class="bi bi-chevron-right"></i> <a href="<?= base_url('galeri') ?>">Galeri</a></li>
                        <li><i class="bi bi-chevron-right"></i> <a href="<?= base_url('aspirasi') ?>">Aspirasi</a></li>
                    </ul>
                </div>
                <div class="col-lg-4 col-md-12 footer-newsletter">
                    <a href="https://info.flagcounter.com/kDRF"><img
                            src="https://s11.flagcounter.com/count2/kDRF/bg_FFFFFF/txt_000000/border_CCCCCC/columns_2/maxflags_8/viewers_0/labels_0/pageviews_1/flags_0/percent_0/"
                            alt="Flag Counter" border="0"></a>
                </div>
            </div>
        </div>
    </div>
    <div class="footer-legal text-center">
        <div
            class="container d-flex flex-column flex-lg-row justify-content-center justify-content-lg-between align-items-center">
            <div class="d-flex flex-column align-items-center align-items-lg-start">
                <div class="copyright">
                    &copy; Copyright <strong><span>Universitas Nusa Mandiri</span></strong>. All Rights Reserved
                </div>
                <div class="credits">
                    Designed by <a href="https://bootstrapmade.com/">BootstrapMade</a> and modified by <a
                        href="https://faservice.github.io/">Faservice</a>
                </div>
            </div>
            <div class="social-links order-first order-lg-last mb-3 mb-lg-0">
                <a href="<?= $tw->value ?>" class="twitter"><i class="bi bi-twitter"></i></a>
                <a href="<?= $fb->value ?>" class="facebook"><i class="bi bi-facebook"></i></a>
                <a href="<?= $ig->value ?>" class="instagram"><i class="bi bi-instagram"></i></a>
                <a href="<?= $yt->value ?>" class="youtube"><i class="bi bi-youtube"></i></a>
            </div>
        </div>
    </div>
</footer>
<a href="#" class="scroll-top d-flex align-items-center justify-content-center"><i class="bi bi-arrow-up-short"></i></a>
<!-- <div id="preloader"></div> -->
<script src="<?= base_url('/_temp/frontend/') ?>js/jquery.min.js"></script>
<script src="<?= base_url('/_temp/frontend/') ?>vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
<script src="<?= base_url('/_temp/frontend/') ?>vendor/aos/aos.js"></script>
<script src="<?= base_url('/_temp/frontend/') ?>vendor/glightbox/js/glightbox.min.js"></script>
<script src="<?= base_url('/_temp/frontend/') ?>vendor/isotope-layout/isotope.pkgd.min.js"></script>
<script src="<?= base_url('/_temp/frontend/') ?>vendor/swiper/swiper-bundle.min.js"></script>
<script src="<?= base_url('/_temp/frontend/') ?>vendor/fancybox/jquery.fancybox.min.js"> </script>
<script src="<?= base_url('/_temp/frontend/') ?>js/main.js"></script>

</body>

</html>