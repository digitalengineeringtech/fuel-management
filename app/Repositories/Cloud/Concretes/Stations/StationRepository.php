<?php

namespace App\Repositories\Cloud\Concretes\Stations;

use App\Http\Resources\Cloud\Stations\StationResource;
use App\Models\Station;
use App\Repositories\Cloud\Contracts\Stations\StationRepositoryInterface;
use App\Traits\HasGenerate;
use App\Traits\HasImage;
use App\Traits\HasResponse;
use Exception;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\DB;

class StationRepository implements StationRepositoryInterface
{
    use HasGenerate;
    use HasImage;
    use HasResponse;

    public function getStations($request)
    {
        try {
            $stations = Station::paginate(10);

            if (! $stations) {
                return $this->errorResponse('Stations not found', 404, null);
            }

            return StationResource::collection($stations);
        } catch (Exception $e) {
            return $this->errorResponse($e->getMessage(), 500, null);
        }
    }

    public function getStation($id)
    {
        try {
            $station = Station::find($id);

            if (! $station) {
                return $this->errorResponse('Station not found', 404, null);
            }

            return $this->successResponse('Station found', 200, new StationResource($station));

        } catch (Exception $e) {
            return $this->errorResponse($e->getMessage(), 500, null);
        }
    }

    public function createStation($data)
    {
        try {

            // Generate station number
            $stationNo = $this->generateStationNumber($data['shop_id']);

            // Generate a unique database name for the station
            $stationDatabase = $this->generateDatabaseName($stationNo);

            // Create a new station
            $station = Station::create([
                'shop_id' => $data['shop_id'],
                'name' => $data['name'],
                'station_no' => $stationNo,
                'license_no' => $data['license_no'],
                'image' => isset($data['image']) ?? $this->uploadImage('stations', $data['image']),
                'phone_one' => $data['phone_one'],
                'phone_two' => $data['phone_two'],
                'address' => $data['address'],
                'opening_date' => $data['opening_date'],
                'subscribe_year' => $data['subscribe_year'],
                'expiry_date' => $data['expiry_date'],
                'opening_hour' => $data['opening_hour'],
                'closing_hour' => $data['closing_hour'],
                'station_database' => $stationDatabase,
                'expose_url' => $data['expose_url'],
            ]);

            // if the station doesn't exist, return an error response and delete the database
            if (! $station) {
                DB::statement("DROP DATABASE IF EXISTS $station->station_database");

                return $this->errorResponse('Failed to create station', 400, null);
            }

            // Create a new database for mysql
            DB::statement("CREATE DATABASE $station->station_database");

            // Configure dynamic connection for the station database
            config(['database.connections.station' => [
                'driver' => env('DB_CONNECTION', 'mysql'),
                'host' => env('DB_HOST', '127.0.0.1'),
                'port' => env('DB_PORT', '3306'),
                'database' => $station->station_database,
                'username' => env('DB_USERNAME', 'hak'),
                'password' => env('DB_PASSWORD', 'hak5095905'),
                'charset' => 'utf8',
                'prefix' => '',
            ]]);

            // Run migrations for the station database using Artisan
            Artisan::call('migrate', ['--database' => 'station']);

            return $this->successResponse('Station successfully created', 201, new StationResource($station));
        } catch (Exception $e) {
            return $this->errorResponse($e->getMessage(), 500, null);
        }
    }

    public function updateStation($id, $data)
    {
        // Upload the image if provided
        try {
            // find the station by id
            $station = Station::find($id);

            // if the station doesn't exist, return an error response
            if (! $station) {
                return $this->errorResponse('Station not found', 404, null);
            }

            // update the station
            $station->update([
                'shop_id' => $data['shop_id'],
                'name' => $data['name'],
                'station_no' => $station->station_no,
                'license_no' => $data['license_no'],
                'image' => isset($data['image']) ?? $this->uploadImage('stations', $data['image']),
                'phone_one' => $data['phone_one'],
                'phone_two' => $data['phone_two'],
                'address' => $data['address'],
                'opening_date' => $data['opening_date'],
                'subscribe_year' => $data['subscribe_year'],
                'expiry_date' => $data['expiry_date'],
                'opening_hour' => $data['opening_hour'],
                'closing_hour' => $data['closing_hour'],
                'station_database' => $station->station_database,
                'expose_url' => $data['expose_url'],
            ]);

            return $this->successResponse('Station successfully updated', 200, new StationResource($station));
        } catch (Exception $e) {
            return $this->errorResponse($e->getMessage(), 500, null);
        }
    }

    public function deleteStation($id)
    {
        // find the station by id
        try {
            $station = Station::find($id);

            // if the station doesn't exist, return an error response
            if (! $station) {
                return $this->errorResponse('Station not found', 404, null);
            }

            // Delete the station's image if it exists
            if ($station->image) {
                $this->deleteImage($station->image);
            }

            // Delete the station's database
            $station->delete();

            return $this->successResponse('Station successfully deleted', 200, null);
        } catch (Exception $e) {
            return $this->errorResponse($e->getMessage(), 500, null);
        }
    }
}
