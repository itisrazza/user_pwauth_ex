<?php

/**
 * Nextcloud UNIX Authenticator
 *
 * @author C. Véret, Raresh Nistor
 * @copyright 2012 C. Véret veretcle+owncloud@mateu.be
 *
 */

namespace OCA\UserPwauthEx;

class UserPwauth extends \OC\User\Backend implements \OCP\UserInterface {
  protected $pwauth_bin_path;
  protected $pwauth_uid_list;
  private $user_search;

  // Constructior
  public function __construct() {
    $config = \OC::$server->getConfig();
    $this->pwauth_bin_path = $config->getAppValue('user_pwauth', 'pwauth_path');
    $list = explode(";", $config->getAppValue('user_pwauth', 'uid_list'));
    $r = array();
    
    foreach($list as $entry) {
      if(strpos($entry, '-') === FALSE) {
        $r[] = $entry;
      } else {
        $range = explode('-', $entry); 
        if($range[0] < 0) { $range[0] = 0; }
        if($range[1] < $range[0]) { $range[1] = $range[0]; }

        for($i = $range[0]; $i <= $range[1]; $i++) {
          $r[] = $i;
        }	
      }
    }

    $this->pwauth_uid_list = $r;
  }
   
 /**
  * Returns implemented actions
  */   
  public function implementsAction($actions) {
    return (bool)((OC_USER_BACKEND_CHECK_PASSWORD) & $actions);
  }
      
  /**
   * ???
   */
  private function userMatchesFilter($user) {
    return (strripos($user, $this->user_search) !== false);
  }

  /**
   * Remove user
   */
  public function deleteUser($_uid) {
    // Can't delete user
    OC::$server->getLogger()->notice(
      "Notice: Deleting a UNIX user from Nextcloud will only remove their data. To delete them, run `userdel $username` as root.",
      ['app' => 'user_pwauth_ex']
    );
    return false;
  }

  /**
   * Check user's password
   */
  public function checkPassword($uid, $password) {
          $uid = strtolower($uid);
          
          $unix_user = posix_getpwnam($uid);
          
          // checks if the Unix UID number is allowed to connect
          if(empty($unix_user)) return false; //user does not exist
          if(!in_array($unix_user['uid'], $this->pwauth_uid_list)) return false;

          $handle = popen($this->pwauth_bin_path, 'w');
          if ($handle === false) {
            // Can't open pwauth executable
            OC::$server->getLogger()->alert(
              'Cannot open pwauth, check that it is installed on server.',
              ['app' => 'user_pwauth_ex']
            );
                  
            return false;
          }
          if (fwrite($handle, "$uid\n$password\n") === false) {
                  // Can't pipe uid and password
                  return false;
          }
          # Is the password valid?
          $result = pclose( $handle );
          if (0 === $result){
                  return $uid;
          }

          return false;
  }

  /**
   * Check user's existence
   */
  public function userExists($uid){
          $user = posix_getpwnam( strtolower($uid) );
          return is_array($user);
  }
  
  /*
  * this is a tricky one : there is no way to list all users which UID > 1000 directly in PHP
  * so we just scan all UIDs from $pwauth_min_uid to $pwauth_max_uid
  *
  * for OC4.5.* this functions implements limitation and offset via array_slice and search via array_filter using internal function userMatchesFilter
  */
  public function getUsers($search = '', $limit = 10, $offset = 10){
    $returnArray = array();
    
    foreach($this->pwauth_uid_list as $f) {
      if(is_array($array = posix_getpwuid($f))) {
        $returnArray[] = $array['name'];
      }
    }
    
    $this->user_search = $search;
    if(!empty($this->user_search)) {
      $returnArray = array_filter($returnArray, array($this, 'userMatchesFilter'));
    } 

    if($limit = -1)
      $limit = null;
    
    return array_slice($returnArray, $offset, $limit);
  }
  
  /**
   * Gets user's name
   */
  public function getDisplayName($uid) {
    $userInfo = posix_getpwnam($uid);
    if ($uid === null) {
      return $uid;
    }
    return explode(',', $userInfo['gecos'])[0];
  }
}

?>
