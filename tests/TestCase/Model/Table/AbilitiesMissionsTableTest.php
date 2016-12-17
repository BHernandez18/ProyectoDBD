<?php
namespace App\Test\TestCase\Model\Table;

use App\Model\Table\AbilitiesMissionsTable;
use Cake\ORM\TableRegistry;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\AbilitiesMissionsTable Test Case
 */
class AbilitiesMissionsTableTest extends TestCase
{

    /**
     * Test subject
     *
     * @var \App\Model\Table\AbilitiesMissionsTable
     */
    public $AbilitiesMissions;

    /**
     * Fixtures
     *
     * @var array
     */
    public $fixtures = [
        'app.abilities_missions',
        'app.missions',
        'app.abilities',
        'app.users',
        'app.manual_requests',
        'app.reports',
        'app.abilities_users'
    ];

    /**
     * setUp method
     *
     * @return void
     */
    public function setUp()
    {
        parent::setUp();
        $config = TableRegistry::exists('AbilitiesMissions') ? [] : ['className' => 'App\Model\Table\AbilitiesMissionsTable'];
        $this->AbilitiesMissions = TableRegistry::get('AbilitiesMissions', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown()
    {
        unset($this->AbilitiesMissions);

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
     * Test buildRules method
     *
     * @return void
     */
    public function testBuildRules()
    {
        $this->markTestIncomplete('Not implemented yet.');
    }
}
