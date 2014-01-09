<?php
if ($lang == 'ja') {
    $base = '/';
} else {
    $base = '/en/';
}
$home = "http://ranyuen.com$base";
?>
<!DOCTYPE HTML>
<html lang="<?php $h->h($lang); ?>">
<head>
    <meta charset="UTF-8"/>
    <title><?php $h->h($title); ?> - Ranyuen</title>
    <link rel="home" href="<?php $h->h($home); ?>"/>
    <link rel="stylesheet" href="/assets/bower_components/normalize-css/normalize.css"/>
    <link href="http://fonts.googleapis.com/css?family=Alef:400,700" rel="stylesheet" type="text/css"/>
    <link rel="stylesheet" href="/assets/stylesheets/layout.css"/>
    <style>
    body, .header {
        background: url('<?php echo $bgimage; ?>') fixed;
    }
    </style>
</head>
<body>
    <div class="lang">
    <?php if ($lang === 'en') { ?>
        English
    <?php } else { ?>
        <a href="/en/">English</a>
    <?php } ?> /
    <?php if ($lang === 'ja') { ?>
        日本語
    <?php } else { ?>
        <a href="/">日本語</a>
    <?php } ?>
    </div>
    <div class="container">
        <div class="global_nav">
        <?php $h->echoNav($global_nav, $base); ?>
        </div>
        <div class="header">
            <a href="<?php $h->h($home); ?>" class="logo inactive" title="Ranyuen">
                <img src="/assets/images/icons/ranyuen.png" alt="Ranyuen"
                     longdesc="<?php $h->h($home); ?>"/>
            </a>
            <h1><?php $h->h($title); ?><small>Ranyuen</small></h1>
        </div>
        <div class="main">
            <div class="aside">
                <div class="news">
                    <img src="/assets/images/icons/feed.png"
                         width="30" height="30"/>NEWS
                <?php $h->echoNav($news_nav); ?>
                </div>
                <a href="https://www.facebook.com/ranyuenjapan"
                   target="_blank"
                   class="facebook"
                   title="Ranyuen Japan Facebook Page">
                    <img src="/assets/images/icons/facebook.png"
                         alt="Ranyuen Japan Facebook Page"
                         longdesc="https://www.facebook.com/ranyuenjapan"/>
                    <div style="line-height:13pt;">Ranyuen<br/>Facebook</div>
                </a>
            </div>
            <div class="content">
                <div class="breadcrumb">
                <?php $h->echoNav($breadcrumb, $base); ?>
                </div>
                <div class="local_nav">
                <?php $h->echoNav($local_nav, './'); ?>
                </div>
                <?php $h->render($content, $__params); ?>
            </div>
        </div>
        <div class="footer">
            <div class="menu">
            <?php $h->echoNav($global_nav, $base); ?>
            </div>
            <p class="copyright">Copyright (C) 2010-2013
            <a href="<?php $h->h($home); ?>">Ranyuen</a> All Rights Reserved.<br/>
            Spring Calanthe (EBINE) and Ponerorchis (AWACHIDORI &amp; YUMECHIDORI)
            you see on our website are all bred, researched and developed in our
            <a href="<?php $h->h($home); ?>">Ranyuen</a>&#39;s farm.</p>
        </div>
    </div>
    <script src="/assets/javascripts/messageForDeveloperFromRanyuen.js"></script>
    <script type="text/javascript">
        var _gaq = _gaq || [];
        _gaq.push(['_setAccount', 'UA-21495834-1']);
        _gaq.push(['_setDomainName', 'ranyuen.com']);
        _gaq.push(['_setAllowLinker', true]);
        _gaq.push(['_trackPageview']);
        (function () {
            var ga = document.createElement('script');
            ga.type = 'text/javascript';
            ga.async = true;
            ga.src = ('https:' == document.location.protocol ?
                'https://ssl' : 'http://www') +
                '.google-analytics.com/ga.js';
            var s = document.getElementsByTagName('script')[0];
            s.parentNode.insertBefore(ga, s);
        })();
    </script>
</body>
</html>
