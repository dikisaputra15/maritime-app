<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class WeaponController extends Controller
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
            ->where('fxr_postmeta.meta_key', '_content_field_106')
            ->get();

        //    $no = 1;
        //     foreach ($tanggals as $tanggal) {
        //         echo $no++ . " " . $tanggal->id . "<br>";
        //     }


        if($regions->isNotEmpty()){
            foreach($regions as $region){
                if($region->meta_value == 1){
                    $reg = 'No Weapon Used';
                }elseif($region->meta_value == 2){
                    $reg = 'Physical Violence';
                }elseif($region->meta_value == 3){
                    $reg = 'Blunt Force Weapon';
                }elseif($region->meta_value == 4){
                    $reg = 'Improvised Weapon';
                }elseif($region->meta_value == 5){
                    $reg = 'Edged Weapon';
                }elseif($region->meta_value == 6){
                    $reg = 'Firearm';
                }elseif($region->meta_value == 7){
                    $reg = 'Military-grade Firearm';
                }elseif($region->meta_value == 8){
                    $reg = 'Explosive';
                }elseif($region->meta_value == 9){
                    $reg = 'Homemade Explosive';
                }elseif($region->meta_value == 10){
                    $reg = 'Firebomb/Molotov cocktail';
                }elseif($region->meta_value == 11){
                    $reg = 'Commercial Explosive';
                }elseif($region->meta_value == 12){
                    $reg = 'Military-grade Explosive';
                }elseif($region->meta_value == 13){
                    $reg = 'Improvised Explosive Device (IEDs)';
                }elseif($region->meta_value == 14){
                    $reg = 'Grenade';
                }elseif($region->meta_value == 15){
                    $reg = 'Multiple Weapons Used';
                }elseif($region->meta_value == 17){
                    $reg = 'Unreported/Unconfirmed';
                }else{
                    $reg = NULL;
                }
                DB::table('maritimestatistiks')
                    ->where('id_listing', $region->id)
                    ->update([
                        'weapons' => $reg
                    ]);
            }

            echo "sukses";
        }else{
            echo "empty";
        }

    }
}
