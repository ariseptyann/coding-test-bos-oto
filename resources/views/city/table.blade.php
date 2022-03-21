<table class="table display nowrap table-striped table-bordered scroll-horizontal-vertical">
    <thead>
        <tr>
            <th>Province</th> 
            <th>City</th>       
        </tr>
        <tr>
            <th>
                <div class="form-group">
                    <select class="select2 form-control" name="province_id" style="width: 100%">
                        <option value="">Pilih Province</option>
                        @foreach ($provinces as $item)
                            <option value="{{ $item->province_id }}">{{ $item->name }}</option>
                        @endforeach
                    </select>
                </div> 
            </th>
            <th>
                <fieldset class="form-group position-relative has-icon-left">
                    <input type="text" class="form-control" name="city_name" placeholder="Cari nama city">
                    <div class="form-control-position">
                        <i class="icon-magnifier"></i>
                    </div>
                </fieldset>
            </th>
        </tr>
    </thead>
    <tbody>
        @foreach ($data as $item)
        <tr>
            <td>{{ $item->provname }}</td>
            <td>{{ $item->cityname }}</td>
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