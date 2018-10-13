<?php

function redirect($url)
{
	header('Location: ' . $url);
}

function print_with_template(string $page, string $title = 'My App')
{
	ob_start();
	require_once(path('core/templates/main.php'));
	$template = ob_get_clean();
	$page = str_replace('@content', $page, $template);
	$page = str_replace('@title', $title, $page);
	return $page;
}

function insert(string $table, array $attributes)
{
	$columns = implode(', ', array_keys($attributes));
	$values = implode(', ', array_map(function($item) {
		return '"' . $item . '"';
	}, $attributes));
	safe_query("INSERT INTO $table ($columns) VALUES ($values)");
}

function abort($status_code, $message)
{
	http_response_code($status_code);
	echo print_with_template("<h1>$message</h1>", "$status_code $message");
	exit;
}

function safe_query($sql)
{
	global $database_connection;
	$result = mysqli_query($database_connection, $sql);
	if (mysqli_error($database_connection)) {
		abort(500, mysqli_error($database_connection));
	}
	return $result;
}

function validate($data, $rules)
{
	$errors = [];
	foreach ($data as $field => $value) {
		if (isset($rules[$field])) {
			$fieldErrors = validateField($field, $rules[$field], $data);
			if (!empty($fieldErrors)) {
				$errors[$field] = $fieldErrors;
			}
		}
	}
	if (!empty($errors)) {
		session_flush('errors', $errors);
		session_flush('old', $data);
		redirect(session_get('previous_url'));
		exit;
	}
	return true;
}

function getErrorMessage($field, $rule, $attributes)
{
	$messages = [
		'required' => "The field :field is required",
		'min' => "The field :field must be at least :attribute characters long",
		'max' => "The field :field must be no longer than :attribute characters long",
		'email' => "The field :field is not a valid email address",
		'phone' => "The field :field is not a valid phone number",
		'confirmed' => "The :field confirmation does not match",
		'unique' => "The :field is already in use",
	];
	if (isset($messages[$rule])) {
		$message = $messages[$rule];
		$message = str_replace(':field', $field, $message);
		if (!empty($attributes)) {
			$message = str_replace(':attribute', $attributes[0], $message);
		}
		return $message;
	}
}

function validateField(string $field, string $rules, array $data)
{
	$rules = explode('|', $rules);
	$errors = [];
	foreach ($rules as $rule) {
		$ruleWithAttributes = explode(':', $rule);
		$ruleName = $ruleWithAttributes[0];
		$attributes = count($ruleWithAttributes) > 1 ? explode(',', $ruleWithAttributes[1]) : [];
		$success = validateFieldRule($field, $ruleName, $attributes, $data);
		if (!$success) {
			$errors[] = getErrorMessage($field, $ruleName, $attributes);
		}
	}
	return $errors;
}

function validateFieldRule($field, $ruleName, $attributes, $data)
{
	switch ($ruleName) {
		case 'required':
			return !empty($data[$field]);
			break;
		case 'min':
			return isset($data[$field]) && strlen($data[$field]) >= $attributes[0];
			break;
		case 'max':
			return isset($data[$field]) && strlen($data[$field]) <= $attributes[0];
			break;
		case 'email':
			$pattern = "/\b[\w\.-]+@[\w\.-]+\.\w{2,4}\b/";
			preg_match($pattern, $data[$field], $matches);
			return count($matches) > 0;
			break;
		case 'phone':
			$pattern = "/\+(9[976]\d|8[987530]\d|6[987]\d|5[90]\d|42\d|3[875]\d|2[98654321]\d|9[8543210]|8[6421]|6[6543210]|5[87654321]|4[987654310]|3[9643210]|2[70]|7|1)\d{1,14}$/";
			preg_match($pattern, $data[$field], $matches);
			return count($matches) > 0;
			break;
		case 'confirmed':
			return isset($data[$field]) && isset($data['confirm_' . $field]) && $data[$field] == $data['confirm_' . $field];
			break;
		case 'unique':
			$table = $attributes[0];
			$column = $attributes[1];
			$value = $data[$field];
			$sql = "SELECT * FROM $table WHERE $column = '$value'";
			return empty(mysqli_fetch_assoc(safe_query($sql)));
			break;
		default:
			break;
	}
}

function getOldFields()
{
	return session_get('old');
}

function old($field)
{
	if (!empty(getOldFields()[$field])) {
		return getOldFields()[$field];
	}
}

function getErrors()
{
	return session_get('errors');
}

function getError($field)
{
	if (!empty(getErrors()[$field])) {
		return getErrors()[$field][0];
	}
	return false;
}

function session_set($key, $value)
{
	if (is_array($value) || is_object($value)) {
		$value = json_encode($value);
	}
	$_SESSION[$key] = $value;
}

function session_get($key)
{
	$value = !empty($_SESSION[$key]) ? $_SESSION[$key] : ($_SESSION['flush'][$key] ? $_SESSION['flush'][$key] : null);
	if (json_decode($value)) {
		$value = json_decode($value, true);
	}
	return $value;
}

function session_flush($key, $value)
{
	$flushed = session_get('flush');
	$flushed = empty($flushed) ? [] : $flushed;
	$flushed[$key] = $value;
	session_set('flush', $flushed);
}