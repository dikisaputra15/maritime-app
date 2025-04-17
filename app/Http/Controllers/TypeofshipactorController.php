<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class TypeofshipactorController extends Controller
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
            ->where('fxr_postmeta.meta_key', '_content_field_120')
            ->get();

        //    $no = 1;
        //     foreach ($tanggals as $tanggal) {
        //         echo $no++ . " " . $tanggal->id . "<br>";
        //     }


        if($regions->isNotEmpty()){
            foreach($regions as $region){
                if($region->meta_value == 1){
                    $reg = 'Barge';
                }elseif($region->meta_value == 2){
                    $reg = 'Bulk Carier';
                }elseif($region->meta_value == 3){
                    $reg = 'Container Ship';
                }elseif($region->meta_value == 4){
                    $reg = 'Cruise Liner';
                }elseif($region->meta_value == 5){
                    $reg = 'Fishing Vessel';
                }elseif($region->meta_value == 6){
                    $reg = 'General Cargo Ship';
                }elseif($region->meta_value == 7){
                    $reg = 'Heavy-load Carrier';
                }elseif($region->meta_value == 8){
                    $reg = 'Military/Security Vessel';
                }elseif($region->meta_value == 9){
                    $reg = 'Passenger Vessel';
                }elseif($region->meta_value == 10){
                    $reg = 'Police Vessel';
                }elseif($region->meta_value == 11){
                    $reg = 'Coast Guard Vessel';
                }elseif($region->meta_value == 12){
                    $reg = 'Private Vessel';
                }elseif($region->meta_value == 13){
                    $reg = 'Research Vessel';
                }elseif($region->meta_value == 14){
                    $reg = 'Supply Vessel';
                }elseif($region->meta_value == 15){
                    $reg = 'Tanker';
                }elseif($region->meta_value == 16){
                    $reg = 'Tugboat';
                }elseif($region->meta_value == 17){
                    $reg = 'Yacht';
                }elseif($region->meta_value == 18){
                    $reg = 'Unreported/Unconfirmed';
                }else{
                    $reg = NULL;
                }
                DB::table('maritimestatistiks')
                    ->where('id_listing', $region->id)
                    ->update([
                        'type_of_ship_actor' => $reg
                    ]);
            }

            echo "sukses";
        }else{
            echo "empty";
        }

    }
}
