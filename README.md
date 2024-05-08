# psr/log for JobRunner

[![Build Status](https://github.com/job-runner/psr-log-adapter/actions/workflows/continuous-integration.yml/badge.svg)](https://github.com/job-runner/psr-log-adapter/actions/workflows/continuous-integration.yml)
[![Type Coverage](https://shepherd.dev/github/job-runner/psr-log-adapter/coverage.svg)](https://shepherd.dev/github/job-runner/psr-log-adapter)
[![Type Coverage](https://shepherd.dev/github/job-runner/psr-log-adapter/level.svg)](https://shepherd.dev/github/job-runner/psr-log-adapter)
[![Latest Stable Version](https://poser.pugx.org/job-runner/psr-log-adapter/v/stable)](https://packagist.org/packages/job-runner/psr-log-adapter)
[![License](https://poser.pugx.org/job-runner/psr-log-adapter/license)](https://packagist.org/packages/job-runner/psr-log-adapter)

This package provides a psr-log adapter for JobRunner.

## Installation

````bash
composer require job-runner/psr-log-adapter
````

## Usage

````php
<?php

declare(strict_types=1);

use JobRunner\JobRunner\Job\CliJob;
use JobRunner\JobRunner\Job\JobList;
use JobRunner\JobRunner\CronJobRunner;
use JobRunner\JobRunner\PsrLog\PsrLogEventListener;

require 'vendor/autoload.php';


$myLogger = new \Psr\Log\NullLogger();
$jobList = new JobList();
$jobList->push(new CliJob('php ' . __DIR__ . '/tutu.php', '* * * * *'));

CronJobRunner::create()->withEventListener(new PsrLogEventListener($myLogger));->run($jobList);

````
