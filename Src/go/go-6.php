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
    <style type="text/css">body { margin: 0; height: 100vh; display: flex; align-items: center; justify-content: center; background: #222428 } .container { width: 8em; height: 1em; font-size: 35px; display: flex; justify-content: space-between } .container span { width: 1em; height: 1em; --duration: 1.5s } .girl { animation: slide var(--duration) ease-in-out infinite alternate } @keyframes slide { 0% { transform: translateX(0); filter: brightness(1) } to { transform: translatex(6.75em); filter: brightness(1.45) } } .boys { width: 6em; display: flex; justify-content: space-between } .boys span { animation: var(--duration) ease-in-out infinite alternate } .boys span:nth-child(1) { animation-name: jump-off-1 } .boys span:nth-child(2) { animation-name: jump-off-2 } .boys span:nth-child(3) { animation-name: jump-off-3 } .boys span:nth-child(4) { animation-name: jump-off-4 } @keyframes jump-off-1 { 0%, 15% { transform: rotate(0deg) } 35%, to { transform-origin: -50% center; transform: rotate(-180deg) } } @keyframes jump-off-2 { 0%, 30% { transform: rotate(0deg) } 50%, to { transform-origin: -50% center; transform: rotate(-180deg) } } @keyframes jump-off-3 { 0%, 45% { transform: rotate(0deg) } 65%, to { transform-origin: -50% center; transform: rotate(-180deg) } } @keyframes jump-off-4 { 0%, 60% { transform: rotate(0deg) } 80%, to { transform-origin: -50% center; transform: rotate(-180deg) } } .container span:before { content: ''; position: absolute; width: inherit; height: inherit; border-radius: 15%; box-shadow: 0 0 .1em rgba(0, 0, 0, .3) } .girl:before { background-color: hotpink } .boys span:before { background-color: #1e90ff; animation: var(--duration) ease-in-out infinite alternate } .boys span:nth-child(1):before { filter: brightness(1); animation-name: jump-down-1 } .boys span:nth-child(2):before { filter: brightness(1.15); animation-name: jump-down-2 } .boys span:nth-child(3):before { filter: brightness(1.3); animation-name: jump-down-3 } .boys span:nth-child(4):before { filter: brightness(1.45); animation-name: jump-down-4 } @keyframes jump-down-1 { 5% { transform: scale(1, 1) } 15% { transform-origin: center bottom; transform: scale(1.3, 0.7) } 20%, 25% { transform-origin: center bottom; transform: scale(0.8, 1.4) } 40% { transform-origin: center top; transform: scale(1.3, 0.7) } 55%, to { transform: scale(1, 1) } } @keyframes jump-down-2 { 20% { transform: scale(1, 1) } 30% { transform-origin: center bottom; transform: scale(1.3, 0.7) } 35%, 40% { transform-origin: center bottom; transform: scale(0.8, 1.4) } 55% { transform-origin: center top; transform: scale(1.3, 0.7) } 70%, to { transform: scale(1, 1) } } @keyframes jump-down-3 { 35% { transform: scale(1, 1) } 45% { transform-origin: center bottom; transform: scale(1.3, 0.7) } 50%, 55% { transform-origin: center bottom; transform: scale(0.8, 1.4) } 70% { transform-origin: center top; transform: scale(1.3, 0.7) } 85%, to { transform: scale(1, 1) } } @keyframes jump-down-4 { 50% { transform: scale(1, 1) } 60% { transform-origin: center bottom; transform: scale(1.3, 0.7) } 65%, 70% { transform-origin: center bottom; transform: scale(0.8, 1.4) } 85% { transform-origin: center top; transform: scale(1.3, 0.7) } to { transform: scale(1, 1) } }
    </style>
  </head>
  
  <body>
    <div class="container">
      <span class="girl"></span>
      <div class="boys">
        <span></span>
        <span></span>
        <span></span>
        <span></span>
      </div>
    </div>
  </body>
</html>