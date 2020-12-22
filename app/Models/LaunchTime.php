<?php

declare(strict_types=1);

namespace App\Models;

use DateTime;

class LaunchTime extends Model
{

    /**
     * @var DateTime|null
     */
    private ?DateTime $launchWinOpen = null;

    /**
     * @var DateTime|null
     */
    private ?DateTime $launchWinClose = null;

    /**
     * @var DateTime|null
     */
    private ?DateTime $launchNet = null;

    /**
     * @return array
     */
    public function export(): array
    {
        $array = $this->toArray();

        foreach ($array as $key=>$value) {
            if ($value === null) {
                unset($array[$key]);
            }
        }

        return $array;
    }

    /**
     * @return array
     */
    private function toArray(): array
    {
        return [
            "launchWinOpen" => $this->launchWinOpen,
            "launchNet" => $this->launchNet,
            "launchWinClose" => $this->launchWinClose
        ];
    }

    /**
     * @return DateTime
     */
    public function getLaunchWinOpen(): DateTime
    {
        return $this->launchWinOpen;
    }

    /**
     * @return DateTime
     */
    public function getLaunchWinClose(): DateTime
    {
        return $this->launchWinClose;
    }

    /**
     * @return DateTime
     */
    public function getLaunchNet(): DateTime
    {
        return $this->launchNet;
    }

    /**
     * @param DateTime $launchNet
     * @return LaunchTime
     */
    public function setLaunchNet(DateTime $launchNet): LaunchTime
    {
        $this->launchNet = $launchNet;

        return $this;
    }

    /**
     * @param DateTime $launchWinClose
     * @return LaunchTime
     */
    public function setLaunchWinClose(DateTime $launchWinClose): LaunchTime
    {
        $this->launchWinClose = $launchWinClose;

        return $this;
    }

    /**
     * @param DateTime $launchWinOpen
     * @return LaunchTime
     */
    public function setLaunchWinOpen(DateTime $launchWinOpen): LaunchTime
    {
        $this->launchWinOpen = $launchWinOpen;

        return $this;
    }
}
