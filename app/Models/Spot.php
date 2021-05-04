<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Spot extends Model
{
    use HasFactory;

    // 1.用户模型关联表
    public $table = 'spots';

    // 2.关联表的主键
    public $primarKey = 'id';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'locale_name',
        'city_name',
        'spot_name',
        'content',
        'spot_img',
        'pid',
        'level'
    ];
}
