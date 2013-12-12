<?php
$action=$this->action;
?>
<script type="text/javascript">
    urlMemes='<?=HTTP_URL_PUB."news/index/memes"?>'
    action='<?=$action?>'
    urlButtons='<?=HTTP_URL_PUB."news/index/updateLikes"?>'
</script>
<header class="news">News</header>
<div class="news" id="news">
    <ul class="nav nav-tabs">
        <li><a href="<?=HTTP_URL_PUB."news/index/index"?>">Последние</a></li>
        <li><a href="<?=HTTP_URL_PUB."news/index/rating"?>">Лучшие</a></li>
    </ul>
<?php
//echo "action = ".$this->action."<br>";
//include "ajax.php";
for ($i=0; $i<count($this->memes); $i++) {
    echo "<div class=\"container\" id='container'>"
        ."<header>".$this->memes[$i]['name']."</header>"
    ."<img alt=\"memes\" src=".DIR_USERS.$this->memes[$i]['path']."\" class=\"img-thumbnail\"/>"
    ."<div class=\"likes_dislikes\">"
    /*."<form id='likes' action=\"".HTTP_URL_PUB."news/index/like\" method=post></form>"
        ."<form id='dislikes' action=\"".HTTP_URL_PUB."news/index/dislike\" method=post></form>"*/
    ."<button type='submit' form='likes' name='like' value=\"".$this->memes[$i]['id']."\">
        <img alt=\"like\" src=\"".HTTP_URL_PUB."css/news/like1.jpg\" height=\"20\"/></button>"
    ."<button type='submit' form='dislikes' name='dislike' value=\"".$this->memes[$i]['id']."\">
        <img alt=\"dislike\" src=\"".HTTP_URL_PUB."css/news/dislike1.jpg\" height=\"20\"/></button>";
    $date=strtotime($this->memes[$i]['date_create']);
    print "</div><div class=\"row-fluid\"><div class=\"date\">Опубликовано ".date('j.m.y', $date)." в "
        .date('H:i')." by ".$this->memes[$i]['username']."</div><div class=\"rating\" id='".$this->memes[$i]['id']."'><span class=\"dislikes\">-"
        .$this->memes[$i]['dislikes']."</span>
        <span class=\"likes\">+".$this->memes[$i]['likes']."</span></div></div>"
    ."</div>";
}
echo "<div id='nextMeme'><div>";
//var_dump($this->memes);
//echo "Session userID = ".$_SESSION['userID'];
?>
</div>