<?php
namespace App\Test\TestCase\Model\Table;

use App\Model\Table\ManualsRequestsTable;
use Cake\ORM\TableRegistry;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\ManualsRequestsTable Test Case
 */
class ManualsRequestsTableTest extends TestCase
{

    /**
     * Test subject
     *
     * @var \App\Model\Table\ManualsRequestsTable
     */
    public $ManualsRequests;

    /**
     * Fixtures
     *
     * @var array
     */
    public $fixtures = [
        'app.manuals_requests',
        'app.requests',
        'app.users',
        'app.missions',
        'app.manual_requests',
        'app.reports',
        'app.abilities',
        'app.abilities_missions',
        'app.abilities_users',
        'app.manuals',
        'app.tasks'
    ];

    /**
     * setUp method
     *
     * @return void
     */
    public function setUp()
    {
        parent::setUp();
        $config = TableRegistry::exists('ManualsRequests') ? [] : ['className' => 'App\Model\Table\ManualsRequestsTable'];
        $this->ManualsRequests = TableRegistry::get('ManualsRequests', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown()
    {
        unset($this->ManualsRequests);

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
