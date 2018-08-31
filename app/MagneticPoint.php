<?php

declare(strict_types=1);

namespace App;


class MagneticPoint
{
    /**
     * O eixo X da coordanada de localização do ponto.
     *
     * @var float
     */
    protected $x = 0;

    /**
     * O eixo Y da coordanada de localização do ponto.
     *
     * @var float
     */
    protected $y = 0;

    /**
     * O raio de efeito do ponto magnético.
     *
     * @var float
     */
    protected $radius = 0;

    public function __construct(float $x, float $y, float $radius)
    {
        $this->x = $x;
        $this->y = $y;
        $this->radius = $radius;
    }

    /**
     * Diz se o ponto (coordenadas) é atraído pelo ponto magnético.
     *
     * @param float $x
     * @param float $y
     * @return bool
     */
    public function pulls(float $x, float $y): bool
    {
        return $this->inRadius($x, $y);
    }

    /**
     * Informa a distância entre as coordenadas e o ponto magnético.
     *
     * @param float $x
     * @param float $y
     * @return float
     */
    public function distance(float $x, float $y): float
    {
        $square = pow(abs($x) - abs($this->x), 2) + pow(abs($y) - abs($this->y), 2);

        return round(sqrt($square), 2);
    }

    /**
     * Obtém as coordenadas do ponto magnético.
     *
     * @return array
     */
    public function getCoordinate(): array
    {
        return [$this->x, $this->y];
    }

    /**
     * Informa se as coordenadas estão no raio de atuação do ponto magnético.
     *
     * @param $x
     * @param $y
     * @return bool
     */
    protected function inRadius($x, $y): bool
    {
        return (pow(abs($x) - abs($this->x), 2) - pow(abs($y) - abs($this->y), 2)) <= pow($this->radius, 2);
    }
}