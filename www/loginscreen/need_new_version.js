// Get client version and channel name from browser user agent to determine if we show upgrade information.
// See http://wiki.secondlife.com/wiki/Second_Life_Browser_User_Agent
//
// * As of 1.20.13     navigator.userAgent = "Mozilla/5.0 (Windows; U; Windows NT 5.1; chrome://navigator/locale/navigator.properties; rv:1.8.1.13) Gecko/20080314 SecondLife/1.20.13.0 (Second Life Release; default skin)";
// * As of 1.18.2.1    navigator.userAgent = "Mozilla/5.0 (Windows; U; Windows NT 5.1; chrome://navigator/locale/navigator.properties; rv:1.8.0.12) Gecko/20070605 [Second Life (Second Life Release) - 1.18.2.1]";
// * Prior to 1.18.2.1 navigator.userAgent = "Mozilla/5.0 (Windows; U; Windows NT 5.1; chrome://navigator/locale/navigator.properties; rv:1.8.0.12) Gecko/20070605 [Second Life 1.18.2.0]";

var user_agent = navigator.userAgent;
//~ var user_agent = "Mozilla/5.0 (Windows; U; Windows NT 5.1; chrome://navigator/locale/navigator.properties; rv:1.8.1.13) Gecko/20080314 SecondLife/1.20.13.0 (Second Life Release; default skin)";
//~ var user_agent = "Mozilla/5.0 (Windows; U; Windows NT 5.1; chrome://navigator/locale/navigator.properties; rv:1.8.0.12) Gecko/20070605 [Second Life (Second Life Release) - 1.18.2.1]";
//var user_agent = "Mozilla/5.0 (Windows; U; Windows NT 5.1; chrome://navigator/locale/navigator.properties; rv:1.8.0.12) Gecko/20070605 [Second Life (Second Life Release) - 1.18.2.0]"; // invalid
//var user_agent = "Mozilla/5.0 (Windows; U; Windows NT 5.1; chrome://navigator/locale/navigator.properties; rv:1.8.0.12) Gecko/20070605 [Second Life 1.21.5.0]";
var reChannelVersion_1_20 = new RegExp("SecondLife/([0-9.]+) \\((.*);.*\\)");
var reChannelVersion_1_18 = new RegExp("\\[Second Life \\((.*)\\) - ([0-9.]+)\\]");
var reChannelVersionOld   = new RegExp("\\[Second Life ([0-9.]+)\\]");

var DEFAULT_CHANNEL = "Second Life Release";
var channel, version;
if( user_agent.match( reChannelVersion_1_20 ) )
{
        version = RegExp.$1;
        channel = RegExp.$2;
}
else if( user_agent.match( reChannelVersion_1_18 ) )
{
        channel = RegExp.$1;
        version = RegExp.$2;
}
else if( user_agent.match( reChannelVersionOld ) )
{
        channel = DEFAULT_CHANNEL;
        version = RegExp.$1;
}
else
{
        channel = DEFAULT_CHANNEL;
}

var os = get_os_from_ua(user_agent);

function get_url(os, channel, version)
{
	if(os == "mac" || os == "win" || os == "lnx")
	{
		switch(channel)
		{
			case "Second Life Release":
				var url = "/app/login/versions/"+os+"_release.php?os="+os+"&channel="+channel+"&version="+version;
				break;
			case "Second Life Release Candidate":
				var url = "/app/login/versions/"+os+"_release_candidate.php?os="+os+"&channel="+channel+"&version="+version;
				break;
			default:
				var url = "/app/login/versions/"+os+"_release.php?os="+os+"&channel="+channel+"&version="+version;
		}
	}
	return url + "&i=20080229";
}

// Given two string of the form MAJOR.MINOR.PATCH.BUILD, return true if
// version_a is greater than version_b
function versionIsNewer(version_a, version_b)
{
	var version_a_parts = version_a.split('.');
	var version_b_parts = version_b.split('.');

	if (version_a_parts.length != version_b_parts.length)
		return false;

	for (var i=0; i < 4; i++) {
		var a_part = parseInt(version_a_parts[i], 10);
		var b_part = parseInt(version_b_parts[i], 10);

		// will be falsy if either are undefined
		if (a_part > b_part)
			return true;
		else if (a_part < b_part)
			return false;
	}

	// versions are equal,
	return false;
}

function getReleaseNotesUrl(channel, version)
{
	return 'http://secondlife.com/app/releasenotes/?channel='+channel+'&version='+version;
}

function extrapolate_os_from_user_agent(user_agent)
{
	var agent = user_agent.toLowerCase();
	if( agent.search("windows nt 5.1") != -1)
	{
		return "windows xp";
	}
	else if( agent.search("windows 98") != -1)
	{
		return "windows 98";
	}
	else if( agent.search("windows nt 5.0") != -1)
	{
		return "windows 2000";
	}
	else if( agent.search("windows nt 5.2") != -1)
	{
		return "windows 2003 server";
	}
	else if( agent.search("windows nt 6.0") != -1)
	{
		return "windows vista";
	}
	else if( agent.search("windows nt") != -1)
	{
		return "windows nt";
	}
	else if( agent.search("win 9x 4.90") != -1)
	{
		return "windows me";
	}
	else if( agent.search("win ce") != -1)
	{
		return "windows ce";
	}
	else if( agent.search("win 9x 4.90") != -1)
	{
		return "windows me";
	}
	else if( agent.search("mac os x") != -1)
	{
		return "mac os x";
	}
	else if( agent.search("macintosh") != -1)
	{
		return "macintosh";
	}
	else if( agent.search("linux") != -1)
	{
		return "linux";
	}
	else if( agent.search("freebsd") != -1)
	{
		return "freebsd";
	}
	else if( agent.search("symbian") != -1)
	{
		return "symbian";
	}
	else
	{
		return "false";
	}
}


function get_os_from_ua(user_agent)
{
	var raw_os = extrapolate_os_from_user_agent(user_agent);

	if( raw_os.search("win") != -1)
	{
		return "win";
	}
	else if( raw_os.search("mac") != -1)
	{
		return "mac";
	}
	else
	{
		return "lnx";
	}
}
