<?php
declare(strict_types=1);
namespace Scheduler\Job;

use Scheduler\GenericConfig;
use Scheduler\JobStatus;

class CallableJob extends GenericJob 
{
    public function __construct($callback, array $args, GenericConfig $config)
    {
        
    }

    public function start(): JobStatus {
        echo 'TEST!';
        return JobStatus::FINISHED;
    }

}