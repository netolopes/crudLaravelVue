<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Refrigerante extends Model
{
    protected $table = 'refrigerantes';
    protected $guarded = ['id'];
    protected $fillable=['marca','tipo','sabor','litragem','valor_unidade','quantidade'];
    public $timestamps = false;
  
   
}
