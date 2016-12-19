<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class NiceActionLog extends Model
{
//    Define our relation

    public function nice_action() {
        return $this->belongsTo('App\NiceAction');
    }
}
