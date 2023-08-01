<div style="width:600px; margin: 0 auto">
    <div style="text-align:center">
        <h2>Xin chào {{ $user->full_name }}</h2>
        <p>Email này giúp bạn lấy lại mật khẩu đã quên</p>
        <p>Vui lòng click vào link bên dưới để lấy lại mật khẩu</p>
        <p>
            <a href="{{ route('homes.getpass', ['user' => $user, 'token' => $user->token]) }}"
                style="display:inline-block; background:green; color:#fff;padding:7px 25px; font-weight:bold">
                Đặt lại mật khẩu
            </a>
        </p>
    </div>
</div>
