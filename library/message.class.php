<?php

class Message {
	
	//-----------------------------------------------------------------------------------------------
	// Class Variables
	//-----------------------------------------------------------------------------------------------	
	var $msgId;
	var $msgTypes = array( 'help', 'info', 'warning', 'success', 'error' );
	var $msgClass = 'alert';
	//var $msgWrapper = "<div class='%s %s'><a href='#' class='closeMessage'></a>\n%s</div>\n";
	var $msgBefore = "";
	var $msgAfter = "";
    var $msgWrapper = "<div class='%s %s'><button class='close' data-dismiss='alert' type='button'>×</button>\n%s</div>\n";

    /**
	 * Constructor
	 * @author Mike Everhart
	 */
	public function __construct() {
	
		// Generate a unique ID for this user and session
		$this->msgId = md5(uniqid());
		
		// Create the session array if it doesnt already exist
		if( !array_key_exists('flash_messages', $_SESSION) ) $_SESSION['flash_messages'] = array();
		
	}
	
	/**
	 * Add a message to the queue
	 * 
	 * @param  string   $type        	The type of message to add
	 * @param  string   $message     	The message
	 * @param  string   $redirect_to 	(optional) If set, the user will be redirected to this URL
	 * @return  bool 
	 * 
	 */
	public function set($type, $message, $redirect_to=null) {
		
		if( !isset($_SESSION['flash_messages']) ) return false;
		
		if( !isset($type) || !isset($message[0]) ) return false;

		// Replace any shorthand codes with their full version
		if( strlen(trim($type)) == 1 ) {
			$type = str_replace( array('h', 'i', 'w', 'e', 's'), array('help', 'info', 'warning', 'error', 'success'), $type );
		
		// Backwards compatibility...
		} elseif( $type == 'information' ) {
			$type = 'info';	
		}
		
		// Make sure it's a valid message type
		if( !in_array($type, $this->msgTypes) ) die('"' . strip_tags($type) . '" is not a valid message type!' );
		
		// If the session array doesn't exist, create it
		if( !array_key_exists( $type, $_SESSION['flash_messages'] ) ) $_SESSION['flash_messages'][$type] = array();

        $_SESSION['flash_messages'][$type][] = $message;

        if( !is_null($redirect_to) ) {
			header("Location: $redirect_to");
			exit();
		}
		return true;
	}
	
	/**
	 * Display the queued messages
	 * 
	 * @param  string   $type     Which messages to display
	 * @param  bool  	$print    True  = print the messages on the screen
	 * @return mixed              
	 * 
	 */
	public function get($type='all', $print=true) {
		$messages = '';
		$data = '';

		if( !isset($_SESSION['flash_messages']) ) return false;

		// Print a certain type of message?
		if( in_array($type, $this->msgTypes) ) {
			foreach( $_SESSION['flash_messages'][$type] as $msg ) {
				$messages .= $this->msgBefore . $msg . $this->msgAfter;
			}

			$data .= sprintf($this->msgWrapper, $this->msgClass, 'alert-'.$type, $messages);
			
			//Clear the viewed messages
			$this->clear($type);
		
		// Print ALL queued messages
		} elseif( $type == 'all' ) {

            foreach( $_SESSION['flash_messages'] as $type => $msgArray ) {
				$messages = '';
				foreach( $msgArray as $msg ) {
					$messages .= $this->msgBefore . $msg . $this->msgAfter;	
				}
				$data .= sprintf($this->msgWrapper, $this->msgClass, 'alert-'.$type, $messages);
            }

            // Clear ALL of the messages
            $this->clear();

		} else {
            // Invalid Message Type?
			return false;
		}

        // Print everything to the screen or return the data
		if( $print ) { 
			echo $data; 
		} else { 
			return $data; 
		}
	}
	
	
	/**
	 * Check to  see if there are any queued error messages
	 * 
	 * @return bool  true  = There ARE error messages
	 *               false = There are NOT any error messages
	 * 
	 */
	public function hasErrors() { 
		return empty($_SESSION['flash_messages']['error']) ? false : true;	
	}
	
	/**
	 * Check to see if there are any ($type) messages queued
	 * 
	 * @param  string   $type     The type of messages to check for
	 * @return bool            	  
	 * 
	 */
	public function hasMessages($type=null) {
		if( !is_null($type) ) {
			if( !empty($_SESSION['flash_messages'][$type]) ) return $_SESSION['flash_messages'][$type];	
		} else {
			foreach( $this->msgTypes as $type ) {
				if( !empty($_SESSION['flash_messages']) ) return true;	
			}
		}
		return false;
	}
	
	/**
	 * Clear messages from the session data

	 * @param  string   $type     The type of messages to clear
	 * @return bool 
	 * 
	 */
	public function clear($type='all') { 
		if( $type == 'all' ) {
			unset($_SESSION['flash_messages']);
		} else {
			unset($_SESSION['flash_messages'][$type]);
		}
		return;
	}
	
	public function __toString() {
        return $this->hasMessages();
    }

	public function __destruct() {
		//$this->clear();
	}


} // end class
?>