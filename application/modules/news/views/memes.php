<?php
$action=$this->action;
?>
<script type="text/javascript">
    urlMemes='<?=BASE_URL."news/index/memes"?>'
    action='<?=$action?>'
    urlButtons='<?=BASE_URL."news/index/updateLikes"?>'
</script>
<header class="news">News</header>
<div class="news" id="news">
    <ul class="nav nav-tabs">
        <li><a href="<?=BASE_URL."news/index/index"?>">Последние</a></li>
        <li><a href="<?=BASE_URL."news/index/rating"?>">Лучшие</a></li>
    </ul>
    <?php
    //echo "action = ".$this->action."<br>";
    //include "ajax.php";
    for ($i=0; $i<count($this->memes); $i++) {
        echo "<div class=\"container\" id='container'>"
            ."<header>".$this->memes[$i]['name']."</header>"
            ."<img alt=\"memes\" src=".DIR_USERS.$this->memes[$i]['path']."\" class=\"img-thumbnail\"/>"
            ."<div class=\"likes_dislikes\" id='".$this->memes[$i]['id']."'>"
            /*."<form id='likes' action=\"".BASE_URL."news/index/like\" method=post></form>"
                ."<form id='dislikes' action=\"".BASE_URL."news/index/dislike\" method=post></form>"*/
            ."<button type='submit' form='likes' name='like' value=\"".$this->memes[$i]['id']."\">
        <img alt=\"like\" src=\"".BASE_URL."css/news/like1.jpg\" height=\"20\"/></button>"
            ."<button type='submit' form='dislikes' name='dislike' value=\"".$this->memes[$i]['id']."\">
        <img alt=\"dislike\" src=\"".BASE_URL."css/news/dislike1.jpg\" height=\"20\"/></button>";
        $date=strtotime($this->memes[$i]['date_create']);
        print "</div><div class=\"row-fluid\"><div class=\"date\">Опубликовано ".date('j.m.y', $date)." в "
            .date('H:i')." by ".$this->memes[$i]['username']."</div><div class=\"rating\" id='".$this->memes[$i]['id']."'><span class=\"dislikes\">-"
            .$this->memes[$i]['dislikes']."</span>
        <span class=\"likes\">+".$this->memes[$i]['likes']."</span></div></div>"
            ."</div>";
    }
    echo "<div class='nextMeme'><div>";
    //var_dump($this->memes);
    //echo "Session userID = ".$_SESSION['userID'];
    ?>
</div>