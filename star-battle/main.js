$(function () {

    // 初始化選單動畫
    (function () {

        function showLi(n = 0) {
            if (n >= $("#menu li").length) {
                return;
            }
            $("#menu li").eq(n).css('animation-play-state', 'running');
            setTimeout(() => {
                showLi(n + 1);
            }, 100);
        }
        showLi();
    })();

    //遊戲選項
    var GAME_OPTIONS = {
        FPS: 30,
        SCORE: 0,
        TIME: 0,
        FRAME: 0,
        FONT_SIZE: 16,
        HP: 0,
        DIFF: 0,
        ISMUTED: false,
        STATUS: false,
        GAMEOVER: true,
        BIG_BULLET_TIME: 0,
        PLAYER_X: 0,
        PLAYER_Y: 0,
        SUPER_TIME: 0,
        AUTO_SHOOT_TIME: 0,
    }

    //當前畫面中有的物件
    var GameObj = {};
    //是否已經按下射擊(空白鍵)
    var isShoot = false;
    //一些聲音的DOM
    var sounds = {
        bgm: document.getElementById('sound_bgm'),
        shoot: document.getElementById('sound_shoot'),
        destroy: document.getElementById('sound_destroy'),
    };

    //遊戲初始化
    function init() {

        sounds.bgm.currentTime = 0;
        if (!GAME_OPTIONS.ISMUTED)
            sounds.bgm.play();

        var options = {
            FPS: 30,
            SCORE: 0,
            TIME: 0,
            FRAME: 0,
            HP: 0,
            DIFF: 0,
            STATUS: true,
            GAMEOVER: false,
            SUPER_TIME: 5,
            BIG_BULLET_TIME: 0,
            AUTO_SHOOT_TIME: 0,
        };

        Object.assign(GAME_OPTIONS, options);
        $("#gameobjects").empty();
        GameObj = {};

        new Player(100, 100);
        new Ship(960, rand(30, 570));
        new Aestroid(960, rand(30, 570));
        new Fuel(rand(50, 550), 0);
        new Player2(960, rand(30, 570));

        game_start();
        $("#adBtn").show();
    }

    //遊戲每FPS做的事
    function update() {
        GAME_OPTIONS.DIFF = Math.ceil(GAME_OPTIONS.TIME / 5);
        GAME_OPTIONS.FPS = Math.max(10, 31 - GAME_OPTIONS.DIFF);
        if (GameObj.player[0] != undefined) {
            GAME_OPTIONS.HP = GameObj.player[0].hp;
        }
        //對每個物件做更新
        Object.keys(GameObj).forEach(key => {
            GameObj[key].forEach(ele => {
                if (ele.frame > 1) {
                    let width = ele.width;
                    let n = Math.floor(GAME_OPTIONS.FRAME / 5) % ele.frame;
                    ele.obj.find('.objBackground').css('background-position-x', `${n * width}px`);
                }
                if (ele.active) {
                    ele.update();
                }
            });
        });


        //刪除被destroy的物件
        Object.keys(GameObj).forEach(key => {
            for (let i = 0; i < GameObj[key].length; i++) {
                if (GameObj[key][i].active == false) {
                    GameObj[key][i].obj.remove();
                    GameObj[key].splice(i, 1);
                    i--;
                }
            }
        });

        //產生敵人與燃料

        if (GAME_OPTIONS.FRAME % 30 == 0) {

            for (let i = 0; i <= Math.ceil(GAME_OPTIONS.DIFF / 2); i++) {
                if ($(".object").length <= 20) {
                    let n = rand(1, 8);
                    if (n <= 4) {
                        new Ship(960, rand(30, 570));
                    } else if (n <= 7) {
                        new Aestroid(960, rand(30, 570));
                    } else {
                        new Fuel(rand(50, 550), 0);
                    }
                }
                if ($(".item").length < 3) {
                    if (rand(1, 10) == 1) {
                        new BigBulletItem(rand(50, 350), 0);
                    }
                    if (rand(1, 20) == 2 && GAME_OPTIONS.SUPER_TIME <= 5) {
                        new SuperTimeItem(rand(50, 350), 0);
                    }
                    if (rand(1, 30) == 3 && GAME_OPTIONS.AUTO_SHOOT_TIME <= 10) {
                        new AutoShootItem(rand(50, 350), 0);
                    }
                }
            }
            if (GAME_OPTIONS.HP <= 7 && $(".fuel").length <= 2)
                new Fuel(rand(50, 550), 0);
            if (GAME_OPTIONS.TIME >= 30 && $(".bigEnemy").length < Math.floor(GAME_OPTIONS.TIME / 15) && rand(1, Math.max(5, (26 - GAME_OPTIONS.DIFF))) == 5) {
                if (rand(1, 2) == 1) {
                    if (GAME_OPTIONS.TIME >= 60) {
                        new BigAestroid_DIFF(960, rand(50, 400));
                    } else {
                        new BigAestroid(960, rand(50, 400));
                    }
                } else {
                    if (GAME_OPTIONS.TIME >= 60) {
                        new BigShip_DIFF(960, rand(50, 400));
                    } else {
                        new BigShip(960, rand(50, 400));
                    }
                }
            }
            if ($(".boss").length == 0 && GAME_OPTIONS.TIME > 60 && rand(1, Math.max(15, (50 - GAME_OPTIONS.DIFF))) == 5) {
                new BossShip(960, rand(100, 400));
            }

        }

        if (GAME_OPTIONS.AUTO_SHOOT_TIME > 0 && GAME_OPTIONS.FRAME % 5 == 0) {
            shoot();
        }

        //設定畫面上的物件
        $("#score div").text(GAME_OPTIONS.SCORE);
        $("#time div").text(GAME_OPTIONS.TIME);
        $("#fuelText").text(GAME_OPTIONS.HP);
        $("#fuelFill").css('top', (30 - GAME_OPTIONS.HP) * (125 / 30) + 'px');
    }

    // 遊戲開始
    function game_start() {
        if (!GAME_OPTIONS.ISMUTED)
            sounds.bgm.play();
        GAME_OPTIONS.STATUS = true;
        animate_start();

        $("#controller").on('mousemove', function (e) {
            let [x, y] = [e.offsetX - 65, e.offsetY - 65];
            [x, y] = [x / 13, y / 13];
            let angle = x * 2 + y * 3;
            GameObj.player[0].offsetX = x;
            GameObj.player[0].offsetY = y;
            GameObj.player[0].obj.css({
                transition: `transform .2s`,
                transform: `rotate(${angle}deg)`
            });
        });

        $("#controller").on('mouseout', function (e) {
            GameObj.player[0].offsetX = 0;
            GameObj.player[0].offsetY = 0;
            GameObj.player[0].obj.css({
                transition: `transform 1s`,
                transform: `rotate(0deg)`
            });
        });

    }

    //遊戲暫停
    function game_stop() {
        sounds.bgm.pause();
        GAME_OPTIONS.STATUS = false;
        animate_stop();
        $("#controller").off('mousemove');
        $("#controller").off('mouseout');
    }

    //遊戲結束
    function game_over() {
        GAME_OPTIONS.GAMEOVER = true;
        game_stop();
        $("#continueBtn").prop('disabled', true);
        $("#inputName input").val('');
        $("#center-center").show();
        $("#center-center").css('display', 'flex');
        $("#inputName").fadeIn(500);
    }

    //動畫開始

    function animate_start() {
        $("[data-time]").each(function () {
            let datatime = $(this).data('time');
            let avg_speed = 2880 / datatime;
            let distance = 960 + parseInt($(this).css('left').replace('px', ''));
            let time = distance / avg_speed;
            $(this).animate({
                left: '-960px',
            }, time * 1000, 'linear', function () {
                $(this).css({
                    left: '0px',
                    animation: `planetMove ${datatime}s infinite linear`
                });
                $(this).removeAttr('data-time');
            });
        });
        $(".animObj").css('animation-play-state', 'running');
    }

    //動畫暫停
    function animate_stop() {
        $("[data-time]").stop();
        $(".animObj").css('animation-play-state', 'paused');
    }

    //回傳遊戲狀態
    function gameIsRunning() {
        return GAME_OPTIONS.STATUS;
    }

    //切換遊戲狀態
    function switchStatus() {
        if (GAME_OPTIONS.GAMEOVER == false) {
            GAME_OPTIONS.STATUS = !GAME_OPTIONS.STATUS;
            let n = GAME_OPTIONS.STATUS ? 0 : -40;
            $("#status").css('background-position-x', n + 'px');
            GAME_OPTIONS.STATUS ? game_start() : game_stop();
        }
    }

    //事件處理
    $(document).on('keydown', function (e) {
        if (gameIsRunning() && e.keyCode == 32 && isShoot == false) {
            isShoot = true;
            shoot()
        }
        if (e.keyCode == 80) {
            switchStatus();
        }
    });

    $(document).on('keyup', function (e) {
        if (e.keyCode == 32) {
            isShoot = false;
        }
    })

    function shoot() {
        if (!GAME_OPTIONS.ISMUTED) {
            sounds.shoot.cloneNode().play();
        }
        if (GAME_OPTIONS.TIME <= 15) {
            new Bullet(GameObj.player[0]);
        } else if (GAME_OPTIONS.TIME <= 30) {
            new Bullet(GameObj.player[0], -7);
            new Bullet(GameObj.player[0], 7);
        } else if (GAME_OPTIONS.TIME <= 45) {
            new Bullet(GameObj.player[0], -5, -1);
            new Bullet(GameObj.player[0], 0);
            new Bullet(GameObj.player[0], 5, 1);
        } else if (GAME_OPTIONS.TIME < 100) {
            new Bullet(GameObj.player[0], -10, -2);
            new Bullet(GameObj.player[0], -5, -1);
            new Bullet(GameObj.player[0], 0);
            new Bullet(GameObj.player[0], 5, 1);
            new Bullet(GameObj.player[0], 10, 2);
        } else {
            new Bullet(GameObj.player[0], -10, -2);
            new Bullet(GameObj.player[0], -5, -1, -rand(-30, 30));
            new Bullet(GameObj.player[0], -5, -1);
            new Bullet(GameObj.player[0], 0, 0, -rand(-30, 30));
            new Bullet(GameObj.player[0], 0);
            new Bullet(GameObj.player[0], 5, 1, -rand(-30, 30));
            new Bullet(GameObj.player[0], 5, 1);
            new Bullet(GameObj.player[0], 10, 2);
        }
    }

    $("#status").click(switchStatus);
    $("#sound").click(function () {
        GAME_OPTIONS.ISMUTED = !GAME_OPTIONS.ISMUTED;
        let n = !GAME_OPTIONS.ISMUTED ? 0 : -40;
        $("#sound").css('background-position-x', n + 'px');
        if (!GAME_OPTIONS.ISMUTED && GAME_OPTIONS.STATUS) {
            sounds.bgm.play();
        } else {
            sounds.bgm.pause();
        }
    });

    $(".fontsize").click(function () {
        let value = $(this).data('value');
        GAME_OPTIONS.FONT_SIZE += value;
        $("#score div,#time div").css('font-size', GAME_OPTIONS.FONT_SIZE + 'px');
        $("#fuelText").css('font-size', GAME_OPTIONS.FONT_SIZE * 2 + 'px');

    });

    $("#startBtn").click(function () {
        $("#menu").remove();
        $("#game").removeAttr('data-init');
        init();
    });

    $("#inputName input").on('input', function () {
        let value = this.value;
        $("#continueBtn").prop('disabled', value == "");
    });

    $("#continueBtn").click(function () {
        let name = $("#inputName input").val();
        if (name != "") {
            let score = GAME_OPTIONS.SCORE;
            let time = GAME_OPTIONS.TIME;
            $.ajax({
                url: 'register.php',
                method: 'post',
                dataType: 'json',
                data: {
                    name,
                    score,
                    time,
                },
                success: function (res) {
                    $("#table table tr:gt(0)").remove();
                    res.forEach(record => {
                        $tr = $("<tr>").
                        append($("<td>").text(record.rank)).
                        append($("<td>").text(record.name)).
                        append($("<td>").text(record.score)).
                        append($("<td>").text(record.time));
                        $("#table table tr").last().after($tr);
                        $("#inputName").hide();
                        $("#rank").fadeIn(500);
                    });
                }
            });
        }
    });

    $("#restartBtn").click(function () {
        $("#rank,#center-center").hide();
        init();
    });

    $("#adBtn").click(function () {
        $("#inputName").hide();
        $("#continueGameBtn").prop('disabled', true);
        $("#ad").fadeIn(500, function () {
            // $("#ad video")[0].currentTime = 25;
            $("#ad video")[0].play();
            $("#ad video").on('ended', function () {
                $("#ad>header>div").text('播放結束');
                $("#continueGameBtn").prop('disabled', false);
                $(this)[0].currentTime = 0;
            });
        });
    });

    $("#continueGameBtn").click(function () {
        $("#ad>header>div").text('廣告播放中');
        $("#ad,#center-center,#adBtn").hide();
        sounds.bgm.currentTime = 0;
        if (!GAME_OPTIONS.ISMUTED)
            sounds.bgm.play();

        var options = {
            STATUS: true,
            GAMEOVER: false,
            BIG_BULLET_TIME: 0,
            SUPER_TIME: 5
        };

        Object.assign(GAME_OPTIONS, options);

        GameObj.Bullet = [];
        $(".bullet").remove();
        $(".item").parent().remove();
        new Player(GAME_OPTIONS.PLAYER_X, GAME_OPTIONS.PLAYER_Y);
        new Fuel(rand(50, 550), 0);
        game_start();
    });

    //每個FPS做的事
    setInterval(() => {
        if (gameIsRunning()) {
            GAME_OPTIONS.FRAME++;
            update();
        }
    }, GAME_OPTIONS.FPS);

    //每秒做的事
    setInterval(() => {
        if (gameIsRunning()) {
            GAME_OPTIONS.TIME++;
            GameObj.player[0].hp--;
            if (GAME_OPTIONS.TIME == 30) {
                if (rand(1, 2) == 1) {
                    new BigAestroid(960, rand(50, 400));
                } else {
                    new BigShip(960, rand(50, 400));
                }
            }
            if (GAME_OPTIONS.TIME == 60) {
                new BossShip(960, rand(100, 400));
            }
            if (GAME_OPTIONS.BIG_BULLET_TIME > 0)
                GAME_OPTIONS.BIG_BULLET_TIME--;
            if (GAME_OPTIONS.SUPER_TIME > 0)
                GAME_OPTIONS.SUPER_TIME--;
            if (GAME_OPTIONS.AUTO_SHOOT_TIME > 0)
                GAME_OPTIONS.AUTO_SHOOT_TIME--;
        }
    }, 1000);


    //類別的宣告

    //最基底的類別 遊戲物件
    class GameObject {
        constructor(params) {
            var data = {
                x: 0,
                y: 0,
                width: 100,
                height: 100,
                background: '#333',
                frame: 1,
                hp: 1,
                offsetX: 0,
                offsetY: 0,
                outsideX: 1000,
                outside_X: -100,
                outsideY: 700,
                outside_Y: -100,
                useBomb: true,
                name: 'object',
                className: 'object',
                bombWidth: 100,
                bombHeight: 100,
                useHPBar: false
            }
            Object.assign(data, params);
            Object.assign(this, data);
            this.active = true;
            this.maxHP = data.hp;
            this.obj = $("<div>").css({
                left: this.x + 'px',
                top: this.y + 'px',
                width: this.width + 'px',
                height: this.height + 'px'
            })
            if (this.useHPBar) {
                this.obj.append($("<div>").addClass("hp").css({
                    width: '100%',
                    height: '5px',
                    background: '#333',
                    'z-index': 9,
                }).append($("<div>").css({
                    transition: 'width .1s',
                    background: 'red',
                    height: '5px',
                })))
            }

            this.obj.append($("<div>").css({
                background: this.background,
                width: this.width + 'px',
                height: this.height + 'px'
            }).addClass(this.className).addClass('objBackground'));
            if (GameObj[this.name] == undefined)
                GameObj[this.name] = [];
            GameObj[this.name].push(this);
            $("#gameobjects").append(this.obj);
        }

        update() {
            this.x += this.offsetX;
            this.y += this.offsetY;

            if (this.x >= this.outsideX || this.y >= this.outsideY || this.x <= this.outside_X || this.y <= this.outside_Y || this.hp <= 0) {
                this.destroy();
            }

            this.obj.css({
                left: this.x + 'px',
                top: this.y + 'px'
            });
            if (this.useHPBar) {
                this.obj.find('.hp>div').css({
                    width: (this.hp / this.maxHP) * 100 + '%'
                });
            }

            //判斷碰撞
            Object.keys(GameObj).forEach(key => {
                GameObj[key].forEach(ele => {
                    if (ele != this) {
                        let [x1, y1] = [this.x, this.y];
                        let [x2, y2] = [ele.x, ele.y];
                        if (x1 > x2) {
                            x2 += ele.width;
                        } else {
                            [x1, x2] = [x2, x1 + this.width];
                        }

                        if (y1 > y2) {
                            y2 += ele.height;
                        } else {
                            [y1, y2] = [y2, y1 + this.height];
                        }

                        if (ele.name == 'bullet' || this.name == 'bullet') {
                            if (x2 > x1 && y2 > y1) {
                                this.collide(ele);
                            }
                        } else {
                            if (x2 > x1 && y2 * 0.95 > y1) {
                                this.collide(ele);
                            }
                        }
                    }
                });
            });

        }

        destroy() {
            this.active = false;
            if (this.useBomb && this.hp <= 0) {
                if (!GAME_OPTIONS.ISMUTED) {
                    sounds.destroy.cloneNode().play();
                }
                let [x, y] = [this.x, this.y];
                let [width, height] = [this.width, this.height];
                let $bomb = $("<div>").css({
                    left: this.x + width / 2 + 'px',
                    top: this.y + height / 2 + 'px',
                    width: '10px',
                    height: '10px',
                    background: 'url("./Module_C_素材/C_CLIENT_SIDE_MEDIA/images/bomb.png")',
                    'background-size': '100% 100%',
                });

                $("#gameobjects").append($bomb);

                $bomb.animate({
                    left: this.x + width / 2 - (this.bombWidth - 10) / 2 + 'px',
                    top: this.y + height / 2 - (this.bombHeight - 10) / 2 + 'px',
                    width: this.bombWidth + 'px',
                    height: this.bombHeight + 'px',
                }, 150, 'linear', function () {
                    setTimeout(() => {
                        $(this).fadeOut(100, function () {
                            $(this).remove();
                        });
                    }, 50);
                });
            }

        }

        collide(target) {

        }
    }

    //玩家類別
    class Player extends GameObject {
        constructor(x, y) {
            super({
                x,
                y,
                background: 'url("./Module_C_素材/C_CLIENT_SIDE_MEDIA/images/player.png")',
                width: 140,
                height: 80,
                hp: 15,
                frame: 3,
                name: 'player',
                bulletSize: 1,
            });
            this.obj.addClass('animObj');
            this.update = (() => {
                let func = this.update;
                return () => {
                    this.x = Math.min(820, Math.max(0, this.x));
                    this.y = Math.min(520, Math.max(0, this.y));
                    this.hp = Math.min(30, Math.max(0, this.hp));
                    this.bulletSize = GAME_OPTIONS.BIG_BULLET_TIME > 0 ? 2 : 1;
                    // this.hp = 30;
                    if (GAME_OPTIONS.SUPER_TIME) {
                        this.hp = 30;
                        if (GAME_OPTIONS.FRAME % 2 == 0)
                            this.obj.css({
                                animation: 'flicker .5s infinite linear'
                            });
                    } else {
                        this.obj.css('animation', '');
                    }
                    return func.apply(this, arguments);
                }
            })();

            this.destroy = (() => {
                let func = this.destroy;
                return () => {
                    GAME_OPTIONS.HP = 0;
                    GAME_OPTIONS.PLAYER_X = this.x;
                    GAME_OPTIONS.PLAYER_Y = this.y;
                    game_over();
                    return func.apply(this, arguments);
                }
            })();

        }

        collide(target) {
            if (target.name == 'enemy') {
                target.hp = 0;
                target.destroy();
                this.hp -= 15;
            } else if (target.name == 'fuel') {
                target.destroy();
                this.hp += 15;
            }

        }

    }

    //子彈類別
    class Bullet extends GameObject {
        constructor(obj, offsetY = 0, angle = 0, offsetX = 0) {
            let name = obj.name;
            if (name == 'player') {
                var x = obj.x + obj.width;
                var y = obj.y + obj.height / 2;
                var dir = 1;
                var color = '#39f';
                var attack = 1;
                let [ox, oy] = [obj.offsetX, obj.offsetY];
                var width = 25 * obj.bulletSize;
                var height = 5 * obj.bulletSize;
                angle += ox * 2 + oy * 3;
            } else {
                var x = obj.x;
                var y = obj.y + obj.height / 2;
                var dir = -1;
                var color = 'red';
                var attack = 15;
                var width = 25;
                var height = 5;
            }

            super({
                width: width,
                height: height,
                x: x + offsetX,
                y: y + angle * 2 + offsetY,
                offsetX: dir * 10,
                background: `linear-gradient(to right,white,${color})`,
                name: 'bullet',
                className: 'bullet',
                src: name,
                attack: attack,
                super: false
            });
            this.offsetY = angle;
            if (name == 'player') {
                this.obj.css('transform', `rotate(${angle * 3}deg)`);
                if (obj.bulletSize > 1)
                    this.super = true;
            } else
                this.obj.css('transform', `rotate(${360 - (angle * 3)}deg)`);

        }

        collide(target) {
            if (target.name != 'fuel' && target.name != 'item') {
                if (target.name == 'bullet') {
                    if (target.src != this.src) {
                        if (!this.super)
                            this.destroy();
                        if (!target.super)
                            target.destroy();
                    }
                } else {
                    if (target.name != this.src) {
                        if (this.name == 'bullet' && !target.obj.find('div').eq(0).hasClass('object') && this.super) {
                            this.destroy();
                            target.hp -= this.attack * 2;
                        }
                        if (!this.super) {
                            this.destroy();
                        }
                        target.hp -= this.attack;
                        if (target.name == 'enemy' && target.hp <= 0) {
                            GAME_OPTIONS.SCORE += target.score;
                        }
                    }
                }
            }
        }
    }

    class BossBullet extends GameObject {
        constructor(obj) {
            var x = obj.x;
            var y = obj.y + obj.height / 2;

            super({
                width: 200,
                height: 30,
                x: x,
                y: y,
                offsetX: -20,
                background: `linear-gradient(to right,white,rgba(0,0,255,.5))`,
                name: 'boss_bullet',
                className: 'bullet',
                src: 'boss',
                attack: 30,
                super: true,
                hp: 999,
                useBomb: false
            });
        }

        collide(target) {
            if (target.name != 'fuel' && target.name != 'item') {
                if (target.name == 'bullet') {
                    target.destroy();
                } else {
                    if (target.className != 'boss' && target.className != 'bigEnemy') {
                        target.hp -= this.attack;
                    }
                    if (target.name == 'player') {
                        GAME_OPTIONS.SUPER_TIME = Math.min(GAME_OPTIONS.SUPER_TIME, 1);
                        this.destroy();
                    }
                }
            }
        }
    }

    //敵人的基底類別
    class Enemy extends GameObject {
        constructor(params) {
            var data = {
                score: 5,
                hp: 1,
                name: "enemy"
            };
            Object.assign(data, params);
            super(data);
        }
    }

    //敵人太空艦 類別
    class Ship extends Enemy {
        constructor(x, y) {
            let n = rand(1, 3);
            super({
                x: x,
                y: y,
                background: 'url("./Module_C_素材/C_CLIENT_SIDE_MEDIA/images/ship_' + n + '.png")',
                width: 80,
                height: 80,
                frame: 4,
                score: (n == 2) ? -10 : 5,
                offsetX: -3.5,
            });

            if (n != 2) {

                this.update = (() => {
                    let func = this.update;
                    return () => {
                        if ((GAME_OPTIONS.FRAME % (GAME_OPTIONS.FPS * Math.max(1, 6 - GAME_OPTIONS.DIFF))) == 0)
                            new Bullet(this);
                        return func.apply(this, arguments);
                    }
                })();

            }
        }
    }

    class Aestroid extends Enemy {
        constructor(x, y) {
            let n = rand(1, 2);
            super({
                x: x,
                y: y,
                background: 'url("./Module_C_素材/C_CLIENT_SIDE_MEDIA/images/aestroid_' + n + '.png")',
                width: 80,
                height: 80,
                score: 10,
                hp: 2,
                offsetX: -3.5,
                className: 'aestroid animObj',
            });

        }
    }

    class BigAestroid extends Enemy {
        constructor(x, y) {
            super({
                x: x,
                y: y,
                background: 'url("./Module_C_素材/C_CLIENT_SIDE_MEDIA/images/aestroid_gray_2.png")',
                width: 256,
                height: 256,
                score: 200,
                hp: 100,
                offsetX: -rand(1.5, 15),
                className: 'aestroid animObj bigEnemy',
                outside_X: -300,
                bombWidth: 250,
                bombHeight: 250,
                useHPBar: true,
            });
        }
    }

    class BigShip extends Enemy {
        constructor(x, y) {
            super({
                x: x,
                y: y,
                background: 'url("./Module_C_素材/C_CLIENT_SIDE_MEDIA/images/ship_4.png")',
                width: 180,
                height: 180,
                frame: 3,
                score: 200,
                hp: 50,
                className: 'bigEnemy',
                offsetX: -2.5,
                outside_X: -300,
                bombWidth: 250,
                bombHeight: 250,
                useHPBar: true,
            });
            this.obj.addClass('traversal');
            this.traversal = false;
            this.update = (() => {
                let func = this.update;
                return () => {

                    if ((GAME_OPTIONS.FRAME % GAME_OPTIONS.FPS * rand(3, 7)) == 0) {
                        new Bullet(this, -20, -2);
                        new Bullet(this, -10, -1);
                        new Bullet(this);
                        new Bullet(this, 10, 1);
                        new Bullet(this, 20, 2);
                    }

                    if (this.traversal && (GAME_OPTIONS.FRAME % (Math.floor(GAME_OPTIONS.FPS * (0.5 + Math.random() * 3)))) == 0) {
                        this.x = rand(400, 800);
                        this.y = rand(100, 400);
                    }

                    if (this.x <= 800) {
                        this.traversal = true;
                        this.offsetX = 0;
                    }
                    return func.apply(this, arguments);
                }
            })();

        }
    }

    class Player2 extends Enemy {
        constructor(x, y) {
            super({
                x: x,
                y: y,
                background: 'url("./Module_C_素材/C_CLIENT_SIDE_MEDIA/images/player2.png")',
                width: 140,
                height: 80,
                score: 20,
                hp: 5,
                offsetX: -5,
                useHPBar: true,
                frame: 3
            });

            this.update = (() => {
                let func = this.update;
                return () => {
                    if ((GAME_OPTIONS.FRAME % (GAME_OPTIONS.FPS * Math.max(1, 6 - GAME_OPTIONS.DIFF))) == 0)
                        new Bullet(this);
                    return func.apply(this, arguments);
                }
            })();

        }
    }

    class Fuel extends GameObject {
        constructor(x, y) {
            super({
                x: x,
                y: y,
                background: 'url("./Module_C_素材/C_CLIENT_SIDE_MEDIA/images/fuel_fly.png")',
                width: 65,
                height: 70,
                offsetY: GAME_OPTIONS.DIFF + 1,
                className: 'fuel animObj',
                name: 'fuel'
            });
        }
    }

    class Item extends GameObject {
        constructor(params) {
            var data = {
                width: 50,
                height: 50,
                offsetY: 3,
                className: 'item',
                name: 'item',
                x: 0,
                y: 0,
                useBomb: false,
            };
            Object.assign(data, params);
            super(data);
            this.obj.append($("<div>").css({
                background: data.itemBG,
                width: data.width + 'px',
                height: data.height + 'px',
                'border-radius': '50%',
            }));
        }
    }

    class BigBulletItem extends Item {
        constructor(x, y) {
            var data = {
                x: x,
                y: y,
                itemBG: 'radial-gradient(white,rgba(255,0,0,.5))'
            };
            super(data);
            this.obj.append($("<div>").css({
                background: 'linear-gradient(to left,white,#39f)',
                width: '25px',
                height: '5px',
            }).addClass('bullet')).css({
                display: 'flex',
                'align-items': 'center',
                'justify-content': 'center'
            });
        }
        collide(target) {
            if (target.name == 'player') {
                GAME_OPTIONS.BIG_BULLET_TIME += 10;
                this.destroy();
            }
        }
    }

    class SuperTimeItem extends Item {
        constructor(x, y) {
            var data = {
                x: x,
                y: y,
                itemBG: 'radial-gradient(white,rgba(0,255,0,.5))'
            };
            super(data);
            this.obj.append($("<div>").css({
                background: 'url("./Module_C_素材/C_CLIENT_SIDE_MEDIA/images/player.png")',
                'background-size': '132px 30px',
                'background-position-x': '4px',
                'background-position-y': '11px',
                width: '50px',
                height: '50px',
                display: 'flex',
                'align-items': 'center',
                'justify-content': 'center',
                animation: 'flicker .5s infinite linear',
                padding: '7px 0',
                'padding-left': '1px',
                'background-clip': 'content-box',
            }).addClass('animObj'));
        }
        collide(target) {
            if (target.name == 'player') {
                GAME_OPTIONS.SUPER_TIME += 5;
                this.destroy();
            }
        }
    }

    class AutoShootItem extends Item {
        constructor(x, y) {
            var data = {
                x: x,
                y: y,
                itemBG: 'radial-gradient(white,rgba(0,0,255,.5))'
            };
            super(data);
            this.obj.append($("<div>").css({
                background: 'linear-gradient(to left,white,#39f)',
                width: '25px',
                height: '5px',
            }).addClass('bullet')).css({
                display: 'flex',
                'align-items': 'center',
                'justify-content': 'center'
            });
            this.obj.append($("<div>", {
                text: 'AUTO'
            }).css({
                'width': '50px',
                'height': '50px',
                'font-weight': '900',
                'font-size': '12px',
                'text-align': 'center',
                'top': '5px',
            }));
            this.obj.append($("<div>", {
                text: '5s'
            }).css({
                'width': '50px',
                'height': '50px',
                'font-weight': '900',
                'font-size': '12px',
                'text-align': 'center',
                'top': '30px',
            }));
        }
        collide(target) {
            if (target.name == 'player') {
                GAME_OPTIONS.AUTO_SHOOT_TIME += 5;
                this.destroy();
            }
        }
    }

    class BossShip extends Enemy {
        constructor(x, y) {
            super({
                x: x,
                y: y,
                background: 'url("./Module_C_素材/C_CLIENT_SIDE_MEDIA/images/spaceship-reference_3-01.png")',
                width: 289,
                height: 157,
                score: 2000,
                hp: 1000,
                className: 'boss',
                offsetX: -1,
                outside_X: -500,
                bombWidth: 400,
                bombHeight: 400,
                useHPBar: true,
            });
            this.obj.addClass('traversal');
            this.traversal = false;
            this.update = (() => {
                let func = this.update;
                return () => {
                    if ((GAME_OPTIONS.FRAME % GAME_OPTIONS.FPS * rand(3, 7)) == 0) {
                        if (rand(1, 5) == 1) {
                            new BossBullet(this);
                        } else {
                            for (let i = 1; i <= 25; i++) {
                                new Bullet(this, rand(-10, 10), rand(-4, 4), rand(0, 20));
                            }
                        }
                    }
                    if (this.traversal && (GAME_OPTIONS.FRAME % (GAME_OPTIONS.FPS * 2)) == 0) {
                        this.x = rand(400, 750);
                        this.y = rand(0, 400);
                    }

                    if (this.x <= 800) {
                        this.traversal = true;
                        this.offsetX = 0;
                    }
                    return func.apply(this, arguments);
                }
            })();

        }
    }
    class BigShip_DIFF extends Enemy {
        constructor(x, y) {
            super({
                x: x,
                y: y,
                background: 'url("./Module_C_素材/C_CLIENT_SIDE_MEDIA/images/ship_4.png")',
                width: 180,
                height: 180,
                frame: 3,
                score: 500,
                hp: 150,
                className: 'bigEnemy',
                offsetX: -2.5,
                outside_X: -300,
                bombWidth: 250,
                bombHeight: 250,
                useHPBar: true,
            });
            this.obj.addClass('traversal');
            this.obj.find('.bigEnemy').css('filter', 'hue-rotate(50deg)');
            this.obj.css('transform', 'scale(1.3,1.3)');
            this.obj.addClass('animObj');
            this.traversal = false;
            this.skillCD = false;
            this.update = (() => {
                let func = this.update;
                return () => {
                    if (rand(1, 200) == 99 && this.skillCD == false) {
                        this.skillCD = true;
                        this.x = rand(600, 800);
                        this.y = rand(100, 400);
                        setTimeout(() => {
                            var n = 1;
                            while (n <= 50 && this.active && !GAME_OPTIONS.GAMEOVER) {
                                if (gameIsRunning()) {
                                    n++;
                                    setTimeout(() => {
                                        new Bullet(this, rand(-25, 25), rand(-10, 10));
                                    }, n * 30);
                                }
                            }
                            setTimeout(() => {
                                this.obj.css('animation', 'flicker .5s infinite linear');
                                setTimeout(() => {
                                    this.obj.css('animation', '');
                                    this.skillCD = false;
                                }, 3000);
                            }, 1500);
                        }, 2500);
                    } else if (this.skillCD == false) {
                        if ((GAME_OPTIONS.FRAME % GAME_OPTIONS.FPS * rand(3, 6)) == 0) {
                            new Bullet(this, -30, -3);
                            new Bullet(this, -20, -2);
                            new Bullet(this, -10, -1);
                            new Bullet(this);
                            new Bullet(this, 10, 1);
                            new Bullet(this, 20, 2);
                            new Bullet(this, 30, 3);
                        }
                        if (this.traversal && (GAME_OPTIONS.FRAME % (GAME_OPTIONS.FPS * 1.5)) == 0) {
                            this.x = rand(400, 800);
                            this.y = rand(100, 400);
                        }
                    }

                    if (this.x <= 800) {
                        this.traversal = true;
                        this.offsetX = 0;
                    }
                    return func.apply(this, arguments);
                }
            })();

        }
    }

    class BigAestroid_DIFF extends Enemy {
        constructor(x, y) {
            super({
                x: x,
                y: y,
                background: 'url("./Module_C_素材/C_CLIENT_SIDE_MEDIA/images/aestroid_gray_2.png")',
                width: 256,
                height: 256,
                score: 500,
                hp: 300,
                offsetX: -rand(1.5, 5),
                className: 'aestroid animObj bigEnemy',
                outside_X: -300,
                bombWidth: 250,
                bombHeight: 250,
                useHPBar: true,
            });
            this.obj.css('transform', 'scale(1.4,1.4)');
            this.obj.find('.bigEnemy').css('filter', 'sepia(2) brightness(1.2)');

            this.destroy = (() => {
                let func = this.destroy;
                return () => {
                    for (var i = 1; i <= rand(4, 8); i++) {
                        new Aestroid(this.x + rand(-100, 200), this.y + rand(-100, 200));
                    }
                    return func.apply(this, arguments);
                }
            })();
        }

    }


    animate_stop();
});

function rand(min, max) {
    return Math.floor(Math.random() * (max - min + 1) + min);
}