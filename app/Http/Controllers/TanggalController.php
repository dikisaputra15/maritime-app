<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class TanggalController extends Controller
{
    public function index()
    {
        ini_set('max_execution_time', 3600);

        $tgl = Carbon::now();
        $tgl_now = $tgl->format('Y-m-d');
        // $tgl_coba = ['2024-09-02', '2024-10-01'];

        $tanggals = DB::table('fxr_postmeta')
            ->join('fxr_posts', 'fxr_posts.ID', '=', 'fxr_postmeta.post_id')
            ->join('fxr_w2gm_locations_relationships', 'fxr_w2gm_locations_relationships.post_id', '=', 'fxr_postmeta.post_id')
            ->select('fxr_postmeta.post_id', 'fxr_postmeta.meta_value', 'fxr_posts.post_date', 'fxr_w2gm_locations_relationships.id')
            ->whereDate(DB::raw('DATE(fxr_posts.post_date)'), $tgl_now)
            // ->whereBetween(DB::raw('DATE(fxr_posts.post_date)'), [$tgl_coba[0], $tgl_coba[1]])
            ->where('fxr_postmeta.meta_key', '_content_field_89_date_end')
            ->get();

        //    $no = 1;
        //     foreach ($tanggals as $tanggal) {
        //         echo $no++ . " " . $tanggal->id . "<br>";
        //     }


        if($tanggals->isNotEmpty()){
            foreach($tanggals as $tanggal){
                $tgl_unix = $tanggal->meta_value;
                $tgl_hasil = date('Y-m-d', $tgl_unix);
                DB::table('maritimestatistiks')
                    ->where('id_listing', $tanggal->id)
                    ->update([
                        'listing_date' => $tgl_hasil
                    ]);
            }

            echo "sukses";
        }else{
            echo "empty";
        }

    }
}
