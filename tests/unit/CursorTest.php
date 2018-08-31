<?php

use App\Cursor;
use App\MagneticPoint;
use PHPUnit\Framework\TestCase;

class CursorTest extends TestCase
{
    public function testMovesToPointerWhenNoMagneticPointExists()
    {
        $cursor = new Cursor();

        $coordinates = $cursor->move(50, 30);

        $this->assertEquals([50, 30], $coordinates);
    }

    public function testMovesToAvailableMagneticPoint()
    {
        $cursor = new Cursor();

        $magneticPoint = new MagneticPoint(50, 50, 5);

        $coordinates = $cursor->withMagneticPoints([$magneticPoint])->move(46, 53);

        $this->assertEquals([50, 50], $coordinates);
    }

    public function testMovesToClosestMagneticPoint()
    {
        $cursor = new Cursor();

        $magneticPoints = [
            new MagneticPoint(50, 50, 5),
            new MagneticPoint(100, 50, 5),
            new MagneticPoint(130, 80, 5)
        ];

        $coordinates = $cursor->withMagneticPoints($magneticPoints)->move(101, 48);

        $this->assertEquals([100, 50], $coordinates);
    }
}