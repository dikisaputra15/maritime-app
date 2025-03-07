<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class TimeofincidenttypeController extends Controller
{
    public function index()
    {
        // ini_set('max_execution_time', 3600);

        $tgl = Carbon::now();
        $tgl_now = $tgl->format('Y-m-d');
        // $tgl_coba = ['2024-01-21', '2024-01-31'];

        $times = DB::table('fxr_postmeta')
            ->join('fxr_posts', 'fxr_posts.ID', '=', 'fxr_postmeta.post_id')
            ->join('fxr_w2gm_locations_relationships', 'fxr_w2gm_locations_relationships.post_id', '=', 'fxr_postmeta.post_id')
            ->select('fxr_postmeta.post_id', 'fxr_postmeta.meta_value', 'fxr_posts.post_date', 'fxr_w2gm_locations_relationships.id')
            ->whereDate(DB::raw('DATE(fxr_posts.post_date)'), $tgl_now)
            // ->whereBetween(DB::raw('DATE(fxr_posts.post_date)'), [$tgl_coba[0], $tgl_coba[1]])
            ->where('fxr_postmeta.meta_key', '_content_field_112')
            ->get();

        //    $no = 1;
        //     foreach ($tanggals as $tanggal) {
        //         echo $no++ . " " . $tanggal->id . "<br>";
        //     }


        if($times->isNotEmpty()){
            foreach($times as $time){
                if($time->meta_value == 1){
                    $timeval = '00:00 - 04:00';
                }elseif($time->meta_value == 2){
                    $timeval = '04:01 - 08:00';
                }elseif($time->meta_value == 3){
                    $timeval = '08:01 - 12:00';
                }elseif($time->meta_value == 4){
                    $timeval = '12:01 - 16:00';
                }elseif($time->meta_value == 5){
                    $timeval = '16:01 - 20:00';
                }elseif($time->meta_value == 6){
                    $timeval = '20:01 - 23:59';
                }else{
                    $timeval = NULL;
                }
                DB::table('maritimestatistiks')
                    ->where('id_listing', $time->id)
                    ->update([
                        'timeofincidenttype' => $timeval
                    ]);
            }

            echo "sukses";
        }else{
            echo "empty";
        }

    }
}
