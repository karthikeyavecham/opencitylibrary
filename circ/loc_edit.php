<?php
/* This file is part of a copyrighted work; it is distributed with NO WARRANTY.
 * See the file COPYRIGHT.html for more details.
 */
 
  require_once("../shared/common.php");
  $tab = "circulation";
  $restrictToMbrAuth = TRUE;
  $nav = "edit";
  $restrictInDemo = true;
  require_once("../shared/logincheck.php");

  require_once("../classes/Location.php");
  require_once("../classes/LocationQuery.php");
  require_once("../classes/DmQuery.php");
  require_once("../functions/errorFuncs.php");
  require_once("../classes/Localize.php");
  $loc = new Localize(OBIB_LOCALE,$tab);

  #****************************************************************************
  #*  Checking for post vars.  Go back to form if none found.
  #****************************************************************************

  if (count($_POST) == 0) {
    header("Location: ../circ/index.php");
    exit();
  }

  #****************************************************************************
  #*  Validate data
  #****************************************************************************
  $locid = $_POST["locationid"];

  $location = new Location();
  $location->setLocationid($_POST["locationid"]);
  $_POST["locationid"] = $location->getLocationid();
  $location->setAddressOne($_POST["location"]);
  $_POST["location"] = $location->getAddressOne();
  $location->setAddressTwo($_POST["address"]);
  $_POST["address"] = $location->getAddressTwo();
  $location->setLastChangeUserid($_SESSION["userid"]);
  $location->setStaffid($_POST["staffid"]);
  $_POST["staffid"] = $location->getStaffid();
  $location->setCity($_POST["city"]);
  $_POST["city"] = $location->getCity();
  $location->setState($_POST["state"]);
  $_POST["state"] = $location->getState();
  $location->setPincode($_POST["pincode"]);
  $_POST["pincode"] = $location->getPincode();
  $location->setDays($_POST["days"]);
  $_POST["days"] = $location->getDays();
  $location->setTime($_POST["time"]);
  $_POST["time"] = $location->getTime();
  $location->setLatitude($_POST["latitude"]);
  $_POST["latitude"] = $location->getLatitude();
  $location->setLongitude($_POST["longitude"]);
  $_POST["longitude"] = $location->getLongitude();
  
  
  #**************************************************************************
  #*  Update library Location
  #**************************************************************************
  $locationQ = new LocationQuery();
  $locationQ->update($location);
  $locationQ->close();

  #**************************************************************************
  #*  Destroy form values and errors
  #**************************************************************************
  unset($_SESSION["postVars"]);
  unset($_SESSION["pageErrors"]);

  $msg = $loc->getText("locEditSuccess");
  header("Location: ../circ/loc_view.php?locationid=".U($location->getLocationid())."&reset=Y&msg=".U($msg));
  exit();
?>
