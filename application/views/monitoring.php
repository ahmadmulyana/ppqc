<!doctype html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Mode Monitoring</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-Zenh87qX5JnK2Jl0vWa8Ck2rdkQ2Bzep5IDxbcnCeuOxjzrPF/et3URy9Bv1WTRi" crossorigin="anonymous">

  <!-- Google Font -->
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;700&family=Open+Sans:wght@400;500;700&display=swap" rel="stylesheet">

  <style>

    html,body {
      height:100vh;
      overflow: hidden;
      font-family: 'Open Sans', sans-serif;
      background: #ecf0f6;
    }
    .forquality h2 {
      font-size: 18px !important;
      font-weight: 600;
      font-family: 'Inter', sans-serif;
    }
    .forquality p {
      margin-bottom: 0px;
    }
    .bgblue {
      background: rgba(25, 122, 207, .3);
      border-radius: 10px;
    }
    .bgyellow {
      background: rgba(255, 229, 0, .3);
      border-radius: 10px;
    }
    .card {
      min-height: 250px;
    }
    .forquality {
      padding: 10px;
    }
    .fornc {
      padding: 10px;
    }
    .fornc h2 {
      font-size: 18px !important;
      font-weight: 600;
      font-family: 'Inter', sans-serif;
    }
    .no-overflow {
      display:inline-block;
      white-space:nowrap;
      position:relative; /* must be relative */
      width:100%; /* fit to table cell width */
      margin-right:-1000px; /* technically this is a less than zero width object */
      overflow:hidden;
    }
    .table>thead {
      background-color: #197ACF;
      color: #FFFFFF;
    }
    .table.table-responsive {
      margin-bottom: 0px;
      font-size: 14px;
    }
    .table>:not(caption)>*>* {
      padding: 0.4rem 0.5rem !important;
    }
    .css h3 {
      font-size: 18px !important;
      font-weight: 600;
      font-family: 'Inter', sans-serif;
    }
    h2.title {
      font-size: 24px !important;
      font-weight: 600;
      font-family: 'Inter', sans-serif;
    }

  </style>

</head>
<body>
	<div style="text-align: right; margin-right: 10px;">
		<button id="go-button" class="btn btn-primary btn-sm">Full Screen</button>
	</div>

  <main id="element">
    <div class="container-fluid">
      <h2 class="title">Mode Monitoring</h2>
    </div>
    <div class="container-fluid">
      <div class="row">
        <div class="col-md-4">
          <div class="card">
            <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3967.03999417684!2d106.85793281517394!3d-6.1253203955648905!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x2e6a1fa3823b7263%3A0x9fc9c0986c6adaf9!2sJakarta%20International%20Stadium!5e0!3m2!1sen!2sid!4v1668495718503!5m2!1sen!2sid" width="100%" height="250" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
          </div>
        </div>
        <div class="col-md-4">
          <div class="card forquality">
            <div class="row p-2">
              <div class="col-md-12">
                <h2>Quality Achievment</h2>
              </div>
              <div class="col">
                <div class="text-center bgblue p-2">
                  <p>Assessment</p>
                  <h2>91.50</h2>
                </div>
              </div>
              <div class="col">
                <div class="text-center bgblue p-2">
                  <p>QSIA</p>
                  <h2>90.00</h2>
                </div>
              </div>
            </div>
            <div class="row p-2">
              <div class="col-md-12">
                <h2>Customer Satisfaction Survey</h2>
              </div>
              <div class="col">
                <div class="text-center bgyellow p-2">
                  <p>50%</p>
                  <h2>82.57</h2>
                </div>
              </div>
              <div class="col">
                <div class="text-center bgblue p-2">
                  <p>100%</p>
                  <h2>98.45</h2>
                </div>
              </div>
            </div>
          </div>
        </div>
        <div class="col-md-4">
          <div class="card fornc">
            <div class="row p-2">
              <div class="col-md-12">
                <h2>Non Conformance</h2>
              </div>
              <div class="col-md-12 p-2">
                <div class="bgblue m-auto text-center p-2">
                  <div class="row">
                    <div class="col-md-4 m-auto">Close</div>
                    <div class="col-md-4 m-auto"><h2>2</h2></div>
                    <div class="col-md-4 m-auto"><span class="alert alert-success" role="alert" style="display: none;">67%</span></div>
                  </div>
                </div>
              </div>
              <div class="col-md-12 p-2">
                <div class="bgblue m-auto text-center p-2">
                  <div class="row">
                    <div class="col-md-4 m-auto">Open</div>
                    <div class="col-md-4 m-auto"><h2>1</h2></div>
                    <div class="col-md-4 m-auto"><span class="alert alert-danger" role="alert" style="display: none;">33 %</span></div>
                  </div>
                </div>
              </div>
              <div class="col-md-12 p-2">
                <div class="bgblue m-auto text-center p-2">
                  <div class="row">
                    <div class="col-md-4 m-auto">Total</div>
                    <div class="col-md-4 m-auto"><h2>3</h2></div>
                    <div class="col-md-4 m-auto"><span class="alert alert-warning" role="alert" style="display: none;">100%</span></div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
    <br>
    <div class="container-fluid">
      <div class="row">
        <div class="col-md-4">
          <div class="card p-3">
            <div class="row css">
              <div class="col-md-6">
                <div class="inspeksi">
                  <h3>This Week</h3>
                  <table class="table table-responsive w-100">
                    <thead>
                      <tr>
                        <th colspan="2">Nama Pekerjaan</th>
                      </tr>
                    </thead>
                    <tbody>
                      <tr><td colspan="2">Tidak ada data</td></tr>                                        
                    </tbody>
                  </table>
                </div>
              </div>
              <div class="col-md-6">
                <div class="inspeksi">
                  <h3>Next Week</h3>
                  <table class="table table-responsive w-100">
                    <thead>
                      <tr>
                        <th colspan="2">Nama Pekerjaan</th>
                      </tr>
                    </thead>
                    <tbody>
                      <tr><td>Tidak ada data</td></tr>                                        
                    </tbody>
                  </table>
                </div>
              </div>
            </div>
          </div>
        </div>
        <div class="col-md-4">
          <div class="card p-2">
            <div class="row css">
              <div class="col-md-12 mt-2">
                <div class="inspeksi">
                  <h3>CSS On Going</h3>
                  <table class="table table-responsive w-100">
                    <thead>
                      <tr>
                        <th colspan="2">Nama Pekerjaan</th>
                        <th>Keadaan</th>
                        <th>Status</th>
                      </tr>
                    </thead>
                    <tbody>
                      <tr>
                        <td class="text-primary">1</td>
                        <td>Jalan Kendari - Toronipa Tahap 2 <br> <span>12 November 2021</span> - MWT Biro QHSE</td>
                        <td class="text-primary">(45.56%)</td>
                        <td class="text-primary">+12 hr</td>
                      </tr>
                      <tr>
                        <td class="text-primary">2</td>
                        <td>Jalan Kendari - Toronipa Tahap 2 <br> <span>12 November 2021</span> - MWT Biro QHSE</td>
                        <td class="text-primary"><span class="alert alert-danger" style="display: none;">(100%)</span></td>
                        <td class="text-primary">+5 hr</td>
                      </tr>
                      <tr>
                        <td class="text-primary">3</td>
                        <td>Jalan Kendari - Toronipa Tahap 2 <br> <span>12 November 2021</span> - MWT Biro QHSE</td>
                        <td class="text-primary">(45.56%)</td>
                        <td class="text-primary">+12 hr</td>
                      </tr>
                      <tr>
                        <td class="text-primary">4</td>
                        <td>Jalan Kendari - Toronipa Tahap 2 <br> <span>12 November 2021</span> - MWT Biro QHSE</td>
                        <td class="text-primary"><span class="alert alert-danger" style="display: none;">(56.32%)</span></td>
                        <td class="text-primary">Belum diajukan</td>
                      </tr>
                      <tr>
                        <td class="text-primary">5</td>
                        <td>Jalan Kendari - Toronipa Tahap 2 <br> <span>12 November 2021</span> - MWT Biro QHSE</td>
                        <td class="text-primary">(56.32%)</td>
                        <td class="text-primary">Belum diajukan</td>
                      </tr>
                    </tbody>
                  </table>
                </div>
              </div>
            </div>
          </div>
        </div>
        <div class="col-md-4">
          <div class="card fornc mb-2">
            <div class="row p-2">
              <div class="col-md-12">
                <h2>Mobile Inspeksi</h2>
              </div>
              <table class="table table-responsive w-100">
                <thead>
                  <tr>
                    <th colspan="3">Nama Pekerjaan</th>
                  </tr>
                </thead>
                <tbody>

                  <tr>
                    <td class="">1</td>
                    <td class="">Oke</td>
                    <td class="">1</td>
                  </tr>
                  <tr>
                    <td class="">2</td>
                    <td class="">Tes</td>
                    <td class="">2</td>
                  </tr>
                  <tr>
                    <td class="">3</td>
                    <td class="">Kegiatan Visit</td>
                    <td class="">3</td>
                  </tr>
                  <tr>
                    <td class="">4</td>
                    <td class="">Mengunjungi lokasi kejadian</td>
                    <td class="">4</td>
                  </tr>
                  <tr>
                    <td class="">5</td>
                    <td class="">Kegiatan Tes</td>
                    <td class="">5</td>
                  </tr>
                </tbody>
              </table>
            </div>
          </div>
          <div class="card fornc">
            <div class="row p-2">
              <div class="col-md-12">
                <h2>Potensi</h2>
              </div>
              <table class="table table-responsive w-100 ">
                <thead>
                  <tr>
                    <th colspan="3">Nama Pekerjaan</th>
                  </tr>
                </thead>
                <tbody>
                  <tr>
                    <td>1</td>
                    <td class="no-overflow">Jalan Kawasan Industri Batang 14</td>
                    <td><span class="alert alert-danger" role="alert" style="display: none;">80%</span></td>
                  </tr>
                  <tr>
                    <td>2</td>
                    <td>Jalan Kawasan Industri Batang 14</td>
                    <td><span class="alert alert-danger" role="alert" style="display: none;">80%</span></td>
                  </tr>
                  <tr>
                    <td>3</td>
                    <td>Jalan Kawasan Industri Batang 14</td>
                    <td><span class="alert alert-warning" role="alert" style="display: none;">80%</span></td>
                  </tr>
                  <tr>
                    <td>4</td>
                    <td>Jalan Kawasan Industri Batang 14</td>
                    <td><span class="alert alert-success" role="alert" style="display: none;">80%</span></td>
                  </tr>
                  <tr>
                    <td>5</td>
                    <td>Jalan Kawasan Industri Batang 14</td>
                    <td><span class="alert alert-success" role="alert" style="display: none;">80%</span></td>
                  </tr>
                </tbody>
              </table>
            </div>
          </div>
        </div>
      </div>
    </div>

  </main>

  <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.4/jquery.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-OERcA2EqjJCMA+/3y+gxIOqMEjwtxJY7qPCqsdltbNJuaOe923+mo//f6V8Qbsw3" crossorigin="anonymous"></script>

  <script>

/* Get into full screen */
function GoInFullscreen(element) {
	if(element.requestFullscreen)
		element.requestFullscreen();
	else if(element.mozRequestFullScreen)
		element.mozRequestFullScreen();
	else if(element.webkitRequestFullscreen)
		element.webkitRequestFullscreen();
	else if(element.msRequestFullscreen)
		element.msRequestFullscreen();
}

/* Get out of full screen */
function GoOutFullscreen() {
	if(document.exitFullscreen)
		document.exitFullscreen();
	else if(document.mozCancelFullScreen)
		document.mozCancelFullScreen();
	else if(document.webkitExitFullscreen)
		document.webkitExitFullscreen();
	else if(document.msExitFullscreen)
		document.msExitFullscreen();
}

/* Is currently in full screen or not */
function IsFullScreenCurrently() {
	var full_screen_element = document.fullscreenElement || document.webkitFullscreenElement || document.mozFullScreenElement || document.msFullscreenElement || null;
	
	// If no element is in full-screen
	if(full_screen_element === null)
		return false;
	else
		return true;
}

$("#go-button").on('click', function() {
	if(IsFullScreenCurrently())
		GoOutFullscreen();
	else
		GoInFullscreen($("#element").get(0));
});

$(document).on('fullscreenchange webkitfullscreenchange mozfullscreenchange MSFullscreenChange', function() {
	if(IsFullScreenCurrently()) {
		$("#go-button").text('X');
	}
	else {
		$("#go-button").text('+');
	}
});

$(document).ready(function(){
	//Monitoring();
});

</script>
</body>
</html>