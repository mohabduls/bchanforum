<?php
class bchanUtils
{
	public function getServerUrl()
	{
		$server_url = $_SERVER['SERVER_NAME'];
		return $server_url;
	}

	public function getBaseUrl()
	{
		$base_url = $_SERVER['SERVER_NAME'].$_SERVER['REQUEST_URI'];
		return $base_url;
	}

	public function realString($conn, $string)
	{
		return mysqli_real_escape_string($conn, $string);
	}

	public function blockedString($string)
	{
		$illegal_string = $arrayName = array("'","=");
		if($string == array($illegal_string))
		{
			return false;
		}
		else
		{
			return true;
		}
	}

	//Filter Script
	public function filterHTML($string)
	{
		$illegalString = array("<script","</script>");
		$replaceTo = array("","");
		
		return str_replace($illegalString, $replaceTo, $string);
	}

	//SQL
	public function forumType($ft, $did)
	{
		switch($ft)
		{
			case "anime":
				{
					return "SELECT * FROM bchan_forum1 WHERE forum_id='$did'";
				}
			break;
			case "manga":
				{
					return "SELECT * FROM bchan_forum2 WHERE forum_id='$did'";
				}
			break;
			case "japanese":
				{
					return "SELECT * FROM bchan_forum3 WHERE forum_id='$did'";
				}
			break;
			case "liveaction":
				{
					return "SELECT * FROM bchan_forum4 WHERE forum_id='$did'";
				}
			break;
			case "film":
				{
					return "SELECT * FROM bchan_forum5 WHERE forum_id='$did'";
				}
			break;
			case "others":
				{
					return "SELECT * FROM bchan_forum6 WHERE forum_id='$did'";
				}
			break;
		}
	}

	public function getForumID($ft, $did)
	{
		switch($ft)
		{
			case "anime":
				{
					return "SELECT * FROM bchan_forum1 WHERE forum_id='$did'";
				}
			break;
			case "manga":
				{
					return "SELECT * FROM bchan_forum2 WHERE forum_id='$did'";
				}
			break;
			case "japanese":
				{
					return "SELECT * FROM bchan_forum3 WHERE forum_id='$did'";
				}
			break;
			case "liveaction":
				{
					return "SELECT * FROM bchan_forum4 WHERE forum_id='$did'";
				}
			break;
			case "film":
				{
					return "SELECT * FROM bchan_forum5 WHERE forum_id='$did'";
				}
			break;
			case "others":
				{
					return "SELECT * FROM bchan_forum6 WHERE forum_id='$did'";
				}
			break;
		}
	}

	public function addHits($ft, $did, $hits)
	{
		switch($ft)
		{
			case "anime":
				{
					return "UPDATE bchan_forum1 SET bchan_hits='$hits' WHERE forum_id='$did'";
				}
			break;
			case "manga":
				{
					return "UPDATE bchan_forum2 SET bchan_hits='$hits' WHERE forum_id='$did'";
				}
			break;
			case "japanese":
				{
					return "UPDATE bchan_forum3 SET bchan_hits='$hits' WHERE forum_id='$did'";
				}
			break;
			case "liveaction":
				{
					return "UPDATE bchan_forum4 SET bchan_hits='$hits' WHERE forum_id='$did'";
				}
			break;
			case "film":
				{
					return "UPDATE bchan_forum5 SET bchan_hits='$hits' WHERE forum_id='$did'";
				}
			break;
			case "others":
				{
					return "UPDATE bchan_forum6 SET bchan_hits='$hits' WHERE forum_id='$did'";
				}
			break;
		}
	}

	public function getHits($ft, $did)
	{
		switch($ft)
		{
			case "anime":
				{
					return "SELECT bchan_hits FROM bchan_forum1 WHERE forum_id='$did'";
				}
			break;
			case "manga":
				{
					return "SELECT bchan_hits FROM bchan_forum2 WHERE forum_id='$did'";
				}
			break;
			case "japanese":
				{
					return "SELECT bchan_hits FROM bchan_forum3 WHERE forum_id='$did'";
				}
			break;
			case "liveaction":
				{
					return "SELECT bchan_hits FROM bchan_forum4 WHERE forum_id='$did'";
				}
			break;
			case "film":
				{
					return "SELECT bchan_hits FROM bchan_forum5 WHERE forum_id='$did'";
				}
			break;
			case "others":
				{
					return "SELECT bchan_hits FROM bchan_forum6 WHERE forum_id='$did'";
				}
			break;
		}
	}

	public function moreDiscussion($forumType, $discussionType, $start, $end)
	{
		switch($forumType)
		{
			case "anime":
				{
					return "SELECT * FROM bchan_forum1 WHERE bchan_discussion_tag='#$discussionType' ORDER BY forum_id DESC LIMIT $start, $end";
				}
			break;
			case "manga":
				{
					return "SELECT * FROM bchan_forum2 WHERE bchan_discussion_tag='#$discussionType' ORDER BY forum_id DESC LIMIT $start, $end";
				}
			break;
			case "japanese":
				{
					return "SELECT * FROM bchan_forum3 WHERE bchan_discussion_tag='#$discussionType' ORDER BY forum_id DESC LIMIT $start, $end";
				}
			break;
			case "liveaction":
				{
					return "SELECT * FROM bchan_forum4 WHERE bchan_discussion_tag='#$discussionType' ORDER BY forum_id DESC LIMIT $start, $end";
				}
			break;
			case "film":
				{
					return "SELECT * FROM bchan_forum5 WHERE bchan_discussion_tag='#$discussionType' ORDER BY forum_id DESC LIMIT $start, $end";
				}
			break;
			case "others":
				{
					return "SELECT * FROM bchan_forum6 WHERE bchan_discussion_tag='#$discussionType' ORDER BY forum_id DESC LIMIT $start, $end";
				}
			break;
		}
	}

	public function countDiscussion($forumType, $discussionTag)
	{
		switch($forumType)
		{
			case "anime":
				{
					return "SELECT COUNT(*) AS bchan_total FROM bchan_forum1 WHERE bchan_discussion_tag='#$discussionTag'";
				}
			break;
			case "manga":
				{
					return "SELECT COUNT(*) AS bchan_total FROM bchan_forum2 WHERE bchan_discussion_tag='#$discussionTag'";
				}
			break;
			case "japanese":
				{
					return "SELECT COUNT(*) AS bchan_total FROM bchan_forum3 WHERE bchan_discussion_tag='#$discussionTag'";
				}
			break;
			case "liveaction":
				{
					return "SELECT COUNT(*) AS bchan_total FROM bchan_forum4 WHERE bchan_discussion_tag='#$discussionTag'";
				}
			break;
			case "film":
				{
					return "SELECT COUNT(*) AS bchan_total FROM bchan_forum5 WHERE bchan_discussion_tag='#$discussionTag'";
				}
			break;
			case "others":
				{
					return "SELECT COUNT(*) AS bchan_total FROM bchan_forum6 WHERE bchan_discussion_tag='#$discussionTag'";
				}
			break;
		}
	}

	public function totalDiscussion($forumType, $discussionTag)
	{
		switch($forumType)
		{
			case "anime":
				{
					return "SELECT * FROM bchan_forum1 WHERE bchan_discussion_tag='#$discussionTag' ORDER BY forum_id DESC";
				}
			break;
			case "manga":
				{
					return "SELECT * FROM bchan_forum2 WHERE bchan_discussion_tag='#$discussionTag' ORDER BY forum_id DESC";
				}
			break;
			case "japanese":
				{
					return "SELECT * FROM bchan_forum3 WHERE bchan_discussion_tag='#$discussionTag' ORDER BY forum_id DESC";
				}
			break;
			case "liveaction":
				{
					return "SELECT * FROM bchan_forum4 WHERE bchan_discussion_tag='#$discussionTag' ORDER BY forum_id DESC";
				}
			break;
			case "film":
				{
					return "SELECT * FROM bchan_forum5 WHERE bchan_discussion_tag='#$discussionTag' ORDER BY forum_id DESC";
				}
			break;
			case "others":
				{
					return "SELECT * FROM bchan_forum6 WHERE bchan_discussion_tag='#$discussionTag' ORDER BY forum_id DESC";
				}
			break;
		}
	}

	public function checkUser($username)
	{
		$sql_check_user = "SELECT * FROM bchan_user WHERE bchan_username='$username'";
		return $sql_check_user;
	}

	public function verifyUser($username)
	{
		$sql_verify_user = "UPDATE bchan_user SET bchan_status=true WHERE bchan_username='$username'";
		return $sql_verify_user;
	}

	public function getName($username)
	{
		return "SELECT * FROM bchan_user WHERE bchan_username='$username'";
	}

	public function checkForumType($ft)
	{
		$forum_type = array("anime","manga","japanese","liveaction","film","others");
		if(in_array($ft, $forum_type))
		{
			return true;
		}
		else
		{
			return false;
		}
	}

	public function getThisServer()
	{
		$protocol = stripos($_SERVER['SERVER_PROTOCOL'],'https') === 0 ? 'https://' : 'http://';
		$hostname = $_SERVER['SERVER_NAME'];
		$port = $_SERVER['SERVER_PORT'];
		return $protocol.$hostname;
	}
	public function getServerPort()
	{
		$port = $_SERVER['SERVER_PORT'];
		return $port;
	}

	public function dangerChars($string)
	{
		$chars = array("'","=","/",",",";");
		if(in_array($string, $chars))
		{
			return true;
		}
		else
		{
			return false;
		}
	}

	public function tagReplacer($string)
	{
		$object = array(" ");
		return str_replace($object,"-",$string);
	}

	public function redirectURI(int $time,$url)
	{
		$uri = $url;
		header("Refresh: $time; URL=$url");
	}
}
?>