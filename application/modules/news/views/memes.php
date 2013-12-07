<h2>Home page</h2>
<br>
<div class="news">
<?php
//$memesPath=$this->memesPath;
//$strPath="";
for ($i=0;$i<count($this->memes);$i++) {
    echo "<div class=\"container\">";
    print "<header>".$this->memes[$i]['name']."</header>";
    print "<img src=".DIR_USERS.$this->memes[$i]['path']."\" class=\"img-thumbnail\">";
    print "<div class=\"likes_dislikes\">";
    print "<a href=\"#\"><img src=".DIR_CSS."css/news/dislike.gif\" height=\"33px\"/></a>\t"
        ."<a href=\"#\"><img src=".DIR_CSS."css/news/like.gif\" height=\"37px\"/></a>";
    print "</div><div class=\"row-fluid\"><div class=\"date\">".$this->memes[$i]['date_create']
        ."</div><div class=\"rating\"><span id=\"dislikes\">-".$this->memes[$i]['dislikes']."</span>
        <span id=\"likes\">+".$this->memes[$i]['likes']."</span></div></div>";
    echo "</div>";

}
//var_dump($this->memesDate);?>
    <ul class="pager">
        <li class="previous"><a href="#">&larr; Previous</a></li>
        <li class="next"><a href="#">Next &rarr;</a></li>
    </ul>
</div>