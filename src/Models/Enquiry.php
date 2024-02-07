<?php

namespace Hup234design\FilamentCms\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Enquiry extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'name', 'email', 'telephone', 'subject', 'message', 'referral', 'referral_other', 'ip_address', 'spam'
    ];

    protected $casts = [
        'spam' => 'boolean',
    ];

}
