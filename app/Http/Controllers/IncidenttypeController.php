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

        $actors = DB::table('fxr_w2gm_locations_relationships')
            ->join('fxr_term_relationships', 'fxr_term_relationships.object_id', '=', 'fxr_w2gm_locations_relationships.post_id')
            ->join('fxr_term_taxonomy', 'fxr_term_taxonomy.term_taxonomy_id', '=', 'fxr_term_relationships.term_taxonomy_id')
            ->join('fxr_terms', 'fxr_terms.term_id', '=', 'fxr_term_taxonomy.term_id')
            ->join('fxr_posts', 'fxr_posts.ID', '=', 'fxr_w2gm_locations_relationships.post_id')
            ->select('fxr_w2gm_locations_relationships.id', 'fxr_terms.name')
            ->whereDate(DB::raw('DATE(fxr_posts.post_date)'), $tgl_now)
            // ->whereBetween(DB::raw('DATE(fxr_posts.post_date)'), [$tgl_coba[0], $tgl_coba[1]])
            ->where(function($query) {
                $query->Where('fxr_terms.term_id', 2837)
                    ->orWhere('fxr_terms.term_id', 2649)
                    ->orWhere('fxr_terms.term_id', 2821)
                    ->orWhere('fxr_terms.term_id', 2468)
                    ->orWhere('fxr_terms.term_id', 2462)
                    ->orWhere('fxr_terms.term_id', 2471)
                    ->orWhere('fxr_terms.term_id', 2880)
                    ->orWhere('fxr_terms.term_id', 2469)
                    ->orWhere('fxr_terms.term_id', 2460)
                    ->orWhere('fxr_terms.term_id', 2459)
                    ->orWhere('fxr_terms.term_id', 2465)
                    ->orWhere('fxr_terms.term_id', 2463)
                    ->orWhere('fxr_terms.term_id', 2892)
                    ->orWhere('fxr_terms.term_id', 2876)
                    ->orWhere('fxr_terms.term_id', 2464)
                    ->orWhere('fxr_terms.term_id', 2457)
                    ->orWhere('fxr_terms.term_id', 2470)
                    ->orWhere('fxr_terms.term_id', 2458)
                    ->orWhere('fxr_terms.term_id', 2452)
                    ->orWhere('fxr_terms.term_id', 2455)
                    ->orWhere('fxr_terms.term_id', 2453)
                    ->orWhere('fxr_terms.term_id', 3445)
                    ->orWhere('fxr_terms.term_id', 3447)
                    ->orWhere('fxr_terms.term_id', 3446)
                    ->orWhere('fxr_terms.term_id', 3448)
                    ->orWhere('fxr_terms.term_id', 3449)
                    ->orWhere('fxr_terms.term_id', 3451)
                    ->orWhere('fxr_terms.term_id', 3450)
                    ->orWhere('fxr_terms.term_id', 3453)
                    ->orWhere('fxr_terms.term_id', 3454)
                    ->orWhere('fxr_terms.term_id', 3452)
                    ->orWhere('fxr_terms.term_id', 4041)
                    ->orWhere('fxr_terms.term_id', 4067);
                })
            ->get();

        //    $no = 1;
        //     foreach ($tanggals as $tanggal) {
        //         echo $no++ . " " . $tanggal->id . "<br>";
        //     }


        if($actors->isNotEmpty()){
            foreach ($actors as $actor){
                DB::table('maritimestatistiks')
                    ->where('id_listing', $actor->id)
                    ->update([
                        'incident_category' => $actor->name
                    ]);
            }
            echo "sukses";
        }else{
            echo "empty";
        }

    }
}
