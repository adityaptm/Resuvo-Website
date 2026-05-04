<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\CvData;
use App\Models\Payment;
use Illuminate\Support\Facades\DB;

class PaymentController extends Controller
{
    /**
     * Initialize payment for a CV.
     */
    public function checkout($slug)
    {
        $cv = CvData::where('slug', $slug)->firstOrFail();
        
        // Inisialisasi data pembayaran sebelum diarahkan ke payment gateway
        $payment = Payment::create([
            'cv_data_id' => $cv->id,
            'amount' => 15000, 
            'status' => 'pending',
        ]);

        // Simulasi proses transaksi untuk keperluan pengembangan awal
        return view('cv.checkout', compact('cv', 'payment'));
    }

    /**
     * Simulate payment success.
     */
    public function simulateSuccess($slug)
    {
        $cv = CvData::where('slug', $slug)->firstOrFail();
        
        DB::transaction(function () use ($cv) {
            $cv->update(['is_paid' => true]);
            $cv->payments()->where('status', 'pending')->update(['status' => 'paid']);
        });

        // Simulasi pengiriman email konfirmasi
        // \Illuminate\Support\Facades\Log::info('Email pembelian dikirim ke: ' . $cv->content['personal']['email']);
        // \Illuminate\Support\Facades\Mail::to($cv->content['personal']['email'])->send(new \App\Mail\CvPurchaseReceipt($cv));

        return redirect()->route('cv.show', $slug)->with('success', 'Pembayaran Berhasil! CV Anda kini siap diunduh tanpa watermark.');
    }
}
