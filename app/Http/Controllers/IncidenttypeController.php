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
        // $tgl_coba = ['2024-09-02', '2024-10-01'];

        $itypes = DB::table('fxr_w2gm_locations_relationships')
            ->join('fxr_term_relationships', 'fxr_term_relationships.object_id', '=', 'fxr_w2gm_locations_relationships.post_id')
            ->join('fxr_term_taxonomy', 'fxr_term_taxonomy.term_taxonomy_id', '=', 'fxr_term_relationships.term_taxonomy_id')
            ->join('fxr_terms', 'fxr_terms.term_id', '=', 'fxr_term_taxonomy.term_id')
            ->join('fxr_posts', 'fxr_posts.ID', '=', 'fxr_w2gm_locations_relationships.post_id')
            ->select('fxr_w2gm_locations_relationships.id', 'fxr_terms.name', 'fxr_posts.post_date')
            ->whereDate(DB::raw('DATE(fxr_posts.post_date)'), $tgl_now)
            // ->whereBetween(DB::raw('DATE(fxr_posts.post_date)'), [$tgl_coba[0], $tgl_coba[1]])
            ->where(function($query) {
                $query->where('fxr_terms.term_id', 2452)
                      ->orWhere('fxr_terms.term_id', 2453)
                      ->orWhere('fxr_terms.term_id', 2455)
                      ->orWhere('fxr_terms.term_id', 2457)
                      ->orWhere('fxr_terms.term_id', 2458)
                      ->orWhere('fxr_terms.term_id', 2459)
                      ->orWhere('fxr_terms.term_id', 2460)
                      ->orWhere('fxr_terms.term_id', 2461)
                      ->orWhere('fxr_terms.term_id', 2462)
                      ->orWhere('fxr_terms.term_id', 2463)
                      ->orWhere('fxr_terms.term_id', 2464)
                      ->orWhere('fxr_terms.term_id', 2465)
                      ->orWhere('fxr_terms.term_id', 2466)
                      ->orWhere('fxr_terms.term_id', 2468)
                      ->orWhere('fxr_terms.term_id', 2469)
                      ->orWhere('fxr_terms.term_id', 2470)
                      ->orWhere('fxr_terms.term_id', 2471)
                      ->orWhere('fxr_terms.term_id', 2649)
                      ->orWhere('fxr_terms.term_id', 2837);
            })
            ->get();


            if($itypes->isNotEmpty()){
                foreach ($itypes as $itype){
                    DB::table('maritimestatistiks')
                        ->where('id_listing', $itype->id)
                        ->update([
                            'incident_category' => $itype->name
                        ]);
                }
                echo "sukses";
            }else{
                echo "empty";
            }

    }
}
