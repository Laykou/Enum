<?php

/**
 * Copyright 2015, Cake Development Corporation (http://cakedc.com)
 *
 * Licensed under The MIT License
 * Redistributions of files must retain the above copyright notice.
 *
 * @copyright Copyright 2015, Cake Development Corporation (http://cakedc.com)
 * @license MIT License (http://www.opensource.org/licenses/mit-license.php)
 */

namespace CakeDC\Enum\Test\TestCase\Model\Behavior\Strategy;

use CakeDC\Enum\Model\Behavior\Strategy\ConstStrategy;
use Cake\ORM\Table;
use Cake\TestSuite\TestCase;

class ArticlesTable extends Table
{

    const EXTRA_VALUE = 'Extra';

    const STATUS_PUBLIC = 'Published';
    const STATUS_DRAFT = 'Drafted';
    const STATUS_ARCHIVE = 'Archived';
}

class ConstStrategyTest extends TestCase
{
    public $Strategy;

    public function setUp()
    {
        parent::setUp();
        $this->Strategy = new ConstStrategy('status', new ArticlesTable());
        $this->Strategy->initialize(['prefix' => 'STATUS', 'lowercase' => true]);
    }

    public function tearDown()
    {
        parent::tearDown();
        unset($this->Strategy);
    }

    public function testEnum()
    {
        $result = $this->Strategy->enum();
        $expected = [
            'public' => 'Published',
            'draft' => 'Drafted',
            'archive' => 'Archived',
        ];
        $this->assertEquals($expected, $result);

        // Cached list
        $this->assertEquals($expected, $this->Strategy->enum());
    }
}
