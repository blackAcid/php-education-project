<!DOCTYPE html>
<html>
<head>
    <meta charset=utf-8>
    <title><?php echo $this->title;?></title>
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
    <h1>header</h1>
</header>

<section>
    <?php if($this->addIntoTemplate()) require_once($this->include_file);?>
</section>
<footer>
    <h1>footer</h1>
</footer>
</body>
</html>

