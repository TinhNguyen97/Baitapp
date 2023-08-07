@php
    $url = str_replace($app_url, $http_host, route('homes.getpass', ['user' => $user_id, 'token' => $token]));
@endphp
<div style="width:600px; margin: 0 auto">
    <div style="text-align:center">
        <h2>Xin chào {{ $full_name }}</h2>
        <p>Email này giúp bạn lấy lại mật khẩu đã quên</p>
        <p>Vui lòng click vào link bên dưới để lấy lại mật khẩu</p>
        <p>


            <?php echo $url; ?>
        </p>

    </div>
</div>
