<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\City;
use App\Models\Kecamatan;
use Symfony\Component\HttpFoundation\Response;
use Maatwebsite\Excel\Facades\Excel;
use App\Imports\KecamatanImport;
use App\Exports\KecamatanExport;

use View, Alert;

class KecamatanController extends Controller
{
    protected $model;
    protected $title = 'Import Data Kecamatan';
    protected $view  = 'kecamatan.';

    public function __construct(Kecamatan $model){
        $this->model = $model;
    }

    public function index(Request $req){
        View::share('breadcrumbs', [
            [$this->title, route('kecamatan.index')],
            ['List '.$this->title, null]
        ]);

        if($req->ajax()) {
            $keca   = $this->model
                    ->leftJoin('kelurahans', 'kecamatans.kelurahan_id', '=', 'kelurahans.kelurahan_id')
                    ->leftJoin('citys', 'kelurahans.city_id', '=', 'citys.city_id')
                    ->leftJoin('provinces', 'citys.province_id', '=', 'provinces.province_id')
                    ->select('provinces.name as provname', 'citys.name as cityname', 'kelurahans.name as keluname', 'kecamatans.kecamatan_id as id', 'kecamatans.name as kecaname');
            
            if ($req->prov_name) {
                $keca->where('provinces.name', 'LIKE', "%{$req->prov_name}%");
            }

            if ($req->city_id) {
                $keca->where('kelurahans.city_id', $req->city_id);
            }

            if ($req->kelu_name) {
                $keca->where('kelurahans.name', 'LIKE', "%{$req->kelu_name}%");
            }

            if ($req->kec_name) {
                $keca->where('kecamatans.name', 'LIKE', "%{$req->kec_name}%");
            }
            
            $data   = $keca->orderBy('provinces.name', 'asc')->paginate(10);
            $citys  = City::select('*')->orderBy('name', 'asc')->get();
            
            return view($this->view.'table')->with(compact(['data', 'citys']));
        };

        return view($this->view.'index');
    }

    public function getKecamatanByKelurahanID($id = null)
    {
        $data = $this->model
                ->leftJoin('kelurahans', 'kecamatans.kelurahan_id', '=', 'kelurahans.kelurahan_id')
                ->select('kelurahans.kelurahan_id as keluid', 'kelurahans.name as keluname', 'kecamatans.kecamatan_id as kecid', 'kecamatans.name as kecname')
                ->where('kecamatans.kelurahan_id', $id)
                ->orderBy('kelurahans.name', 'asc')->get();

        $return = [];

        foreach ($data as $k => $v) {
            $return [] = (object)[
                'kelurahan_id'  => $v->keluid,
                'keluname'      => $v->keluname,
                'kecamatan_id'  => $v->kecid,
                'kecname'       => $v->kecname
            ];
        }

        $response = [
            'status' => true,
            'data' => $return
        ];

        return response()->json($response, Response::HTTP_OK);
    }

    public function destroy($id)
    {
        $data = $this->model->where('kecamatan_id', $id);
        if($data->delete()){
            Alert::success('Success', 'Data telah berhasil dihapus');
            return redirect()->back();
        }else{
            Alert::error('Gagal', 'Data gagal dihapus');
            return redirect()->back();
        }
    }

    public function import(Request $req)
    {
        $req->validate([
            'file' => 'required|mimes:csv,xls,xlsx'
        ]);

        try {

            ini_set('memory_limit', '-1');
            ini_set('max_execution_time', '7200');
            Excel::import(new KecamatanImport, $req->file);

            Alert::success('Berhasil', 'Data telah berhasil di import');
            return redirect()->route('kecamatan.index');

        } catch (\Maatwebsite\Excel\Validators\ValidationException $e) {
            $failures = $e->failures();
            foreach ($failures as $failure) {
                Alert::error('Gagal', $failure->errors());
                return redirect()->route('kecamatan.index');
            }
        }
    }

    public function export()
    {
        ini_set('memory_limit', '-1');
        ini_set('max_execution_time', '7200');
        $data   = $this->model
                    ->leftJoin('kelurahans', 'kecamatans.kelurahan_id', '=', 'kelurahans.kelurahan_id')
                    ->leftJoin('citys', 'kelurahans.city_id', '=', 'citys.city_id')
                    ->leftJoin('provinces', 'citys.province_id', '=', 'provinces.province_id')
                    ->select('provinces.name as provname', 'citys.name as cityname', 'kelurahans.name as keluname', 'kecamatans.name as kecaname')
                    ->orderBy('provinces.name', 'asc')->get();
        return Excel::download(new KecamatanExport($data), 'kecamatan.xlsx');
    }
}
