<table class="table display nowrap table-striped table-bordered scroll-horizontal-vertical">
    <thead>
        <tr>
            <th>Province</th>
            <th>City</th> 
            <th>Kelurahan</th>       
            <th>Kecamatan</th>
            <th>Action</th>
        </tr>
        <tr>
            <th>
                <div class="form-group position-relative has-icon-left">
                    <input type="text" class="form-control" name="prov_name" placeholder="Cari nama provinsi">
                    <div class="form-control-position">
                        <i class="icon-magnifier"></i>
                    </div>
                </div>
            </th>
            <th>
                <div class="form-group">
                    <select class="select2 form-control" name="city_id">
                        <option value="">Pilih City</option>
                        @foreach ($citys as $item)
                            <option value="{{ $item->city_id }}">{{ $item->name }}</option>
                        @endforeach
                    </select>
                </div> 
            </th>
            <th>
                <div class="form-group position-relative has-icon-left">
                    <input type="text" class="form-control" name="kelu_name" placeholder="Cari nama kelurahan">
                    <div class="form-control-position">
                        <i class="icon-magnifier"></i>
                    </div>
                </div>
            </th>
            <th>
                <div class="form-group position-relative has-icon-left">
                    <input type="text" class="form-control" name="kec_name" placeholder="Cari nama kecamatan">
                    <div class="form-control-position">
                        <i class="icon-magnifier"></i>
                    </div>
                </div>
            </th>
        </tr>
    </thead>
    <tbody>
        @foreach ($data as $item)
        <tr>
            <td>{{ $item->provname }}</td>
            <td>{{ $item->cityname }}</td>
            <td>{{ $item->keluname }}</td>
            <td>{{ $item->kecaname }}</td>
            <td>
                <span class="dropdown">
                    <a href="#" class="btn btn-sm btn-clean btn-icon btn-icon-md" data-toggle="dropdown" aria-expanded="true">
                        <i class="la la-ellipsis-h"></i>
                    </a>
                    <div class="dropdown-menu">
                        <a class="dropdown-item" href="{{ route('kecamatan.index') }}/{{ $item->id }}/edit">
                            <i class="la la-edit"></i> Edit
                        </a>
                        <form action="{{ route('kecamatan.index') }}/{{ $item->id }}" method="post" class="form-inline">
                            @method('DELETE') @csrf
                            <button class="dropdown-item delete-from-table">
                                <i class="la la-trash"></i> Delete
                            </button>
                        </form>
                    </div>
                </span>
            </td>
        </tr>
        @endforeach
    </tbody>
</table>
@if ($data->lastPage() > 1)
    <nav aria-label="Page navigation">
        <ul class="pagination justify-content-right pagination-separate pagination-round pagination-flat">
            {!! getPrevious($data->currentPage(), $data->currentPage()-1 ) !!}
            @php
                $no = 1;
            @endphp
            @if ($data->currentPage() > 2 )
                <li class="page-item">
                    <a href="javascript:void(0)" class="page-link paginate" data-page="{{ '1' }}">1</a>
                </li>
            @endif
            @if($data->currentPage() > 3)
                <li class="page-item"><span>.</span></li>
            @endif
            @foreach(range(1, $data->lastPage()) as $i)
                @if($i >= $data->currentPage() - 1 && $i <= $data->currentPage() + 1)
                    @if ($i == $data->currentPage())
                        <li class="page-item active">
                            <a href="javascript:void(0)" class="page-link" aria-controls="exit-goods" data-dt-idx="1" tabindex="0">
                                {{ $i }}
                            </a>
                        </li>
                    @else
                        <li class="page-item">
                            <a href="javascript:void(0)" class="page-link paginate" data-page="{{ $i }}">
                                {{ $i }}
                            </a>
                        </li>
                    @endif
                @endif
                @endforeach
                @if($data->currentPage() < $data->lastPage() - 2)
                    <li class="page-item"><span>.</span></li>
                @endif
                @if($data->currentPage() < $data->lastPage() - 1)
                    <li class="page-item">
                        <a href="javascript:void(0)" class="page-link paginate" data-page="{{ $data->lastPage() }}">{{ $data->lastPage() }}</a>
                    </li>
                @endif
            {!! getNext($data->currentPage(), $data->lastPage(), $data->currentPage()+1 ) !!}
        </ul>
    </nav>
@endif