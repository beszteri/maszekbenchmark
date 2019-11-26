<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\DB;

class Computer extends Model
{
    /**
     * @var integer
     */
    private $cpuId;
    /**
     * @var float
     */
    private $cpuScore;
    /**
     * @var integer
     */
    private $gpuId;
    /**
     * @var float
     */
    private $gpuScore;
    /**
     * @var integer
     */
    private $ramId;
    /**
     * @var float
     */
    private $ramScore;
    /**
     * @var Collection
     */
    private $ssdIds;
    /**
     * @var Collection
     */
    private $ssdScores;
    /**
     * @var Collection
     */
    private $hddIds;
    /**
     * @var Collection
     */
    private $hddScores;

    /**
     * Computer constructor.
     * @param int $cpuId
     * @param float $cpuScore
     * @param int $gpuId
     * @param float $gpuScore
     * @param int $ramId
     * @param float $ramScore
     * @param Collection $ssdIds
     * @param Collection $ssdScores
     * @param Collection $hddIds
     * @param Collection $hddScores
     */
    public function __construct(int $cpuId, float $cpuScore, int $gpuId, float $gpuScore, int $ramId, float $ramScore, Collection $ssdIds, Collection $ssdScores, Collection $hddIds, Collection $hddScores)
    {
        $this->cpuId = $cpuId;
        $this->cpuScore = $cpuScore;
        $this->gpuId = $gpuId;
        $this->gpuScore = $gpuScore;
        $this->ramId = $ramId;
        $this->ramScore = $ramScore;
        $this->ssdIds = $ssdIds;
        $this->ssdScores = $ssdScores;
        $this->hddIds = $hddIds;
        $this->hddScores = $hddScores;
    }


}
