<?php

declare(strict_types=1);

namespace App\Models;

use DateTime;

class LaunchTime
{

    /**
     * @var DateTime
     */
    private DateTime $launchWinOpen;

    /**
     * @var DateTime
     */
    private DateTime $launchWinClose;

    /**
     * @var DateTime
     */
    private DateTime $launchNet;

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
