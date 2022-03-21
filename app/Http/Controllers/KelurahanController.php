<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\City;
use App\Models\Kelurahan;
use Symfony\Component\HttpFoundation\Response;

use View;

class KelurahanController extends Controller
{
    protected $model;
    protected $title = 'Kelurahan';
    protected $view  = 'kelurahan.';

    public function __construct(Kelurahan $model){
        $this->model = $model;
    }

    public function index(Request $req){
        View::share('breadcrumbs', [
            [$this->title, route('kelurahan.index')],
            ['List '.$this->title, null]
        ]);

        if($req->ajax()) {
            $kelu   = $this->model
                    ->leftJoin('citys', 'kelurahans.city_id', '=', 'citys.city_id')    
                    ->select('citys.name as cityname', 'kelurahans.name as keluname');
            
            if ($req->kelu_name) {
                $kelu->where('kelurahans.name', 'LIKE', "%{$req->kelu_name}%");
            }

            if ($req->city_id) {
                $kelu->where('kelurahans.city_id', $req->city_id);
            }
            
            $data   = $kelu->orderBy('kelurahans.name', 'asc')->paginate(10);
            $citys  = City::select('*')->orderBy('name', 'asc')->get();
            
            return view($this->view.'table')->with(compact(['data', 'citys']));
        };
        
        return view($this->view.'index');
    }

    public function getKelurahanByCityID($id = null)
    {
        $data = $this->model
                ->leftJoin('citys', 'kelurahans.city_id', '=', 'citys.city_id')
                ->select('kelurahans.kelurahan_id as keluid', 'kelurahans.name as keluname', 'citys.city_id as cityid', 'citys.name as cityname')
                ->where('kelurahans.city_id', $id)
                ->orderBy('citys.name', 'asc')->get();

        $return = [];

        foreach ($data as $k => $v) {
            $return [] = (object)[
                'city_id'       => $v->cityid,
                'cityname'      => $v->cityname,
                'kelurahan_id'  => $v->keluid,
                'keluname'      => $v->keluname
            ];
        }

        $response = [
            'status' => true,
            'data' => $return
        ];

        return response()->json($response, Response::HTTP_OK);
    }
}
