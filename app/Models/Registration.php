<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Support\Str;

class Registration extends Model
{
    protected $fillable = [
        'course_id',
        'full_name',
        'dni',
        'email',
        'phone',
        'status',
        'lookup_token',
        'certificate_code',
        'certificate_issued_at',
    ];

    protected $casts = [
        'certificate_issued_at' => 'datetime',
    ];

    protected static function booted(): void
    {
        static::saving(function (Registration $registration): void {
            if (blank($registration->lookup_token)) {
                $registration->lookup_token = Str::random(48);
            }

            if ($registration->status === 'attended') {
                if (blank($registration->certificate_code)) {
                    $registration->certificate_code =
                        'CERT-' . Str::upper(Str::random(12));

                    $registration->certificate_issued_at = now();
                }
            } else {
                $registration->certificate_code = null;
                $registration->certificate_issued_at = null;
            }
        });
    }

    public function course(): BelongsTo
    {
        return $this->belongsTo(Course::class);
    }
}