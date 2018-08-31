<?php

declare(strict_types=1);

namespace App;


class Cursor
{
    /**
     * O mapa de pontos magnéticos disponíveis para o cursor.
     *
     * @var array
     */
    protected $magneticPoints = [];

    /**
     * Move o cursor para as coordenadas solicitadas ou
     * o ponto magnético mais próximo.
     *
     * @param float $x
     * @param float $y
     * @return array
     */
    public function move(float $x, float $y): array
    {
        $coordinates = [$x, $y];

        if (empty($this->magneticPoints)) {
            return $coordinates;
        }

        $magneticPoint = $this->closestMagneticPoint($x, $y);

        if (! $magneticPoint) {
            return $coordinates;
        }

        return $magneticPoint->getCoordinate();
    }

    public function withMagneticPoints(array $magneticPoints): Cursor
    {
        $this->magneticPoints = $magneticPoints;

        return $this;
    }

    /**
     * Obtém o ponto magnético mais próximo da coordenada.
     *
     * @param float $x
     * @param float $y
     * @return MagneticPoint|null
     */
    protected function closestMagneticPoint(float $x, float $y)
    {
        $closest = null;
        $closestDistance = null;

        foreach ($this->magneticPoints as $magneticPoint) {

            if (! $magneticPoint->pulls($x, $y)) {
                continue;
            }

            $distance = $magneticPoint->distance($x, $y);

            if (is_null($closestDistance) || ($distance < $closestDistance)) {

                $closestDistance = $distance;

                $closest = $magneticPoint;
            }
        }

        return $closest;
    }
}