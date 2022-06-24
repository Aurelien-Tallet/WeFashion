<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Picture extends Model
{
    use HasFactory;
    protected $fillable = [
        'name',
    ];

    public function name() {
        return $this->name;
    }
    public function id(){
        return $this->id;
    }
}
