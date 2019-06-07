$(document).ready(function(){	
	var user_href,
			user_href_spiltted,
			user_id;
	var img_src,
			img_src_spiltted,
			img_name;

	var photo_id; 		
	$('.modal-photo').click(function(){
		$('#set-user-image').prop('disabled', false);
		//Pull User Id
		user_href = $('#user-id').prop('href');
		user_href_spiltted = user_href.split('=');
		user_id = user_href_spiltted[user_href_spiltted.length-1];

		//Pull Img Id
		img_src = $(this).prop('src');
		img_src_spiltted = img_src.split('/');
		img_name = img_src_spiltted[img_src_spiltted.length-1];

		photo_id  = $(this).attr('data');

		$.ajax({
			url: "includes/ajax_code.php",
			data: {photo_id:photo_id},
			type: 'POST',
			success:function(data){
				if (!data.error) {
					$('#modal-sidebar').html(data);
				}
			}
		})
		
	});



	//Update User Photo By Ajax
	$('#set-user-image').click(function(){
		$.ajax({
			url: "includes/ajax_code.php",
			data: {user_id:user_id, img_name:img_name},
			type: 'POST',
			success:function(data){
				if (!data.error) {
					$('.user-img-box a img').prop('src', data);
				}
			}
		})
	});
		
		//Confirm Delete Action
		$('.delete').click(function(){
			 return confirm('Are you sure');
		});

		//Edit Page
		$('.info-box-header').click(function(){
			$('.inside').slideToggle('fast');
			$('.info-box-header i').toggleClass("fas fa-angle-down float-right , fas fa-angle-up float-right");
		});

		tinymce.init({ selector:'textarea' });
})