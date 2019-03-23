<?php

namespace Core\Model;

use Illuminate\Database\Eloquent\Model;

class CuriosityModel extends Model
{
    protected $table = 'curiosities';

    protected $fillable = ['id', 'text'];

    public $timestamps = false;
}