<?php
//include database class
include("db.php");

//set up your database
$host = "localhost:3306";
$username = "root";
$password = "";
$dbname = "bchan_forum";


$bchan_class = new bchanDB();
$conn = $bchan_class->conn($host, $username, $password, $dbname);
if(!$conn)
{
	echo "Can't connect to the database. : ".mysqli_error($conn);
}

//SQL Setup

//Table Admin
$sql_admin = "CREATE TABLE IF NOT EXISTS bchan_administrator (admin_id int(11) UNSIGNED AUTO_INCREMENT PRIMARY KEY, bchan_admin_name varchar(255) NOT NULL, bchan_admin_email varchar(255) NOT NULL, bchan_admin_password varchar(255) NOT NULL)";

//Table Forum 1
$sql_user = "CREATE TABLE IF NOT EXISTS bchan_user(id int(11) UNSIGNED AUTO_INCREMENT PRIMARY KEY,bchan_name varchar(255) NOT NULL, bchan_username varchar(255) NOT NULL, bchan_email varchar(255) NOT NULL, bchan_password varchar(255) NOT NULL, bchan_status boolean NOT NULL, bchan_birth date NOT NULL, bchan_photo varchar(255) NOT NULL, bchan_bio text NOT NULL)";

//Table Forum 1
$sql_forum_1 = "CREATE TABLE IF NOT EXISTS bchan_forum1(forum_id int(11) UNSIGNED AUTO_INCREMENT PRIMARY KEY, bchan_discussion_owner varchar(255) NOT NULL, bchan_discussion_title varchar(255) NOT NULL, bchan_discussion_content text NOT NULL, bchan_discussion_tag varchar(255), bchan_discussion_date varchar(255) NOT NULL,bchan_discussion_month int(11) NOT NULL, bchan_discussion_year int(11) NOT NULL, bchan_hits int(11) NOT NULL)";
//Table Forum 2
$sql_forum_2 = "CREATE TABLE IF NOT EXISTS bchan_forum2(forum_id int(11) UNSIGNED AUTO_INCREMENT PRIMARY KEY, bchan_discussion_owner varchar(255) NOT NULL, bchan_discussion_title varchar(255) NOT NULL, bchan_discussion_content text NOT NULL, bchan_disscusion_tag varchar(255), bchan_discussion_date varchar(255) NOT NULL, bchan_discussion_month int(11) NOT NULL, bchan_discussion_year int(11) NOT NULL, bchan_hits int(11) NOT NULL)";
//Table Forum 3
$sql_forum_3 = "CREATE TABLE IF NOT EXISTS bchan_forum3(forum_id int(11) UNSIGNED AUTO_INCREMENT PRIMARY KEY, bchan_discussion_owner varchar(255) NOT NULL, bchan_discussion_title varchar(255) NOT NULL, bchan_discussion_content text NOT NULL, bchan_disscusion_tag varchar(255), bchan_discussion_date varchar(255) NOT NULL, bchan_discussion_month int(11) NOT NULL, bchan_discussion_year int(11) NOT NULL, bchan_hits int(11) NOT NULL)";

//Table Forum 4
$sql_forum_4 = "CREATE TABLE IF NOT EXISTS bchan_forum4(forum_id int(11) UNSIGNED AUTO_INCREMENT PRIMARY KEY, bchan_discussion_owner varchar(255) NOT NULL, bchan_discussion_title varchar(255) NOT NULL, bchan_discussion_content text NOT NULL, bchan_disscusion_tag varchar(255), bchan_discussion_date varchar(255) NOT NULL, bchan_discussion_month int(11) NOT NULL, bchan_discussion_year int(11) NOT NULL, bchan_hits int(11) NOT NULL)";
//Table Forum 5
$sql_forum_5 = "CREATE TABLE IF NOT EXISTS bchan_forum5(forum_id int(11) UNSIGNED AUTO_INCREMENT PRIMARY KEY, bchan_discussion_owner varchar(255) NOT NULL, bchan_discussion_title varchar(255) NOT NULL, bchan_discussion_content text NOT NULL, bchan_disscusion_tag varchar(255), bchan_discussion_date varchar(255) NOT NULL, bchan_discussion_month int(11) NOT NULL, bchan_discussion_year int(11) NOT NULL, bchan_hits int(11) NOT NULL)";
//Table Forum 6
$sql_forum_6 = "CREATE TABLE IF NOT EXISTS bchan_forum6(forum_id int(11) UNSIGNED AUTO_INCREMENT PRIMARY KEY, bchan_discussion_owner varchar(255) NOT NULL, bchan_discussion_title varchar(255) NOT NULL, bchan_discussion_content text NOT NULL, bchan_disscusion_tag varchar(255), bchan_discussion_date varchar(255) NOT NULL, bchan_discussion_month int(11) NOT NULL, bchan_discussion_year int(11) NOT NULL, bchan_hits int(11) NOT NULL)";

//TAG / CATEGORY RULES
$sql_tag_forum = "CREATE TABLE IF NOT EXISTS bchan_tag(id int(11) UNSIGNED AUTO_INCREMENT PRIMARY KEY, bchan_tag varchar(255) NOT NULL)";
$sql_create_tag = "INSERT INTO bchan_tag(bchan_tag) VALUES('#ASK'), ('#INFO'), ('#RECOMENDATION'), ('#SHARE')";

$sql_anime_list = "CREATE TABLE IF NOT EXISTS bchan_anime(bchan_id int(11) UNSIGNED AUTO_INCREMENT PRIMARY KEY, bchan_anime_name varchar(255) NOT NULL, bchan_episode int(11) NOT NULL, bchan_status varchar(255) NOT NULL, bchan_aired varchar(255) NOT NULL, bchan_premiered varchar(255) NOT NULL, bchan_broadcast varchar(255) NOT NULL, bchan_producers varchar(255) NOT NULL, bchan_licensors varchar(255) NOT NULL, bchan_source varchar(255) NOT NULL, bchan_studios varchar(255) NOT NULL, bchan_genres varchar(255) NOT NULL, bchan_duration varchar(255) NOT NULL, bchan_rating varchar(255), bchan_synopsis text NOT NULL, bchan_picture text NOT NULL)";

$sql_check_table_tag = "SELECT * FROM bchan_tag";

if(!$bchan_class->q($conn, $sql_user))
{
	echo "Cant create table bchan_user !";
}
if(!$bchan_class->q($conn, $sql_forum_1))
{
	echo "Cant create table bchan_forum1 ! : ".mysqli_error($conn);
}
if(!$bchan_class->q($conn, $sql_forum_2))
{
	echo "Cant create table bchan_forum1 !";
}
if(!$bchan_class->q($conn, $sql_forum_3))
{
	echo "Cant create table bchan_forum1 !";
}
if(!$bchan_class->q($conn, $sql_forum_4))
{
	echo "Cant create table bchan_forum1 !";
}
if(!$bchan_class->q($conn, $sql_forum_5))
{
	echo "Cant create table bchan_forum1 !";
}
if(!$bchan_class->q($conn, $sql_forum_6))
{
	echo "Cant create table bchan_forum1 !";
}
if(!$bchan_class->q($conn, $sql_tag_forum))
{
	echo "Cant create table bchan_tag !";
}
if(!$bchan_class->q($conn, $sql_admin))
{
	echo "Cant create table bchan_administrator !";
}
if(!$bchan_class->q($conn, $sql_anime_list))
{
	echo "Cant create table bchan_anime !";
}

//check table tag
$query_check_tag = $bchan_class->q($conn, $sql_check_table_tag);
if(mysqli_num_rows($query_check_tag) == 0)
{
	if(!$bchan_class->q($conn, $sql_create_tag))
	{
		die("Error while adding a default tag :".mysqli_error($conn));
	}
}
?>