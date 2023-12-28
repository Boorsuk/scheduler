<?php
declare(strict_types=1);
namespace Scheduler;

use Scheduler\Builder\CallableBuilder;
use Scheduler\Contract\Builder;
use Scheduler\Contract\Job;
use Scheduler\Trait\DateTimeTrait;

final class Scheduler
{
    use DateTimeTrait;
    private array $registeredJobs = [];
    
    public function register(Job ...$jobs): self {
        foreach ($jobs as $job) {
            $this->registeredJobs[] = $job;
        }
        return $this;
    }

    public function run(\DateTimeInterface|string|null $now = null)
    {
        foreach ($this->prepareQue($now) as $job) {
            $this->startJob($job);
        }
    }

    public function call(\Closure $callback, array $args): Builder&CallableBuilder
    {
        return new CallableBuilder($callback, $args);
    }

    private function prepareQue(\DateTimeInterface|string|null $now): array
    {
        $now = $this->prepareDateTime($now);
        $que = [];

        /** @var Job $job */
        foreach ($this->registeredJobs as $job) {
            if($job->isDue($now)) {
                $que[] = $job;
            }
        }

        return $que;
    }

    private function startJob(Job $job)
    {
        /** @todo handle statuses and mark failed jobs */
        $status = $job->start();
    }
}