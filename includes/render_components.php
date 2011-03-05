<?php if ($on_facebook_tab) { ?>
	<div id="messagespc">
		<?php
		if ($fb_signed_request['page']['id'] == FACEBOOK_FANPAGE_ID) {
			if ($fb_signed_request['page']['liked']) {
				$_SESSION['fb_reports_liked'] = true;
				echo '<p>' . str_replace("'","\'",ISAFAN_MESSAGE) . '</p>' .
				'<a href="claimasset.php?approot=' . $currenturl . '" class="biglink">' . DOWNLOAD_TITLE . '</a>' .
				'<p class="smallmessage">' .
				'<br />Enjoy it, and <a id="fbsharelink" href="http://www.facebook.com/sharer.php?u=' . urlencode($currenturl) . '">please share</a>!</p>';
			} else {
				$_SESSION['fb_reports_liked'] = false;
				echo '<span class="alert">To get your download please "like" this page by hitting the like button near the title.</span>';
			}
		} else {
			echo 'Get your download at <a href="'. FACEBOOK_FANPAGE_URL . '" target="_new">The ' . FACEBOOK_FANPAGE_NAME . ' page</a>.';
		}
		?>
	</div>
<?php } else { ?>
	<div id="likespc">
		<fb:like-box profile_id="<?php echo FACEBOOK_FANPAGE_ID; ?>" width="300" stream="0" header="0" connections="0" logobar="0"></fb:like-box>
	</div>
	<div id="messagespc"><div id="fb-message"></div></div>
<?php } ?>