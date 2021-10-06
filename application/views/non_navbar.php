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

        // BODY
        include $page.'.php';

        // FOOTER
        include './application/views/template/footer/footer.php';
        
        // SCRIPT
        include './application/views/template/script/script.php';

        // JS SCRIPT EACH PAGE
        echo "<script>";
        @include $page.'.js';
        echo "</script>";

    ?>
</html>