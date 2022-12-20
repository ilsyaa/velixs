<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\License;
use App\Models\Payment;
use App\Models\ProductLibrary;
use Illuminate\Http\Request;
use App\Helpers\Metavis;

class PaymentController extends Controller
{
    public function index()
    {
        return Metavis::lyna('admin.payments.index', [
            'title' => 'Transaction History',
        ]);
    }

    public function json()
    {
        if (request()->query('payment_id')) {
            $payments = Payment::where('payment_id', request()->query('payment_id'))->orderBy('id', 'desc')->get();
        } else {
            $payments = Payment::orderBy('id', 'desc')->get();
        }
        return datatables()->of($payments)
            // ->addColumn('action', function ($payment) {
            //     return '<a href="' . route('payment.index', $payment->id) . '" class="btn btn-sm btn-primary"><i class="fa fa-eye"></i></a>';
            // })
            ->addColumn('responsive_id', function ($payment) {
                return '';
            })
            ->addColumn('user', function ($payment) {
                return $payment->user->name;
            })
            ->addColumn('item', function ($payment) {
                if ($payment->payment_type == 'product') {
                    return $payment->product->name;
                } else {
                    return '';
                }
            })
            ->editColumn('created_at', function ($payment) {
                return $payment->created_at->format('d M Y');
            })
            ->rawColumns(['action'])
            ->toJson();
    }

    public function destroyall(Request $request)
    {
        $ids = $request->id;
        $pament = Payment::whereIn('id', $ids);
        foreach ($pament->get() as $p) {
            if ($p->payment_type == 'product') {
                $library = ProductLibrary::where('payment_id', $p->id);
                License::where('license', $library->first()->license)->delete();
                $library->forcedelete();
            }
        }
        $pament->delete();
        return response()->json(['success' => "Payments Deleted successfully."]);
    }
}
