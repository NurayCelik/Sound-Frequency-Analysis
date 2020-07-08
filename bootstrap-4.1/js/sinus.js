
        let canvas = document.querySelector('canvas')
         //var canvas = document.getElementById('canvas');
         let ctx = canvas.getContext('2d')
         let originX = 150
         let originY = canvas.height/2
         let a = 1// dönen uç daki köşe sayısıdır. a= 1000 olursa kare dalga oluşur.
         let t = 0
         let wave = []

         function draw()
         {
          //console.log(wave.length)
          //cleaning wave
          if(wave.length > 300)
          {
            wave.pop()
          }
          ctx.fillStyle = 'black'
          let x = originX
          let y = originY
          let lastX = originX
          let lastY = originY
          ctx.fillRect(0, 0, canvas.width, canvas.height);
          let r = 80
          for(let i=0; i<a; i++)
          {
            let n = (i*2)+1
            let radius = r * (4/(n*Math.PI))
            x +=radius*Math.cos(n*t)
            y +=radius*Math.sin(n*t)
            //drawing lines
            ctx.beginPath()
            ctx.strokeStyle = 'white'
            ctx.lineJoin = 'round'
            ctx.lineCap = 'round'
            ctx.fillStyle ='white'
            ctx.moveTo(lastX, lastY)
            ctx.lineTo(x,y)
            ctx.stroke()
            //drawing circles
            ctx.beginPath()
            ctx.strokeStyle = 'rgba(255, 255, 255, 0.3)'
            ctx.arc(lastX, lastY, radius, 0, 2*Math.PI)
            ctx.stroke()

            //drawing dots at the ends of line
            ctx.beginPath()
            ctx.fillStyle = 'rgba(255, 255, 255, 0.7)'
            ctx.arc(x, y, radius, 3,0, 2*Math.PI)
            ctx.stroke()
            lastX = x
            lastY = y
          }
          wave.unshift(y)
          //drawing line from circler to wave
          ctx.beginPath()
          ctx.strokeStyle = 'white'
          ctx.lineJoin = 'round'
          ctx.lineCap = 'round'
          ctx.fillStyle ='white'
          ctx.moveTo(x, y)
          ctx.lineTo(300, wave[0])
          ctx.stroke();

          //drawing wave
          ctx.beginPath()
          ctx.strokeStyle = 'white'
          ctx.lineJoin = 'round'
          ctx.lineCap = 'round'
          ctx.fillStyle ='white'
          ctx.moveTo(300, wave[0])
         
          for(let i=0; i<wave.length; i++)
          {
            ctx.lineTo(400+i, wave[i])
          }
          ctx.stroke()
          t -= 0.02 // ters yönde hare
         }
         setInterval(()=>draw(), 21)
          