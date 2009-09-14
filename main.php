<?php

if (!defined('DOKU_INC')) die();

define('H6E_CSS', DOKU_URL . 'lib/tpl/minimal');

if (empty($_REQUEST['do']) || in_array($_REQUEST['do'], array('revisions', 'show', 'edit'))) {
    $page_type = 'content-page';
} else {
    $page_type = 'do-page';
}

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN"
 "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="<?php echo $conf['lang']?>"
 lang="<?php echo $conf['lang']?>" dir="<?php echo $lang['direction']?>">
<head>
  <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
  <title><?php tpl_pagetitle() ?> - <?php echo strip_tags($conf['title']) ?></title>

  <link rel="stylesheet" media="screen" href="<?php echo H6E_CSS ?>/h6e-minimal/h6e-minimal.css" />

  <?php tpl_metaheaders()?>
  
  <style type="text/css">

  .h6e-main-content {
      width:<?php echo tpl_getConf('width') ?>;
      padding-left:2.5em;
      padding-right:2.5em;
  }
  .h6e-post-content {
      font-size:<?php echo tpl_getConf('font-size') ?>;
  }
  .h6e-entry-title, .h6e-entry-title a, .h6e-entry-title a:visited, .do-page h1 {
      color:<?php echo tpl_getConf('title-color') ?>;
  }
  </style>

</head>

<body>

<div class="dokuwiki">

  <?php html_msgarea()?>

  <?php
  if (tpl_getConf('topbar') == 'never') {
      $top_bar = false;
  } else if (tpl_getConf('topbar') == 'connected' && empty($_SERVER['REMOTE_USER'])) {
      $top_bar = false;
  } else {
      $top_bar = true;
  }
  ?>

  <?php if (class_exists('Ld_Ui') && method_exists('Ld_Ui', 'top_bar') && $top_bar) : ?>
     <?php Ld_Ui::top_bar() ?>
  <?php else : ?>
      <div class="user-info" style="float:right">
        <?php tpl_userinfo()?>
        <?php tpl_actionlink('subscribe') ?>
        <?php tpl_actionlink('subscribens') ?>

        <?php tpl_actionlink('profile') ?>
        <?php tpl_actionlink('admin') ?>
        <?php tpl_actionlink('login'); ?>
      </div>
  <?php endif ?>

  <div style="padding-left: 30px;">
  <h4><a href="/">The Singularity</a> &gt; <?php tpl_link(wl(),$conf['title'],'name="dokuwiki__top" id="dokuwiki__top" accesskey="h" title="[ALT+H]"') ?> &gt; <?php tpl_actionlink('backlink')?> </h4>
  </div>

  <div class="<?php echo $page_type ?> h6e-main-content">

    <div style="float:right">
    <?php tpl_searchform() ?>
    </div>
    <div class="actions actions-page">
        <?php tpl_button('edit')?>
        <?php tpl_button('history')?>
    </div>

    <?php if (!tpl_getConf('hide-entry-title')){?>
        <h2 class="h6e-entry-title">
        [[<?php tpl_link(wl($ID,'do=backlink'),tpl_pagetitle($ID,true),'title="'.$lang['btn_backlink'].'"')?>]]
        </h2>
    <?php }?>

    <?php if($conf['breadcrumbs']){?>
    <div class="breadcrumbs">
      <?php tpl_breadcrumbs() ?>
    </div>
    <?php }?>

    <?php if($conf['youarehere']){?>
    <div class="breadcrumbs">
      <?php tpl_youarehere() ?>
    </div>
    <?php }?>

    <div id="wikipage" class="h6e-post-content">
        <?php tpl_content()?>
    </div>

    <div class="pageinfo">
        <?php tpl_pageinfo()?>
    </div>

    <div class="h6e-simple-footer">

      <div class="actions actions-site">
          <div class="a">
              <?php tpl_button('recent')?>
              <?php tpl_button('index')?>
          </div>
      </div>

      <p><?php echo tpl_getConf('footer-text') ?></p>

    </div>

  </div>

</div>

<div class="no"><?php /* provide DokuWiki housekeeping, required in all templates */ tpl_indexerWebBug()?></div>

</body>
</html>
