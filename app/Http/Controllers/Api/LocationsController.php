<?php

namespace App\Http\Controllers\Api;

use App\Location;
use App\LocationCheckIn;
use App\Repositories\LocationRepository;
use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;

class LocationsController extends Controller
{
    private $locationRepository;

    public function __construct(LocationRepository $locationRepository)
    {
        $this->locationRepository = $locationRepository;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $this->locationRepository->test();

        $locations = Location::query()->orderBy('created_at', 'desc')->get();
        return response()->json([
            'locations' => $locations,
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $input = $request->get('input');
        $now = Carbon::now()->format('Y-m-d');
        $input['location_check_ins_list'] = [
            [
                'rate' => 1,
                'memo' => "こんにちわ",
                    'date' => $now,
            ],
            [
                'rate' => 2,
                'memo' => "さようなら",
                'date' => $now,
            ],
        ];

        try {
            $result = DB::transaction(function () use ($input) {
                $location = new Location();
                $location->fill($input);
                $location->save();

                $foreignKeyValue = [
                    'location_id' => $location->id,
                ];
                $intermediateClasses = [
                    LocationCheckIn::class,
                ];
                foreach ($intermediateClasses as $class) {
                    $attrName = (new $class())->getTable() . '_list';
                    $params = array_get($input, $attrName, []);
                    $location[$attrName] = $this->bulkInsert($params, $foreignKeyValue, $class);
                }

                return $location;
            });
        } catch (\Throwable $throwable) {
            // TODO: エラーステータスを画面に返す
            logger('エラーをキャッチ');
        }

        return response()->json([
            'location' => $result,
        ]);
    }

    private function bulkInsert(array $params, array $foreignKeyValue, string $class)
    {
        $res = [];
        foreach ($params as $param) {
            foreach ($foreignKeyValue as $key => $value) {
                $param[$key] = $value;
            }

            $instance = new $class();
            $instance->fill($param);
            $instance->save();

            $res[] = $instance;
        }

        return $res;
    }

    /**
     * Display the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
