<?php
namespace Enum\Test\TestCase\Model\Behavior\Strategy;

use Cake\ORM\Table;
use Cake\TestSuite\TestCase;
use Enum\Model\Behavior\Strategy\ConstStrategy;

class ArticlesTable extends Table
{
    const STATUS_PUBLIC = 'Published';
    const STATUS_DRAFT = 'Drafted';
    const STATUS_ARCHIVE = 'Archived';
    const PRIORITY_URGENT = 'Urgent';
    const PRIORITY_HIGH = 'High';
    const PRIORITY_NORMAL = 'Normal';
}

class ConstStrategyTest extends TestCase
{
    public $Strategy;

    public function setUp()
    {
        parent::setUp();
        $this->Strategy = new ConstStrategy('status', new ArticlesTable());
    }

    public function tearDown()
    {
        parent::tearDown();
        unset($this->Strategy);
    }

    public function testListPrefixes()
    {
        $result = $this->Strategy->listPrefixes();
        $expected = ['STATUS', 'PRIORITY'];
        $this->assertEquals($expected, $result);
    }

    public function testEnum()
    {
        $this->Strategy->config('prefix', 'STATUS');
        $result = $this->Strategy->enum();
        $expected = [
            'STATUS_PUBLIC' => 'Published',
            'STATUS_DRAFT' => 'Drafted',
            'STATUS_ARCHIVE' => 'Archived',
        ];
        $this->assertEquals($expected, $result);
    }
}
