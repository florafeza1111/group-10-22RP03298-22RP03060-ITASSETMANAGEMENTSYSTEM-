<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Assignment;
use App\Models\User;

class Asset extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'category',
        'description',
        'defect_description',
        'status',
    ];

    public function assignment()
    {
        return $this->hasOne(Assignment::class);
    }

    public function technician()
    {
        return $this->hasOneThrough(User::class, Assignment::class, 'asset_id', 'id', 'id', 'technician_id');
    }

    public function isAssigned()
    {
        return $this->status === 'assigned';
    }

    public function isFixed()
    {
        return $this->status === 'fixed';
    }

    public function isApproved()
    {
        return $this->status === 'approved';
    }
}
