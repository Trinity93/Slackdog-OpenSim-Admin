<?
/* ------------------------------------------------------------------------
 * session_mysql.php
 * ------------------------------------------------------------------------
 * PHP4 MySQL Session Handler
 * Version 1.00
 * by Ying Zhang (ying@zippydesign.com)
 * Last Modified: May 21 2000
 *
 * ------------------------------------------------------------------------
 * TERMS OF USAGE:
 * ------------------------------------------------------------------------
 * You are free to use this library in any way you want, no warranties are
 * expressed or implied.  This works for me, but I don't guarantee that it
 * works for you, USE AT YOUR OWN RISK.
 *
 * While not required to do so, I would appreciate it if you would retain
 * this header information.  If you make any modifications or improvements,
 * please send them via email to Ying Zhang <ying@zippydesign.com>.
 *
 * ------------------------------------------------------------------------
 * DESCRIPTION:
 * ------------------------------------------------------------------------
 * This library tells the PHP4 session handler to write to a MySQL database
 * instead of creating individual files for each session.
 *
 * Create a new database in MySQL called "sessions" like so:
 *
 * CREATE TABLE sessions (
 *      sesskey char(32) not null,
 *      expiry int(11) unsigned not null,
 *      value text not null,
 *      PRIMARY KEY (sesskey)
 * );
 *
 * ------------------------------------------------------------------------
 * INSTALLATION:
 * ------------------------------------------------------------------------
 * Make sure you have MySQL support compiled into PHP4.  Then copy this
 * script to a directory that is accessible by the rest of your PHP
 * scripts.
 *
 * ------------------------------------------------------------------------
 * USAGE:
 * ------------------------------------------------------------------------
 * Include this file in your scripts before you call session_start(), you
 * don't have to do anything special after that.
 */

$SESS_DBHOST = $mysql_host;			/* database server hostname */
$SESS_DBNAME = $mysql_db;			/* database name */
$SESS_DBUSER = $mysql_user;		/* database user */
$SESS_DBPASS = $mysql_pwd;		/* database password */

$SESS_DBH = "";
$SESS_LIFE = get_cfg_var("session.gc_maxlifetime");

function sess_open($save_path, $session_name) {
	global $SESS_DBHOST, $SESS_DBNAME, $SESS_DBUSER, $SESS_DBPASS, $SESS_DBH;

	if (! $SESS_DBH = mysql_pconnect($SESS_DBHOST, $SESS_DBUSER, $SESS_DBPASS)) {
		echo "<li>Can't connect to $SESS_DBHOST as $SESS_DBUSER";
		echo "<li>MySQL Error: ", mysql_error();
		die;
	}

	if (! mysql_select_db($SESS_DBNAME, $SESS_DBH)) {
		echo "<li>Unable to select database $SESS_DBNAME";
		die;
	}

	return true;
}

function sess_close() {
	return true;
}

function sess_read($key) {
	global $SESS_DBH, $SESS_LIFE;

	$qry = "SELECT value FROM sessions WHERE sesskey = '$key' AND expiry > " . time();
	$qid = mysql_query($qry, $SESS_DBH);

	if (list($value) = mysql_fetch_row($qid)) {
		return stripslashes($value);
	}

	return '';
}

function sess_write($key, $val) {
	global $SESS_DBH, $SESS_LIFE;

	$expiry = time() + $SESS_LIFE;
	$value = addslashes($val);

	$qry = "INSERT INTO sessions VALUES ('$key', $expiry, '$value')";
	$qid = mysql_query($qry, $SESS_DBH);

	if (! $qid) {
//		$qry = "UPDATE sessions SET expiry = $expiry, value = '$value' WHERE sesskey = '$key' AND expiry > " . time();
		$qry = "UPDATE sessions SET expiry = $expiry, value = '$value' WHERE sesskey = '$key'";
		$qid = mysql_query($qry, $SESS_DBH);
	}

	return $qid;
}

function sess_destroy($key) {
	global $SESS_DBH;

	$qry = "DELETE FROM sessions WHERE sesskey = '$key'";
	$qid = mysql_query($qry, $SESS_DBH);

	return $qid;
}

function sess_gc($maxlifetime) {
	global $SESS_DBH;

	$qry = "DELETE FROM sessions WHERE expiry < " . time();
	$qid = mysql_query($qry, $SESS_DBH);

	return mysql_affected_rows($SESS_DBH);
}

session_set_save_handler(
	"sess_open",
	"sess_close",
	"sess_read",
	"sess_write",
	"sess_destroy",
	"sess_gc");
?>
