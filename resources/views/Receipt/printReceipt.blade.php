<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Receipt: {{$receipt->receipt_no}}</title>
</head>

<body>
    <img src="..." alt="Abata Logo" style="width: 200px; height: 100px;">
    <table border="1" width="100%" cellpadding="5" cellspacing="0">
        <tr>
            <td colspan="2" align="center" style="font-size:18px">
                <b>Receipt: {{$receipt->receipt_no}}</b>
            </td>
        </tr>
        <tr>
            <td colspan="2">
                <table width="100%" cellpadding="5">
                    <tr>
                        <td width="65%">
                            <b>Name:</b> {{$receipt->receipt_name}}<br>
                            <b>IC:</b> {{$receipt->receipt_receiver_ic}}<br>
                            <b>Address:</b> {{$receipt->receipt_address}}<br>
                        </td>
                        <td width="35%">
                            <b>Receipt No:</b> {{$receipt->receipt_no}}<br>
                            <b>Receipt Date:</b> {{$receipt->receipt_date}}<br>
                            <b>Issued By:</b> {{$receipt->receipt_issuedby}}
                        </td>
                    </tr>
                </table>
                <br>
                <table width="100%" border="1" cellpadding="5" cellspacing="0">
                    <tr>
                        <th>No.</th>
                        <th>Item Name</th>
                        <th>Quantity</th>
                        <th>Price (RM)</th>
                        <th align="right">Actual Amount (RM)</th>
                    </tr>
                    @foreach($receipt_items as $index=>$item)
                    <tr>
                        <td>{{$index+1}}</td>
                        <td>{{$item->item_name}}</td>
                        <td>{{$item->item_quantity}}</td>
                        <td>{{$item->item_price}}</td>
                        <td align="right">{{$item->item_actual_amount}}</td>
                    </tr>
                    @endforeach
                    <tr>
                        <td align="right" colspan="4"><b>Total (RM)</b></td>
                        <td align="right">{{$receipt->receipt_total}}</td>
                    </tr>
                </table>
                <div style="text-align:center;">
                    <i>For question concerning this receipt, please contact<br></i>
                    ABATA Resources - 03 1234 5678, email@email.com<br>
                    www.yourwebsite.com
                </div>
            </td>
        </tr>
    </table>
</body>

</html>