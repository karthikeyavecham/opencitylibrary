<?php
/* This file is part of a copyrighted work; it is distributed with NO WARRANTY.
 * See the file COPYRIGHT.html for more details.
 */
 
  require_once("../shared/common.php");
  $tab = "circulation";
  $restrictToMbrAuth = TRUE;
  $nav = "delete";
  require_once("../shared/logincheck.php");
  require_once("../classes/Location.php");
  require_once("../classes/LocationQuery.php");
  require_once("../classes/BiblioSearchQuery.php");
  require_once("../classes/BiblioHoldQuery.php");
  require_once("../classes/Localize.php");
  $loc = new Localize(OBIB_LOCALE,$tab);

  $locationid = $_GET["locid"];

  #****************************************************************************
  #*  Getting Location name
  #****************************************************************************
  $locQ = new LocationQuery();
  $locQ->connect();
  $location = $locQ->get($locationid);
  $locQ->close();
  $locationName = $location->getFirstName()." ".$location->getLastName();

  #****************************************************************************
  #*  Check to see if there are any books checked out
  #****************************************************************************
  $biblioQ = new BiblioSearchQuery();
  $biblioQ->connect();
  if ($biblioQ->errorOccurred()) {
    $biblioQ->close();
    displayErrorPage($biblioQ);
  }
  if (!$biblioQ->checkoutLocationQuery(OBIB_STATUS_OUT,$locationid)) {
    $biblioQ->close();
    displayErrorPage($biblioQ);
  }
  $checkoutCount = $biblioQ->getRowCount();
  $biblioQ->close();

  #****************************************************************************
  #*  Getting hold request count based on location
  #****************************************************************************
  $holdQ = new BiblioHoldQuery();
  $holdQ->connect();
  if ($holdQ->errorOccurred()) {
    $holdQ->close();
    displayErrorPage($holdQ);
  }
  $holdQ->queryByLocationid($locationid);
  if ($holdQ->errorOccurred()) {
    $holdQ->close();
    displayErrorPage($holdQ);
  }
  $holdCount = $holdQ->getRowCount();
  $holdQ->close();
  
  #**************************************************************************
  #*  Show confirm page
  #**************************************************************************
  require_once("../shared/header.php");

  if (($checkoutCount > 0) or ($holdCount > 0)) {
?>
<center>
  <?php echo $loc->getText("locDelConfirmWarn",array("name"=>$locationName,"checkoutCount"=>$checkoutCount,"holdCount"=>$holdCount)); ?>
  <br><br>
  <a href="../circ/loc_view.php?locid=<?php echo HURL($locid);?>&amp;reset=Y"><?php echo $loc->getText("locDelConfirmReturn"); ?></a>
</center>

<?php
  } else {
?>
<center>
<form name="delLocationform" method="POST" action="../circ/loc_view.php?locid=<?php echo HURL($locid);?>&amp;reset=Y">
<?php echo $loc->getText("locDelConfirmMsg",array("name"=>$locationName)); ?>
<br><br>
      <input type="button" onClick="self.location='../circ/loc_del.php?locid=<?php echo H(addslashes(U($locid)));?>&amp;name=<?php echo H(addslashes(U($locationName)));?>'" value="<?php echo $loc->getText("circDelete"); ?>" class="button">
      <input type="submit" value="<?php echo $loc->getText("circCancel"); ?>" class="button">
</form>
</center>
<?php 
  }
  include("../shared/footer.php");
?>
