<?php
if (isset($_GET['theme'])) {
    $theme = ($_GET['theme'] === 'dark') ? 'dark' : 'light';
    setcookie('site_theme', $theme, time() + (86400 * 30), "/");
    echo 'Theme updated to ' . $theme;
}
?>