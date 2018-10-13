<div class="row">
	<div class="col-sm-8 col-sm-offset-2">
		<h1>Create Your Account</h1>
		<form action="/user/register" method="post">
			<div class="form-group <?= getError('first_name') ? 'has-error' : ''; ?>">
				<label for="first_name" class="control-label">
					First Name
				</label>
				<input type="text" name="first_name" class="form-control" value="<?= old('first_name') ?>">
				<?php if ($e = getError('first_name')) : ?>
					<p class="help-block"><?= $e; ?></p>
				<?php endif; ?>
			</div>
			<div class="form-group <?= getError('last_name') ? 'has-error' : ''; ?>">
				<label for="last_name" class="control-label">
					Last Name
				</label>
				<input type="text" name="last_name" class="form-control" value="<?= old('last_name') ?>">
				<?php if ($e = getError('last_name')) : ?>
					<p class="help-block"><?= $e; ?></p>
				<?php endif; ?>
			</div>
			<div class="form-group <?= getError('email') ? 'has-error' : ''; ?>">
				<label for="email" class="control-label">
					Email
				</label>
				<input type="text" name="email" class="form-control" value="<?= old('email') ?>">
				<?php if ($e = getError('email')) : ?>
					<p class="help-block"><?= $e; ?></p>
				<?php endif; ?>
			</div>
			<div class="form-group <?= getError('password') ? 'has-error' : ''; ?>">
				<label for="password" class="control-label">
					Password
				</label>
				<input type="password" name="password" class="form-control">
				<?php if ($e = getError('password')) : ?>
					<p class="help-block"><?= $e; ?></p>
				<?php endif; ?>
			</div>
			<div class="form-group <?= getError('confirm_password') ? 'has-error' : ''; ?>">
				<label for="confirm_password" class="control-label">
					Confirm Password
				</label>
				<input type="password" name="confirm_password" class="form-control">
				<?php if ($e = getError('confirm_password')) : ?>
					<p class="help-block"><?= $e; ?></p>
				<?php endif; ?>
			</div>
			<input type="submit" value="Register" class="btn btn-success">
		</form>
	</div>
</div>
