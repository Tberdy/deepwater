<?php
namespace App\Test\TestCase\Model\Table;

use App\Model\Table\StickersTable;
use Cake\ORM\TableRegistry;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\StickersTable Test Case
 */
class StickersTableTest extends TestCase
{

    /**
     * Test subject
     *
     * @var \App\Model\Table\StickersTable
     */
    public $Stickers;

    /**
     * Fixtures
     *
     * @var array
     */
    public $fixtures = [
        'app.stickers',
        'app.earnings',
        'app.members',
        'app.bonds',
        'app.member2s',
        'app.devices',
        'app.logs',
        'app.workouts',
        'app.messages'
    ];

    /**
     * setUp method
     *
     * @return void
     */
    public function setUp()
    {
        parent::setUp();
        $config = TableRegistry::exists('Stickers') ? [] : ['className' => StickersTable::class];
        $this->Stickers = TableRegistry::get('Stickers', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown()
    {
        unset($this->Stickers);

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
