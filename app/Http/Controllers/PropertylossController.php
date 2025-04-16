<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class PropertylossController extends Controller
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
            ->where('fxr_postmeta.meta_key', '_content_field_119')
            ->get();

        //    $no = 1;
        //     foreach ($tanggals as $tanggal) {
        //         echo $no++ . " " . $tanggal->id . "<br>";
        //     }


        if($regions->isNotEmpty()){
            foreach($regions as $region){
                if($region->meta_value == 1){
                    $reg = 'Discharged Cargo';
                }elseif($region->meta_value == 2){
                    $reg = 'Discharged Fuel/Oil';
                }elseif($region->meta_value == 3){
                    $reg = 'Stolen';
                }elseif($region->meta_value == 4){
                    $reg = 'Engine Spares';
                }elseif($region->meta_value == 5){
                    $reg = 'Fuel';
                }elseif($region->meta_value == 6){
                    $reg = 'Ships Property/Stores';
                }elseif($region->meta_value == 7){
                    $reg = 'Crews Property';
                }elseif($region->meta_value == 8){
                    $reg = 'Cargo';
                }elseif($region->meta_value == 9){
                    $reg = 'Tools/Equipment';
                }elseif($region->meta_value == 10){
                    $reg = 'Unsecured Items';
                }elseif($region->meta_value == 11){
                    $reg = 'No Loss/Impact Reported';
                }elseif($region->meta_value == 12){
                    $reg = 'Unreported/Unconfirmed';
                }else{
                    $reg = NULL;
                }
                DB::table('maritimestatistiks')
                    ->where('id_listing', $region->id)
                    ->update([
                        'property_loss' => $reg
                    ]);
            }

            echo "sukses";
        }else{
            echo "empty";
        }

    }
}
