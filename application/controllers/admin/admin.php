<?php
  /* meera april 2014
  admin controller exists
  1. user manager (create, edit, view, changepassowrd)
  2. admin manager (create, edit, view, changepassowrd)
  3. login, forgot password, resetpassword
  4. if user or admin exists
  */
  if ( !defined( 'BASEPATH' ) )
      exit( 'No direct script access allowed' );
  class Admin extends CI_Controller {
      public function __construct( ) {
          parent::__construct();
          $this->load->model( array(
               'admin/admin_model'
              
          ) );
          $this->load->library( array(
               'corefunctions',
              'securimage/securimage',
              'hedercontroller' 
          ) );
		  $this->load->library('migration');
			if ( ! $this->migration->current()) {
			  show_error($this->migration->error_string());
			} 
      }
      /*
      For remapping meera 
      check if a function exists
      or else redirect to 404
      */
      public function _remap( $method, $params = array( ) ) {
          if ( method_exists( __CLASS__, $method ) ) {
              $args = array_slice( $this->uri->rsegments, 2 );
              if ( method_exists( $this, $method ) ) {
                  return call_user_func_array( array(
                       &$this,
                      $method 
                  ), $args );
              }
          } else {
              redirect( base_url() . '404' );
              exit( );
          }
      }
      /*
      For remapping meera end 
      */
      /*
      Login
      Forgotpassword
      and resetpassword starts meera april 4 2014
      */
      public function index( ) {
		  
          if ( $this->session->userdata( 'adminKey' ) ) {
              redirect( base_url( ADMIN . '/adminmanager' ) );
          }
          $data[ 'title' ] = TITLE . 'Login';
          if ( $this->input->post( 'Login' ) == '1' ) {
              $data[ 'haserror' ] = FALSE;
              $data[ 'errormsg' ] = '';
              $this->form_validation->set_rules( 'password', 'Password', 'required' );
              $this->form_validation->set_rules( 'email', 'Email', 'required|valid_email' );
              if ( $this->form_validation->run() === TRUE ) {
                  $password  = $this->corefunctions->passwordencrypt( $this->input->post( 'password' ) ); //encrypt password using pwd constant
                  $loginData = $this->admin_model->check_login_creds( $this->input->post( 'email' ), $password ); //get admin details
                  if ( $loginData ) {
                      if ( $loginData[ 'imgkey' ] != NULL ) {
                          $img = base_url( $this->corefunctions->getMyPath( $loginData[ 'adminid' ], $loginData[ 'imgkey' ], $loginData[ 'imgext' ], "assets/admin/profImgs/crop/" ) );
                      } else {
                          $img = base_url( "images/defltimg.png" );
                      }
                      if ( $loginData[ 'status' ] == '1' ) {
                          $set_sesion = array(
                               'adminId' => $loginData[ 'adminid' ],
                              'adminKey' => $loginData[ 'adminkey' ],
                              'adminFirstname' => $loginData[ 'firstname' ],
                              'adminLastname' => $loginData[ 'lastname' ],
                              'adminImage' => $img 
                          );
                          $this->session->set_userdata( $set_sesion );
                          $this->admin_model->update_lastlogin( $loginData[ 'adminid' ] ); //update last Login time
                          redirect( base_url( ADMIN.'/adminmanager' ) );
                          exit;
                      } else {
                          $data[ 'haserror' ] = TRUE;
                          $data[ 'errormsg' ] = "Invalid email or password";
                      }
                  } else {
                      $data[ 'haserror' ] = TRUE;
                      $data[ 'errormsg' ] = "Invalid email or password.";
                  }
              } else {
                  $data[ 'haserror' ] = TRUE;
                  $data[ 'errormsg' ] = "Please enter a valid email and password.";
              }
          }
          $this->load->view( 'admin/login', $data );
      }
      public function logout( ) {
          $newdata = array(
               'adminId' => '',
              'adminKey' => '',
              'adminFirstname' => '',
              'adminLastname' => '',
              'adminprofImg' => '',
              'adminImage' => '' 
          );
          $this->session->sess_destroy();
          $se = $this->session->all_userdata();
          redirect( base_url( ADMIN ) );
      }
      public function forgotpassword( ) {
          $data[ 'title' ] = TITLE . 'Forgot Password';
          if ( $this->input->post( 'fogot' ) == '1' ) {
              $this->form_validation->set_rules( 'email', 'Email', 'required|valid_email' );
              $this->form_validation->set_rules( 'captcha_code', 'Security Code', 'required|xss_clean' );
              if ( $this->form_validation->run() === FALSE ) {
                  $data[ 'haserror' ] = TRUE;
                  $data[ 'errormsg' ] = "Please enter required details";
              } else if ( $this->securimage->check( $this->input->post( 'captcha_code' ) ) == false ) {
                  $data[ 'haserror' ] = TRUE;
                  $data[ 'errormsg' ] = "Please enter correct security code";
              } else {
                  $adminData = $this->admin_model->check_admin_by_email( $this->input->post( 'email' ) ); //get details by email
                  if ( !$adminData ) {
                      $data[ 'haserror' ] = TRUE;
                      $data[ 'errormsg' ] = "Your email address is invalid.";
                  } else if ( $adminData[ 'status' ] == '0' ) {
                      $data[ 'haserror' ] = TRUE;
                      $data[ 'errormsg' ] = "Your account is Inactive";
                  } elseif ( $adminData ) {
                      $mailKey = $this->corefunctions->generateUniqueKey( '12', 'admins', 'passwrdkey' );
                      $this->admin_model->update_passwordkey( $adminData[ 'adminid' ], $mailKey ); //update passwordkey for resetting
                      $data[ 'resUrl' ]    = base_url( ADMIN . "/resetpassword/" . $mailKey );
                      $data[ 'firstname' ] = $adminData[ 'firstname' ];
                      $data[ 'lastname' ]  = $adminData[ 'lastname' ];
                      $msg                 = $this->load->view('admin/mail/forgotmail', $data, true );
                      if ( $this->corefunctions->sendmail( ADMINEMAIL, $adminData[ 'email' ], 'The Lessner Plumbing :: Password Recovery', $msg ) );
                      $data[ 'hasSucess' ] = TRUE;
                      $data[ 'Sucessmsg' ] = "The information to reset the password has been sent your email. Thank you!";
                  }
              }
          }
          $this->load->view( 'admin/forgotpassword', $data );
      }
      public function resetpassword( $recoverKey ) {
          if ( !isset( $recoverKey ) ) {
              redirect( base_url( ADMIN ) );
          }
          $data[ 'title' ] = TITLE . 'Reset Password';
          $recoverData     = $this->admin_model->recoverkey_exists( $recoverKey ); //check passwordkey exists
          if ( !$recoverData ) {
              redirect( base_url( ADMIN ) );
          }
          if ( $this->input->post( 'reset' ) == '1' ) {
              $this->form_validation->set_rules( 'newpassword', 'New Password', 'required|min_length[3]' );
              $this->form_validation->set_rules( 'repassword', 'Confirm Password', 'required|matches[newpassword]|min_length[3]' );
              if ( $this->form_validation->run() === TRUE ) {
                  if ( $this->input->post( 'newpassword' ) == $this->input->post( 'repassword' ) ) {
                      if ( $recoverData[ "status" ] == "1" ) {
                          $this->admin_model->update_passwordkey( $recoverData[ 'adminid' ], "" ); //update key with null data
                          $password = $this->corefunctions->passwordencrypt( $this->input->post( 'newpassword' ) );
                          $this->admin_model->update_password( $recoverData[ 'adminid' ], $password ); //update new password
                          $data[ 'hasSucess' ] = TRUE;
                          $data[ 'Sucessmsg' ] = "Your password has been reset.";
                      } else {
                          $data[ 'haserror' ] = TRUE;
                          $data[ 'errormsg' ] = "Your Account is Inactive.";
                      }
                  } else {
                      $data[ 'haserror' ] = TRUE;
                      $data[ 'errormsg' ] = "Your passwords do not match. Please check and try again.";
                  }
              } else {
                  $data[ 'haserror' ] = TRUE;
                  $data[ 'errormsg' ] = "Please enter required details";
              }
          }
          $data[ 'recoverKey' ] = $recoverKey;
          $this->load->view( 'admin/resetpassword', $data );
      }
      /*
      Login
      Forgotpassword
      and resetpassword ends
      */
      /*
      admin manager starts meera april 4 2014
      */
      public function adminmanager( $status = 'Active', $alpha = NULL ) {
          if ( !$this->session->userdata( 'adminKey' ) ) {
              redirect( base_url( ADMIN ) );
          }
          if ( $status == 'Active' )
              $stat = '1';
          elseif ( $status == 'Inactive' )
              $stat = '0';
          else
              $stat = '1';
          $Admins = $this->admin_model->all_admins( $stat, $alpha );
          if ( !empty( $Admins ) ) {
              foreach ( $Admins as $key => $admndtls ) {
                  if ( $admndtls[ 'imgkey' ] != NULL ) {
                      $Admins[ $key ][ 'profImg' ] = base_url( $this->corefunctions->getMyPath( $admndtls[ 'adminid' ], $admndtls[ 'imgkey' ], $admndtls[ 'imgext' ], "assets/admin/profImgs/crop/" ) );
                  } else {
                      $Admins[ $key ][ 'profImg' ] = base_url( "images/defltimg.png" );
                  }
              }
          }
          $breadcum[ ]           = array(
               "url" => base_url( ADMIN . '/adminmanager' ),
              "title" => 'Admins' 
          );
          $breadcum[ ]           = array(
               "title" => $status . ' Admins' 
          );
          $header[ 'breadcum' ]  = $breadcum;
          $header[ 'title' ]     = TITLE . 'Admin Manager';
          $header[ 'hederdata' ] = $this->hedercontroller->headerdata();
          $header[ 'titlecls' ]  = 'admin';
          $header[ 'createurl' ] = base_url() . ADMIN . '/createadmin';
          $header[ 'pagetitle' ] = 'Admins';
          $data[ 'pageHeader' ]  = $status . " Admins";
          $data[ 'Admins' ]      = $Admins;
          $data[ 'alpha' ]       = $alpha;
          $data[ 'status' ]      = $status;
          $this->load->view('admin/header', $header );
          $this->load->view('admin/admins/listing', $data );
          $this->load->view('admin/footer' );
      }
      public function changeadminstatus( ) {
          if ( !$this->session->userdata( 'adminKey' ) ) {
              $arr[ 'error' ] = 1;
              print json_encode( $arr );
              exit( );
          }
          if ( !$this->input->post( 'adminkey' ) or !$this->input->post( 'status' ) ) {
              $arr[ 'error' ] = 1;
              print json_encode( $arr );
              exit( );
          }
          if ( $this->input->post( 'act' ) == 'statchange' ) {
              if ( $this->input->post( 'status' ) == 'Activate' ) {
                  $stat = '1';
                  $st   = '0';
              } elseif ( $this->input->post( 'status' ) == 'Deactivate' ) {
                  $stat = '0';
                  $st   = '1';
              }
              $this->admin_model->change_admin_status( $this->input->post( 'adminkey' ), $stat );
              $arr[ 'success' ] = 1;
              print json_encode( $arr );
              exit( );
          }
      }
      public function createadmin( ) {
          if ( !$this->session->userdata( 'adminKey' ) ) {
              redirect( base_url( ADMIN ) );
              exit;
          }
          if ( $this->input->post( 'addAdmin' ) == '1' ) {
              $this->form_validation->set_rules( 'firstname', 'First Name', 'required|xss_clean' );
              $this->form_validation->set_rules( 'lastname', 'Last Name', 'required|xss_clean' );
              $this->form_validation->set_rules( 'password', 'Password', 'required|min_length[3]|xss_clean' );
              $this->form_validation->set_rules( 'address', 'Address', 'required|xss_clean' );
              $this->form_validation->set_rules( 'city', 'City', 'required|xss_clean' );
              $this->form_validation->set_rules( 'state', 'State', 'required|xss_clean' );
              $this->form_validation->set_rules( 'zip', 'Zip', 'required|xss_clean' );
              $this->form_validation->set_rules( 'phone', 'Phone', 'required|xss_clean' );
              $this->form_validation->set_rules( 'email', 'Email', 'required|valid_email|is_unique[admins.email]|xss_clean' );
              $this->form_validation->set_message( 'is_unique', 'Email ID already exists' );
              if ( $this->form_validation->run() === FALSE ) {
                  $data[ 'haserror' ] = TRUE;
                  $data[ 'errormsg' ] = "Please enter required details";
              } else {
                  $password            = $this->corefunctions->passwordencrypt( $this->input->post( 'password' ) );
                  $adminkey            = $this->corefunctions->generateUniqueKey( '12', 'admins', 'adminkey' );
                  $Id                  = $this->admin_model->create_admin( $adminkey, $password );
                  /*Send Mail starts here  */
                  $data[ 'firstname' ] = $this->input->post( 'firstname' );
                  $data[ 'lastname' ]  = $this->input->post( 'lastname' );
                  $data[ 'email' ]     = $this->input->post( 'email' );
                  $data[ 'password' ]  = $this->input->post( 'password' );
                  $msg                 = $this->load->view('admin/mail/createadminmail_byadmin', $data, true );
                  $recvrMail           = $this->input->post( 'email' );
                  $this->corefunctions->sendmail( ADMINEMAIL, $recvrMail, 'The Lessner Plumbing :: Account Registration', $msg );
                  /*Send Mail ends here  */
                  $data[ 'hasSucess' ] = TRUE;
                  $data[ 'email' ]     = $this->input->post( 'email' );
              }
          }
          $header[ 'titlecls' ]  = 'admin';
          $data[ 'states' ]      = $this->admin_model->get_states();
          $breadcum[ ]           = array(
               "url" => base_url( ADMIN . '/adminmanager' ),
              "title" => 'Admins' 
          );
          $breadcum[ ]           = array(
               "title" => 'Create Admin' 
          );
          $header[ 'breadcum' ]  = $breadcum;
          $header[ 'title' ]     = TITLE . 'Create Admin';
          $header[ 'hederdata' ] = $this->hedercontroller->headerdata();
          //$header[ 'createurl' ] = base_url() . ADMIN . '/createadmin';
          $header[ 'pagetitle' ] = 'Admins';
          $this->load->view('admin/header', $header );
          $this->load->view('admin/admins/create', $data );
          $this->load->view('admin/footer' );
      }
      public function editadmin( $adminkey = NULL ) {
          if ( !$this->session->userdata( 'adminKey' ) ) {
              redirect( base_url( ADMIN ) );
              exit;
          }
          if ( !$adminkey ) {
              redirect( base_url( ADMIN . '/adminmanager' ) );
              exit;
          }
          $admin_by_key = $this->admin_model->admin_by_key( $adminkey );
          if ( !$admin_by_key ) {
              redirect( base_url( ADMIN . '/adminmanager' ) );
              exit;
          }
          if ( $this->input->post( 'editadmin' ) == '1' ) {
              $this->form_validation->set_rules( 'firstname', 'First Name', 'required|xss_clean' );
              $this->form_validation->set_rules( 'lastname', 'Last Name', 'required|xss_clean' );
              $this->form_validation->set_rules( 'address', 'Address', 'required|xss_clean' );
              $this->form_validation->set_rules( 'city', 'City', 'required|xss_clean' );
              $this->form_validation->set_rules( 'state', 'State', 'required|xss_clean' );
              $this->form_validation->set_rules( 'zip', 'Zip', 'required|xss_clean' );
              $this->form_validation->set_rules( 'phone', 'Phone', 'required|xss_clean' );
              if ( $this->form_validation->run() === FALSE ) {
                  $data[ 'haserror' ] = TRUE;
                  $data[ 'errormsg' ] = "Please enter required details";
              } else {
                  $Id = $this->admin_model->admin_update_by_key( $adminkey );
                  redirect( base_url( ADMIN . '/adminmanager' ) );
                  exit;
              }
          }
          if ( $admin_by_key[ 'imgkey' ] ) {
              $admin_by_key[ 'profImg' ] = base_url( $this->corefunctions->getMyPath( $admin_by_key[ 'adminid' ], $admin_by_key[ 'imgkey' ], $admin_by_key[ 'imgext' ], "assets/admin/profImgs/crop/" ) );
          } else {
              $admin_by_key[ 'profImg' ] = base_url( "images/defltimg.png" );
          }
          $data[ 'AdminDet' ]    = $admin_by_key;
          $header[ 'titlecls' ]  = 'admin';
          $data[ 'states' ]      = $this->admin_model->get_states();
          $breadcum[ ]           = array(
               "url" => base_url( ADMIN . '/adminmanager' ),
              "title" => 'Admins' 
          );
          $breadcum[ ]           = array(
               "title" => 'Edit Admin' 
          );
          $header[ 'breadcum' ]  = $breadcum;
          $header[ 'title' ]     = TITLE . 'Edit Admin';
          $header[ 'hederdata' ] = $this->hedercontroller->headerdata();
          //$header[ 'createurl' ] = base_url() . ADMIN . '/createadmin';
          $header[ 'pagetitle' ] = 'Admins';
          $this->load->view('admin/header', $header );
          $this->load->view('admin/admins/edit', $data );
          $this->load->view('admin/footer' );
      }
      public function changeadminpasswrd( $adminkey, $type ) {
          if ( !$this->session->userdata( 'adminKey' ) ) {
              redirect( base_url( ADMIN ) );
              exit;
          }
          if ( !$adminkey ) {
              redirect( base_url( ADMIN . '/adminmanager' ) );
              exit;
          }
          if ( !$type ) {
              redirect( base_url( ADMIN . '/adminmanager' ) );
              exit;
          }
          $admin_by_key = $this->admin_model->admin_by_key( $adminkey );
          if ( !$admin_by_key ) {
              redirect( base_url( ADMIN . '/adminmanager' ) );
              exit;
          }
          if ( $this->input->post( 'resetpass' ) == '1' ) {
              $this->form_validation->set_rules( 'newpassword', 'New Password', 'required|min_length[3]' );
              $this->form_validation->set_rules( 'repassword', 'Confirm Password', 'required|matches[newpassword]|min_length[3]' );
              if ( $this->form_validation->run() === TRUE ) {
                  if ( $this->input->post( 'newpassword' ) == $this->input->post( 'repassword' ) ) {
                      if ( !empty( $admin_by_key ) ) {
                          if ( $admin_by_key[ "status" ] == 1 ) {
                              $password = $this->corefunctions->passwordencrypt( $this->input->post( 'newpassword' ) );
                              $this->admin_model->change_admin_password( $admin_by_key[ 'adminid' ], $password );
                              $data[ 'hasSucess' ] = TRUE;
                              $data[ 'Sucessmsg' ] = "Your password has been reset.";
                          } else {
                              $data[ 'haserror' ] = TRUE;
                              $data[ 'errormsg' ] = "Your Account is Inactive";
                          }
                      } else {
                          $data[ 'haserror' ] = TRUE;
                          $data[ 'errormsg' ] = "Invalid Key";
                      }
                  } else {
                      $data[ 'haserror' ] = TRUE;
                      $data[ 'errormsg' ] = "Your passwords do not match. Please check and try again.";
                  }
              }
          }
          $data[ 'adminkey' ] = $adminkey;
          $data[ 'type' ]     = $type;
          if ( $type == 'profile' ) {
              $breadcum[ ] = array(
                   "url" => base_url( ADMIN . '/myprofile' ),
                  "title" => 'My Profile' 
              );
          } else {
              $breadcum[ ] = array(
                   "url" => base_url( ADMIN . '/adminmanager' ),
                  "title" => 'Admins' 
              );
              $breadcum[ ] = array(
                   "url" => base_url( ADMIN . '/editadmin' . '/' . $adminkey ),
                  "title" => 'Edit Admin' 
              );
          }
          $breadcum[ ]           = array(
               "title" => 'Change Password' 
          );
          $breadcum[ ]           = array(
               "title" => $admin_by_key[ 'firstname' ] . ' ' . $admin_by_key[ 'lastname' ] 
          );
          $header[ 'breadcum' ]  = $breadcum;
          $header[ 'title' ]     = TITLE . 'Change Password';
          $header[ 'hederdata' ] = $this->hedercontroller->headerdata();
          $header[ 'titlecls' ]  = 'admin';
          if ( $type == 'profile' ) {
              $header[ 'pagetitle' ] = 'My Profile';
          } else {
             // $header[ 'createurl' ] = base_url() . ADMIN . '/createadmin';
              $header[ 'pagetitle' ] = 'Admins';
          }
          $data[ 'pageHeader' ] = " Admins";
          $this->load->view('admin/header', $header );
          $this->load->view('admin/admins/changepasswrd', $data );
          $this->load->view('admin/footer' );
      }
      /*
      admin manager ends
      */
      public function myprofile( ) {
          if ( !$this->session->userdata( 'adminKey' ) ) {
              redirect( base_url( ADMIN ) );
              exit;
          }
          $admin_by_key = $this->admin_model->admin_by_key( $this->session->userdata( 'adminKey' ) );
          if ( !$admin_by_key ) {
              redirect( base_url( ADMIN . '/adminmanager' ) );
              exit;
          }
          $data[ 'states' ] = $this->admin_model->get_states();
          if ( $this->input->post( 'editadmin' ) == '1' ) {
              $this->form_validation->set_rules( 'firstname', 'First Name', 'required|xss_clean' );
              $this->form_validation->set_rules( 'lastname', 'Last Name', 'required|xss_clean' );
              $this->form_validation->set_rules( 'address', 'Address', 'required|xss_clean' );
              $this->form_validation->set_rules( 'city', 'City', 'required|xss_clean' );
              $this->form_validation->set_rules( 'state', 'State', 'required|xss_clean' );
              $this->form_validation->set_rules( 'zip', 'Zip', 'required|xss_clean' );
              $this->form_validation->set_rules( 'phone', 'Phone', 'required|xss_clean' );
              if ( $this->form_validation->run() === FALSE ) {
                  $data[ 'haserror' ] = TRUE;
                  $data[ 'errormsg' ] = "Please enter required details";
              } else {
                  $Id = $this->admin_model->admin_update_by_key( $admin_by_key[ 'adminkey' ] );
                  if ( $this->input->post( 'tempimage' ) ) {
                      $tempImg      = $this->admin_model->get_temp_det( $this->input->post( 'tempimage' ) );
                      $originalpath = "assets/tempImgs/original/" . $this->input->post( 'tempimage' ) . '.' . $tempImg[ 'tempimgext' ];
                      $croppath     = "assets/tempImgs/crop/" . $this->input->post( 'tempimage' ) . '.' . $tempImg[ 'tempimgext' ];
                      $imgkey       = $this->corefunctions->generateUniqueKey( '12', 'admins', 'imgkey' );
                      $this->admin_model->update_img_admin( $admin_by_key[ 'adminid' ], $imgkey, $tempImg[ 'tempimgext' ] );
                      $orgpath = $this->corefunctions->getMyPath( $admin_by_key[ 'adminid' ], $imgkey, $tempImg[ 'tempimgext' ], 'assets/admin/profImgs/original/' );
                      $cppath  = $this->corefunctions->getMyPath( $admin_by_key[ 'adminid' ], $imgkey, $tempImg[ 'tempimgext' ], 'assets/admin/profImgs/crop/' );
                      copy( $originalpath, $orgpath );
                      copy( $croppath, $cppath );
                  }
                  redirect( base_url( ADMIN . '/adminmanager' ) );
                  exit;
              }
          }
          if ( $admin_by_key[ 'imgkey' ] ) {
              $admin_by_key[ 'profImg' ] = base_url( $this->corefunctions->getMyPath( $admin_by_key[ 'adminid' ], $admin_by_key[ 'imgkey' ], $admin_by_key[ 'imgext' ], "assets/admin/profImgs/crop/" ) );
          } else {
              $admin_by_key[ 'profImg' ] = base_url( "images/defltimg.png" );
          }
          $data[ 'AdminDet' ]    = $admin_by_key;
          $header[ 'titlecls' ]  = 'admin';
          $header[ 'title' ]     = TITLE . "My Profile";
          $header[ 'hederdata' ] = $this->hedercontroller->headerdata();
          // $header[ 'createurl' ]  = base_url().ADMIN.'/createadmin';
          //$header[ 'pagetitle' ]  = 'Admins';
          $this->load->view('admin/header', $header );
          $this->load->view('admin/admins/myprofile', $data );
          $this->load->view('admin/footer' );
      }
    
      public function checkemailexists( ) {
         
          $checkadminEmail = $this->admin_model->check_adminemail_exists( $_REQUEST[ 'email' ] );
          if ( $checkadminEmail  ) {
              echo "false"; //good to register
          } else {
              echo "true"; //already registered
          }
      }
      public function checkeligible( ) {
          $checkadminEmail = $this->admin_model->check_adminemail_exists( $_REQUEST[ 'email' ] );
          if ( $checkadminEmail and $checkadminEmail[ 'status' ] == '1' ) {
              echo "true"; //good to register
          } elseif ( $checkadminEmail and $checkadminEmail[ 'status' ] == '0' ) {
              echo "false"; //good to register
          } else {
              echo "false"; //already registered
          }
      }
  }
?>