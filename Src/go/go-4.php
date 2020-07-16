    <?php
    if (
        strlen($_SERVER['REQUEST_URI']) > 384 ||
        strpos($_SERVER['REQUEST_URI'], "eval(") ||
        strpos($_SERVER['REQUEST_URI'], "base64")
    ) {
        @header("HTTP/1.1 414 Request-URI Too Long");
        @header("Status: 414 Request-URI Too Long");
        @header("Connection: Close");
        @exit;
    }
    //通过QUERY_STRING取得完整的传入数据，然后取得url=之后的所有值，兼容性更好
    $t_url = preg_replace('/^url=(.*)$/i', '$1', $_SERVER["QUERY_STRING"]);

    //数据处理
    if (!empty($t_url)) {
        //判断取值是否加密
        if ($t_url == base64_encode(base64_decode($t_url))) {
            $t_url =  base64_decode($t_url);
        }
        //对取值进行网址校验和判断
        preg_match('/^(http|https|thunder|qqdl|ed2k|Flashget|qbrowser):\/\//i', $t_url, $matches);
        if ($matches) {
            $url = $t_url;
            $title = '页面加载中,请稍候...';
        } else {
            preg_match('/\./i', $t_url, $matche);
            if ($matche) {
                $url = 'http://' . $t_url;
                $title = '页面加载中,请稍候...';
            } else {
                $url = 'http://' . $_SERVER['HTTP_HOST'];
                $title = '参数错误，正在返回首页...';
            }
        }
    } else {
        $title = '参数缺失，正在返回首页...';
        $url = 'http://' . $_SERVER['HTTP_HOST'];
    }
    ?>
    <html>

    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <meta name="robots" content="noindex, nofollow" />
        <meta charset="UTF-8">
        <link rel="shortcut icon" href="https://pic.ryanjie.cn/2020/favicon.ico">
        <noscript>
            <meta http-equiv="refresh" content="1;url='<?php echo $url; ?>';"></noscript>
        <script>
            function link_jump() {
                //禁止其他网站使用我们的跳转页面
                var MyHOST = new RegExp("<?php echo $_SERVER['HTTP_HOST']; ?>");
                if (!MyHOST.test(document.referrer)) {
                    location.href = "http://" + MyHOST;
                }
                location.href = "<?php echo $url; ?>";
            }
            //延时0.5S跳转，可自行修改延时时间
            setTimeout(link_jump, 500);
            //延时50S关闭跳转页面，用于文件下载后不会关闭跳转页的问题
            setTimeout(function() {
                window.opener = null;
                window.close();
            }, 50000);
        </script>
        <title><?php echo $title; ?></title>
        <style type="text/css">* { margin: 0; padding: 0; border: 0 } body, html { min-height: 100% } body { background: radial-gradient(#eee, #444) } .loader { position: absolute; top: 0; bottom: 0; left: 0; right: 0; margin: auto; width: 175px; height: 100px } .loader span { display: block; background: #ccc; width: 7px; height: 10%; border-radius: 14px; margin-right: 5px; float: left; margin-top: 25% } .loader span:last-child { margin-right: 0 } .loader span:nth-child(1) { animation: load 2.5s 1.4s infinite linear } .loader span:nth-child(2) { animation: load 2.5s 1.2s infinite linear } .loader span:nth-child(3) { animation: load 2.5s 1s infinite linear } .loader span:nth-child(4) { animation: load 2.5s .8s infinite linear } .loader span:nth-child(5) { animation: load 2.5s .6s infinite linear } .loader span:nth-child(6) { animation: load 2.5s .4s infinite linear } .loader span:nth-child(7) { animation: load 2.5s .2s infinite linear } .loader span:nth-child(8) { animation: load 2.5s 0s infinite linear } .loader span:nth-child(9) { animation: load 2.5s .2s infinite linear } .loader span:nth-child(10) { animation: load 2.5s .4s infinite linear } .loader span:nth-child(11) { animation: load 2.5s .6s infinite linear } .loader span:nth-child(12) { animation: load 2.5s .8s infinite linear } .loader span:nth-child(13) { animation: load 2.5s 1s infinite linear } .loader span:nth-child(14) { animation: load 2.5s 1.2s infinite linear } .loader span:nth-child(15) { animation: load 2.5s 1.4s infinite linear } @keyframes load { 0% { background: #ccc; margin-top: 25%; height: 10% } 50% { background: #444; height: 100%; margin-top: 0 } 100% { background: #ccc; height: 10%; margin-top: 25% } }
    </style>
  </head>
  
  <body>
    <div class="loader">
      <span></span>
      <span></span>
      <span></span>
      <span></span>
      <span></span>
      <span></span>
      <span></span>
      <span></span>
      <span></span>
      <span></span>
      <span></span>
      <span></span>
      <span></span>
      <span></span>
      <span></span>
    </div>
  </body>
</html>