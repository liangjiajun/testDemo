/*
    requestAnimFrame =>新型定时器（1000/60）
*/
window.requestAnimFrame = (function() {
    return window.requestAnimationFrame || window.webkitRequestAnimationFrame 
    || window.mozRequestAnimationFrame || function(callback) {
        window.setTimeout(callback, 1000 / 60);
    };
 })();

/* website the background*/
    var canvasBg = document.getElementById("bg");
    var ctx = canvasBg.getContext("2d");
    var R = [];
    function Rect(x, y, w, h, color, angle, radius, angularSpeed) {
        this.x = x;
        this.y = y;
        this.w = w;
        this.h = h;
        this.color = color;
        this.angle = angle;
        this.radius = radius;
        this.angularSpeed = angularSpeed;
    }
    function setSize() {
        canvasBg.width = window.innerWidth;
        canvasBg.height = window.innerHeight;
    }
    function setBg() {
        ctx.fillStyle = "rgb(0,0,0)";
        ctx.fillRect(0, 0, canvasBg.width, canvasBg.height);
    }
    function drawRect() {
        setBg();
        for (var i = 0; i < R.length; i++) {
            ctx.fillStyle = R[i].color;
            ctx.fillRect(R[i].x, R[i].y, R[i].w, R[i].h);
            R[i].x = canvasBg.width / 2 + Math.sin(R[i].angle) * R[i].radius;
            R[i].y = canvasBg.height / 2 + Math.cos(R[i].angle) * R[i].radius;
            R[i].angle += R[i].angularSpeed;
        }
        requestAnimFrame(drawRect);
    }
    setSize();
    setBg();
    for (var i = 0; i < 2000; i++) {
        var x = canvasBg.width / 2;
        var y = canvasBg.height / 2;
        var w = Math.random() * 3;
        var h = w;
        var r = Math.random() * 255;
        var g = Math.random() * 255;
        var b = 255;
        var color = "rgba(" + ~~r + "," + ~~g + "," + ~~b + ",0.2)";
        var angle = Math.random() * 2 * Math.PI;
        var radius = Math.random() * (canvasBg.width + canvasBg.height) / 3 + 20;
        var angularSpeed = 0.2 * Math.random() * Math.PI / radius;
        R.push(new Rect(x, y, w, h, color, angle, radius, angularSpeed));
    }
    drawRect();

/*生成节点*/
for(var i = 0; i<45;i++){
    $('#wrap').append('<div class="post"> <span class="boxS"> <span class="boxT" id="boxWarp" style="background-image: url(2.jpg);"> </span> </span> </div>') 
}
/*节点顺序排列*/
$.fn.sixBorder = function(options){
    var defaults={post:'post'}
    var options=$.extend(defaults,options);
    var wrapWidth=$(this)[0].offsetWidth,postWidth=$("."+options.post)[0].offsetWidth,lineNum=Math.floor(wrapWidth/postWidth),lineLimit=Math.floor((wrapWidth-51)/postWidth);
    $("."+options.post).each(function(index){
        var _this = $(this);
        _this.css({'margin-left':'0px'});
        if(lineLimit == lineNum){
            var numPer=index%lineNum;
            if(numPer == 0){
                var linePer=Math.floor(index/lineNum)%2;
                if(linePer == 1){
                    _this.css({'margin-left':'51px'});
                }
            }
        }else{
            var numPer=index%(lineLimit+lineNum);
            if(numPer == 0){
                    _this.css({'margin-left':'51px'});
            }
        };
    });
}
/*执行排序方法*/
$("#wrap").sixBorder();
$(window).resize(function(){
    $("#wrap").sixBorder();
});



