<?php
namespace App\Test\Fixture;

use Cake\TestSuite\Fixture\TestFixture;

/**
 * ManualsRequestsFixture
 *
 */
class ManualsRequestsFixture extends TestFixture
{

    /**
     * Fields
     *
     * @var array
     */
    // @codingStandardsIgnoreStart
    public $fields = [
        'request_id' => ['type' => 'integer', 'length' => 11, 'unsigned' => false, 'null' => false, 'default' => null, 'comment' => '', 'autoIncrement' => true, 'precision' => null],
        'user_id' => ['type' => 'integer', 'length' => 11, 'unsigned' => false, 'null' => false, 'default' => null, 'comment' => '', 'precision' => null, 'autoIncrement' => null],
        'manual_id' => ['type' => 'integer', 'length' => 11, 'unsigned' => false, 'null' => false, 'default' => null, 'comment' => '', 'precision' => null, 'autoIncrement' => null],
        'request_date' => ['type' => 'datetime', 'length' => null, 'null' => true, 'default' => null, 'comment' => '', 'precision' => null],
        'devolution_date' => ['type' => 'datetime', 'length' => null, 'null' => true, 'default' => null, 'comment' => '', 'precision' => null],
        '_indexes' => [
            'FK_PETICION_USUARIO' => ['type' => 'index', 'columns' => ['user_id'], 'length' => []],
            'FK_PETICION_MANUAL' => ['type' => 'index', 'columns' => ['manual_id'], 'length' => []],
        ],
        '_constraints' => [
            'primary' => ['type' => 'primary', 'columns' => ['request_id'], 'length' => []],
            'FK_PETICION_MANUAL' => ['type' => 'foreign', 'columns' => ['manual_id'], 'references' => ['manuals', 'id'], 'update' => 'restrict', 'delete' => 'restrict', 'length' => []],
            'FK_PETICION_USUARIO' => ['type' => 'foreign', 'columns' => ['user_id'], 'references' => ['users', 'id'], 'update' => 'restrict', 'delete' => 'restrict', 'length' => []],
        ],
        '_options' => [
            'engine' => 'InnoDB',
            'collation' => 'latin1_swedish_ci'
        ],
    ];
    // @codingStandardsIgnoreEnd

    /**
     * Records
     *
     * @var array
     */
    public $records = [
        [
            'request_id' => 1,
            'user_id' => 1,
            'manual_id' => 1,
            'request_date' => '2016-12-15 16:17:28',
            'devolution_date' => '2016-12-15 16:17:28'
        ],
    ];
}
