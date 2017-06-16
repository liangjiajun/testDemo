var sliceArr = [0,1,2,3],
		output = '',
		slicenum = 0;

function nodePut(arr,flag){
	var structure ="";
	for(var i=0; i<arr.length;i++){

		var sqrt = Math.sqrt(arr.length),
			width = 400/sqrt,
			x= arr[i]%sqrt*width,
			y=Math.floor(arr[i]/sqrt)*width,
			ang = Math.floor(Math.random()*4)+1;

		if(flag ==1){
			structure +="<div class='move rang"+ang+"' ang='"+ang+"' no='"+arr[i]+"' style='background-position: -"+x+"px -"+y+"px; width:"+width+"px;height:"+width+"px;'></div>";
		}else{
			structure +="<div class='move no"+arr[i]+"' style='background-position: -"+x+"px -"+y+"px; width:"+width+"px;height:"+width+"px;'></div>";
		}
	}
	return structure;
}

/*put refer*/
output =nodePut(sliceArr);
$('.refer').append(output);

/*put main*/
sliceArr.sort(function(){ return Math.random()- 0.5});
output =nodePut(sliceArr,1);
$('.main').append(output);

var activityArea = function(){

	$('.refer div').each(function(){
		$(this).droppable({
			accept:function(drag){
					if(drag.attr('ang') == 1){
						if(drag.attr("no") == $(this).attr("no")){
							return drag;
						}
						return ".no"+$(this).attr('no');
					}
			},	
			drop:function(){
				slicenum++;
				if(slicenum ==sliceArr.length){
					alert('完成！');
				}
			}
		})
	})

	$('.main .move').click(function(){
		$('.main .move').removeClass('clicked');
		$(this).addClass('clicked');
	})


	$('.main .move').draggable({
		snap:'.move',
		snapTolerance:50,
		snapMode:'inner',
		revert:'invalid',
		delay:50,
		zIndex:999,
		stop: function(){
			$('.clicked').removeClass('clicked');
		}
	})
}
activityArea();


/*changes images*/


var imgArr = ['images/1.png','images/2.png','images/3.png','images/4.png'];
imgText = '';
function imgPut(arr){
	var imgNum ='';
	for(var i = 0;i<arr.length;i++){
		imgNum +="<img src='"+arr[i]+"' alt='"+arr[i]+"'/>"
	}
	return imgNum;
}
imgText =imgPut(imgArr);
$('.img').append(imgText);

$('.img img').each(function(){
	$(this).click(function(){
		var alt= $(this).attr('alt');
		console.log(alt);
		$('.refer,.main div').css("background-image","url("+alt+")");
	})	
});



document.onkeydown = function(){
	var activeClick = $('.clicked');
	activeClick.removeClass("rang1 rang2 rang3 rang4");

	if(event.keyCode ==37){
		var ang = activeClick.attr('ang')*1-1;
		if(ang<1){ang=4}
	}else if(event.keyCode ==39){
		var ang = activeClick.attr('ang')*1+1;
		if(ang>4){ang=1}
	}
	activeClick.attr("ang",ang);
	activeClick.addClass('rang'+ang);
	activityArea();
}


$('[name=level]').click(function(){
	var level = $(this).val();
	
	if(level ==1){
		sliceArr = [0,1,2,3];
	}
	else if(level ==2){
		sliceArr = [0,1,2,3,4,5,6,7,8];
	}
	else if(level ==3){
		sliceArr = [0,1,2,3,4,5,6,7,8,9,10,11,12,13,14,15];
	}


	output =nodePut(sliceArr);
	$('.refer').html("");
	$('.refer').append(output);

	sliceArr.sort(function(){ return Math.random()- 0.5});
	output =nodePut(sliceArr,1);
	$('.main').html("");
	$('.main').append(output);

	$('.img img').each(function(){
		$(this).click(function(){
			var alt= $(this).attr('alt');
			console.log(alt);
			$('.refer,.main div').css("background-image","url("+alt+")");
		})	
	});

	activityArea();
});

function readAsDataURL(){  
	var file =document.getElementById("file").files[0];  
    var reader =new FileReader();  
    reader.readAsDataURL(file);  
    reader.onload=function(e){  
        var result=$("#preview2");  
        // result.innerHTML=this.result;  
        localStorage.path = this.result;
        var file_name =file.name;
        var name =file_name.split('.');
        result.append('<img src="'+this.result +'" alt=images/'+name[0]+'.png>');  
console.log($('#file').val());
    }
        var path =localStorage.path

    // if(localStorage){$('#main div').css('background','url('+path+')')}  
} 