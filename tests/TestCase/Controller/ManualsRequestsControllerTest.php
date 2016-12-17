<?php
namespace App\Test\TestCase\Controller;

use App\Controller\ManualsRequestsController;
use Cake\TestSuite\IntegrationTestCase;

/**
 * App\Controller\ManualsRequestsController Test Case
 */
class ManualsRequestsControllerTest extends IntegrationTestCase
{

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
        'app.emergencies',
        'app.tasks',
        'app.calls',
        'app.manuals',
        'app.reports',
        'app.abilities',
        'app.abilities_missions',
        'app.abilities_users'
    ];

    /**
     * Test index method
     *
     * @return void
     */
    public function testIndex()
    {
        $this->markTestIncomplete('Not implemented yet.');
    }

    /**
     * Test view method
     *
     * @return void
     */
    public function testView()
    {
        $this->markTestIncomplete('Not implemented yet.');
    }

    /**
     * Test add method
     *
     * @return void
     */
    public function testAdd()
    {
        $this->markTestIncomplete('Not implemented yet.');
    }

    /**
     * Test edit method
     *
     * @return void
     */
    public function testEdit()
    {
        $this->markTestIncomplete('Not implemented yet.');
    }

    /**
     * Test delete method
     *
     * @return void
     */
    public function testDelete()
    {
        $this->markTestIncomplete('Not implemented yet.');
    }
}
