<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Http;

class HomeController
{
    public function index()
    {
        $posts = DB::table('posts')->orderBy('created_at', 'desc')->get();
        $settings = DB::table('site_settings')->pluck('value', 'key')->toArray();

        $crypto = Cache::remember('crypto', 60, function () {
            try {
                $response = Http::timeout(5)->get('https://api.coingecko.com/api/v3/coins/markets', [
                    'vs_currency' => 'usd',
                    'ids' => 'bitcoin,ethereum',
                    'price_change_percentage' => '24h',
                ]);

                $data = $response->json();

                if (empty($data) || ! is_array($data)) {
                    return Cache::get('crypto') ?? collect([]);
                }

                return collect($data)->keyBy('id');
            } catch (\Exception $e) {
                return Cache::get('crypto') ?? collect([]);
            }
        });

        $gold = Cache::remember('gold', 60, function () {
            try {
                $response = Http::timeout(5)->get('https://finans.truncgil.com/today.json');
                $data = $response->json();

                $gramAltin = (float) str_replace(['.', ','], ['', '.'], $data['gram-altin']['Satış']);

                return [
                    'gram_try' => number_format($gramAltin, 2, ',', '.'),
                ];
            } catch (\Exception $e) {
                return Cache::get('gold') ?? [];
            }
        });

        return view('home', compact('posts', 'settings', 'crypto', 'gold'));
    }

    public function getCrypto()
    {
        $crypto = Cache::remember('crypto', 60, function () {
            try {
                $response = Http::timeout(5)->get('https://api.coingecko.com/api/v3/coins/markets', [
                    'vs_currency' => 'usd',
                    'ids' => 'bitcoin,ethereum',
                    'price_change_percentage' => '24h',
                ]);

                $data = $response->json();

                if (empty($data) || ! is_array($data)) {
                    return Cache::get('crypto') ?? collect([]);
                }

                return $data;
            } catch (\Exception $e) {
                return Cache::get('crypto') ?? collect([]);
            }
        });

        return response()->json($crypto);
    }

    public function getGold()
    {
        $gold = Cache::remember('gold', 60, function () {
            try {
                $response = Http::timeout(5)->get('https://finans.truncgil.com/today.json');
                $data = $response->json();

                // gram altın ve ons fiyatlarını al
                $gramAltin = (float) str_replace(['.', ','], ['', '.'], $data['gram-altin']['Satış']);

                return [
                    'gram_try' => number_format($gramAltin, 2, ',', '.'),
                ];
            } catch (\Exception $e) {
                return Cache::get('gold') ?? [];
            }
        });

        return response()->json($gold);
    }
}
