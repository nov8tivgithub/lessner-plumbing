<?php
  /* table creations meera june 10*/
  if (!defined('BASEPATH')) {
      exit('No direct script access allowed');
  }
  class Migration_tables extends CI_Migration {
      
      public function up() {
         if (!$this->db->table_exists('ci_sessions')) {
			  $sql   = "CREATE TABLE IF NOT EXISTS `lp_ci_sessions` (
				`session_id` varchar(40) NOT NULL DEFAULT '0',
				`ip_address` varchar(45) NOT NULL DEFAULT '0',
				`user_agent` varchar(120) NOT NULL,
				`last_activity` int(10) unsigned NOT NULL DEFAULT '0',
				`user_data` text NOT NULL,
				`prevent_update` int(10) DEFAULT NULL,
				PRIMARY KEY (`session_id`),
				KEY `last_activity_idx` (`last_activity`)
			  )";
			   $query = $this->db->query($sql);
		 }
		  if (!$this->db->table_exists('docs')) {
			  $sql   = "CREATE TABLE IF NOT EXISTS `lp_docs` (
					`docid` mediumint(7) NOT NULL AUTO_INCREMENT,
					`dockey` varchar(15) NOT NULL,
					`originalname` varchar(255) NOT NULL,
					`doc_ext` varchar(5) NOT NULL,
					`id` mediumint(7) NOT NULL,
					`createdate` int(11) NOT NULL,
					`updatedate` int(11) NOT NULL,
					KEY `docid` (`docid`)
					) ";
			   $query = $this->db->query($sql);
		  
          if (!$this->db->table_exists('admins')) {
              $this->dbforge->add_field(array(
                  'adminid' => array(
                      'type' => 'mediumint',
                      'constraint' => 7,
                      'unsigned' => TRUE,
                      'auto_increment' => TRUE
                  ),
                  'adminkey' => array(
                      'type' => 'VARCHAR',
                      'constraint' => '20'
                  ),
                  'email' => array(
                      'type' => 'VARCHAR',
                      'constraint' => '150'
                  ),
                  'password' => array(
                      'type' => 'VARCHAR',
                      'constraint' => '255'
                  ),
                  'firstname' => array(
                      'type' => 'VARCHAR',
                      'constraint' => '255'
                  ),
                  'lastname' => array(
                      'type' => 'VARCHAR',
                      'constraint' => '255'
                  ),
                  'address' => array(
                      'type' => 'TEXT',
                      'null' => TRUE
                  ),
                  'city' => array(
                      'type' => 'VARCHAR',
                      'constraint' => '255'
                  ),
                  'state' => array(
                      'type' => 'VARCHAR',
                      'constraint' => '100'
                  ),
                  'zip' => array(
                      'type' => 'VARCHAR',
                      'constraint' => '10'
                  ),
                  'phone' => array(
                      'type' => 'VARCHAR',
                      'constraint' => '20'
                  ),
                  'mobile' => array(
                      'type' => 'VARCHAR',
                      'constraint' => '20'
                  ),
                  'imgkey' => array(
                      'type' => 'VARCHAR',
                      'constraint' => '20'
                  ),
                  'imgext' => array(
                      'type' => 'VARCHAR',
                      'constraint' => '5'
                  ),
                  'passwrdkey' => array(
                      'type' => 'VARCHAR',
                      'constraint' => '20'
                  ),
                  'status' => array(
                      'type' => 'ENUM("0","1")',
                      'default' => '1',
                      'null' => FALSE
                  ),
                  'lastlogindate' => array(
                      'type' => 'INT',
                      'constraint' => '11'
                  ),
                  'createdate' => array(
                      'type' => 'INT',
                      'constraint' => '11'
                  ),
                  'updatedate' => array(
                      'type' => 'INT',
                      'constraint' => '11'
                  )
              ));
              
              $this->dbforge->add_key('adminid', TRUE);
              $this->dbforge->create_table('admins', TRUE);
			  $sql="INSERT INTO `lp_admins` (`adminid`, `adminkey`, `email`, `password`, `firstname`, `lastname`, `address`, `city`, `state`, `zip`, `phone`, `createdate`) VALUES
                    (1, 'a3b8ab7hirhf', 'icadmin@consult-ic.com', 'f9f25c73084ece868fb4f5b9a275c7c3', 'IC', 'Admin', '123 Church Road', 'Baltimore', 'MD', '21117', '567-897-8765', now())";
              $query = $this->db->query($sql);
          }
          
     
          if (!$this->db->table_exists('tempimage')) {
              $this->dbforge->add_field(array(
                  'tempimgid' => array(
                      'type' => 'mediumint',
                      'constraint' => 7,
                      'unsigned' => TRUE,
                      'auto_increment' => TRUE
                  ),
                  'tempimgkey' => array(
                      'type' => 'VARCHAR',
                      'constraint' => 30
                  ),
                  'tempimgext' => array(
                      'type' => 'VARCHAR',
                      'constraint' => 5
                  ),
                  'width' => array(
                      'type' => 'mediumint',
                      'constraint' => '7'
                  ),
                  'height' => array(
                      'type' => 'mediumint',
                      'constraint' => '7'
                  ),
                  'createdate' => array(
                      'type' => 'INT',
                      'constraint' => 11
                  )
              ));
              
              $this->dbforge->add_key('tempimgid', TRUE);
              $this->dbforge->create_table('tempimage', TRUE);
          }
		  
        
        
         
          
      
          if (!$this->db->table_exists('posts')) {
              $this->dbforge->add_field(array(
                  'postid' => array(
                      'type' => 'mediumint',
                      'constraint' => 7,
                      'unsigned' => TRUE,
                      'auto_increment' => TRUE
                  ),
                  'postkey' => array(
                      'type' => 'VARCHAR',
                      'constraint' => '20'
                  ),
                  'title' => array(
                      'type' => 'VARCHAR',
                      'constraint' => '255'
                  ),
                  'url' => array(
                      'type' => 'VARCHAR',
                      'constraint' => '255'
                  ),
                  'description' => array(
                      'type' => 'TEXT',
                      'null' => TRUE
                  ),
                  'imgkey' => array(
                      'type' => 'VARCHAR',
                      'constraint' => '20'
                  ),
                  'imgext' => array(
                      'type' => 'VARCHAR',
                      'constraint' => '5'
                  ),
                  'status' => array(
                      'type' => 'ENUM("0","1")',
                      'default' => '1',
                      'null' => FALSE
                  ),
                  'createdate' => array(
                      'type' => 'INT',
                      'constraint' => 11
                  ),
                  'updatedate' => array(
                      'type' => 'INT',
                      'constraint' => 11
                  ),
                  'embedcode' => array(
                      'type' => 'VARCHAR',
                      'constraint' => '500'
                  )
              ));
              $this->dbforge->add_key('postid', TRUE);
              $this->dbforge->create_table('posts', TRUE);
              //print $this->db->last_query();
          }
          
       
       
          if (!$this->db->table_exists('state')) {
              $this->dbforge->add_field(array(
                  'state_id' => array(
                      'type' => 'mediumint',
                      'constraint' => 7,
                      'unsigned' => TRUE,
                      'auto_increment' => TRUE
                  ),
                  'state_prefix' => array(
                      'type' => 'VARCHAR',
                      'constraint' => 8
                  ),
                  'state_name' => array(
                      'type' => 'VARCHAR',
                      'constraint' => 32
                  )
              ));
              $this->dbforge->add_key('state_id', TRUE);
              $this->dbforge->create_table('state', TRUE);
              $sql   = "insert into lp_state
					  values
					  (NULL, 'Alabama', 'AL'),
					  (NULL, 'Alaska', 'AK'),
					  (NULL, 'Arizona', 'AZ'),
					  (NULL, 'Arkansas', 'AR'),
					  (NULL, 'California', 'CA'),
					  (NULL, 'Colorado', 'CO'),
					  (NULL, 'Connectlput', 'CT'),
					  (NULL, 'Delaware', 'DE'),
					  (NULL, 'Distrlpt of Columbia', 'DC'),
					  (NULL, 'Florida', 'FL'),
					  (NULL, 'Georgia', 'GA'),
					  (NULL, 'Hawaii', 'HI'),
					  (NULL, 'Idaho', 'ID'),
					  (NULL, 'Illinois', 'IL'),
					  (NULL, 'Indiana', 'IN'),
					  (NULL, 'Iowa', 'IA'),
					  (NULL, 'Kansas', 'KS'),
					  (NULL, 'Kentucky', 'KY'),
					  (NULL, 'Louisiana', 'LA'),
					  (NULL, 'Maine', 'ME'),
					  (NULL, 'Maryland', 'MD'),
					  (NULL, 'Massachusetts', 'MA'),
					  (NULL, 'Mlphigan', 'MI'),
					  (NULL, 'Minnesota', 'MN'),
					  (NULL, 'Mississippi', 'MS'),
					  (NULL, 'Missouri', 'MO'),
					  (NULL, 'Montana', 'MT'),
					  (NULL, 'Nebraska', 'NE'),
					  (NULL, 'Nevada', 'NV'),
					  (NULL, 'New Hampshire', 'NH'),
					  (NULL, 'New Jersey', 'NJ'),
					  (NULL, 'New Mexlpo', 'NM'),
					  (NULL, 'New York', 'NY'),
					  (NULL, 'North Carolina', 'NC'),
					  (NULL, 'North Dakota', 'ND'),
					  (NULL, 'Ohio', 'OH'),
					  (NULL, 'Oklahoma', 'OK'),
					  (NULL, 'Oregon', 'OR'),
					  (NULL, 'Pennsylvania', 'PA'),
					  (NULL, 'Rhode Island', 'RI'),
					  (NULL, 'South Carolina', 'SC'),
					  (NULL, 'South Dakota', 'SD'),
					  (NULL, 'Tennessee', 'TN'),
					  (NULL, 'Texas', 'TX'),
					  (NULL, 'Utah', 'UT'),
					  (NULL, 'Vermont', 'VT'),
					  (NULL, 'Virginia', 'VA'),
					  (NULL, 'Washington', 'WA'),
					  (NULL, 'West Virginia', 'WV'),
					  (NULL, 'Wisconsin', 'WI'),
					  (NULL, 'Wyoming', 'WY')";
              $query = $this->db->query($sql);
          }
          if (!$this->db->table_exists('country')) {
              $this->dbforge->add_field(array(
			    'country_id' => array(
                      'type' => 'INT',
                      'constraint' => 5,
                      'unsigned' => TRUE,
                      'auto_increment' => TRUE
                  ),
                  'country_code' => array(
                      'type' => 'CHAR',
                      'constraint' => 2
                  ),
                  'country_name' => array(
                      'type' => 'VARCHAR',
                      'constraint' => 80
                  ),
				  'long_name' => array(
                      'type' => 'VARCHAR',
                      'constraint' => 80
                  )
                  
              ));
			  $this->dbforge->add_key('country_id', TRUE);
              $this->dbforge->create_table('country', TRUE);
              $sql   = "INSERT INTO `lp_country` (`country_id`, `country_code`, `country_name`, `long_name`) VALUES
						(1, 'AF', 'Afghanistan', 'Islamlp Republlp of Afghanistan'),
						(2, 'AX', 'Aland Islands', '&Aring;land Islands'),
						(3, 'AL', 'Albania', 'Republlp of Albania'),
						(4, 'DZ', 'Algeria', 'People''s Democratlp Republlp of Algeria'),
						(5, 'AS', 'Amerlpan Samoa', 'Amerlpan Samoa'),
						(6, 'AD', 'Andorra', 'Principality of Andorra'),
						(7, 'AO', 'Angola', 'Republlp of Angola'),
						(8, 'AI', 'Anguilla', 'Anguilla'),
						(9, 'AQ', 'Antarctlpa', 'Antarctlpa'),
						(10, 'AG', 'Antigua and Barbuda', 'Antigua and Barbuda'),
						(11, 'AR', 'Argentina', 'Argentine Republlp'),
						(12, 'AM', 'Armenia', 'Republlp of Armenia'),
						(13, 'AW', 'Aruba', 'Aruba'),
						(14, 'AU', 'Australia', 'Commonwealth of Australia'),
						(15, 'AT', 'Austria', 'Republlp of Austria'),
						(16, 'AZ', 'Azerbaijan', 'Republlp of Azerbaijan'),
						(17, 'BS', 'Bahamas', 'Commonwealth of The Bahamas'),
						(18, 'BH', 'Bahrain', 'Kingdom of Bahrain'),
						(19, 'BD', 'Bangladesh', 'People''s Republlp of Bangladesh'),
						(20, 'BB', 'Barbados', 'Barbados'),
						(21, 'BY', 'Belarus', 'Republlp of Belarus'),
						(22, 'BE', 'Belgium', 'Kingdom of Belgium'),
						(23, 'BZ', 'Belize', 'Belize'),
						(24, 'BJ', 'Benin', 'Republlp of Benin'),
						(25, 'BM', 'Bermuda', 'Bermuda Islands'),
						(26, 'BT', 'Bhutan', 'Kingdom of Bhutan'),
						(27, 'BO', 'Bolivia', 'Plurinational State of Bolivia'),
						(28, 'BQ', 'Bonaire, Sint Eustatius and Saba', 'Bonaire, Sint Eustatius and Saba'),
						(29, 'BA', 'Bosnia and Herzegovina', 'Bosnia and Herzegovina'),
						(30, 'BW', 'Botswana', 'Republlp of Botswana'),
						(31, 'BV', 'Bouvet Island', 'Bouvet Island'),
						(32, 'BR', 'Brazil', 'Federative Republlp of Brazil'),
						(33, 'IO', 'British Indian Ocean Territory', 'British Indian Ocean Territory'),
						(34, 'BN', 'Brunei', 'Brunei Darussalam'),
						(35, 'BG', 'Bulgaria', 'Republlp of Bulgaria'),
						(36, 'BF', 'Burkina Faso', 'Burkina Faso'),
						(37, 'BI', 'Burundi', 'Republlp of Burundi'),
						(38, 'KH', 'Cambodia', 'Kingdom of Cambodia'),
						(39, 'CM', 'Cameroon', 'Republlp of Cameroon'),
						(40, 'CA', 'Canada', 'Canada'),
						(41, 'CV', 'Cape Verde', 'Republlp of Cape Verde'),
						(42, 'KY', 'Cayman Islands', 'The Cayman Islands'),
						(43, 'CF', 'Central Afrlpan Republlp', 'Central Afrlpan Republlp'),
						(44, 'TD', 'Chad', 'Republlp of Chad'),
						(45, 'CL', 'Chile', 'Republlp of Chile'),
						(46, 'CN', 'China', 'People''s Republlp of China'),
						(47, 'CX', 'Christmas Island', 'Christmas Island'),
						(48, 'CC', 'Cocos (Keeling) Islands', 'Cocos (Keeling) Islands'),
						(49, 'CO', 'Colombia', 'Republlp of Colombia'),
						(50, 'KM', 'Comoros', 'Union of the Comoros'),
						(51, 'CG', 'Congo', 'Republlp of the Congo'),
						(52, 'CK', 'Cook Islands', 'Cook Islands'),
						(53, 'CR', 'Costa Rlpa', 'Republlp of Costa Rlpa'),
						(54, 'CI', 'Cote d''ivoire (Ivory Coast)', 'Republlp of C&ocirc;te D''Ivoire (Ivory Coast)'),
						(55, 'HR', 'Croatia', 'Republlp of Croatia'),
						(56, 'CU', 'Cuba', 'Republlp of Cuba'),
						(57, 'CW', 'Curacao', 'Cura&ccedil;ao'),
						(58, 'CY', 'Cyprus', 'Republlp of Cyprus'),
						(59, 'CZ', 'Czech Republlp', 'Czech Republlp'),
						(60, 'CD', 'Democratlp Republlp of the Congo', 'Democratlp Republlp of the Congo'),
						(61, 'DK', 'Denmark', 'Kingdom of Denmark'),
						(62, 'DJ', 'Djibouti', 'Republlp of Djibouti'),
						(63, 'DM', 'Dominlpa', 'Commonwealth of Dominlpa'),
						(64, 'DO', 'Dominlpan Republlp', 'Dominlpan Republlp'),
						(65, 'EC', 'Ecuador', 'Republlp of Ecuador'),
						(66, 'EG', 'Egypt', 'Arab Republlp of Egypt'),
						(67, 'SV', 'El Salvador', 'Republlp of El Salvador'),
						(68, 'GQ', 'Equatorial Guinea', 'Republlp of Equatorial Guinea'),
						(69, 'ER', 'Eritrea', 'State of Eritrea'),
						(70, 'EE', 'Estonia', 'Republlp of Estonia'),
						(71, 'ET', 'Ethiopia', 'Federal Democratlp Republlp of Ethiopia'),
						(72, 'FK', 'Falkland Islands (Malvinas)', 'The Falkland Islands (Malvinas)'),
						(73, 'FO', 'Faroe Islands', 'The Faroe Islands'),
						(74, 'FJ', 'Fiji', 'Republlp of Fiji'),
						(75, 'FI', 'Finland', 'Republlp of Finland'),
						(76, 'FR', 'France', 'French Republlp'),
						(77, 'GF', 'French Guiana', 'French Guiana'),
						(78, 'PF', 'French Polynesia', 'French Polynesia'),
						(79, 'TF', 'French Southern Territories', 'French Southern Territories'),
						(80, 'GA', 'Gabon', 'Gabonese Republlp'),
						(81, 'GM', 'Gambia', 'Republlp of The Gambia'),
						(82, 'GE', 'Georgia', 'Georgia'),
						(83, 'DE', 'Germany', 'Federal Republlp of Germany'),
						(84, 'GH', 'Ghana', 'Republlp of Ghana'),
						(85, 'GI', 'Gibraltar', 'Gibraltar'),
						(86, 'GR', 'Greece', 'Hellenlp Republlp'),
						(87, 'GL', 'Greenland', 'Greenland'),
						(88, 'GD', 'Grenada', 'Grenada'),
						(89, 'GP', 'Guadaloupe', 'Guadeloupe'),
						(90, 'GU', 'Guam', 'Guam'),
						(91, 'GT', 'Guatemala', 'Republlp of Guatemala'),
						(92, 'GG', 'Guernsey', 'Guernsey'),
						(93, 'GN', 'Guinea', 'Republlp of Guinea'),
						(94, 'GW', 'Guinea-Bissau', 'Republlp of Guinea-Bissau'),
						(95, 'GY', 'Guyana', 'Co-operative Republlp of Guyana'),
						(96, 'HT', 'Haiti', 'Republlp of Haiti'),
						(97, 'HM', 'Heard Island and McDonald Islands', 'Heard Island and McDonald Islands'),
						(98, 'HN', 'Honduras', 'Republlp of Honduras'),
						(99, 'HK', 'Hong Kong', 'Hong Kong'),
						(100, 'HU', 'Hungary', 'Hungary'),
						(101, 'IS', 'Iceland', 'Republlp of Iceland'),
						(102, 'IN', 'India', 'Republlp of India'),
						(103, 'ID', 'Indonesia', 'Republlp of Indonesia'),
						(104, 'IR', 'Iran', 'Islamlp Republlp of Iran'),
						(105, 'IQ', 'Iraq', 'Republlp of Iraq'),
						(106, 'IE', 'Ireland', 'Ireland'),
						(107, 'IM', 'Isle of Man', 'Isle of Man'),
						(108, 'IL', 'Israel', 'State of Israel'),
						(109, 'IT', 'Italy', 'Italian Republlp'),
						(110, 'JM', 'Jamalpa', 'Jamalpa'),
						(111, 'JP', 'Japan', 'Japan'),
						(112, 'JE', 'Jersey', 'The Bailiwlpk of Jersey'),
						(113, 'JO', 'Jordan', 'Hashemite Kingdom of Jordan'),
						(114, 'KZ', 'Kazakhstan', 'Republlp of Kazakhstan'),
						(115, 'KE', 'Kenya', 'Republlp of Kenya'),
						(116, 'KI', 'Kiribati', 'Republlp of Kiribati'),
						(117, 'XK', 'Kosovo', 'Republlp of Kosovo'),
						(118, 'KW', 'Kuwait', 'State of Kuwait'),
						(119, 'KG', 'Kyrgyzstan', 'Kyrgyz Republlp'),
						(120, 'LA', 'Laos', 'Lao People''s Democratlp Republlp'),
						(121, 'LV', 'Latvia', 'Republlp of Latvia'),
						(122, 'LB', 'Lebanon', 'Republlp of Lebanon'),
						(123, 'LS', 'Lesotho', 'Kingdom of Lesotho'),
						(124, 'LR', 'Liberia', 'Republlp of Liberia'),
						(125, 'LY', 'Libya', 'Libya'),
						(126, 'LI', 'Liechtenstein', 'Principality of Liechtenstein'),
						(127, 'LT', 'Lithuania', 'Republlp of Lithuania'),
						(128, 'LU', 'Luxembourg', 'Grand Duchy of Luxembourg'),
						(129, 'MO', 'Macao', 'The Macao Special Administrative Region'),
						(130, 'MK', 'Macedonia', 'The Former Yugoslav Republlp of Macedonia'),
						(131, 'MG', 'Madagascar', 'Republlp of Madagascar'),
						(132, 'MW', 'Malawi', 'Republlp of Malawi'),
						(133, 'MY', 'Malaysia', 'Malaysia'),
						(134, 'MV', 'Maldives', 'Republlp of Maldives'),
						(135, 'ML', 'Mali', 'Republlp of Mali'),
						(136, 'MT', 'Malta', 'Republlp of Malta'),
						(137, 'MH', 'Marshall Islands', 'Republlp of the Marshall Islands'),
						(138, 'MQ', 'Martinique', 'Martinique'),
						(139, 'MR', 'Mauritania', 'Islamlp Republlp of Mauritania'),
						(140, 'MU', 'Mauritius', 'Republlp of Mauritius'),
						(141, 'YT', 'Mayotte', 'Mayotte'),
						(142, 'MX', 'Mexlpo', 'United Mexlpan States'),
						(143, 'FM', 'Mlpronesia', 'Federated States of Mlpronesia'),
						(144, 'MD', 'Moldava', 'Republlp of Moldova'),
						(145, 'MC', 'Monaco', 'Principality of Monaco'),
						(146, 'MN', 'Mongolia', 'Mongolia'),
						(147, 'ME', 'Montenegro', 'Montenegro'),
						(148, 'MS', 'Montserrat', 'Montserrat'),
						(149, 'MA', 'Morocco', 'Kingdom of Morocco'),
						(150, 'MZ', 'Mozambique', 'Republlp of Mozambique'),
						(151, 'MM', 'Myanmar (Burma)', 'Republlp of the Union of Myanmar'),
						(152, 'NA', 'Namibia', 'Republlp of Namibia'),
						(153, 'NR', 'Nauru', 'Republlp of Nauru'),
						(154, 'NP', 'Nepal', 'Federal Democratlp Republlp of Nepal'),
						(155, 'NL', 'Netherlands', 'Kingdom of the Netherlands'),
						(156, 'NC', 'New Caledonia', 'New Caledonia'),
						(157, 'NZ', 'New Zealand', 'New Zealand'),
						(158, 'NI', 'Nlparagua', 'Republlp of Nlparagua'),
						(159, 'NE', 'Niger', 'Republlp of Niger'),
						(160, 'NG', 'Nigeria', 'Federal Republlp of Nigeria'),
						(161, 'NU', 'Niue', 'Niue'),
						(162, 'NF', 'Norfolk Island', 'Norfolk Island'),
						(163, 'KP', 'North Korea', 'Democratlp People''s Republlp of Korea'),
						(164, 'MP', 'Northern Mariana Islands', 'Northern Mariana Islands'),
						(165, 'NO', 'Norway', 'Kingdom of Norway'),
						(166, 'OM', 'Oman', 'Sultanate of Oman'),
						(167, 'PK', 'Pakistan', 'Islamlp Republlp of Pakistan'),
						(168, 'PW', 'Palau', 'Republlp of Palau'),
						(169, 'PS', 'Palestine', 'State of Palestine (or Occupied Palestinian Territory)'),
						(170, 'PA', 'Panama', 'Republlp of Panama'),
						(171, 'PG', 'Papua New Guinea', 'Independent State of Papua New Guinea'),
						(172, 'PY', 'Paraguay', 'Republlp of Paraguay'),
						(173, 'PE', 'Peru', 'Republlp of Peru'),
						(174, 'PH', 'Phillipines', 'Republlp of the Philippines'),
						(175, 'PN', 'Pitcairn', 'Pitcairn'),
						(176, 'PL', 'Poland', 'Republlp of Poland'),
						(177, 'PT', 'Portugal', 'Portuguese Republlp'),
						(178, 'PR', 'Puerto Rlpo', 'Commonwealth of Puerto Rlpo'),
						(179, 'QA', 'Qatar', 'State of Qatar'),
						(180, 'RE', 'Reunion', 'R&eacute;union'),
						(181, 'RO', 'Romania', 'Romania'),
						(182, 'RU', 'Russia', 'Russian Federation'),
						(183, 'RW', 'Rwanda', 'Republlp of Rwanda'),
						(184, 'BL', 'Saint Barthelemy', 'Saint Barth&eacute;lemy'),
						(185, 'SH', 'Saint Helena', 'Saint Helena, Ascension and Tristan da Cunha'),
						(186, 'KN', 'Saint Kitts and Nevis', 'Federation of Saint Christopher and Nevis'),
						(187, 'LC', 'Saint Lucia', 'Saint Lucia'),
						(188, 'MF', 'Saint Martin', 'Saint Martin'),
						(189, 'PM', 'Saint Pierre and Miquelon', 'Saint Pierre and Miquelon'),
						(190, 'VC', 'Saint Vincent and the Grenadines', 'Saint Vincent and the Grenadines'),
						(191, 'WS', 'Samoa', 'Independent State of Samoa'),
						(192, 'SM', 'San Marino', 'Republlp of San Marino'),
						(193, 'ST', 'Sao Tome and Principe', 'Democratlp Republlp of S&atilde;o Tom&eacute; and Pr&iacute;ncipe'),
						(194, 'SA', 'Saudi Arabia', 'Kingdom of Saudi Arabia'),
						(195, 'SN', 'Senegal', 'Republlp of Senegal'),
						(196, 'RS', 'Serbia', 'Republlp of Serbia'),
						(197, 'SC', 'Seychelles', 'Republlp of Seychelles'),
						(198, 'SL', 'Sierra Leone', 'Republlp of Sierra Leone'),
						(199, 'SG', 'Singapore', 'Republlp of Singapore'),
						(200, 'SX', 'Sint Maarten', 'Sint Maarten'),
						(201, 'SK', 'Slovakia', 'Slovak Republlp'),
						(202, 'SI', 'Slovenia', 'Republlp of Slovenia'),
						(203, 'SB', 'Solomon Islands', 'Solomon Islands'),
						(204, 'SO', 'Somalia', 'Somali Republlp'),
						(205, 'ZA', 'South Afrlpa', 'Republlp of South Afrlpa'),
						(206, 'GS', 'South Georgia and the South Sandwlph Islands', 'South Georgia and the South Sandwlph Islands'),
						(207, 'KR', 'South Korea', 'Republlp of Korea'),
						(208, 'SS', 'South Sudan', 'Republlp of South Sudan'),
						(209, 'ES', 'Spain', 'Kingdom of Spain'),
						(210, 'LK', 'Sri Lanka', 'Democratlp Socialist Republlp of Sri Lanka'),
						(211, 'SD', 'Sudan', 'Republlp of the Sudan'),
						(212, 'SR', 'Suriname', 'Republlp of Suriname'),
						(213, 'SJ', 'Svalbard and Jan Mayen', 'Svalbard and Jan Mayen'),
						(214, 'SZ', 'Swaziland', 'Kingdom of Swaziland'),
						(215, 'SE', 'Sweden', 'Kingdom of Sweden'),
						(216, 'CH', 'Switzerland', 'Swiss Confederation'),
						(217, 'SY', 'Syria', 'Syrian Arab Republlp'),
						(218, 'TW', 'Taiwan', 'Republlp of China (Taiwan)'),
						(219, 'TJ', 'Tajikistan', 'Republlp of Tajikistan'),
						(220, 'TZ', 'Tanzania', 'United Republlp of Tanzania'),
						(221, 'TH', 'Thailand', 'Kingdom of Thailand'),
						(222, 'TL', 'Timor-Leste (East Timor)', 'Democratlp Republlp of Timor-Leste'),
						(223, 'TG', 'Togo', 'Togolese Republlp'),
						(224, 'TK', 'Tokelau', 'Tokelau'),
						(225, 'TO', 'Tonga', 'Kingdom of Tonga'),
						(226, 'TT', 'Trinidad and Tobago', 'Republlp of Trinidad and Tobago'),
						(227, 'TN', 'Tunisia', 'Republlp of Tunisia'),
						(228, 'TR', 'Turkey', 'Republlp of Turkey'),
						(229, 'TM', 'Turkmenistan', 'Turkmenistan'),
						(230, 'TC', 'Turks and Calpos Islands', 'Turks and Calpos Islands'),
						(231, 'TV', 'Tuvalu', 'Tuvalu'),
						(232, 'UG', 'Uganda', 'Republlp of Uganda'),
						(233, 'UA', 'Ukraine', 'Ukraine'),
						(234, 'AE', 'United Arab Emirates', 'United Arab Emirates'),
						(235, 'GB', 'United Kingdom', 'United Kingdom of Great Britain and Nothern Ireland'),
						(236, 'US', 'United States of Amerlpa', 'United States of Amerlpa'),
						(237, 'UM', 'United States Minor Outlying Islands', 'United States Minor Outlying Islands'),
						(238, 'UY', 'Uruguay', 'Eastern Republlp of Uruguay'),
						(239, 'UZ', 'Uzbekistan', 'Republlp of Uzbekistan'),
						(240, 'VU', 'Vanuatu', 'Republlp of Vanuatu'),
						(241, 'VA', 'Vatlpan City', 'State of the Vatlpan City'),
						(242, 'VE', 'Venezuela', 'Bolivarian Republlp of Venezuela'),
						(243, 'VN', 'Vietnam', 'Socialist Republlp of Vietnam'),
						(244, 'VG', 'Virgin Islands, British', 'British Virgin Islands'),
						(245, 'VI', 'Virgin Islands, US', 'Virgin Islands of the United States'),
						(246, 'WF', 'Wallis and Futuna', 'Wallis and Futuna'),
						(247, 'EH', 'Western Sahara', 'Western Sahara'),
						(248, 'YE', 'Yemen', 'Republlp of Yemen'),
						(249, 'ZM', 'Zambia', 'Republlp of Zambia'),
						(250, 'ZW', 'Zimbabwe', 'Republlp of Zimbabwe')";
              $query = $this->db->query($sql);
          }
		  
		 }
      }
  }
?>