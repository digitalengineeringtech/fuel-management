<?php

namespace App\Repositories\Cloud\Concretes\Stations;

use App\Models\Station;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\DB;
use App\Repositories\Cloud\Contracts\Stations\StationRepositoryInterface;
use Illuminate\Support\Facades\Artisan;

class StationRepository implements StationRepositoryInterface
{
     public function getStations($request)
     {
         return Station::paginate(10);
     }

     public function getStation($id)
     {
         return Station::findOrFail($id);
     }

     public function createStation($data)
     {
         // Generate a unique database name for the station
         $data['station_database'] = 'station_' . Str::slug($data['name'], '_') . '_' . $data['station_no'];

         // Create a new station
         $station = Station::create($data);

         // Create a new database
         DB::statement("CREATE DATABASE $station->station_database");

         // Configure dynamic connection for the station database
         config(['database.connections.station' => [
            'driver' => 'pgsql',
            'host' => env('DB_HOST', '127.0.0.1'),
            'port' => env('DB_PORT', '5432'),
            'database' => $station->station_database,
            'username' => env('DB_USERNAME', 'postgres'),
            'password' => env('DB_PASSWORD', ''),
            'charset' => 'utf8',
            'prefix' => '',
            'schema' => 'public',
         ]]);

         // Run migrations for the station database using Artisan
         Artisan::call('migrate', ['--database' => 'station']);

         return $station;

     }

     public function updateStation($id, $data)
     {
         $station = Station::findOrFail($id);

         $station->update($data);

         return $station;
     }

     public function deleteStation($id)
     {
         $station = Station::findOrFail($id);

         $station->delete();

         return $station;
     }


}
