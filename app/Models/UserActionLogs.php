<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserActionLogs extends Model
{
    use HasFactory;
    protected $table = 'user_logs';

    protected $fillable = [
        'user_id',
        'user_email',
        'action',
        'action_model',
        'action_model_id'
    ];

    public function user(){

        return $this->belongsTo(User::class);

    }
}
