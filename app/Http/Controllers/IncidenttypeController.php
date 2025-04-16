<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class IncidenttypeController extends Controller
{
    public function index()
    {
        // ini_set('max_execution_time', 3600);

        $tgl = Carbon::now();
        $tgl_now = $tgl->format('Y-m-d');
        // $tgl_coba = ['2024-02-01', '2024-02-10'];

        $regions = DB::table('fxr_postmeta')
            ->join('fxr_posts', 'fxr_posts.ID', '=', 'fxr_postmeta.post_id')
            ->join('fxr_w2gm_locations_relationships', 'fxr_w2gm_locations_relationships.post_id', '=', 'fxr_postmeta.post_id')
            ->select('fxr_postmeta.post_id', 'fxr_postmeta.meta_value', 'fxr_posts.post_date', 'fxr_w2gm_locations_relationships.id')
            ->whereDate(DB::raw('DATE(fxr_posts.post_date)'), $tgl_now)
            // ->whereBetween(DB::raw('DATE(fxr_posts.post_date)'), [$tgl_coba[0], $tgl_coba[1]])
            ->where('fxr_postmeta.meta_key', '_content_field_96')
            ->orWhere('fxr_postmeta.meta_key', '_content_field_115')
            ->orWhere('fxr_postmeta.meta_key', '_content_field_97')
            ->get();

        //    $no = 1;
        //     foreach ($tanggals as $tanggal) {
        //         echo $no++ . " " . $tanggal->id . "<br>";
        //     }


        if($regions->isNotEmpty()){
            foreach($regions as $region){
                if($region->meta_key == '_content_field_96'){
                    if($region->meta_value == 30){
                        $reg = 'Attack/Military Related';
                    }elseif($region->meta_value == 28){
                        $reg = 'Border Dispute/Incursion';
                    }elseif($region->meta_value == 29){
                        $reg = 'Detained Vessel/Personnel';
                    }elseif($region->meta_value == 31){
                        $reg = 'Incident/Military-Govt Related';
                    }elseif($region->meta_value == 24){
                        $reg = 'Suspicious Vessel';
                    }elseif($region->meta_value == 19){
                        $reg = 'Terrorism';
                    }elseif($region->meta_value == 27){
                        $reg = 'Unreported/Unconfirmed';
                    }
                }
                if($region->meta_key == '_content_field_115'){
                    if($region->meta_value == 11){
                        $reg = 'Attack/Crime Related';
                    }elseif($region->meta_value == 10){
                        $reg = 'Attempted Boarding';
                    }elseif($region->meta_value == 2){
                        $reg = 'Hijacking';
                    }elseif($region->meta_value == 3){
                        $reg = 'Hostage';
                    }elseif($region->meta_value == 4){
                        $reg = 'Human Trafficking';
                    }elseif($region->meta_value == 5){
                        $reg = 'Illegal/Unregulated Fishing';
                    }elseif($region->meta_value == 12){
                        $reg = 'Illegal/Undocumented Immigration';
                    }elseif($region->meta_value == 1){
                        $reg = 'Narcotics';
                    }elseif($region->meta_value == 13){
                        $reg = 'Robbery';
                    }elseif($region->meta_value == 6){
                        $reg = 'Smuggling';
                    }elseif($region->meta_value == 14){
                        $reg = 'Suspicious Vessel';
                    }elseif($region->meta_value == 7){
                        $reg = 'Theft';
                    }elseif($region->meta_value == 15){
                        $reg = 'Unauthorized Boarding';
                    }elseif($region->meta_value == 8){
                        $reg = 'Violent Robbery';
                    }elseif($region->meta_value == 9){
                        $reg = 'Unreported/Unconfirmed';
                    }
                }
                if($region->meta_key == '_content_field_97'){
                    if($region->meta_value == 4){
                        $reg = 'Capsize/Listing/Sunk';
                    }elseif($region->meta_value == 5){
                        $reg = 'Collision with Ship';
                    }elseif($region->meta_value == 6){
                        $reg = 'Collision with Fixed Object';
                    }elseif($region->meta_value == 7){
                        $reg = 'Fire/Explosion';
                    }elseif($region->meta_value == 8){
                        $reg = 'Occupational Accident';
                    }elseif($region->meta_value == 9){
                        $reg = 'Oil Spill';
                    }elseif($region->meta_value == 10){
                        $reg = 'Running Aground';
                    }elseif($region->meta_value == 2){
                        $reg = 'Weather';
                    }elseif($region->meta_value == 12){
                        $reg = 'Other';
                    }
                }
                DB::table('maritimestatistiks')
                    ->where('id_listing', $region->id)
                    ->update([
                        'incident_category' => $reg
                    ]);
            }

            echo "sukses";
        }else{
            echo "empty";
        }

    }
}
