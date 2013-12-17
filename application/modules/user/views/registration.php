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

<form id="reg_form" method="post" action="/user/user/registration">
    <p id="global_error_message_container" class="message_container">
        <span id="global_error_message"></span>
    </p>

    <p>
    <p>Логин*</p>

    <p><input class='username' name='username' id="username" type="text"/></p>
      <span id="username_message_container" class="message_container">
             <span id="username_message"><?php echo $this->username_message ?></span>
      </span>
    </p>
    <p>

    <p>Пароль*</p>

    <p><input class='password_1' name="password_1" id="password_1" type="password"/></p>
         <span id="password_1_message_container" class="message_container">
           <span id="password_1_message"><?php echo $this->password_1_message ?></span>
       </span>
    </p>
    <p>

    <p>Повторите пароль*</p>

    <p><input class='password_2' name="password_2" id="password_2" type="text"/></p>
        <span id="password_2_message_container" class="message_container">
             <span id="password_2_message"><?php echo $this->password_2_message ?></span>
        </span>
    </p>
    <p>

    <p>Еmail*</p>

    <p><input class='email' name="email" type="text" id="email"/></p>
        <span id="email_message_container" class="message_container">
               <span id="email_message"><?php echo $this->email_message ?></span>
        </span>
    </p>
    <p>

    <p>Дата рождения (dd/mm/yyyy)*</p>

    <p><input class='date_of_birthday' name='date_of_birthday' id="date_of_birthday" type="text"/>

    <p>
     <span id="date_of_birthday_message_container" class="message_container">
           <span id="date_of_birthday_message"><?php echo $this->date_of_birthday_message ?></span>
     </span>
    </p>

    <p>

    <p>Аватар:</p>

    <p><input class='country' name='country' id="country" type="text"/></p>
    <span id="country_message_container" class="message_container">
           <span id="country_message"></span>
     </span>
    </p>

    <p>
        <input type=submit  name="send" class="send" id="send"  value="Отправить">
    </p>
</form>
<div id="results"></div>

