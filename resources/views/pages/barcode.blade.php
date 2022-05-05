<html>
    <head>
        <style>
            body {
                margin: 0;
                padding: 0;
            }
            @page {
                size: A4;
                margin: 0;
                padding: 0;
            }
            div {
                page-break-after: always;
                height: 90px;
                width: 390px;
                border: 1px solid #000;
            }

            @media print {
              @page {
                size: auto
              }
            }
        </style>
    </head>
    <body>
        @foreach($printables as $printable)
            @for($i=0; $i<5; $i++)
                <div>
                    <img src="data:image/png;base64, {{ $printable }}" />
                </div>
            @endfor
        @endforeach

        <script type="text/javascript">
            alert('yes');
              window.onload = function() { window.print(); }
         </script>
    </body>
</html>



