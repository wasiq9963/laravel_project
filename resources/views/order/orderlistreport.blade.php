<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <title>Orders List Report</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />

    <link
      rel="stylesheet"
      href="https://cdn.materialdesignicons.com/2.8.94/css/materialdesignicons.min.css"
    />
    <script src="{{asset('assets/plugins/jquery/jquery.min.js')}}"></script>
    <script src="{{asset('style/bootstrap.min.js')}}"></script>
    <script src="{{asset('activereportsjs/ar-js-core.js')}}"></script>
	<script src="{{asset('activereportsjs/ar-js-viewer.js')}}"></script>
	<script src="{{asset('activereportsjs/ar-js-pdf.js')}}"></script>
	<script src="{{asset('activereportsjs/ar-js-xlsx.js')}}"></script>
	<script src="{{asset('activereportsjs/ar-js-html.js')}}"></script>


    <link
      href="https://fonts.googleapis.com/css2?family=Montserrat:ital,wght@0,300;0,400;0,500;0,600;0,700;1,400&display=swap"
      rel="stylesheet"
    />
    <link
	  rel="stylesheet"
	  href="{{asset('activereportsjs/ar-js-ui.css')}}"
	  type="text/css"
	/>
	<link
	  rel="stylesheet"
	  href="{{asset('activereportsjs/ar-js-viewer.css')}}"
	  type="text/css"
	/>
    <style>
      #viewer-host {
        margin: 0 auto;
        width: 100%;
        height: 650px;
      }
    </style>
  </head>
  <body onload="onLoad()">
    <div id="viewer-host"></div>
    <script>
      async function loadData() {
        // Use the Fetch Api to pull the data https://developer.mozilla.org/en-US/docs/Web/API/Fetch_API/Using_Fetch
        const headers = new Headers();

        const url = '{{'/storereport/fetch?store='.$store.'&from='.$from.'&to='.$to}}';
        const parseResult = new DOMParser().parseFromString(url, "text/html");
        const parsedUrl = parseResult.documentElement.textContent;
        
               /*const dataRequest = new Request(

                '{{'/storereport/fetch?store='.$store.'&from='.$from.'&to='.$to}}',   
                 {
                  headers: headers,
                 }
              );*/
        const response = await fetch(parsedUrl);
        const data = await response.json();
        console.log(data);
        return data;
      }

      async function loadReport() {
        // load report definition from the file
        const reportResponse = await fetch(
          '{{asset('assets/storerecord.rdlx-json')}}'
          // 'proreport.rdlx-json'
        );
        const report = await reportResponse.json();
        return report;
      }

      async function onLoad() {
        /*GC.ActiveReports.Core.FontStore.registerFonts(
          "/activereportsjs/demos/resource/fontsConfig.json"
        );*/
        const viewer = new ActiveReports.Viewer("#viewer-host");
        const data = await loadData();
        const report = await loadReport();
        // update the embedded data
        report.DataSources[0].ConnectionProperties.ConnectString =
          "jsondata=" + JSON.stringify(data);
        viewer.open(report);
      }
    </script>
  </body>
</html>
