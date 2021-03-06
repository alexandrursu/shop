<?php defined('_JEXEC') or die('Restricted access');
/*
Do not edit this file or it will be overwritten at the first upgrade
Copy from this source using another file name and select your own new created css in the module or plugin options
*/
$owner = JRequest::getVar("owner", "", "GET");
$id = JRequest::getVar("id", "", "GET");
?>
#contentmap_wrapper_plugin_<?php echo $id ?> img{max-width:none}

#contentmap_wrapper_<?php echo $owner; ?>_<?php echo $id; ?>
{
	width: <?php echo $this->Params->get("map_width", "100"); ?><?php echo $this->Params->get("map_width_unit", "%"); ?>;
	margin: auto; /*Horizontally center the map*/
	clear: both; /*Avoid overlapping with joomla article image, but it can create problems with some templates*/
}

#contentmap_container_<?php echo $owner; ?>_<?php echo $id; ?>
{
	padding: 6px; /*inner spacer*/
	margin: 24px 1px 0px 1px; /*outer spacer*/
	border-width: 1px;
	border-style: solid;
	border-color: #ccc #ccc #999 #ccc;
	-webkit-box-shadow: 0 2px 5px rgba(64, 64, 64, 0.5);
	-moz-box-shadow: 0 2px 5px rgba(64, 64, 64, 0.5);
	box-shadow: 0 2px 5px rgba(64, 64, 64, 0.5);
}

#contentmap_<?php echo $owner; ?>_<?php echo $id; ?>
{
	height: <?php echo $this->Params->get("map_height", "400"); ?>px;
	color: #505050;
}

#contentmap_<?php echo $owner; ?>_<?php echo $id; ?> a, #contentmap_<?php echo $owner; ?>_<?php echo $id; ?> a:hover, #contentmap_<?php echo $owner; ?>_<?php echo $id; ?> a:visited
{
	color: #0055ff;
}

/* Prevent max-width styles*/
#contentmap_<?php echo $owner; ?>_<?php echo $id; ?> img
{
    max-width:none;
}

/* Article image inside the balloon */
.intro_image
{
	margin: 8px;
}

/* Author alias inside the balloon */
.created_by_alias
{
	font-size: 0.8em;
	font-style:italic;
}

/* Creation date inside the balloon */
.created
{
	font-size: 0.8em;
	font-style:italic;
}


.contentmap-checkcontainer {
    margin-right: 30px;
    white-space: nowrap;
}
.contentmap-checkcontainer > span {
}

.contentmap-checkcontainer > .checkbox {
    margin: 0;
    margin-right:5px;
}
#contentmap_legend_<?php echo $owner; ?>_<?php echo $id; ?>{
    margin-top: 5px;
}

