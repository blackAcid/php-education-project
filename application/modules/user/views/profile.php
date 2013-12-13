<div class="user-profile row col-md-12">
    <div class="profile-info col-md-3">
        <div class="avatar">
            <img src="<?php echo '/images/user_avatars/'.$this->avatar; ?>" class="avatar">
        </div>
        <div class="profile-navigation">
            <ul class="user-info">
                <li><?php echo $this->username; ?></li>
                <li><?php echo $this->date_of_birth; ?></li>
                <li><a href="change"><button type="button" class="btn btn-default">Редактировать Профиль</button></a></li>
            </ul>

            <ul class="navigation">
                <li><a href="/meme/meme/create"><button type="button" class="btn btn-default">Создать Мем</button></a></li>
                <li><a href="news/index/index"><button type="button" class="btn btn-default">Новости</button></a></li>
                <li><a href="#"><button type="button" class="btn btn-default">Подписки</button></a></li>
            </ul>
        </div>
    </div>
    <div class="profile-content col-md-9">
        <?php for($i = 0; $this->MemesNumber > $i; $i++)
        {
            echo '<div class="meme-zone"><header><a href="/meme/meme/view?id=' . $this->paths_to_my_memes[$i]['id']
                .'">' . $this->paths_to_my_memes[$i]['name'] . '</a></header><img src="'.
                BASE_URL.$this->paths_to_my_memes[$i]['path'].'" class="meme"><footer>//комменты/лайки</footer></div>';
        } ?>
    </div>
</div>