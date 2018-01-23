<?php
namespace App\Test\TestCase\Model\Table;

use App\Model\Table\EarningsTable;
use Cake\ORM\TableRegistry;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\EarningsTable Test Case
 */
class EarningsTableTest extends TestCase
{

    /**
     * Test subject
     *
     * @var \App\Model\Table\EarningsTable
     */
    public $Earnings;

    /**
     * Fixtures
     *
     * @var array
     */
    public $fixtures = [
        'app.earnings',
        'app.members',
        'app.stickers'
    ];

    /**
     * setUp method
     *
     * @return void
     */
    public function setUp()
    {
        parent::setUp();
        $config = TableRegistry::exists('Earnings') ? [] : ['className' => EarningsTable::class];
        $this->Earnings = TableRegistry::get('Earnings', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown()
    {
        unset($this->Earnings);

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
