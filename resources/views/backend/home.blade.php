@extends('backend.layouts.app')
@section('title','Dashboard')
@section('content')

<div class="app-page-title">
    <div class="page-title-wrapper">
        <div class="page-title-heading">
            <div class="page-title-icon">
                <i class="metismenu-icon icon-gradient bg-mean-fruit pe-7s-display2"></i>
            </div>
            <div>Dashboard</div>
        </div>   
    </div>
</div>
<div class="content pt-3">
    <div class="card">
        <div class="card-body">
            <div class="row">
                <div class="col-lg-6 col-xl-3">
                    <a href="{{ url('admin/admin-user')}}" style="text-decoration: none;">
                        <div class="btn btn-alternate card mb-3 bg-night-fade p-4">
                            <div class="d-flex justify-content-around text-white">
                                <div>
                                    <i class="metismenu-icon pe-7s-users" style="font-size: 3rem;"></i>
                                </div>
                                <div class="">
                                    <div>Admin Users</div>
                                    <div class="widget-numbers text-white lead"><span>1896</span></div>
                                </div>
                            </div>
                        </div>
                    </a>
                </div>
                <div class="col-lg-6 col-xl-3">
                    <a href="{{url('admin/user')}}" style="text-decoration: none;">
                        <div class="btn btn-dark card mb-3 bg-premium-dark p-4">
                            <div class="d-flex justify-content-around text-white">
                                <div>
                                    <i class="metismenu-icon pe-7s-users" style="font-size: 3rem;"></i>
                                </div>
                                <div class="">
                                    <div>Users</div>
                                    <div class="widget-numbers text-white lead"><span>1896</span></div>
                                </div>
                            </div>
                        </div>
                    </a>
                </div>
                <div class="col-lg-6 col-xl-3">
                    <a href="{{url('admin/wallet')}}" style="text-decoration: none;">
                        <div class="btn btn-success card mb-3 bg-happy-green p-4">
                            <div class="d-flex justify-content-around text-white">
                                <div>
                                    <i class="metismenu-icon pe-7s-wallet" style="font-size: 3rem;"></i>
                                </div>
                                <div class="">
                                    <div>Wallets</div>
                                    <div class="widget-numbers text-white lead"><span>1896</span></div>
                                </div>
                            </div>
                        </div>
                    </a>
                </div>
                <div class="col-lg-6 col-xl-3">
                    <a href="{{url('admin/transactions')}}" style="text-decoration: none;">
                        <div class="btn btn-info card mb-3 bg-midnight-bloom p-4">
                            <div class="d-flex justify-content-around text-white">
                                <div>
                                    <i class="metismenu-icon pe-7s-news-paper" style="font-size: 3rem;"></i>
                                </div>
                                <div class="">
                                    <div>Transactions</div>
                                    <div class="widget-numbers text-white lead"><span>1896</span></div>
                                </div>
                            </div>
                        </div>
                    </a>
                </div>
            </div>
        </div>
    </div>
    <div class="card my-2">
        <div class="card-body">
            <div class="text-center h5 pt-2 pb-3"><b>Today Transactions</b></div>
            <table id="today-transactions-table" class="table table-bordered">
                <thead>
                    <tr class="bg-light">
                        <th>Trx_Id</th>
                        <th>Time</th>
                        <th>User</th>
                        <th>Amount (MMK)</th>
                        <th>Type</th>
                        <th>Action</th>
                    </tr>
                </thead>
                
            </table>
        </div>
    </div>
</div>
@endsection

@section('scripts')
    <script>
        $(document).ready(function() {
            var table = $('#today-transactions-table').DataTable({
                            processing: true,
                            serverSide: true,
                            ajax: '/admin/today-transactions/datatable/ssd',
                            columnDefs: [{
                                defaultContent : "-",
                                targets : "_all"
                            }],
                            columns: [
                                { data: 'trx_id', name: 'trx_id' },
                                { data: 'created_at', name: 'created_at'},
                                { data: 'user_id', name: 'user_id', searchable: true },
                                { data: 'amount', name: 'amount', searchable: false},
                                { data: 'type', name: 'type', searchable: false, orderable: false },
                                { data: 'action', name: 'action', searchable: false, orderable: false },
                            ]
                        });
            // setInterval(function() {
            //     table.ajax.reload()
            // }, 30000);
        });
    </script>
@endsection