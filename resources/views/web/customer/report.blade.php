<style type="text/css" media="print">
  @page { size: landscape; }
</style>

<html>
    <head>
        <title>
            Report
        </title>
    </head>
    <body>
        <div style="">
            <img src="{{ asset('assets/logos/logo.png') }}" height="85px" width="250px"  />
            <h1 style="margin-left:535px;margin-top:-85px;font-size:40px">Premier Clinical Laboratory</h1>
            <h3 style="margin-left:585px;font-size:25px">{{ $item->site->name}}, {{ $item->site->address }}</h3>
            <br/>
            <br/>
            <br/>
            <br/>
            <table style="border:2px solid black;border-collapse:collapse;font-size:20px">
                <tbody>
                    <tr>
                        <th style="border:2px solid black;width:160px;text-align:right;">Name:</th>
                        <th style="border:2px solid black;width:200px;text-align:left">
                            {{ $item->customer->first_name }} {{ $item->customer->last_name }}

                        </th>
                        <th style="border:2px solid black;width:130px;"></th>
                        <th style="border:2px solid black;width:130px;"></th>
                        <th style="border:2px solid black;width:160px;text-align:right;">Provider:</th>
                        <th style="border:2px solid black;width:220px;text-align:left;">

                            Self Ordered

                        </th>
                    </tr>
                    <tr>
                        <th style="border:2px solid black;width:160px;text-align:right;">DOB:</th>
                        <th style="border:2px solid black;width:200px;text-align:left">
                            {{ $item->customer->dob }}

                        </th>
                        <th style="border:2px solid black;width:130px;"></th>
                        <th style="border:2px solid black;width:130px;"></th>
                        <th style="border:2px solid black;width:130px;"></th>
                        <th style="border:2px solid black;width:220px;"></th>
                    </tr>
                    <tr>
                        <th style="border:2px solid black;width:160px;text-align:right;">NIB:</th>
                        <th style="border:2px solid black;width:200px;"></th>
                        <th style="border:2px solid black;width:130px;text-align:right">Gender:</th>
                        <th style="border:2px solid black;width:130px;text-align:left">{{ $item->customer->Gender() }}</th>
                        <th style="border:2px solid black;width:150px;text-align:right;">Collection:</th>
                        <th style="border:2px solid black;width:220px;text-align:left;">{{ $item->site->name}}</th>
                    </tr>
                    <tr>
                        <th style="border:2px solid black;width:160px;text-align:right;">Collection Date:</th>
                        <th style="border:2px solid black;width:200px;text-align:left">
                            {{ $item->created_at }}</th>
                        <th style="border:2px solid black;width:130px;text-align:right">Age:</th>
                        <th style="border:2px solid black;width:130px;text-align:left">{{ $item->customer->Age().' Year(s)' }}</th>
                        <th style="border:2px solid black;width:150px;text-align:right;">Sample ID:</th>
                        <th style="border:2px solid black;width:220px;text-align:left;">
                            {{ $item->package_number }}
                        </th>
                    </tr>
                    <tr>
                        <th style="border:2px solid black;width:160px;text-align:right;">Approval Date:</th>
                        <th style="border:2px solid black;width:200px;text-align:left">
                            {{ $item->updated_at }}</th>
                        <th style="border:2px solid black;width:130px;text-align:right"></th>
                        <th style="border:2px solid black;width:130px;text-align:left"></th>
                        <th style="border:2px solid black;width:150px;text-align:right;">Collected By:
                        </th>
                        <th style="border:2px solid black;width:220px;text-align:left;">
                        {{ ($item->employee === null) ? 'N/A' :  $item->employee->name}}</th>
                    </tr>
                    <tr>
                        <th style="border:2px solid black;width:160px;text-align:right;"></th>
                        <th style="border:2px solid black;width:200px;text-align:left"></th>
                        <th style="border:2px solid black;width:130px;text-align:right"></th>
                        <th style="border:2px solid black;width:130px;text-align:left"></th>
                        <th style="border:2px solid black;width:150px;text-align:right;">Entered By:</th>
                        <th style="border:2px solid black;width:220px;text-align:left;">
                        {{ ($item->employee === null) ? 'N/A' :  $item->employee->name}}
                        </th>
                    </tr>
                    <tr>
                        <th style="border:2px solid black;width:160px;text-align:right;height:27px"></th>
                        <th style="border:2px solid black;width:200px;text-align:left;height:27px"></th>
                        <th style="border:2px solid black;width:130px;text-align:right;height:27px"></th>
                        <th style="border:2px solid black;width:130px;text-align:left;height:27px"></th>
                        <th style="border:2px solid black;width:150px;text-align:right;height:27px"></th>
                        <th style="border:2px solid black;width:220px;text-align:left;height:27px"></th>
                    </tr>
                    <tr style="background-color:LightGray">
                        <th style="border:2px solid black;width:160px;text-align:center;height:27px">TEST NAME</th>
                        <th style="border:2px solid black;width:200px;text-align:left;height:27px"></th>
                        <th style="border:2px solid black;width:130px;text-align:center;height:27px">RESULT</th>
                        <th style="border:2px solid black;width:130px;text-align:left;height:27px"></th>
                        <th style="border:2px solid black;width:150px;text-align:center;height:27px">UNITS</th>
                        <th style="border:2px solid black;width:220px;text-align:center;height:27px">REFERENCE RANGE</th>
                    </tr>
                    <tr style="background-color:LightGray">
                        <th style="border:2px solid black;width:160px;text-align:right;height:27px"></th>
                        <th style="border:2px solid black;width:200px;text-align:center;height:27px">IN RANGE</th>
                        <th style="border:2px solid black;width:130px;text-align:center;height:27px"colspan="2">OUT OF RANGE</th>
                        <th style="border:2px solid black;width:150px;text-align:right;height:27px"></th>
                        <th style="border:2px solid black;width:220px;text-align:left;height:27px"></th>
                    </tr>
                    <tr style="background-color:LightGray">
                        <th style="border:2px solid black;width:160px;text-align:center;height:27px">COVID-19 {{ $item->Type(true) }}</th>
                        <th style="border:2px solid black;width:200px;text-align:left;height:27px"> {{($item->Report() == 'NEGATIVE') ? $item->Report():''   }}</th>
                        <th style="border:2px solid black;width:130px;text-align:center;height:27px"></th>
                        <th style="border:2px solid black;width:130px;text-align:center;height:27px;color:  {{($item->Report() == 'POSITIVE') ? 'red':''  }}">{{($item->Report() == 'POSITIVE') ? $item->Report():''   }}</th>
                        <th style="border:2px solid black;width:150px;text-align:center;height:27px"></th>
                        <th style="border:2px solid black;width:220px;text-align:center;height:27px">{{ $item->Report() }}</th>
                    </tr>
                    <tr style="background-color:LightGray">
                        <th style="border:2px solid black;width:160px;vertical-align:text-top;font-size:19px">{{ now() }}<br></th>

                        <th style="border:2px solid black;width:220px;height:27px;"colspan="5"> Negative result does not rule out Sars-Cov-2 infection particularly in patients who have been in contact with the virus. A patient’s recent exposure and the presence of clinical symptoms consistent with Covid-19 should be considered with a False/Negative result. A negative test result in this assay is expected for a patient without symptoms of Covid-19 and who is not shedding Sars-Cov-2 virus.</th>
                    </tr>
                </tbody>
            </table>
        </div>
    </body>
</html>


<script>window.print()</script>
