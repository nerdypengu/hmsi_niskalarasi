<?php namespace App\Commands;

use CodeIgniter\CLI\BaseCommand;
use CodeIgniter\CLI\CLI;
use Config\Database;

class ShowTable extends BaseCommand
{
    protected $group = 'Custom';
    protected $name = 'show:table';
    protected $description = 'Tampilkan isi tabel DB (usage: php spark show:table tabel_name [limit])';

    public function run(array $params = [])
    {
        $table = $params[0] ?? null;
        $limit = isset($params[1]) ? (int)$params[1] : 50;

        if (!$table) {
            CLI::error("Usage: php spark show:table <table_name> [limit]");
            return;
        }

        $db = Database::connect();
        $builder = $db->table($table);

        $query = $builder->limit($limit)->get();
        $rows  = $query->getResultArray();

        if (empty($rows)) {
            CLI::write("No rows found in table: {$table}");
            return;
        }

        // tampilkan dalam format tabel di CLI (kolom = keys dari row pertama)
        $headers = array_keys($rows[0]);
        CLI::table($rows, $headers);
    }
}
