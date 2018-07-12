<?php

namespace Webup\LaravelTools;

use Illuminate\Session\Store;

class Flash
{
    private $session;

    public function __construct(Store $session)
    {
        $this->session = $session;
    }

    public function info($message, $key = 'default')
    {
        $this->message($message, 'info', $key);
    }

    public function success($message, $key = 'default')
    {
        $this->message($message, 'success', $key);
    }

    public function error($message, $key = 'default')
    {
        $this->message($message, 'error', $key);
    }

    private function message($message, $level = 'info', $key = 'default')
    {
        $key = 'flash.' . $key;
        $this->session->flash($key, [
            'message' => $message,
            'level' => $level,
        ]);
    }
}
