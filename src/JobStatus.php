<?php
declare(strict_types=1);
namespace Scheduler;

enum JobStatus: int
{
    case FAILED     = -1;
    case FINISHED   = 1;
}