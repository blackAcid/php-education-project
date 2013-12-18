<?php
/**
 * Created by PhpStorm.
 * User: anna
 * Date: 18.12.13
 * Time: 19:23
 */
use modules\news\model\NewsModel;

require_once ("/var/www/php-education-project/public/bootstart.php");
class NewsModelTest extends PHPUnit_Framework_TestCase
{
    public function testGetMemes()
    {
        $this->assertNotNull(NewsModel::getMemes(2));
        //$this->assertType('array',NewsModel::getMemes(2));
    }
}
