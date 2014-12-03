<?php

namespace Ibrows\Tests\DataTrans;

use Psr\Log\AbstractLogger;

class Logger extends AbstractLogger
{
    /**
     * @var array
     */
    protected $logEntries = array();

    /**
     * Logs with an arbitrary level.
     *
     * @param  mixed  $level
     * @param  string $message
     * @param  array  $context
     * @return null
     */
    public function log($level, $message, array $context = array())
    {
        if (!isset($this->logEntries[$level])) {
            $this->logEntries[$level] = array();
        }

        $this->logEntries[$level][] = $message;
    }

    /**
     * @return array
     */
    public function getLogEntries()
    {
        return $this->logEntries;
    }
}
