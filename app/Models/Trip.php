<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Trip extends Model
{
    use HasFactory;
    protected $fillable = [ 
        'id', 
        'code',
        'from_area',
        'to_area', 
        'client_id', 
        'driver_id',
        'driver_fee',
        'client_price',
        'loan',
        'discount',
        'carrier_name',
        'status',
        'category_id',
        'notes',
        'date', 
        'created_id', 
        'updated_id',
        'deleted_id',
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
          
    /**
     * Method deletedBy
     *
     * @return void
     */
    public function deletedBy()
    {
        return $this->belongsTo(User::class, 'deleted_id');
    }
      
        
    /**
     * Method client
     *
     * @return void
     */
    public function client()
    {
        return $this->belongsTo(Client::class);
    }
    
    /**
     * Method company
     *
     * @return void
     */
    public function driver()
    {
        return $this->belongsTo(Driver::class);
    }
    
    /**
     * Method fromArea
     *
     * @return void
     */
    public function fromArea()
    {
        return $this->belongsTo(Area::class, 'from_area');
    }
    
    /**
     * Method toArea
     *
     * @return void
     */
    public function toArea()
    {
        return $this->belongsTo(Area::class, 'to_area');
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
    
    
}
