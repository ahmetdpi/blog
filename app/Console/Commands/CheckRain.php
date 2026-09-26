<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Http;

class CheckRain extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:check-rain';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Execute the console command.
     */
    public function handle(): void
    {
        $data = Http::timeout(5)->get('https://api.open-meteo.com/v1/forecast', [
            'latitude' => 12.24,
            'longitude' => 109.19,
            'hourly' => 'precipitation_probability',
            'timezone' => 'auto',
        ])->json();

        $allRain = $data['hourly']['precipitation_probability'];
        $allTimes = $data['hourly']['time'];

        $currentTime = (int) now()->timezone('Asia/Ho_Chi_Minh')->format('H');

        $next3Rain = array_slice($allRain, $currentTime, 3);
        $next3Time = array_slice($allTimes, $currentTime, 3);

        $rainIs = false;
        foreach ($next3Rain as $possibility) {
            if ($possibility > 70) {
                $rainIs = true;
            }
        }

        $lastState = Cache::get('last_rain_state', false);
        if ($rainIs && ! $lastState) {
            $message = "☔ Yağmur Uyarısı!\n\n";
            foreach ($next3Rain as $i => $oran) {
                $time = $next3Time[$i];
                $message .= "{$time} -> %{$oran}\n";
            }
            $token = env('TELEGRAM_BOT_TOKEN');
            $chatID = env('TELEGRAM_CHAT_ID');

            Http::post("https://api.telegram.org/bot{$token}/sendMessage", [
                'chat_id' => $chatID,
                'text' => $message,
            ]);
        }

        Cache::put('last_rain_state', $rainIs);
    }
}
