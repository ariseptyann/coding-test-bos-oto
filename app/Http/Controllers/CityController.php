<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\City;
use App\Models\Province;
use Symfony\Component\HttpFoundation\Response;

use View;

class CityController extends Controller
{
    protected $model;
    protected $title = 'City';
    protected $view  = 'city.';

    public function __construct(City $model){
        $this->model = $model;
    }

    public function index(Request $req){
        View::share('breadcrumbs', [
            [$this->title, route('city.index')],
            ['List '.$this->title, null]
        ]);

        if($req->ajax()) {
            $city   = $this->model
                    ->leftJoin('provinces', 'citys.province_id', '=', 'provinces.province_id')    
                    ->select('provinces.name as provname', 'citys.name as cityname');
            
            if ($req->city_name) {
                $city->where('citys.name', 'LIKE', "%{$req->city_name}%");
            }

            if ($req->province_id) {
                $city->where('citys.province_id', $req->province_id);
            }
            
            $data       = $city->orderBy('citys.name', 'asc')->paginate(10);
            $provinces  = Province::select('*')->orderBy('name', 'asc')->get();
            
            return view($this->view.'table')->with(compact(['data', 'provinces']));
        };
        
        return view($this->view.'index');
    }

    public function getCityByProvinceID($id = null)
    {
        $data = $this->model
                ->leftJoin('provinces', 'citys.province_id', '=', 'provinces.province_id')
                ->select('provinces.province_id as provid', 'provinces.name as provname', 'citys.city_id as cityid', 'citys.name as cityname')
                ->where('citys.province_id', $id)
                ->orderBy('provinces.name', 'asc')->get();

        $return = [];

        foreach ($data as $k => $v) {
            $return [] = (object)[
                'province_id'   => $v->provid,
                'provname'      => $v->provname,
                'city_id'       => $v->cityid,
                'cityname'      => $v->cityname
            ];
        }

        $response = [
            'status' => true,
            'data' => $return
        ];

        return response()->json($response, Response::HTTP_OK);
    }
}
