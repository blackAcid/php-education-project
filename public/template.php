<!DOCTYPE html>
<html>
<head>
    <meta charset=utf-8>
    <title><?php echo $this->title;?></title>
    <link rel="stylesheet" type="text/css" href=<?php
    print "\"".HTTP_URL_PUB."css/bootstrap.css\""?>/>
    <link rel="stylesheet" type="text/css" href=<?php
    print "\"".HTTP_URL_PUB."css/main-style.css\"";?>/>
    <script type="text/javascript" src="<?php echo HTTP_URL_PUB . "js/jquery-1.10.2.min.js" ?>"></script>
    <script type="text/javascript" src="<?php echo HTTP_URL_PUB . "js/bootstrap.min.js" ?>"></script>
    <?php
      foreach($this->getCssFile() as $value)
      {
          print $value;
      }
     foreach($this->getJsFile() as $value)
      {
          print $value;
      }

    ;?>
</head>
<body>
<header>
    <nav class="navbar navbar-default col-md-8 col-md-offset-2 row" role="navigation">
        <a class="navbar-brand" href="#"><img alt="palette" src=<?="\"".HTTP_URL_PUB."images/palette.png\"";?>></a>
        <form id="search-form" class="navbar-form navbar-right form-inline" method="GET" action="<?= HTTP_URL_PUB; ?>search/search/result" role="search">
            <div class="form-group input-prepend">
                    <span class="glyphicon glyphicon-search"></span>
                    <input type="hidden" name="view" value="memes"/>
                    <input type="text" name="query" class="form-control input-sm" value="<?php if(isset($_GET['query'])){ echo htmlspecialchars($_GET['query']); }?>" placeholder="Введите текст...">
            </div>
            <input type="submit" class="btn btn-default btn-sm" value="Поиск"/>
        </form>
        <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
            <ul class="nav navbar-nav">
                <li><a href="#">Главная</a></li>
                <li><a href="<?=HTTP_URL_PUB."news/index/index"?>">Новости</a></li>
            </ul>
        </div>
    </nav>
</header>

<section class="content row col-md-8 col-md-offset-2">
    <?php if($this->addIntoTemplate()) require_once($this->include_file);?>
</section>
<footer class="col-md-8 col-md-offset-2 row">
    &copy; =)
</footer>
</body>
</html>

