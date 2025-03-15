<?php namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;
// Model
use App\Models\DashboardModel;
use App\Models\DataReqModel;
use App\Models\Data_m_s_Model;

class DashboardController extends Controller {
    public function index() {
        $loggedInUser=session('logged_in_user')['level'];
        $name_page  = "B'Mine - Dashboard";
        $minepermit=DashboardModel::countAccess1();
        $simper=DashboardModel::countAccess2();
        $sheprosess=DataReqModel::where('validasi_in', 1)->count();
        $pjoprosess=DataReqModel::where('validasi_in', 2)->count();
        $becprosess=DataReqModel::where('validasi_in', 3)->count();
        $kttprosess=DataReqModel::where('validasi_in', 4)->count();
        $minepermit_data=DataReqModel::where('status', 1)->count();
        $simper_data=DataReqModel::where('status', 2)->count();
        $totaloutstanding=$sheprosess+$pjoprosess+$becprosess+$kttprosess;

        if ($loggedInUser==='admin'|| $loggedInUser==='section_admin'|| $loggedInUser==='she'|| $loggedInUser==='pjo') {
            // Jika pengguna adalah admin, section_admin, she, atau pjo
             return view('dashboard.dashboard', compact('name_page','minepermit', 'simper', 'sheprosess', 'pjoprosess', 'becprosess', 'kttprosess', 'totaloutstanding', 'simper_data', 'minepermit_data'));
        }

        elseif ($loggedInUser==='bec'|| $loggedInUser==='ktt') {
            // Jika pengguna adalah bec atau pjo
            return view('dashboard.dashboard_external', compact('name_page','minepermit', 'simper', 'sheprosess', 'pjoprosess', 'becprosess', 'kttprosess', 'totaloutstanding', 'simper_data', 'minepermit_data'));
        }

        else {
            // Jika tidak ada peran yang sesuai
            echo "Tidak ada peran yang dikenali";
        }
    }

    public function about() {
         $name_page  = "B'Mine - Dashboard";
        return view('dashboard.about', compact('name_page'));
    }
      public function reset_password(Request $request) {
        $name_page  = "B'Mine - Dashboard";
        return view('setting.reset_password', compact('name_page'));
    }

     /**
     * Endpoint untuk menyediakan data chart
     */
    public function getPermitRequestsData()
    {
        // Data untuk 12 bulan terakhir (atau tahun berjalan)
        $currentYear = Carbon::now()->year;
        
        // Array untuk menyimpan jumlah permintaan per bulan
        $simperCounts = array_fill(0, 12, 0);
        $minePermitCounts = array_fill(0, 12, 0);
        
        // Query untuk menghitung jumlah permintaan per bulan dan per tipe
        $data = DB::table('data_m_s') // Ganti dengan nama tabel yang benar
            ->select(
                DB::raw('MONTH(date_req) as month'),
                'validasi_in',
                DB::raw('COUNT(*) as total')
            )
            ->whereYear('date_req', $currentYear)
            ->whereNotNull('validasi_in') // Hanya data yang sudah divalidasi
            ->groupBy('month', 'validasi_in')
            ->get();
        
        // Populasi array hasil berdasarkan data dari database
        foreach ($data as $item) {
            $month = $item->month - 1; // Adjust untuk array 0-based
            
            if ($item->validasi_in == 1) {
                // SIMPER
                $simperCounts[$month] = $item->total;
            } elseif ($item->validasi_in == 2) {
                // Mine Permit
                $minePermitCounts[$month] = $item->total;
            }
        }
        
        // Return data dalam format JSON
        return response()->json([
            'simper' => $simperCounts,
            'minePermit' => $minePermitCounts
        ]);
    }
    
    /**
     * Endpoint alternatif untuk mendapatkan data berdasarkan rentang tanggal kustom
     */
    public function getCustomRangeData(Request $request)
    {
        // Validasi input
        $request->validate([
            'start_date' => 'required|date',
            'end_date' => 'required|date|after_or_equal:start_date',
        ]);
        
        $startDate = Carbon::parse($request->start_date);
        $endDate = Carbon::parse($request->end_date);
        
        // Hitung jumlah bulan antara tanggal mulai dan akhir
        $monthDiff = $endDate->diffInMonths($startDate) + 1;
        
        // Buat array untuk label bulan yang akan ditampilkan
        $labels = [];
        $simperCounts = [];
        $minePermitCounts = [];
        
        // Generate label dan array kosong untuk data
        $currentDate = clone $startDate;
        for ($i = 0; $i < $monthDiff; $i++) {
            $labels[] = $currentDate->format('F Y');
            $simperCounts[] = 0;
            $minePermitCounts[] = 0;
            $currentDate->addMonth();
        }
        
        // Query untuk mendapatkan data dalam rentang yang ditentukan
        $data = DB::table('data_m_s') // Ganti dengan nama tabel yang benar
            ->select(
                DB::raw('DATE_FORMAT(date_req, "%Y-%m") as month_year'),
                'validasi_in',
                DB::raw('COUNT(*) as total')
            )
            ->whereBetween('date_req', [$startDate->format('Y-m-d'), $endDate->endOfMonth()->format('Y-m-d')])
            ->whereNotNull('validasi_in')
            ->groupBy('month_year', 'validasi_in')
            ->get();
        dd($data);
        // Populasi array hasil
        foreach ($data as $item) {
            $date = Carbon::createFromFormat('Y-m', $item->month_year);
            $monthLabel = $date->format('F Y');
            $index = array_search($monthLabel, $labels);
            
            if ($index !== false) {
                if ($item->validasi_in == 1) {
                    // SIMPER
                    $simperCounts[$index] = $item->total;
                } elseif ($item->validasi_in == 2) {
                    // Mine Permit
                    $minePermitCounts[$index] = $item->total;
                }
            }
        }
        
        // Return data dalam format JSON
        return response()->json([
            'labels' => $labels,
            'simper' => $simperCounts,
            'minePermit' => $minePermitCounts
        ]);
    }
}
