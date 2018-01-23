<?php
namespace App\Test\TestCase\Model\Table;

use App\Model\Table\ContestsTable;
use Cake\ORM\TableRegistry;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\ContestsTable Test Case
 */
class ContestsTableTest extends TestCase
{

    /**
     * Test subject
     *
     * @var \App\Model\Table\ContestsTable
     */
    public $Contests;

    /**
     * Fixtures
     *
     * @var array
     */
    public $fixtures = [
        'app.contests',
        'app.workouts'
    ];

    /**
     * setUp method
     *
     * @return void
     */
    public function setUp()
    {
        parent::setUp();
        $config = TableRegistry::exists('Contests') ? [] : ['className' => ContestsTable::class];
        $this->Contests = TableRegistry::get('Contests', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown()
    {
        unset($this->Contests);

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
}
