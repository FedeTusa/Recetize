<?php

namespace App\Validation;

use Config\Database;

class ValidationRules
{
    public function id_exists(string $str, string $fields, array $data): bool
    {
        $db = Database::connect();
        $builder = $db->table('paciente');
        $builder->where('id', $str);
        return $builder->countAllResults() > 0;
    }
}