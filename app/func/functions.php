<?php 
/*
	Write global functions here...
*/
// Example :
function page($_page, $data = [], $title = '')
{
	$position = get_session('user')['LevelP'];
	if($position == 'admin'){
		view('ui/admin-header.pie', [ 'title' => $title] );
	}else if($position == 'pengelola'){
		view('ui/pengelola-header.pie', [ 'title' => $title] );
	}else{
		view('ui/anggota-header.pie', [ 'title' => $title] );
	}
	view($_page, $data);
	view('ui/footer.pie');
}
// Get page as string
function get_page($_page, $data = [])
{
	return get_view($_page, $data);
}
function app_name()
{
	return config('app_name');
}
function debug($var)
{
	echo('<pre>');
	var_dump((is_string($var) ? htmlspecialchars($var) : $var));
	echo('</pre><br />');
}

function test($var, $name='Test')
{
	echo $name;
	debug($var);
	die();
}
function auth($direct = false)
{
	if(exist_session('user')){
		if($direct){
			$position = get_session('user')['position'];
			if ($position == 'admin') 
				redirect('admin');
			else if($position == 'guru')
				redirect('main');
			else
				redirect('siswa');
		}
	}else{
		if(!$direct)
			redirect('login');
	}
}
function unregis_sw()
{
	echo '<script> var redirect = () => { window.location = \''.site('login').'\'; } </script>';
	echo '<script src="/unregis-sw.js"></script>';
}
function logout()
{
	unset_session('user');
	auth();
}
function nav_active($selected, $expect)
{
	return strtolower($selected) == strtolower($expect) ? 'active' : STRING_EMPTY;
}
function getUser($name = STRING_EMPTY)
{
	$data = [];
	$user = get_session('user');
	if(isset($user['LevelP'])){
		$position = $user['LevelP'];

		if ($position == 'admin') {
			$data['name'] = $user['NamaP'];
		}else{
			$data['name'] = $user['NamaA'];
		}
	}
	$user['name'] = $data['name'];
	if(isset($user[$name]))
		return $user[$name];
	else
		return $user;
}
function set_error($message = STRING_EMPTY)
{
	if(string_empty($message))
		$message = 'Terjadi Kesalahan. Silahkan periksa kembali.';
	set_flash('error', '<div class="alert alert-danger">'.$message.'</div>');
}