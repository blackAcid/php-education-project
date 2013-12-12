<div class="user-change col-md-12">
    <form enctype="multipart/form-data" action="change" method="POST">
        <input type="hidden" name="MAX_FILE_SIZE" value="200000" />
        <ul class="change-data">
            <li>
                <div class="change-avatar">
                    Выбрать новый Аватар: <input name="userfile" type="file" />
                </div>
            </li>
            <li>
                <div class="change-login">
                    Новое Имя: <input name="name" type="text" class="form-control" placeholder="Имя" />
                </div>
            </li>
            <li>
                <div class="change-email">
                    Новый E-mail: <input name="email" type="text" class="form-control" placeholder="e-mail" />
                </div>
            </li>
            <input type="submit" value="Изменить" class="btn btn-default" name="user" />
        </ul>
    </form>
</div>