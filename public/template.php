<!DOCTYPE html>
<html>
<head>
    <meta charset=utf-8>
    <title><?php echo $this->title;?></title>
    <script type="text/javascript" src="http://code.jquery.com/jquery-1.10.2.min.js"></script>
    <!-- Latest compiled and minified CSS -->
    <link rel="stylesheet" href="//netdna.bootstrapcdn.com/bootstrap/3.0.3/css/bootstrap.min.css">

    <!-- Optional theme -->
    <link rel="stylesheet" href="//netdna.bootstrapcdn.com/bootstrap/3.0.3/css/bootstrap-theme.min.css">

    <!-- Latest compiled and minified JavaScript -->
    <script src="//netdna.bootstrapcdn.com/bootstrap/3.0.3/js/bootstrap.min.js"></script>
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
        <a class="navbar-brand" href="#"><img src="images/palette.png"></a>
        <form class="navbar-form navbar-right" role="search">
            <div class="form-group">
                <input type="text" class="form-control input-sm"><span class="glyphicon glyphicon-search"></span>
            </div>
        </form>
        <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
            <ul class="nav navbar-nav">
                <li><a href="#">Главная</a></li>
                <li><a href="#">Новости</a></li>
            </ul>
        </div>
    </nav>


</header>


<section class="content row col-md-8 col-md-offset-2">
    <p>
        <a href="/user/user/signin">Вход</a>
        <a href="/user/user/registration">Регистрация</a>
    </p>
    <?php if($this->addIntoTemplate()) require_once($this->include_file);?>
</section>
<footer class="col-md-8 col-md-offset-2 row">
    &copy; =)
</footer>
</body>
</html>

