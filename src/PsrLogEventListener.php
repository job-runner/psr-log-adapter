<?php

declare(strict_types=1);

namespace JobRunner\JobRunner\PsrLog;

use JobRunner\JobRunner\Event\JobEvent;
use JobRunner\JobRunner\Event\JobFailEvent;
use JobRunner\JobRunner\Event\JobIsLockedEvent;
use JobRunner\JobRunner\Event\JobNotDueEvent;
use JobRunner\JobRunner\Event\JobStartEvent;
use JobRunner\JobRunner\Event\JobSuccessEvent;
use JobRunner\JobRunner\Job\Job;
use Psr\Log\LoggerInterface;

use function sprintf;

final class PsrLogEventListener implements JobEvent, JobFailEvent, JobSuccessEvent, JobStartEvent, JobNotDueEvent, JobIsLockedEvent
{
    public function __construct(private readonly LoggerInterface $logger)
    {
    }

    public function fail(Job $job, string $output): void
    {
        $this->logger->error(sprintf('job %s fail : %s', $job->getName(), $output));
    }

    public function success(Job $job, string $output): void
    {
        $this->logger->info(sprintf('job %s success : %s', $job->getName(), $output));
    }

    public function start(Job $job): void
    {
        $this->logger->debug(sprintf('job %s start', $job->getName()));
    }

    public function notDue(Job $job): void
    {
        $this->logger->debug(sprintf('job %s notDue', $job->getName()));
    }

    public function isLocked(Job $job): void
    {
        $this->logger->debug(sprintf('job %s isLocked', $job->getName()));
    }
}
