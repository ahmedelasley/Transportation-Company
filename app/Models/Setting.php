<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Setting extends Model
{
    use HasFactory;
    protected $fillable = [
        'key',
        'value',
        'created_id',
        'updated_id',
    ];
    public $timestamps = true;

    /**
     * Method user
     *
     * @return void
     */
    public function createdBy()
    {
        return $this->belongsTo(User::class, 'created_id');
    }
    
    /**
     * Method updatedBy
     *
     * @return void
     */
    public function updatedBy()
    {
        return $this->belongsTo(User::class, 'updated_id');
    }
}
