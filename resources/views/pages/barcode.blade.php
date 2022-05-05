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
                width: 1.125in;
                height: 3.5in;
                margin: .5in;
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
            @for($i=0; $i<2; $i++)
                <div>
                    <img src="data:image/png;base64, {{ $printable }}" />
                </div>
            @endfor
        @endforeach

        <script type="text/javascript">
              window.onload = function() { window.print(); }
         </script>
    </body>
</html>



