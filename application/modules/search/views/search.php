<div class="wrapper">
    <ul class="nav nav-tabs">
        <li class="active"><a href="#">Публикации</a></li>
        <li><a href="#">Пользователи</a></li>
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
                <h4 class="list-group-item-heading"><?php echo $row['name'];?></h4>
                <p class="list-group-item-text"><?php echo $row['path'];?></p>
            </a>
            <?php endforeach;?>
        </div>
        <?php endif;?>
    </div>
</div>