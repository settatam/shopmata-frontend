<html>
    <head>
        <style>
            body {
                margin: 0;
                padding: 0;
            }
            div {
                page-break-after: always;
                /*height: 90px;*/
                /*width: 390px;*/
                /*border: 1px solid #000;*/
            }

            @media print {
              @page {
                size: 4mm 6mm;
              }
            }
        </style>
    </head>
    <body>
        @foreach($printables as $printable)
            @for($i=0; $i<2; $i++)
                <div>
                    <img src="data:image/png;base64, {{ $printable->raw_data }}" />
                </div>
            @endfor
        @endforeach

        <script type="text/javascript">
            alert('yes');
              window.onload = function() { window.print(); }
         </script>
    </body>
</html>




