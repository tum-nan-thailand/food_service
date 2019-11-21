<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>หน้าเข้าสู่ระบบ</title>


        <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
        <!-- Bootstrap 3.3.6 -->
        <link rel="stylesheet" href="{{asset('/public/bootstrap/css/bootstrap.min.css')}}">

        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.5.0/css/font-awesome.min.css">
        <!-- Ionicons -->
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/ionicons/2.0.1/css/ionicons.min.css">
        <!-- Theme style -->
        <link rel="stylesheet" href="{{asset('/public/dist/css/AdminLTE.min.css')}}">
        <!-- iCheck -->
        <link rel="stylesheet" href="{{asset('/public/plugins/iCheck/square/blue.css')}}">
      <script>
        var isIE = /*@cc_on!@*/ false || !!document.documentMode;
        // Edge 20+
        var isEdge = !isIE && !!window.StyleMedia;
        // Chrome 1+
        var isChrome = !!window.chrome && !!window.chrome.webstore;
        // Blink engine detection
        var isBlink = (isChrome) && !!window.CSS;
        if (isIE ) {
            alert('โปรแกรมนี้ไม่สามารถใช้ใน Browser Internet Explorer (IE)  ได้ \n ท่านสามารถใช้ได้ใน Chrome, Firefox, Opera เท่านั้น');
            window.open('', '_self', '');
            window.close();
        }
        </script>
    </head>
    <body class="hold-transition login-page">
        @yield('content')


        <!-- jQuery 2.2.3 -->
        <script src="{{asset('/public/plugins/jQuery/jquery-2.2.3.min.js')}}"></script>
        <!-- Bootstrap 3.3.6 -->
        <script src="{{asset('/public/bootstrap/js/bootstrap.min.js')}}"></script>
        <!-- iCheck -->
        <script src="{{asset('/public/plugins/iCheck/icheck.min.js')}}"></script>
        <script>
        $(function () {
            $('input').iCheck({
            checkboxClass: 'icheckbox_square-blue',
            radioClass: 'iradio_square-blue',
            increaseArea: '20%' // optional
            });
        });
        </script>
    </body>
</html>
