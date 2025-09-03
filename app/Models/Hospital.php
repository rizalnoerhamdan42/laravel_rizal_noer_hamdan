<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Model;

class Hospital extends Model
{
    protected $fillable = ['hospital_code','name','address','email','phone'];

    public function patients()
    {
        return $this->hasMany(Patient::class);
    }
}