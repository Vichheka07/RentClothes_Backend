<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Post;
use App\Models\User;

class Profile extends Model
{
    use HasFactory;
    protected $fillable = [
        'file_name',
        'user_id',
        'name',
    ];
    public function user(){
        return $this->belongsTo(User::class);
    }
}