@extends('layouts.app')

@section("page_title", "Vouchers")

@section('page_content')

    <div class="pt-1">
        <div class="row mt-1">
            <div class="col-12">
                <div class="card-box">
                    <h4 class="m-t-0 header-title">Generated Vouchers</h4>
                    <table class="table mb-0" id="generated-vouchers-table">
                        <thead>
                        <tr>
                            <th>#</th>
                            <th>Title</th>
                            <th>
                                Actions
                            </th>
                        </tr>
                        </thead>
                        <tbody>
                        @php $i = 1 @endphp
                        @foreach($generated_vouchers as $generated_voucher)
                            <tr>
                                <th scope="row">{{ $i }}</th>
                                <td>
                                    {{ $generated_voucher->file_name }}
                                </td>
                                <td>
                                    <a href="{{ route("admin.vouchers.download-generated-voucher", ["id" => $generated_voucher->id]) }}" class="btn btn-outline-info btn-sm"><i class="mdi mdi-download"></i> Download</a>
                                </td>
                            </tr>
                            @php $i++ @endphp
                        @endforeach
                        </tbody>
                    </table>
                </div>

                <div class="card-box">
                    <div class="dropdown float-right"><a href="#" class="dropdown-toggle arrow-none card-drop" data-toggle="dropdown" aria-expanded="false"><i class="mdi mdi-dots-horizontal"></i></a>
                        <div class="dropdown-menu dropdown-menu-right">
                            <a href="#" data-toggle="modal" data-target="#addNewVoucherModal" class="dropdown-item">Generate vouchers</a>
                            <a href="{{ route("admin.vouchers.download") }}" class="dropdown-item">Download vouchers list</a>
                        </div>
                    </div>

                    <h4 class="m-t-0 header-title">Vouchers</h4>
                    <table class="table mb-0" id="vouchers-table">
                        <thead>
                        <tr>
                            <th>#</th>
                            <th>Code</th>
                            <th>Serial Number</th>
                            <th>Amount</th>
                            <th>
                                Actions
                            </th>
                        </tr>
                        </thead>
                        <tbody>
                        @php $i = 1 @endphp
                        @foreach($vouchers as $voucher)
                            <tr>
                                <th scope="row">{{ $i }}</th>
                                <td>
                                    {{ $voucher->code }}
                                </td>
                                <td>
                                    {{ $voucher->serial_number }}
                                </td>
                                <td>
                                    N{{ number_format($voucher->amount) }}
                                </td>
                                <td>
                                    <form method="post" action="{{ route("admin.voucher.destroy", ["id" => $voucher->id]) }}">
                                        @csrf
                                        {{ method_field("DELETE") }}
                                        <button type="button" data-toggle="modal" data-target="#editVoucher{{ $voucher->id }}Modal" class="btn btn-info btn-sm"><i class="mdi mdi-square-edit-outline"></i> Edit</button>
                                        <button class="btn btn-danger btn-sm" type="submit">
                                            <i class="mdi mdi-delete"></i> Delete
                                        </button>
                                    </form>
                                </td>
                            </tr>

                            <div class="modal fade" id="editVoucher{{ $voucher->id }}Modal" tabindex="-1" role="dialog" aria-labelledby="editVoucher{{ $voucher->id }}ModalLabel" aria-hidden="true">
                                <div class="modal-dialog" role="document">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="editVoucher{{ $voucher->id }}ModalLabel">Update voucher</h5>
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>
                                        <form method="post" action="{{ route("admin.voucher.update", ["id" => $voucher->id]) }}">
                                            @csrf
                                            {{ method_field("PUT") }}

                                            <div class="modal-body">
                                                <div class="form-group">
                                                    <input class="form-control" type="number" id="amount" required name="amount" placeholder="Amount" value="{{ $voucher->amount }}">
                                                </div>
                                                <hr>
                                                <div class="text-center">
                                                    <button type="button" class="btn btn-secondary btn-sm" data-dismiss="modal">Close</button>
                                                    <button type="submit" class="btn btn-primary btn-sm">Save</button>
                                                </div>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>

                            @php $i++ @endphp
                        @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="addNewVoucherModal" tabindex="-1" role="dialog" aria-labelledby="addNewVoucherModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="addNewVoucherModalLabel">Generate Vouchers</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form method="post" action="{{ route("admin.voucher.store") }}">
                    @csrf
                    <div class="modal-body">
                        <div class="row">
                            <div class="form-group col-12 col-sm-6">
                                <input class="form-control" type="number" id="number_of_vouchers" required name="number_of_vouchers" placeholder="Number of vouchers">
                            </div>
                            <div class="form-group col-12 col-sm-6">
                                <input class="form-control" type="number" id="amount" required name="amount" placeholder="Amount">
                            </div>
                        </div>
                        <hr>
                        <div class="text-center">
                            <button type="button" class="btn btn-secondary btn-sm" data-dismiss="modal">Close</button>
                            <button type="submit" class="btn btn-primary btn-sm">Create</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection

@section("page_scripts")
    <script>
        $(document).ready(function() {
            $('#vouchers-table').DataTable({
                searching: false,
                lengthChange: false
            });
            $('#generated-vouchers-table').DataTable({
                searching: false,
                lengthChange: false,
                pageLength: 5
            });
        });
    </script>
@endsection