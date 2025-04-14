<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Asset;
use App\Models\User;

class Assignment extends Model
{
    use HasFactory;

    protected $fillable = [
        'asset_id',
        'technician_id',
        'fixed_at',
        'approved_by_admin',
    ];

    protected $casts = [
        'fixed_at' => 'datetime',
        'approved_by_admin' => 'boolean',
    ];

    public function asset()
    {
        return $this->belongsTo(Asset::class);
    }

    public function technician()
    {
        return $this->belongsTo(User::class, 'technician_id');
    }

    public function isFixed()
    {
        return $this->fixed_at !== null;
    }

    public function isApproved()
    {
        return $this->approved_by_admin;
    }

    public function getStatusAttribute()
    {
        if ($this->isApproved()) {
            return 'approved';
        }
        if ($this->isFixed()) {
            return 'fixed';
        }
        return 'pending';
    }
}
