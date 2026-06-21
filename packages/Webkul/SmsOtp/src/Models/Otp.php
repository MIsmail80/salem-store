<?php

namespace Webkul\SmsOtp\Models;

use Illuminate\Database\Eloquent\Model;

class Otp extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'otps';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'phone',
        'code',
        'expires_at',
        'verified_at',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array
     */
    protected $casts = [
        'expires_at' => 'datetime',
        'verified_at' => 'datetime',
    ];

    /**
     * Check if OTP is expired.
     */
    public function isExpired(): bool
    {
        return $this->expires_at->isPast();
    }

    /**
     * Check if OTP is verified.
     */
    public function isVerified(): bool
    {
        return $this->verified_at !== null;
    }

    /**
     * Check if OTP is valid (not expired and not verified).
     */
    public function isValid(): bool
    {
        return !$this->isExpired() && !$this->isVerified();
    }

    /**
     * Mark OTP as verified.
     */
    public function markAsVerified(): bool
    {
        return $this->update(['verified_at' => now()]);
    }

    /**
     * Generate a new OTP code.
     */
    public static function generateCode(int $length = 6): string
    {
        return str_pad((string) random_int(0, pow(10, $length) - 1), $length, '0', STR_PAD_LEFT);
    }

    /**
     * Create a new OTP for the given phone number.
     */
    public static function createForPhone(string $phone, int $expiryMinutes = 10): self
    {
        // Invalidate any existing OTPs for this phone
        self::where('phone', $phone)
            ->whereNull('verified_at')
            ->delete();

        return self::create([
            'phone' => $phone,
            'code' => self::generateCode(),
            'expires_at' => now()->addMinutes($expiryMinutes),
        ]);
    }

    /**
     * Verify OTP for the given phone and code.
     */
    public static function verify(string $phone, string $code): ?self
    {
        $otp = self::where('phone', $phone)
            ->where('code', $code)
            ->whereNull('verified_at')
            ->where('expires_at', '>', now())
            ->first();

        if ($otp) {
            $otp->markAsVerified();
        }

        return $otp;
    }
}
