<style type="text/css">
    #reg_form {
        font-family: Verdana, sans-serif;
        font-size: 14px;
        background-color: #FFFFE0;
    }

    .message_container {
        display: none;
        font-weight: bold;
        color: red;
    }
</style>
<!-- Modal -->
<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                <h4 class="modal-title" id="myModalLabel">Регистрация</h4>
            </div>
            <div class="modal-body">
                <form id="reg_form" method="POST" action="/user/user/registration" accept-charset="UTF-8">
                    <p id="global_error_message_container" class="message_container">
                        <span id="global_error_message"></span>
                        <?php echo $this->global_message ?>
                    </p>
                    <div class="row">
                        <div class="form-group col-xs-6">
                            <input class='username form-control' name='username' id="username" type="text"
                                   placeholder="Логин">
                              <span id="username_message_container" class="message_container">
                                  <span id="username_message"><?php echo $this->username_message ?></span>
                              </span>
                        </div>
                    </div>
                    <div class="row">
                        <div class="form-group col-xs-6">
                            <input class='password_1 form-control' name="password_1" id="password_1" type="password"
                                   placeholder="Пароль">
                            <span id="password_1_message_container" class="message_container">
                                 <span id="password_1_message"><?php echo $this->password_1_message ?></span>
                           </span>
                        </div>
                    </div>
                    <div class="row">
                        <div class="form-group col-xs-6">
                            <input class='password_2 form-control' name="password_2" id="password_2" type="password"
                                   placeholder="Повторите пароль">
                            <span id="password_2_message_container" class="message_container">
                                 <span id="password_2_message"><?php echo $this->password_2_message ?></span>
                            </span>
                        </div>
                    </div>
                    <div class="row">
                        <div class="form-group col-xs-6">
                            <input class='email form-control' name="email" type="text" id="email" placeholder="Email">
                            <span id="email_message_container" class="message_container">
                                 <span id="email_message"><?php echo $this->email_message ?></span>
                            </span>
                        </div>
                    </div>
                    <div class="row">
                        <div class="form-group col-xs-6">
                            <input class='date_of_birthday form-control' name='date_of_birthday' id="date_of_birthday"
                                   type="text"
                                   placeholder="Дата рождения">
                            <span id="date_of_birthday_message_container" class="message_container">
                                  <span id="date_of_birthday_message"><?php echo $this->date_of_birthday_message ?></span>
                            </span>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="send btn btn-default" data-dismiss="modal">отмена</button>
                        <button type="submit" class="send btn btn-primary" name="send" id="send">ок</button>
                    </div>
                </form>
            </div>
        </div>
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>
<!-- /.modal -->


<div class="container">
    <div class="row">
        <div class="span4 offset4 well col-xs-4">
            <legend>Please Sign In</legend>
            <div class="alert alert-error">
                <a class="close" data-dismiss="alert" href="#">×</a>Incorrect Username or Password!
            </div>
            <form method="POST" action="" accept-charset="UTF-8">
                <div class="form-group">
                    <input type="email" class="form-control" id="exampleInputEmail1" placeholder="логин">
                </div>
                <div class="form-group">
                    <input type="email" class="form-control" id="exampleInputEmail1" placeholder="пароль">
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-info">Вход</button>
                    <button type="submit" class="btn btn-info " data-toggle="modal" data-target="#myModal">
                        Регистрация
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>