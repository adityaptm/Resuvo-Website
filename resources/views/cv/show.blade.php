@extends('layouts.app')

@section('title', 'CV Anda - RESUVO')

@section('styles')
<style>
    .cv-view-container {
        padding-top: 100px;
        padding-bottom: 80px;
        background-color: #f1f5f9;
        min-height: 100vh;
    }
    .cv-paper {
        background: #fff;
        width: 100%;
        max-width: 210mm; /* A4 Width */
        min-height: 297mm; /* A4 Height */
        margin: 0 auto;
        padding: 10mm 15mm; /* Slightly smaller padding for mobile */
        box-shadow: 0 0 20px rgba(0,0,0,0.1);
        font-family: 'Times New Roman', Times, serif;
        color: #000;
        font-size: 10.5pt;
        line-height: 1.3;
        position: relative;
    }
    @media (min-width: 768px) {
        .cv-paper {
            padding: 15mm 20mm;
        }
    }
    .cv-header {
        text-align: center;
        margin-bottom: 15px;
    }
    .cv-header h1 {
        font-size: 18pt;
        text-transform: uppercase;
        font-weight: bold;
        margin-bottom: 2px;
    }
    .cv-contact {
        display: flex;
        justify-content: center;
        gap: 8px;
        font-size: 9.5pt;
    }
    .cv-section {
        margin-top: 12px;
        margin-bottom: 5px;
    }
    .cv-section-title {
        font-size: 11pt;
        font-weight: bold;
        text-transform: uppercase;
        border-bottom: 1px solid #000;
        margin-bottom: 5px;
        padding-bottom: 1px;
    }
    .cv-item {
        margin-bottom: 8px;
    }
    .cv-item-header {
        display: flex;
        justify-content: space-between;
        font-weight: bold;
    }
    .cv-item-sub {
        display: flex;
        justify-content: space-between;
        font-style: italic;
        font-size: 10pt;
    }
    .cv-desc {
        margin-top: 3px;
        text-align: justify;
        white-space: pre-line;
        font-size: 10pt;
    }
    .cv-desc ul {
        padding-left: 15px;
        margin: 0;
    }
    .cv-desc li {
        margin-bottom: 2px;
    }

    @media print {
        body { background: #fff !important; }
        .cv-view-container { padding: 0 !important; }
        body * { visibility: hidden; }
        .cv-paper, .cv-paper * { visibility: visible; }
        .cv-paper {
            position: absolute;
            left: 0;
            top: 0;
            box-shadow: none !important;
            margin: 0 !important;
            width: 100% !important;
        }
        .no-print { display: none !important; }
    }
    
    .floating-actions {
        position: fixed;
        bottom: 30px;
        right: 30px;
        display: flex;
        gap: 15px;
        z-index: 100;
    }
    
    .watermark {
        position: absolute;
        top: 50%;
        left: 50%;
        transform: translate(-50%, -50%) rotate(-45deg);
        font-size: 80pt;
        color: rgba(0,0,0,0.05);
        pointer-events: none;
        z-index: 10;
        white-space: nowrap;
        text-transform: uppercase;
        font-weight: 900;
    }
</style>
@endsection

@section('content')
<div class="cv-view-container">
    <div class="container">
        @if(!$cv->is_paid)
        <div class="alert alert-warning no-print" style="max-width: 210mm; margin: 0 auto 20px; border-left: 5px solid #000; background: #fff; padding: 20px; border-radius: 4px; box-shadow: 0 4px 6px rgba(0,0,0,0.05); display: flex; justify-content: space-between; align-items: center;">
            <div>
                <h4 style="color: #000; margin-bottom: 5px; font-weight: bold;"><i class="fas fa-lock"></i> Pratinjau Terbatas (Bentuk ATS Asli)</h4>
                <p style="margin: 0; color: #333; font-size: 0.9rem;">Selesaikan pembayaran untuk menghilangkan watermark dan mengunduh PDF resmi.</p>
            </div>
            <a href="{{ route('payment.checkout', $cv->slug) }}" class="btn btn-primary" style="background: #000; color: #fff; border: none;">Bayar Rp 15.000</a>
        </div>
        @endif

        <div class="cv-paper" id="cv-paper" style="position: relative;">
            @if(!$cv->is_paid)
                <div class="watermark">PREVIEW ONLY</div>
            @endif
            
            <div class="cv-header" style="display:flex; align-items:flex-start; gap:15px; margin-bottom:15px;">
                @if(!empty($cv->content['personal']['photo']))
                <img src="{{ $cv->content['personal']['photo'] }}" alt="Foto Profil" style="width:90px;height:90px;object-fit:cover;border-radius:4px;flex-shrink:0;">
                @endif
                <div style="flex:1;text-align:left;">
                    <h1 style="font-size:16pt;text-transform:uppercase;font-weight:bold;margin-bottom:2px;">{{ $cv->content['personal']['full_name'] ?? 'NAMA LENGKAP ANDA' }}</h1>
                    @if(!empty($cv->content['personal']['title']))
                    <div style="font-style:italic;color:#333;margin-bottom:4px;font-size:10pt;">{{ $cv->content['personal']['title'] }}</div>
                    @endif
                    <div class="cv-contact" style="justify-content:flex-start;flex-wrap:wrap;gap:5px;font-size:9pt;">
                        <span>{{ $cv->content['personal']['address'] ?? '' }}</span>
                        @if(!empty($cv->content['personal']['phone'])) <span> | {{ $cv->content['personal']['phone'] }}</span> @endif
                        @if(!empty($cv->content['personal']['email'])) <span> | {{ $cv->content['personal']['email'] }}</span> @endif
                        @if(!empty($cv->content['personal']['linkedin'])) <span> | {{ $cv->content['personal']['linkedin'] }}</span> @endif
                        @if(!empty($cv->content['personal']['website'])) <span> | {{ $cv->content['personal']['website'] }}</span> @endif
                    </div>
                </div>
            </div>
            <hr style="border:none;border-top:1.5px solid #000;margin-bottom:12px;">

            @if(!empty($cv->content['personal']['summary']))
            <div class="cv-section">
                <div class="cv-section-title">Professional Summary</div>
                <div class="cv-desc">{{ $cv->content['personal']['summary'] }}</div>
            </div>
            @endif

            @if(!empty($cv->content['experience']))
            <div class="cv-section">
                <div class="cv-section-title">Work Experience</div>
                @foreach($cv->content['experience'] as $exp)
                    @if(!empty($exp['company']))
                    @php
                        $months = ['01'=>'Jan','02'=>'Feb','03'=>'Mar','04'=>'Apr','05'=>'Mei','06'=>'Jun','07'=>'Jul','08'=>'Agu','09'=>'Sep','10'=>'Okt','11'=>'Nov','12'=>'Des'];
                        $startLabel = !empty($exp['start_month']) ? ($months[$exp['start_month']] ?? '') . ' ' . ($exp['start_year'] ?? '') : '';
                        $endLabel = (!empty($exp['end_month']) && !empty($exp['end_year'])) ? ($months[$exp['end_month']] ?? '') . ' ' . ($exp['end_year'] ?? '') : 'Sekarang';
                        $period = $startLabel ? $startLabel . ' - ' . $endLabel : '';
                    @endphp
                    <div class="cv-item">
                        <div class="cv-item-header">
                            <span><strong>{{ $exp['company'] }}</strong>@if(!empty($exp['location'])) - {{ $exp['location'] }}@endif</span>
                            <span>{{ $period }}</span>
                        </div>
                        <div class="cv-item-sub"><span>{{ $exp['role'] ?? '' }}</span></div>
                        <div class="cv-desc">
                            @if(!empty($exp['desc']))
                                <ul>@foreach(explode("\n",$exp['desc']) as $line)@if(trim($line)!='')<li>{{ ltrim(trim($line),'-') }}</li>@endif @endforeach</ul>
                            @endif
                        </div>
                    </div>
                    @endif
                @endforeach
            </div>
            @endif

            @if(!empty($cv->content['education']))
            <div class="cv-section">
                <div class="cv-section-title">Education</div>
                @foreach($cv->content['education'] as $edu)
                    @if(!empty($edu['school']))
                    @php
                        $months = ['01'=>'Jan','02'=>'Feb','03'=>'Mar','04'=>'Apr','05'=>'Mei','06'=>'Jun','07'=>'Jul','08'=>'Agu','09'=>'Sep','10'=>'Okt','11'=>'Nov','12'=>'Des'];
                        $sM = !empty($edu['start_month']) ? ($months[$edu['start_month']] ?? '') : '';
                        $sY = $edu['start_year'] ?? '';
                        $eM = !empty($edu['end_month']) ? ($months[$edu['end_month']] ?? '') : '';
                        $eY = $edu['end_year'] ?? '';
                        $period = $sY ? trim("$sM $sY") . ' - ' . ($eY ? trim("$eM $eY") . ' (Expected)' : 'Sekarang') : '';
                    @endphp
                    <div class="cv-item">
                        <div class="cv-item-header">
                            <span><strong>{{ $edu['school'] }}</strong>@if(!empty($edu['location'])) - {{ $edu['location'] }}@endif</span>
                            <span>{{ $period }}</span>
                        </div>
                        <div class="cv-item-sub">
                            <span>{{ $edu['degree_level'] ?? '' }}{{ !empty($edu['major']) ? ' of ' . $edu['major'] : '' }}</span>
                            @if(!empty($edu['gpa']))<span>{{ $edu['gpa'] }}/{{ $edu['gpa_max'] ?? '4.00' }}</span>@endif
                        </div>
                        @if(!empty($edu['activities']))
                        <div class="cv-desc">
                            <ul>@foreach(explode("\n",$edu['activities']) as $line)@if(trim($line)!='')<li>{{ ltrim(trim($line),'-') }}</li>@endif @endforeach</ul>
                        </div>
                        @endif
                    </div>
                    @endif
                @endforeach
            </div>
            @endif

            @if(!empty($cv->content['organization']))
            <div class="cv-section">
                <div class="cv-section-title">Organization Experience</div>
                @foreach($cv->content['organization'] as $org)
                    @if(!empty($org['name']))
                    @php
                        $months = ['01'=>'Jan','02'=>'Feb','03'=>'Mar','04'=>'Apr','05'=>'Mei','06'=>'Jun','07'=>'Jul','08'=>'Agu','09'=>'Sep','10'=>'Okt','11'=>'Nov','12'=>'Des'];
                        $sLabel = !empty($org['start_month']) ? ($months[$org['start_month']] ?? '') . ' ' . ($org['start_year'] ?? '') : '';
                        $isCurrent = !empty($org['current']);
                        $eLabel = (!empty($org['end_month']) && !empty($org['end_year']) && !$isCurrent) ? ($months[$org['end_month']] ?? '') . ' ' . ($org['end_year'] ?? '') : ($isCurrent ? 'Sekarang' : '');
                        $period = $sLabel ? $sLabel . ($eLabel ? ' - ' . $eLabel : '') : '';
                    @endphp
                    <div class="cv-item">
                        <div class="cv-item-header">
                            <span><strong>{{ $org['name'] }}</strong>@if(!empty($org['location'])) - {{ $org['location'] }}@endif</span>
                            <span>{{ $period }}</span>
                        </div>
                        <div class="cv-item-sub"><span>{{ $org['role'] ?? '' }}</span></div>
                        <div class="cv-desc">
                            @if(!empty($org['desc']))
                                <ul>@foreach(explode("\n",$org['desc']) as $line)@if(trim($line)!='')<li>{{ ltrim(trim($line),'-') }}</li>@endif @endforeach</ul>
                            @endif
                        </div>
                    </div>
                    @endif
                @endforeach
            </div>
            @endif

            @if(!empty($cv->content['skills']) || !empty($cv->content['other']['languages']))
            <div class="cv-section">
                <div class="cv-section-title">Skills & Achievements</div>
                <div class="cv-desc">
                    @if(!empty($cv->content['skills']))
                        @foreach($cv->content['skills'] as $skill)
                            @if(!empty($skill['detail']))<div><strong>{{ $skill['category'] ?? 'Skills' }}:</strong> {{ $skill['detail'] }}</div>@endif
                        @endforeach
                    @endif
                    @if(!empty($cv->content['other']['languages']))
                        <div><strong>Languages:</strong> {{ $cv->content['other']['languages'] }}</div>
                    @endif
                </div>
            </div>
            @endif
        </div>
    </div>

    <div class="floating-actions no-print">
        <button onclick="window.print()" class="btn btn-primary btn-lg shadow-lg" style="background: #000; color: #fff; border: none;" {{ !$cv->is_paid ? 'disabled' : '' }}>
            <i class="fas fa-download"></i> Cetak ke PDF
        </button>
        <a href="{{ route('cv.create') }}" class="btn btn-outline btn-lg shadow-lg" style="background: #fff; border: 2px solid #000; color: #000;">
            <i class="fas fa-edit"></i> Edit CV
        </a>
    </div>
</div>
@endsection
