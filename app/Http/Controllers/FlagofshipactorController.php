<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class FlagofshipactorController extends Controller
{
    public function index()
    {
        // ini_set('max_execution_time', 3600);

        $tgl = Carbon::now();
        $tgl_now = $tgl->format('Y-m-d');
        // $tgl_coba = ['2024-02-01', '2024-02-10'];

        $actors = DB::table('fxr_postmeta')
            ->join('fxr_posts', 'fxr_posts.ID', '=', 'fxr_postmeta.post_id')
            ->join('fxr_w2gm_locations_relationships', 'fxr_w2gm_locations_relationships.post_id', '=', 'fxr_postmeta.post_id')
            ->select('fxr_postmeta.post_id', 'fxr_postmeta.meta_value', 'fxr_posts.post_date', 'fxr_w2gm_locations_relationships.id')
            ->whereDate(DB::raw('DATE(fxr_posts.post_date)'), $tgl_now)
            // ->whereBetween(DB::raw('DATE(fxr_posts.post_date)'), [$tgl_coba[0], $tgl_coba[1]])
            ->where('fxr_postmeta.meta_key', '_content_field_113')
            ->get();

        //    $no = 1;
        //     foreach ($tanggals as $tanggal) {
        //         echo $no++ . " " . $tanggal->id . "<br>";
        //     }


        if($actors->isNotEmpty()){
            foreach($actors as $actor){
                if($actor->meta_value == 1){
                    $reg = 'Afghanistan';
                }elseif($actor->meta_value == 2){
                    $reg = 'Armenia';
                }elseif($actor->meta_value == 3){
                    $reg = 'Australia';
                }elseif($actor->meta_value == 4){
                    $reg = 'Azerbaijan';
                }elseif($actor->meta_value == 5){
                    $reg = 'Bahrain';
                }elseif($actor->meta_value == 6){
                    $reg = 'Bangladesh';
                }elseif($actor->meta_value == 70){
                    $reg = 'Barbados';
                }elseif($actor->meta_value == 7){
                    $reg = 'Bhutan';
                }elseif($actor->meta_value == 8){
                    $reg = 'Brunei';
                }elseif($actor->meta_value == 9){
                    $reg = 'Cambodia';
                }elseif($actor->meta_value == 10){
                    $reg = 'China';
                }elseif($actor->meta_value == 69){
                    $reg = 'Comoros';
                }elseif($actor->meta_value == 11){
                    $reg = 'Cyprus';
                }elseif($actor->meta_value == 12){
                    $reg = 'East Timor';
                }elseif($actor->meta_value == 13){
                    $reg = 'Egypt';
                }elseif($actor->meta_value == 73){
                    $reg = 'Estonia';
                }elseif($actor->meta_value == 71){
                    $reg = 'Gabon';
                }elseif($actor->meta_value == 62){
                    $reg = 'Gambia';
                }elseif($actor->meta_value == 14){
                    $reg = 'Georgia';
                }elseif($actor->meta_value == 72){
                    $reg = 'Germany';
                }elseif($actor->meta_value == 74){
                    $reg = 'Ghana';
                }elseif($actor->meta_value == 15){
                    $reg = 'Greece';
                }elseif($actor->meta_value == 63){
                    $reg = 'Hong Kong';
                }elseif($actor->meta_value == 16){
                    $reg = 'India';
                }elseif($actor->meta_value == 17){
                    $reg = 'Indonesia';
                }elseif($actor->meta_value == 18){
                    $reg = 'Iran';
                }elseif($actor->meta_value == 19){
                    $reg = 'Iraq';
                }elseif($actor->meta_value == 20){
                    $reg = 'Israel';
                }elseif($actor->meta_value == 21){
                    $reg = 'Italy';
                }elseif($actor->meta_value == 22){
                    $reg = 'Japan';
                }elseif($actor->meta_value == 23){
                    $reg = 'Jordan';
                }elseif($actor->meta_value == 24){
                    $reg = 'Kazakhstan';
                }elseif($actor->meta_value == 25){
                    $reg = 'Kuwait';
                }elseif($actor->meta_value == 26){
                    $reg = 'Kyrgyzstan';
                }elseif($actor->meta_value == 27){
                    $reg = 'Laos';
                }elseif($actor->meta_value == 28){
                    $reg = 'Liberia';
                }elseif($actor->meta_value == 29){
                    $reg = 'Lebanon';
                }elseif($actor->meta_value == 64){
                    $reg = 'Madeira';
                }elseif($actor->meta_value == 30){
                    $reg = 'Malaysia';
                }elseif($actor->meta_value == 31){
                    $reg = 'Maldives';
                }elseif($actor->meta_value == 32){
                    $reg = 'Marshal Island';
                }elseif($actor->meta_value == 33){
                    $reg = 'Malta';
                }elseif($actor->meta_value == 34){
                    $reg = 'Mongolia';
                }elseif($actor->meta_value == 35){
                    $reg = 'Myanmar';
                }elseif($actor->meta_value == 36){
                    $reg = 'Nepal';
                }elseif($actor->meta_value == 67){
                    $reg = 'Netherlands';
                }elseif($actor->meta_value == 37){
                    $reg = 'North Korea';
                }elseif($actor->meta_value == 65){
                    $reg = 'Norway';
                }elseif($actor->meta_value == 38){
                    $reg = 'Oman';
                }elseif($actor->meta_value == 39){
                    $reg = 'Pakistan';
                }elseif($actor->meta_value == 40){
                    $reg = 'Panama';
                }elseif($actor->meta_value == 41){
                    $reg = 'Palestine';
                }elseif($actor->meta_value == 42){
                    $reg = 'Papua New Guinea';
                }elseif($actor->meta_value == 43){
                    $reg = 'Philippines';
                }elseif($actor->meta_value == 68){
                    $reg = 'Portugal';
                }elseif($actor->meta_value == 44){
                    $reg = 'Qatar';
                }elseif($actor->meta_value == 45){
                    $reg = 'Russia';
                }elseif($actor->meta_value == 46){
                    $reg = 'Saudi Arabia';
                }elseif($actor->meta_value == 47){
                    $reg = 'Singapore';
                }elseif($actor->meta_value == 48){
                    $reg = 'South Korea';
                }elseif($actor->meta_value == 49){
                    $reg = 'Sri Lanka';
                }elseif($actor->meta_value == 66){
                    $reg = 'St. Kitts & Nevis';
                }elseif($actor->meta_value == 50){
                    $reg = 'Syria';
                }elseif($actor->meta_value == 51){
                    $reg = 'Taiwan';
                }elseif($actor->meta_value == 52){
                    $reg = 'Tajikistan';
                }elseif($actor->meta_value == 53){
                    $reg = 'Thailand';
                }elseif($actor->meta_value == 54){
                    $reg = 'Turkey';
                }elseif($actor->meta_value == 55){
                    $reg = 'Turkmenistan';
                }elseif($actor->meta_value == 76){
                    $reg = 'Ukraine';
                }elseif($actor->meta_value == 56){
                    $reg = 'United Arab Emirates (UAE)';
                }elseif($actor->meta_value == 57){
                    $reg = 'United Kingdom';
                }elseif($actor->meta_value == 58){
                    $reg = 'Uzbekistan';
                }elseif($actor->meta_value == 59){
                    $reg = 'Vietnam';
                }elseif($actor->meta_value == 60){
                    $reg = 'Yemen';
                }elseif($actor->meta_value == 61){
                    $reg = 'Unreported/Unconfirmed';
                }else{
                    $reg = NULL;
                }
                DB::table('maritimestatistiks')
                    ->where('id_listing', $actor->id)
                    ->update([
                        'flag_of_ship_actor' => $reg
                    ]);
            }

            echo "sukses";
        }else{
            echo "empty";
        }

    }
}
