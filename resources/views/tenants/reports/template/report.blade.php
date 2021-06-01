<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Relatório</title>
    @yield('css_person')
    <style>
        @page {
            margin: 120px 50px 80px 50px;
        }
        body{
            font-size: 11px;
        }
        #footer {
            position: fixed;
            bottom: 0;
            width: 100%;
            text-align: right;
            border-top: 0px solid gray;
            padding-top: 5px;
        }
        #head{
            background-repeat: no-repeat;
            /*font-size: 25px;*/
            text-align: center;
            height: 30px;
            width: 100%;
            position: fixed;
            top: -50px;
            left: 0;
            right: 0;
            margin: auto;
            border: 0px solid #ccc;
        }
        #corpo{
            width: 100%;
            position: relative;
            margin: auto;
        }
        table {
            width: 100%;
            border-collapse: collapse;
        }
    </style>
</head>
<body>
<div id="head">
    <div style="width:100%;">
        <div style="float:left;width:100%; text-align:center; height:30px; vertical-align:bottom">
            <h1>@yield('title')</h1>
        </div>
        <div style="float:left;width:100%; text-align:right; height:30px">
            <p style="margin-top:7px; padding:0;height:20px"></p>
            <p style="margin: 0; padding:0; font-size:9px">{{date("d/m/Y h:i:s")}}</p>
        </div>
    </div>
</div>

@yield("body")

@yield('js')
<script type="text/php">
        if (isset($pdf)) {
            $text = "Página {PAGE_NUM} / {PAGE_COUNT})";
            $size = 9;
            $font = $fontMetrics->getFont("times");
            $width = $fontMetrics->get_text_width($text, $font, $size) / 2;
            $x = ($pdf->get_width() - $width) / 2;
            $y = $pdf->get_height() - 35;
            $pdf->page_text($x, $y, $text, $font, $size);
        }
    </script>
</body>
</html>
