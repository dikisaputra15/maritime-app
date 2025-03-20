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

        $actors = DB::table('fxr_w2gm_locations_relationships')
        ->join('fxr_term_relationships', 'fxr_term_relationships.object_id', '=', 'fxr_w2gm_locations_relationships.post_id')
        ->join('fxr_term_taxonomy', 'fxr_term_taxonomy.term_taxonomy_id', '=', 'fxr_term_relationships.term_taxonomy_id')
        ->join('fxr_terms', 'fxr_terms.term_id', '=', 'fxr_term_taxonomy.term_id')
        ->join('fxr_posts', 'fxr_posts.ID', '=', 'fxr_w2gm_locations_relationships.post_id')
        ->select('fxr_w2gm_locations_relationships.id', 'fxr_terms.name')
        ->whereDate(DB::raw('DATE(fxr_posts.post_date)'), $tgl_now)
        // ->whereBetween(DB::raw('DATE(fxr_posts.post_date)'), [$tgl_coba[0], $tgl_coba[1]])
        ->where(function($query) {
            $query->Where('fxr_terms.term_id', 2551)
                ->orWhere('fxr_terms.term_id', 2552)
                ->orWhere('fxr_terms.term_id', 2553)
                ->orWhere('fxr_terms.term_id', 2554)
                ->orWhere('fxr_terms.term_id', 2555)
                ->orWhere('fxr_terms.term_id', 2556)
                ->orWhere('fxr_terms.term_id', 2557)
                ->orWhere('fxr_terms.term_id', 2558)
                ->orWhere('fxr_terms.term_id', 2559)
                ->orWhere('fxr_terms.term_id', 2560)
                ->orWhere('fxr_terms.term_id', 2561)
                ->orWhere('fxr_terms.term_id', 2562)
                ->orWhere('fxr_terms.term_id', 2563)
                ->orWhere('fxr_terms.term_id', 2564)
                ->orWhere('fxr_terms.term_id', 2565)
                ->orWhere('fxr_terms.term_id', 2566)
                ->orWhere('fxr_terms.term_id', 2567)
                ->orWhere('fxr_terms.term_id', 2568)
                ->orWhere('fxr_terms.term_id', 2569)
                ->orWhere('fxr_terms.term_id', 2570)
                ->orWhere('fxr_terms.term_id', 2571)
                ->orWhere('fxr_terms.term_id', 2572)
                ->orWhere('fxr_terms.term_id', 2573)
                ->orWhere('fxr_terms.term_id', 2574)
                ->orWhere('fxr_terms.term_id', 2575)
                ->orWhere('fxr_terms.term_id', 2576)
                ->orWhere('fxr_terms.term_id', 2577)
                ->orWhere('fxr_terms.term_id', 2578)
                ->orWhere('fxr_terms.term_id', 2579)
                ->orWhere('fxr_terms.term_id', 2580)
                ->orWhere('fxr_terms.term_id', 2581)
                ->orWhere('fxr_terms.term_id', 2582)
                ->orWhere('fxr_terms.term_id', 2583)
                ->orWhere('fxr_terms.term_id', 2584)
                ->orWhere('fxr_terms.term_id', 2585)
                ->orWhere('fxr_terms.term_id', 2586)
                ->orWhere('fxr_terms.term_id', 2587)
                ->orWhere('fxr_terms.term_id', 2588)
                ->orWhere('fxr_terms.term_id', 2589)
                ->orWhere('fxr_terms.term_id', 2590)
                ->orWhere('fxr_terms.term_id', 2591)
                ->orWhere('fxr_terms.term_id', 2592)
                ->orWhere('fxr_terms.term_id', 2593)
                ->orWhere('fxr_terms.term_id', 2594)
                ->orWhere('fxr_terms.term_id', 2595)
                ->orWhere('fxr_terms.term_id', 2596)
                ->orWhere('fxr_terms.term_id', 2597)
                ->orWhere('fxr_terms.term_id', 2598)
                ->orWhere('fxr_terms.term_id', 2599)
                ->orWhere('fxr_terms.term_id', 2600)
                ->orWhere('fxr_terms.term_id', 2601)
                ->orWhere('fxr_terms.term_id', 2602)
                ->orWhere('fxr_terms.term_id', 2603)
                ->orWhere('fxr_terms.term_id', 2604)
                ->orWhere('fxr_terms.term_id', 2633)
                ->orWhere('fxr_terms.term_id', 2634)
                ->orWhere('fxr_terms.term_id', 2653)
                ->orWhere('fxr_terms.term_id', 2659)
                ->orWhere('fxr_terms.term_id', 2658)
                ->orWhere('fxr_terms.term_id', 2657)
                ->orWhere('fxr_terms.term_id', 2660)
                ->orWhere('fxr_terms.term_id', 2665)
                ->orWhere('fxr_terms.term_id', 2836);
            })
        ->get();

        if($actors->isNotEmpty()){
            foreach ($actors as $actor){
                DB::table('maritimestatistiks')
                    ->where('id_listing', $actor->id)
                    ->update([
                        'flag_of_ship_target' => $actor->name
                    ]);
            }
            echo "sukses";
        }else{
            echo "empty";
        }

    }
}
