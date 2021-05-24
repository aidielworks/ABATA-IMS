@extends('layout.main')

@section('title', 'ABATA | New Receipt')

@section('container')

<div class="card">
    <div class="card-header">
        New Receipt
    </div>
    <div class="card-body">
        <form method="post" action="{{ url('/admin/receipt') }}" autocomplete="off">
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
                            <select name="receipt_receiver_name" id="receipt_receiver_name" placeholder="Choose Receiver Name" class="form-control mb-2">
                                <option value="" selected disabled hidden>Choose Student...</option>

                                @foreach($students as $stud)
                                <option value="{{$stud->ic}}">{{ $stud->name }}</option>
                                @endforeach

                            </select>
                            <input type="hidden" id="receipt_name" name="receipt_name">
                            <input type="hidden" id="receiver_ic" name="receiver_ic">
                            <textarea name="receipt_receiver_address" id="receipt_receiver_address" class="form-control" placeholder="Enter Billing Address" readonly required></textarea>
                        </div>
                        <div class="col-md-4">
                            <b>RECEIPT NUMBER</b><br>
                            <input type="text" name="receipt_no" id="receipt_no" class="form-control input-sm mb-2" placeholder="Receipt No" readonly required>
                            <input type="text" name="receipt_date" id="receipt_date" class="form-control input-sm" placeholder="Select Receipt Date" required>
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
                                <tr>
                                    <td><span id="sr_no">1</span></td>
                                    <td><input type="text" name="item_name[]" id="item_name1" class="form-control input-sm" required>
                                    </td>
                                    <td><input type="number" name="item_quantity[]" id="item_quantity1" data-srno="1" class="form-control input-sm number_only item_quantity" required>
                                    </td>
                                    <td><input type="number" name="item_price[]" id="item_price1" data-srno="1" class="form-control input-sm number_only item_price" required>
                                    </td>
                                    <td><input type="text" name="item_actual_amount[]" id="item_actual_amount1" data-srno="1" class="form-control input-sm item_actual_amount" readonly required>
                                    </td>
                                </tr>
                            </tbody>
                            <tfoot>
                                <tr>
                                    <td colspan="5">
                                        <div align="right" class="">
                                            <button type="button" name="add_row" id="add_row" class="btn btn-success">+</button>
                                            <button type="button" name="delete_row" id="delete_row" class="btn btn-danger">-</button>
                                        </div>
                                    </td>
                                </tr>
                                <tr>
                                    <td colspan="4" align="right"><b>Total</b></td>
                                    <td align="right"><b><span id="final_amount">0</span></b></td>
                                </tr>
                                <tr>
                                    <td colspan="5" align="center">
                                        <input type="hidden" name="receipt_final_amount" id="receipt_final_amount">
                                        <input type="hidden" name="total_item" id="total_item" value="1">
                                        <input type="submit" name="create_receipt" id="create_receipt" class="btn btn-outline-success" value="Create">
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

        //Date timepicker
        $("#receipt_date").datepicker({
            format: 'dd/mm/yyyy'
        });

        //Table receipt function
        var count = 1;

        function cal_final_amount(count) {
            var final_amount = 0;
            for (j = 1; j <= count; j++) {
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
                }
                //item_total = parseFloat(actual_amount);
                final_amount = parseFloat(final_amount) + parseFloat(actual_amount); //parseFloat(item_total);
            }
            $('#final_amount').text(final_amount);
            $('#receipt_final_amount').val(final_amount);
        }

        //ADD ITEM ROW
        $(document).on('click', '#add_row', function() {
            count = count + 1;
            $('#total_item').val(count);
            var html_code = '';
            html_code += '<tr id="row_id_' + count + '">';
            html_code += '<td><span id="sr_no">' + count + '</span></td>';
            html_code += '<td><input type="text" name="item_name[]" id="item_name' + count + '" class="form-control input-sm"></td>';
            html_code += '<td><input type="number" name="item_quantity[]" id="item_quantity' + count + '" data-srno="' + count + '" class="form-control input-sm item_quantity"></td>';
            html_code += '<td><input type="number" name="item_price[]" id="item_price' + count + '" data-srno="' + count + '" class="form-control input-sm number_only item_price"></td>';
            html_code += '<td><input type="text" name="item_actual_amount[]" id="item_actual_amount' + count + '" data-srno="' + count + '" class="form-control input-sm item_actual_amount" readonly></td>';

            $('#receipt-item-table').append(html_code);


        });

        //REMOVE ITEM ROW
        $(document).on('click', '#delete_row', function() {
            if (count <= 1) {
                count = 1;
                $('#total_item').val(count);
            } else {
                $('#row_id_' + count).remove();
                count--;
                $('#total_item').val(count);
            }
        });

        //set ic for receipt
        function setIC(setic) {

            var str = setic;
            var count;
            var finalIc;
            count = str.length;
            finalIc = str.substr(count - 4, count);
            return finalIc;
        }

        var d = new Date(); //declare new date eg. yyyymdd

        $.ajaxSetup({

            headers: {

                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')

            }

        });

        //get student address
        $(document).on('change', '#receipt_receiver_name', function() {

            var ic = $(this).val();
            $('#receiver_ic').val(ic)

            $.ajax({
                url: "{{ url('/findAddress') }}",
                method: "POST",
                data: {
                    ic: ic
                },
                success: function(data) {
                    var fullDate = "" + d.getFullYear() + (d.getMonth() + 1) + d.getDate();
                    var lastId = parseInt(data.lastId) + 1;
                    var receiptIc = setIC(ic);
                    var receiptNo = fullDate + "-" + receiptIc + "-" + lastId;

                    $('#receipt_receiver_address').html(data.address);
                    $('#receipt_name').val(data.name);
                    $('#receipt_no').val(receiptNo);
                }
            });
        });

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