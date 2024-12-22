<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class PermissionSeeder extends Seeder
{
    public function run(): void
    {
        // Reset cached roles and permissions
        app()[\Spatie\Permission\PermissionRegistrar::class]->forgetCachedPermissions();

        // System permissions (for users management)
        $systemPermissions = [
            'view_users',
            'view_any_users',
            'create_users',
            'update_users',
            'delete_users',
            'view_roles',
            'view_any_roles',
            'create_roles',
            'update_roles',
            'delete_roles',
            'view_permissions',
            'view_any_permissions',
            'create_permissions',
            'update_permissions',
            'delete_permissions'
        ];

        // Create system permissions first
        foreach ($systemPermissions as $permission) {
            Permission::create([
                'name' => $permission,
                'guard_name' => 'web'
            ]);
        }

        // Grup menu dan modelnya
        $menuGroups = [
            'Kesiswaan' => [
                'prestasi',
                'bimbingan_konseling',
                'ekstrakurikuler',
                'ruang_ekspresi',
                'organisasi_siswa'
            ],
            'Informasi' => [
                'pengumuman'
            ],
            'Perpustakaan' => [
                'peminjaman_buku',
                'buku',
                'koleksi_buku',
                'kunjungan'
            ],
            'Master Data' => [
                'kelas',
                'mata_pelajaran',
                'teacher',
                'student'
            ],
            'Akademik' => [
                'ujian_cbt',
                'rapor',
                'permit',
                'qr_code',
                'surat_izin_siswa'
            ],
            'Tamu' => [
                'buku_tamu'
            ],
            'Facilities' => [
                'laboratory'
            ],
            'Keguruan' => [
                'absensi_siswa'
            ],
            'Unit Produksi' => [
                'unit_produksi'
            ],
            'Keamanan' => [
                'keamanan'
            ],
            'Kehadiran' => [
                'kehadiran_guru'
            ],
            'Pembelajaran' => [
                'jurnal_mengajar'
            ]
        ];

        // Permission types
        $permissions = [
            'view',
            'view_any',
            'create',
            'update',
            'delete',
            'delete_any',
            'restore',
            'force_delete'
        ];

        // Create permissions for each menu item
        foreach ($menuGroups as $group => $menus) {
            foreach ($menus as $menu) {
                foreach ($permissions as $permission) {
                    Permission::create([
                        'name' => "{$permission}_{$menu}",
                        'guard_name' => 'web'
                    ]);
                }
            }
        }

        // Create and assign roles
        $roles = [
            'super_admin' => Permission::all(),
            'admin' => array_merge($systemPermissions, [
                'view_any_kelas',
                'create_kelas',
                'update_kelas',
                'delete_kelas',
                // Add more
            ]),
            'guru' => [
                'view_jurnal_mengajar',
                'create_jurnal_mengajar',
                'view_kehadiran_guru',
                'create_absensi_siswa',
                // Add more
            ],
            'siswa' => [
                'view_rapor',
                'view_pengumuman',
                'view_absensi_siswa',
                // Add more
            ],
            'security' => [
                'view_keamanan',
                'create_keamanan',
                'view_buku_tamu',
                'create_buku_tamu',
                // Add more
            ],
            'staff_perpustakaan' => [
                'view_any_buku',
                'create_buku',
                'view_peminjaman_buku',
                'create_peminjaman_buku',
                // Add more
            ]
        ];

        foreach ($roles as $roleName => $permissions) {
            $role = Role::findByName($roleName);
            $role->givePermissionTo($permissions);
        }
    }
} 