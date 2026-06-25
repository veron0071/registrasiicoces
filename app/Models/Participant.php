<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Participant extends Model
{
    use HasFactory;

    protected $fillable = [
        'full_name',
        'institution',
        'country',
        'email',
        'phone',
        'cohost',
        'category',
        'participant_origin',
        'paper_title',
        'fee_amount',
        'fee_currency',
        'payment_proof',
        'payment_status',
        'certificate_eligible',
    ];
}
