<x-app-layout>
    @section('style')
        <link rel="stylesheet" type="text/css" href="{{ asset('template-asset/app-assets/vendors/css/forms/selects/select2.min.css') }}">
    @endsection

    <div class="row">
        <div class="col-sm-12 col-md-10">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title">Edit Kecamatan</h4>
                    <a class="heading-elements-toggle">
                        <i class="ft-align-justify font-medium-3"></i>
                    </a>
                    <div class="heading-elements">
                        <ul class="list-inline mb-0">
                            <li>
                                <a data-action="collapse">
                                    <i class="ft-minus"></i>
                                </a>
                            </li>
                            <li>
                                <a data-action="expand">
                                    <i class="ft-maximize"></i>
                                </a>
                            </li>
                        </ul>
                    </div>
                </div>
                <div class="card-content collapse show">
                    <div class="card-body">
                        <form action="{{ route('kecamatan.update', $id) }}" method="post">
                            @csrf
                            @method('PUT')
                            <div class="form-body">
                                <div class="row">
                                    <div class="form-group col-md-6">
                                        <label>Kelurahan</label>
                                        <select class="select2 form-control" name="kelurahan_id" style="width: 100%">
                                            <option value="">Pilih Kelurahan</option>
                                            @foreach ($kelurahans as $item)
                                                <option value="{{ $item->kelurahan_id }}" {{ ( $item->kelurahan_id == $data->kelurahan_id) ? 'selected' : '' }}>{{ $item->name }}</option>
                                            @endforeach
                                        </select>
                                    </div>

                                    <div class="form-group col-md-6">
                                        <label>Name</label>
                                        <input type="text" name="name" class="form-control" placeholder="Name" autocomplete="off" value="{{$data->name}}">
                                    </div>
                                </div>
                            </div>
                            <div class="form-actions">
                                <div class="text-right">
                                    <button type="reset" class="btn btn-outline-warning"> 
                                        <i class="ft-refresh-cw"></i> Reset
                                    </button>
                                    <button type="submit" class="btn btn-outline-primary ml-1"> 
                                        <i class="ft-check"></i> update
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    @section('script')
        <script src="{{ asset('template-asset/app-assets/vendors/js/forms/select/select2.full.min.js') }}"></script>
        <script src="{{ asset('template-asset/app-assets/js/scripts/forms/select/form-select2.min.js') }}"></script>
    @endsection
</x-app-layout>