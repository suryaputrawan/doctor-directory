<!DOCTYPE html>
<html>
<head>
    <meta http-equiv="refresh" content="20" />
  <title>WARD INFORMATION</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>

  <style type="text/css">

    #halaman{
        width: 100%; 
        height: 100%; 
        position: absolute; 
        padding-top: 10px; 
        padding-left: 10px; 
        padding-right: 10px; 
        padding-bottom: 10px;
    }

    table tr td,
    table tr th{
        font-size: 14pt;
    }

    /* Table styling */
    table {
        width: 100%;
        border-collapse: collapse;
    }

    td, th {
        border: 1px solid #ddd;
        padding: 4px;
    }

    th {
        background-color: blue;
        /* background-color: #f2f2f2; */
        color: white;
        text-align: left;
    }

    /* Mengatur warna baris */
    table tr {
        background:#f5fcf8;
    }

    @media screen and (max-width: 600px) {
    table, thead, tbody, th, td, tr {
        display: block;
    }

    th {
        position: absolute;
        top: -9999px;
        left: -9999px;
    }

    td {
        border: none;
        border-bottom: 1px solid #0a0a0a;
        position: relative;
        padding-left: 50%;
    }

    td:before {
        position: absolute;
        top: 6px;
        left: 6px;
        width: 45%;
        padding-right: 10px;
        white-space: nowrap;
        content: attr(data-label);
        font-weight: bold;
    }
    }
</style>
</head>
<body>
    <div id="halaman">
        <h5 style="font-size: 150%; padding-bottom: 5px;"><center><strong>WARD INFORMATION - {{ $date }}</strong></center></h5>
        <table>
            <thead>
                <tr>
                    <th scope="col"><center>LOCATION</center></th>
                    <th scope="col"><center>BED</center></th>
                    <th scope="col"><center>SEX</center></th>
                    <th scope="col"><center>SPECIALIST</center></th>
                    <th scope="col"><center>RMO</center></th>
                    <th scope="col"><center>NURSE</center></th>
                </tr>
            </thead>
            <tbody>
              @foreach ($schedules as $index => $schedule)
                  @foreach ($schedule as $itemIndex => $item)
                      @if ($itemIndex == 0)
                          <tr>
                              <td rowspan="{{ count($schedule) }}" align="center" valign="middle">{{ $index }}</td>
                              <td align="center">{{ $item->room->name }}</td>
                              <td align="center">{{ $item->patient_sex }}</td>
                              <td align="center">{{ $item->spesialist()->get()->implode('name',', ') }}</td>
                              <td align="center">{{ $item->dokter_id ? $item->dokter->name : '' }}</td>
                              <td align="center">{{ $item->nurse_id ? $item->nurse->name : '' }}</td>
                          </tr>
                      @else
                          <tr>
                              <td align="center">{{ $item->room->name }}</td>
                              <td align="center">{{ $item->patient_sex }}</td>
                              <td align="center">{{ $item->spesialist()->get()->implode('name',', ') }}</td>
                              <td align="center">{{ $item->dokter_id ? $item->dokter->name : '' }}</td>
                              <td align="center">{{ $item->nurse_id ? $item->nurse->name : '' }}</td>
                          </tr>
                      @endif
                  @endforeach
              @endforeach
            </tbody>
        </table>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js" integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js" integrity="sha384-cVKIPhGWiC2Al4u+LWgxfKTRIcfu0JTxR+EQDz/bgldoEyl4H0zUF0QKbrJ0EcQF" crossorigin="anonymous"></script>
</body>
</html>

{{-- <!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <link href="//netdna.bootstrapcdn.com/bootstrap/3.1.0/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
    <script src="//netdna.bootstrapcdn.com/bootstrap/3.1.0/js/bootstrap.min.js"></script>
    <script src="//code.jquery.com/jquery-1.11.1.min.js"></script>

    <style type="text/css">
        .container { padding-top: 10px; width: 100%; height: 100%;}
        #details { font-family: "Quicksand", sans-serif; font-size: 24px; padding-left: 30px }
        #home-box > h2 { font-family: "Quicksand", sans-serif; font-weight: 600; line-height: 1.1; color: #75b1ae; }
        .pricing_header { background: none repeat scroll 0% 0% rgb(44, 62, 80); border-radius: 5px 5px 0px 0px; transition: background 0.4s ease-out 0s; }
        .pricing_header h2 { text-align:center; line-height: 25px; padding: 15px 0px; margin: 0px; font-family: "Quicksand", sans-serif; font-weight: 400; color: #eff3f3; }
        .list-group-item:first-child { border-top-right-radius: 0px; border-top-left-radius: 0px;}
        .list-group-item { border-top-right-radius: 0px; border-top-left-radius: 0px; font-size: 18px;}
        .off { text-decoration: line-through; color: rgb(86,86,86); }
        .space {height: 2px; background-color: #75b1ae;}
    </style>
</head>
<body>
    <div class="container">
        <div class="row">
            <h6 id="details"><strong>WARD INFORMATION</strong></h6>
        </div><br>

           @foreach ($schedules as $index => $schedule)
                @foreach ($schedule as $itemIndex => $item)
                    <div class="col-md-3" id="home-box">
                        <div class="pricing_header">
                            <h2>{{ $item->room->name }} - {{ $item->room->location->name }}</h2>
                            <div class="space"></div>
                        </div>
                            <ul class="list-group">
                                <li class="list-group-item"><span class="glyphicon glyphicon-ok"></span> {{ $item->patient_sex }}</li>
                                <li class="list-group-item"><span class="glyphicon glyphicon-user"></span> {{ $item->dokter_id ? $item->dokter->name : '' }}</li>
                                <li class="list-group-item"><span class="glyphicon glyphicon-user"></span> {{ $item->nurse ? $item->nurse->name : '' }}</li>
                            </ul>
                    </div>
                @endforeach
           @endforeach
    </div>
</body>
</html> --}}

                