<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PlayerOverview extends Model
{
    protected $table = 'player_overview';
    protected $primaryKey = "player_id";
    public $timestamps = false;

    public function rankings(){
        return $this->hasMany('App\Rankings');
    }
}
