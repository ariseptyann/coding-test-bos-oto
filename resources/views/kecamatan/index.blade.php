<x-app-layout>
    @section('style')
        <link rel="stylesheet" type="text/css" href="{{ asset('template-asset/app-assets/vendors/css/forms/selects/select2.min.css') }}">
        <link rel="stylesheet" type="text/css" href="{{ asset('template-asset/app-assets/vendors/css/tables/datatable/datatables.min.css') }}">
    @endsection

    <div class="row">
        <div class="col-sm-12">
            <div class="card">
                <div class="card-header">
                    <a class="heading-elements-toggle">
                        <i class="ft-align-justify font-medium-3"></i>
                    </a>
                    <div class="heading-elements">
                            <a href="{{ route('kecamatan.export') }}" class="btn btn-outline-primary">
                                <i class="icon-cloud-download"></i>
                                Download to Excel
                            </a>
                            <button class="btn btn-primary btn-sm import" data-toggle="modal" style="height: 32px;">
                                <i class="icon-cloud-upload"></i> Import Data Kecamatan
                            </button>
                            <a href="{{ route('kecamatan.index') }}" class="btn btn-danger">
                                <i class="icon icon-close"></i>
                                Reset Filter
                            </a>
                    </div>
                </div>
                <br>
                <div class="card-content collapse show">
                    <div class="card-body" id="dataTable">
                        
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Start modal -->
    <div class="modal fade popup_import" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog">
            <form action="{{ route('kecamatan.import') }}" method="post" enctype="multipart/form-data">
                @csrf
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Import Data Kecamatan</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="form-group">
                            <input type="file" name="file" class="form-control">
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                        <button type="submit" class="btn btn-primary">Upload</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
    <!-- End modal -->

    @section('script')
        <script src="{{ asset('template-asset/app-assets/vendors/js/forms/select/select2.full.min.js') }}"></script>
        <script src="{{ asset('template-asset/app-assets/js/scripts/forms/select/form-select2.min.js') }}"></script>
        <!-- Pagination-->
        <script src="{{ asset('template-asset/app-assets/vendors/js/pagination/jquery.bootpag.min.js') }}"></script>
        <script src="{{ asset('template-asset/app-assets/vendors/js/pagination/jquery.twbsPagination.min.js') }}"></script>
        <script src="{{ asset('template-asset/app-assets/vendors/js/pagination/moment.min.js') }}"></script>
        <script src="{{ asset('template-asset/app-assets/vendors/js/pagination/datepicker.js') }}"></script>
        <script src="{{ asset('template-asset/app-assets/vendors/js/pagination/bootstrap-datepaginator.min.js') }}"></script>
        <script src="{{ asset('template-asset/app-assets/js/scripts/pagination/pagination.js') }}"></script>
        <script type="text/javascript">
            $(document).on('click', '.paginate', function(e){
                e.preventDefault();
                var searchParams = new URLSearchParams(window.location.search);
                searchParams.set(`page`, '1');
                var newUrl = '?'+searchParams.toString();
                window.history.pushState({}, '', newUrl);
                let page = $(this).data('page');
                let queryString = `page`;
                getQueryString(queryString, page);
            });

            $(document).ready(function () {
                getData();

                // ================== Popup =====================
                $(".import").click(function() {
                    $('.popup_import').modal();
                });
            });

            // Search
            $(document).on('keyup', 'input[name=prov_name]', function(e){
                e.preventDefault();
                var searchParams = new URLSearchParams(window.location.search);
                searchParams.set(`page`, '1');
                var newUrl = '?'+searchParams.toString();
                window.history.pushState({}, '', newUrl);

                let name = $('input[name=prov_name]').val();
                let queryString = `prov_name`;
                getQueryString(queryString, name);
            });

            $(document).on('change', 'select[name=city_id]', function(e){
                e.preventDefault();
                var searchParams = new URLSearchParams(window.location.search);
                searchParams.set(`page`, '1');
                var newUrl = '?'+searchParams.toString();
                window.history.pushState({}, '', newUrl);

                let name = $('select[name=city_id]').val();
                let queryString = `city_id`;
                getQueryString(queryString, name);
            });

            $(document).on('keyup', 'input[name=kelu_name]', function(e){
                e.preventDefault();
                var searchParams = new URLSearchParams(window.location.search);
                searchParams.set(`page`, '1');
                var newUrl = '?'+searchParams.toString();
                window.history.pushState({}, '', newUrl);

                let name = $('input[name=kelu_name]').val();
                let queryString = `kelu_name`;
                getQueryString(queryString, name);
            });

            $(document).on('keyup', 'input[name=kec_name]', function(e){
                e.preventDefault();
                var searchParams = new URLSearchParams(window.location.search);
                searchParams.set(`page`, '1');
                var newUrl = '?'+searchParams.toString();
                window.history.pushState({}, '', newUrl);

                let name = $('input[name=kec_name]').val();
                let queryString = `kec_name`;
                getQueryString(queryString, name);
            });

            function getQueryString(queryString = '', value = '')
            {
                let currentUrl = window.location.href;
                if(currentUrl.indexOf("?page=") > -1)
                {
                    if(currentUrl.indexOf(queryString) > -1)
                    {
                        var parameters = new URLSearchParams(window.location.search);
                        let val = parameters.get(queryString) //1
                        if(value === '')
                        {
                            var searchParams = new URLSearchParams(window.location.search);
                            var newUrl = removeParam(queryString, currentUrl);
                            window.history.pushState({}, '', newUrl);
                            getData(newUrl);
                        }else {
                            if(val !== value)
                            {
                                var searchParams = new URLSearchParams(window.location.search);
                                searchParams.set(queryString, value);
                                var newUrl = '?'+searchParams.toString();
                                window.history.pushState({}, '', newUrl)
                                getData(newUrl);
                            }
                        }
                    }else {
                        let newUrl = currentUrl+'&'+queryString+'='+value;
                        window.history.pushState({}, '', newUrl);
                        getData(newUrl);
                    }
                }else {
                    let newUrl = currentUrl+'?page=1&'+queryString+'='+value;
                    window.history.pushState({}, '', newUrl);
                    getData(newUrl);
                }
            }

            function removeParam(key, sourceURL) {
                var rtn = sourceURL.split("?")[0],
                    param,
                    params_arr = [],
                    queryString = (sourceURL.indexOf("?") !== -1) ? sourceURL.split("?")[1] : "";
                if (queryString !== "") {
                    params_arr = queryString.split("&");
                    for (var i = params_arr.length - 1; i >= 0; i -= 1) {
                        param = params_arr[i].split("=")[0];
                        if (param === key) {
                            params_arr.splice(i, 1);
                        }
                    }
                    if (params_arr.length) rtn = rtn + "?" + params_arr.join("&");
                }
                return rtn;
            }

            function getData(url = ''){
                if(url.indexOf("?page=1") > -1){
                    $.ajax({
                        url: url,
                        method: "GET",
                        cache: false,
                        success: function(data)
                        {
                            $('#dataTable').html(data);
                        }
                    });
                }else {
                    let currentUrl = window.location.href;
                    $.ajax({
                        url: currentUrl,
                        method: "GET",
                        cache: false,
                        success: function(data)
                        {
                            $('#dataTable').html(data);
                        }
                    });
                }

            }
        </script>
    @endsection
</x-app-layout>