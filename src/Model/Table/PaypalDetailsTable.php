<?php
declare(strict_types=1);

namespace App\Model\Table;

use Cake\ORM\Table;

class PaypalDetailsTable extends Table
{
    public function initialize(array $config): void
    {
        parent::initialize($config);

        // Define the table name
        $this->setTable('paypal_details');

        // Define the primary key
        $this->setPrimaryKey('id');

        // Add behaviors like Timestamp if needed
        $this->addBehavior('Timestamp');
    }
}
