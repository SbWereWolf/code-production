<?php

namespace App\CardPr\Table;

use Illuminate\Database\Eloquent\Model;

class Message extends Model
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
    protected $table = 'message';
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        "content",
        "author",
        "created_at",
    ];
}
