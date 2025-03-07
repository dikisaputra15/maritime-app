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
            $query->Where('fxr_terms.term_id', 2514)
                ->orWhere('fxr_terms.term_id', 2515)
                ->orWhere('fxr_terms.term_id', 2516)
                ->orWhere('fxr_terms.term_id', 2516)
                ->orWhere('fxr_terms.term_id', 2518)
                ->orWhere('fxr_terms.term_id', 2519)
                ->orWhere('fxr_terms.term_id', 2520)
                ->orWhere('fxr_terms.term_id', 2521)
                ->orWhere('fxr_terms.term_id', 2632)
                ->orWhere('fxr_terms.term_id', 2522);
            })
        ->get();

        if($actors->isNotEmpty()){
            foreach ($actors as $actor){
                DB::table('maritimestatistiks')
                    ->where('id_listing', $actor->id)
                    ->update([
                        'treatment_of_crew' => $actor->name
                    ]);
            }
            echo "sukses";
        }else{
            echo "empty";
        }

    }
}
