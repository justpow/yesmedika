<!doctype html>
<html lang="id">
    <?php 

        $title = "";
        switch ($page) {
            case 'auth/login':
                $title = 'Masuk';
                break;

            case 'user/register':
                $title = 'Buat Akun';
                break;
            
            default:
                $title = "YES! Medika";
                break;
        }

        // HEAD
        include './application/views/template/head/head.php';
        render_head_with_title($title);

        // NAVBAR
        include './application/views/template/nav/nav.php';

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
