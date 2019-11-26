<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\DB;

class Hardware extends Model
{
    /**
     * @var integer
     */
    private $id;
    /**
     * @var string
     */
    private $part;
    /**
     * @var string
     */
    private $brand;
    /**
     * @var string
     */
    private $model;
    /**
     * @var float
     */
    private $score;

    /**
     * Hardware constructor.
     * @param int $id
     * @param string $part
     * @param string $brand
     * @param string $model
     * @param float $score
     */
    public function __construct(int $id, string $part, string $brand, string $model, float $score)
    {
        $this->id = $id;
        $this->part = $part;
        $this->brand = $brand;
        $this->model = $model;
        $this->score = $score;
    }

    /**
     * @return int
     */
    public function getId(): int
    {
        return $this->id;
    }

    /**
     * @param int $id
     */
    public function setId(int $id): void
    {
        $this->id = $id;
    }

    /**
     * @return string
     */
    public function getPart(): string
    {
        return $this->part;
    }

    /**
     * @param string $part
     */
    public function setPart(string $part): void
    {
        $this->part = $part;
    }

    /**
     * @return string
     */
    public function getBrand(): string
    {
        return $this->brand;
    }

    /**
     * @param string $brand
     */
    public function setBrand(string $brand): void
    {
        $this->brand = $brand;
    }

    /**
     * @return string
     */
    public function getModel(): string
    {
        return $this->model;
    }

    /**
     * @param string $model
     */
    public function setModel(string $model): void
    {
        $this->model = $model;
    }

    /**
     * @return float
     */
    public function getScore(): float
    {
        return $this->score;
    }

    /**
     * @param float $score
     */
    public function setScore(float $score): void
    {
        $this->score = $score;
    }
}
