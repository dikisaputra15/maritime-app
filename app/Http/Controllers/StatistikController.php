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
        $tgl_now = $tgl->format('Y-m-d');
        // $tgl_now = '2024-09-19';
        // $tgl_coba = ['2024-09-02', '2024-10-01'];
        $icats = DB::table('fxr_terms')
            ->join('fxr_term_taxonomy', 'fxr_terms.term_id', '=', 'fxr_term_taxonomy.term_id')
            ->join('fxr_term_relationships', 'fxr_term_taxonomy.term_taxonomy_id', '=', 'fxr_term_relationships.term_taxonomy_id')
            ->join('fxr_posts', 'fxr_posts.ID', '=', 'fxr_term_relationships.object_id')
            ->join('fxr_w2gm_locations_relationships', 'fxr_posts.ID', '=', 'fxr_w2gm_locations_relationships.post_id')
            ->join('fxr_lokasi', 'fxr_w2gm_locations_relationships.location_id', '=', 'fxr_lokasi.location_id')
            ->select('fxr_posts.ID', 'fxr_posts.post_title', 'fxr_w2gm_locations_relationships.id', 'fxr_w2gm_locations_relationships.address_line_1', 'fxr_lokasi.sea_ocean', 'fxr_lokasi.country', 'fxr_lokasi.area', 'fxr_lokasi.location', 'fxr_w2gm_locations_relationships.map_coords_1', 'fxr_w2gm_locations_relationships.map_coords_2', 'fxr_terms.name', 'fxr_w2gm_locations_relationships.number_of_incident', 'fxr_w2gm_locations_relationships.number_of_injuries', 'fxr_w2gm_locations_relationships.number_of_fatalities', 'fxr_w2gm_locations_relationships.additional_info', 'fxr_posts.post_date', 'fxr_terms.name')
            ->where('fxr_posts.post_status', 'publish')
            ->whereDate(DB::raw('DATE(fxr_posts.post_date)'), $tgl_now)
            // ->whereBetween(DB::raw('DATE(fxr_posts.post_date)'), [$tgl_coba[0], $tgl_coba[1]])
            ->where(function($query) {
                $query->where('fxr_terms.term_id', 2451)
                      ->orWhere('fxr_terms.term_id', 2456)
                      ->orWhere('fxr_terms.term_id', 2853);
            })
            ->get();

            // $no = 1;
            // foreach ($icats as $icat) {
            //     echo $no++ . " " . $icat->ID . " " . $icat->id . " " . $icat->post_title . " ". $icat->name ."<br>";
            // }

        if($icats->isNotEmpty()){
            foreach ($icats as $icat){
                $loc = $icat->map_coords_1 . "," . " " . $icat->map_coords_2;
                $weburl = "https://maritime.concordreview.com/incident-tracking/#w2gm-listing-";

                $category = [
                    'id_listing' => $icat->id,
                    'post_id_cat' => $icat->ID,
                    'listing_date' => NULL,
                    'post_title' => $icat->post_title,
                    'address' => $icat->address_line_1,
                    'sea_ocean' => $icat->sea_ocean,
                    'country' => $icat->country,
                    'area' => $icat->area,
                    'location' => $icat->location,
                    'region' => Null,
                    'coordinate' => $loc,
                    'main_incident' => $icat->name,
                    'incident_category' => NULL,
                    'actor' => NULL,
                    'perpetrators' => NULL,
                    'time_of_incident' => NULL,
                    'night_type' => NULL,
                    'timeofincidenttype' => NULL,
                    'flag_of_ship_actor' => NULL,
                    'flag_of_ship_target' => NULL,
                    'type_of_ship' => NULL,
                    'type_of_ship_actor' => NULL,
                    'vessel_loss' => NULL,
                    'property_loss' => NULL,
                    'treatment_of_crew' => NULL,
                    'injury' => NULL,
                    'fatality' => NULL,
                    'assaulted_type' => NULL,
                    'weapons' => NULL,
                    'number_of_incident' => $icat->number_of_incident,
                    'number_of_injuries' => $icat->number_of_injuries,
                    'number_of_fatalities' => $icat->number_of_fatalities,
                    'additional_info' => $icat->additional_info,
                    'url' => $weburl . $icat->ID,
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
