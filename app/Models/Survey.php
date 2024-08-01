<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Survey extends Model
{
    use HasFactory;
    protected $fillable = ['id','title', 'status'];

    /**
     * Get the questions for the survey.
     */
    public function questions()
    {
        return $this->hasMany(Question::class);
    }
}
