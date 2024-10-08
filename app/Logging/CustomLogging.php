<?php

declare(strict_types=1);

namespace App\Logging;

use Monolog\Formatter\JsonFormatter;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Request;
use Monolog\LogRecord;

class CustomLogging extends JsonFormatter
{
    public function __construct()
    {
        parent::__construct(includeStacktraces: true);
    }

    public function format(LogRecord $record): string
    {
        $data = [
            'level' => $record['level_name'],
            'datetime' => $record['datetime']->format('Y-m-d H:i:s.v'),
            'env' => config('app.env'),
            'request_id' => $this->getRequestId(),
            'service' => config('app.name'),
            'client_ip' => $this->getClientIp(),
            'session_id' => $this->getSessionId(),
            'message' => $record['message'],
        ];

        return $this->toJson($data);
    }

    private function getRequestId(): string
    {
        return Request::header('X-Request-ID') ?? (string) Str::uuid();
    }

    private function getClientIp(): string
    {
        if (Request::header('HTTP_X_FORWARDED_FOR')) {
            return Request::header('HTTP_X_FORWARDED_FOR');
        }
        return Request::ip();
    }

    private function getSessionId(): string
    {
        if (Auth::check()) {
            return hash('sha224', session()->getId());
        }
        return '';
    }
}
