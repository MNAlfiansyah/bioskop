<!DOCTYPE html>
<html>
<head>
    <title>Hello World</title>
    <style>
    body {
        width: 100%;
        height: 100%;
        margin: 0;
        padding: 0;
        background-color: #FAFAFA;
        font: 12pt "Tahoma";
    }
    * {
        box-sizing: border-box;
        -moz-box-sizing: border-box;
    }
    .page {
        width: 58mm;
        min-height: 297mm;
        padding: 20mm;
        margin: 10mm auto;
        border: 1px #D3D3D3 solid;
        border-radius: 5px;
        background: white;
        box-shadow: 0 0 5px rgba(0, 0, 0, 0.1);
    }
    .subpage {
        padding: 1cm;
        border: 5px red solid;
        height: 58;
        outline: 2cm #FFEAEA solid;
    }
    
    @page {
        margin: 0;
    }
    @media print {
        html, body {
            width: 58mm;
            height: 58mm;        
        }
        .page {
            margin: 0;
            border: initial;
            border-radius: initial;
            width: initial;
            min-height: initial;
            box-shadow: initial;
            background: initial;
            page-break-after: always;
        }
    }
</style>
</head>
<body>
    <div class="book">
        <div class="page">
            <div class="subpage">Page 1/2</div>    
        </div>
    </div>
</body>

<script type="text/javascript">
    window.print();
</script>
</html>