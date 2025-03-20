<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class UserVerify extends Model
{
    use HasFactory;
    protected $table = 'password_reset_tokens';
    protected $fillable = ['email', 'token'];
    const UPDATED_AT = null;
}
