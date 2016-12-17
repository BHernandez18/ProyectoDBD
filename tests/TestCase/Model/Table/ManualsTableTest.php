<?php
namespace App\Test\TestCase\Model\Table;

use App\Model\Table\ManualsTable;
use Cake\ORM\TableRegistry;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\ManualsTable Test Case
 */
class ManualsTableTest extends TestCase
{

    /**
     * Test subject
     *
     * @var \App\Model\Table\ManualsTable
     */
    public $Manuals;

    /**
     * Fixtures
     *
     * @var array
     */
    public $fixtures = [
        'app.manuals',
        'app.tasks',
        'app.manuals_requests'
    ];

    /**
     * setUp method
     *
     * @return void
     */
    public function setUp()
    {
        parent::setUp();
        $config = TableRegistry::exists('Manuals') ? [] : ['className' => 'App\Model\Table\ManualsTable'];
        $this->Manuals = TableRegistry::get('Manuals', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown()
    {
        unset($this->Manuals);

        parent::tearDown();
    }

    /**
     * Test initialize method
     *
     * @return void
     */
    public function testInitialize()
    {
        $this->markTestIncomplete('Not implemented yet.');
    }

    /**
     * Test validationDefault method
     *
     * @return void
     */
    public function testValidationDefault()
    {
        $this->markTestIncomplete('Not implemented yet.');
    }

    /**
     * Test buildRules method
     *
     * @return void
     */
    public function testBuildRules()
    {
        $this->markTestIncomplete('Not implemented yet.');
    }
}
