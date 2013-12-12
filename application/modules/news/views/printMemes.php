<?php
for ($i=0; $i<count($memes); $i++) {
echo "<div class='container' id='container'>"
    ."<header>".$memes[$i]['name']."</header>"
    ."<img alt='memes' src=".DIR_USERS.$memes[$i]['path']."\" class='img-thumbnail'/>"
    ."<div class='likes_dislikes'>"
        /*."<form id='likes' action=\"".HTTP_URL_PUB."news/index/like\" method=post></form>"
        ."<form id='dislikes' action=\"".HTTP_URL_PUB."news/index/dislike\" method=post></form>"*/
        ."<button type='submit' form='likes' name='like' value='".$memes[$i]['id']."'>
            <img alt='like' src='".HTTP_URL_PUB."css/news/like1.jpg' height='20'/></button>"
        ."<button type='submit' form='dislikes' name='dislike' value='".$memes[$i]['id']."'>
            <img alt='dislike' src='".HTTP_URL_PUB."css/news/dislike1.jpg' height='20'/></button>";
        $date=strtotime($memes[$i]['date_create']);
        print "</div><div class='row-fluid'><div class='date'>Опубликовано ".date('j.m.y', $date)." в "
            .date('H:i')." by ".$memes[$i]['username']."</div><div class='rating' id='".$memes[$i]['id']."'><span class=\"dislikes\">-"
        .$memes[$i]['dislikes']."</span>
            <span class='likes'>+".$memes[$i]['likes']."</span></div></div>"
    ."</div>";
}
echo "<div id='nextMeme'><div>";
?>
