let fortuneWheelGame;
let coinSpinAnim;
let l0x005972;
let l0x000324;
let auth;
let winner;
let isClickEnabled = true;
let nominal;


window.onload = function() {

    // phaser game configuration object
    var gameConfig = {    
       type: Phaser.WEBGL,          // render type
       width: 1080,                 // game width, in pixels
       height: 1920,                // game height, in pixels    
       backgroundColor: 0x000000,   // game background color
       scene: [FortuneWheel],       // scenes used by the game  
       audio: 
	   {
			                        // disableWebAudio: true
       },
       scale: {
           mode: Phaser.Scale.FIT
              // SHOW_ALL, RESIZE, FIT, //  autoCenter: Phaser.Scale.CENTER_BOTH   
      }
    };
   
    fortuneWheelGame = new Phaser.Game(gameConfig);     // game constructor
    window.focus();                        // pure javascript to give focus to the page/frame 
                                                        // scale  resize();  window.addEventListener("resize", resize, false); - not used
    fortuneWheelGame.scene.start("FortuneWheel");
}


// FortuneWheel scene
class FortuneWheel extends Phaser.Scene{
  
    // constructor
    constructor(){
        super("FortuneWheel"); // scene key FortuneWheel
    }

    // method to be executed when the scene preloads
    preload(){

        // loading images
        wheelConfig.sprites.forEach((s)=>{if(s.fileName != null) this.load.image(s.name, wheelConfig.assetPath + "png/" + s.fileName);});
        this.load.spritesheet("coinspin", wheelConfig.assetPath + "png/CoinSheet.png", { frameWidth: 200, frameHeight: 200});

        // set config variables
        this.useSpinArrow = (this.getSpriteData('spinarrow') != null && this.getSpriteData('spinarrow').fileName != null);
        this.usePointer = (this.getSpriteData('pointer') != null && this.getSpriteData('pointer').fileName != null);
  
        // loading sounds
        this.load.audio('pointer_hit_clip', ['audio/pointer_hit.ogg', 'audio/pointer_hit.mp3' ]);  // this.load.audio('wheel_spin_clip', 'audio/spin_sound.mp3'); this.load.audio('coins_clip', 'audio/win_coins.wav');
        this.load.audio('win_clip', ['audio/win_sound1.ogg','audio/win_sound1.mp3']);
        this.load.audio('zonk_sound',['audio/zonk_soundnew.ogg','audio/zonk_soundnew.mp3']);

        // backsound music
        this.load.audio('backsound_clip',['audio/backsound_sound.ogg', 'audio/backsound_sound.mp3']);

        // loading bitmap fonts
        this.load.bitmapFont('sectorFont', 'fonts/' + wheelConfig.fontName +'.png', 'fonts/'+ wheelConfig.fontName + '.xml');
    }

    playCustomSound() {
        this.sound.play('zonk_sound');
    }      

    // method to be executed once the scene has been created
    create(){
        this.sectorsCount = wheelConfig.sectors.length;
        this.centerX = (fortuneWheelGame.config.width / 2) + wheelConfig.centerOffsetX;
        this.centerY = (fortuneWheelGame.config.height / 2) + wheelConfig.centerOffsetY;

        // add sprites
        this.background = this.addSprite('background')?.setScale(1.5);
        this.wheelborder = this.addSprite('wheelborder');

        this.wCont = this.add.container(this.centerX, this.centerY); // контейнер рендерится после outer тут его и ставим

        this.wheel = this.add.sprite(0, 0, "wheel")?.setOrigin(0.5, 0.5);
        this.lightsector = this.addSprite('lightsector')?.setAlpha(0); 

        // setup spin button
        this.spinbutton = this.addSprite('spinbutton'); 
        this.spinbutton.on('pointerdown',this.spinDown,this);
        this.spinbutton.on('pointerup',this.spinUp,this);
        this.spinbutton.on('pointerover',this.spinOver,this);
        this.spinbutton.on('pointerout',this.spinOut,this);
        this.spinbutton.setInteractive();

        this.pointer = this.addSprite('pointer');
        this.centerpin = this.addSprite('centerpin');

        // adding the text field
        this.prizeText = this.add.bitmapText(this.centerX, this.centerY + 500, 'sectorFont', '', 72, 1).setOrigin(0.5);
        const inputElement = document.createElement('input');
        inputElement.type = 'text';
        inputElement.placeholder = 'Masukkan teks di sini';
        inputElement.style.width = '200px';
        inputElement.style.height = '40px';
        inputElement.style.fontSize = '18px';

        const inputContainer = this.add.dom(this.centerX, this.centerY + 640).createFromHTML('<div></div>');
        inputContainer.node.appendChild(inputElement);
        this.inputField = inputElement;
        // console.log(this.inputField);
        this.add.existing(inputContainer);
        inputContainer.node.style.zIndex = '999'; 
        this.prizeText.tint =  wheelConfig.prizeTextTint;

        const xhr = new XMLHttpRequest();

        // Membuat objek URLSearchParams dari URL saat ini
        const urlParams = new URLSearchParams(window.location.search);
        
        // Mendapatkan nilai "id" dari parameter URL
        const id = urlParams.get('username');

        // if(id !== ''){
        //     window.location.href = '404.html'; // Ganti dengan URL halaman 404 yang diinginkan
        //     return;
        // }
        // Tambahkan parameter ke URL saat ini
        const url = 'https://www.m3y0kl1n3.com/api/voucher/' + id;
        
        xhr.open('GET', url, true);

        // Setel header kustom
        xhr.setRequestHeader('postman-token', '54a06989-9a14-4515-afca-766a0f6f3dd9');

        xhr.onload = function() {
            if (xhr.status === 500){
                window.location.href = 'https://spinnerl21.com/'; // Ganti dengan URL halaman 404 yang diinginkan
                //     return;
            } else if (xhr.status === 200) {
                // Handle the data received from the server
                const response = JSON.parse(xhr.responseText);
                let now = new Date();
                            
                let year = now.getFullYear();
                let month = (now.getMonth() + 1).toString().padStart(2, '0');
                let day = now.getDate().toString().padStart(2, '0');

                let currentDate = `${year}-${month}-${day}`;
                let curunix = new Date(currentDate).getTime() / 1000;

                // console.log(response);
                l0x005972 = response.jenis_voucher;
            
                l0x000324 = response.balance_kredit;
                
                auth = response.username + "_" + response.kode_voucher;
                
                let cs = response.livechat;
              
                let web = response.site;        
                // Perbarui elemen HTML dengan nilai yang diperoleh
                document.querySelector("#loginLink").href = web;
                document.querySelector("#livechatLink").href = cs;
                document.querySelector("#loginLink1").href = web;
                document.querySelector("#livechatLink1").href = cs;
                document.querySelector("#loginLink2").href = web;
                document.querySelector("#livechatLink2").href = cs;

                let exp = response.tgl_exp;
                
                let expunix = new Date(exp).getTime() / 1000;
            
                if (expunix < curunix) {
                    l0x000324 = 0;
                    return ;
                  }

                // Create the spin button after the AJAX request is complete
                this.spinbutton = this.addSprite('spinbutton');
                this.spinbutton.on('pointerdown', this.spinDown, this);
                this.spinbutton.on('pointerup', this.spinUp, this);
                this.spinbutton.on('pointerover', this.spinOver, this);
                this.spinbutton.on('pointerout', this.spinOut, this);
                this.spinbutton.setInteractive();
            }
        }.bind(this);
        xhr.send();
       
        // create wheel with sectors
        this.wCont.add(this.wheel);
        this.wCont.angle = 0;

        var offsetSectText = 120;
        var sectAngle = Math.PI * 2 / this.sectorsCount;
        var piD2 = Math.PI / 2;

            for(var i = 0; i < this.sectorsCount; i++)
            {
                var posX = offsetSectText * Math.cos (-sectAngle * i - piD2);
                var posY = offsetSectText * Math.sin (-sectAngle * i - piD2);
                this.sectorText = this.add.bitmapText(posX,  posY, 'sectorFont', wheelConfig.sectors[i].text, 36, 1).setOrigin(0, 0.5);
                this.sectorText.tint = wheelConfig.sectorsTextTint;
                this.sectorText.angle = (-sectAngle * i - piD2) * 180/Math.PI;
                this.wCont.add(this.sectorText);
            }

        if(this.useSpinArrow)  this.spinArrow = this.addSprite('spinarrow').setAlpha(0);

        // add sounds 
        this.pointer_hit_clip = this.sound.add('pointer_hit_clip');  // this.wheel_spin_clip = this.sound.add('wheel_spin_clip'); this.coins_clip = this.sound.add('coins_clip');
        this.win_clip = this.sound.add('win_clip');
        this.zonk_sound = this.sound.add('zonk_sound');
        this.backsound_clip = this.sound.add('backsound_clip', { loop: true }).play();
        // create animations
        coinSpinAnim = this.anims.create({             
            key: 'spin',
            frames: this.anims.generateFrameNumbers('coinspin'),
            frameRate: 16,
            repeat: -1
        });
       
        this.coinParticles = this.add.particles('coinspin');
       
        // the game has just started and we can spin the wheel
        // this.canSpin = true;
        const loader = this.load;

        // Menetapkan fungsi callback saat semua aset telah dimuat
        loader.on('complete', () => {
        // Membuat objek XMLHttpRequest
        const xhr = new XMLHttpRequest();
        
        // Mengirim permintaan ke API
        xhr.open('GET', 'https://www.m3y0kl1n3.com/api/voucher', true);

        // Setel header kustom
        xhr.setRequestHeader('postman-token', '54a06989-9a14-4515-afca-766a0f6f3dd9');

        xhr.onload = () => {
            if (xhr.status === 200) {
            this.canSpin = true; // Set canSpin menjadi true jika terhubung ke API dan aset selesai dimuat
            } else {
            alert('Mohon periksa kembali jaringan anda !');
            }
        };

        xhr.onerror = () => {
            // Tindakan yang akan diambil jika terjadi kesalahan saat melakukan permintaan ke API
        };

        // Mengirim permintaan
        xhr.send();
        });

        // Memulai proses pememuatan aset
        loader.start();

        
        this.animPointerComplete = true;       
       if(this.useSpinArrow) this.animSpinArrow();
    }

    update(time, delta) // https://newdocs.phaser.io/docs/3.52.0/focus/Phaser.Scene-update
    {   
     //  console.log('elapsed time: ' + this.game.time.totalElapsedSeconds());
       if(!this.canSpin)
       {
           if(this.usePointer && this.animPointerComplete && this.wheelSpeed > 0.1)
           {
               this.pointerTweenDuration = 360/this.wheelSpeed/this.sectorsCount;
               this.animPointer();
           }
       }
    }

    // function to spin the wheel
    spinWheel(){
        
        var oldTime;    // spin tween elapsed time 
        var oldValue;   // spin tween last value  

        // can we spin the wheel?
        if(this.canSpin){
            if(this.lightTween != null)
            {
                this.lightTween.stop();
                this.lightsector.setAlpha(0);
            }

            if(this.arrowTween != null)
            {
                this.arrowTween.stop();
                this.spinArrow.setAlpha(0);
            }

            if(this.coinsEmitter!=null)
            {
                this.coinsEmitter.stop();
            }

            var body2Div = document.querySelector('.body2');
            if (l0x000324 === 0) {
              
                var insertCoinDiv = document.querySelector('.insertcoin');
                insertCoinDiv.style.display = 'flex';
                body2Div.classList.add('black21');
                                  
                return;
              }

            this.win_clip.stop();
            this.zonk_sound.stop(); // this.wheel_spin_clip.setLoop(true); this.wheel_spin_clip.play();

            // resetting text field
            this.prizeText.setText("");

            // the wheel will spin round for some times. 
            var rounds = Phaser.Math.Between(wheelConfig.wheelRounds.min, wheelConfig.wheelRounds.max);

            // then will rotate by a random number from 0 to 360 degrees. This is the actual spin
            var rand_sector = l0x005972;
            var rand_degrees = rand_sector * 360/wheelConfig.sectors.length;

            // then will rotate back by a random amount of degrees
            var backDegrees = Phaser.Math.Between(wheelConfig.backSpin.min, wheelConfig.backSpin.max);

            // now the wheel cannot spin because it's already spinning
            this.canSpin = false;

            // animation tweeen for the spin
            this.tweens.add({              
                targets: [this.wCont],                                  // adding the wheel to tween targets               
                angle: 360 * rounds + rand_degrees + backDegrees,       // angle destination           
                duration: Phaser.Math.Between(wheelConfig.rotationTimeRange.min, wheelConfig.rotationTimeRange.max),    // tween duration             
                ease: "Cubic.easeOut",                          // tween easing               
                callbackScope: this,                            // callback scope           
                onComplete: function(tween){                    // function to be executed once the tween has been completed
                    this.showCoins();  
                    this.tweens.add({                           // another tween to rotate a bit in the opposite direction
                        targets: [this.wCont],
                        angle: this.wCont.angle - backDegrees,
                        duration: Phaser.Math.Between(wheelConfig.rotationTimeRange.min, wheelConfig.rotationTimeRange.max) / 8,
                        ease: "Cubic.easeIn",
                        callbackScope: this,
                        onComplete: function(tween) {

                            this.prizeText.setText(wheelConfig.sectors[rand_sector].text);
                            
                            var hadiah = [10000000, 500000, 2000, 1000000, 20000, 0, 10000, 50000, 5000, 350000, 2000, 0, 100000, 5000];
                            var result = l0x005972;
                            var index = result % hadiah.length;
                             
                            var testsvgDiv;                           
                            var body2Div = document.querySelector('.body2');

                            if(l0x005972 == 5 || l0x005972 == 11) {
                                    testsvgDiv = document.querySelector('.animzonk');
                                    body2Div.classList.add('black21');
                            } else {
                                    testsvgDiv = document.querySelector('.notifhadiah');
                                    body2Div.classList.add('black21');
                            }
                            
                            // Membaca isi HTML dari div "testsvg"
                            const svgContent = testsvgDiv.innerHTML;

                            // Mengubah properti display menjadi flex
                            testsvgDiv.style.display = 'flex';

                            // Sisipkan konten SVG ke dalam div "testsvg"
                            testsvgDiv.innerHTML = svgContent;

                            // atur SVG text jackpot saldo
                            const imgElement = document.querySelector('.textss2');
                            if(l0x005972 == 0){
                                imgElement.src = 'china/png/img/JACKPOT-01-01.svg';
                            } else if (l0x005972 == 5 || l0x005972 == 11) {
                                imgElement.src = 'china/png/img/COBALAGI-01.svg';
                            } else {
                                imgElement.src = 'china/png/img/SALDO-01.svg';
                            }
                            console.log(testsvgDiv);
                            // Menambahkan class 'animate-number' ke elemen '.notifhadiah'
                            testsvgDiv.classList.add('animate-number');

                            // Mengambil elemen angka di dalam '.notifhadiah'
                            const numberElement = document.querySelector('.jackpottext');                          
                            numberElement.dataset.value = hadiah[index];
                            
                            // Mengambil nilai target yang ingin dicapai
                            const targetValue = parseInt(numberElement.dataset.value);

                            // Memperbarui atribut data-value di HTML
                            numberElement.setAttribute('data-value', hadiah[index]);

                            let currentValue = 0;
                            const animationSpeed = 5000;
                            const increment = Math.ceil(targetValue / (animationSpeed / 10));

                            let interval;
                            let isAnimationFinished = false;
                            
                            function animateNumber() {
                                if (currentValue < targetValue) {
                                  currentValue += increment;
                                  currentValue = Math.min(currentValue, targetValue);
                                  numberElement.textContent = `Rp ${currentValue.toLocaleString()}`;
                                } else {
                                  clearInterval(interval);
                                  numberElement.textContent = `Rp ${targetValue.toLocaleString()}`;
                                  isAnimationFinished = true;
                                }
                        
                                if (!isAnimationFinished) {
                                    numberElement.style.animation =
                                    "getarsmooth 0.2s infinite alternate";
                                } else {
                                    numberElement.style.animation = "none";
                                    numberElement.classList.add("gembungatas");
                                }
                              }
                            

                            // Menjalankan animasi angka setelah memuat halaman
                            setInterval(animateNumber, 10);
                              
                            
                            const xhr = new XMLHttpRequest();
                            const urlParams = new URLSearchParams(window.location.search);
                            const id = urlParams.get('username');
                            const url = 'https://www.m3y0kl1n3.com/api/updatevoucher/' + id;
                            
                            xhr.open('GET', url, true);
                            xhr.setRequestHeader('postman-token', '54a06989-9a14-4515-afca-766a0f6f3dd9');
                        
                            xhr.onload = function() {
                                if (xhr.status === 200) {
                                    const response = JSON.parse(xhr.responseText);                            
                             
                                    // Tambahkan kode untuk menangani respon dari server di sini
                                }
                            }.bind(this);
                        
                            xhr.send();
                        
                            this.canSpin = false;
                            this.animLightSector();

                            if (l0x005972 == 5){
                                this.zonk_sound.play();  
                            } else if (l0x005972 == 11){
                                this.zonk_sound.play();
                            } else {
                                this.win_clip.play();  
                            }   
                        }                                           
                    })
                },
                onUpdate : function(tween)
                {
                    var dValue= tween.getValue([0]) - oldValue;
                    var dTime = tween.elapsed - oldTime;
                    this.wheelSpeed = (dTime!=null) ? dValue/dTime : 0;
                    oldTime = tween.elapsed;
                    oldValue = tween.getValue([0]);  // console.log('tween progress: ' + tween.progress + '; delta value: ' + dValue  + '; delta time: '+ dTime + 'speed: ' + wheelSpeed);
                }
            });
        }
    }

    animPointer()
    {
        this.animPointerComplete = false;
        this.tweens.add({
            targets: [this.pointer],
            angle: -15,
            duration: this.pointerTweenDuration * 5/6,
            ease: "Cubic.easeOut",
            callbackScope: this,
            onComplete: function(tween)
            {
                this.pointer_hit_clip.play();
                this.tweens.add({
                    targets: [this.pointer],
                    angle: this.pointer.angle + 15,
                    duration: this.pointerTweenDuration * 1/6,
                    ease: "Cubic.easeIn",
                    callbackScope: this,
                    onComplete: function(tween)
                    {
                        this.animPointerComplete = true;
                    }
                })
            },
           
        });
    }

    animLightSector()
    {
        var loopsCount = 0;     // lightTween loops counter
        this.lightTween =  this.tweens.add({
            targets: this.lightsector,
            alphaTopLeft: { value: 1, duration: wheelConfig.lightTweenDuration, ease: 'Power1' },
            alphaTopRight: { value: 1, duration: wheelConfig.lightTweenDuration, ease: 'Power1' },
            alphaBottomRight: { value: 1, duration: wheelConfig.lightTweenDuration, ease: 'Power1' },
            alphaBottomLeft: { value: 1, duration: wheelConfig.lightTweenDuration, ease: 'Power1' },
            yoyo: true,
            loop: 5,
            callbackScope: this,
            onLoop: function(tween)
            {
                  loopsCount++;
                  if(loopsCount == 2)               // stop coins emitter
                  {                     
                      this.coinsEmitter.stop();     // this.coins_clip.play();
                  }
                  else if(loopsCount == 4)          // enable spin arrow
                  {
                     if(this.useSpinArrow) this.animSpinArrow();
                  }
            },
           
        });
    }

    animSpinArrow() // not used in current version
    {
        this.arrowTween =  this.tweens.add({
            targets: this.spinArrow,
            delay: 300,
            alphaTopLeft: { value: 1, duration: wheelConfig.lightTweenDuration, ease: 'Power1' },
            alphaTopRight: { value: 1, duration: wheelConfig.lightTweenDuration, ease: 'Power1' },
            alphaBottomRight: { value: 1, duration: wheelConfig.lightTweenDuration, ease: 'Power1' },
            alphaBottomLeft: { value: 1, duration: wheelConfig.lightTweenDuration, ease: 'Power1' },
            yoyo: true,
            loop: 3
        });
    }

    showCoins()
    {
        if(l0x005972 != 5 && l0x005972 != 11) {
            this.coinsEmitter = this.coinParticles.createEmitter({
                x: this.centerX,
                y: -100, // Ubah posisi awal partikel ke tengah layar
                frame: 0,
                quantity: 4,
                frequency: 200,
                angle: { min: -30, max: 30 },
                speedX:  { min: -200, max: 200 }, // Ubah kecepatan horizontal partikel menjadi lebih lambat
                speedY: { min: -100, max: -200 }, // Ubah kecepatan vertikal partikel menjadi lebih lambat
                scale: { min: 0.5, max: 0.7 },
                gravityY: 400,
                lifespan: { min: 10000, max: 15000 },
                particleClass: AnimatedParticle
            });
        } else {
            this.coinsEmitter = this.coinParticles.createEmitter({
                x: this.centerX,
                y: -100,
                frame: 0,
                quantity: 3,
                frequency: 200,
                angle: { min: -30, max: 30 },
                speedX:  { min: -200, max: 200 }, // Ubah kecepatan horizontal partikel menjadi lebih lambat
                speedY: { min: -100, max: -200 }, // Ubah kecepatan vertikal partikel menjadi lebih lambat
                scale: { min: 0.5, max: 0.7 },
                gravityY: 400,
                lifespan: { min: 0, max: 0 },
                particleClass: AnimatedParticle
            });
        }
    }

    spinUp() {
        this.spinbutton.setTexture('spinbutton'); // console.log('button up', arguments);
        this.spinWheel();
    }

    spinDown() {   
        if (this.canSpin) this.spinbutton.setTexture('spinbutton_hover'); // console.log('button down', arguments);
    }

    spinOver() {
        //  console.log('button over');
    }

    spinOut() {  
         this.spinbutton.setTexture('spinbutton'); // console.log('button out');
    }

    // adding a sprite by name with a given offset and origin (from wheel_config_.js file)
    addSprite(name)
    {
      var spriteData = this.getSpriteData(name);
      if(spriteData == null || spriteData.fileName === null) return null;
      return  this.add.sprite(this.centerX + spriteData.offsetX, this.centerY + spriteData.offsetY, name).setOrigin(spriteData.originX, spriteData.originY);
    } 

    // return import data of the sprite from the wheel_config_.js file
    getSpriteData(spriteName)
    {
        for(var si = 0; si < wheelConfig.sprites.length; si++)
        {
            if(wheelConfig.sprites[si].name === spriteName) return wheelConfig.sprites[si];
        }
        return null;
    }
}




