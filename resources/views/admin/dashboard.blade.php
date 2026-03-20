<!-- Site Ayarları -->
<section style="margin-top: 60px;">

    @if(session('success'))
        <div style="display:flex; align-items:center; gap:8px; background:rgba(34,197,94,0.12); border:1px solid rgba(74,222,128,0.3); border-radius:8px; padding:10px 16px; margin-bottom:24px; font-size:13px; color:#4ade80;">
            <svg width="14" height="14" viewBox="0 0 16 16" fill="none" stroke="currentColor" stroke-width="2"><polyline points="2 8 6 12 14 4"/></svg>
            {{ session('success') }}
        </div>
    @endif

    <form action="{{ route('admin.settings.update') }}" method="POST">
        @csrf

        @php
            $sections = [
                'Hero Bölümü' => [
                    'icon' => '🚀',
                    'sub'  => 'Ana sayfa üst alan içerikleri',
                    'fields' => [
                        'hero_badge'          => 'Badge Yazısı',
                        'hero_title'          => 'Başlık',
                        'hero_btn_primary'    => 'Birinci Buton',
                        'hero_btn_secondary'  => 'İkinci Buton',
                        'hero_description'    => 'Açıklama',
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
                'Creations Ülke' => [
                    'icon' => '✦',
                    'sub'  => 'Gezilen Ülke',
                    'fields' => [
                        'creations_country_title'       => 'Başlık',
                        'creations_country_description' => 'Açıklama',
                    ],
                ],
                'About Bölümü' => [
                    'icon' => '💡',
                    'sub'  => 'Uygulama hakkında bilgi',
                    'fields' => [
                        'about_title'       => 'Başlık',
                        'about_description' => 'Açıklama',
                    ],
                ],
                'Testimonials Bölümü' => [
                    'icon' => '💬',
                    'sub'  => 'Müşteri yorumları başlığı',
                    'fields' => [
                        'testimonials_title'       => 'Başlık',
                        'testimonials_description' => 'Açıklama',
                    ],
                ],
                'Footer Bölümü' => [
                    'icon' => '📄',
                    'sub'  => 'Alt bilgi alanı',
                    'fields' => [
                        'footer_description' => 'Footer Açıklama',
                    ],
                ],
            ];

            $textareas = $sections;
        @endphp

        @foreach($sections as $sectionTitle => $section)
            <div style="background:#151525; border:1px solid rgba(99,102,241,0.18); border-radius:14px; overflow:hidden; margin-bottom:20px;">

                {{-- Kart Başlığı --}}
                <div style="padding:16px 22px; border-bottom:1px solid rgba(99,102,241,0.18); display:flex; align-items:center; gap:10px;">
                    <div style="width:28px; height:28px; border-radius:7px; background:rgba(79,70,229,0.15); border:1px solid rgba(99,102,241,0.32); display:flex; align-items:center; justify-content:center; font-size:14px;">
                        {{ $section['icon'] }}
                    </div>
                    <div>
                        <div style="font-size:13px; font-weight:500; color:#c7d2fe;">{{ $sectionTitle }}</div>
                        <div style="font-size:11px; color:#64748b;">{{ $section['sub'] }}</div>
                    </div>
                </div>

                {{-- Alanlar --}}
                <div style="display:grid; grid-template-columns:1fr 1fr;">
                    @foreach($section['fields'] as $key => $label)
                        @php
                            $isTextarea = in_array($key, $textareas);
                            $isLast = $loop->last;
                            $isOdd = $loop->odd;
                        @endphp
                        <div style="padding:14px 22px;
                            {{ !$isLast ? 'border-bottom:1px solid rgba(99,102,241,0.18);' : '' }}
                            {{ !$isTextarea && $isOdd ? 'border-right:1px solid rgba(99,102,241,0.18);' : '' }}
                            {{ $isTextarea ? 'grid-column:1/-1;' : '' }}
                            display:flex; flex-direction:column; gap:6px;">
                            <label style="font-size:11px; color:#64748b; font-weight:500; text-transform:uppercase; letter-spacing:0.06em;">{{ $label }}</label>
                            @if($isTextarea)
                                <textarea name="{{ $key }}" rows="3" style="background:#0f0f1a; border:1px solid rgba(99,102,241,0.18); border-radius:7px; padding:8px 12px; font-size:13px; color:#f1f0ff; outline:none; width:100%; box-sizing:border-box; resize:vertical; font-family:inherit; line-height:1.5;">{{ $settings[$key] ?? '' }}</textarea>
                            @else
                                <input type="text" name="{{ $key }}" value="{{ $settings[$key] ?? '' }}" style="background:#0f0f1a; border:1px solid rgba(99,102,241,0.18); border-radius:7px; padding:8px 12px; font-size:13px; color:#f1f0ff; outline:none; width:100%; box-sizing:border-box;">
                            @endif
                        </div>
                    @endforeach
                </div>

            </div>
        @endforeach

        {{-- Kaydet --}}
        <div style="display:flex; justify-content:flex-end;">
            <button type="submit" style="background:#4f46e5; border:none; color:white; padding:10px 24px; border-radius:8px; font-size:14px; font-weight:500; cursor:pointer; display:flex; align-items:center; gap:6px;">
                <svg width="13" height="13" viewBox="0 0 16 16" fill="none" stroke="currentColor" stroke-width="2"><polyline points="2 8 6 12 14 4"/></svg>
                Kaydet
            </button>
        </div>

    </form>
</section>
