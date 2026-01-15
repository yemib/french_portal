@extends("pdf.pdf_overall")

@section("pdf_title", "Vouchers")

@section("pdf_content")
    <div style="max-width: 300px">
        <table id="datatable-buttons" class="table table-bordered dt-responsive nowrap">
            <tbody>
            @forelse($vouchers as $voucher)
                <tr>
                    <td>
                        <div>
                            Amount: N<b>{{ number_format($voucher->amount) }}</b>
                        </div>
                        <div>
                            Code: <b>{{ $voucher->code }}</b>
                        </div>
                        <div>
                            <small>Serial Number: {{ $voucher->serial_number }}</small>
                        </div>
                        <div>
                            <small><i>Date: {{ $voucher->updated_at->toDateTImeString() }}</i></small>
                        </div>
                    </td>
                </tr>
            @empty
                <tr>
                    <td>No available vouchers</td>
                </tr>
            @endforelse
            </tbody>
        </table>
    </div>
@endsection