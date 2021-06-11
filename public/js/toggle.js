/* global $*/
// $.ajaxSetup({
//         headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')}
// });

 

$('.custom-control-input').on('change', function () {
    //workIdを取得
    let workId = $(this).parent().children(".work_id").val();
    let workPublicVal = $(this).val();
    let selecterId = $(this).attr("id");
    if ($(this).prop('checked')) {
      console.log('公開！！');
      //公開に変更する
      sendPost(this,workId,1);

      $(`#${selecterId}`).parent().children("span").text("公開");
     
    } else {
      console.log('非公開！！');
      //非公開に変更する
      sendPost(this,workId,0); 
      $(`#${selecterId}`).parent().children("span").text("非公開");
    
    }
    console.log(workId);
});

function sendPost(targetDom,workId,workPublicVal){    //laravelに値を渡している、送信メソッド
    $.ajax({
        type: "POST",
        url: "api/articles",        
        data: { "workId" : workId, "workPublicVal" : workPublicVal },
        dataType : "json",
        headers: {
          'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
      }).done(function(data){
        //$('label .custom-control-label').text('公開');
        var jsonObj = JSON.parse(data);
		if(jsonObj.status === 200){
		    //成功
		    $(targetDom).val(jsonObj.workPublicVal)
		}else{
		    //失敗
		}
      }).fail(function(XMLHttpRequest, status, e){
        alert(e);
      }); 
}
