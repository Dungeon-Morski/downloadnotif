
<?php
$url = $_SERVER['REQUEST_URI'];
?>


<header class="header">
    <div class="container header__items flex justify-between">
        <div class="logo">
            <a href="/index.php"><span class="main-blue">sky</span>-x.space</a>
        </div>
        <ul class="flex gap-3">
            <li><a href="index.php" <?= $url == '/index.php' ? "class='main-blue'": ''?>>ga<span class="main-blue">me</span></a></li>
            <li><a href="antivirus.php" <?= $url == '/antivirus.php' ? "class='main-blue'": ''?>><span class="main-blue">anti</span>virus & <span class="main-blue" >vp</span>n</a></li>
            <li><a href="adobe.php" <?= $url == '/adobe.php' ? "class='main-blue'": ''?>>ad<span class="main-blue">o</span>be</a></li>
            <li><a href="soft.php" <?= $url == '/soft.php' ? "class='main-blue'": ''?>>so<span class="main-blue">ft</span></a></li>
        </ul>
    </div>
</header>