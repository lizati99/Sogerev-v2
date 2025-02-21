<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    /** @use HasFactory<\Database\Factories\UserFactory> */
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = [
        'name',
        'phone_number',
        'email',
        'password',
        'address',
        'role_id',
        // 'google_id',
        'email_verified_at',
        // 'google_id',
        // 'profile_photo_path',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var list<string>
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
            // 'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }

    public function role() {
        return $this->belongsTo(Role::class);
    }

    public function permissions() {
        return $this->role ? $this->role->permissions() : collect();
    }

    public function hasPermission($permission)
    {
        $mapPermissions = [
            'manage_users' => 'gérer les utilisateurs',
            'view_reports' => 'consulter les rapports',
            'manage_sales' => 'gérer les ventes',
            'access_dashboard' => 'tableau de bord d\'accès',
        ];

        // Convert the name if it exists
        $permissionName = $mapPermissions[$permission] ?? $permission;

        // Super Admin has all permissions
        if ($this->role && $this->role->libelle === 'super admin') {
            return true;
        }

        return $this->permissions()->where('libelle', $permissionName)->exists();
    }
}
