<?php
namespace modules\search\model;

use core\classTables\Users;
use core\classTables\Memes;

class SearchModel
{
    private $query = '';
    private $view = '';
    public $result = array();
    public function __construct($query, $view)
    {
        $this->query = $query;
        $this->view = $view;
    }
    public function search()
    {
        switch ($this->view) {
            case 'users':
                $table = new Users();
                break;
            case 'memes':
                $table = new Memes();
                $select = $table->selectPrepare();
                $this->result = $select->selectColumns(
                    ['memes.id', 'memes.name', 'memes.path', 'memes.date_create', 'memes.user_id', 'users.username']
                )->
                    join('', 'users', 'user_id', 'id')->where(['`name` LIKE' => '%' . $this->query . '%'])->order(
                        'date_create',
                        'DESC'
                    )->fetchAll(null);
                break;
            default:
                $table = new Users();
                break;
        }
    }

} 