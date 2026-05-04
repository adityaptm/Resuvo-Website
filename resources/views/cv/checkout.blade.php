@extends('layouts.app')

@section('title', 'Pembayaran - RESUVO')

@section('content')
<div class="container" style="padding-top: 150px; padding-bottom: 100px; text-align: center;">
    <div style="max-width: 500px; margin: 0 auto; background: #fff; padding: 50px; border-radius: var(--radius-lg); box-shadow: var(--shadow-lg);">
        <div style="background: rgba(244, 180, 0, 0.1); width: 80px; height: 80px; border-radius: 50%; display: flex; align-items: center; justify-content: center; margin: 0 auto 25px;">
            <i class="fas fa-crown" style="font-size: 2.5rem; color: var(--accent-color);"></i>
        </div>
        <h2 style="margin-bottom: 10px; color: var(--primary-color); font-weight: 800;">Buka Template Premium</h2>
        <p style="color: var(--text-muted); margin-bottom: 30px;">Dapatkan akses unduhan PDF berkualitas tinggi dan hilangkan watermark selamanya.</p>
        
        <div style="text-align: left; margin-bottom: 30px; background: #f8fafc; padding: 25px; border-radius: var(--radius-md); border: 1px solid #e2e8f0;">
            <div style="display: flex; justify-content: space-between; margin-bottom: 15px;">
                <span style="color: #64748b;">Produk:</span>
                <span style="font-weight: 700;">CV ATS Premium</span>
            </div>
            <div style="display: flex; justify-content: space-between; font-size: 1.2rem; border-top: 1px dashed #cbd5e1; pt: 15px; margin-top: 15px; padding-top: 15px;">
                <span style="font-weight: 800;">Total:</span>
                <span style="font-weight: 800; color: var(--primary-color);">Rp 15.000</span>
            </div>
        </div>

        <a href="{{ route('payment.success', $cv->slug) }}" class="btn btn-primary btn-block btn-lg" style="box-shadow: var(--shadow-accent);">Bayar Sekarang (Simulasi)</a>
        
        <div style="margin-top: 30px; display: flex; justify-content: center; gap: 15px; opacity: 0.5;">
            <i class="fab fa-cc-visa fa-2x"></i>
            <i class="fab fa-cc-mastercard fa-2x"></i>
            <i class="fas fa-qrcode fa-2x"></i>
            <i class="fas fa-university fa-2x"></i>
        </div>
        <p style="margin-top: 20px; font-size: 0.75rem; color: var(--text-muted);">Metode Pembayaran Aman & Terenkripsi</p>
    </div>
</div>
@endsection
