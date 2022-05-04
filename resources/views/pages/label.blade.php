<html>
    <head>
        <style>
            body {
                margin: 0;
                padding: 0;
            }
            img {
                page-break-after: always;
                display: block;
                height: 100%;
                width: 100%;
                /*height: 90px;*/
                /*width: 390px;*/
                /*border: 1px solid #000;*/
            }

            @media print {
              @page {
                size: 4in 6in;
              }
            }
        </style>
    </head>
    <body>
        @foreach($printables as $printable)
            @for($i=0; $i<2; $i++)
                <img src="data:image/png;base64, {{ $printable->raw_data }}" />
            @endfor
        @endforeach

        <script type="text/javascript">
            alert('yes');
              window.onload = function() { window.print(); }
         </script>
    </body>
</html>




