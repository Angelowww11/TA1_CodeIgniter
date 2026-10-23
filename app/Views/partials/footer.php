    </main>
    <button class="motion-toggle" type="button" aria-pressed="false">Pause motion</button>
    <footer class="site-footer"><div class="container footer-inner"><span>SimplePOS <span aria-hidden="true">/</span> Store operations</span><span>IT0049 &middot; <?= date('Y') ?></span></div></footer>
    <script src="<?= base_url('js/nature-motion.js') ?>?v=<?= substr(md5_file(FCPATH . 'js/nature-motion.js'), 0, 12) ?>" defer></script>
</body>
</html>
