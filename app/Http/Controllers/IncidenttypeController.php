<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class IncidenttypeController extends Controller
{
    public function index()
    {
        ini_set('max_execution_time', 3600);

        $tgl = Carbon::now();
        $tgl_now = $tgl->format('Y-m-d');
        $tgl_coba = ['2024-09-02', '2024-10-01'];

        $itypes = DB::table('wp_w2gm_locations_relationships')
            ->join('wp_term_relationships', 'wp_term_relationships.object_id', '=', 'wp_w2gm_locations_relationships.post_id')
            ->join('wp_term_taxonomy', 'wp_term_taxonomy.term_taxonomy_id', '=', 'wp_term_relationships.term_taxonomy_id')
            ->join('wp_terms', 'wp_terms.term_id', '=', 'wp_term_taxonomy.term_id')
            ->join('wp_posts', 'wp_posts.ID', '=', 'wp_w2gm_locations_relationships.post_id')
            ->select('wp_w2gm_locations_relationships.id', 'wp_terms.name', 'wp_posts.post_date')
            // ->whereDate(DB::raw('DATE(wp_posts.post_date)'), $tgl_now)
            ->whereBetween(DB::raw('DATE(wp_posts.post_date)'), [$tgl_coba[0], $tgl_coba[1]])
            ->where(function($query) {
                $query->where('wp_terms.term_id', 2452)
                      ->orWhere('wp_terms.term_id', 2453)
                      ->orWhere('wp_terms.term_id', 2455)
                      ->orWhere('wp_terms.term_id', 2457)
                      ->orWhere('wp_terms.term_id', 2458)
                      ->orWhere('wp_terms.term_id', 2459)
                      ->orWhere('wp_terms.term_id', 2460)
                      ->orWhere('wp_terms.term_id', 2461)
                      ->orWhere('wp_terms.term_id', 2462)
                      ->orWhere('wp_terms.term_id', 2463)
                      ->orWhere('wp_terms.term_id', 2464)
                      ->orWhere('wp_terms.term_id', 2465)
                      ->orWhere('wp_terms.term_id', 2466)
                      ->orWhere('wp_terms.term_id', 2468)
                      ->orWhere('wp_terms.term_id', 2469)
                      ->orWhere('wp_terms.term_id', 2470)
                      ->orWhere('wp_terms.term_id', 2471);
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
