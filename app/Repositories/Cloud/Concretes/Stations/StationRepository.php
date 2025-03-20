<?php

namespace App\Repositories\Cloud\Concretes\Stations;

use App\Http\Resources\Cloud\Stations\StationResource;
use App\Models\Station;
use App\Repositories\Cloud\Contracts\Stations\StationRepositoryInterface;
use App\Traits\HasImage;
use App\Traits\HasResponse;
use Exception;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class StationRepository implements StationRepositoryInterface
{
    use HasImage;
    use HasResponse;

    public function getStations($request)
    {
        try {
            $stations = Station::paginate(10);

            if (! $stations) {
                return $this->errorResponse('Stations not found', 404, null);
            }

            return $this->successResponse('Stations successfully retrieved', 200, StationResource::collection($stations));
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
            // Generate a unique database name for the station
            $data['station_database'] = 'station_'.Str::slug($data['name'], '_').'_'.Str::lower($data['station_no']);

            // Upload the image if provided
            if (isset($data['image'])) {
                $data['image'] = $this->uploadImage('stations', $data['image']);
            }
            // Create a new station
            $station = Station::create($data);

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
            if (isset($data['image'])) {
                $data['image'] = $this->uploadImage('stations', $data['image']);
            }
            // find the station by id
            $station = Station::find($id);

            // if the station doesn't exist, return an error response
            if (! $station) {
                return $this->errorResponse('Station not found', 404, null);
            }

            // update the station
            $station->update($data);

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
