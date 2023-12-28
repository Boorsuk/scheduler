<?php
declare(strict_types=1);
namespace Scheduler\Builder;

use Scheduler\Contract\Builder;
use Scheduler\Contract\Job;
use Scheduler\GenericConfig;
use Scheduler\Job\CallableJob;
use Scheduler\Scheduler;

class CallableBuilder extends Builder
{
    private $callback;
    private $args;

    public function __construct($callback, array $args) {
        $this->callback = $callback;
        $this->args = $args;
    }

    public function build(): Job {
        return new CallableJob(
            $this->callback,
            $this->args,
            GenericConfig::createFromArray($this->config)
        );
    }

    public function buildAndRegister(Scheduler $scheduler): Job {
        $job = $this->build();
        $scheduler->register($job);
        return $job;
    }

}