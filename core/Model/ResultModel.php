<?php

namespace Core\Model;

use Illuminate\Database\Eloquent\Model;

class ResultModel extends Model
{
    protected $table = 'results';

    protected $fillable = ['id', 'dose', 'unit_dose', 'voltage', 'unit_voltage', 'date_of_measurement'];

    public $timestamps = false;
}