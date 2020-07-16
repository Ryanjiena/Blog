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
    <style type="text/css">a, abbr, acronym, address, applet, article, aside, audio, b, big, blockquote, body, canvas, caption, center, cite, code, dd, del, details, dfn, div, dl, dt, em, embed, fieldset, figcaption, figure, footer, form, h1, h2, h3, h4, h5, h6, header, hgroup, html, i, iframe, img, ins, kbd, label, legend, li, mark, menu, nav, object, ol, output, p, pre, q, ruby, s, samp, section, small, span, strike, strong, sub, summary, sup, table, tbody, td, tfoot, th, thead, time, tr, tt, u, ul, var, video { margin: 0; padding: 0; border: 0; font-size: 100%; font: inherit; vertical-align: baseline } body { background: #3498db } #loader-container { width: 188px; height: 188px; color: #fff; margin: 0 auto; position: absolute; top: 50%; left: 50%; margin-right: -50%; transform: translate(-50%, -50%); border: 5px solid #3498db; border-radius: 50%; -webkit-animation: borderScale 1s infinite ease-in-out; animation: borderScale 1s infinite ease-in-out } #loadingText { font-family: "Microsoft YaHei", Helvetica, Arial, Lucida Grande, Tahoma, sans-serif, Raleway, sans-serif; font-size: 1.4em; position: absolute; top: 50%; left: 50%; margin-right: -50%; transform: translate(-50%, -50%) } @-webkit-keyframes borderScale { 0% { border: 5px solid #fff } 50% { border: 25px solid #3498db } 100% { border: 5px solid #fff } } @keyframes borderScale { 0% { border: 5px solid #fff } 50% { border: 25px solid #3498db } 100% { border: 5px solid #fff } }
    </style>
  </head>
  
  <body>
    <div id="loader-container">
      <p id="loadingText">页面加载中...</p></div>
  </body>
</html>