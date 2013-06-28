<?php
/* This file is part of a copyrighted work; it is distributed with NO WARRANTY.
 * See the file COPYRIGHT.html for more details.
 * 
 * 
 * Change History for Open City Library Project
 * 
 * #C1 - 	The first change has been to modify the home page
 * 			This has been done to enable non members to browse the library collection
 *          
 * 			Check the file OldIndex.php to see how how the home page looked previously
 * 
 */
 
  require_once("../shared/common.php");
  session_cache_limiter(null);

  $tab = "cataloging";
  $nav = "searchform";
  $focus_form_name = "barcodesearch";
  $focus_form_field = "searchText";

  //require_once("../shared/logincheck.php");
  require_once("../shared/header_no_nav.php");
  require_once("../classes/Localize.php");
  $loc = new Localize(OBIB_LOCALE,$tab);
  if (isset($_GET["msg"])) {
    $msg = "<font class=\"error\">".H($_GET["msg"])."</font><br><br>";
  } else {
    $msg = "";
  }

?>
<h1><img src="../images/catalog.png" border="0" width="30" height="30" align="top"> <?php echo "Welcome to Open City Library - Browse the Catalog";?></h1>

<form name="phrasesearch" method="POST" action="../shared/biblio_nonmember_search.php">
<table class="primary">
  <tr>
    <th valign="top" nowrap="yes" align="left">
      <?php echo $loc->getText("indexSearchHdr");?>:
    </td>
  </tr>
  <tr>
    <td nowrap="true" class="primary">
      <select name="searchType">
        <option value="keyword" selected><?php echo $loc->getText("indexKeyword");?>
        <option value="title"><?php echo $loc->getText("indexTitle");?>
        <option value="author"><?php echo $loc->getText("indexAuthor");?>
        <option value="subject"><?php echo $loc->getText("indexSubject");?>
        <option value="callno"><?php echo $loc->getText("biblioFieldsCallNmbr");?>
      </select>
      <input type="text" name="searchText" size="30" maxlength="256">
      <input type="hidden" name="sortBy" value="default">
      <input type="submit" value="<?php echo $loc->getText("indexButton");?>" class="button">
    </td>
  </tr>
</table>
</form>
<?php echo $msg ?>

<?php include("../shared/footer.php"); ?>

 