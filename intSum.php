<?php

/**
 * Platform name vivelab_prueba.
 * @author Daniel Cifuentes
 * Date: 10/13/16
 */
include ("WordToSum.php");

$numberA = $_POST['numberA'];
$numberB = $_POST['numberB'];

$app = new WordToSum();
echo $app->sumTwoWords($numberA, $numberB);





