<?php

namespace App\Models;

use CodeIgniter\Model;

class Departemen extends Model
{
    protected $DBGroup          = 'default';
    protected $table            = 'departemen';
    protected $returnType       = 'object';
    protected $allowedFields    = ['nama_departemen'];
}
