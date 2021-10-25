<!DOCTYPE html>
<html lang="en">
<head>
    <title>마크다운 블로그</title>
    <!-- Meta -->
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="Blog Template">
    <meta name="author" content="Xiaoying Riley at 3rd Wave Media">
    <link rel="shortcut icon" href="favicon.ico">

    <!-- FontAwesome JS-->
    <script defer src="/assets/fontawesome/js/all.min.js"></script>

    <!-- Theme CSS -->
    <link id="theme-style" rel="stylesheet" href="/assets/css/theme-1.css">

</head>
<body>
<header class="header text-center">
    <h1 class="blog-name pt-lg-4 mb-0"><a href="/post">마크다운 블로그</a></h1>

    <nav class="navbar navbar-expand-lg navbar-dark" >

        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navigation" aria-controls="navigation" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div id="navigation" class="collapse navbar-collapse flex-column" >
            <div class="profile-section pt-3 pt-lg-0">                
                <ul class="social-list list-inline py-3 mx-auto">
                    <li class="list-inline-item"><a href="#"><i class="fab fa-twitter fa-fw"></i></a></li>
                    <li class="list-inline-item"><a href="#"><i class="fab fa-linkedin-in fa-fw"></i></a></li>
                    <li class="list-inline-item"><a href="#"><i class="fab fa-github-alt fa-fw"></i></a></li>
                    <li class="list-inline-item"><a href="#"><i class="fab fa-stack-overflow fa-fw"></i></a></li>
                    <li class="list-inline-item"><a href="#"><i class="fab fa-codepen fa-fw"></i></a></li>
                </ul><!--//social-list-->
                <hr>
            </div><!--//profile-section-->

            <ul class="navbar-nav flex-column text-left">
                <li class="nav-item">
                    <?php
                    if (App\helpers\LoginHelper::isLogin()) {
                        $login_link = "/oauth/logout";
                        $login_message = "로그아웃";
                    }else{
                        $login_link = "/oauth/google";
                        $login_message = "로그인";
                    }
                    ?>
                    <a class="nav-link" href="<?= $login_link ?>"><i class="fas fa-bookmark fa-fw mr-2"></i><?= $login_message ?></a>
                </li>
            </ul>
        </div>
    </nav>
</header>
<div class="main-wrapper">
    <section class="blog-list px-3 py-5 p-md-5">
        <div class="container">

    <?= $this->renderSection('content') ?>

    <footer class="footer text-center py-2 theme-bg-dark">
        <!--/* This template is released under the Creative Commons Attribution 3.0 License. Please keep the attribution link below when using for your own project. Thank you for your support. :) If you'd like to use the template without the attribution, you can buy the commercial license via our website: themes.3rdwavemedia.com */-->
        <small class="copyright">Designed with <i class="fas fa-heart" style="color: #fb866a;"></i> by <a href="http://themes.3rdwavemedia.com" target="_blank">Xiaoying Riley</a> for developers</small>
    </footer>

</div><!--//main-wrapper-->

<!-- Javascript -->
<script src="/assets/plugins/jquery-3.4.1.min.js"></script>
<script src="/assets/plugins/popper.min.js"></script>
<script src="/assets/plugins/bootstrap/js/bootstrap.min.js"></script>

<!-- Page Specific JS -->
<script src="//cdnjs.cloudflare.com/ajax/libs/highlight.js/9.14.2/highlight.min.js"></script>

<!-- Custom JS -->
<script src="/assets/js/blog.js"></script>



</body>
</html>