<?php
include_once("sql/Database.php");
?>
<!DOCTYPE html>
<html lang="tr">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta http-equiv="X-UA-Compatible" content="IE=edge" /> 

    <!--[if le IE 9]> -->
    <script src="http://html5shiv.googlecode.com/svn/trunk/html5.js"></script>
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" type="text/css" href="bootstrap-4.1/css/bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="bootstrap-4.1/css/bootstrap.css">
    <link rel="stylesheet" type="text/css" href="bootstrap-4.1/css/sesFrekans.css">
    <script type="text/javascript" src="bootstrap-4.1/js/bootstrap.min.js"></script>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">

    <title>Ses Frekans Analizi</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">

  
  </head>
  <body  >
    <header style="width: 100%; height: 200px; margin-bottom: 100px; background-image: url('image/iste.jpg');">
      <div class="container-fluid" >
       <div class="headerBilgi"><pre>
        İskenderun Teknik Üniversitesi 
        Mühendislik ve Doğa Bilimleri Fakültesi
        Bilgisayar Mühendisliği Bölümü
       </pre></div>
      </div>  
    </header>
    <div class="clearfix"></div>
    <div class="container sameHeight" style="margin-bottom: 100px; ">
  <!-- Content here -->
      <div class="col cellHeight" style="float: left; width: 75% !important; margin-bottom: 30px;">
          <form id="indexForm">
            <fieldset>
              <legend class="kontrolLegend">Ses Frekans Analizi</legend>
              <p style="text-align: center;padding: 10px;">Javascript, kendi seslerinizi ve müziklerinizi üretmak için harika imkanlar sunuyor. Bu şekilde oluşturulan sesin frekansa ve ses ayarı ile genliğe bağlı değişimini incleyebilirsiniz.</p>
             <div class="form-check">
               <label for="customRange3" style=" font-weight: 600;font-size: 17px;">Volume</label>
               <input type="range" class="slider" name="vol" min="0" max="200" step="2" value ="30" onchange="updateSliderVol(this.value)" id="myVolume" oninput="myPlayer.setVolume(this.value/100);">
                <p>Value: <span style="color:black;" id="demo1">30</span></p>
              </div>
              <script>
                 function updateSliderVol(slideAmount) {
                  var sliderVol = document.getElementById("demo1");
                  sliderVol.innerHTML = slideAmount;
                   }
              </script>
              <div class="form-check">
               <label for="customRange3" style=" font-weight: 600;font-size: 17px;">Frekans</label>
               <input type="range" class="slider" name="freq" min="20" max="20000" value ="220" step="2" onchange="updateSliderFreq(this.value)" id="myRange" oninput="myPlayer.setFrequency(this.value);">
                <p>Value: <span id="demo">220</span></p>
              </div>
              <script>
              
                 function updateSliderFreq(slideAmount) {
                    var sliderFreq = document.getElementById("demo");
                    sliderFreq.innerHTML = slideAmount;
                }
              </script>
              <fieldset class="form-group radioField">
                <div class="col">
                 
                  <div class="" align="center" >
                    <div class="custom-control custom-radio custom-control-inline">
                       <label style="text-align: left; padding-right:50px; font-weight: 600;font-size: 17px;">Wave Type</label>
                      <input type="radio" id="customRadioInline1" name="wave" value="sine" checked onclick="myPlayer.setWaveType(this.value);" class="custom-control-input">
                      <label class="custom-control-label" for="customRadioInline1">sine</label>
                    </div>
                    <div class="custom-control custom-radio custom-control-inline">
                      <input type="radio" id="customRadioInline2" name="wave" value="square" onclick="myPlayer.setWaveType(this.value);" class="custom-control-input">
                      <label class="custom-control-label" for="customRadioInline2">square</label>
                    </div>
                     <div class="custom-control custom-radio custom-control-inline">
                      <input type="radio" id="customRadioInline3" name="wave" value="sawtooth" onclick="myPlayer.setWaveType(this.value);" class="custom-control-input">
                      <label class="custom-control-label" for="customRadioInline3">sawtooth</label>
                    </div>
                    <div class="custom-control custom-radio custom-control-inline">
                      <input type="radio" id="customRadioInline4" name="wave"  value="triangle" onclick="myPlayer.setWaveType(this.value);" class="custom-control-input">
                      <label class="custom-control-label" for="customRadioInline4">triangle</label>
                    </div>
                    
                  </div>
                </div>
              </fieldset>
              <div id="analyser"></div>

              <script type="text/javascript" src="bootstrap-4.1/js/soundplayersource.js"></script>
              <script>

                  const checkRadio = (field) => {
                      if ((typeof field.length == "undefined") && (field.type == "radio")) {
                          if (field.checked)
                              return field.value;
                      } else {
                          for (let i = 0; i < field.length; i++) {
                              if (field[i].checked)
                                  return field[i].value;
                          }
                      }
                      return false;
                  };

                  var AudioContext = window.AudioContext || window.webkitAudioContext;
                  var audioFirst = new (window.AudioContext || window.webkitAudioContext)();

                  var analyser = audioFirst.createAnalyser();


                  let analyserDisplay = document.getElementById("analyser");
                  let myPlayer;
                  
                  if (analyser.getFloatTimeDomainData) {
                      analyser.fftSize = 1024;
                      analyser.connect(audioFirst.destination);
                      myPlayer = new SoundPlayer(audioFirst, analyser);
                     
                      for (let i = 0; i < analyser.fftSize; i++) {
                          analyserDisplay.appendChild(document.createElement("DIV"));
                      }
                      let dataArray = new Float32Array(analyser.fftSize);
                      setInterval(function() {
                          analyser.getFloatTimeDomainData(dataArray);
                          for (let i = 0; i < dataArray.length; i++) {
                              analyserDisplay.children[i].style.height = (50 + (20 * dataArray[i])) + "px";
                          }
                      }, 500);
                  } else {
                      // getFloatTimeDomainData not supported
                      myPlayer = new SoundPlayer(audioFirst);
                      analyserDisplay.style.display = "none";
                  }

                </script>
              
              <div class="butonFrekansListe">
                  <ul style="list-style-type: none;text-align: center; padding-left: 0;">
                   <li><button type="submit" name="play" class="btn btn-primary" onclick="myPlayer.play(form.freq.value, form.vol.value/100, checkRadio(form.wave));
                          this.style.display = 'none';
                          form.stop.style.display = 'inline';
                        " value="Play &#9658;"><a href="#onay">Play</a></button>
                        <button type="submit" name="stop" style="display: none;" class="btn btn-primary" onclick="
                          myPlayer.stop();
                          form.play.style = 'inline';
                          this.style.display = 'none';
                        " value="Stop &#10073;&#10073;"><a href="#onay">Stop &#10073;</a></button></li>
                    </ul>   
                  <p style="color:black!important;">İnsan kulağı 20 - 20000 Hertz arasındaki sesleri duyabilir.</p>
                  
              
                </div>
            </fieldset>
          </form>
          
        </div>

        <div class="col cellHeight1" style="width: 25%; float: left; text-align: center">
          <form>
             <fieldset>
              <legend class="mysqlLegend">Ses / Video</legend>
                <div class="butonListe">
                  <ul style="list-style-type: none; padding-left: 0;">
                    <li><button type="submit" class="btn btn-primary"><a href="ekle.php">Ekle</a></button></li>
                    <li><button type="submit" class="btn btn-primary"><a href="edit.php">Güncelle</a></button></li>
                    <li><button type="submit" class="btn btn-primary"><a href="clear.php">Sil</a></button></li>
                </ul>
                </div>
                

            </fieldset>    
          </form>
        </div>
        <div class="clearfix"></div>
        <!-------------------------------------------------------------->
        <div>
          
          <div class="container sameHeight" style="margin-bottom: 100px; ">
  <!-- Content here -->
      <div class="col cellHeight cellHeight3" style="float: left; width: 75% !important;">
          <form id="indexForm" method="GET" class="barForm" action="#gidilenNokta" enctype="multipart/form-data">
            <fieldset>
              <legend class="kontrolLegend">Müzik - Fast Fourier Transform</legend>
              <h6 style="text-align: center">Müzik seçmek için seç butonuna tıklamalısınız.</h6>
              <p style="padding-top: 10px;text-align: center">Ses şiddeti, ses dalgalarının genliğini etkiler. Yüksek volume dalganın genliğini büyütür. </p>
              <p style="padding-bottom: 10px;text-align: center">Hız frekansla doğru orantılıdır. <b>V = f x λ </b>formulü hız ve frekans hakkında bir fikir sunar. </p>
             <div class="form-check">
               <label for="customRange3" style=" font-weight: 600;font-size: 17px;" id="gidilenNokta">Volume</label>
               <input type="range" class="slider" name="form2vol" min="0" max="100" step="1" value ="30" onchange="" id="form2myVolume" oninput="">
                <p>Value: <span style="color:black;" id="form2demo1">0</span></p>
              </div>
              <script>
                form2myVolume.onchange = function(e) {
                    var elm = e.target;
                    
                     var source = elm.value;
                     audio.volume = parseFloat(source)/100;
                     var sliderVol = document.getElementById("form2demo1");
                     sliderVol.innerHTML = parseFloat(source);
                      };
              </script>
              <div class="form-check">
               <label for="customRange3" style=" font-weight: 600;font-size: 17px;">Hız</label>
               <input type="range" class="slider" name="hizRange" min="0.1" max="6" value ="1" step="0.1" onchange="" id="hizRange" oninput="myFunctionHiz(this.value)">
               <p>Value: <span id="demoForm2">0</span></p>
              </div>
              <script>

              document.addEventListener("oninput", myFunctionHiz);

              function myFunctionHiz(e) {
                audioFreq = event.target.value;
                var sliderHiz = document.getElementById("demoForm2");
                sliderHiz.innerHTML = parseFloat(audioFreq);
              }
                   
                  
              </script>
             
              <div id="analyserform"></div>
              <p>FFT boyutumuz 512 olduğu için yarısı kadar 256 indexe frekans değeri veriliyor. FFT boyutu 64 de alabilİrdik, bu sefer 32 indis ile değerleri alacaktık.
              <p style="font-weight: 600;">Frekans Value: <br><span style="font-weight: 400;color:black; font-size: 14px;" id="getfreqvalue"><br>0</span></p>

               <div class="clearfix"></div>
             <div>
           
             <div id="mp3_player">
            <div id="audio_box"></div>
            <canvas id="analyser_render"></canvas>
            </div>
          <div class="clearfix"></div>
              
              <div class="butonFrekansListe" id="butonFrekansListe">
                  <ul style="list-style-type: none;text-align: center;margin-left: 25%">
                    <?php
                    include_once("sql/Database.php");
                    include "classes/Pages.php";
                   
                    $page = new Pages();
                    
                    if (isset($_GET['sec']) ) { 
                    
                    ?>
                    <form method="GET" action="#gidilenNokta">
                    <div class="form-group seciliForm">
                    <label class="control-label col-md-3 col-sm-2 col-xs-12" style="margin-right: 83%" for="first-name">Ses Listesi<span class="required">*</span>
                    </label>
                    <div class="col-md-9 col-sm-9 col-xs-12">
                    
                      <select id="select" name="sesSelect" required="required" class="form-control col-md-7 col-xs-12">
                        <option>Ses Kaydı Seçiniz</option>  
                        <?php  
                           
                              $getName = $page->getAllTable("tbl_sesfrekans");
                                 if ($getName) {
                                  while ($result = $getName->fetch_assoc()) {
                            

                             echo '<option value="'.$result['ad'].'">'. $result['sesad'].'</option>';
                            
                                
                                }  } 
                            ?>
                          </select>
                            <a href="#sec" style="padding-right: 7px;">
                             
                              <input type="submit"style="border-color:#55595a; background-color: #fff !important; opacity:.7; font-weight: 400 !important; border-width: 1px; border-radius: 5px!important;height: 30px;" value="Tamam" name="onay_"></a>
                    </div>
                  </div>
                  </form>
                  <?php

                 
                  ?><li class="duzen"><button type="submit" id="sec" name="sec" class="btn btn-primary"><a href="#ok">Seç</a></button></li>

                  <?php
                  
                    }
                    else
                    {
                    
                    ?>
                    <li class="duzen"><button type="submit" name="sec" id="sec" class="btn btn-primary"><a href="#ok">Seç</a></button></li>
                    <?php
                    
                  }
                  
                ?>
                <?php

                  $ad="";

                if($_SERVER['REQUEST_METHOD'] == 'GET' && isset($_GET['onay_'])){

                 $ad = $_GET['sesSelect'];

                 ?>
                  <script type="text/javascript">
                   
                      $(document).ready(function(){

                      $(".seciliForm").hide();
    
                      return false;
                    });
                    </script>
                 <?php
                 
                  }
                  
                  ?>

              
                  <li class="duzen"><button type="submit" name="play1" onclick="" class="playButton1 btn btn-primary" id="playClick" class="">Play</button>
                    
                  </li>
            
                     
                  <li class="duzen"><button type="submit" name="" id="stopAudio" onclick="" class="stopButton1 btn btn-primary">Stop &#10073;</button></li>
                </ul>
                </div>
                
                
            </fieldset>
          </form>
          <script type="text/javascript" src="bootstrap-4.1/js/soundplayersource.js"></script>
          <script>
            
                var canvas2, ctx2, analyser2, fbc_array, bars, bar_x, bar_width, bar_height;
                var source;
               var filter;

                     analyser2=null;
                     source =null;
                     _analyser=null;
                var audioFreq = 1.0;
                
               // window.webkitAudioContext = window.AudioContext || window.webkitAudioContext;
                _context = new (window.AudioContext || window.webkitAudioContext)();

                var audio = new Audio();
                audio.src= '<?php echo $ad;?>'; 
                //audio.src='ses-video/6f66a65cb2.mp3'
                audio.crossOrigin = 'anonymous';
                audio.loop = true;
                audio.controls = false;
                audio.volume = 50/100;
                audio.playbackRate = audioFreq;
                document.body.appendChild(audio);

                
                source = _context.createMediaElementSource(audio);
                var _analyser = _context.createAnalyser();
                
                source.connect(_analyser);
                source.connect(_context.destination);
               
               
                let analyserDisplay_ = document.getElementById("analyserform");
                    
                   if (_analyser.getFloatTimeDomainData) {
                      _analyser.fftSize = 128;
                      _analyser.connect(_context.destination);
                      source.connect(_context.destination);
                    //Alltaki iki satır grafikle ilgili değil frekans değerlerini yazdırmak için//
                     var bufferLength = _analyser.frequencyBinCount;
                     var frequencyData = new Uint8Array(bufferLength);
                    ////////////////////////////////////////
                    for (let i = 0; i < _analyser.fftSize; i++) {
                          analyserDisplay_.appendChild(document.createElement("DIV"));
                      }

                      let _dataArray = new Float32Array(_analyser.fftSize);
                      setInterval(function() {
                          _analyser.getFloatTimeDomainData(_dataArray);
                          for (let i = 0; i < _dataArray.length; i++) {
                              analyserDisplay_.children[i].style.height = (50 + (30 * _dataArray[i])) + "px";
                          }
                          _analyser.getByteFrequencyData(frequencyData);
                          console.log("Frekans Değerleri : "+ frequencyData);
                          var sliderVol = document.getElementById("getfreqvalue");
                        sliderVol.innerHTML = frequencyData;
                        }, 500);
                  
                   
                  } else {
                     
                      analyserDisplay_.style.display = "none";
                  }
                 
                
                  // Initialize the MP3 player after the page loads all of its HTML into the window
                window.addEventListener("load", initMp3Player, false);
                function initMp3Player(){
                  document.getElementById('audio_box').appendChild(audio);
                  analyser2 = _context.createAnalyser(); // AnalyserNode method
                  canvas2 = document.getElementById('analyser_render');
                  ctx2 = canvas2.getContext('2d'); 
                  // Re-route audio playback into the processing graph of the AudioContext
                  //source2 = _context.createMediaElementSource(audio); 
                  source.connect(analyser2);
                  analyser2.fftSize = 1024;
                  analyser2.connect(_context.destination);
                  source.connect(_context.destination);
                  frameLooper();
                }
                // frameLooper() animates any style of graphics you wish to the audio frequency
                // Looping at the default frame rate that the browser provides(approx. 60 FPS)
                function frameLooper(){
                  window.webkitRequestAnimationFrame(frameLooper);
                  fbc_array = new Uint8Array(analyser2.frequencyBinCount);
                  analyser2.getByteFrequencyData(fbc_array);
                  ctx2.clearRect(0, 0, canvas2.width, canvas2.height); // Clear the canvas
                  ctx2.fillStyle = "rgb(167, 81, 92)"// Color of the bars
                  bars = 100;
                  for (var i = 0; i < bars; i++) {
                    bar_x = i * 3;
                    bar_width = 2;
                    bar_height = -(fbc_array[i] / 2);
                    //  fillRect( x, y, width, height ) // Explanation of the parameters below
                    ctx2.fillRect(bar_x, canvas2.height, bar_width, bar_height);
                   // console.log('Frekans : ' + fbc_array);
                  }

                }

                    audio.addEventListener('timeupdate', function(){
                        if(!isNaN(audio.currentTime)) {
                            audio.playbackRate = audioFreq;
                        }
                    });
                playClick.onclick = function(e) {
                    e.preventDefault();
                    var elm = e.target;
                    if(audio) {
                    audio.pause();
                      }
                     audio.load(); //call this to just preload the audio without playing
                     audio.play(); //call this to play the song right away
                    //
                     
                  };
                   stopAudio.onclick = function(e) {
                    e.preventDefault();
                    var elm = e.target;
                     audio.load(); //call this to just preload the audio without playing
                     audio.pause(); //call this to play the song right away
                     audio.currentTime=0;
                     
                  };
                </script>

        </div>

        </div>
        <br>
        <!-------------------------------------------------------------->

        <div class="col " style="float: left; width: 70.5% !important; background-color: #b2b7b83d; margin:2.5%;  margin-right:10%; text-align: center; padding: 10%;">
          <h3>Siren Sesi Frekans İnceleme</h3> <br>
          <h5>0-3 saniye arası</h5>
          <p>
            Siren sesini 2 ayrı osilatör ile oluşturduk. İlk osilatörün başlangıç frekansını 1200 hertz, ikinci osilatörün freakansını ise 1/0.380 hertz olarak düzenledik. Dalga formu sine default olarak belirlendi, alternatif dalga formları ise square, sawtooth ve triangle seçilebilir.
          </p><br>
          <h5>3-12 saniye arası</h5>
          <p>
            Birinci osilatörün frekansını 3. saniyeden 7. saniyeye kadar düzenli olarak 100 hertz yine ikinci osilatörün freksını ise 10 hertz artırdık. Frekanslar 12. saniyeye kadar aynı kaldı.
          </p><br>
          <h5>12-20 saniye arası</h5>
           <p>
            Birinci osilatörün frekansını 12. saniyeden 16. saniyeye kadar düzenli olarak 500 hertz yine ikinci osilatörün freksını ise 20 hertz artırdık. Frekanslar 20. saniyeye kadar aynı kaldı.
          </p><br>
          <h5>20 saniye sonrası</h5>
           <p>
             Birinci osilatörün frekansını 20 saniye sonra 24. saniyeye kadar düzenli olarak 1000 hertz, yine ikinci osilatörün freksını ise 20 hertz azalttık. Frekanslar bu süreden sonra değişmedi.
          </p>
        <div>
          <button class="playGenlikButton"  onclick="play()">Play/Stop</button>
          </div>
          <br>
          <div>
           <div class="" align="left" >
                <div class="custom-control custom-radio custom-control-inline">
                   <label style="text-align: left; padding-right:50px; font-weight: 600;font-size: 17px;">Wave Type</label>
                  <input type="radio" id="customRadioInline5" name="waveform" value="sine" checked onchange="changetype()" class="custom-control-input">
                  <label class="custom-control-label" for="customRadioInline5">sine</label>
                </div>
                <div class="custom-control custom-radio custom-control-inline">
                  <input type="radio" id="customRadioInline6" name="waveform" value="square" onchange="changetype()" class="custom-control-input">
                  <label class="custom-control-label" for="customRadioInline6">square</label>
                </div>
                 <div class="custom-control custom-radio custom-control-inline">
                  <input type="radio" id="customRadioInline7" name="waveform" value="sawtooth" onchange="changetype()" class="custom-control-input">
                  <label class="custom-control-label" for="customRadioInline7">sawtooth</label>
                </div>
                <div class="custom-control custom-radio custom-control-inline">
                  <input type="radio" id="customRadioInline8" name="waveform"  value="triangle" onchange="changetype()" class="custom-control-input">
                  <label class="custom-control-label" for="customRadioInline8">triangle</label>
                </div>
                
              </div>
            </div>
             <!-- <input type="range" class="slider" name="" min="0" max="10000" step="1" value ="" id="freqslider" onchange="changefreq()"> -->
          </div>
          <br>
         
         <script>
          var play,
          changefreq,
          oscillator,
          changetype;

          var oscProp = {
            type:"sine",
            frequency:1200,
            playing:false
          }


             var context = new (window.AudioContext || window.webkitAudioContext)();
             var now = context.currentTime;
             var seconderfreq = 1/0.380;

             window.onload = function(){
              play = function(){
                if(oscProp.playing){
                  oscillator.stop();
                      lfo.stop();
                  oscProp.playing = false;
                }
                else
                {

                  oscillator = context.createOscillator();
                  oscillator.type = oscProp.type;
                  oscillator.frequency.setValueAtTime(oscProp.frequency, now);
                  lfo = context.createOscillator();
                  lfo.type = oscProp.type;
                  lfo.frequency.setValueAtTime(seconderfreq, now);
                  // 3 saniye içinde bir "kontrol noktası" belirleyin - bu rampanın başlangıç noktası olacaktır.
                  oscillator.frequency.setValueAtTime(oscProp.frequency, now+3);
                  lfo.frequency.setValueAtTime(seconderfreq, now+3);
                  // sonraki 4 saniye boyunca bir rampayı frekeans + 100Hz olarak ayarlayın.
                  oscillator.frequency.linearRampToValueAtTime(oscProp.frequency+100,now+7);
                  lfo.frequency.linearRampToValueAtTime(seconderfreq+1/0.1, now+7);

                  oscillator.frequency.setValueAtTime(oscProp.frequency, now+12);
                  lfo.frequency.setValueAtTime(seconderfreq, now+12);
                  oscillator.frequency.linearRampToValueAtTime(oscProp.frequency+500,now+16);
                  lfo.frequency.linearRampToValueAtTime(seconderfreq+1/0.05, now+16);

                  oscillator.frequency.setValueAtTime(oscProp.frequency, now+20);
                  lfo.frequency.setValueAtTime(seconderfreq, now+20);
                  oscillator.frequency.linearRampToValueAtTime(oscProp.frequency-1000, now+24);
                  lfo.frequency.linearRampToValueAtTime(seconderfreq-1/0.05 , now+24);

                  lfoGain = context.createGain();
                  lfoGain.gain.value = 450;

                  lfo.connect(lfoGain);
                  lfoGain.connect(oscillator.frequency);

                  oscillator.connect(context.destination);
                  oscillator.start();
                      lfo.start(); 
                  oscProp.playing = true;

                }
              } 

              changefreq = function(){
                oscProp.frequency = document.getElementById("freqslider").value * 50;
                play();
                play();
              }
              changetype = function(){
                oscProp.type = document.querySelector("input[name = 'waveform']:checked").value;
                play();
              }
          }
          </script>
        </div>
          <!-------------------------------------------------------------->     
        <div class="clearfix"></div>
        <div class="col anime1" style="width: 50%; float: left; text-align: center; margin-top: 3%;">
          <br>
          <br>
          <br>
          <h3 style="text-align: center;">Sinüs Dalga - Kare Dalga</h3>
          <br>
          <canvas id="canvasfft" width="520" height="305"></canvas>
          
            <script>
            //let canvas = document.querySelector('canvas')
           var canvasfft = document.getElementById('canvasfft');
           let ctx = canvasfft.getContext('2d')
           let originX = 110
           let originY = canvasfft.height/2
           let a=1;
           let t = 0;
           let wave = []

           function draw()
           {
            //console.log(wave.length)
            //cleaning wave
            if(wave.length > 500)
            {
              wave.pop()
            }
            ctx.fillStyle = 'rgb(49, 52, 53)'
            let x = originX
            let y = originY
            let lastX = originX
            let lastY = originY
            ctx.fillRect(0, 0, canvasfft.width, canvasfft.height);
            let r = 80
            for(let i=0; i<a; i++)
            {
              let n = (i*2)+1
              let radius = r * (2/(n*Math.PI))
              x +=radius*Math.cos(n*t)
              y +=radius*Math.sin(n*t)
              //drawing lines
              ctx.beginPath()
              ctx.strokeStyle =  'rgb(167, 81, 92)'
              ctx.lineJoin = 'round'
              ctx.lineCap = 'round'
              ctx.fillStyle =  'rgb(167, 81, 92)'
              ctx.moveTo(lastX, lastY)
              ctx.lineTo(x,y)
              ctx.stroke()
              //drawing circles
              ctx.beginPath()
              ctx.strokeStyle =  'rgb(167, 81, 92)'
              ctx.arc(lastX, lastY, radius, 0, 2*Math.PI)
              ctx.stroke()

              //drawing dots at the ends of line
              ctx.beginPath()
              ctx.fillStyle =  'rgba(167, 81, 92, 0.3)'
              //ctx.arc(x, y, radius, 7,0, 2*Math.PI)
              ctx.stroke()
              lastX = x
              lastY = y

            }
            wave.unshift(y)
            //drawing line from circler to wave
            ctx.beginPath()
            ctx.strokeStyle = 'rgb(167, 81, 92)'
            ctx.lineJoin = 'round'
            ctx.lineCap = 'round'
            ctx.fillStyle = 'rgb(167, 81, 92)'
            ctx.moveTo(x, y)
            ctx.lineTo(300, wave[0])
            ctx.stroke();

            //drawing wave
            ctx.beginPath()
            ctx.strokeStyle = 'rgb(167, 81, 92)'
            ctx.lineJoin = 'round'
            ctx.lineCap = 'round'
            ctx.fillStyle = 'rgb(167, 81, 92)'
            ctx.moveTo(200, wave[0])
           
            for(let i=0; i<wave.length; i++)
            {
              ctx.lineTo(300+i, wave[i])
            }
            ctx.stroke()
            t -= 0.05 // ters yönde hare
           }
           setInterval(()=>draw(), 21)

          document.addEventListener("oninput", myFunctionsin);

          function myFunctionsin(e) {
            a = event.target.value;
            var sliderType = document.getElementById("demoSinuscanva");
            sliderType.innerHTML = parseFloat(a);
          }
    
        </script>
        <br> <br>
        <div class="form-check">      
        <label for="customRange3" style=" font-weight: 600;font-size: 17px;">Sin wave - Square wave</label>
         <input type="range" class="slider" name="form2vol" min="1" max="20" step="1" value ="" onchange="" id="sliderfft" oninput="myFunctionsin(this.value)">
          <p>Tepe Sayıs: <span style="color:black;" id="demoSinuscanva">0</span></p>

       </div>
    
       <div style="margin-top: 100px; padding:30px; padding-left: 0; margin-left: 0;">
       <ul style="list-style-type: none;text-decoration: none;font-size: 10px; text-align: left;">
          <h6>Teşekkürler</h6>
        <li><a href=" https://www.the-art-of-web.com/javascript/creating-sounds/" class="thanks" >https://www.the-art-of-web.com/javascript/creating-sounds/</a></li>
        <li><a href="https://gist.github.com/gkhays/e264009c0832c73d5345847e673a64ab?fbclid=IwAR3Y4vsHyWBiWPDLxVroxkRmBpPFauCJT0okNhJhjDfwcIBlbEo1jtQlmHM" class="thanks">https://gist.github.com/gkhays/e264009c0832c73d5345847e673a64ab?fbclid=IwAR3Y4vsHyWBiWPDLxVroxkRmBpPFauCJT0okNhJhjDfwcIBlbEo1jtQlmHM</a></li>
        <li><a href="http://www.developphp.com/video/JavaScript/Analyser-Bars-Animation-HTML-Audio-API-Tutorial" class="thanks">http://www.developphp.com/video/JavaScript/Analyser-Bars-Animation-HTML-Audio-API-Tutorial</a></li>
        <li><a href="https://stackoverflow.com/" class="thanks">https://stackoverflow.com/</a></li>
        
      </ul>
    </div>

       </div>
    
    <div class="col anime2" style="width: 50%; float: right; text-align: center;margin-top: 3%; vertical-align: middle; align-items: center;">
     <br>
     <br>
     <br>

    <h3 style="text-align: center;">Salınımlı Sinüs Dalgası</h3>
    <br>
    <div style="background-color:  rgb(49, 52, 53); float: right;">
      <canvas id="canvas1" width="500" height="300"></canvas>
    
     <script type="text/javascript">
      var genlik = 50;
      var frequencyCn = 20;
        function display(ctex,disp) {
            var width = ctex.canvas.width;
            var height = ctex.canvas.height;
            var xMin = 0;
            
            ctex.beginPath();
            ctex.strokeStyle = "rgb(128,128,128)";
            
            // X-Axis
            ctex.moveTo(xMin, height/2);
            ctex.lineTo(width, height/2);
            
            // Y-Axis
            ctex.moveTo(width/2, 0);
            ctex.lineTo(width/2, height);

            // Starting line
            ctex.moveTo(0, 0);
            ctex.lineTo(0, height);
            
            ctex.stroke();
        }
        function displayCoor(ctex, y) {            
            var radius = 3;
            ctex.beginPath();

            // Hold x constant at 4 so the point only moves up and down.
            ctex.arc(4, y, radius, 0, 2 * Math.PI, false);

            ctex.fillStyle = 'rgba(167, 81, 92, 0.3)';
            ctex.fill();
            ctex.lineWidth = 1;
            ctex.stroke();
        }
        function sineWave(ctex, xOffset, yOffset) {
            var width = ctex.canvas.width;
            var height = ctex.canvas.height;
            var scale = 20;

            ctex.beginPath();
            ctex.lineWidth = 2;
            ctex.strokeStyle = 'rgb(167, 81, 92)';

            
            var x = 4;
            var y = 0;
            
            //ctex.moveTo(x, y);
            ctex.moveTo(x, 50);
            while (x < width) {
                y = height/2 + genlik * Math.sin((x+xOffset)/frequencyCn);
                ctex.lineTo(x, y);
                x++;
                // console.log("x="+x+" y="+y);
            }
            ctex.stroke();
            ctex.save();

            //console.log("Drawing point at y=" + y);
            displayCoor(ctex, y);
            ctex.stroke();
            ctex.restore();
        }
        function drawing() {
            var canvas1 = document.getElementById("canvas1");
            var cntxt = canvas1.getContext("2d");
            
          
            cntxt.fillRect(0, 0, canvas1.width, canvas1.height);
            cntxt.clearRect(0, 0, 500, 500);
            display(cntxt);
            cntxt.save();     
            sineWave(cntxt, step, 50);
            cntxt.restore();
            
            step += 4;
            window.requestAnimationFrame(drawing);
        }
        window.addEventListener("load", init, false);
        function init() {
            window.requestAnimationFrame(drawing);
        
        }
        var step = -4;

          isPlayingen = false
          var  contextn = new (window.AudioContext || window.webkitAudioContext)();
          var audion = new Audio();
                audion.src='ses-video/99a1c1601c.mp3'
                audion.crossOrigin = 'anonymous';
                audion.loop = true;
                audion.controls = false;
                audion.volume = 20/100;
              
                
         document.addEventListener("onclick",playgenlikClick); 
         function playgenlikClick() 
         {
         if(audio) {
           audion.pause();
             }
         isPlayingen = true;
         audion.load(); 
         audion.play(); 
         };
         document.addEventListener("onclick",stopgenlikClick); 
         function stopgenlikClick() 
         {
         isPlayingen = false;
         audion.pause(); 
         audion.currentTime=0;
        };

        document.addEventListener("onclick",togglegenlikstop); 
        function togglegenlikstop() {
        isPlayingen ? stopgenlikClick() : playgenlikClick();
        //isPlaying = !isPlaying;
   };
    </script>
  </div>
 <div class="clearfix"></div>
 <br>
       <div class="form-check">
         <label for="customRange3" style=" font-weight: 600;font-size: 17px;">Frekans</label>
         <input type="range" class="slider" name="form2vol" min="0" max="100" step="1" value ="" onchange="" id="myfreqCanva" oninput="">
          <p>Frekans Value:  <span style="color:black;" id="demofreqCanva">0</span></p>
        </div>
       <div class="form-check">      
        <label for="customRange3" style=" font-weight: 600;font-size: 17px;">Genlik/Volume</label>
         <input type="range" class="slider" name="form2vol" min="0" max="100" step="1" value ="" onchange="" id="mygenlikCanva" oninput="">
         <p>Genlik Value:  <span style="color:black;" id="demogenCanva">0</span></p>
         <p>Genliği, müziğin ses şiddeti ile değiştirebilirsiniz.</p>
         
          <button class="playGenlikButton" style="" onclick="togglegenlikstop();">Play/Stop</button>
       </div>


              <script>
               
                mygenlikCanva.onchange = function (e) {
                     
                      audion.volume=e.target.value/100;
                      genlik = audion.volume*100;
                      source = genlik;
                      var slidergen = document.getElementById("demogenCanva");
                      slidergen.innerHTML = parseInt(genlik);
                      console.log("Genlik" + genlik);
                }
         
            
                 myfreqCanva.onchange = function(e) { 
                     var elm = e.target;
                     var source = parseInt(elm.value);
                     var periot = parseFloat(source);//-100 min, 1 max, step 1
                     frequencyCn = parseInt(101-periot);
                     var sliderFreq = document.getElementById("demofreqCanva");
                     sliderFreq.innerHTML = periot;
                    
                     console.log("Frekans" + periot);
                   
                     /*frequencyCn = parseInt(source);//-100 min, 1 max, step 1
                     var sliderFreq = document.getElementById("demofreqCanva");
                     sliderFreq.innerHTML = parseInt((200-(-1*frequencyCn)));
                    
                     console.log("Frekans" + parseInt((200-(-1*frequencyCn))));
                    */
                     
                 };
         

       
              </script>


            </div>


        <!--------------------------------------------------------------->
     
      
        
        



       </div>  
     
     </div>


    
    <div class="clearfix"></div>
    <footer style="width: 100%; height: 200px; margin-top: 200px; background-image: url('image/iste.png');">
      <div class="container-fluid" >
         <div class= "footerDiv">
         Copyright © 2020 İSTE. Tüm Hakları Saklıdır & by Nuray Çelik
        </div>
      </div>  
    </footer>

    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>
    <script type="text/javascript" src="bootstrap-4.1/js/soundplayersource.js"></script>
   
  </body>
</html>