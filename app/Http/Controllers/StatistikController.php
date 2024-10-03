<?php

namespace App\Http\Controllers;

use App\Models\Maritimestatistik;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class StatistikController extends Controller
{
    public function index()
    {
        ini_set('max_execution_time', 3600);

        $tgl = Carbon::now();
        // $tgl_now = $tgl->format('Y-m-d');
        $tgl_now = '2024-09-19';
        $tgl_coba = ['2024-09-02', '2024-10-01'];
        $icats = DB::table('wp_terms')
            ->join('wp_term_taxonomy', 'wp_terms.term_id', '=', 'wp_term_taxonomy.term_id')
            ->join('wp_term_relationships', 'wp_term_taxonomy.term_taxonomy_id', '=', 'wp_term_relationships.term_taxonomy_id')
            ->join('wp_posts', 'wp_posts.ID', '=', 'wp_term_relationships.object_id')
            ->join('wp_w2gm_locations_relationships', 'wp_posts.ID', '=', 'wp_w2gm_locations_relationships.post_id')
            ->select('wp_posts.ID', 'wp_posts.post_title', 'wp_w2gm_locations_relationships.id', 'wp_w2gm_locations_relationships.address_line_1', 'wp_w2gm_locations_relationships.map_coords_1', 'wp_w2gm_locations_relationships.map_coords_2', 'wp_terms.name', 'wp_w2gm_locations_relationships.number_of_incident', 'wp_w2gm_locations_relationships.number_of_injuries', 'wp_w2gm_locations_relationships.number_of_fatalities', 'wp_w2gm_locations_relationships.additional_info', 'wp_posts.post_date', 'wp_terms.name')
            ->where('wp_posts.post_status', 'publish')
            // ->whereDate(DB::raw('DATE(wp_posts.post_date)'), $tgl_now)
            ->whereBetween(DB::raw('DATE(wp_posts.post_date)'), [$tgl_coba[0], $tgl_coba[1]])
            ->where(function($query) {
                $query->where('wp_terms.term_id', 2451)
                      ->orWhere('wp_terms.term_id', 2456);
            })
            ->get();

            // $no = 1;
            // foreach ($icats as $icat) {
            //     echo $no++ . " " . $icat->ID . " " . $icat->id . " " . $icat->post_title . " ". $icat->name ."<br>";
            // }    

        if($icats->isNotEmpty()){
            foreach ($icats as $icat){
                $loc = $icat->map_coords_1 . "," . " " . $icat->map_coords_2;
        
                $category = [
                    'id_listing' => $icat->id,
                    'post_id_cat' => $icat->ID,
                    'listing_date' => NULL,
                    'post_title' => $icat->post_title,
                    'address' => $icat->address_line_1,
                    'country' => Null,
                    'location' => $loc,
                    'main_incident' => $icat->name,
                    'incident_category' => NULL,
                    'actor' => NULL,
                    'perpetrators' => NULL,
                    'time_of_incident' => NULL,
                    'night_type' => NULL,
                    'flag_of_ship' => NULL,
                    'type_of_ship' => NULL,
                    'stolen_property' => NULL,
                    'treatment_of_crew' => NULL,
                    'weapons' => NULL,
                    'number_of_incident' => $icat->number_of_incident,
                    'number_of_injuries' => $icat->number_of_injuries,
                    'number_of_fatalities' => $icat->number_of_fatalities,
                    'additional_info' => $icat->additional_info,
                    'date_posting' => $icat->post_date
                ];

                // DB::table('statistiks')->insert($category);
                $criteria = ['id_listing' => $icat->id];

             Maritimestatistik::firstOrCreate(
                    $criteria,
                    $category
                );

            }
            echo "sukses";
        }else{
            echo "empty";
        }
    }
}
