<?php

namespace App\CardPr\Table;

use Illuminate\Database\Eloquent\Model;

class Obtain extends Model
{
    /**
     * Indicates if the model should be timestamped.
     *
     * @var bool
     */
    public $timestamps = false;
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'obtain';
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        "obtain_at",
    ];
}
