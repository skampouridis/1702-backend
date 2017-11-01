<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use FF;

/**
 * Vessel Position Model
 * 
 * @property string $mmsi
 * @property int $status
 * @property int $speed
 * @property float|int|string $lat
 * @property float|int|string $lon
 * @property int $course
 * @property int $heading
 * @property string $rot
 * @property datetime $timestamp
 * 
 */
class Position extends Model
{

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'vessel_positions';

    /**
     * Indicates if the model should be timestamped.
     *
     * @var bool
     */
    public $timestamps = false;

    /**
     * Blacklist fields for mass assignment
     *
     * @var array
     */
    protected $guarded = [];

    /**
     * Get table fields
     *
     * @return array
     */
    public static function getTableFields()
    {
        return [
            'mmsi', 'status', 'speed', 'lat', 'lon', 'course', 'heading', 'rot', 'timestamp'
        ];
    }
    
    /**
     * Normalize item: Position (pass by reference)
     *
     * @param \App\Models\Position $item
     * @return void
     */
    public static function normalizeItem(Position $item)
    {
        $item->mmsi = (string)$item->mmsi;
        $item->status = (int)$item->status;
        $item->speed = (int)$item->speed;
        $item->lat = (string)$item->lat;
        $item->lon = (string)$item->lon;
        $item->course = (int)$item->course;
        $item->heading = (int)$item->heading;
        $item->rot = (double)$item->rot;
        $item->timestamp = (string)$item->timestamp;                
    }    

    /**
     * Serialize fields for CSV (like jsonSerialize)
     *           
     * @return array
     */
    public function csvSerialize()
    {
        static $fields;
        if ($fields === null) {
            $fields = static::getTableFields();
        }

        $result = [];
        foreach ($fields as $key) {
            if (isset($this->$key)) {
                $result[$key] = $this->$key;
            }
        }

        return $result;
    }

    /**
     * Parse and normalize search filters from request
     *
     * @param array $form_data $request->all() | $_GET | $_POST | $_REQUEST etc.
     * @return array
     */
    public static function getSearchFilters(array $form_data = [])
    {
        $filters = [
            'filter_mmsi' => [],
            'filter_lat_from' => '',
            'filter_lat_to' => '',
            'filter_lon_from' => '',
            'filter_lon_to' => '',
            'filter_timestamp_from' => '',
            'filter_timestamp_to' => '',
        ];

        if (isset($form_data['filter_mmsi']) && is_array($form_data['filter_mmsi'])) {
            $filters['filter_mmsi'] = FF::varCleanFromInput($form_data['filter_mmsi']);
        }
        if (isset($form_data['filter_lat_from']) && is_numeric($form_data['filter_lat_from'])) {
            $filters['filter_lat_from'] = FF::varCleanFromInput($form_data['filter_lat_from']);
        }
        if (isset($form_data['filter_lat_to']) && is_numeric($form_data['filter_lat_to'])) {
            $filters['filter_lat_to'] = FF::varCleanFromInput($form_data['filter_lat_to']);
        }
        if (isset($form_data['filter_lon_from']) && is_numeric($form_data['filter_lon_from'])) {
            $filters['filter_lon_from'] = FF::varCleanFromInput($form_data['filter_lon_from']);
        }
        if (isset($form_data['filter_lon_to']) && is_numeric($form_data['filter_lon_to'])) {
            $filters['filter_lon_to'] = FF::varCleanFromInput($form_data['filter_lon_to']);
        }
        if (isset($form_data['filter_timestamp_from']) && FF::validateDatetime($form_data['filter_timestamp_from'])) {
            $filters['filter_timestamp_from'] = FF::varCleanFromInput($form_data['filter_timestamp_from']);            
        }
        if (isset($form_data['filter_timestamp_to']) && FF::validateDatetime($form_data['filter_timestamp_to'])) {
            $filters['filter_timestamp_to'] = FF::varCleanFromInput($form_data['filter_timestamp_to']);
        }

        return $filters;
    }

    /**
     * Get search result
     *
     * @param array $filters
     * @see \App\Models\Position::getSearchFilters()
     * @return \Illuminate\Pagination\LengthAwarePaginator
     */
    public static function getSearchResult(array $filters = [])
    {
        /* build sql parts... */

        // select
        $q_select = "*";

        // from
        $q_from = "vessel_positions";

        // where
        $q_where_parts = [];
        if (!empty($filters['filter_mmsi'])) {
            $filters['filter_mmsi'] = array_map(function($value) {
                return FF::q($value);
            }, $filters['filter_mmsi']);
            $q_where_parts[] = " `mmsi` IN (" . implode(',', $filters['filter_mmsi']) . ") ";
        }
        if (!empty($filters['filter_lat_from'])) {
            $q_where_parts[] = " `lat` >= " . FF::q($filters['filter_lat_from']) . " ";
        }
        if (!empty($filters['filter_lat_to'])) {
            $q_where_parts[] = " `lat` <= " . FF::q($filters['filter_lat_to']) . " ";
        }
        if (!empty($filters['filter_lon_from'])) {
            $q_where_parts[] = " `lon` >= " . FF::q($filters['filter_lon_from']) . " ";
        }
        if (!empty($filters['filter_lon_to'])) {
            $q_where_parts[] = " `lon` <= " . FF::q($filters['filter_lon_to']) . " ";
        }
        if (!empty($filters['filter_timestamp_from'])) {
            $q_where_parts[] = " `timestamp` >= " . FF::q($filters['filter_timestamp_from']) . " ";
        }
        if (!empty($filters['filter_timestamp_to'])) {
            $q_where_parts[] = " `timestamp` <= " . FF::q($filters['filter_timestamp_to']) . " ";
        }
        if (count($q_where_parts)) {
            $q_where = implode(' AND ', $q_where_parts);
        } else {
            $q_where = "1";
        }

        // Final sql should look like this.. or enable _ffDebugTemp in AppServiceProvider
        //$query = "SELECT $q_select FROM $q_from WHERE $q_where";
        //FF::dd($query);

        $paginator = DB::table($q_from)->select($q_select)->whereRaw($q_where)->paginate(config('app.ff_api_per_page'));
        $paginator->getCollection()->transform(function ($item) {            
            $pos = new static;
            $pos->fill((array)$item);
            static::normalizeItem($pos);
            return $pos;
        });

    
        return $paginator;
    }

}
