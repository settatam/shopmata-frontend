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
                height: 6in;
                width: 4in;
            }

            @media print {
              @page {
                  size: auto;
                  margin: 0;
              }
            }
        </style>
    </head>
    <body>
        @foreach($printables as $printable)
            @for($i=0; $i<$printable['qty']; $i++)
                <img src="data:image/png;base64, {{ $printable['label']->raw_data }}" />
            @endfor
        @endforeach

        <script type="text/javascript">
              window.onload = function() { window.print(); }
         </script>
    </body>
</html>




