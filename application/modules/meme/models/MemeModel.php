<?php
namespace modules\meme\models;

use core\classTables\MemeBase;

class Meme
{
    public $pics;
    public function getBasePictures()
    {
        $pics = new MemeBase();
        $selected = $pics->selectPrepare();
        $pics = $selected->select('*')->fetchAll();


    }
}