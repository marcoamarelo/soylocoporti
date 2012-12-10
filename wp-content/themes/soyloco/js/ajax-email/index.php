<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN"
	"http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">

<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
<head>
	<title>Ajax contact form</title>
	<link href="style.css" rel="stylesheet" type="text/css" />
	<script type="text/javascript" src="mootools.js"></script>
	<script type="text/javascript">
		window.addEvent('domready', function(){
			$('myForm').addEvent('submit', function(e) {

			new Event(e).stop();
			var log = $('log_res').empty().addClass('ajax-loading');
			this.send({
				update: log,
				onComplete: function() {
					log.removeClass('ajax-loading');
				}
			});
			});		
		});
	</script>
</head>
<body>
	<div id="log">
	<div id="log_res">
		<!-- spanner -->
	</div>
	</div>
	<form id="myForm" action="send.php" method="get" name="myForm">
	<div id="form_box">
		<div>
			<p>
				First Name:
			</p><input type="text" name="first_name" value="" />
		</div>
		<div>
			<p>
				Last Name:
			</p><input type="text" name="last_name" value="" />
		</div>
		<div>
			<p>
				E-Mail:
			</p><input type="text" name="e_mail" value="" />
		</div>
		<div>
			<p>
				Message:
			</p><textarea name="message" cols="40" rows="5"></textarea>
		</div>
		<div class="hr">
			<!-- spanner -->
		</div><input type="submit" name="button" id="submitter" /></div>
	</form>
</body>
</html>