@extends('layouts.app')

@section("page_title", "Payments")

@section('page_content')

    <div class="pt-1">
        <div class="row mt-1">
            <div class="col-12">
                <div class="card-box">
                    <h4 class="m-t-0 header-title">Payments</h4>
                    <table class="table mb-0" id="payments-table">
                        <thead>
                        <tr>
                            <th class="d-none"></th>
                            <th>#</th>
                            <th>Payment Reference</th>
                            <th>User</th>
                            <th>Amount</th>
                            <th>Payment Description</th>
                            <th>Status</th>
                            <th>Date</th>
                            <th>
                                Actions
                            </th>
                        </tr>
                        </thead>
                        <tbody>
                        @php $i = 1 @endphp
                        @foreach($payments as $payment)
                            <tr>
                                <td class="d-none">{{ $payment->created_at }}</td>
                                <th scope="row">{{ $i }}</th>
                                <td>{{ $payment->rrr }}</td>
                                <td>
                                    {{ $payment->student ? $payment->student->user->full_name : "" }}
                                </td>
                                <td>
                                    ₦{{ number_format($payment->amount) }}
                                </td>
                                <td>
                                    {{ ucwords($payment->reason) }}
                                </td>
                                <td>
                                    {{-- @if($payment->paid)
                                        <small class="text-success">Paid</small>
                                    @else
                                        <small><i>Not Paid</i></small>
                                    @endif --}}
                                    @if($payment->paid)
                                        <span class="text-success">Paid</span>
                                    @elseif(strtolower($payment->reason) == "access")
                                        <a href="{{ route('check-remita-payment-status', ['rrr' => $payment->rrr]) }}" class="btn btn-primary btn-sm">Check Status</a>
                                    @else
                                        <a href="{{ route('check-remita-payment-status', ['rrr' => $payment->rrr]) }}" class="btn btn-primary btn-sm">Check Status</a>
                                    @endif
                                </td>
                                <td>
                                    {{ $payment->created_at }}
                                </td>
                                <td>
                                    <form method="post" action="{{ route("admin.payment.destroy", ["id" => $payment->id]) }}">
                                        @csrf
                                        {{ method_field("DELETE") }}
                                        {{-- @if(!$payment->verified)
                                            <a href="{{ route("admin.payment.verify", ["id" => $payment->id]) }}" class="btn btn-success btn-sm"><i class="mdi mdi-check-circle"></i> Mark as paid</a>
                                        @endif --}}
                                        <button class="btn btn-danger btn-sm" type="submit">
                                            <i class="mdi mdi-delete"></i> Delete
                                        </button>
                                    </form>
                                </td>
                            </tr>

                            @php $i++ @endphp
                        @endforeach
                        </tbody>
                    </table>
                    
                       <?php   echo  $payments->links() ?>
                </div>
            </div>
        </div>
    </div>
@endsection

@section("page_scripts")
    <script>
        $(document).ready(function() {
            // Default Datatable
            $('#payments-table').DataTable({
                //searching: false,
                lengthChange: true,
				 "order": [[ 0, "desc" ]]
            });
        });
    </script>
@endsection
