<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Carbon;
use Spatie\Permission\Traits\HasRoles;

class User extends Authenticatable implements MustVerifyEmail
{
    /** @use HasFactory<\Database\Factories\UserFactory> */
    use HasFactory, Notifiable, HasRoles;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'avatar',
        'phoneNumber',
        //yang di komen dipindahkan ke approval
        // 'fullName',
        // 'homeAddress',
        // 'occupation',
        // 'companyName',
        // 'companyAddress',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }

    public function dataRequests()
    {
        return $this->hasMany(DataRequest::class);
    }

    public function approval(){
        return $this->hasMany(approval::class);
    }

    public function hasActiveApproval()
    {
        // Cari approval terbaru yang sudah di-upload
        $latestApproval = $this->approval()
            ->where('upload', true)
            ->latest('updated_at')
            ->first();

        // Jika tidak ada approval yang valid, kembalikan false
        if (!$latestApproval) {
            return false;
        }

        // Approval berlaku seumur hidup, jadi langsung kembalikan true
        return true;
    }
}
