<?php
class UserLogin {
    private $_db,
            $_data,
            $_sessionName,
            $_cookieName,
            $isLoggedIn;

    public function __construct($user = null) {
        $this->_db = DB::getInstance();
        $this->_sessionName = Config::get('sessions/session_name');
        $this->_cookieName = Config::get('remember/cookie_name');

        if(!$user) {
            if(Session::exists($this->_sessionName)) {
                $user = Session::get($this->_sessionName);

                if($this->find($user)) {
                    $this->isLoggedIn = true;
                } else {
                    //Logout
                }
            }
        } else {
            $this->find($user);
        }
    }

    public function create($fields = array()) {
        if(!$this->_db->insert('userlogin', $fields)) {
            throw new Exception('Sorry, there was a problem creating your account;');
        }
    }

    public function update($fields = array(), $id = null) {

        if(!$id && $this->isLoggedIn()) {
            $id = $this->data()->id;
        }

        if(!$this->_db->update('userlogin', $id, $fields)) {
            throw new Exception('There was a problem updating');
        }
    }

    public function find($user = null) {
        if($user) {
            $field = (is_numeric($user)) ? 'id' : 'username';
            $data = $this->_db->get('userlogin', array($field, '=', $user));

            if($data->count()) {
                $this->_data = $data->first();
                return true;
            }
        }
        return false;
    }

    public function login($username = null, $password = null, $permission) {
        if(!$username && !$password && $this->exists()) {
            Session::put($this->_sessionName, $this->data()->id);
            return true;
        } else {
            $user = $this->find($username);
            if ($user && $permission == $this->data()->permission) {
                if ($this->data()->current_session == 0 && $this->data()->password === Hash::make($password)) {
                    Session::put($this->_sessionName, $this->data()->id);
                    return true;
                } else {
                    if ($this->data()->current_session == 1) {
                        Session::flash('LoginError', 'Your account has been deactivated. Please contact the administrator.');
                    } else {
                        Session::flash('IncorrectPass', 'Incorrect username or password.');
                    }
                }
            } else {
                Session::flash('LoginError', 'The login details that you have provided did not match the permission you have selected.');
            }
        }
        return false;
    }
    
	
	public function isSuperAdmin() {
        $group = $this->_db->get('groups', array('id', '=', $this->data()->permission));
		
		foreach($group->results() as $group){
			if ($group->is_admin == true){
				return true;
			}
		}
		return false;
    }

    public function isAdmin() {
        $group = $this->_db->get('groups', array('id', '=', $this->data()->permission));
		
		foreach($group->results() as $group){
			if ($group->permission == 'is_admin'){
				return true;
			}
		}
		return false;
    }

    public function isCollegeStaff() {
        $group = $this->_db->get('groups', array('id', '=', $this->data()->permission));
		
		foreach($group->results() as $group){
			if ($group->permission == 'is_colibrary_staff'){
				return true;
			}
		}
		return false;
    }
	
	public function isHighSchoolStaff() {
        $group = $this->_db->get('groups', array('id', '=', $this->data()->permission));
		
		foreach($group->results() as $group){
			if ($group->permission == 'is_hslibrary_staff'){
				return true;
			}
		}
		return false;
    }
	
	public function isElementaryStaff() {
        $group = $this->_db->get('groups', array('id', '=', $this->data()->permission));
		
		foreach($group->results() as $group){
			if ($group->permission == 'is_elemlibrary_staff'){
				return true;
			}
		}
		return false;
    }

    public function isStudent() {
        $group = $this->_db->get('groups', array('id', '=', $this->data()->permission));
		
		foreach($group->results() as $group){
			if ($group->permission == 'is_student'){
				return true;
			}
		}
		return false;
    }

    public function isTeacher() {
        $group = $this->_db->get('groups', array('id', '=', $this->data()->permission));
		
		foreach($group->results() as $group){
			if ($group->permission == 'is_teacher'){
				return true;
			}
		}
		return false;
    }
	
    public function exists() {
        return (!empty($this->_data)) ? true : false;
    }

    public function logout() {
        $this->_db->delete('users_session', array('user_id', '=', $this->data()->id));

        Session::delete($this->_sessionName);
        Cookie::delete($this->_cookieName);
    }

    public function data(){
        return $this->_data;
    }

    public function isLoggedIn() {
        return $this->isLoggedIn;
    }

    public function getUserSession($username) {
        $user = $this->find($username, 'username');
        if ($user) {
            return $user->current_session;
        } else {
            return null;
        }
    }
}