<?php \App\Services\Page::part('msg'); ?>
<?php \App\Services\Page::part('error'); ?>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.3/jquery.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4"
        crossorigin="anonymous"></script>

<script>
    $(document).ready(function () {
        <?php if (!empty($_SESSION['notify']['info'])): ?>
        $('.toast-custom').toast('show');
        <?php endif;?>
        <?php if (!empty($_SESSION['notify']['error'])): ?>
        $('.toast').toast('show');
        <?php endif;?>
    });
</script>

<?php unset($_SESSION['notify']); ?>

</body>
</html>