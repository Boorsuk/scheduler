<?php
declare(strict_types=1);
namespace Scheduler;

use Cron\CronExpression;

class GenericConfig
{
    public const TIMEZONE_KEY = 'timezone';
    public const CRON_EXPRESSION_KEY = 'cronExpression';

    public function __construct(
        public readonly ?\DateTimeZone $timezone = null,
        public readonly ?CronExpression $cronExpression = null
    ) {}

    public static function createFromArray(array $args): self {
        return new GenericConfig(
            $args[self::TIMEZONE_KEY] ?? null,
            $args[self::CRON_EXPRESSION_KEY] ?? null
        );
    }
}