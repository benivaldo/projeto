<?php 

namespace App;

use Illuminate\Database\Eloquent\Model;

final class Candidato extends Model
{
    public $rules = [
        'nome' => 'required',
        'email' => 'required',
    ];
}