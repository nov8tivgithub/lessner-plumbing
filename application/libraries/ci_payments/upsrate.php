<?php
  if ( !defined( 'BASEPATH' ) )
      exit( 'No direct script access allowed' );
  class upsRate extends CI_Model {
	  
      function __construct( ) {
          parent::__construct();
          $this->load->model( array(
               'cart_model' 
          ) );
      }
	  
      // You need to create userid ... at http://www.ec.ups.com 
	     
      var $userid = ups_account_username;
      var $passwd = ups_account_password;
      var $accesskey = access_key;
      var $upstool = 'https://www.ups.com/ups.app/xml/Rate';
      var $request; //'rate' for single service or 'shop' for all possible services
      var $service;
      var $pickuptype = '01'; // 01 daily pickup
      var $residential;
      //ship from location or shipper
      var $from_zip = from_zip;
      var $from_state = from_state;
      var $from_country = from_country;
      //ship to location
      var $to_zip;
      var $to_state;
      var $to_country;
      //package info
      var $package_type; // 02 customer supplied package
      var $weight;
      var $error = 0;
      var $errormsg;
      var $xmlarray = array( );
      var $xmlreturndata = "";
	  
      function construct_request_xml( ) {
          $xml = "<?xml version=\"1.0\"?>
				<AccessRequest xml:lang=\"en-US\">
				   <AccessLicenseNumber>$this->accesskey</AccessLicenseNumber>
				   <UserId>$this->userid</UserId>
				   <Password>$this->passwd</Password>
				</AccessRequest>
				<?xml version=\"1.0\"?>
				<RatingServiceSelectionRequest xml:lang=\"en-US\">
				  <Request>
					<TransactionReference>
					  <CustomerContext>Rating and Service</CustomerContext>
					  <XpciVersion>1.0001</XpciVersion>
					</TransactionReference>
					<RequestAction>Rate</RequestAction> 
					<RequestOption>$this->request</RequestOption> 
				  </Request>
				  <PickupType>
				  <Code>$this->pickuptype</Code>
				  </PickupType>
				  <Shipment>
					<Shipper>
					  <Address>
					<StateProvinceCode>$this->from_state</StateProvinceCode>
					<PostalCode>$this->from_zip</PostalCode>
					<CountryCode>$this->from_country</CountryCode>
					  </Address>
					</Shipper>
					<ShipTo>
					  <Address>
					<StateProvinceCode>$this->to_state</StateProvinceCode>
					<PostalCode>$this->to_zip</PostalCode>
					<CountryCode>$this->to_country</CountryCode>
					
				<ResidentialAddressIndicator>$this->residential</ResidentialAddressIndicator>
					  </Address>
					</ShipTo>
					<Service>
						<Code>$this->service</Code>
					</Service>
					<Package>
					  <PackagingType>
						<Code>$this->package_type</Code>
						<Description>Package</Description>
					  </PackagingType>
					  <Description>Rate Shopping</Description>
					  <PackageWeight>
						<Weight>$this->weight</Weight>
					  </PackageWeight>
					</Package>
					<ShipmentServiceOptions/>
				  </Shipment>
				</RatingServiceSelectionRequest>";
          return $xml;
      }
	  
      public function shipping_rate_with_methods( $shipcountry, $to_zip, $weight, $residential = 1, $packagetype = '02', $service = '' ) {
          $country = $this->cart_model->getcountrycode( $shipcountry );
          if ( $country ) {
              $to_country = $country[ 'country_code' ];
          } else
              $to_country = 'US';
          if ( $service == '' )
              $this->request = 'shop';
          else
              $this->request = 'rate';
          $this->service      = $service;
          $this->to_zip       = $to_zip;
          $this->to_state     = '';
          $this->to_country   = $to_country;
          $this->weight       = $weight;
          $this->residential  = $residential;
          $this->package_type = $packagetype;
          $this->__runCurl();
          $this->xmlarray = $this->_get_xml_array( $this->xmlreturndata );
          //check if error occurred
          if ( $this->xmlarray == "" ) {
              $this->error    = 0;
              $this->errormsg = "Unable to retrieve the Shipping info";
              return NULL;
          }
          $values = $this->xmlarray[ RatingServiceSelectionResponse ][ Response ][ 0 ];
          if ( $values[ ResponseStatusCode ] == 0 ) {
              $this->error    = $values[ Error ][ 0 ][ ErrorCode ];
              $this->errormsg = $values[ Error ][ 0 ][ ErrorDescription ];
              return NULL;
          }
          $rates = $this->get_rates();
          if ( !empty( $rates ) ) {
              foreach ( $rates as $key => $row ) {
                  $rates[ $key ][ 'option' ] = $this->foundservice( $row[ 'service' ] );
              }
          }
          return $rates;
      }
      function foundservice( $service ) {
          $ups_service = array(
               '01' => 'UPS Next Day Air',
              '02' => 'UPS 2nd Day Air',
              '03' => 'UPS Ground',
              '07' => 'UPS Worldwide Express',
              '08' => 'UPS Worldwide Expedited',
              '11' => 'UPS Standard',
              '12' => 'UPS 3 Day Select',
              '13' => 'UPS Next Day Air Saver',
              '14' => 'UPS Next Day Air Early A.M.',
              '54' => 'UPS Worldwide Express Plus',
              '59' => 'UPS 2nd Day Air A.M.',
              '65' => 'UPS Express Saver' 
          );
          return $ups_service[ $service ];
      }
      /** 
       * __runCurl() 
       * 
       * This is processes the curl command. 
       * 
       * @access    private 
       */
      function __runCurl( ) {
          $y  = $this->construct_request_xml();
          $ch = curl_init();
          curl_setopt( $ch, CURLOPT_URL, "$this->upstool" ); /// set the post-to url (do not include the ?query+string here!) 
          curl_setopt( $ch, CURLOPT_HEADER, 0 ); /// Header control 
          curl_setopt( $ch, CURLOPT_POST, 1 ); /// tell it to make a POST, not a GET 
          curl_setopt( $ch, CURLOPT_POSTFIELDS, "$y" ); /// put the querystring here starting with "?" 
          curl_setopt( $ch, CURLOPT_RETURNTRANSFER, 1 ); /// This allows the output to be set into a variable $xyz 
          curl_setopt( $ch, CURLOPT_SSL_VERIFYPEER, 0 );
          $this->xmlreturndata = curl_exec( $ch ); /// execute the curl session and return the output to a variable $xyz 
          curl_close( $ch ); /// close the curl session
      }
      function __get_xml_array( $values, &$i ) {
          $child = array( );
          if ( $values[ $i ][ 'value' ] )
              array_push( $child, $values[ $i ][ 'value' ] );
          while ( ++$i < count( $values ) ) {
              switch ( $values[ $i ][ 'type' ] ) {
                  case 'cdata':
                      array_push( $child, $values[ $i ][ 'value' ] );
                      break;
                  case 'complete':
                      $name           = $values[ $i ][ 'tag' ];
                      $child[ $name ] = $values[ $i ][ 'value' ];
                      if ( $values[ $i ][ 'attributes' ] ) {
                          $child[ $name ] = $values[ $i ][ 'attributes' ];
                      }
                      break;
                  case 'open':
                      $name = $values[ $i ][ 'tag' ];
                      $size = sizeof( $child[ $name ] );
                      if ( $values[ $i ][ 'attributes' ] ) {
                          $child[ $name ][ $size ] = $values[ $i ][ 'attributes' ];
                          $child[ $name ][ $size ] = $this->__get_xml_array( $values, $i );
                      } else {
                          $child[ $name ][ $size ] = $this->__get_xml_array( $values, $i );
                      }
                      break;
                  case 'close':
                      return $child;
                      break;
              }
          }
          return $child;
      }
      function _get_xml_array( $data ) {
          $values = array( );
          $index  = array( );
          $array  = array( );
          $parser = xml_parser_create();
          xml_parser_set_option( $parser, XML_OPTION_SKIP_WHITE, 1 );
          xml_parser_set_option( $parser, XML_OPTION_CASE_FOLDING, 0 );
          xml_parse_into_struct( $parser, $data, $values, $index );
          xml_parser_free( $parser );
          $i              = 0;
          /*
          print "<pre>";
          print_r($values);
          print "</pre>";
          exit;
          */
          $name           = $values[ $i ][ 'tag' ];
          //$array[$name] = $values[$i]['attributes']; 
          $array[ $name ] = $this->__get_xml_array( $values, $i );
          return $array;
      }
      function get_rates( ) {
          $retArray = array( );
          $values   = $this->xmlarray[ RatingServiceSelectionResponse ][ RatedShipment ];
          $ct       = count( $values );
          for ( $i = 0; $i < $ct; $i++ ) {
              $current =& $values[ $i ];
              $retArray[ $i ][ 'service' ] = $current[ Service ][ 0 ][ Code ];
              $retArray[ $i ][ 'basic' ]   = $current[ TransportationCharges ][ 0 ][ MonetaryValue ];
              $retArray[ $i ][ 'option' ]  = $current[ ServiceOptionsCharges ][ 0 ][ MonetaryValue ];
              $retArray[ $i ][ 'total' ]   = $current[ TotalCharges ][ 0 ][ MonetaryValue ];
              $retArray[ $i ][ 'days' ]    = $current[ GuaranteedDaysToDelivery ];
              $retArray[ $i ][ 'time' ]    = $current[ ScheduledDeliveryTime ];
          }
          return $retArray;
      }
  }
?>
