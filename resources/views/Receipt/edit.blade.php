@extends('layout.main')

@section('title', 'ABATA | New Receipt')

@section('container')

<div class="card">
    <div class="card-header">
        New Receipt
    </div>
    <div class="card-body">
        <form method="post" action="/admin/receipt/{{ $receipt->id }}" autocomplete="off">
            @method('patch')
            @csrf
            <div class="card card-success">
                <div class="card-header">
                    <h3 class="card-title">Receipt Forms</h3>
                </div>
                <!-- /.card-header-->
                <div class="card-body">
                    <div class="row mb-2">
                        <div class="col-md-8">
                            <b>RECEIVER (BILL TO)</b><br>
                            <input type="text" name="receipt_receiver_name" id="receipt_receiver_name" class="form-control input-sm mb-2" value="{{$receipt->receipt_name}}" readonly>
                            <textarea name="receipt_receiver_address" id="receipt_receiver_address" class="form-control" placeholder="Enter Billing Address" readonly required>{{$receipt->receipt_address}}</textarea>
                        </div>
                        <div class="col-md-4">
                            <b>RECEIPT NUMBER</b><br>
                            <input type="text" name="receipt_no" id="receipt_no" class="form-control input-sm mb-2" placeholder="Receipt No" value="{{$receipt->receipt_no}}" readonly required>
                            <input type="text" name="receipt_date" id="receipt_date" class="form-control input-sm" placeholder="Select Receipt Date" value="{{$receipt->receipt_date}}" readonly required>
                        </div>
                    </div>
                    <!-- /.end rows -->
                    <hr>
                    <div class="row">
                        <table class="table table-bordered">
                            <thead>
                                <th>No.</th>
                                <th>Item Name</th>
                                <th>Quantity</th>
                                <th>Price</th>
                                <th>Actual Amount</th>
                            </thead>
                            <tbody id="receipt-item-table">
                                @foreach($receipt_items as $index=>$item)
                                <tr>
                                    <td><span id="sr_no">{{$index+1}}</span><input type="hidden" name="item_id[]" value="{{$item->id}}"></td>
                                    <td><input type="text" name="item_name[]" id="item_name{{$index+1}}" class="form-control input-sm" value="{{$item->item_name}}" required>
                                    </td>
                                    <td><input type="number" name="item_quantity[]" id="item_quantity{{$index+1}}" data-srno="1" class="form-control input-sm number_only item_quantity" value="{{$item->item_quantity}}" required>
                                    </td>
                                    <td><input type="number" name="item_price[]" id="item_price{{$index+1}}" data-srno="1" class="form-control input-sm number_only item_price" value="{{$item->item_price}}" required>
                                    </td>
                                    <td><input type="text" name="item_actual_amount[]" id="item_actual_amount{{$index+1}}" data-srno="1" class="form-control input-sm item_actual_amount" value="{{$item->item_actual_amount}}" readonly required>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                            <tfoot>
                                <tr>
                                    <td colspan="4" align="right"><b>Total</b></td>
                                    <td align="right"><b><span id="final_amount"></span></b></td>
                                </tr>
                                <tr>
                                    <td colspan="5" align="center">
                                        <input type="hidden" name="receipt_final_amount" id="receipt_final_amount" value="{{$receipt->receipt_total}}">
                                        <input type="hidden" name="total_item" id="total_item" value="{{$index+1}}">
                                        <input type="submit" name="create_receipt" id="create_receipt" class="btn btn-outline-success" value="Update">
                                    </td>
                                </tr>
                            </tfoot>

                        </table>
                    </div>
                    <!-- /.end rows -->
                </div>
                <!-- /.card-body -->
            </div>
            <!-- /.card -->
        </form>
        <!-- /.Form -->
    </div>
</div>



<script>
    $(document).ready(function() {

        var final_amount = 0;
        var count = parseInt($('#total_item').val());
        cal_final_amount(count)
        //Function for calculate
        function cal_final_amount(count) {
            var final_amount = 0;
            for (j = 0; j <= count; j++) {
                var quantity = 0;
                var price = 0;
                var actual_amount = 0;
                var item_total = 0;
                quantity = $('#item_quantity' + j).val();
                if (quantity > 0) {
                    price = $('#item_price' + j).val();
                    if (price > 0) {
                        actual_amount = parseFloat(quantity) * parseFloat(price);
                        $('#item_actual_amount' + j).val(actual_amount);
                    }
                    //item_total = parseFloat(actual_amount);
                    final_amount = parseFloat(final_amount) + parseFloat(actual_amount); //parseFloat(item_total);
                }
            }
            $('#final_amount').text(final_amount);
            $('#receipt_final_amount').val(final_amount);
        }

        //Update final final amount
        $(document).on('keyup', '.item_price', function() {
            cal_final_amount(count);
        });

        $(document).on('keyup', '.item_quantity', function() {
            cal_final_amount(count);
        });

    });
</script>
@endsection