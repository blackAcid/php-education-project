<div class="user-change col-md-12">
    <form enctype="multipart/form-data" action="change" method="POST">
        <input type="hidden" name="MAX_FILE_SIZE" value="200000" />
        <ul class="change-data">
            <li>
                <div class="avatar">
                    Ваш Аватар: <img src="<?php echo '/images/user_avatars/'.$this->avatar['avatar']; ?>" class="avatar">
                </div>
                <div class="change-avatar">
                    Выбрать новый Аватар: <input name="userfile" type="file" />
                </div>
            </li>
            <li>
                <div class="actual-login">
                    Ваше Имя: <h3><?php echo $this->username['username']; ?></h3>
                </div>
                <div class="change-login">
                    Новое Имя: <input name="name" type="text" class="form-control" placeholder="Имя" />
                </div>
            </li>
            <li>
                <div class="actual-email">
                    Ваш E-mail: <h3><?php echo $this->email['email']; ?></h3>
                </div>
                <div class="change-email">
                    Новый E-mail: <input name="email" type="text" class="form-control" placeholder="e-mail" />
                </div>
            </li>
            <li>
                <div class="change-password">
                    Введите новый пароль: <input name="password" type="password" class="form-control" placeholder="New Password"></br>
                    Повторите пароль: <input name="password-repeat" type="password" class="form-control" placeholder="Repeat Password">
                </div>
            </li>
            <input type="submit" value="Изменить" class="btn btn-default" name="user" />
        </ul>
    </form>
</div>