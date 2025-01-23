<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Task extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'title',
        'task_description',
        'priority',
        'due_date',
        'status',
    ];
    protected $casts = [
        'due_date' => 'datetime', // Cast 'due_date' to a Carbon instance
    ];

    /**
     * Define the relationship with the User model.
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }
    public function activities()
{
    return $this->hasMany(Activity::class);
}

}

