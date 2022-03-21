<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Province;
use Symfony\Component\HttpFoundation\Response;

use View;

class ProvinceController extends Controller
{
    protected $model;
    protected $title = 'Province';
    protected $view  = 'province.';

    public function __construct(Province $model){
        $this->model = $model;
    }

    public function index(Request $req){
        View::share('breadcrumbs', [
            [$this->title, route('province.index')],
            ['List '.$this->title, null]
        ]);

        if($req->ajax()) {
            $province   = $this->model->select('*');
            
            if ($req->province_name) {
                $province->where('name', 'LIKE', "%{$req->province_name}%");
            }
            
            $data       = $province->orderBy('name', 'asc')->paginate(10);
                    
            return view($this->view.'table')->with(compact('data'));
        };

        return view($this->view.'index');
    }

    public function getAll()
    {
        $data = $this->model->orderBy('name', 'asc')->get();

        $return = [];

        foreach ($data as $k => $v) {
            $return [] = (object)[
                'province_id' => $v->province_id,
                'province_name' => $v->name
            ];
        }

        $response = [
            'status' => true,
            'data' => $return
        ];

        return response()->json($response, Response::HTTP_OK);
    }
}
