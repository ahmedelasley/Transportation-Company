<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Vehicle extends Model
{
    use HasFactory;
    protected $fillable = [ 'id', 'name','category_id','status_id','created_id', 'updated_id'];
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
     * Method category
     *
     * @return void
     */
    public function category()
    {
        return $this->belongsTo(Category::class);
    }
    
    
    /**
     * Method status
     *
     * @return void
     */
    public function status()
    {
        return $this->belongsTo(Status::class);
    }
}
