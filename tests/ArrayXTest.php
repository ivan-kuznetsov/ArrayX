<?php

use PHPUnit\Framework\TestCase;
use App\ArrayX;

class ArrayXTest extends TestCase
{
    private $randomArray;
    private $users;
    private $user;

    public function setUp()
    {
        $this->randomArray = range(1, rand(5, 10));

        $this->users = [
          ['name' => 'Sergey', 'score' => 10],
          ['name' => 'Ivan', 'score' => 10],
          ['name' => 'Ilya', 'score' => 30],
          ['name' => 'Mikhail', 'score' => 20],
        ];

        $this->user = [
          'name' => 'Ivan',
          'topics' => [
            ['title' => 'Hi arrays'],
            ['title' => 'Buy arrays'],
          ],
          'country' => [
            'name' => 'UK',
            'flag' => 'nice'
          ],
        ];
    }

    public function test_that_array_is_accessible()
    {
        $this->assertTrue(ArrayX::accessible($this->randomArray));
    }

    public function test_that_key_exists()
    {
        $a = ['key' => 'value'];

        $this->assertTrue(ArrayX::exists($a, 'key'));
    }

    public function test_that_key_does_not_exist()
    {
        $a = ['key' => 'value'];

        $this->assertFalse(ArrayX::exists($a, 'keys'));
    }

    public function test_that_we_can_get_value()
    {
        $a = ['key' => 'value'];

        $this->assertFalse(ArrayX::exists($a, 'keys'));
    }

    public function test_that_we_can_not_get_value()
    {
        $a = ['key' => 'value'];

        $this->assertNull(ArrayX::get($a, 'keys'));
    }

    public function test_that_we_can_get_default_value()
    {
        $a = ['key' => 'value'];

        $this->assertSame('default', ArrayX::get($a, 'keys', 'default'));
    }

    public function test_that_we_can_not_get_dotted_value()
    {
        $this->markTestIncomplete('This test has not been implemented yet.');
    }
}
