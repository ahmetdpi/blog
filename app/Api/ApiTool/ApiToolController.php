<?php

namespace App\Api\ApiTool;

use App\Http\Controllers\Controller;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Artisan;
use Symfony\Component\Console\Output\StreamOutput;

class ApiToolController extends Controller
{
    public function gitPull(): JsonResponse
    {
        // Git Pull
        $result = exec('cd '.base_path().' && git pull');

        // Artisan Optimize
        ob_start();
        $stream = fopen('php://output', 'w');
        Artisan::call('optimize', [], new StreamOutput($stream));
        $optimizeLogs = ob_get_contents();
        ob_end_clean();
        $optimizeLogs = trim(preg_replace('/\s+/', ' ', $optimizeLogs));

        // Queue Restart
        ob_start();
        $stream = fopen('php://output', 'w');
        Artisan::call('queue:restart', [], new StreamOutput($stream));
        $queueRestartLogs = ob_get_contents();
        ob_end_clean();
        $queueRestartLogs = trim(preg_replace('/\s+/', ' ', $queueRestartLogs));

        // Op Cache
        $opCacheLog = opcache_reset() ? 'OpCache cache was cleared successfully.' : 'OpCache clearing failed.';

        return response()->json([
            'status' => true,
            'message' => $result.' '.$optimizeLogs.' '.$queueRestartLogs.' '.$opCacheLog,
        ]);
    }
}
