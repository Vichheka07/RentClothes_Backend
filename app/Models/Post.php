<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\User;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;

class Post extends Model implements HasMedia
{
    use HasFactory, InteractsWithMedia;

    protected $fillable = [
        'user_id',
        'title',
        'describe',
        'price',
        'orgprice',
        'day',
        'category',
        'codition',
        'size',
        'delivery'
    ];
    public function user(){
        return $this->belongsTo(User::class);
    }
}
