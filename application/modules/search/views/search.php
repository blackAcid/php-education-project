<div class="wrapper">
    <ul class="nav nav-tabs">
        <li <?php if($this->view == 'memes') { echo 'class="active"';} ?>>
            <a href="<?php echo $this->memes_tab; ?>">Публикации</a>
        </li>
        <li <?php if($this->view == 'users') { echo 'class="active"';} ?>>
            <a href="<?php echo $this->users_tab; ?>">Пользователи</a>
        </li>
    </ul>
    <div class="search-results">
        <?php if($this->errors):?>
        <?php foreach($this->errors as $error):?>
        <div class="alert alert-danger"><?php echo $error;?></div>
        <?php endforeach;?>
        <?php else:?>
        <div class="list-group">
            <?php foreach($this->data as $row):?>
            <a href="#" class="list-group-item">
                <p class="lead"><strong class="label label-info">Мем</strong></p>
                <div class="pull-left picture">
                    <?php //todo: Сменить путь изображения ?>
                    <img class="img-responsive" alt="mem" src="<?php echo $row['path'];?>"/>
                </div>
                <h4 class="list-group-item-heading">Название: <?php echo $row['name'];?></h4>
                <p class="list-group-item-text">Автор: <?php echo $row['username'];?></p>
            </a>
            <?php endforeach;?>
        </div>
        <?php endif;?>
    </div>
</div>