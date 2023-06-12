$(document).ready(function() {
    $("#uploadBtn").click(function() {
        var formData = new FormData($('#data')[0]);
        $.ajax({
            url: "post/image-uploader.php?filename=" + filename,
            type: 'POST',
            data: formData,
            xhr: function() {
                var xhr = new window.XMLHttpRequest();
                xhr.upload.addEventListener("progress", function(evt) {
                    if (evt.lengthComputable) {
                        var percentComplete = evt.loaded / evt.total;
                        console.log(percentComplete);
                        $('#progressBar').val(Math.round(percentComplete * 100));
                    }
                }, false);
                return xhr;
            },
            success: function(result) {
            	console.log(result);
				var res = JSON.parse(result);
				if (res.status == true) {
					$("#imageErr").html("");
					var l = res.link;
					var id = res.id;
					var addImg = '<div class="image-edit-box" id="'+ id +'"><div class="image-edit-trash" onclick="delImg(\''+ id +'\')"><i class="fa fa-trash"></i></div><img class="image-edit-preview" src="../product-images/'+ l +'"></div>';

					var addImgCheck = '<input type="checkbox" name="images[]" value="'+ l +'" id="img_check'+ id +'" style="display:none;" checked>';

					$('#imgPreview').innerHTML = $('#imgPreview').html(addImg + $('#imgPreview').html());
					$('#img_checks').innerHTML = $('#img_checks').html($('#img_checks').html() + addImgCheck);

					filename = res.newname;
					$("#fileId").val("");


				}else{
					$("#imageErr").html(res.error);
				}

            },
	        error : function(){
	            if (textStatus === "abort"){
	                console.log('aborted');
	            }
	        },
            cache: false,
            contentType: false,
            processData: false
        });
        return false;
    });
});

function delImg(e, dv){
	$.post("post/image-uploader", {deleteImage: e}, function(result){
	});
}


function setImg(e, id){
	console.log(id);
	$("#featured_image").val(e);
	$(".set-featured-img").removeClass("setted-featured-img");
	$("#set"+id).addClass("setted-featured-img");
}


$('#add-btn').on('click', function(){
	var stuff = $('#feature').val();

	var add = '<div class="product-feature" id="feature'+ stuff_cn +'">' + stuff + '<i onclick="delFeat(\''+ stuff_cn +'\')">x</i></div><input type="checkbox" name="tags[]" value="'+ stuff +'" id="fea_check'+ stuff_cn +'" style="display:none;" checked>';

	stuff_cn++;

	$('#features').innerHTML = $('#features').html($('#features').html() + add);

	$('#feature').val('');


});

function delFeat(e){
	$('#feature'+e).remove();
	$('#fea_check'+e).remove();
};
