<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class TreatmentofcrewController extends Controller
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
            ->where('fxr_postmeta.meta_key', '_content_field_107')
            ->get();

        //    $no = 1;
        //     foreach ($tanggals as $tanggal) {
        //         echo $no++ . " " . $tanggal->id . "<br>";
        //     }


        if($regions->isNotEmpty()){
            foreach($regions as $region){
                if($region->meta_value == 1){
                    $reg = 'Killed';
                }elseif($region->meta_value == 2){
                    $reg = 'Assaulted';
                }elseif($region->meta_value == 3){
                    $reg = 'Kidnapped/Taken Hostage';
                }elseif($region->meta_value == 5){
                    $reg = 'Threatened';
                }elseif($region->meta_value == 6){
                    $reg = 'Evicted from Vessel';
                }elseif($region->meta_value == 7){
                    $reg = 'Missing';
                }elseif($region->meta_value == 9){
                    $reg = 'Unreported/Unconfirmed';
                }elseif($region->meta_value == 10){
                    $reg = 'Unharmed';
                }elseif($region->meta_value == 11){
                    $reg = 'No Injury Reported';
                }elseif($region->meta_value == 12){
                    $reg = 'Detained';
                }elseif($region->meta_value == 13){
                    $reg = 'Seriously Injured';
                }elseif($region->meta_value == 14){
                    $reg = 'Minor Injury';
                }elseif($region->meta_value == 15){
                    $reg = 'Questioned by Authorities';
                }elseif($region->meta_value == 17){
                    $reg = 'No Fatality Reported';
                }elseif($region->meta_value == 18){
                    $reg = 'Detained by Authorities';
                }elseif($region->meta_value == 19){
                    $reg = 'Injury/Fatality';
                }elseif($region->meta_value == 20){
                    $reg = 'No Injury/Fatality';
                }else{
                    $reg = NULL;
                }
                DB::table('maritimestatistiks')
                    ->where('id_listing', $region->id)
                    ->update([
                        'treatment_of_crew' => $reg
                    ]);
            }

            echo "sukses";
        }else{
            echo "empty";
        }

    }
}
