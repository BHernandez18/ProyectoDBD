<?php
namespace App\Test\Fixture;

use Cake\TestSuite\Fixture\TestFixture;

/**
 * AbilitiesMissionsFixture
 *
 */
class AbilitiesMissionsFixture extends TestFixture
{

    /**
     * Fields
     *
     * @var array
     */
    // @codingStandardsIgnoreStart
    public $fields = [
        'mission_id' => ['type' => 'integer', 'length' => 11, 'unsigned' => false, 'null' => false, 'default' => null, 'comment' => '', 'autoIncrement' => true, 'precision' => null],
        'ability_id' => ['type' => 'integer', 'length' => 11, 'unsigned' => false, 'null' => false, 'default' => null, 'comment' => '', 'precision' => null, 'autoIncrement' => null],
        '_indexes' => [
            'FK_HABILIDAD_NECESITA' => ['type' => 'index', 'columns' => ['ability_id'], 'length' => []],
        ],
        '_constraints' => [
            'primary' => ['type' => 'primary', 'columns' => ['mission_id', 'ability_id'], 'length' => []],
            'FK_HABILIDAD_NECESITA' => ['type' => 'foreign', 'columns' => ['ability_id'], 'references' => ['abilities', 'id'], 'update' => 'restrict', 'delete' => 'restrict', 'length' => []],
            'FK_MISION_NECESITA' => ['type' => 'foreign', 'columns' => ['mission_id'], 'references' => ['missions', 'id'], 'update' => 'restrict', 'delete' => 'restrict', 'length' => []],
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
            'mission_id' => 1,
            'ability_id' => 1
        ],
    ];
}
