<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class bruise extends Model
{
    use HasFactory;

    //　テーブル名
    protected $table = 'bruises';

    //　可変項目
    protected $fillable = [
        'userid',
        'target',
        'age',
        'sex',
        'hasseiyy',
        'hasseimm',
        'hasseidd',
        'hasseihh',
        'hasseimi',
        'factor',
        'element',
        'targetfile',
        'note',
        'image1',
        'oimagename1',
        'takeymd1',
        'image2',
        'oimagename2',
        'takeymd2',
    ];
}
