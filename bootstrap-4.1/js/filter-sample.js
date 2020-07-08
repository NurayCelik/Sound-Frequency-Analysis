//https://www.html5rocks.com/en/tutorials/webaudio/intro/
/*var FilterSample = {
  FREQ_MUL: 7000,
  QUAL_MUL: 30,
  playing: false
};*/
function FilterSample(audioContext,filterNode){
  this.FREQ_MUL: 7000;
  this.QUAL_MUL: 30;
  this.playing: false;
  this.context=audioContext;
  this.gainNode=this.context.createGain();
  if(filterNode){this.gainNode.connect(filterNode);
  }else{this.gainNode.connect(this.context.destination);
  }
  this.oscillator=null;}
FilterSample.prototype.play = function() {
  // Create the source.
  var source = context.createBufferSource();
  source.buffer = BUFFERS.techno;
  // Create the filter.
  var filter = context.createBiquadFilter();
  //filter.type is defined as string type in the latest API. But this is defined as number type in old API.
  filter.type = (typeof filter.type === 'string') ? 'lowpass' : 0; // LOWPASS
  filter.frequency.value = 5000;
  // Connect source to filter, filter to destination.
  source.connect(filter);
  filter.connect(context.destination);
  // Play!
  if (!source.start)
    source.start = source.noteOn;
  source.start(0);
  source.loop = true;
  // Save source and filterNode for later access.
  this.source = source;
  this.filter = filter;
};

FilterSample.prototype.stop = function() {
  if (!this.source.stop)
  this.source.stop = source.noteOff;
  this.source.stop(0);
  this.source.noteOff(0);
};

FilterSample.prototype.toggle = function() {
  this.playing ? this.stop() : this.play();
  this.playing = !this.playing;
};

FilterSample.prototype.changeFrequency = function(element) {
  // Clamp the frequency between the minimum value (40 Hz) and half of the
  // sampling rate.
  var minValue = 40;
  var maxValue = context.sampleRate / 2;
  // Logarithm (base 2) to compute how many octaves fall in the range.
  var numberOfOctaves = Math.log(maxValue / minValue) / Math.LN2;
  // Compute a multiplier from 0 to 1 based on an exponential scale.
  var multiplier = Math.pow(2, numberOfOctaves * (element.value - 1.0));
  // Get back to the frequency value between min and max.
  this.filter.frequency.value = maxValue * multiplier;
};

FilterSample.prototype.changeQuality = function(element) {
  this.filter.Q.value = element.value * this.QUAL_MUL;
};

FilterSample.prototype.toggleFilter = function(element) {
  this.source.disconnect(0);
  this.filter.disconnect(0);
  // Check if we want to enable the filter.
  if (element.checked) {
    // Connect through the filter.
    this.source.connect(this.filter);
    this.filter.connect(context.destination);
  } else {
    // Otherwise, connect directly.
    this.source.connect(context.destination);
  }
};
FilterSample.prototype.setVolume=function(val,when){
  if(when){this.gainNode.gain.exponentialRampToValueAtTime(val,this.context.currentTime+when);
  }
  else{
    this.gainNode.gain.setValueAtTime(val,this.context.currentTime);
  }
  return this;};
FilterSample.prototype.stop=function(when){
  if(when){this.gainNode.gain.setTargetAtTime(1/1000,this.context.currentTime+when-0.05,0.02);
    this.oscillator.stop(this.context.currentTime+when);}
    else{this.gainNode.gain.setTargetAtTime(1/1000,this.context.currentTime,0.02);
      this.oscillator.stop(this.context.currentTime+0.05);}
      return this;};