<?php

use Monolog\Handler\StreamHandler;
use Monolog\Handler\SyslogUdpHandler;

return [

    /*
    |--------------------------------------------------------------------------
    | Default Log Channel
    |--------------------------------------------------------------------------
    |
    | This option defines the default log channel that gets used when writing
    | messages to the logs. The name specified in this option should match
    | one of the channels defined in the "channels" configuration array.
    |
    */

    'default' => env('LOG_CHANNEL', 'stack'),

    /*
    |--------------------------------------------------------------------------
    | Log Channels
    |--------------------------------------------------------------------------
    |
    | Here you may configure the log channels for your application. Out of
    | the box, Laravel uses the Monolog PHP logging library. This gives
    | you a variety of powerful log handlers / formatters to utilize.
    |
    | Available Drivers: "single", "daily", "slack", "syslog",
    |                    "errorlog", "monolog",
    |                    "custom", "stack"
    |
    */

    'channels' => [
        'stack' => [
            'driver' => 'stack',
            'channels' => ['daily'],
            'ignore_exceptions' => false,
        ],

        'single' => [
            'driver' => 'single',
            'path' => storage_path('logs/laravel.log'),
            'level' => 'debug',
        ],

        'daily' => [
            'driver' => 'daily',
            'path' => storage_path('logs/laravel.log'),
            'level' => 'debug',
            'days' => 14,
        ],

        'slack' => [
            'driver' => 'slack',
            'url' => env('LOG_SLACK_WEBHOOK_URL'),
            'username' => 'Laravel Log',
            'emoji' => ':boom:',
            'level' => 'critical',
        ],

        'papertrail' => [
            'driver' => 'monolog',
            'level' => 'debug',
            'handler' => SyslogUdpHandler::class,
            'handler_with' => [
                'host' => env('PAPERTRAIL_URL'),
                'port' => env('PAPERTRAIL_PORT'),
            ],
        ],

        'stderr' => [
            'driver' => 'monolog',
            'handler' => StreamHandler::class,
            'formatter' => env('LOG_STDERR_FORMATTER'),
            'with' => [
                'stream' => 'php://stderr',
            ],
        ],

        'syslog' => [
            'driver' => 'syslog',
            'level' => 'debug',
        ],

        'errorlog' => [
            'driver' => 'errorlog',
            'level' => 'debug',
        ],

        'buy_ticket' => [
            'driver' => 'single',
            'path' => storage_path('logs/ejackpot/buy_ticket.log')
        ],
        'vault' => [
            'driver' => 'single',
            'path' => storage_path('logs/ejackpot/vault.log')
        ],
        'crate' => [
            'driver' => 'single',
            'path' => storage_path('logs/ejackpot/crate.log')
        ],
        'credit' => [
            'driver' => 'single',
            'path' => storage_path('logs/ejackpot/credit.log')
        ],
        'reward' => [
            'driver' => 'single',
            'path' => storage_path('logs/ejackpot/reward.log')
        ],
        'lottery' => [
            'driver' => 'single',
            'path' => storage_path('logs/ejackpot/lottery.log')
        ],
        'wallet' => [
            'driver' => 'single',
            'path' => storage_path('logs/ejackpot/wallet.log')
        ],
        'withdraw' => [
            'driver' => 'single',
            'path' => storage_path('logs/ejackpot/withdraw.log')
        ],
        'commission' => [
            'driver' => 'single',
            'path' => storage_path('logs/ejackpot/commission.log')
        ]
    ],

];
