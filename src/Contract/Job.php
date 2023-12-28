<?php
declare(strict_types=1);
namespace Scheduler\Contract;

use Cron\CronExpression;
use DateTimeInterface;
use DateTimeZone;
use Scheduler\JobStatus;

interface Job
{
    /**
     * returns cron expression used by Job
     * @return CronExpression 
     */
    public function cronExpression(): CronExpression;

    /**
     * returns timezone used by job
     * @return DateTimeZone 
     */
    public function timezone(): \DateTimeZone;

    /**
     * Main method which start the job
     * @param null|DateTimeInterface $now 
     * @return JobStatus 
     */
    public function start(): JobStatus;

    /**
     * determine if job should be started
     * @param null|DateTimeInterface|string $now 
     * @return bool 
     */
    public function isDue(\DateTimeInterface|string|null $now = null): bool;
}