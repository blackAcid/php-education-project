<!DOCTYPE html>
<html>
<head>
    <meta charset=utf-8>
    <title><?php echo Config::getProperty('title', 'title'); ?></title>
</head>
<body>
<header>
    <h1>Hello World</h1>
</header>

<section>
    <?php require_once DIR_MOD.$module.'/views/'.$content;?></br>
</section>
<footer>

</footer>
</body>
</html>

