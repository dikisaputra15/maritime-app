<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class FlagofshipController extends Controller
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
            ->where('fxr_postmeta.meta_key', '_content_field_111')
            ->get();

        //    $no = 1;
        //     foreach ($tanggals as $tanggal) {
        //         echo $no++ . " " . $tanggal->id . "<br>";
        //     }


        if($regions->isNotEmpty()){
            foreach($regions as $region){
                if($region->meta_value == 1){
                    $reg = 'Afghanistan';
                }elseif($region->meta_value == 2){
                    $reg = 'Armenia';
                }elseif($region->meta_value == 3){
                    $reg = 'Australia';
                }elseif($region->meta_value == 4){
                    $reg = 'Azerbaijan';
                }elseif($region->meta_value == 5){
                    $reg = 'Bahrain';
                }elseif($region->meta_value == 6){
                    $reg = 'Bangladesh';
                }elseif($region->meta_value == 71){
                    $reg = 'Barbados';
                }elseif($region->meta_value == 7){
                    $reg = 'Bhutan';
                }elseif($region->meta_value == 8){
                    $reg = 'Brunei';
                }elseif($region->meta_value == 9){
                    $reg = 'Cambodia';
                }elseif($region->meta_value == 10){
                    $reg = 'China';
                }elseif($region->meta_value == 70){
                    $reg = 'Comoros';
                }elseif($region->meta_value == 11){
                    $reg = 'Cyprus';
                }elseif($region->meta_value == 74){
                    $reg = 'Djibouti';
                }elseif($region->meta_value == 12){
                    $reg = 'East Timor';
                }elseif($region->meta_value == 58){
                    $reg = 'Egypt';
                }elseif($region->meta_value == 72){
                    $reg = 'Gabon';
                }elseif($region->meta_value == 66){
                    $reg = 'Gambia';
                }elseif($region->meta_value == 13){
                    $reg = 'Georgia';
                }elseif($region->meta_value == 75){
                    $reg = 'Ghana';
                }elseif($region->meta_value == 59){
                    $reg = 'Greece';
                }elseif($region->meta_value == 67){
                    $reg = 'Hong Kong';
                }elseif($region->meta_value == 14){
                    $reg = 'India';
                }elseif($region->meta_value == 15){
                    $reg = 'Indonesia';
                }elseif($region->meta_value == 16){
                    $reg = 'Iran';
                }elseif($region->meta_value == 17){
                    $reg = 'Iraq';
                }elseif($region->meta_value == 18){
                    $reg = 'Israel';
                }elseif($region->meta_value == 57){
                    $reg = 'Italy';
                }elseif($region->meta_value == 19){
                    $reg = 'Japan';
                }elseif($region->meta_value == 20){
                    $reg = 'Jordan';
                }elseif($region->meta_value == 21){
                    $reg = 'Kazakhstan';
                }elseif($region->meta_value == 22){
                    $reg = 'Kuwait';
                }elseif($region->meta_value == 23){
                    $reg = 'Kyrgyzstan';
                }elseif($region->meta_value == 24){
                    $reg = 'Laos';
                }elseif($region->meta_value == 60){
                    $reg = 'Liberia';
                }elseif($region->meta_value == 25){
                    $reg = 'Lebanon';
                }elseif($region->meta_value == 64){
                    $reg = 'Madeira';
                }elseif($region->meta_value == 26){
                    $reg = 'Malaysia';
                }elseif($region->meta_value == 27){
                    $reg = 'Maldives';
                }elseif($region->meta_value == 55){
                    $reg = 'Marshal Island';
                }elseif($region->meta_value == 62){
                    $reg = 'Malta';
                }elseif($region->meta_value == 28){
                    $reg = 'Mongolia';
                }elseif($region->meta_value == 29){
                    $reg = 'Myanmar';
                }elseif($region->meta_value == 30){
                    $reg = 'Nepal';
                }elseif($region->meta_value == 68){
                    $reg = 'Netherlands';
                }elseif($region->meta_value == 31){
                    $reg = 'North Korea';
                }elseif($region->meta_value == 63){
                    $reg = 'Norway';
                }elseif($region->meta_value == 32){
                    $reg = 'Oman';
                }elseif($region->meta_value == 33){
                    $reg = 'Pakistan';
                }elseif($region->meta_value == 56){
                    $reg = 'Panama';
                }elseif($region->meta_value == 34){
                    $reg = 'Palestine';
                }elseif($region->meta_value == 35){
                    $reg = 'Papua New Guinea';
                }elseif($region->meta_value == 36){
                    $reg = 'Philippines';
                }elseif($region->meta_value == 69){
                    $reg = 'Portugal';
                }elseif($region->meta_value == 37){
                    $reg = 'Qatar';
                }elseif($region->meta_value == 38){
                    $reg = 'Russia';
                }elseif($region->meta_value == 39){
                    $reg = 'Saudi Arabia';
                }elseif($region->meta_value == 40){
                    $reg = 'Singapore';
                }elseif($region->meta_value == 41){
                    $reg = 'South Korea';
                }elseif($region->meta_value == 42){
                    $reg = 'Sri Lanka';
                }elseif($region->meta_value == 65){
                    $reg = 'St. Kitts & Nevis';
                }elseif($region->meta_value == 43){
                    $reg = 'Syria';
                }elseif($region->meta_value == 44){
                    $reg = 'Taiwan';
                }elseif($region->meta_value == 45){
                    $reg = 'Tajikistan';
                }elseif($region->meta_value == 46){
                    $reg = 'Thailand';
                }elseif($region->meta_value == 47){
                    $reg = 'Turkey';
                }elseif($region->meta_value == 48){
                    $reg = 'Turkmenistan';
                }elseif($region->meta_value == 49){
                    $reg = 'United Arab Emirates (UAE)';
                }elseif($region->meta_value == 61){
                    $reg = 'United Kingdom';
                }elseif($region->meta_value == 73){
                    $reg = 'United States of America';
                }elseif($region->meta_value == 50){
                    $reg = 'Uzbekistan';
                }elseif($region->meta_value == 51){
                    $reg = 'Vietnam';
                }elseif($region->meta_value == 52){
                    $reg = 'Yemen';
                }elseif($region->meta_value == 53){
                    $reg = 'Unreported/Unconfirmed';
                }else{
                    $reg = NULL;
                }
                DB::table('maritimestatistiks')
                    ->where('id_listing', $region->id)
                    ->update([
                        'flag_of_ship_target' => $reg
                    ]);
            }

            echo "sukses";
        }else{
            echo "empty";
        }

    }
}
