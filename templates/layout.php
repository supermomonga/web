<?php
$site_names = ['ja' => '蘭裕園', 'en' => 'Ranyuen'];
$site_name = $site_names[$lang];
$home = "http://ranyuen.com{$link['base']}";
$switch_lang = [];
foreach ([
    'en' => 'English',
    'ja' => '日本語',
] as $k => $v) {
    $switch_lang[] =  $lang === $k ? $v : "<a href=\"{$link[$k]}\">$v</a>";
}
$switch_lang = implode(' / ', $switch_lang);
?>
<!DOCTYPE HTML>
<html lang="<?php $h->h($lang); ?>">
<head>
    <meta charset="UTF-8"/>
    <title><?php $h->h("$title - $site_name"); ?></title>
    <meta name="google-site-verification" content="osPpSihI4cWmpC3IfcU0MFq6zDdSPWyb7V2_ECHHo5Q"/>
    <meta name="msvalidate.01" content="C6AA98E0859490689AD2DDDC23486114"/>
<?php if (isset($description)) { ?>
    <meta name="description" content="<?php $h->h($description); ?>"/>
<?php } ?>
    <link rel="home" href="<?php $h->h($home); ?>"/>
    <link rel="author" href="https://plus.google.com/117493105665785554638?rel=author"/>
    <link rel="stylesheet" href="/assets/bower_components/normalize-css/normalize.css"/>
    <link rel="stylesheet" href="http://fonts.googleapis.com/css?family=Alef:400,700" type="text/css"/>
    <link rel="stylesheet" href="/assets/stylesheets/layout.css"/>
    <style>
    body, .header {
        background: url('<?php echo $bgimage; ?>') fixed;
    }
    </style>
</head>
<body>
    <div class="lang"><?php echo $switch_lang; ?></div>
    <div class="container">
        <div class="global_nav">
        <?php $h->echoNav($global_nav, $link['base']); ?>
        </div>
        <div class="header">
            <a rel="home" href="<?php $h->h($home); ?>" class="logo inactive" title="Ranyuen">
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
                <?php $h->echoNav($news_nav, "{$link['base']}/news/"); ?>
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
                <?php $h->echoBreadcrumb($breadcrumb, $link['base']); ?>
                </div>
                <div class="local_nav">
                <?php $h->echoNav($local_nav, './'); ?>
                </div>
                <article class="article"><?php $h->render($content, $__params); ?></article>
            </div>
        </div>
        <div class="footer">
            <div class="menu">
            <?php $h->echoNav($global_nav, $link['base']); ?>
            </div>
            <p class="copyright">Copyright (C) 2010-2014
            <a rel="home" href="<?php $h->h($home); ?>">Ranyuen</a> All Rights Reserved.<br/>
            Spring Calanthe (EBINE) and Ponerorchis (AWACHIDORI &amp; YUMECHIDORI)
            you see on our website are all bred, researched and developed in our
            <a rel="home" href="<?php $h->h($home); ?>">Ranyuen</a>&#39;s farm.</p>
        </div>
    </div>
    <script src="/assets/javascripts/messageForDeveloperFromRanyuen.js"></script>
    <script>
        (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
        (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
        m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
        })(window,document,'script','//www.google-analytics.com/analytics.js','ga');

        ga('create', 'UA-47871400-1', 'ranyuen.com');
        ga('send', 'pageview');
    </script>
</body>
</html>
