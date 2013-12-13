<?php
namespace modules\subscriptions\model;

use core\classTables\Roles;
use core\classTables\Subscription;
use core\classTables\Users;

class SubscriptionsModel
{
    public $userId;
    public $dataSubscriptions;
    public $targetId;

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
        count($result);
        for ($i = 0; $i < count($result); $i++) {
            $this->targetId = $result[$i]['target_id'];
            $selectUser = new Users();
            $selObjUser = $selectUser->selectPrepare();
            $this->dataSubscriptions[$i] = $selObjUser->where(['id=' => "$this->targetId"])->selectColumns(['username', 'avatar', 'date_update'])->fetchAll(null);
        }
        return $this->dataSubscriptions;
    }

    public function subscribeFromUser($targetId)
    {
        $this->targetId = $targetId;
        $updateSubscriptions = new Subscription();
        $updateSubscriptions->update(['status' => '1'], 'target_id=? and user_id=?', [$this->targetId, $this->userId]);
    }

    public function unsubscribeFromUser($targetId)
    {
        $this->targetId = $targetId;
        $updateSubscriptions = new Subscription();
        $updateSubscriptions->update(['status' => '0'], 'target_id=? and user_id=?', [$this->targetId, $this->userId]);
    }

}
