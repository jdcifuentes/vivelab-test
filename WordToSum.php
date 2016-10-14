<?php
/**
 * Platform name vivelab_prueba.
 * @author Daniel Cifuentes
 * Date: 10/13/16
 */
class WordToSum
{

    private static $ones = array(
        "zero", "one", "two", "three", "four", "five", "six", "seven", "eight",
        "nine", "ten", "eleven", "twelve", "thirteen", "fourteen", "fifteen",
        "sixteen", "seventeen", "eighteen", "nineteen");
    private static $tens = array("", "", "twenty", "thirty", "forty", "fifty", "sixty", "seventy", "eighty", "ninety");

    private static $scales = array("hundred", "thousand", "million", "billion", "trillion");

    public function word2Int($number_string = '')
    {

        $numbers = array();

        $numbers['and'] = array(1, 0);

        foreach (self::$ones as $idx => $number) {
            $numbers[$number] = array(1, $idx);
        }

        foreach (self::$tens as $idx => $number) {
            $numbers[$number] = array(1, $idx * 10);
        }

        foreach (self::$scales as $idx => $number) {
            $numbers[$number] = array($idx == 0 ? 100 : 10 ** ($idx * 3), 0);
        }
        unset($numbers['']);

        $number_string = rtrim(preg_replace('/\s+/', ' ', $number_string));

        $current = $result = 0;
        foreach (explode(' ', strtolower($number_string)) as $word) {
            if (!isset($numbers[$word])) {
                return -1;
            }
            $scale = $numbers[$word][0];
            $increment = $numbers[$word][1];
            $current = $current * $scale + $increment;

            if ($scale > 100) {
                $result += $current;
                $current = 0;
            }
        }
        return $result + $current;

    }

    /**
     * @param string $a
     * @param string $b
     * @return int|string
     */
    public function sumTwoWords($a = '', $b = '')
    {
        $int_a = $this->word2Int($a);
        $int_b = $this->word2Int($b);
        if (($int_a != -1) && ($int_b != -1)) {
            return $this->int2Word($int_a + $int_b);
        } else {
            return 'zero';
        }
    }

    public function int2Word($number = 0)
    {

        if ($number >= PHP_INT_MAX) {
            return 'Zero';
        }
        $k = 1000;
        $m = $k * 1000;
        $b = $m * 1000;
        $t = $b * 1000;

        if ($number < 20) {
            return self::$ones[$number];
        }

        if ($number < 100) {
            return $number % 10 == 0 ? self::$tens[($number / 10)] : self::$tens[(floor($number / 10))] . " " . self::$ones[($number % 10)];
        }

        if ($number < $k) {
            return $number % 100 == 0 ? [$number / 100] . ' hundred' : self::$ones[(floor($number / 100))] . ' hundred and ' . $this->int2Word($number % 100);
        }

        if ($number < $m) {
            return $number % $k == 0 ? $this->int2Word(floor($number / $k)) . ' thousand' : $this->int2Word(floor($number / $k)) . ' thousand ' . $this->int2Word($number % $k);
        }

        if ($number < $b) {
            return $number % $m == 0 ? $this->int2Word(floor($number / $m)) . ' million' : $this->int2Word(floor($number / $m)) . ' million ' . $this->int2Word($number % $m);
        }

        if ($number < $t) {
            return $number % $b == 0 ? $this->int2Word(floor($number / $b)) . ' billion' : $this->int2Word(floor($number / $b)) . ' billion ' . $this->int2Word($number % $b);
        }

        if ($number % $t == 0) {
            return $this->int2Word(floor($number / $t)) . ' trillion';
        } elseif (($number % $t) < 10) {
            return $this->int2Word(floor($number / $t)) . ' trillion ' . $this->int2Word($number % $t);
        } else {
            return 'zero';
        }


    }
}
