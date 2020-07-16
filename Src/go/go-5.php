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
    <style type="text/css">html { overflow: hidden } html, html body { height: 100%; min-height: 100% } html body { background: #222428; background-size: 163px; font: 14px/21px Monaco, sans-serif; color: #999; font-smoothing: antialiased; -webkit-text-size-adjust: 100%; -ms-text-size-adjust: 100%; text-size-adjust: 100% } html body a, html body a:visited { text-decoration: none; color: #ff805f } html body h4 { margin: 0; color: #666 } .scene { width: 100%; height: 100%; -webkit-perspective: 600; perspective: 600; display: flex; align-items: center; justify-content: center } .scene svg { width: 15pc; height: 15pc } .dc-logo { position: fixed; right: 10px; bottom: 10px } .dc-logo:hover svg { -webkit-transform-origin: 50% 50%; transform-origin: 50% 50%; -webkit-animation: arrow-spin 2.5s 0s cubic-bezier(0.165, 0.84, 0.44, 1) infinite; animation: arrow-spin 2.5s 0s cubic-bezier(0.165, 0.84, 0.44, 1) infinite } .dc-logo:hover:hover:before { content: '\2764'; color: #00fffe; left: -70px } .dc-logo:hover:hover:after, .dc-logo:hover:hover:before { padding: 6px; font: 10px/1 Monaco, sans-serif; font-size: 10px; text-transform: uppercase; position: absolute; top: -30px; white-space: nowrap; z-index: 20px; box-shadow: 0 0 4px #222; background: rgba(0, 0, 0, .4) } .dc-logo:hover:hover:after { content: 'Digital Craft'; color: #6e6f71; right: 0; background-image: none } @keyframes arrow-spin { 50% { -webkit-transform: rotateY(360deg); transform: rotateY(360deg) } }
    </style>
  </head>
  
  <body>
    <div class="scene">
      <svg version="1.1" id="dc-spinner" xmlns="http://www.w3.org/2000/svg" x="0px" y="0px" width: "38" height: "38" viewbox="0 0 38 38" preserveaspectratio="xMinYMin meet">
        <text x="14" y="21" font-family="Monaco" font-size="2px" style="letter-spacing:0.6" fill="grey">LOADING
          <animate attributename="opacity" values="0;1;0" dur="1.8s" repeatcount="indefinite" /></text>
        <path fill="#373a42" d="M20,35c-8.271,0-15-6.729-15-15S11.729,5,20,5s15,6.729,15,15S28.271,35,20,35z M20,5.203 C11.841,5.203,5.203,11.841,5.203,20c0,8.159,6.638,14.797,14.797,14.797S34.797,28.159,34.797,20 C34.797,11.841,28.159,5.203,20,5.203z"></path>
        <path fill="#373a42" d="M20,33.125c-7.237,0-13.125-5.888-13.125-13.125S12.763,6.875,20,6.875S33.125,12.763,33.125,20 S27.237,33.125,20,33.125z M20,7.078C12.875,7.078,7.078,12.875,7.078,20c0,7.125,5.797,12.922,12.922,12.922 S32.922,27.125,32.922,20C32.922,12.875,27.125,7.078,20,7.078z"></path>
        <path fill="#2AA198" stroke="#2AA198" stroke-width="0.6027" stroke-miterlimit="10" d="M5.203,20 c0-8.159,6.638-14.797,14.797-14.797V5C11.729,5,5,11.729,5,20s6.729,15,15,15v-0.203C11.841,34.797,5.203,28.159,5.203,20z">
          <animatetransform attributename="transform" type="rotate" from="0 20 20" to="360 20 20" calcmode="spline" keysplines="0.4, 0, 0.2, 1" keytimes="0;1" dur="2s" repeatcount="indefinite" /></path>
        <path fill="#859900" stroke="#859900" stroke-width="0.2027" stroke-miterlimit="10" d="M7.078,20 c0-7.125,5.797-12.922,12.922-12.922V6.875C12.763,6.875,6.875,12.763,6.875,20S12.763,33.125,20,33.125v-0.203 C12.875,32.922,7.078,27.125,7.078,20z">
          <animatetransform attributename="transform" type="rotate" from="0 20 20" to="360 20 20" dur="1.8s" repeatcount="indefinite" /></path>
      </svg>
    </div>
  </body>
</html>