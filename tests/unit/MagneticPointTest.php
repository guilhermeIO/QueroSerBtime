<?php

use App\MagneticPoint;
use PHPUnit\Framework\TestCase;

class MagneticPointTest extends TestCase
{
    public function testPullsWhenCoordinateIsInRadius()
    {
        $magneticPoint = new MagneticPoint(50, 50, 5);

        $this->assertTrue($magneticPoint->pulls(45, 46));
    }

    public function testDoesNotPullIfCoordinateIsOutsideRadius()
    {
        $magneticPoint = new MagneticPoint(160, 80, 20);

        $this->assertFalse($magneticPoint->pulls(40, 42));
    }

    public function testDistanceBetweenCoordinates()
    {
        $magneticPoint = new MagneticPoint(1, 4, 10);

        $distance = $magneticPoint->distance(1, 1);

        $this->assertEquals(3, $distance);
    }

    public function testHasExpectedCoordinate()
    {
        $magneticPoint = new MagneticPoint(130, 50, 10);

        $coordinate = $magneticPoint->getCoordinate();

        $this->assertEquals([130, 50], $coordinate);
    }
}
