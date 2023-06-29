<?php
/**
 * document submission
 *
 * @package Tutor\Templates
 * @subpackage Dashboard\Document_Submission
 * getMemberField($user_id,$key)
 */
$current_user = wp_get_current_user();

//echo 'Username: '.$current_user->user_login;
//echo 'User ID: '.$current_user->ID;
//echo 'User Email: '.$current_user->user_email;
//echo 'User First Name: '.$current_user->user_firstname;
//echo 'User Last Name: '.$current_user->user_lastname;
//echo 'User Display Name: '.$current_user->display_name;
//%7$s
//
$forms = getGravityFormsByCategory(); 
$user_id = $current_user->ID;
$member_level = getMemberLevel();
$educator_id = getMemberField($user_id,'educator_id');
$educator = getMemberField($user_id,'educator_name');
$program_name = getMemberField($user_id,'program_name');							  
$coach = $current_user->display_name;
$todays_date = date("m/d/Y");

//echo $field_values;
?>
<h2>Document Forms</h2>
<div class="tutor-dashboard-content-inner document-submission">
	<div class="tutor-mb-32">
		<ul class="tutor-nav" tutor-priority-nav="">
			<li class="tutor-nav-item"><a class="tutor-nav-link is-active" href="/dashboard/document_submission">Documents</a></li>							
			<li class="tutor-nav-item"><a class="tutor-nav-link" href="/dashboard/document_submission/submissions">Submissions</a></li>
		</ul>
	</div>
<?php if ($educator_id!=='' && $educator !=='' && $program_name !==''){ ?>
	<ul>
		<?php for ($i=0; $i<count($forms); $i++){
		$form_id = $forms[$i]["id"];
		echo sprintf(
		'<li><a href="#" class="modal-button">%1$s</a>
		<div class="modal hide">  
		    <div class="modal-dialog">
				<div class="modal-content">
					<div class="modal-header">
						%1$s
						<a href="#" class="close-button">
							<i class="far fa-times"></i>
						</a>
					</div>
					<div class="modal-body">				
						%2$s
					</div>
				</div>
            </div>  
		</div></li>',				
        ($i+1).'. '.$forms[$i]["title"],
        do_shortcode('[gravityform id="'.$form_id.'" field_values="educator_id=' . $educator_id . '&educator=' . $educator . '&program_name='.$program_name.'&coach='.$coach.'&date=' .$todays_date .'" title="false"]')
		);
	}?>	
	</ul>
<?php 
																	  } ?>
</div>	

<script>
jQuery(document).ready(function($){
	$(".modal-button").on("click",function(e){
		e.preventDefault();
		$(this).next('.modal').toggleClass("show").toggleClass("hide");
	});
	
	$('body').on("click","a.close-button",function(e){
		e.preventDefault();
		$('.modal').addClass('hide');
	});
	$(".gfield-choice-input").on("change",function(){
		//resize window when someone changes the thang.
		$(".modal-dialog").height($(document).height());
		
	});
/*	$(document).on('gform_post_render', function(){
         $(".gf_readonly input").prop('disabled',true);
   });
	
	$(document).on('gform_pre_submission',function(){
		$(".gf_readonly input").prop('disabled',false);
	});
*/
});
</script>
