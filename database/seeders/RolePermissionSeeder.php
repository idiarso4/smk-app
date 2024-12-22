<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;

class RolePermissionSeeder extends Seeder
{
    public function run(): void
    {
        // Guru
        Role::findByName('guru')->givePermissionTo([
            'view_student_permits',
            'approve_subject_permits',
            'create_teaching_journal',
        ]);

        // Guru Piket
        Role::findByName('guru_piket')->givePermissionTo([
            'view_student_permits',
            'approve_final_permits',
        ]);

        // Staff Sarpras
        Role::findByName('staff_sarpras')->givePermissionTo([
            'manage_inventory',
            'manage_stock',
            'view_inventory_reports',
        ]);

        // Security
        Role::findByName('security')->givePermissionTo([
            'create_security_logs',
            'manage_visitor_logs',
        ]);

        // Siswa PKL
        Role::findByName('siswa_pkl')->givePermissionTo([
            'manage_pkl_journals',
        ]);
    }
} 