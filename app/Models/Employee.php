<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Employee extends Model
{
    use HasFactory;
    protected $table = '_employees';
    protected $primaryKey = 'employee_id';

    // Define a relationship with the Company model
    public function company()
    {
        return $this->belongsTo(Company::class, 'comp_id');
    }
}
