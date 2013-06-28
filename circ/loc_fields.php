<?php
/* This file is part of a copyrighted work; it is distributed with NO WARRANTY.
 * See the file COPYRIGHT.html for more details.
 */

  require_once("../functions/inputFuncs.php");
  $fields = array(
    "locFldsAddr2" => inputField('text', "location", $location->getAddressTwo()),
    "locFldsAddr1" => inputField('text', "locAddress", $location->getAddressOne()),
    "locFldsCity" => inputField('text', "locCity", $location->getCity()),
    "locFldsPincode" => inputField('text', "locPinCode", $location->getPincode()),
    "locFldsState" => inputField('textarea', "locState", $location->getState()),
  );
  
?>

<table class="primary">
  <tr>
    <th colspan="2" valign="top" nowrap="yes" align="left">
      <?php echo H($headerWording);?> <?php echo $loc->getText("locFldsHeader"); ?>
    </td>
  </tr>
<?php
  foreach ($fields as $title => $html) {
?>
  <tr>
    <td nowrap="true" class="primary" valign="top">
      <?php echo $loc->getText($title); ?>
    </td>
    <td valign="top" class="primary">
      <?php echo $html; ?>
    </td>
  </tr>
<?php
  }
?>
  <tr>
    <td align="center" colspan="2" class="primary">
      <input type="submit" value="<?php echo $loc->getText("locFldsSubmit"); ?>" class="button">
      <input type="button" onClick="self.location='<?php echo H(addslashes($cancelLocation));?>'" value="<?php echo $loc->getText("locFldsCancel"); ?>" class="button">
    </td>
  </tr>

</table>
