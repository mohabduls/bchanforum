<?php 
/*
Copyright 2020
Bchan - Bacod Chan Forum
Coded by : Mohamad Abdul Sobur
https://www.facebook.com/dul86
https://www.linkedin.com/in/mohabduls
https://github.com/mohabduls
Based on PHP NATIVE
*/
header("Content-type: text/xml");
include_once("system/utils.php");
include_once("system/connection.php");
include_once("system/bchan-controls.php");
$controls = new bchanControls();
$utils = new bchanUtils();
$bchan_domain = $utils->getThisServer()."/";
?>
<?xml version='1.0' encoding='UTF-8' standalone='yes'?>
<urlset xmlns="http://www.google.com/schemas/sitemap/0.84" xmlns:xsi="http://www.w3.org/2001/XMLSchema-instance" xsi:schemaLocation="http://www.google.com/schemas/sitemap/0.84 http://www.google.com/schemas/sitemap/0.84/sitemap.xsd">
    <valid>
        <url>
            <loc><?php echo $bchan_domain; ?></loc>
            <priority>1.00</priority>
        </url>

        <url>
            <loc><?php echo $bchan_domain ?>login</loc>
            <priority>1.00</priority>
        </url>

        <url>
            <loc><?php echo $bchan_domain; ?>signup</loc>
            <priority>1.00</priority>
        </url>

        <url>
            <loc><?php echo $bchan_domain; ?>anime</loc>
            <priority>1.00</priority>
        </url>
        <?php
        //Forum 1
        $sql_discussion_result = "SELECT * FROM bchan_forum1 ORDER BY forum_id";
        $result = $bchan_class->q($conn, $sql_discussion_result);
        while($row = mysqli_fetch_assoc($result))
        { 
        $dis_id = $row['forum_id'];
        ?>
        <url>
            <loc><?php echo $bchan_domain."anime?did=".$dis_id."&amp;ft=anime"; ?></loc>
            <changefreq>monthly</changefreq>
            <priority>0.5</priority>
        </url>
        <?php
        } 
        ?>
    </valid>
</urlset>