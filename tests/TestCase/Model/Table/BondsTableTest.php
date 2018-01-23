<?php
namespace App\Test\TestCase\Model\Table;

use App\Model\Table\BondsTable;
use Cake\ORM\TableRegistry;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\BondsTable Test Case
 */
class BondsTableTest extends TestCase
{

    /**
     * Test subject
     *
     * @var \App\Model\Table\BondsTable
     */
    public $Bonds;

    /**
     * Fixtures
     *
     * @var array
     */
    public $fixtures = [
        'app.bonds',
        'app.members',
        'app.member2s'
    ];

    /**
     * setUp method
     *
     * @return void
     */
    public function setUp()
    {
        parent::setUp();
        $config = TableRegistry::exists('Bonds') ? [] : ['className' => BondsTable::class];
        $this->Bonds = TableRegistry::get('Bonds', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown()
    {
        unset($this->Bonds);

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
