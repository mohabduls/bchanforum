<?php

class bchanControls{
    public function areYouAdmin(){
        if(!empty($_SESSION['bchan_administrator_mode'])){
            return true;
        }
        else{
            return false;
        }
    }

    public function delPost($ft, $pid){
        switch($ft)
		{
			case "anime":
				{
					return "DELETE FROM bchan_forum1 WHERE forum_id='$pid'";
				}
			break;
			case "manga":
				{
					return "DELETE FROM bchan_forum2 WHERE forum_id='$pid'";
				}
			break;
			case "japanese":
				{
					return "DELETE FROM bchan_forum3 WHERE forum_id='$pid'";
				}
			break;
			case "liveaction":
				{
					return "DELETE FROM bchan_forum4 WHERE forum_id='$pid'";
				}
			break;
			case "film":
				{
					return "DELETE FROM bchan_forum5 WHERE forum_id='$pid'";
				}
			break;
			case "others":
				{
					return "DELETE FROM bchan_forum6 WHERE forum_id='$pid'";
				}
			break;
		}
    }
}

?>