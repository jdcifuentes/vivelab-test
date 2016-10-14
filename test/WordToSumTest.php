<?php
require_once (__DIR__ .'/../WordToSum.php');

/**
 * Platform name vivelab_prueba.
 * @author Daniel Cifuentes
 * Date: 10/14/16
 */

class WordToSumTest extends PHPUnit_Framework_TestCase
{
    /** @var  WordToSum */
    protected $_sum;
    protected function setUp()
    {
        $this->_sum = new WordToSum();
    }

    public function testWord2Int() {
        $this->assertEquals(0, $this->_sum->word2Int('zero'));
        $this->assertEquals(34, $this->_sum->word2Int('thirty four'));
        $this->assertEquals(117, $this->_sum->word2Int('one hundred and seventeen'));
        $this->assertEquals(117, $this->_sum->word2Int('one   hundred    and    seventeen   '));
        $this->assertEquals(-1, $this->_sum->word2Int('one ff  hundred    and    seventeen   '));

    }

    public function testInt2Word() {
        $this->assertEquals('four',$this->_sum->int2Word('4'));
        $this->assertEquals('forty seven thousand six hundred and eighty five',$this->_sum->int2Word('47685'));
        $this->assertEquals('Zero',$this->_sum->int2Word('4712341234124312412412423423432685'));
    }

    public function testSum2Words() {
        $this->assertEquals('five',$this->_sum->sumTwoWords('four', 'one'));
        $this->assertEquals('zero',$this->_sum->sumTwoWords('four', 'one fis'));
        $this->assertEquals('one million nine hundred and eighty one',$this->_sum->sumTwoWords('nine hundred and eighty two', 'nine hundred and ninety nine thousand nine hundred and ninety nine'));
    }



}
