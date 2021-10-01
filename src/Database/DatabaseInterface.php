<?php

namespace Dentist\Database;

use PDO;

interface  DatabaseInterface
{
    public function connect(): PDO;
}
