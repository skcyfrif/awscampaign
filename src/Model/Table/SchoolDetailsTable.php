<?php
declare(strict_types=1);

namespace App\Model\Table;

use Cake\ORM\Table;

class SchoolDetailsTable extends Table
{
    public function initialize(array $config): void
    {
        parent::initialize($config);

        // Define the table name
        $this->setTable('schools');

        // Define the primary key
        $this->setPrimaryKey('id');

        // Add behaviors like Timestamp if needed
        $this->addBehavior('Timestamp');
    }
}
