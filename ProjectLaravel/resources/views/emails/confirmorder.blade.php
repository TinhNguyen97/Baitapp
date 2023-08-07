<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Xác nhận đơn hàng</title>

</head>

<body>
    <h1>Xin chào {{ $request['name'] }}!</h1>
    <p>Chúng tôi xin xác nhận đơn hàng của bạn!</p>
    <table border="1" cellspacing="0" cellpadding="10" style="width:100%">
        <thead>
            <tr>
                <th>STT</th>
                <th>Sản phẩm</th>
                <th>Đơn giá($)</th>
                <th>Số lượng</th>
                <th>Thành tiền($)</th>
            </tr>
        </thead>
        <tbody>

            @if ($carts)
                @php
                    // $carts = $cart->items;
                    $i = 1;
                    // dd($carts);
                @endphp
                @foreach ($carts as $key => $item)
                    <tr>
                        <td style="text-align: center">{{ $i++ }}</td>
                        <td style="text-align: center">
                            {{ $item['item']['name'] }}
                        </td>
                        @if ($item['item']['promotion_price'] != 0)
                            <td style="text-align: center">
                                {{ number_format($item['item']['promotion_price'], 0, ',', '.') }}
                            </td>
                        @else
                            <td style="text-align: center">
                                {{ $item['item']['unit_price'] }}
                            </td>
                        @endif

                        <td style="text-align: center">
                            {{ $item['qty'] }}
                        </td>

                        @if ($item['item']['promotion_price'] != 0)
                            <td style="text-align: center">
                                {{ number_format($item['qty'] * $item['item']['promotion_price'], 0, ',', '.') }}
                            </td>
                        @else
                            <td style="text-align: center">
                                {{ number_format($item['qty'] * $item['item']['unit_price'], 0, ',', '.') }}
                            </td>
                        @endif

                    </tr>
                @endforeach

                <tr>
                    <th>Tổng</th>
                    <th></th>
                    <th></th>
                    <th id=total-quantity>{{ $totalQty }}</th>
                    <th id="total-price">{{ number_format($totalPrice, 0, ',', '.') }}
                    </th>
                </tr>
            @else
                <tr>
                    <td colspan="8" style="color:red">Giỏ hàng trống</td>
                </tr>
            @endif

        </tbody>

    </table>
    <p>Thông tin người nhận hàng:</p>
    <table border="1" cellspacing="0" cellpadding="10" style="width:50%">
        <tr>
            <th>Họ và tên</th>
            <th>Địa chỉ nhận hàng</th>
            <th>Số điện thoại</th>
            <th>Ghi chú</th>
        </tr>
        <td style="text-align: center">{{ $request['name'] }}</td>
        <td style="text-align: center">{{ $request['address'] }}</td>
        <td style="text-align: center">{{ $request['phone'] }}</td>
        <td style="text-align: center">{{ $request['note'] }}</td>
        <tr>

        </tr>
    </table>
    <p>Cảm ơn bạn đã đặt hàng tại hệ thống, chúng tôi sẽ sớm liên hệ với bạn!</p>
    <p>
        @php
            
        @endphp
</body>

</html>
