<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;

class PermissionSeeder extends Seeder
{
    public function run(): void
    {
        $permissions = [
            // Perizinan Siswa
            'view_student_permits',
            'create_student_permits',
            'approve_subject_permits',
            'approve_final_permits',
            
            // Presensi & Jurnal Guru
            'manage_qr_codes',
            'view_teacher_attendance',
            'create_teaching_journal',
            'view_teaching_reports',
            
            // PKL
            'manage_pkl_journals',
            'validate_pkl_journals',
            'manage_pkl_visits',
            'view_pkl_reports',
            
            // Sarpras
            'manage_inventory',
            'approve_maintenance',
            'view_inventory_reports',
            'manage_stock',
            
            // Keamanan
            'manage_security_shifts',
            'create_security_logs',
            'manage_visitor_logs',
            'view_security_reports',
        ];

        foreach ($permissions as $permission) {
            Permission::create([
                'name' => $permission,
                'guard_name' => 'web',
            ]);
        }
    }
} 