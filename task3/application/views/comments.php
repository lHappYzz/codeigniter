<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport"
		  content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
	<meta http-equiv="X-UA-Compatible" content="ie=edge">
	<title>Comments</title>
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" integrity="sha384-JcKb8q3iqJ61gNV9KGb8thSsNjpSL0n8PARn9HuZOnIxN0hoP+VmmDGMN5t9UJ0Z" crossorigin="anonymous">
</head>
<body>
	<div class="container mt-3">
		<?= validation_errors(); ?>

		<?php echo form_open('/comments/create', array('method' => 'post')); ?>
		<div class="form">
			<div class="heading">
				<p>Write your comment</p>
			</div>

			<div class="form-row mb-3">
				<div class="col-md-6">
					<input type="text" class="form-control" name="creator_name" placeholder="Name">
				</div>
				<div class="col-md-6">
					<input type="email" required class="form-control" name="creator_email" placeholder="Email">
				</div>
			</div>
			<div class="form-row">
				<div class="col-md-12 ">
					<textarea required class="form-control" name="text" id="text" cols="30" rows="5" placeholder="Text"></textarea>
				</div>
			</div>
			<div class="form-group" style="display: flex; justify-content: flex-end">
				<button class="btn btn-primary mt-3" type="submit">New comment</button>
			</div>
		</div>
		<?= form_close(); ?>

		<? foreach ($comments as $comment) : ?>
			<div class="comment-item mb-3">
				<hr>
				<div class="comment-info mb-2">
					<div class="creator" style="display: inline-block">
						<?= $comment->creator_name ?>
					</div>
					<div class="created" style="display: inline-block; float: right">
						<?= date('d.m.Y H:i', strtotime($comment->created_at)) ?>
					</div>
				</div>
				<div class="comment-text">
					<?= $comment->text ?>
				</div>
			</div>
		<? endforeach; ?>
		<?= $links ?>
	</div>
</body>
</html>
