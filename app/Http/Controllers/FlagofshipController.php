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
        // $tgl_coba = ['2024-09-02', '2024-10-01'];

        $actors = DB::table('wp_w2gm_locations_relationships')
        ->join('wp_term_relationships', 'wp_term_relationships.object_id', '=', 'wp_w2gm_locations_relationships.post_id')
        ->join('wp_term_taxonomy', 'wp_term_taxonomy.term_taxonomy_id', '=', 'wp_term_relationships.term_taxonomy_id')
        ->join('wp_terms', 'wp_terms.term_id', '=', 'wp_term_taxonomy.term_id')
        ->join('wp_posts', 'wp_posts.ID', '=', 'wp_w2gm_locations_relationships.post_id')
        ->select('wp_w2gm_locations_relationships.id', 'wp_terms.name')
        ->whereDate(DB::raw('DATE(wp_posts.post_date)'), $tgl_now)
        // ->whereBetween(DB::raw('DATE(wp_posts.post_date)'), [$tgl_coba[0], $tgl_coba[1]])
        ->where(function($query) {
            $query->Where('wp_terms.term_id', 2551)
                ->orWhere('wp_terms.term_id', 2552)
                ->orWhere('wp_terms.term_id', 2553)
                ->orWhere('wp_terms.term_id', 2554)
                ->orWhere('wp_terms.term_id', 2555)
                ->orWhere('wp_terms.term_id', 2556)
                ->orWhere('wp_terms.term_id', 2557)
                ->orWhere('wp_terms.term_id', 2558)
                ->orWhere('wp_terms.term_id', 2559)
                ->orWhere('wp_terms.term_id', 2560)
                ->orWhere('wp_terms.term_id', 2561)
                ->orWhere('wp_terms.term_id', 2562)
                ->orWhere('wp_terms.term_id', 2563)
                ->orWhere('wp_terms.term_id', 2564)
                ->orWhere('wp_terms.term_id', 2565)
                ->orWhere('wp_terms.term_id', 2566)
                ->orWhere('wp_terms.term_id', 2567)
                ->orWhere('wp_terms.term_id', 2568)
                ->orWhere('wp_terms.term_id', 2569)
                ->orWhere('wp_terms.term_id', 2570)
                ->orWhere('wp_terms.term_id', 2571)
                ->orWhere('wp_terms.term_id', 2572)
                ->orWhere('wp_terms.term_id', 2573)
                ->orWhere('wp_terms.term_id', 2574)
                ->orWhere('wp_terms.term_id', 2575)
                ->orWhere('wp_terms.term_id', 2576)
                ->orWhere('wp_terms.term_id', 2577)
                ->orWhere('wp_terms.term_id', 2578)
                ->orWhere('wp_terms.term_id', 2579)
                ->orWhere('wp_terms.term_id', 2580)
                ->orWhere('wp_terms.term_id', 2581)
                ->orWhere('wp_terms.term_id', 2582)
                ->orWhere('wp_terms.term_id', 2583)
                ->orWhere('wp_terms.term_id', 2584)
                ->orWhere('wp_terms.term_id', 2585)
                ->orWhere('wp_terms.term_id', 2586)
                ->orWhere('wp_terms.term_id', 2587)
                ->orWhere('wp_terms.term_id', 2588)
                ->orWhere('wp_terms.term_id', 2589)
                ->orWhere('wp_terms.term_id', 2590)
                ->orWhere('wp_terms.term_id', 2591)
                ->orWhere('wp_terms.term_id', 2592)
                ->orWhere('wp_terms.term_id', 2593)
                ->orWhere('wp_terms.term_id', 2594)
                ->orWhere('wp_terms.term_id', 2595)
                ->orWhere('wp_terms.term_id', 2596)
                ->orWhere('wp_terms.term_id', 2597)
                ->orWhere('wp_terms.term_id', 2598)
                ->orWhere('wp_terms.term_id', 2599)
                ->orWhere('wp_terms.term_id', 2600)
                ->orWhere('wp_terms.term_id', 2601)
                ->orWhere('wp_terms.term_id', 2602)
                ->orWhere('wp_terms.term_id', 2603)
                ->orWhere('wp_terms.term_id', 2604)
                ->orWhere('wp_terms.term_id', 2633)
                ->orWhere('wp_terms.term_id', 2634)
                ->orWhere('wp_terms.term_id', 2653)
                ->orWhere('wp_terms.term_id', 2659)
                ->orWhere('wp_terms.term_id', 2658)
                ->orWhere('wp_terms.term_id', 2657)
                ->orWhere('wp_terms.term_id', 2660)
                ->orWhere('wp_terms.term_id', 2665);
            })
        ->get();

        if($actors->isNotEmpty()){
            foreach ($actors as $actor){
                DB::table('maritimestatistiks')
                    ->where('id_listing', $actor->id)
                    ->update([
                        'flag_of_ship' => $actor->name
                    ]);
            }
            echo "sukses";
        }else{
            echo "empty";
        }

    }
}
