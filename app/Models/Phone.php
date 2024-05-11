<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Phone extends Model
{
    use HasFactory;
    protected $fillable = [ 'id', 'client_id','phone','category_id','created_id', 'updated_id'];
    public $timestamps = true;

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
