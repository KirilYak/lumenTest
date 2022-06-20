<?php

namespace App\Services\User\Entity;

use Illuminate\Database\Eloquent\Model;

class CompanyModel extends Model
{
    protected $table = 'companies';
    /**
     * The attributes that are mass assignable.
     *
     * @var string[]
     */
    protected $fillable = [
        'userId', 'title', 'phone', 'description',
    ];
}
