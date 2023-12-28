<?php
declare(strict_types=1);
namespace Scheduler\Contract;

use Scheduler\Contract\Job;
use Scheduler\Exception\InvalidTimezoneException;
use Scheduler\GenericConfig;
use Scheduler\Scheduler;

abstract class Builder
{
    protected array $config = []; 

    public function timezone(string|\DateTimeZone $timezone): static {
        if(is_string($timezone)) {
            try {
                $timezone = new \DateTimeZone($timezone);
            } catch (\Throwable $ex) {
                throw new InvalidTimezoneException('invalid timezone: ' . $timezone);
            }
        }

        $config[GenericConfig::TIMEZONE_KEY] = $timezone;
        return $this;
    }

    abstract public function build(): Job;
    abstract public function buildAndRegister(Scheduler $scheduler): Job;
}