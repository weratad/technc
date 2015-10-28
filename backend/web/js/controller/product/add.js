function submitForm() {
     // alert(tinyMCE.activeEditor.getContent().replace(/<[^>]+>/g, '').length);
      var checked_ids = [];
      //console.log($('#tree').jstree('get_checked',null,true));
      document.getElementById('catpro').value = $('#tree').jstree('get_checked',null,true);
    // Submit the form
    document.forms[0].submit();
}
(function( $ ){
  $.fn.confirmDelete = function (url,value) {
      //console.log(tr.data());
      swal({
        title: "บันทึกรายการ",
        text: "คุณต้องการบันทึกรายการนี้หรือไม่ ?",
        type: "warning",
        showCancelButton: true,
        showLoaderOnConfirm: true,
        confirmButtonColor: "#DD6B55",
        confirmButtonText: "บันทึก",
        cancelButtonText: "ยกเลิก",
        closeOnConfirm: false,
      }, function (isConfirm) {
        if (!isConfirm) return;
        $.ajax({
            url: url,
            type: "POST",
          data: {
            data: value
          },
          dataType: "html",
          success: function (result) {
            swal("สำเร็จ", "บันทีกรายการเรียบร้อยแล้ว", "success");
            console.log(result);
            $("#last-time").html('ล่าสุดเมื่อ '+result);
            $("#last-time").show();
           
          },
          error: function (xhr, ajaxOptions, thrownError) {
            swal("ไม่สำเร็จ ", "กรุณาบันทึกใหม่อีกครั้ง", "error");
          }
      });
    });
  };
})( jQuery );

$( document ).ready(function() {
  $( "#submitForm" ).click(function() {
  	$('#catpro').val($('#tree').jstree('get_checked',null,true));
    var url =  window.location.origin+'/technc/backend/web/index.php?r=product%2Fedit&lang='+$.url().param('lang')+'&product='+$.url().param('product');
    var value = $('#add-product').serializeArray();
    $(this).confirmDelete(url,value);
  });
 });