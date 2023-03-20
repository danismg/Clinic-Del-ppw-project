<?php

namespace App\Http\Controllers;

use App\Models\Medicine;
use App\Http\Controllers\Controller;

class NotificationController extends Controller
{
    public function counter()
    {
        $medicine = Medicine::where('quantity', '<', '10')->count();
        return response()->json([
            'total_notif' => $medicine,
        ]);
    }

    public function index()
    {
        $output = '';
        $medicine = Medicine::where('quantity', '<', '10')->get();
        if ($medicine->count() > 0) {
            foreach ($medicine as $notification) {
                $output .= '
                <a href="javascript:;" class="navi-item">
                    <div class="navi-link">
                        <div class="navi-icon mr-2">
                            <i class="fas fa-exclamation-circle text-warning"></i>
                        </div>
                        <div class="navi-text">
                            <div class="font-weight-bold">Stok ' . $notification->name . ' Tersisa ' . $notification->quantity . '</div>
                        </div>
                    </div>
                </a>';
            }
        } else {
            $output = '
            <a href="javascript:;" class="navi-item">
                <div class="navi-link">
                    <div class="navi-text">
                        <div class="font-weight-bold">Belum ada notifikasi</div>
                    </div>
                </div>
            </a>';
        }
        return response()->json([
            'collection' => $output,
            'total_notif' => $medicine->count(),
        ]);
    }
}
