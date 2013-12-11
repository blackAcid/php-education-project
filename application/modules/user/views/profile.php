<div class="user-profile row col-md-12">
    <div class="profile-info col-md-3">
        <div class="avatar">
            <img src="<?php echo '/images/user_avatars/'.$this->avatar['avatar']; ?>" class="avatar">
        </div>
        <div class="profile-navigation">
            <ul class="user-info">
                <li><?php echo $this->username['username']; ?></li>
                <li><?php echo $this->date_of_birth['date_of_birth']; ?></li>
                <li><a href="change"><button type="button" class="btn btn-default">Редактировать Профиль</button></a></li>
            </ul>

            <ul class="navigation">
                <li><button type="button" class="btn btn-default"><a href="#">Создать Мем</a></button></li>
                <li><button type="button" class="btn btn-default"><a href="#">Друзья</a></button></li>
                <li><button type="button" class="btn btn-default"><a href="#">Новости</a></button></li>
                <li><button type="button" class="btn btn-default"><a href="#">Подписки</a></button></li>
            </ul>
        </div>
    </div>
    <div class="profile-content col-md-9">
        <?php for($i = 0; $this->MemesNumber > $i; $i++)
        {
            echo '<div class="meme-zone"><img src="'.$this->paths_to_my_memes[$i]['path'].'" class="meme"></div>';
        } ?>
    </div>
</div>