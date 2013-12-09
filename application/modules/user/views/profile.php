<div class="user-profile row col-md-12">
    <div class="profile-info col-md-3">
        <div class="avatar">
            <img src="<?php echo '/images/user_avatars/'.$this->avatar['avatar']; ?>" class="avatar">
        </div>
        <div class="profile-navigation">
            <ul class="user-info">
                <li><a href="#"><?php echo $this->login['login']; ?></a></li>
                <li><a href="#"><?php echo $this->date_of_birth['date_of_birth']; ?></a></li>
            </ul>

            <ul class="navigation">
                <li><a href="#">News</a></li>
                <li><a href="#">Friends</a></li>
            </ul>
        </div>
    </div>
    <div class="profile-content col-md-9">
        <?php for($i = 0; $this->MemesNumber > $i; $i++)
        {
            echo '<img src="'.$this->paths_to_my_memes[$i]['path'].'" class="meme"></br>';
        } ?>
    </div>
</div>