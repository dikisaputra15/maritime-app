<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class CountryController extends Controller
{
    public function index()
    {
        // ini_set('max_execution_time', 3600);

        $tgl = Carbon::now();
        $tgl_now = $tgl->format('Y-m-d');
        // $tgl_now = '2024-09-19';
        // $tgl_coba = ['2024-09-02', '2024-10-01'];

        $countris = DB::table('fxr_w2gm_locations_relationships')
        ->join('fxr_terms', 'fxr_terms.term_id', '=', 'fxr_w2gm_locations_relationships.location_id')
        ->join('fxr_posts', 'fxr_posts.ID', '=', 'fxr_w2gm_locations_relationships.post_id')
        ->select('fxr_w2gm_locations_relationships.id', 'fxr_terms.name')
        ->whereDate(DB::raw('DATE(fxr_posts.post_date)'), $tgl_now)
        // ->whereBetween(DB::raw('DATE(fxr_posts.post_date)'), [$tgl_coba[0], $tgl_coba[1]])
        ->get();

        //  $no = 1;
        //     foreach ($countris as $countri) {
        //         echo $no++ . " " . $countri->name ."<br>";
        //     }

        if($countris->isNotEmpty()){
            foreach ($countris as $countri){
                DB::table('maritimestatistiks')
                    ->where('id_listing', $countri->id)
                    ->update([
                        'country' => $countri->name
                    ]);
            }
            echo "sukses";
        }else{
            echo "empty";
        }

    }
}
