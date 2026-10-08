<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class AddTaskAuthAndArchive extends Migration
{
    public function up(): void
    {
        $this->forge->addColumn('tasks', ['is_archived' => ['type' => 'BOOLEAN', 'default' => false]]);
        $this->forge->addColumn('users', ['password_hash' => ['type' => 'VARCHAR', 'constraint' => 255, 'null' => true]]);
    }

    public function down(): void
    {
        $this->forge->dropColumn('tasks', 'is_archived');
        $this->forge->dropColumn('users', 'password_hash');
    }
}
