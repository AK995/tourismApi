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
    public $primarKey = 'spot_id';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'locale_name',
        'spot_name',
        'avatar',
        'level',
        'intro',
        'ticket_info',
        'favor_policy',
        'open_time',
        'tips',
        'trans',
        'pics'
    ];

    // 强制转换的属性
    protected $casts = [
        'pics' => 'array',
    ];

    protected $resultSetType = 'collection';
}
