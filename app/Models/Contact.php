<?php

namespace App\Models;

use App\ModelTraits\EncryptableTrait;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Contact extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable =
    [
        'cell_phone',
        'whatsapp',
        'email',
        'preffered_contact_method',
        'learner_id'
    ];

    protected $guarded = [];

    /**
     * The attributes that are encrypted by the encryptable trait
     * 
     * @var array
     */
    //protected $encryptable = ['cell_phone', 'whatsapp', 'email'];
}
