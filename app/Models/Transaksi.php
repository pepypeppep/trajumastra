<?php

namespace App\Models;

use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Transaksi extends Model
{
    protected $guarded = ['id'];

    /**
     * Get the staff that owns the Transaksi
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function staff(): BelongsTo
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    /**
     * Get the uptd that owns the Transaksi
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function uptd(): BelongsTo
    {
        return $this->belongsTo(Uptd::class);
    }

    /**
     * Get all of the details for the Transaksi
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function details(): HasMany
    {
        return $this->hasMany(TransaksiDetail::class, 'transaksi_id');
    }

    /**
     * Handle the model's booting routine for creating the invoice ID.
     *
     * @return void
     */
    protected static function boot()
    {
        parent::boot();

        static::creating(function ($model) {
            if (empty($model->invoice_id)) {
                $model->invoice_id = $model->generateInvoiceId();
            }
        });
    }

    /**
     * Generate unique TM + 8 digit invoice ID
     */
    public function generateInvoiceId()
    {
        $maxAttempts = 50;
        $attempts = 0;

        do {
            $randomDigits = Str::padLeft(rand(0, 99999999), 8, '0');
            $invoiceId = 'TM' . $randomDigits;
            $attempts++;
        } while (self::where('invoice_id', $invoiceId)->exists() && $attempts < $maxAttempts);

        if ($attempts >= $maxAttempts) {
            throw new \Exception('Could not generate unique invoice ID');
        }

        return $invoiceId;
    }
}
