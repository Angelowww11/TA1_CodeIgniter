<?php

namespace App\Libraries;

use CodeIgniter\Database\BaseBuilder;
use CodeIgniter\Session\Handlers\Database\PostgreHandler;

/** PostgreSQL session storage for the app's TEXT-backed session table. */
class PostgresTextSessionHandler extends PostgreHandler
{
    protected function setSelect(BaseBuilder $builder)
    {
        $builder->select('data');
    }

    protected function decodeData($data)
    {
        return $data;
    }

    protected function prepareData(string $data): string
    {
        return $data;
    }
}
