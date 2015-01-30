<!DOCTYPE html>
<html class="lockscreen">
<head>
<meta charset="UTF-8">
<title data-i18n="app.title">Horizon Wallet</title>
<meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport" />
<meta http-equiv="X-UA-Compatible" content="IE=edge" />
<link href='http://fonts.googleapis.com/css?family=Droid+Serif|Oswald' rel='stylesheet' type='text/css'>
<link href="css/bootstrap.min.css" rel="stylesheet" type="text/css" />
<link href="css/font-awesome.min.css" rel="stylesheet" type="text/css" />
<link href="css/ionicons.min.css" rel="stylesheet" type="text/css" />
<link href="css/app.css" rel="stylesheet" type="text/css" />
<link href="css/nhz.css" rel="stylesheet" type="text/css" />
<style id="user_header_style" type="text/css"></style>
<style id="user_sidebar_style" type="text/css"></style>
<style id="user_background_style" type="text/css"></style>
<style id="user_page_header_style" type="text/css"></style>
<style id="user_box_style" type="text/css"></style>
<style id="user_table_style" type="text/css"></style>
</head>
<body class="lockscreen fixed">

<!-- BEGIN LOCKSCREEN PAGE -->
<?php include 'includes/page-lockscreen.php' ?>
<!-- END LOCKSCREEN PAGE -->


<!-- BEGIN PAGE HEADER TOP BAR -->
<?php include 'includes/page-header-top-bar.php' ?>
<!-- END PAGE HEADER TOP BAR -->

<div id="page" class="wrapper row-offcanvas row-offcanvas-left">
  
<!-- BEGIN LEFT SIDEBAR MENU -->
<?php // include 'includes/left-sidebar-menu.php' ?>
<!-- END LEFT SIDEBAR MENU --> 
  
	<aside class="right-side">
    
<!-- BEGIN DASHBOARD PAGE --> <!-- COMPLETE -->
<div id="dashboard_page" class="page" style="display:block; padding:50px;">
  <section class="content-header">
    <div class="row topheading">
      <div class="col-lg-2">
        <h1><i class="fa fa-dashboard"></i></h1>
      </div>
      <div class="col-lg-10">
        <h1><span data-i18n="account_balance_is">Your Horizon (HZ) Balance Is</span> <span id="account_balance" class="loading_dots"><span>.</span><span>.</span><span>.</span></span></h1>
        <p data-i18n="dashboard_subhead" style="margin-bottom:5px;">Your Horizon dashboard provides a quick 'at-a-glance' overview of your account. To view sections in more detail, simply use the menu on the side.</p>
      </div>
    </div>
  </section>
  <section class="notification-panel">
    <div class="col-lg-12" style="padding:0px; margin:0px;">
      <div class="alert-danger alert alert-no-icon" id="dashboard_message" style="display:none;padding:5px;padding-left:5px;margin-bottom:15px;"></div>
      <div class="alert-danger alert alert-no-icon" id="secondary_dashboard_message" style="display:none;padding:5px;padding-left:5px;margin-bottom:15px;"></div>
    </div>
  </section>
  <section class="top-panel">
    <div class="row topheading">
      <div class="col-lg-9">
        <div class="hztabs">
          <div class="hztab">
            <input type="radio" id="tab-1" name="tab-group-1" checked>
            <label for="tab-1"><i class="fa fa-briefcase"></i> <span data-i18n="recent_transactions">Recent Transactions</span></label>
            <div class="hzcontent">
              <div class="">
                <div class="row boxheading">
                  <div class="col-lg-8">
                    <h3 class="boxheading"><i class="fa fa-briefcase"></i> <span data-i18n="recent_transactions">Recent Transactions</span></h3>
                  </div>
                  <div class="col-lg-4">
                    <button class="btn btn-primary goto-page tablebutton" data-page="transactions"><i class="fa fa-briefcase" style="margin-right:5px;"></i> <span data-i18n="view_more">View More</span></button>
                  </div>
                </div>
                <div class="row boxbody">
                  <div class="col-lg-12">
                    <div class="data-container data-loading" data-extra="#dashboard_transactions_footer">
                      <table class="table table-striped" id="dashboard_transactions_table">
                        <thead>
                          <tr>
                            <th data-i18n="date">Date</th>
                            <th colspan="2" data-i18n="amount_plus_fee">Amount + Fee</th>
                            <th data-i18n="account">Account</th>
                            <th data-i18n="confirmations_short" style="width:40px">Conf.</th>
                          </tr>
                        </thead>
                        <tbody>
                        </tbody>
                      </table>
                      <div class="data-loading-container"><img src="img/loading_indicator.gif" alt="Loading..." width="32" height="32" /></div>
                      <div class="data-empty-container">
                        <div class="topheading">
                          <h3><i class="fa fa-warning" style="color:#f00;"></i> <span data-i18n="no_transactions_yet">No Transactions Yet.</span></h3>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
          <div class="hztab">
            <input type="radio" id="tab-2" name="tab-group-1">
            <label for="tab-2"><i class="fa fa-bars"></i> <span data-i18n="recent_blocks">Recent Blocks</span></label>
            <div class="hzcontent">
              <div class="">
                <div class="row boxheading">
                  <div class="col-lg-8">
                    <h3 class="boxheading"><i class="fa fa-bars"></i> <span data-i18n="recent_bars">Recent Blocks</span></h3>
                  </div>
                  <div class="col-lg-4">
                    <button class="btn btn-primary goto-page tablebutton" data-page="blocks"><i class="fa fa-briefcase" style="margin-right:5px;"></i> <span data-i18n="view_more">View More</span></button>
                  </div>
                </div>
                <div class="row boxbody">
                  <div class="col-lg-12">
                    <div class="data-container data-loading" data-extra="#dashboard_blocks_footer">
                      <table class="table table-striped" id="dashboard_blocks_table">
                        <thead>
                          <tr>
                            <th data-i18n="height" style="width: 30px">Height</th>
                            <th data-i18n="date">Date</th>
                            <th data-i18n="amount_plus_fee">Amount + Fee</th>
                            <th data-i18n="nr_transactions_short"># TX</th>
                          </tr>
                        </thead>
                        <tbody>
                        </tbody>
                      </table>
                      <div class="data-loading-container"><img src="img/loading_indicator.gif" alt="Loading..." width="32" height="32" /></div>
                      <div class="data-empty-container">
                        <div class="topheading">
                          <h3><i class="fa fa-warning" style="color:#f00;"></i> <span data-i18n="no_blocks_found">Sorry, No Blocks Found.</span></h3>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
      <div class="col-lg-3">
        <div class="box">
          <div class="row boxheading">
            <div class="col-lg-12">
              <h3 class="boxheading"><i class="fa fa-info-circle"></i> <span data-i18n="quick_start_title">Quick Start Guide</span></h3>
            </div>
          </div>
          <div class="row boxbody">
            <div class="col-lg-12">
              <p data-i18n="quick_start_text">This is the text for quick start.</p>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>
</div>
<!-- END DASHBOARD PAGE -->    


<!-- BEGIN TRANSACTIONS SECTION --> <!-- IN PROGRESS -->

<!-- BEGIN TRANSACTIONS PAGE --> <!-- COMPLETE -->
<div id="transactions_page" class="page" style="padding:50px;">
  <section class="content-header">
    <div class="row topheading">
      <div class="col-lg-2">
        <h1><i class="fa fa-briefcase"></i></h1>
      </div>
      <div class="col-lg-10">
        <h1><span data-i18n="transactions">Transactions</span></h1>
        <p data-i18n="transactions_subhead" style="margin-bottom:5px;">This page shows all of the transactions that have been sent and received from your Horizon wallet. You will notice that each day you receive a certain amount of Horizon. This is your interest payment - a daily reward for investing in Horizon.</p>
        <div class="btn-group">
          <button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown"> <span class="text" data-i18n="all_transactions">All Transactions</span> <span class="caret"></span> </button>
          <ul id="transactions_page_type" class="dropdown-menu" role="menu" style="right:0;left:auto;">
            <li><a href="#" data-type="" data-i18n="all_transactions">All Transactions</a></li>
            <li><a href="#" data-type="0:0" data-i18n="ordinary_payment">Ordinary Payment</a></li>
            <li><a href="#" data-type="1:0" data-i18n="arbitrary_message">Arbitrary Message</a></li>
            <li><a href="#" data-type="1:1" data-i18n="alias_assignment">Alias Assignment</a></li>
            <li><a href="#" data-type="1:6" data-i18n="alias_sale">Alias Sale</a></li>
            <li><a href="#" data-type="1:7" data-i18n="alias_buy">Alias Buy</a></li>
            <li><a href="#" data-type="1:2" data-i18n="poll_creation">Poll Creation</a></li>
            <li><a href="#" data-type="1:3" data-i18n="vote_casting">Vote Casting</a></li>
            <li><a href="#" data-type="1:4" data-i18n="hub_announcement">Hub Announcement</a></li>
            <li><a href="#" data-type="1:5" data-i18n="account_info">Account Info</a></li>
            <li><a href="#" data-type="2:0" data-i18n="asset_issuance">Asset Issuance</a></li>
            <li><a href="#" data-type="2:1" data-i18n="asset_transfer">Asset Transfer</a></li>
            <li><a href="#" data-type="2:2" data-i18n="ask_order_placement">Ask Order Placement</a></li>
            <li><a href="#" data-type="2:3" data-i18n="bid_order_placement">Bid Order Placement</a></li>
            <li><a href="#" data-type="2:4" data-i18n="ask_order_cancellation">Ask Order Cancellation</a></li>
            <li><a href="#" data-type="2:5" data-i18n="bid_order_cancellation">Bid Order Cancellation</a></li>
            <li><a href="#" data-type="3:0" data-i18n="marketplace_listing">Marketplace Listing</a></li>
            <li><a href="#" data-type="3:1" data-i18n="marketplace_removal">Marketplace Removal</a></li>
            <li><a href="#" data-type="3:2" data-i18n="marketplace_price_change">Marketplace Price Change</a></li>
            <li><a href="#" data-type="3:3" data-i18n="marketplace_quantity_change">Marketplace Quantity Change</a></li>
            <li><a href="#" data-type="3:4" data-i18n="marketplace_purchase">Marketplace Purchase</a></li>
            <li><a href="#" data-type="3:5" data-i18n="marketplace_delivery">Marketplace Delivery</a></li>
            <li><a href="#" data-type="3:6" data-i18n="marketplace_feedback">Marketplace Feedback</a></li>
            <li><a href="#" data-type="3:7" data-i18n="marketplace_refund">Marketplace Refund</a></li>
            <li><a href="#" data-type="4:0" data-i18n="balance_leasing">Balance Leasing</a></li>
            <li><a href="#" data-type="unconfirmed" data-i18n="unconfirmed_transactions">Unconfirmed Transactions</a></li>
          </ul>
        </div>
      </div>
    </div>
  </section>
  <section class="top-panel">
    <div class="row topheading">
      <div class="col-lg-12">
        <div class="hztabs" style="margin-top:17px;">
          <div class="hztab">
            <input type="radio" id="tab-3" name="tab-group-3" checked>
            <label for="tab-3"><i class="fa fa-briefcase"></i> <span data-i18n="recent_transactions">Recent Transactions</span></label>
            <div class="hzcontent" style="height:300px;">
              <div class="row boxbody" style="margin-left:0px; margin-right:0px; min-height:270px;">
                <div class="col-lg-12">
                  <div class="data-container data-loading" data-extra="#dashboard_transactions_footer">
                    <table class="table table-striped" id="transactions_table">
                      <thead>
                        <tr>
                          <th data-i18n="transaction_id" style="width:1%">Transaction ID</th>
                          <th><i class='fa fa-envelope-o'></i></th>
                          <th data-i18n="date">Date</th>
                          <th data-i18n="type">Type</th>
                          <th data-i18n="amount" colspan="2">Amount</th>
                          <th data-i18n="fee">Fee</th>
                          <th data-i18n="account">Account</th>
                          <th data-i18n="confirmations">Confirmations</th>
                        </tr>
                      </thead>
                      <tbody>
                      </tbody>
                    </table>
                    <div class="data-loading-container"><img src="img/loading_indicator.gif" alt="Loading..." width="32" height="32" /></div>
                    <div class="data-empty-container">
                      <div class="topheading">
                        <h3><i class="fa fa-warning" style="color:#f00;"></i> <span data-i18n="no_transactions_found">Sorry, No Transactions Found.</span></h3>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>
</div>
<!-- END TRANSACTIONS PAGE -->  

<!-- BEGIN MODAL TRANSACTION INFO -->
<div class="modal fade" id="transaction_info_modal" tabindex="-1" role="dialog" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
        <!-- todo -->
        <h4 class="modal-title">Transaction <strong><span id="transaction_info_modal_transaction"></span></strong> Info</h4>
      </div>
      <div class="modal-body">
        <div class="tabbable">
          <ul class="nav nav-pills nav-justified" style="margin-bottom:10px">
            <li class="active"><a href="#transaction_info_tab" data-toggle="tab" id="transaction_info_tab_link" data-i18n="info">Info</a></li>
            <li id="transaction_info_actions"><a href="#transaction_info_actions_tab" data-toggle="tab" data-i18n="actions">Actions</a></li>
            <li><a href="#transaction_info_details_tab" data-toggle="tab" data-i18n="transaction_details">Transaction Details</a></li>
          </ul>
          <div class="tab-content">
            <div class="tab-pane active" id="transaction_info_tab">
              <div id="transaction_info_callout" class="callout callout-info" style="display:none;"></div>
              <div id="transaction_info_output_top" style="display: none;"></div>
              <table class="table table-striped" id="transaction_info_table" style="display:none;margin-bottom: 0;">
                <tbody>
                </tbody>
              </table>
              <div id="transaction_info_output_bottom" style="display: none;margin-top:10px;"></div>
              <div id="transaction_info_bottom" style="display: none;"></div>
            </div>
            <div class="tab-pane" id="transaction_info_actions_tab">
              <div class="row">
                <div class="col-xs-8 col-md-8" style="margin-left:auto;margin-right:auto;float:none;">
                  <button type="button" class="btn btn-default btn-lg btn-block" data-toggle="modal" data-target="#send_money_modal" data-account="" data-i18n="send_nhz_to_sender">Send HZ to Sender</button>
                  <button type="button" class="btn btn-default btn-lg btn-block" data-toggle="modal" data-target="#send_message_modal" data-account="" data-i18n="send_message_to_sender">Send Message to Sender</button>
                  <button type="button" id="transaction_info_modal_add_as_contact" class="btn btn-default btn-lg btn-block" data-toggle="modal" data-target="#add_contact_modal" data-account="" data-i18n="add_sender_as_contact">Add Sender as Contact</button>
                </div>
              </div>
            </div>
            <div class="tab-pane" id="transaction_info_details_tab" style="max-height:350px;overflow:auto;">
              <table class="table table-striped" id="transaction_info_details_table" style="margin-bottom:0;table-layout:fixed;">
                <tbody>
                </tbody>
              </table>
            </div>
          </div>
        </div>
      </div>
      <div class="modal-footer" style="margin-top:0;">
        <button type="button" class="btn btn-primary" data-dismiss="modal" data-i18n="close">Close</button>
      </div>
    </div>
  </div>
</div>
<!-- END MODAL TRANSACTION INFO --> 

<!-- BEGIN MODAL USER INFO -->
<div class="modal fade" id="user_info_modal" tabindex="-1" role="dialog" aria-hidden="true">
  <div class="modal-dialog modal-dialog-wider">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
        <!-- todo -->
        <h4 class="modal-title">Account <strong><span id="user_info_modal_account"></span></strong> Info</h4>
      </div>
      <div class="modal-body">
        <div class="callout callout-info"> 
          <!-- todo --> 
          The account <span id="user_info_modal_account_name_container">named <span id="user_info_modal_account_name" style="font-weight:bold"></span></span> has a balance of <strong><span id="user_info_modal_account_balance"></span></strong>. </div>
        <ul class="nav nav-pills nav-justified" style="margin-bottom:10px">
          <li class="active" id="user_info_transactions" data-tab="transactions"><a href="#" data-i18n="transactions">Transactions</a></li>
          <li id="user_info_assets" data-tab="assets"><a href="#" data-i18n="assets">Assets</a></li>
          <li id="user_info_marketplace" data-tab="marketplace"><a href="#" data-i18n="marketplace">Marketplace</a></li>
          <li id="user_info_aliases" data-tab="aliases"><a href="#" data-i18n="aliases">Aliases</a></li>
          <li id="user_info_description" data-tab="description"><a href="#" data-i18n="description">Description</a></li>
          <li id="user_info_actions" data-tab="actions"><a href="#" data-i18n="actions">Actions</a></li>
        </ul>
        <div class="data-container data-loading user_info_modal_content" id="user_info_modal_transactions" style="display:none;max-height:350px;overflow:auto;">
          <table class="table table-striped" id="user_info_modal_transactions_table">
            <thead>
              <tr>
                <th data-i18n="date">Date</th>
                <th data-i18n="type">Type</th>
                <th data-i18n="amount" colspan="2">Amount</th>
                <th data-i18n="fee">Fee</th>
                <th data-i18n="account">Account</th>
              </tr>
            </thead>
            <tbody>
            </tbody>
          </table>
          <div class="data-loading-container"><img src="img/loading_indicator.gif" alt="Loading..." width="32" height="32" /></div>
          <div class="data-empty-container" style="padding-top:10px" data-i18n="user_no_transactions">This user has no transactions.</div>
        </div>
        <div class="data-container data-loading user_info_modal_content" id="user_info_modal_aliases" style="display:none;max-height:350px;overflow:auto;">
          <table class="table table-striped" id="user_info_modal_aliases_table">
            <thead>
              <tr>
                <th data-i18n="alias">Alias</th>
                <th data-i18n="uri">URI</th>
              </tr>
            </thead>
            <tbody>
            </tbody>
          </table>
          <div class="data-loading-container"><img src="img/loading_indicator.gif" alt="Loading..." width="32" height="32" /></div>
          <div class="data-empty-container" style="padding-top:10px" data-i18n="user_no_aliases">This user has no aliases.</div>
        </div>
        <div class="data-container data-loading user_info_modal_content" id="user_info_modal_assets" style="display:none;max-height:350px;overflow:auto;">
          <table class="table table-striped" id="user_info_modal_assets_table">
            <thead>
              <tr>
                <th data-i18n="asset">Asset</th>
                <th data-i18n="quantity">Quantity</th>
                <th data-i18n="total_available">Total Available</th>
                <th data-i18n="percentage">Percentage</th>
              </tr>
            </thead>
            <tbody>
            </tbody>
          </table>
          <div class="data-loading-container"><img src="img/loading_indicator.gif" alt="Loading..." width="32" height="32" /></div>

          <div class="data-empty-container" style="padding-top:10px" data-i18n="user_no_assets">This user has no assets.</div>
        </div>
        <div class="data-container data-loading user_info_modal_content" id="user_info_modal_marketplace" style="display:none;max-height:350px;overflow:auto;">
          <table class="table table-striped" id="user_info_modal_marketplace_table">
            <thead>
              <tr>
                <th data-i18n="item">Item</th>
                <th data-i18n="price">Price</th>
                <th data-i18n="qty">QTY</th>
              </tr>
            </thead>
            <tbody>
            </tbody>
          </table>
          <div class="data-loading-container"><img src="img/loading_indicator.gif" alt="Loading..." width="32" height="32" /></div>
          <div class="data-empty-container" style="padding-top:10px" data-i18n="user_no_marketplace_listings">This user has no marketplace listings.</div>
        </div>
        <div class="user_info_modal_content data-never-loading" id="user_info_modal_description" style="display:none;"></div>
        <div class="user_info_modal_content data-never-loading" id="user_info_modal_actions" style="display:none;">
          <div class="row">
            <div class="col-xs-6 col-md-6" style="margin-left:auto;margin-right:auto;float:none;">
              <button type="button" class="btn btn-default btn-lg btn-block" data-toggle="modal" data-target="#send_money_modal" data-account="" data-i18n="send_nhz">Send HZ</button>
              <button type="button" class="btn btn-default btn-lg btn-block" data-toggle="modal" data-target="#send_message_modal" data-account="" data-i18n="send_a_message">Send a Message</button>
              <button type="button" id="user_info_modal_add_as_contact" class="btn btn-default btn-lg btn-block" data-toggle="modal" data-target="#add_contact_modal" data-account="" data-i18n="add_as_contact">Add as Contact</button>
            </div>
          </div>
        </div>
      </div>
      <div class="modal-footer" style="margin-top:0;">
        <button type="button" class="btn btn-primary" data-dismiss="modal" data-i18n="close">Close</button>
      </div>
    </div>
  </div>
</div>
<!-- END MODAL USER INFO --> 
<!-- END TRANSACTIONS SECTION -->   
    
<!-- BEGIN CONTACTS PAGE -->

<!-- END CONTACTS PAGE -->   

<!-- BEGIN POLLS PAGE -->
<!-- END POLLS PAGE -->   
    
<!-- BEGIN ALIASES PAGE -->
<!-- END ALIASES PAGE --> 



<!-- BEGIN ASSETS SECTION --> <!-- IN PROGRESS -->

<!-- BEGIN MY ASSETS PAGE --> <!-- COMPLETE -->
<div id="my_assets_page" class="page" style="padding:50px;">
  <section class="content-header">
    <div class="row topheading">
      <div class="col-lg-2">
        <h1><i class="fa fa-signal"></i></h1>
      </div>
      <div class="col-lg-10">
        <h1><span data-i18n="my_assets">My Assets</span></h1>
        <p data-i18n="myassets_subhead" style="margin-bottom:5px;">Assets are like shares and can be used for all types of things. You pay for assets using Horizon on our exclusive Asset Exchange and the price can rise and fall, just like with normal shares. Some assets also pay regular dividends to their investors.</p>
      </div>
    </div>
  </section>
  <section class="top-panel">
    <div class="row topheading">
      <div class="col-lg-12">
        <div class="hztabs" style="margin-top:17px;">
          <div class="hztab">
            <input type="radio" id="tab-4" name="tab-group-4" checked>
            <label for="tab-4"><i class="fa fa-signal"></i> <span data-i18n="my_assets">My Assets</span></label>
            <div class="hzcontent" style="height:300px;">
              <div class="row boxbody" style="margin-left:0px; margin-right:0px; min-height:270px;">
                <div class="col-lg-12">
                  <div class="data-container data-loading" data-extra="#dashboard_transactions_footer">
                    <table class="table table-striped" id="my_assets_table">
                      <thead>
                        <tr>
                          <th data-i18n="asset">Asset</th>
                          <th data-i18n="quantity">Quantity</th>
                          <th data-i18n="total_available">Total Available</th>
                          <th data-i18n="percentage">Percentage</th>
                          <th data-i18n="lowest_ask">Lowest Ask</th>
                          <th data-i18n="highest_bid">Highest Bid</th>
                          <th data-i18n="value_in_nhz">Value in NHZ</th>
                          <th data-i18n="transfer">Transfer</th>
                        </tr>
                      </thead>
                      <tbody>
                      </tbody>
                    </table>
                    <div class="data-loading-container"><img src="img/loading_indicator.gif" alt="Loading..." width="32" height="32" /></div>
                    <div class="data-empty-container">
                      <div class="topheading">
                        <h3> <i class="fa fa-warning" style="color:#f00;"></i> <span data-i18n="no_assets_yet">You Do Not Have Any Assets Yet. You Can Buy Assets By Clicking The 'Asset Exchange' Link.</span></h3>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>
</div>
<!-- END MY ASSETS PAGE -->  

<!-- BEGIN ASSET EXCHANGE PAGE -->
<div id="asset_exchange_page" class="page" style="padding:50px;">

<section class="content-header">
    <div class="row topheading">
      <div class="col-lg-2">
        <h1><i class="fa fa-signal"></i></h1>
      </div>
      <div class="col-lg-10">
        <h1><span data-i18n="asset_exchange">Asset Exchange</span></h1>
        <p data-i18n="assetexchange_subhead" style="margin-bottom:5px;">Assets are like shares and can be used for all types of things. You pay for assets using Horizon on our exclusive Asset Exchange and the price can rise and fall, just like with normal shares. Some assets also pay regular dividends to their investors.</p>
        
        
        <div class="btn-group">
          <button type="button" class="btn btn-primary tablebutton" id="asset_exchange_add_asset_bookmark" data-toggle="modal" data-target="#add_asset_bookmark_modal"><i class="fa fa-bookmark" style="margin-right:5px;"></i> <span data-i18n="add_asset">Add Asset To Watched Assets</span></button>
          <button type="button" class="btn btn-sm btn-default" id="asset_exchange_bookmark_this_asset" style="display:none" data-i18n="bookmark_asset">Bookmark This Asset</button>
          <button type="button" class="btn btn-sm btn-default" id="asset_exchange_clear_search" style="display:none" data-i18n="clear_search_results">Clear Search Results</button>
        </div>
        
      </div>
    </div>
  </section>
  
  
  

  



  <section class="content content-stretch" style="position:fixed;margin-top:3px;padding:0; width:100%; height:100%; height: calc(100% - 101px);overflow:hidden;">
    <div class="content-spliter">
      <div class="content-splitter-inner">
        <div class="content-splitter-sidebar" style="width:200px">
          <div class="content-splitter-sidebar-inner">
            <div class="list-group unselectable sidebar_context" id="asset_exchange_sidebar">
              <div class="list-group-item list-group-item-ungrouped context owns_asset" data-cache="0" style="padding-top:15px;">
                <h4 class="tableheading" style="margin-top:0px;"><i class="fa fa-bookmark" style="font-size:1.2em; margin-right:5px; color:#09f;"></i> <span data-i18n="watched_assets">Watched Assets</span></h4>
              </div>
              <div id="asset_exchange_sidebar_search">
                <form action="#" method="get" class="sidebar-form" id="asset_exchange_search" autocomplete="off">
                  <div class="input-group">
                    <input type="text" name="q" class="form-control" placeholder="Search Assets..." data-i18n="[placeholder]search_assets">
                    <span class="input-group-btn">
                    <button type="submit" name="seach" class="btn btn-flat" style="padding-left:3px"><i class="fa fa-search"></i></button>
                    </span> </div>
                </form>
              </div>
              <div id="asset_exchange_sidebar_content">
                <div style="text-align:center;padding-top:0px;"><span data-i18n="loading_please_wait">Loading, please wait</span><span class="loading_dots"><span>.</span><span>.</span><span>.</span></span></div>
              </div>
            </div>
          </div>
        </div>
        <div class="content-splitter-right">
          <div class="content-splitterright-inner">
            <div id="no_assets_available" class="topheading" style="padding-top: 0px;text-align:center;display:none;">
              <h3> <i class="fa fa-warning" style="margin-right:10px; font-size:1.2em; color:#f00;"></i> <span data-i18n="no_assets_available">You do not have any watched assets yet. Click on the 'Add Asset To Watched Assets' button to add one.</span> </h3>
            </div>
            <div id="no_asset_search_results" style="padding-top: 150px;text-align:center;display:none;" data-i18n="no_asset_search_results"> No assets found that match search query. </div>
            <div id="no_asset_selected" class="topheading" style="padding-top: 0px;text-align:center;">
              <h3> <i class="fa fa-arrow-left" style="margin-right:10px; font-size:1.2em; color:#09f;"></i> <span data-i18n="no_asset_selected">Please select an asset from the left sidebar.</span> </h3>
            </div>
            <div id="loading_asset_data" style="padding-top: 0px;text-align:center;display: none;"><span data-i18n="asset_data_loading">Asset data loading, please wait...</span><br />
              <br />
              <img class="loading" src="img/loading_indicator.gif" alt="Loading..." width="32" height="32" /></div>
            <div id="asset_details" style="display:none;">
              <div class="alert alert-danger alert-no-icon" id="asset_exchange_duplicates_warning" style="display:none" data-i18n="[html]asset_exchange_duplicates_warning"></div>
              <div class="row topheading" style="margin-bottom:30px;">
                <div class="col-lg-8">
                  <h1 style="margin-bottom:0px;"><i class="fa fa-signal" style="font-size:1.2em; margin-right:10px;"></i> <span id="asset_name"></span></h1>
                </div>
                <div class="col-lg-4">
                  <div class="oswaldbold"  style="text-align:right; margin-top:10px;"><span id="asset_id_dropdown" class="dropdown" style="margin-bottom:0;"><strong data-i18n="asset_id">Asset Id</strong>: &nbsp;<a href="#" id="asset_id" class="dropdown-toggle" data-toggle="dropdown"></a>
                    <ul class="dropdown-menu" role="menu" style="right:0;left:auto;text-align:left;">
                      <li role="presentation" class="copy_link"><a role="menuitem" tabindex="-1" href="#" data-type="asset_id" data-i18n="copy_asset_id">Copy Asset ID</a></li>
                      <li role="presentation" class="remote_only copy_link"><a role="menuitem" tabindex="-1" href="#" data-type="asset_link" data-i18n="copy_asset_link">Copy Asset Link</a></li>
                    </ul>
                    </span><br>
                    <strong data-i18n="account">Account</strong>: <span id="asset_account"></span> </div>
                </div>
                <div class="col-lg-12">
                  <p data-i18n="transactions_subhead" style="margin-top:30px; margin-bottom:5px;" id="asset_description"></p>
                </div>
              </div>
              <div class="row">
                <div class="col-md-6">
                  <div class="box box-solid box-info collapsed-box" id="buy_asset_box">
                    <div class="box-header" style="background-color:#DFF0D9;color: #48AB6C;">
                      <h3 class="box-title"><i class="fa fa-shopping-cart" style="font-size:1.2em; margin-right:10px;"></i> <span id="buy_asset_with_nhz" class="oswaldbold"></span></h3>
                      <div class="box-tools pull-right">
                        <button class="btn btn-info btn-sm" style="background-color: #48AB6C"><i class="fa fa-plus"></i></button>
                      </div>
                    </div>
                    <div class="box-body no-padding" style="display:none">
                      <div class="oswaldbold exchangetitlesubhead" id="buy_automatic_price"><strong data-i18n="balance">Your Current Horizon Balance: </strong> <span id="your_nhz_balance"></span> HZ</div>
                      <form role="form" class="form-horizontal" style="padding: 10px;;max-width:350px;margin-left:auto;margin-right:auto;" autocomplete="off">
                        <div style="margin-left:-20px">
                          <div class="form-group">
                            <label for="buy_asset_quantity" class="col-sm-3 control-label labelheading" data-i18n="quantity">Quantity</label>
                            <div class="col-sm-9">
                              <div class="input-group">
                                <input id="buy_asset_quantity" type="text" name="buy_asset_quantity" value="0" class="form-control" data-type="buy" />
                                <span class="input-group-addon"><span class="labelheading asset_name"></span></span> </div>
                            </div>
                          </div>
                          <div class="form-group">
                            <label for="buy_asset_price" class="col-sm-3 control-label labelheading" data-i18n="price">Price</label>
                            <div class="col-sm-9">
                              <div class="input-group">
                                <input id="buy_asset_price" type="text" value="0" name="buy_asset_price" class="form-control" data-type="buy" />
                                <span class="labelheading input-group-addon">HZ / <span class="labelheading asset_name"></span></span> </div>
                            </div>
                          </div>
                          <div class="form-group">
                            <label for="buy_asset_total" class="col-sm-3 control-label labelheading" data-i18n="total">Total</label>
                            <div class="col-sm-9">
                              <div class="input-group">
                                <input type="text" name="buy_asset_total" id="buy_asset_total" readonly value="0" class="form-control disabled" />
                                <span class="input-group-addon labelheading">HZ</span> </div>
                            </div>
                          </div>
                          <div class="form-group">
                            <label for="buy_asset_fee" class="col-sm-3 control-label labelheading" data-i18n="fee">Fee</label>
                            <div class="col-sm-9">
                              <div class="input-group">
                                <input type="text" id="buy_asset_fee" name="buy_asset_fee" value="1" class="form-control" />
                                <span class="input-group-addon labelheading">HZ</span> </div>
                            </div>
                          </div>
                          <div class="form-group form-group-last">
                            <div class="col-sm-3"></div>
                            <div class="col-sm-9">
                              <button type="button" class="btn btn-primary btn-lg btn-block" style="color:#fff;" id="buy_asset_button" data-toggle="modal" data-target="#asset_order_modal" data-asset="" data-type="Buy"><i class="fa fa-shopping-cart" style="margin-right:5px;"></i> <span data-i18n="buy">Buy</span> (HZ → <span class="asset_name"></span>)</button>
                            </div>
                          </div>
                        </div>
                      </form>
                    </div>
                  </div>
                  <div class="topheading" style="margin-top:30px; margin-bottom:20px;">
                    <h3 style="margin-top:8px;"><i class="fa fa-tag" style="margin-right:10px; font-size:1.2em; color:#09f;"></i> <span data-i18n="sell_orders">Sell Orders</span> <span id="sell_orders_count"></span></h3>
                  </div>
                  <div class="box" style="min-height:120px;max-height: 120px;overflow: auto;;">
                    <div class="box-body no-padding">
                      <div class="data-container data-loading" data-no-padding="true">
                        <table class="table table-striped" id="asset_exchange_ask_orders_table">
                          <thead>
                            <tr>
                              <th data-i18n="account" class="labelheading">Account</th>
                              <th data-i18n="quantity" class="labelheading">Quantity</th>
                              <th data-i18n="price" class="labelheading">Price</th>
                              <th data-i18n="total" class="labelheading">Total</th>
                            </tr>
                          </thead>
                          <tbody>
                          </tbody>
                        </table>
                        <div class="data-loading-container"><img class="loading" src="img/loading_indicator.gif" alt="Loading..." width="32" height="32" /></div>
                        <div class="data-empty-container">
                          <p data-i18n="no_sell_orders_for_asset">No sell orders for this asset.</p>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
                <div class="col-md-6">
                  <div class="box box-solid box-info collapsed-box" id="sell_asset_box">
                    <div class="box-header" style="background:#F2DEDE;color:#ED4348;">
                      <h3 class="box-title"><i class="fa fa-tag" style="font-size:1.2em; margin-right:10px;"></i> <span id="sell_asset_for_nhz" class="oswaldbold"></span></h3>
                      <div class="box-tools pull-right">
                        <button class="btn btn-info btn-sm" style="background-color: #ED4348"> <i class="fa fa-plus"></i></button>
                      </div>
                    </div>
                    <div class="box-body no-padding" style="display:none">
                      <div class="oswaldbold exchangetitlesubhead" id="sell_automatic_price"><strong data-i18n="balance">You Currently Have</strong> <span id="your_asset_balance"></span> <span class="asset_name"></span></div>
                      <form role="form" class="form-horizontal" style="padding: 10px;max-width:350px;margin-left:auto;margin-right:auto;" autocomplete="off">
                        <div style="margin-left:-20px">
                          <div class="form-group">
                            <label for="sell_asset_quantity" class="col-sm-3 control-label labelheading" data-i18n="quantity">Quantity</label>
                            <div class="col-sm-9">
                              <div class="input-group">
                                <input id="sell_asset_quantity" type="text" name="sell_asset_quantity" value="0" class="form-control" data-type="sell" />
                                <span class="input-group-addon"><span class="asset_name labelheading"></span></span> </div>
                            </div>
                          </div>
                          <div class="form-group">
                            <label for="sell_asset_price" class="col-sm-3 control-label labelheading" data-i18n="price">Price</label>
                            <div class="col-sm-9">
                              <div class="input-group">
                                <input id="sell_asset_price" type="text" value="0" name="sell_asset_price" class="form-control" data-type="sell" />
                                <span class="input-group-addon labelheading">HZ / <span class="asset_name labelheading"></span></span> </div>
                            </div>
                          </div>
                          <div class="form-group">
                            <label for="sell_asset_total" class="col-sm-3 control-label labelheading" data-i18n="total">Total</label>
                            <div class="col-sm-9">
                              <div class="input-group">
                                <input type="text" name="sell_asset_total" id="sell_asset_total" readonly value="0" class="form-control disabled" />
                                <span class="input-group-addon labelheading">HZ</span> </div>
                            </div>
                          </div>
                          <div class="form-group">
                            <label for="sell_asset_fee" class="col-sm-3 control-label labelheading" data-i18n="fee">Fee</label>
                            <div class="col-sm-9">
                              <div class="input-group">
                                <input type="text" id="sell_asset_fee" name="sell_asset_fee" value="1" class="form-control" />
                                <span class="input-group-addon labelheading">HZ</span> </div>
                            </div>
                          </div>
                          <div class="form-group form-group-last">
                            <div class="col-sm-3"></div>
                            <div class="col-sm-9">
                              <button type="button" style="color:#fff;" class="btn btn-primary btn-lg btn-block" id="sell_asset_button" data-toggle="modal" data-target="#asset_order_modal" data-asset="" data-type="Sell"><i class="fa fa-tag" style="margin-right:5px;"></i> <span data-i18n="sell">Sell</span> (<span class="asset_name"></span> → NHZ)</button>
                            </div>
                          </div>
                        </div>
                      </form>
                    </div>
                  </div>
                  <div class="topheading" style="margin-top:30px; margin-bottom:20px;">
                    <h3 style="margin-top:8px;"><i class="fa fa-shopping-cart" style="margin-right:10px; font-size:1.2em; color:#09f;"></i> <span data-i18n="buy_orders">Buy Orders</span> <span id="buy_orders_count"></span></h3>
                  </div>
                  <div class="box" style="min-height:120px;max-height: 120px;overflow: auto;">
                    <div class="box-body no-padding">
                      <div class="data-container data-loading" data-no-padding="true">
                        <table class="table table-striped" id="asset_exchange_bid_orders_table">
                          <thead>
                            <tr>
                              <th data-i18n="account" class="labelheading">Account</th>
                              <th data-i18n="quantity" class="labelheading">Quantity</th>
                              <th data-i18n="price" class="labelheading">Price</th>
                              <th data-i18n="total" class="labelheading">Total</th>
                            </tr>
                          </thead>
                          <tbody>
                          </tbody>
                        </table>
                        <div class="data-loading-container"><img class="loading" src="img/loading_indicator.gif" alt="Loading..." width="32" height="32" /></div>
                        <div class="data-empty-container">
                          <p data-i18n="no_buy_orders_for_asset">No buy orders for this asset.</p>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
              <div class="topheading" style="margin-top:30px; margin-bottom:20px;">
                <h3 style="margin-top:8px;"><i class="fa fa-info-circle" style="margin-right:10px; font-size:1.2em; color:#09f;"></i> <span data-i18n="trade_history">Trade History</span> <span id="sell_orders_count"></span></h3>
              </div>
              <div class="box " style="max-height:400px;overflow:auto;margin-bottom:10px;">
                <div class="box-body no-padding">
                  <div class="data-container data-loading" data-no-padding="true">
                    <table class="table table-striped" id="asset_exchange_trade_history_table">
                      <thead>
                        <tr>
                          <th data-i18n="date" class="labelheading">Date</th>
                          <th data-i18n="quantity" class="labelheading">Quantity</th>
                          <th data-i18n="price" class="labelheading">Price</th>
                          <th data-i18n="total" class="labelheading">Total</th>
                          <th data-i18n="ask_order_id" class="labelheading">Ask Order ID</th>
                          <th data-i18n="bid_order_id" class="labelheading">Bid Order ID</th>
                        </tr>
                      </thead>
                      <tbody>
                      </tbody>
                    </table>
                    <div class="data-loading-container"><img class="loading" src="img/loading_indicator.gif" alt="Loading..." width="32" height="32" /></div>
                    <div class="data-empty-container">
                      <p data-i18n="no_trade_history">No trade history available.</p>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>
</div>


<!-- END ASSET EXCHANGE PAGE -->  

<!-- BEGIN MODAL TRANSFER ASSET -->
<div class="modal fade" id="transfer_asset_modal" tabindex="-1" role="dialog" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
        <h4 class="modal-title" data-i18n="transfer_asset">Transfer Asset</h4>
      </div>
      <div class="modal-body">
        <form role="form" autocomplete="off">
          <div class="callout callout-danger error_message" style="display:none"></div>
          <div class="form-group">
            <label data-i18n="asset">ASSET</label>
            <p><span id="transfer_asset_name"></span><span id="transfer_asset_available" style="font-style:italic"></span></p>
            <input type="hidden" name="asset" id="transfer_asset_asset" value="" />
            <input type="hidden" name="decimals" id="transfer_asset_decimals" value="" />
          </div>
          <div class="form-group">
            <label for="transfer_asset_recipient" data-i18n="recipient">RECIPIENT</label>
            <div class="input-group">
              <input type="text" class="form-control" name="recipient" id="transfer_asset_recipient" placeholder="Recipient Account" data-i18n="[placeholder]recipient_account" autofocus tabindex="1" />
              <span class="input-group-btn btn-group recipient_selector">
              <button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown"><span class="glyphicon glyphicon-user"></span></button>
              <ul class="dropdown-menu scrollable-menu" role="menu" style="right:0;left:auto;">
              </ul>
              </span> </div>
          </div>
          <div class="form-group recipient_public_key">
            <label for="transfer_asset_recipient_public_key" data-i18n="recipient_public_key">Recipient Public Key</label>
            <input type="text" class="form-control" name="recipientPublicKey" id="transfer_asset_recipient_public_key" placeholder="Public Key" data-i18n="[placeholder]public_key" tabindex="2" spellcheck="false" />
          </div>
          <div class="form-group">
            <label for="transfer_asset_quantity" data-i18n="quantity">QUANTITY</label>
            <div class="input-group">
              <input type="number" name="quantity" id="transfer_asset_quantity" class="form-control" step="any" min="0" placeholder="Quantity" data-i18n="[placeholder]quantity" tabindex="3">
              <span class="input-group-addon" id="transfer_asset_quantity_name"></span> </div>
          </div>
          <div class="form-group">
            <input type="checkbox" name="add_message" id="transfer_asset_add_message" class="add_message" tabindex="6" />
            <label for="transfer_asset_add_message" style="font-weight:normal;margin-bottom:0;"> <span data-i18n="add_message_q">Add a Message?</span></label>
          </div>
          <div class="form-group optional_message">
            <label for="transfer_asset_message" data-i18n="message">MESSAGE</label>
            <textarea class="form-control" id="transfer_asset_message" name="message" rows="4" tabindex="7"></textarea>
            <div style="margin-top:3px" class="dgs_block">
              <label for="transfer_asset_encrypt_message" style="font-weight:normal;color:#666">
                <input type="checkbox" name="encrypt_message" id="transfer_asset_encrypt_message" value="1" data-default="checked" checked="checked" />
                <span data-i18n="encrypt_message">Encrypt Message</span></label>
            </div>
          </div>
          <div class="row advanced">
            <div class="col-xs-6 col-sm-6 col-md-6">
              <div class="form-group">
                <label for="transfer_asset_fee" data-i18n="fee">FEE</label>
                <div class="input-group">
                  <input type="number" name="feeNHZ" id="transfer_asset_fee" class="form-control" step="any" min="1" placeholder="Fee" data-i18n="[placeholder]fee" data-default="1" value="1" tabindex="5">
                  <span class="input-group-addon">NHZ</span> </div>
              </div>
            </div>
            <div class="col-xs-6 col-sm-6 col-md-6">
              <div class="form-group">
                <label for="transfer_asset_deadline" data-i18n="deadline_hours">DEADLINE (HOURS)</label>
                <input type="number" name="deadline" id="transfer_asset_deadline" class="form-control" placeholder="Deadline" data-i18n="[placeholder]deadline" min="1" data-default="24" value="1" tabindex="6">
              </div>
            </div>
          </div>
          <div class="form-group secret_phrase">
            <label for="transfer_asset_password" data-i18n="passphrase">PASSPHRASE</label>
            <input type="password" name="secretPhrase" id="transfer_asset_password" class="form-control" placeholder="" tabindex="7">
          </div>
          <div class="form-group advanced">
            <label for="transfer_asset_referenced_transaction" data-i18n="referenced_transaction_hash">REFERENCED TRANSACTION HASH</label>
            <input type="text" class="form-control" name="referencedTransactionFullHash" id="transfer_asset_referenced_transaction" placeholder="Referenced Transaction Full Hash" data-i18n="[placeholder]referenced_transaction_full_hash" tabindex="8" spellcheck="false" />
          </div>
          <div class="form-group advanced" style="margin-bottom:5px;">
            <input type="checkbox" name="doNotBroadcast" id="transfer_asset_do_not_broadcast" value="1" />
            <label for="transfer_asset_do_not_broadcast" style="font-weight:normal;" tabindex="9" data-i18n="do_not_broadcast">Do Not Broadcast</label>
          </div>
          <div class="form-group dgs_block advanced">
            <input type="checkbox" name="add_note_to_self" id="transfer_asset_add_note_to_self" class="add_note_to_self" tabindex="10" />
            <label for="transfer_asset_add_note_to_self" style="font-weight:normal;margin-bottom:0;"> <span data-i18n="add_note_to_self">Add Note to Self?</span></label>
          </div>
          <div class="form-group dgs_block advanced optional_note">
            <label for="transfer_asset_note_to_self" data-i18n="note_to_self">Note to Self</label>
            <textarea class="form-control" id="transfer_asset_note_to_self" name="note_to_self" rows="4" tabindex="11"></textarea>
            <div style="margin-top:3px;">
              <label style="font-weight:normal;color:#666" data-i18n="note_is_encrypted">This note is encrypted.</span></label>
            </div>
          </div>
          <div class="callout account_info" style="display:none;margin-bottom: 0;"></div>
          <input type="hidden" name="request_type" value="transferAsset" />
          <input type="hidden" name="converted_account_id" value="" />
          <input type="hidden" name="merchant_info" value="" data-default="" />
        </form>
      </div>
      <div class="modal-footer" style="margin-top:0;">
        <div class="advanced_info"><strong data-i18n="fee">Fee:</strong> <span class="advanced_fee">1 NHZ</span> - <a href="#" data-i18n="advanced">advanced</a></div>
        <button type="button" class="btn btn-default" data-dismiss="modal" data-i18n="cancel">Cancel</button>
        <button type="button" class="btn btn-primary" data-loading-text="Submitting..." data-i18n="transfer_asset;[placeholder]submitting">Transfer Asset</button>
      </div>
    </div>
  </div>
</div>
<!-- END MODAL TRANSFER ASSET -->

<!-- BEGIN MODAL BOOKMARK ASSET -->
<div class="modal fade" id="add_asset_bookmark_modal" tabindex="-1" role="dialog" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
        <h4 class="modal-title" data-i18n="add_asset">Add Asset</h4>
      </div>
      <div class="modal-body">
        <form role="form" autocomplete="off">
          <div class="callout callout-danger error_message" style="display:none"></div>
          <div class="form-group">
            <label for="add_asset_bookmark_id" data-i18n="asset_or_account_id">ASSET OR ACCOUNT ID</label>
            <i class="fa fa-question-circle show_popover" style="color:#4CAA6E" data-content="Find the ID on the issuer's website or announcement page." data-container="body" data-i18n="[data-content]find_asset_id_help"></i>
            </label>
            <input type="text" class="form-control" name="id" id="add_asset_bookmark_id" placeholder="ID" autofocus tabindex="1" />
          </div>
          <input type="hidden" name="request_type" value="addAssetBookmark" />
        </form>
      </div>
      <div class="modal-footer" style="margin-top:0;">
        <button type="button" class="btn btn-default" data-dismiss="modal" data-i18n="cancel">Cancel</button>
        <button type="button" class="btn btn-primary" data-loading-text="Submitting..." data-i18n="add_asset;[data-loading-text]submitting">Add Asset</button>
      </div>
    </div>
  </div>
</div>

<!-- END MODAL BOOKMARK ASSET -->

<!-- BEGIN OPEN ORDERS PAGE -->
<div id="open_orders_page" class="page">
  <section class="content-header">
    <h1 data-i18n="open_orders">Open Orders</h1>
  </section>
  <section class="content">
    <div class="row">
      <div class="col-md-6">
        <div class="box box-primary">
          <div class="box-header">
            <h3 class="box-title" data-i18n="sell_orders">Sell Orders</h3>
          </div>
          <div class="box-body no-padding">
            <div class="data-container data-loading" data-no-padding="true">
              <table class="table table-striped" id="open_ask_orders_table">
                <thead>
                  <tr>
                    <th data-i18n="asset">Asset</th>
                    <th data-i18n="quantity">Quantity</th>
                    <th data-i18n="price">Price</th>
                    <th data-i18n="total">Total</th>
                    <th data-i18n="cancel">Cancel</th>
                  </tr>
                </thead>
                <tbody>
                </tbody>
              </table>
              <div class="data-loading-container"><img src="img/loading_indicator.gif" alt="Loading..." width="32" height="32" /></div>
              <div class="data-empty-container">
                <p data-i18n="no_open_sell_orders">No open sell orders.</p>
              </div>
            </div>
          </div>
        </div>
      </div>
      <div class="col-md-6">
        <div class="box box-primary">
          <div class="box-header">
            <h3 class="box-title" data-i18n="buy_orders">Buy Orders</h3>
          </div>
          <div class="box-body no-padding">
            <div class="data-container data-loading" data-no-padding="true">
              <table class="table table-striped" id="open_bid_orders_table">
                <thead>
                  <tr>
                    <th data-i18n="asset">Asset</th>
                    <th data-i18n="quantity">Quantity</th>
                    <th data-i18n="price">Price</th>
                    <th data-i18n="total">Total</th>
                    <th data-i18n="cancel">Cancel</th>
                  </tr>
                </thead>
                <tbody>
                </tbody>
              </table>
              <div class="data-loading-container"><img src="img/loading_indicator.gif" alt="Loading..." width="32" height="32" /></div>
              <div class="data-empty-container">
                <p data-i18n="no_open_buy_orders">No open buy orders.</p>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>
</div>
<!-- END OPEN ORDERS PAGE -->  

<!-- BEGIN MODAL ISSUE ASSET -->
<div class="modal fade" id="issue_asset_modal" tabindex="-1" role="dialog" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
        <h4 class="modal-title" data-i18n="issue_asset">Issue Asset</h4>
      </div>
      <div class="modal-body">
        <form role="form" autocomplete="off">
          <div class="callout callout-danger never_hide" data-i18n="[html]issue_asset_warning"><strong>Warning</strong>: Once submitted, you will not be able to change this information again, ever. Make sure it is correct.</div>
          <div class="callout callout-danger error_message" style="display:none"></div>
          <div class="form-group">
            <label for="issue_asset_name"><span data-i18n="asset_name">ASSET NAME</span> <i class="fa fa-question-circle show_popover" data-content="The asset name is non-unique. Should be between 3 and 10 characters long." data-i18n="[data-content]asset_name_help" data-container="body" style="color:#4CAA6E" ></i></label>
            <input type="text" class="form-control" name="name" id="issue_asset_name" placeholder="Asset Name" data-i18n="[placeholder]asset_name" autofocus tabindex="1" />
          </div>
          <div class="form-group">
            <label for="issue_asset_description" data-i18n="description">DESCRIPTION</label>
            <textarea class="form-control" id="issue_asset_description" name="description" rows="3" tabindex="3"></textarea>
          </div>
          <div class="row">
            <div class="col-xs-6 col-sm-6 col-md-6">
              <div class="form-group">
                <label for="issue_asset_quantity" data-i18n="quantity">QUANTITY</label>
                <input type="number" name="quantity" id="issue_asset_quantity" class="form-control" min="1" placeholder="Quantity" data-i18n="quantity" tabindex="4">
              </div>
            </div>
            <div class="col-xs-6 col-sm-6 col-md-6">
              <div class="form-group">
                <label for="issue_asset_decimals"><span data-i18n="decimals">DECIMALS</span> <i class="fa fa-question-circle show_popover" data-content="The maximum allowed number of digits after the asset quantity decimal point." data-i18n="[data-content]asset_decimals_help" data-container="body" style="color:#4CAA6E" ></i></label>
                <input type="number" name="decimals" id="issue_asset_decimals" class="form-control" min="0" max="8" placeholder="Decimals" data-i18n="decimals" data-default="0" value="0" tabindex="5">
              </div>
            </div>
          </div>
          <div class="row">
            <div class="col-xs-12 col-sm-12 col-md-12 advanced_extend" data-normal="12" data-advanced="6">
              <div class="form-group">
                <label for="issue_asset_fee"><span data-i18n="fee">FEE</span> <i class="fa fa-exclamation-circle show_popover" data-content="The minimum fee to issue an asset is 1,000 Nhz." data-i18n="[data-content]asset_minimum_fee_help" data-container="body" style="color:red"></i></label>
                <div class="input-group">
                  <input type="number" name="feeNHZ" id="issue_asset_fee" class="form-control" placeholder="Fee" step="any" min="1000" data-default="1000" value="1000" tabindex="6">
                  <span class="input-group-addon">NHZ</span> </div>
              </div>
            </div>
            <div class="col-xs-6 col-sm-6 col-md-6 advanced">
              <div class="form-group">
                <label for="issue_asset_deadline" data-i18n="deadline_hours">DEADLINE (HOURS)</label>
                <input type="number" name="deadline" id="issue_asset_deadline" class="form-control" placeholder="Deadline" data-i18n="deadline" min="1" data-default="24" value="24" tabindex="7">
              </div>
            </div>
          </div>
          <div class="form-group secret_phrase">
            <label for="issue_asset_password" data-i18n="passphrase">PASSPHRASE</label>
            <input type="password" name="secretPhrase" id="issue_asset_password" class="form-control" placeholder="" tabindex="8">
          </div>
          <div class="form-group advanced">
            <label for="issue_asset_referenced_transaction" data-i18n="referenced_transaction_hash">REFERENCED TRANSACTION HASH</label>
            <input type="text" class="form-control" name="referencedTransactionFullHash" id="issue_asset_referenced_transaction" placeholder="Referenced Transaction Full Hash" data-i18n="referenced_transaction_full_hash" tabindex="6" spellcheck="false" />
          </div>
          <div class="form-group advanced" style="margin-bottom:0;">
            <input type="checkbox" name="doNotBroadcast" id="issue_asset_do_not_broadcast" value="1" />
            <label for="issue_asset_do_not_broadcast" style="font-weight:normal;" tabindex="7" data-i18n="do_not_broadcast">Do Not Broadcast</label>
          </div>
          <div class="form-group dgs_block advanced">
            <input type="checkbox" name="add_note_to_self" id="issue_asset_add_note_to_self" class="add_note_to_self" tabindex="8" />
            <label for="issue_asset_add_note_to_self" style="font-weight:normal;margin-bottom:0;"> <span data-i18n="add_note_to_self">Add Note to Self?</span></label>
          </div>
          <div class="form-group dgs_block advanced optional_note">
            <label for="issue_asset_note_to_self" data-i18n="note_to_self">Note to Self</label>
            <textarea class="form-control" id="issue_asset_note_to_self" name="note_to_self" rows="4" tabindex="9"></textarea>
            <div style="margin-top:3px;">
              <label style="font-weight:normal;color:#666" data-i18n="note_is_encrypted">This note is encrypted.</span></label>
            </div>
          </div>
          <input type="hidden" name="request_type" value="issueAsset" />
        </form>
      </div>
      <div class="modal-footer" style="margin-top:0;">
        <div class="advanced_info"><strong data-i18n="fee">Fee</strong>: <span class="advanced_fee">1'000 NHZ</span> - <a href="#" data-i18n="advanced">advanced</a></div>
        <button type="button" class="btn btn-default" data-dismiss="modal" data-i18n="cancel">Cancel</button>
        <button type="button" class="btn btn-primary" data-loading-text="Submitting..." data-i18n="issue_asset;[data-loading-text]submitting">Issue Asset</button>
      </div>
    </div>
  </div>
</div>
<!-- END MODAL ISSUE ASSET -->

<!-- BEGIN MODAL ASSET ORDER -->
<div class="modal fade" id="asset_order_modal" tabindex="-1" role="dialog" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
        <!-- todo -->
        <h4 class="modal-title" data-i18n="confirm__order">Confirm <span class="asset_order_modal_type"></span> Order</h4>
      </div>
      <div class="modal-body">
        <form role="form" autocomplete="off">
          <div class="callout callout-danger error_message" style="display:none"></div>
          <div class="form-group">
            <label data-i18n="order_description">ORDER DESCRIPTION</label>
            <p id="asset_order_description"></p>
            <input type="hidden" name="asset" id="asset_order_asset" value="" />
            <input type="hidden" name="quantityQNT" id="asset_order_quantity" value="" />
            <input type="hidden" name="priceNQT" id="asset_order_price" value="" />
            <input type="hidden" name="feeNQT" id="asset_order_fee" value="" />
            <input type="hidden" name="deadline" id="asset_order_deadline" data-default="24" value="24" />
          </div>
          <div class="form-group">
            <label><span data-i18n="total">TOTAL</span> <i id="asset_order_total_tooltip" class="fa fa-question-circle" style="color:#4CAA6E" data-toggle="popover" data-placement="right" data-content=""></i></label>
            <p id="asset_order_total"></p>
          </div>
          <div class="form-group">
            <label data-i18n="fee">FEE</label>
            <p id="asset_order_fee_paid"></p>
          </div>
          <div class="form-group secret_phrase">
            <label for="asset_order_password" data-i18n="passphrase">PASSPHRASE</label>
            <input type="password" name="secretPhrase" id="asset_order_password" class="form-control" placeholder="" tabindex="1">
          </div>
          <input type="hidden" name="asset_order_type"  id="asset_order_type" />
          <input type="hidden" name="request_type" value="orderAsset" />
        </form>
      </div>
      <div class="modal-footer" style="margin-top:0;">
        <button type="button" class="btn btn-default" data-dismiss="modal" data-i18n="cancel">Cancel</button>
        <button type="button" class="btn btn-primary" data-loading-text="Submitting..." id="asset_order_modal_button" data-i18n="[data-loading-text]submitting"></button>
      </div>
    </div>
  </div>
</div>
<!-- END MODAL ASSET ORDER -->

<!-- END ASSETS SECTION --> 
    
<!-- BEGIN TRADE HISTORY PAGE -->
<!-- END TRADE HISTORY PAGE -->   

<!-- BEGIN SEARCH MARKETPLACE PAGE -->
<!-- END SEARCH MARKETPLACE PAGE -->    
    
<!-- BEGIN PURCHASED PRODUCTS PAGE -->
<!-- END PURCHASED PRODUCTS PAGE -->     
    
<!-- BEGIN MY PRODUCTS PAGE -->
<!-- END MY PRODUCTS PAGE -->   

<!-- BEGIN PENDING ORDERS PAGE -->
<!-- END PENDING ORDERS PAGE --> 

<!-- BEGIN COMPLETED ORDERS PAGE -->
<!-- END COMPLETED ORDERS PAGE -->      
    
<!-- BEGIN SETTINGS PAGE -->
<div id="settings_page" class="page">
  <section class="content-header">
    <h1 data-i18n="settings">Settings</h1>
  </section>
  <section class="content" id="settings_box">
    <style type="text/css">
						/*form.settings_form > .form-group > .control-label { width: 120px; }*/
						</style>
    <div class="box box-primary">
      <div class="box-header">
        <h3 class="box-title" data-i18n="general">General</h3>
      </div>
      <form role="form" autocomplete="off">
        <div class="box-body">
          <div class="form-group">
            <label for="settings_language" data-i18n="language">Language</label>
            <select name="language" id="settings_language" class="form-control" style="width:150px">
              <option value="de">Deutsch</option>
              <!-- german -->
              <option value="en">English</option>
              <!-- english -->
              <option value="es">Español</option>
              <!-- spanish -->
              <option value="fi">Suomi</option>
              <!-- finnish -->
              <option value="fr">Français</option>
              <!-- french -->
              <option value="gl">Galego</option>
              <!-- galician -->
              <option value="hr">Hrvatski</option>
              <!-- croatian -->
              <option value="id">Bahasa Indonesia</option>
              <!-- indonesian -->
              <option value="it">Italiano</option>
              <!-- italian -->
              <option value="ja">日本語</option>
              <!-- japanese -->
              <option value="lt">Lietuviškai</option>
              <!-- lithuanian -->
              <option value="nl">Nederlands</option>
              <!-- dutch -->
              <option value="sk">Slovensky</option>
              <!-- slovakian -->
              <option value="pt">Português</option>
              <!-- portugese -->
              <option value="sr">Срки</option>
              <!-- serbian, cyrillic -->
              <option value="sr-cs">Srpski</option>
              <!-- serbian, latin -->
              <option value="uk">Yкраiнка</option>
              <!-- ukranian -->
              <option value="ru">Рукий</option>
              <!-- russian -->
              <option value="zh">中文 (simplified)</option>
              <!-- chinese simplified -->
              <option value="zh-tw">中文 (traditional)</option>
              <!-- chinese traditional -->
            </select>
          </div>
          <div class="form-group">
            <label for="settings_24_hour_format" data-i18n="use_24_hour_format">Use 24 Hour Format</label>
            <select name="24_hour_format" id="settings_24_hour_format" class="form-control" style="width:150px">
              <option value="1" data-i18n="yes">Yes</option>
              <option value="0" data-i18n="no">No</option>
            </select>
          </div>
          <div class="form-group">
            <label for="settings_submit_on_enter" data-i18n="submit_forms_on_enter">Submit Forms on Enter</label>
            <select name="submit_on_enter" id="settings_submit_on_enter" class="form-control" style="width:150px">
              <option value="1" data-i18n="yes">Yes</option>
              <option value="0" data-i18n="no">No</option>
            </select>
            <p class="help-block" data-i18n="submit_forms_on_enter_help">Be careful when choosing to submit forms via the enter key, submitting can't be undone.</p>
          </div>
          <div class="form-group">
            <label for="settings_remember_passphrase" data-i18n="remember_passphrase_by_default">Remember Passphrase By Default</label>
            <select name="remember_passphrase" id="settings_remember_passphrase" class="form-control" style="width:150px">
              <option value="1" data-i18n="yes">Yes</option>
              <option value="0" data-i18n="no">No</option>
            </select>
            <p class="help-block" data-i18n="remember_passphrase_by_default_help">On the login screen.</p>
          </div>
          <div class="form-group">
            <label for="settings_news" data-i18n="enable_news_section">Enable News Section</label>
            <select name="news" id="settings_news" class="form-control" style="width:150px">
              <option value="-1" id="settings_news_initial" data-i18n="choose">Choose</option>
              <option value="1" data-i18n="yes">Yes</option>
              <option value="0" data-i18n="no">No</option>
            </select>
          </div>
          <div class="form-group">
            <label for="settings_animate_forging" data-i18n="animate_forging_indicator">Animate Forging Indicator</label>
            <select name="animate_forging" id="settings_animate_forging" class="form-control" style="width:150px">
              <option value="1" data-i18n="yes">Yes</option>
              <option value="0" data-i18n="no">No</option>
            </select>
          </div>
          <div class="form-group" id="settings_console_log_div">
            <label for="settings_console_log" data-i18n="show_console_log_button">Show Console Log Button</label>
            <select name="console_log" id="settings_console_log" class="form-control" style="width:150px">
              <option value="1" data-i18n="yes">Yes</option>
              <option value="0" data-i18n="no">No</option>
            </select>
          </div>
        </div>
      </form>
    </div>
    <div class="box box-warning" id="settings_box">
      <div class="box-header">
        <h3 class="box-title" data-i18n="form_warnings">Form Warnings</h3>
      </div>
      <form role="form" autocomplete="off">
        <div class="box-body" style="padding-top:0;">
          <p class="help-block" data-i18n="form_warnings_help">Show a warning when an amount / fee entered is higher than specified below.</p>
          <div class="form-group">
            <label for="settings_amount_warning" data-i18n="max_amount_warning">Max Amount Warning</label>
            <div class="input-group" style="width:150px">
              <input type="text" name="amount_warning" id="settings_amount_warning" class="form-control" />
              <span class="input-group-addon">NHZ</span> </div>
          </div>
          <div class="form-group">
            <label for="settings_fee_warning" data-i18n="max_fee_warning">Max Fee Warning</label>
            <div class="input-group" style="width:150px">
              <input type="text" name="fee_warning" id="settings_fee_warning" class="form-control" />
              <span class="input-group-addon">NHZ</span> </div>
          </div>
          <div class="form-group">
            <label for="settings_asset_transfer_warning" data-i18n="max_asset_transfer_warning">Max Asset Transfer Warning</label>
            <div class="input-group" style="width:150px">
              <input type="text" name="asset_transfer_warning" id="settings_asset_transfer_warning" class="form-control" />
              <span class="input-group-addon">QNT</span> </div>
          </div>
        </div>
      </form>
    </div>
    <div class="box box-success" style="overflow:visible">
      <div class="box-header">
        <h3 class="box-title" data-i18n="theme_settings">Theme Settings</h3>
      </div>
      <form role="form" autocomplete="off">
        <div class="box-body">
          <div class="form-group">
            <label class="control-label" data-i18n="header">Header</label>
            <div class="input-group">
              <div class="btn-group colors">
                <button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown" style="width:140px;text-align:left;"> <span class="text" data-i18n="select_color_scheme">Select Color Scheme</span> <span class="caret"></span> </button>
                <ul id="header_color_scheme" class="dropdown-menu color_scheme_editor" role="menu" data-scheme="header" data-container="body">
                </ul>
              </div>
            </div>
          </div>
          <div class="form-group">
            <label class="control-label" data-i18n="sidebar">Sidebar</label>
            <div class="input-group">
              <div class="btn-group colors">
                <button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown" style="width:140px;text-align:left;"> <span class="text" data-i18n="select_color_scheme">Select Color Scheme</span> <span class="caret"></span> </button>
                <ul id="sidebar_color_scheme" class="dropdown-menu color_scheme_editor" role="menu" data-scheme="sidebar" data-container="body">
                </ul>
              </div>
            </div>
          </div>
          <div class="form-group">
            <label class="control-label">Boxes</label>
            <div class="input-group">
              <div class="btn-group colors">
                <button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown" style="width:140px;text-align:left;"> <span class="text" data-i18n="select_color_scheme">Select Color Scheme</span> <span class="caret"></span> </button>
                <ul id="boxes_color_scheme" class="dropdown-menu color_scheme_editor" role="menu" data-scheme="boxes" data-container="body">
                </ul>
              </div>
            </div>
          </div>
        </div>
      </form>
    </div>
  </section>
</div>

<!-- END SETTINGS PAGE --> 

<!-- BEGIN PEERS PAGE -->
<!-- END PEERS PAGE -->   

<!-- BEGIN NEWS PAGE -->
<!-- END NEWS PAGE -->   
    
<!-- BEGIN BLOCKS PAGE -->
<div id="blocks_page" class="page" style="padding:50px;">

<section class="content-header">
    <div class="row topheading">
      <div class="col-lg-2">
        <h1><i class="fa fa-bars"></i></h1>
      </div>
      <div class="col-lg-10">
        <h1><span data-i18n="blocks">Blocks</span></h1>
        <p data-i18n="blocks_subhead" style="margin-bottom:5px;">This page shows all of the transactions that have been sent and received from your Horizon wallet. You will notice that each day you receive a certain amount of Horizon. This is your interest payment - a daily reward for investing in Horizon.</p>
        <div class="btn-group">
          <label class="btn btn-default active" data-type="">
          <input type="radio" name="blocks_page_type">
          <span data-i18n="all_blocks">All Blocks</span> </label>
        <label class="btn btn-default" data-type="forged_blocks">
          <input type="radio" name="blocks_page_type">
          <span data-i18n="forged_by_you">Forged By You</span> </label>
        </div>
      </div>
    </div>
  </section>



<section class="top-panel">
    <div class="row topheading">
      <div class="col-lg-9">
        <div class="hztabs">
          <div class="hztab">
            <input type="radio" id="tab-7" name="tab-group-7" checked>
            <label for="tab-7"><i class="fa fa-bar"></i> <span data-i18n="recent_blocks">Recent Blocks</span></label>
            <div class="hzcontent">
              <div class="">
                <div class="row boxbody" style="min-height:270px;">
                  <div class="col-lg-12">
                    <div class="data-container data-loading" data-extra="#dashboard_blocks_footer">
          <table class="table table-striped" id="blocks_table">
        <thead>
          <tr>
            <th data-i18n="height">Height</th>
            <th data-i18n="date">Date</th>
            <th data-i18n="amount">Amount</th>
            <th data-i18n="fee">Fee</th>
            <th data-i18n="nr_tx">Nr TX</th>
            <th data-i18n="generator">Generator</th>
            <th data-i18n="payload">Payload</th>
            <th data-i18n="base_target">Base Target</th>
          </tr>
        </thead>
        <tbody>
        </tbody>
      </table>
                      <div class="data-loading-container"><img src="img/loading_indicator.gif" alt="Loading..." width="32" height="32" /></div>
                      <div class="data-empty-container">
                        <div class="topheading">
                          <h3><i class="fa fa-warning" style="color:#f00;"></i> <span data-i18n="no_blocks_yet">No Blocks Yet.</span></h3>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
          
        </div>
      </div>
      <div class="col-lg-3">
        <div class="box">
          <div class="row boxheading">
            <div class="col-lg-12">
              <h3 class="boxheading"><i class="fa fa-info-circle"></i> <span data-i18n="quick_start_title">Quick Start Guide</span></h3>
            </div>
          </div>
          <div class="row boxbody">
            <div class="col-lg-12">
              
            <div><span><i class="ion ion-stats-bars"></i></span> <span data-i18n="avg_amount_per_block">Avg. Amount Per Block</span>: <span id="blocks_average_amount" class="loading_dots"><span>.</span><span>.</span><span>.</span></span></div>


         





            <div><span><i class="ion ion-paperclip"></i></span> <span data-i18n="avg_fee_per_block">Avg. Fee Per Block</span>: <span id="blocks_average_fee" class="loading_dots"><span>.</span><span>.</span><span>.</span></span></div>


         


      



          <div id="blocks_transactions_per_hour_box"><i class="fa fa-shopping-cart"></i></span> <span data-i18n="transactions_per_hour">Transactions Per Hour</span>: <span id="blocks_transactions_per_hour" class="loading_dots"><span>.</span><span>.</span><span>.</span></span></div>


          


      


          <div id="blocks_generation_time_box"><i class="ion ion-clock"></i></span> <span data-i18n="block_generation_time">Block Generation Time</span>: <span id="blocks_average_generation_time" class="loading_dots"><span>.</span><span>.</span><span>.</span></span></div>
           
           
           
           <div id="forged_blocks_total_box"><span><i class="ion ion-bars"></i></span> <span data-i18n="nr_forged_blocks"># Forged Blocks</span>: <span id="forged_blocks_total" class="loading_dots"><span>.</span><span>.</span><span>.</span></span></div>
           
           
           <div id="forged_fees_total_box"><span><i class="ion ion-briefcase"></i></span> <span data-i18n="forged_fees_total">Forged Fees Total</span>: <span id="forged_fees_total" class="loading_dots"><span>.</span><span>.</span><span>.</span></span></div>
            
      


          



            </div>
          </div>
        </div>
      </div>
    </div>
  </section>



      






<!-- END BLOCKS PAGE -->    
    
	</aside>
</div>

<!-- BEGIN TESTNET -->
<!-- END TESTNET -->   

<!-- BEGIN MODAL LEASE BALANCE -->
<!-- END MODAL LEASE BALANCE -->

<!-- BEGIN MODAL STOP FORGING -->
<!-- END MODAL STOP FORGING -->

<!-- BEGIN MODAL START FORGING -->
<!-- END MODAL START FORGING -->

<!-- BEGIN MODAL CANCEL ORDER -->
<!-- END MODAL CANCEL ORDER -->







<!-- BEGIN MODAL ADD CONTACT -->
<!-- END MODAL ADD CONTACT -->

<!-- BEGIN MODAL UPDATE CONTACT -->
<!-- END MODAL UPDATE CONTACT -->

<!-- BEGIN MODAL DELETE CONTACT -->
<!-- END MODAL DELETE CONTACT -->



<!-- BEGIN MODAL DGS LISTING -->
<!-- END MODAL DGS LISTING -->

<!-- BEGIN MODAL DGS DELISTING -->
<!-- END MODAL DGS DELISTING -->

<!-- BEGIN MODAL PRICE CHANGE -->
<!-- END MODAL PRICE CHANGE -->

<!-- BEGIN MODAL QUANTITY CHANGE -->
<!-- END MODAL QUANTITY CHANGE -->

<!-- BEGIN MODAL PRODUCT -->
<!-- END MODAL PRODUCT -->

<!-- BEGIN MODAL PURCHASE -->
<!-- END MODAL PURCHASE -->

<!-- BEGIN MODAL DGS DELIVERY -->
<!-- END MODAL DGS DELIVERY -->

<!-- BEGIN MODAL DGS VIEW DELIVERY -->
<!-- END MODAL DGS VIEW DELIVERY -->

<!-- BEGIN MODAL DGS VIEW PURCHASE -->
<!-- END MODAL DGS VIEW PURCHASE -->

<!-- BEGIN MODAL DGS VIEW REFUND -->
<!-- END MODAL DGS VIEW REFUND -->

<!-- BEGIN MODAL REFUND -->
<!-- END MODAL REFUND -->

<!-- BEGIN MODAL FEEDBACK -->
<!-- END MODAL FEEDBACK -->

<!-- BEGIN MODAL CREATE POLL -->
<!-- END MODAL CREATE POLL -->

<!-- BEGIN MODAL CAST VOTE -->
<!-- END MODAL CAST VOTE -->

<!-- BEGIN MODAL SEND MONEY -->
<div class="modal fade" id="send_money_modal" tabindex="-1" role="dialog" aria-hidden="true">
  <div class="modal-dialog modal-dialog-700">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
        <h4 class="modal-title" data-i18n="send_nhz">Send HZ</h4>
      </div>
      <div class="modal-body">
        <form role="form" autocomplete="off">
          <div class="callout callout-danger error_message" style="display:none"></div>
          <div class="form-group">
            <label for="send_money_recipient" data-i18n="recipient">RECIPIENT</label>
            <div class="input-group">
              <input type="text" class="form-control" name="recipient" id="send_money_recipient" placeholder="Recipient Account" data-i18n="[placeholder]recipient_account" autofocus tabindex="1" />
              <span class="input-group-btn btn-group recipient_selector">
              <button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown"><span class="glyphicon glyphicon-user"></span></button>
              <ul class="dropdown-menu scrollable-menu" role="menu" style="right:0;left:auto;">
              </ul>
              </span> </div>
          </div>
          <div class="form-group recipient_public_key">
            <label for="send_money_recipient_public_key" data-i18n="recipient_public_key">Recipient Public Key</label>
            <input type="text" class="form-control" name="recipientPublicKey" id="send_money_recipient_public_key" placeholder="Public Key" data-i18n="[placeholder]public_key" tabindex="2" spellcheck="false" />
          </div>
          <div class="row">
            <div class="col-xs-6 col-sm-6 col-md-6">
              <div class="form-group">
                <label for="send_money_amount" data-i18n="amount">AMOUNT</label>
                <div class="input-group">
                  <input type="text" name="amountNHZ" id="send_money_amount" step="any" min="0" class="form-control" placeholder="Amount" data-i18n="[placeholder]amount" tabindex="3">
                  <span class="input-group-addon">NHZ</span> </div>
              </div>
            </div>
            <div class="col-xs-6 col-sm-6 col-md-6 advanced_extend" data-normal="6" data-advanced="3">
              <div class="form-group">
                <label for="send_money_fee" data-i18n="fee">FEE</label>
                <div class="input-group">
                  <input type="number" name="feeNHZ" id="send_money_fee" class="form-control" step="any" min="1" placeholder="Fee" data-i18n="[placeholder]fee" data-default="1" value="1" tabindex="4">
                  <span class="input-group-addon">NHZ</span> </div>
              </div>
            </div>
            <div class="col-xs-3 col-sm-3 col-md-3 advanced">
              <div class="form-group">
                <label for="send_money_deadline" data-i18n="deadline_hours">DEADLINE (HOURS)</label>
                <input type="number" name="deadline" id="send_money_deadline" class="form-control" placeholder="Deadline" data-i18n="deadline" min="1" data-default="24" value="24" tabindex="5">
              </div>
            </div>
          </div>
          <div class="form-group dgs_block">
            <input type="checkbox" name="add_message" id="send_money_add_message" class="add_message"  tabindex="6" />
            <label for="send_money_add_message" style="font-weight:normal;margin-bottom:0;"> <span data-i18n="add_message_q">Add a Message?</span></label>
          </div>
          <div class="form-group dgs_block optional_message">
            <label for="send_money_message" data-i18n="message">MESSAGE</label>
            <textarea class="form-control" id="send_money_message" name="message" rows="4" tabindex="7"></textarea>
            <div style="margin-top:3px">
              <label for="send_money_encrypt_message" style="font-weight:normal;color:#666">
                <input type="checkbox" name="encrypt_message" id="send_money_encrypt_message" value="1" data-default="checked" checked="checked" />
                <span data-i18n="encrypt_message">Encrypt Message</span></label>
            </div>
          </div>
          <div class="form-group secret_phrase">
            <label for="send_money_password" data-i18n="passphrase">PASSPHRASE</label>
            <input type="password" name="secretPhrase" id="send_money_password" class="form-control" placeholder="" tabindex="8">
          </div>
          <div class="form-group advanced">
            <label for="send_money_referenced_transaction" data-i18n="referenced_transaction_hash">REFERENCED TRANSACTION HASH</label>
            <input type="text" class="form-control" name="referencedTransactionFullHash" id="send_money_referenced_transaction" placeholder="Referenced Transaction Full Hash" data-i18n="[placeholder]referenced_transaction_full_hash" tabindex="9" spellcheck="false" />
          </div>
          <div class="form-group advanced" style="margin-bottom:5px">
            <input type="checkbox" name="doNotBroadcast" id="send_money_do_not_broadcast" value="1" />
            <label for="send_money_do_not_broadcast" style="font-weight:normal;" tabindex="10" data-i18n="do_not_broadcast">Do Not Broadcast</label>
          </div>
          <div class="form-group dgs_block advanced">
            <input type="checkbox" name="add_note_to_self" id="send_money_add_note_to_self" class="add_note_to_self" tabindex="11" />
            <label for="send_money_add_note_to_self" style="font-weight:normal;margin-bottom:0;"> <span data-i18n="add_note_to_self">Add Note to Self?</span></label>
          </div>
          <div class="form-group dgs_block advanced optional_note">
            <label for="send_money_note_to_self" data-i18n="note_to_self">Note to Self</label>
            <textarea class="form-control" id="send_money_note_to_self" name="note_to_self" rows="4" tabindex="12"></textarea>
            <div style="margin-top:3px;">
              <label style="font-weight:normal;color:#666" data-i18n="note_is_encrypted">This note is encrypted.</span></label>
            </div>
          </div>
          <div class="callout account_info" style="display:none;margin-bottom: 0;"></div>
          <input type="hidden" name="request_type" value="sendMoney" data-default="sendMoney" />
          <input type="hidden" name="converted_account_id" value="" />
          <input type="hidden" name="merchant_info" value="" data-default="" />
        </form>
      </div>
      <div class="modal-footer" style="margin-top:0;">
        <div class="advanced_info"><strong data-i18n="fee">Fee</strong>: <span class="advanced_fee">1 NHZ</span> - <a href="#" data-i18n="advanced">advanced</a></div>
        <button type="button" class="btn btn-default" data-dismiss="modal" data-i18n="cancel">Cancel</button>
        <button type="button" class="btn btn-primary" data-loading-text="Submitting..." data-i18n="send_nhz;[data-loading-text]submitting">Send HZ</button>
      </div>
    </div>
  </div>
</div>

<!-- END MODAL SEND MONEY -->

<!-- BEGIN MODAL SEND MESSAGE -->
<div class="modal fade" id="send_message_modal" tabindex="-1" role="dialog" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
        <h4 class="modal-title" data-i18n="send_message">Send Message</h4>
      </div>
      <div class="modal-body">
        <form role="form" id="send_message_form" autocomplete="off">
          <div class="callout callout-danger error_message" style="display:none"></div>
          <div class="form-group">
            <label for="send_message_recipient" data-i18n="recipient">RECIPIENT</label>
            <div class="input-group">
              <input type="text" class="form-control" name="recipient" id="send_message_recipient" placeholder="Recipient Account" data-i18n="[placeholder]recipient_account" autofocus tabindex="1" />
              <span class="input-group-btn btn-group recipient_selector">
              <button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown"><span class="glyphicon glyphicon-user"></span></button>
              <ul class="dropdown-menu scrollable-menu" role="menu" style="right:0;left:auto;">
              </ul>
              </span> </div>
          </div>
          <div class="form-group recipient_public_key">
            <label for="send_message_recipient_public_key" data-i18n="recipient_public_key">Recipient Public Key</label>
            <input type="text" class="form-control" name="recipientPublicKey" id="send_message_recipient_public_key" placeholder="Public Key" data-i18n="[placeholder]public_key" tabindex="2" spellcheck="false" />
          </div>
          <div class="form-group">
            <label for="send_message_message" data-i18n="message">MESSAGE</label>
            <textarea class="form-control" id="send_message_message" name="message" rows="4" tabindex="3"></textarea>
            <div style="margin-top:3px" class="dgs_block">
              <label for="send_message_encrypt" style="font-weight:normal;color:#666">
                <input type="checkbox" name="encrypt_message" id="send_message_encrypt" value="1" data-default="checked" checked="checked" />
                <span data-i18n="encrypt_message">Encrypt Message</span></label>
            </div>
          </div>
          <div class="row advanced">
            <div class="col-xs-6 col-sm-6 col-md-6">
              <div class="form-group">
                <label for="send_message_fee" data-i18n="fee">FEE</label>
                <div class="input-group">
                  <input type="number" name="feeNHZ" id="send_message_fee" class="form-control" step="any" min="1" placeholder="Fee" data-i18n="[placeholder]fee" data-default="1" value="1" tabindex="4">
                  <span class="input-group-addon">NHZ</span> </div>
              </div>
            </div>
            <div class="col-xs-6 col-sm-6 col-md-6">
              <div class="form-group">
                <label for="send_message_deadline" data-i18n="deadline_hours">DEADLINE (HOURS)</label>
                <input type="number" name="deadline" id="send_message_deadline" class="form-control" placeholder="Deadline" data-i18n="[placeholder]deadline" min="1" data-default="24" value="24" tabindex="5">
              </div>
            </div>
          </div>
          <div class="form-group secret_phrase">
            <label for="send_message_password" data-i18n="passphrase">PASSPHRASE</label>
            <input type="password" name="secretPhrase" id="send_message_password" class="form-control" placeholder="" tabindex="6">
          </div>
          <div class="form-group advanced">
            <label for="send_message_referenced_transaction" data-i18n="referenced_transaction_hash">REFERENCED TRANSACTION HASH</label>
            <input type="text" class="form-control" name="referencedTransactionFullHash" id="send_message_referenced_transaction" placeholder="Referenced Transaction Full Hash" data-i18n="referenced_transaction_full_hash" tabindex="7" spellcheck="false" />
          </div>
          <div class="form-group advanced" style="margin-bottom:5px;">
            <input type="checkbox" name="doNotBroadcast" id="send_message_do_not_broadcast" value="1" />
            <label for="send_message_do_not_broadcast" style="font-weight:normal;" tabindex="8" data-i18n="do_not_broadcast">Do Not Broadcast</label>
          </div>
          <div class="form-group dgs_block advanced">
            <input type="checkbox" name="add_note_to_self" id="send_message_add_note_to_self" class="add_note_to_self" tabindex="9" />
            <label for="send_message_add_note_to_self" style="font-weight:normal;margin-bottom:0;"> <span data-i18n="add_note_to_self">Add Note to Self?</span></label>
          </div>
          <div class="form-group dgs_block advanced optional_note">
            <label for="send_message_note_to_self" data-i18n="note_to_self">Note to Self</label>
            <textarea class="form-control" id="send_message_note_to_self" name="note_to_self" rows="4" tabindex="10"></textarea>
            <div style="margin-top:3px;">
              <label style="font-weight:normal;color:#666" data-i18n="note_is_encrypted">This note is encrypted.</span></label>
            </div>
          </div>
          <div class="callout account_info" style="display:none;margin-bottom: 0;"></div>
          <input type="hidden" name="request_type" value="sendMessage" data-default="sendMessage" />
          <input type="hidden" name="converted_account_id" value="" />
        </form>
      </div>
      <div class="modal-footer" style="margin-top:0;">
        <div class="advanced_info"><strong data-i18n="fee">Fee</strong>: <span class="advanced_fee">1 NHZ</span> - <a href="#" data-i18n="advanced">advanced</a></div>
        <button type="button" class="btn btn-default" data-dismiss="modal" data-i18n="cancel">Cancel</button>
        <button type="button" class="btn btn-primary" data-loading-text="Submitting..." data-i18n="send_message_button;[data-loading-text]submitting">Send Message</button>
      </div>
    </div>
  </div>
</div>

<!-- END MODAL SEND MESSAGE -->

<!-- BEGIN MODAL ACCOUNT INFO -->
<!-- END MODAL ACCOUNT INFO -->

<!-- BEGIN MODAL REGISTER ALIAS -->
<!-- END MODAL REGISTER ALIAS -->

<!-- BEGIN MODAL BUY ALIAS -->
<!-- END MODAL BUY ALIAS -->

<!-- BEGIN MODAL TRANSFER ALIAS -->
<!-- END MODAL TRANSFER ALIAS -->

<!-- BEGIN MODAL SELL ALIAS -->
<!-- END MODAL SELL ALIAS -->

<!-- BEGIN MODAL CANCEL SELL ALIAS -->
<!-- END MODAL CANCEL SELL ALIAS -->

<!-- BEGIN MODAL NO HIDE -->
<div class="modal fade modal-no-hide" id="token_modal" tabindex="-1" role="dialog" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
        <h4 class="modal-title" data-i18n="nhz_token_generation_validation">Nhz Token Generation / Validation</h4>
      </div>
      <div class="modal-body">
        <ul class="nav nav-pills nav-justified" style="margin-bottom:10px">
          <li class="active" id="generate_token_nav" data-tab="generate_token"><a href="#" data-i18n="generate_token">Generate Token</a></li>
          <li data-tab="validate_token"><a href="#" data-i18n="validate_token">Validate Token</a></li>
        </ul>
        <div id="token_modal_generate_token" class="token_modal_content" style="display:none">
          <form role="form" id="generate_token_form" autocomplete="off">
            <div class="callout callout-danger remote_warning" style="display:none" data-i18n="[html]passphrase_remote_warning"><strong>Warning</strong>: Your pass phrase will be sent to the server!</div>
            <div class="callout callout-danger error_message" style="display:none"></div>
            <div class="callout callout-info" id="generate_token_output" style="display:none;"></div>
            <div class="form-group">
              <label for="generate_token_data" data-i18n="data">DATA</label>
              <textarea class="form-control" name="website" id="generate_token_data" placeholder="Website or Text" data-i18n="[placeholder]website_or_text" tabindex="1" rows="3"></textarea>
            </div>
            <input type="hidden" name="request_type" value="generateToken" />
            <div class="form-group secret_phrase">
              <label for="generate_token_password" data-i18n="passphrase">PASSPHRASE</label>
              <input type="password" name="secretPhrase" id="generate_token_password" class="form-control" placeholder="" tabindex="5">
            </div>
          </form>
        </div>
        <div id="token_modal_validate_token" class="token_modal_content" style="display:none">
          <form role="form" id="validate_token_form" autocomplete="off">
            <div class="callout callout-danger error_message" style="display:none"></div>
            <div class="callout callout-info" id="decode_token_output" style="display:none;"></div>
            <div class="form-group">
              <label for="decode_token_data" data-i18n="data">DATA</label>
              <textarea type="text" class="form-control" name="website" id="decode_token_data" placeholder="Website or Text" data-i18n="[placeholder]website_or_text" tabindex="1" rows="3"></textarea>
            </div>
            <input type="hidden" name="request_type" value="decodeToken" />
            <div class="form-group">
              <label for="decode_token_token" data-i18n="token">TOKEN</label>
              <input type="text" class="form-control" name="token" id="decode_token_token" placeholder="Token" data-i18n="[placeholder]token" tabindex="2" value="" />
            </div>
          </form>
        </div>
      </div>
      <div class="modal-footer" style="margin-top:0;">
        <button type="button" class="btn btn-default" data-dismiss="modal" data-i18n="cancel">Cancel</button>
        <button type="button" class="btn btn-primary" id="token_modal_button" data-i18n="generate">Generate</button>
      </div>
    </div>
  </div>
</div>

<!-- END MODAL NO HIDE -->

<!-- BEGIN MODAL BLOCK INFO -->
<!-- END MODAL BLOCK INFO -->



<!-- BEGIN MODAL ALIAS INFO -->
<!-- END MODAL ALIAS INFO -->



<!-- BEGIN MODAL NRS -->
<div class="modal fade" id="nrs_modal" tabindex="-1" role="dialog" aria-hidden="true">
  <div class="modal-dialog modal-dialog-wide">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
        <h4 class="modal-title" data-i18n="nrs_info">NRS Info</h4>
      </div>
      <div class="modal-body">
        <ul class="nav nav-pills nav-justified" style="margin-bottom:10px">
          <li class="active" id="nrs_modal_state_nav" data-tab="state"><a href="#" data-i18n="nrs_state">NRS State</a></li>
          <li data-tab="update"><a href="#" data-i18n="nrs_update">NRS Update</a></li>
        </ul>
        <div id="nrs_modal_update" class="nrs_modal_content" style="display:none">
          <div id="nrs_update_explanation" class="nrs_message"> <span id="nrs_update_explanation_blockchain_sync" data-i18n="update_blockchain_downloading">The blockchain is still downloading, check again after it's up to date.</span> <span id="nrs_update_explanation_wait" data-i18n="checking_for_updates">Checking for updates...</span> <span id="nrs_update_explanation_testnet" data-i18n="update_testnet">NRS cannot be updated whilst connected to the testnet.</span> <span id="nrs_update_explanation_up_to_date" data-i18n="update_up_to_date">You have the latest release already. There is no need to update.</span> <span id="nrs_update_explanation_new_release"> <span data-i18n="update_available">A new NRS release is available. It is recommended that you update.</span> <br />
            <br />
            <button type="button" class="btn btn-success ignore" onClick="NRS.downloadClientUpdate('release')"><span data-i18n="download_nrs">Download NRS</span> <span class="nrs_new_version_nr"></span></button>
            </span> <span id="nrs_update_explanation_new_beta"> <span data-i18n="update_beta_available">A new experimental release is available. It is not recommended that you install this unless you know what you're doing.</span> <br />
            <br />
            <button type="button" class="btn btn-success btn-xs ignore" onClick="NRS.downloadClientUpdate('beta')"><span data-i18n="download_nrs">Download NRS</span> <span class="nrs_beta_version_nr"></span></button>
            </span> <span id="nrs_update_explanation_new_choice"> <span data-i18n="update_multiple_available"> Both a general and experimental release are available. It is not recommended that you install the experimental release unless you know what you're doing. </span> <br />
            <br />
            <button type="button" class="btn btn-success ignore" onClick="NRS.downloadClientUpdate('release')"><span data-i18n="download_nrs">Download NRS</span> <span class="nrs_new_version_nr"></span> - <span data-i18n="general_release">General Release</span></button>
            <button type="button" class="btn btn-default ignore" onClick="NRS.downloadClientUpdate('beta')"><span data-i18n="download_nrs">Download NRS</span> <span class="nrs_beta_version_nr"></span> - <span data-i18n="experimental_release">Experimental Release</span></button>
            </span> </div>
          <div id="nrs_update_drop_zone" data-i18n="drop_update">Drop client update (zip file) here when downloaded or click to select.</div>
          <div id="nrs_update_result"></div>
          <div id="nrs_update_hashes" style="display:none;padding-top:10px;">
            <table style="width:100%">
              <tr>
                <td style="background-color:#efefef;font-weight:bold;"><span data-i18n="version">Version</span>:</td>
                <td><span id="nrs_update_hash_version"></span></td>
              </tr>
              <tr>
                <td style="background-color:#efefef;font-weight:bold;"><span data-i18n="downloaded_hash">Downloaded hash</span>:</td>
                <td><span id="nrs_update_hash_download"></span></td>
              </tr>
              <tr>
                <td style="background-color:#efefef;font-weight:bold;"><span data-i18n="official_hash">Official hash</span>:</td>
                <td><span id="nrs_update_hash_official"></span></td>
              </tr>
            </table>
          </div>
          <div id="nrs_update_hash_progress">&nbsp;</div>
          <div style="display:none">
            <iframe id="nrs_update_iframe"></iframe>
            <input type="file" id="nrs_update_file_select" name="files[]" />
          </div>
        </div>
        <div id="nrs_modal_state" class="nrs_modal_content" style="display:none">
          <table class="table table-striped" id="nrs_node_state_table" style="margin-bottom:0;">
            <tbody>
              <tr>
                <td style="font-weight: bold"><span data-i18n="version">Version</span>:</td>
                <td><span id="nrs_node_state_version"></span></td>
                <td style="font-weight: bold"><span data-i18n="nr_blocks"># Blocks</span>:</td>
                <td><span id="nrs_node_state_numberOfBlocks"></span></td>
              </tr>
              <tr>
                <td style="font-weight: bold"><span data-i18n="last_block">Last Block</span>:</td>
                <td><span id="nrs_node_state_lastBlock"></span></td>
                <td style="font-weight: bold"><span data-i18n="nr_accounts"># Accounts</span>:</td>
                <td><span id="nrs_node_state_numberOfAccounts"></span></td>
              </tr>
              <tr>
                <td style="font-weight: bold"><span data-i18n="last_feeder">Last Feeder</span>:</td>
                <td><span id="nrs_node_state_lastBlockchainFeeder"></span></td>
                <td style="font-weight: bold"><span data-i18n="nr_unlocked_accounts"># Unlocked Accounts</span>:</td>
                <td><span id="nrs_node_state_numberOfUnlockedAccounts"></span></td>
              </tr>
              <tr>
                <td style="font-weight: bold"><span data-i18n="last_feeder_height">Last Feeder Height</span>:</td>
                <td><span id="nrs_node_state_lastBlockchainFeederHeight"></span></td>
                <td style="font-weight: bold"><span data-i18n="nr_peers"># Peers</span>:</td>
                <td><span id="nrs_node_state_numberOfPeers"></span></td>
              </tr>
              <tr>
                <td style="font-weight: bold"><span data-i18n="total_memory">Total Memory</span>:</td>
                <td><span id="nrs_node_state_totalMemory"></span></td>
                <td style="font-weight: bold"><span data-i18n="nr_transactions"># Transactions</span>:</td>
                <td><span id="nrs_node_state_numberOfTransactions"></span></td>
              </tr>
              <tr>
                <td style="font-weight: bold"><span data-i18n="free_memory">Free Memory</span>:</td>
                <td><span id="nrs_node_state_freeMemory"></span></td>
                <td style="font-weight: bold"><span data-i18n="nr_aliases"># Aliases</span>:</td>
                <td><span id="nrs_node_state_numberOfAliases"></span></td>
              </tr>
              <tr>
                <td style="font-weight: bold"><span data-i18n="max_memory">Max Memory</span>:</td>
                <td><span id="nrs_node_state_maxMemory"></span></td>
                <td style="font-weight: bold"><span data-i18n="nr_orders"># Orders</span>:</td>
                <td><span id="nrs_node_state_numberOfOrders"></span></td>
              </tr>
              <tr>
                <td style="font-weight: bold"><span data-i18n="processors">Processors</span>:</td>
                <td><span id="nrs_node_state_availableProcessors"></span></td>
                <td style="font-weight: bold"><span data-i18n="nr_assets"># Assets</span>:</td>
                <td><span id="nrs_node_state_numberOfAssets"></span></td>
              </tr>
              <tr>
                <td style="font-weight: bold"><span data-i18n="difficulty">Difficulty</span>:</td>
                <td><span id="nrs_node_state_cumulativeDifficulty"></span></td>
                <td style="font-weight: bold"><span data-i18n="nr_trades"># Trades</span>:</td>
                <td><span id="nrs_node_state_numberOfTrades"></span></td>
              </tr>
              <tr>
                <td style="font-weight: bold"><span data-i18n="total_balance">Total Balance</span>:</td>
                <td><span id="nrs_node_state_totalEffectiveBalanceNHZ"></span></td>
                <td style="font-weight: bold"><span data-i18n="nr_polls"># Polls</span>:</td>
                <td><span id="nrs_node_state_numberOfPolls"></span></td>
              </tr>
              <tr>
                <td style="font-weight: bold"><span data-i18n="time">Time</span>:</td>
                <td><span id="nrs_node_state_time"></span></td>
                <td style="font-weight: bold"><span data-i18n="nr_votes"># Votes</span>:</td>
                <td><span id="nrs_node_state_numberOfVotes"></span></td>
              </tr>
              <tr>
                <td style="font-weight: bold"><span data-i18n="is_scanning">Is Scanning</span>:</td>
                <td><span id="nrs_node_state_isScanning"></span></td>
                <td style="font-weight: bold">&nbsp;</td>
                <td>&nbsp;</td>
              </tr>
            </tbody>
          </table>
        </div>
      </div>
      <div class="modal-footer" style="margin-top:0;">
        <button type="button" class="btn btn-primary" data-dismiss="modal"><span data-i18n="close">Close</button>
      </div>
    </div>
  </div>
</div>

<!-- END MODAL NRS -->

<!-- BEGIN MODAL ACCOUNT DETAILS -->
<div class="modal fade" id="account_details_modal" tabindex="-1" role="dialog" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
        <h4 class="modal-title" data-i18n="account_details">Account Details</h4>
      </div>
      <div class="modal-body">
        <ul class="nav nav-pills nav-justified" style="margin-bottom:10px">
          <li class="active" id="account_details_balance_nav" data-tab="balance"><a href="#" data-i18n="account_details">Account Details</a></li>
          <li data-tab="leasing"><a href="#" data-i18n="account_leasing">Account Leasing</a></li>
        </ul>
        <div id="account_details_modal_balance" class="account_details_modal_content" style="display:none">
          <div class="callout callout-danger" id="account_balance_warning" style="display:none"></div>
          <table class="table" id="account_balance_table" style="margin-bottom:0;table-layout:fixed;">
            <tbody>
              <tr>
                <td style="font-weight: bold;width:180px;"><span data-i18n="account_id">Account ID</span>:</td>
                <td><span id="account_balance_account_rs"></span></td>
              </tr>
              <tr>
                <td style="font-weight: bold;width:180px;"><span data-i18n="numeric_account_id">Numeric Account ID</span>:</td>
                <td><span id="account_balance_account"></span></td>
              </tr>
              <tr>
                <td style="font-weight: bold"><span data-i18n="balance">Balance</span>:</td>
                <td><span id="account_balance_balance"></span></td>
              </tr>
              <tr>
                <td style="font-weight: bold"><span data-i18n="available_balance">Available Balance</span>:</td>
                <td><span id="account_balance_unconfirmed_balance"></span></td>
              </tr>
              <tr>
                <td style="font-weight: bold"><span data-i18n="guaranteed_balance">Guaranteed Balance</span>:</td>
                <td><span id="account_balance_guaranteed_balance"></span></td>
              </tr>
              <tr>
                <td style="font-weight: bold"><span data-i18n="effective_balance">Effective Balance</span>:</td>
                <td><span id="account_balance_effective_balance"></span></td>
              </tr>
              <tr>
                <td style="font-weight: bold"><span data-i18n="public_key">Public Key</span>:</td>
                <td><span id="account_balance_public_key" style="word-break:break-all;word-wrap: break-word;"></span></td>
              </tr>
              <tr>
                <td style="font-weight: bold"><span data-i18n="account_qr_code">Account QR Code</span>:</td>
                <td><div id="account_details_modal_qr_code"></div></td>
              </tr>
            </tbody>
          </table>
        </div>
        <div id="account_details_modal_leasing" class="account_details_modal_content" style="display:none">
          <div id="account_leasing_status" class="nrs_message" style="display:none"></div>
          <div id="account_lessor_container" style="display:none;max-height:350px;overflow:auto;">
            <table class="table table-striped" id="account_lessor_table" style="margin-bottom:0">
              <thead>
                <tr>
                  <th data-i18n="lessor">Lessor</th>
                </tr>
              </thead>
              <tbody>
              </tbody>
            </table>
          </div>
          <div style="padding-top:10px"><a href="#" data-toggle="modal" data-target="#lease_balance_modal" data-i18n="lease_balance_to_account">Lease your balance to another account.</a></div>
        </div>
      </div>
      <div class="modal-footer" style="margin-top:0;">
        <button type="button" class="btn btn-primary" data-dismiss="modal" data-i18n="close">Close</button>
      </div>
    </div>
  </div>
</div>

<!-- END MODAL ACCOUNT DETAILS -->

<!-- BEGIN MODAL RAW TRANSACTION -->
<!-- END MODAL RAW TRANSACTION -->

<!-- BEGIN MODAL TRANSACTION OPERATIONS -->
<div class="modal fade modal-no-hide" id="transaction_operations_modal" tabindex="-1" role="dialog" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
        <h4 class="modal-title" data-i18n="advanced_transaction_operations">Advanced Transaction Operations</h4>
      </div>
      <div class="modal-body">
        <ul class="nav nav-pills nav-justified" style="margin-bottom:10px">
          <li class="active" id="broadcast_transaction_nav" data-tab="broadcast_transaction"><a href="#" data-i18n="broadcast_transaction">Broadcast Transaction</a></li>
          <li data-tab="parse_transaction"><a href="#" data-i18n="parse_transaction">Parse Transaction</a></li>
          <li data-tab="calculate_full_hash"><a href="#" data-i18n="calculate_full_hash">Calculate Full Hash</a></li>
        </ul>
        <div id="transaction_operations_modal_broadcast_transaction" class="tab_content" style="display:none">
          <form role="form" id="broadcast_transaction_form" autocomplete="off">
            <div class="callout callout-danger error_message" style="display:none"></div>
            <div class="form-group">
              <label for="broadcast_transaction_transaction_bytes" data-i18n="transaction_bytes">TRANSACTION BYTES</label>
              <textarea class="form-control" name="transactionBytes" id="broadcast_transaction_transaction_bytes" rows="4" placeholder="Signed Transaction Bytes" data-i18n="[placeholder]signed_transaction_bytes"></textarea>
            </div>
            <input type="hidden" name="request_type" value="broadcastTransaction" />
          </form>
        </div>
        <div id="transaction_operations_modal_parse_transaction" class="tab_content" style="display:none">
          <form role="form" id="parse_transaction_form" autocomplete="off">
            <div class="callout callout-danger error_message" style="display:none"></div>
            <div class="form-group">
              <label for="parse_transaction_transaction_bytes" data-i18n="transaction_bytes">TRANSACTION BYTES</label>
              <textarea class="form-control" name="transactionBytes" id="parse_transaction_transaction_bytes" rows="4" placeholder="Transaction Bytes" data-i18n="[placeholder]transaction_bytes"></textarea>
            </div>
            <input type="hidden" name="request_type" value="parseTransaction" />
            <div id="parse_transaction_output" class="output" style="max-height:350px;overflow:auto">
              <table class="table table-striped output_table" id="parse_transaction_output_table" style="margin-bottom:0;table-layout:fixed">
                <tbody>
                </tbody>
              </table>
            </div>
          </form>
        </div>
        <div id="transaction_operations_modal_calculate_full_hash" class="tab_content" style="display:none">
          <form role="form" id="calculate_full_hash_form" autocomplete="off">
            <div class="callout callout-danger error_message" style="display:none"></div>
            <div class="form-group">
              <label for="calculate_full_hash_unsigned_transaction_bytes" data-i18n="unsigned_transaction_bytes">UNSIGNED TRANSACTION BYTES</label>
              <textarea class="form-control" name="unsignedTransactionBytes" id="calculate_full_hash-unsigned_transaction_bytes" rows="4" placeholder="Unsigned Transaction Bytes" data-i18n="[placeholder]unsigned_transaction_bytes"></textarea>
            </div>
            <div class="form-group">
              <label for="calculate_full_hash_signature_hash" data-i18n="signature_hash">SIGNATURE HASH</label>
              <textarea class="form-control" name="signatureHash" id="calculate_full_hash-unsigned_transaction_bytes" rows="1" placeholder="Signature Hash" data-i18n="[placeholder]signature_hash"></textarea>
            </div>
            <input type="hidden" name="request_type" value="calculateFullHash" />
            <div id="calculate_full_hash_output" class="output" style="max-height:350px;overflow:auto">
              <table class="table table-striped output_table" id="calculate_full_hash_output_table" style="margin-bottom:0;table-layout:fixed">
                <tbody>
                </tbody>
              </table>
            </div>
          </form>
        </div>
      </div>
      <div class="modal-footer" style="margin-top:0;">
        <button type="button" class="btn btn-default" data-dismiss="modal" data-i18n="cancel">Cancel</button>
        <button type="button" class="btn btn-primary" id="transaction_operations_modal_button" data-loading-text="Submitting..." data-i18n="submit;[data-loading-text]submitting">Submit</button>
      </div>
    </div>
  </div>
</div>

<!-- END MODAL TRANSACTION OPERATIONS -->

<!-- BEGIN MODAL ASSET EXCHANGE GROUP NAME -->
<!-- END MODAL ASSET EXCHANGE GROUP NAME -->

<!-- BEGIN MODAL ASSET EXCHANGE GROUP -->
<!-- END MODAL ASSET EXCHANGE GROUP -->

<!-- BEGIN MODAL DECRYPT -->
<!-- END MODAL DECRYPT -->

<!-- BEGIN FORM DECRYPT NOTE  -->
<!-- END FORM DECRYPT NOTE -->

<!-- BEGIN SIDEBAR ASSET EXCHANGE CONTEXT -->
<!-- END SIDEBAR ASSET EXCHANGE CONTEXT -->

<!-- BEGIN SIDEBAR ASSET EXCHANGE GROUP CONTEXT -->
<!-- END SIDEBAR ASSET EXCHANGE GROUP CONTEXT -->

<!-- BEGIN SIDEBAR MESSAGES CONTEXT -->
<!-- END SIDEBAR MESSAGES CONTEXT -->

<!-- BEGIN SIDEBAR MESSAGES UPDATE CONTEXT -->
<!-- END SIDEBAR MESSAGES UPDATE CONTEXT -->

<!-- BEGIN DOWNLOAD BLOCKCHAIN -->
<!-- END DOWNLOAD BLOCKCHAIN -->

<!-- BEGIN SHOW CONSOLE -->
<!-- END SHOW CONSOLE -->




<!--[if lte IE 9]>
        <script type="text/javascript">
            window.onload = function() {
                document.body.innerHTML = '<div id="old_browser_warning" style="margin-left:auto;margin-right:auto;margin-top:200px;background:white;color:black;padding:20px;width:300px;">You are using an old browser which this application does not support.</div>';
            }
        </script>
        <![endif]--> 

<script src="js/3rdparty/jquery.js"></script> 
<script src="js/3rdparty/bootstrap.js" type="text/javascript"></script> 
<script src="js/3rdparty/i18next.js" type="text/javascript"></script> 
<script type="text/javascript">
            $.i18n.init({
                fallbackLng: "en",
                lowerCaseLng: true,
                detectLngFromLocalStorage: true,
                resGetPath: "locales/__lng__.json",
                debug: false
            }, function() {
                $("[data-i18n]").i18n();
            });
        </script> 
<script src="js/3rdparty/ajaxretry.js"></script> 
<script src="js/3rdparty/ajaxmultiqueue.js"></script> 
<script src="js/3rdparty/jquery.rss.js" type="text/javascript"></script> 
<script src="js/3rdparty/webdb.js" type="text/javascript"></script> 
<script src="js/3rdparty/growl.js" type="text/javascript"></script> 
<script src="js/3rdparty/zeroclipboard.js" type="text/javascript"></script> 
<script src="js/3rdparty/jsbn.js" type="text/javascript"></script> 
<script src="js/3rdparty/jsbn2.js" type="text/javascript"></script> 
<script src="js/3rdparty/big.js" type="text/javascript"></script> 
<script src="js/3rdparty/pako.js" type="text/javascript"></script> 
<script src="js/3rdparty/maskedinput.js" type="text/javascript"></script> 
<script src="js/3rdparty/qrcode.js" type="text/javascript"></script> 
<script src="js/util/extensions.js" type="text/javascript"></script> 
<script src="js/util/converters.js" type="text/javascript"></script> 
<script src="js/util/nhzaddress.js" type="text/javascript"></script> 
<script src="js/crypto/3rdparty/jssha256.js" type="text/javascript"></script> 
<script src="js/crypto/curve25519.js" type="text/javascript"></script> 
<script src="js/crypto/curve25519_.js" type="text/javascript"></script> 
<script src="js/crypto/3rdparty/cryptojs/aes.js" type="text/javascript"></script> 
<script src="js/crypto/3rdparty/cryptojs/sha256.js" type="text/javascript"></script> 
<script src="js/nrs.js" type="text/javascript"></script> 
<script src="js/nrs.server.js" type="text/javascript"></script> 
<script src="js/nrs.forms.js" type="text/javascript"></script> 
<script src="js/nrs.login.js" type="text/javascript"></script> 
<script src="js/nrs.update.js" type="text/javascript"></script> 
<script src="js/nrs.recipient.js" type="text/javascript"></script> 
<script src="js/nrs.assetexchange.js" type="text/javascript"></script> 
<script src="js/nrs.dgs.js" type="text/javascript"></script> 
<script src="js/nrs.messages.js" type="text/javascript"></script> 
<script src="js/nrs.aliases.js" type="text/javascript"></script> 
<script src="js/nrs.polls.js" type="text/javascript"></script> 
<script src="js/nrs.blocks.js" type="text/javascript"></script> 
<script src="js/nrs.transactions.js" type="text/javascript"></script> 
<script src="js/nrs.peers.js" type="text/javascript"></script> 
<script src="js/nrs.contacts.js" type="text/javascript"></script> 
<script src="js/nrs.news.js" type="text/javascript"></script> 
<script src="js/nrs.settings.js" type="text/javascript"></script> 
<script src="js/nrs.sidebar.js" type="text/javascript"></script> 
<script src="js/nrs.encryption.js" type="text/javascript"></script> 
<script src="js/nrs.modals.js" type="text/javascript"></script> 
<script src="js/nrs.modals.account.js" type="text/javascript"></script> 
<script src="js/nrs.modals.accountdetails.js" type="text/javascript"></script> 
<script src="js/nrs.modals.block.js" type="text/javascript"></script> 
<script src="js/nrs.modals.forging.js" type="text/javascript"></script> 
<script src="js/nrs.modals.info.js" type="text/javascript"></script> 
<script src="js/nrs.modals.token.js" type="text/javascript"></script> 
<script src="js/nrs.modals.transaction.js" type="text/javascript"></script> 
<script src="js/nrs.modals.accountinfo.js" type="text/javascript"></script> 
<script src="js/nrs.modals.balanceleasing.js" type="text/javascript"></script> 
<script src="js/nrs.modals.advanced.js" type="text/javascript"></script> 
<script src="js/nrs.console.js" type="text/javascript"></script> 
<script src="js/nrs.util.js" type="text/javascript"></script>
</body>
</html>