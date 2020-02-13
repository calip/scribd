<?php
/**
 * Scribd Embed
 * 
 * Scribd documents or documents supported by Scribd (e.g. PDF, MS Office, ePub, and many others) can be embedded into schlix using the Scribd Docs Reader
 *
 * @copyright 2020 Beplas Studio
 *
 * @license MIT
 *
 * @package scribdembed
 * @version 1.0
 * @author  Beplas Studio <alip@beplasstudio.com>
 * @link    https://beplasstudio.com/
 */
if (!defined('SCHLIX_VERSION')) die('No Access');
?>
<iframe width="100%" height="600" src="https://www.scribd.com/embeds/<?= ___($id)?>/content?start_page=1&view_mode=lis" frameborder="0"></iframe>