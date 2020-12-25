<?php

namespace app\common\model;
use app\common\model\TimeModel;

class FinaceWithdrawalrecord extends TimeModel
{
    public function member()
    {
        return $this->belongsTo('app\common\model\Member', 'uid', 'id');
    }
}
