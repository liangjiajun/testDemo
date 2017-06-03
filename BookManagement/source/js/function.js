$(function(){

var $url='fun.php';
/*新建标签*/
$('#new_label').bind("click",function(){
	$(this).slideUp();
	$('#add_label,#add_label_btn').slideDown();
});
$('#add_label_btn').bind("click",function(){
	var val = $('#add_label').val();
	if(val!=""){
		$.ajax({
			url:$url,
			type:'post',
			data:{labelAdd:val},
			success:function(data){
				$('.label_wrap').prepend('<label class="checkbox">\
											<input type="checkbox" name="label" class="check">\
											<span>'+data+'</span>\
										</label>');
				$('#add_label,#add_label_btn').slideUp();
				$('#new_label').slideDown();
			}
		})
	}else{
		$('#add_label_btn').text("内容不能为空");
	}
	
});


/*
	上传新书的连续操作
*/

$('#newBookBtn').click(function(){$('.overhiden,.newBookFace').slideDown();})
$('.overhiden').click(function(){$('.overhiden,.interface').slideUp();})
$('.del').click(function(){$('.overhiden,.interface').slideUp();})
$('#pushBook').click(function(){$('.overhiden,.pushFace').slideDown(); })



/*---获取表单的value---*/
function getVal(label){
	var val = {};
	val.name = $('#bookName').val(); 
	val.author = $('#bookAuthor').val(); 
	val.isbn = $('#isbn').val(); 
	val.message = $('#message').val(); 
	val.type = $('#bookType').find("option:selected").val(); 	
	val.allLabel = label;
	return val;
}



/*----提交表单-------*/
function newBook(){
	var dataLabel ='';
	$(".check:checked").each(function(i,v){
		dataLabel+=$(this).val()+',';
	})
	var val = getVal(dataLabel);
	$.ajax({
		url:$url, 
		type:'post',
	 	datatype: "json",	
		data:{
			valAdd:JSON.stringify(val),
		},
		success:function(data){
			if(data==1){
				$('.overhiden,.newBookFace').slideUp();
				location.reload(); 
			}
		},
	})
	
}
 
/*-------执行提交动作-------*/ 
$('#newBook').submit(function(){

	newBook();
	/*-------上传图片-------*/
	var formdata = new FormData(),
	 	fileObj=document.getElementById("bookFace").files[0];
	formdata.append("bookFace", fileObj); 	
	$.ajax({
		url:$url, 
		type:'post', 
		data:formdata, 
		cache:false, 
		contentType:false, 
		processData:false, 
		dataType:"json", 
	})

})

/*借书的界面*/

$('.borrow').click(function(){
	var bId = $(this).attr('id');
	$.ajax({
			url:$url, 
			type:'post',
			data:{bid:bId},
		 	success:function(data){
		 		$('.book').css({'background-image':'url('+data+')'});
		 		$('.overhiden,.borrowFace').slideDown();
		 		$('#borrowBtn').click(function(){
		 			$.ajax({
		 					url:$url, 
		 					type:'post',
		 					data:{bookBorrow:bId},
		 				 	success:function(data){
		 				 		if(data==1){
		 				 			$('.overhiden,.borrowFace').slideUp();
		 				 			location.reload(); 
		 				 		}
		 				 	}
		 			})
		 		})
		 	}
	})
	
		
})


/*---------还书界面---------------*/



$('.checkRadio').click(function(){
	if($(this).parent().attr('data')==0){
		$(this).parent().css({'opacity':'1'});
		$(this).parent().attr('data',1);
	}else{
		$(this).parent().css({'opacity':'.2'});
		$(this).parent().attr('data',0);
	}
})

$('#pushBtn').click(function(){
	var dataBook = '';
	$(".checkRadio:checked").each(function(i,v){
		dataBook+=$(this).val()+',';
	});
	$.ajax({
		url:$url, 
		type:'post', 
		data:{push:dataBook},
		success:function(data){
			if(data==1){
				$('.overhiden,.pushFace').slideUp();
				location.reload(); 
			}
		}
	})
	
})








	































})