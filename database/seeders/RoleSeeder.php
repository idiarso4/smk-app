<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;

class RoleSeeder extends Seeder
{
    public function run(): void
    {
        // Create roles
        $roles = [
            'super_admin' => 'Super Administrator',
            'admin' => 'Administrator',
            'guru' => 'Guru',
            'guru_piket' => 'Guru Piket',
            'pembimbing_pkl' => 'Pembimbing PKL',
            'wali_kelas' => 'Wali Kelas',
            'staff_sarpras' => 'Staff Sarpras',
            'kepala_sarpras' => 'Kepala Sarpras',
            'security' => 'Petugas Keamanan',
            'kepala_security' => 'Kepala Keamanan',
            'siswa' => 'Siswa',
            'siswa_pkl' => 'Siswa PKL',
            'tamu' => 'Tamu',
        ];

        foreach ($roles as $key => $name) {
            Role::create([
                'name' => $key,
                'guard_name' => 'web',
            ]);
        }
    }
} 