<?php
declare(strict_types=1);
namespace Scheduler\Trait;

trait DateTimeTrait
{
    private function prepareDateTime(
        \DateTimeInterface|string|null $now = null,
        ?\DateTimeZone $timezone = null
    ): \DateTimeInterface
    {
        if($now instanceof \DateTime) {
            $now = clone $now;
        } else if(is_string($now) || is_null($now)) {
            $now = new \DateTime($now ?? 'now');
        }
        
        if($timezone) {
            /** @var \DateTime|\DateTimeImmutable $now */
            $now = $now->setTimezone($timezone);
        }

        return $now;
    }
}