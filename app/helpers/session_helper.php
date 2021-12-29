<?php
	session_start();
	/**
	 * @return bool
	 * Check si l'utilisateur est connecté via le cookie dee seession
	 */
	function isLoggedIn() {
		if (isset($_SESSION['id_user'])) {
			return true;
		} else {
			return false;
		}
	}
