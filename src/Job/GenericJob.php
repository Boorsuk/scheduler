<?php
declare(strict_types=1);
namespace Scheduler\Job;

use Cron\CronExpression;
use Scheduler\Contract\Job;
use Scheduler\Trait\DateTimeTrait;

abstract class GenericJob implements Job
{
    use DateTimeTrait;

    protected const DEFAULT_CRON_EXPRESSION = '* * * * *';

    protected ?\DateTimeZone $timezone = null;
    protected ?CronExpression $cronExpression = null;
    protected ?\Throwable $exception = null;

    public function timezone(): \DateTimeZone
    {
        return $this->timezone ?? new \DateTimeZone(date_default_timezone_get());
    }

    public function cronExpression(): CronExpression
    {
        return $this->cronExpression ?? new CronExpression(self::DEFAULT_CRON_EXPRESSION);    
    }

    public function isDue(\DateTimeInterface|string|null $now = null): bool
    {
        $now = $this->prepareDateTime($now, $this->timezone());
        return $this->cronExpression()->isDue($now);
    }
}