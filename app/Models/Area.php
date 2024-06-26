<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Area extends Model
{
    use HasFactory;
    protected $fillable = [ 'id', 'name','description','parent_id','created_id', 'updated_id'];
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
      
    /**
     * Method children
     *
     * @return void
     */
    public function children()
    {
        return $this->hasMany(Area::class, 'parent_id');
    }
    
    /**
     * Method parent
     *
     * @return void
     */
    public function parent()
    {
        return $this->belongsTo(Area::class, 'parent_id');
    }
}
