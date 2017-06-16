$(function(){ 


/*
    **upload questions files
      tool:dropzone.js
      http://www.dropzonejs.com
*/
$("#dropAreaFile").dropzone({ 
    url: "?c=home&f=add_question",
    acceptedFiles: ".csv",
    init:function(){
         this.on("error", function (file, message) {
            this.removeFile(file);
            $('.dropText').text('文件上传失败，请上传csv文件');
            $('#droparea').addClass('err');
            console.log(message);
        });
        this.on("success", function(file,imageInfo) {
            $('.dropText').text('文件上传成功');
            $('#droparea').removeClass('err').addClass('right');
            this.removeFile(file);
        });
    }
    
});

/*
    用checkbox来判断题目是否在选中状态，选中上传否则删除
*/
$('.checkSend').click(function(){
    $This = $(this);
    $checkData=[];
    if($(this).is(':checked')) {
        $.ajax({
            type:'POST',
            url: '?c=home&f=show_question',
            data: {
                qid: $This.val(),
            },
            success:function(data){
                $Jsondata = eval("("+data+")");
                $Jsondata.forEach(function(e){ $checkData.splice(0,$checkData.length); $checkData.push(e.topic);})
                for (var i = 0; i < $checkData.length; i++) {
                    $text = $checkData[i].split("--");
                    $('.checkData').append('<li class="list-group-item" id="'+$text[1]+'">'+$text[0]+'</li>');
                }
            }

        });
    }else{
        $delId = $This.val();
        $.ajax({
            type:'GET',
            url: '?c=home&f=del_check&id='+$delId+'',
             success:function(data){
                   $('#'+data).remove();
             }

        });
    }
})

/* 
    答题判断对错
*/

$('.checkQuestion+input').click(function(){    
    $this=$(this);
    $score = 10;
    if($(this).attr('checked','true')){    
        $dataClass =$this.prev().attr('class').split(' ');
        $dataId = $this.prev().attr('data-id').split('_')[1];
        $answer = $this.prev().attr('data-answer');
            $.ajax({
                type:'POST',
                url: '?c=home&f=rightQuestion',
                data:{
                    dataId:$dataId,
                    answer:$answer,
                },
                 success:function(data){
                   $this.parent().parent().find('input').remove();
                   if(data==1){
                        $('.'+$dataClass[2]).addClass('list-group-item-success post');
                        $('.scoreFace').text($('.scoreFace').text()*1+10);
                        $('.textHide').val($('.scoreFace').text());
                   }else{
                        $('.'+$dataClass[2]).addClass('list-group-item-danger post');
                        $('.'+$dataClass[2]).parent().parent().find('.a'+data).addClass('list-group-item-success');
                   }

                 }

            });
    }

    if($('.post').length+1 >= $('.test_section').length){
        $('.submitHide').show();
    }


})


































}); 