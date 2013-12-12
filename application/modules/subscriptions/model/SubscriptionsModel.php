<?php
namespace modules\subscriptions\model;

use core\classTables\Roles;
use core\classTables\Subscription;
use core\classTables\Users;

class SubscriptionsModel
{
    public $userId;
    public $userName;
    public $avatar;
    public $targetId;
    public $status;

    public function __construct($userId)
    {
        $this->userId = $userId;
    }
        public function showSubscriptions()
    {
        $selectSubscriptions = new Subscription();
        $selObjSubscriptions = $selectSubscriptions->selectPrepare();

        $result = $selObjSubscriptions->where(['user_id=' => "$this->userId", ' and status=' => '1'])
            ->selectColumns(['target_id'])->fetchAll(null);
        //var_dump($result);
        for ($i = 0; $i < count($result); $i++) {
            foreach ($result as $value) {
                /*$this->targetId = $value['target_id'];
                $selectUser = new Users();
                $selObjUser = $selectUser->selectPrepare();
                $this->userName = $selObjUser->where(['id=' => "$this->targetId"])->selectColumns(['userName'])->fetchAll(null);
                $this->avatar = $selObjUser->where(['id=' => "$this->targetId"])->selectColumns(['avatar'])->fetchAll(null);
                return $this->userName;*/
            }
            return $i;
        }

    }
    }
