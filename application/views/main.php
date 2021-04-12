<!doctype html>
<html lang="id">
    <?php 
        // HEAD
        include './application/views/template/head/head.php';
        render_head_with_title('YES! Medika');

        // BODY
        include $page.'.php';

        // FOOTER
        include './application/views/template/footer/footer.php';
        
        // SCRIPT
        include './application/views/template/script/script.php';

        // JS SCRIPT EACH PAGE
        @include $page.'.js';

    ?>
</html>