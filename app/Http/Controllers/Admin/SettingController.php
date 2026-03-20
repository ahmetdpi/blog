<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class SettingController
{
    private array $sections = [
        'Hero Bölümü' => [
            'icon' => '+',
            'sub' => 'Ana sayfa üst alan içerikleri',
            'fields' => [
                'hero_badge' => 'Badge Yazısı',
                'hero_title' => 'Başlık',
                'hero_btn_primary' => 'Birinci Buton',
                'hero_btn_secondary' => 'İkinci Buton',
                'hero_description' => 'Açıklama',
            ],
        ],
        'Creations Bölümü' => [
            'icon' => '✦',
            'sub' => 'Öne çıkan çalışmalar alanı',
            'fields' => [
                'creations_title' => 'Başlık',
                'creations_description' => 'Açıklama',
            ],
        ],
        'Creations Ülke' => [
            'icon' => '✦',
            'sub' => 'Gezilen Ülke Yazıları',
            'fields' => [
                'creations_country_image1'       => 'Görsel URL 1',
                'creations_country_title1'       => 'Başlık 1',
                'creations_country_description1' => 'Açıklama 1',
                'creations_country_image2'       => 'Görsel URL 2',
                'creations_country_title2'       => 'Başlık 2',
                'creations_country_description2' => 'Açıklama 2',
                'creations_country_image3'       => 'Görsel URL 3',
                'creations_country_title3'       => 'Başlık 3',
                'creations_country_description3' => 'Açıklama 3',
                'creations_country_image4'       => 'Görsel URL 4',
                'creations_country_title4'       => 'Başlık 4',
                'creations_country_description4' => 'Açıklama 4',
            ],
        ],
        'About Bölümü' => [
            'icon' => '💡',
            'sub' => 'Uygulama hakkında bilgi',
            'fields' => [
                'about_title' => 'Başlık',
                'about_description' => 'Açıklama',
            ],
        ],
        'Testimonials Bölümü' => [
            'icon' => '💬',
            'sub' => 'Müşteri yorumları başlığı',
            'fields' => [
                'testimonials_title' => 'Başlık',
                'testimonials_description' => 'Açıklama',
            ],
        ],
        'Footer Bölümü' => [
            'icon' => '📄',
            'sub' => 'Alt bilgi alanı',
            'fields' => [
                'footer_description' => 'Footer Açıklama',
            ],
        ],
    ];

    private array $textareas = [
        'hero_description',
        'creations_description',
        'creations_country_description1',
        'creations_country_description2',
        'creations_country_description3',
        'about_description',
        'testimonials_description',
        'footer_description',
    ];

    public function index()
    {
        $settings = DB::table('site_settings')->pluck('value', 'key')->toArray();

        return view('admin.settings', [
            'settings' => $settings,
            'sections' => $this->sections,
            'textareas' => $this->textareas,
        ]);
    }

    public function update(Request $request)
    {
        $allFields = collect($this->sections)
            ->flatMap(fn ($section) => array_keys($section['fields']))
            ->toArray();

        foreach ($allFields as $key) {
            DB::table('site_settings')->updateOrInsert(
                ['key' => $key],
                ['value' => $request->input($key, '')]
            );
        }

        return redirect()->route('admin.settings.index')->with('success', 'Ayarlar kaydedildi.');
    }
}
