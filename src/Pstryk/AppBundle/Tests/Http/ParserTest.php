<?php
namespace Pstryk\AppBundle\Tests\Http;

use Pstryk\AppBundle\Http\Parser;

class ParserTest extends \PHPUnit_Framework_TestCase {
    /**
     * @var Parser
     */
    private $parser;

    private $content = '
<!DOCTYPE HTML>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<link rel="stylesheet" type="text/css" href="/css/upc.css">
<script src="/language/english.js" type="text/javascript"></script>

<script src="/trans_func.js" type="text/javascript"></script>
<link rel="shortcut icon" href="/favicon.ico" />
<script>i18n_PageTitle("TAG_UPC_22 - UPC_Wireless_Cable_Router_Configuration_STATUS_Downstream")</script>
</head>

<!--[if !IE]><body><![endif]-->
<!--[if IE 9]><body class="ie9"><![endif]-->
<!--[if IE 8]><body class="ie8"><![endif]-->
<!--[if IE 7]><body class="ie7"><![endif]-->
<!--[if lt IE 7]><body><![endif]-->
<div class="upc_container upc_container_12">
<div class="upc_grid_12">

<!--masthead-->
    <div class="upc_masthead">
        <!--top, contains logog ad languageswitch-->
        <div class="top">
            <img src="/media/img/upc_logo.png" width="64" height="59" class="logo" alt="upc">
            <form action="/goform/languages" class="language_switch" method="POST">
                <input type="hidden" name="CSRFValueL" value=19672260>
                <label><a href="/logout.asp" class="logout_nolock">admin</a>&nbsp;&nbsp;<script>i18n("LOGIN_AREA_LANGUAGE=")</script>:</label>
                <select name="UpcLanguages" id="lang" onChange="this.form.submit()">
            <option value="1" selected>English</option>
<option value="2" >Nederlands</option>
<option value="3" >Deutsch</option>
<option value="4" >Türkçe</option>
<option value="5" >Français</option>
<option value="6" >Italiano</option>
<option value="7" >Magyar</option>
<option value="8" >Polski</option>
<option value="9" >Română</option>
<option value="10" >Čeština</option>
<option value="11" >Slovenčina</option>

                </select>
                <a href="/logout.asp" class="logout"><script>i18n("SPECIAL_PAGE_LOGIN_LOGOUT=")</script></a>
            </form>
        </div> 

        <ul class="navigationbar">
            <li><a href="#"><script>i18n("CONTENT_STATUS_MTA_STATUS_TITLE=")</script></a></li>
            <li><a href="/basic/internet.asp"><script>i18n("CONTENT_STATUS_CONNECTION_BASIC_TITLE=")</script></a></li>
            <li><a href="/advanced/options.asp"><script>i18n("LM_ENTRY_WIRELESS_2G_ADVANCED=")</script></a></li>
            <li><a href="/parental/device-rules.asp"><script>i18n("CONTENT_SYSTEM_LOG_CONFIG_MODULE_PARENTAL_CONTROL=")</script></a></li>
            <li><a href="/wireless/radio.asp"><script>i18n("CONTENT_SYSTEM_LOG_CONFIG_MODULE_WIRELESS=")</script></a></li>
            
            <li><a href="/system/password.asp"><script>i18n("CONTENT_STATUS_SYSTEM_TITLE=")</script></a></li>
        </ul>
    </div>
    <!--end masthead-->

</div>
<div class="clear">&nbsp;</div> 
<div class="upc_grid_3">

<!--subnavigation-->
<ul class="upc_subnav">
<li><a href="/status/system.asp"><script>i18n("CONTENT_STATUS_SYSTEM_TITLE=")</script></a></li><li><a href="/status/connection-basic.asp" class="active"><script>i18n("LM_ENTRY_STATUS_CONNECTION=")</script></a><ul><li><a href="/status/connection-basic.asp"><script>i18n("CONTENT_STATUS_CONNECTION_BASIC_TITLE=")</script></a></li><li><a href="/status/connection-upstream.asp"><script>i18n("LM_ENTRY_STATUS_CONNECTION_UPSTREAM=")</script></a></li><li><a href="#" class="active"><script>i18n("LM_ENTRY_STATUS_CONNECTION_DOWNSTREAM=")</script></a></li></ul></li><li><a href="/status/mta.asp"><script>i18n("LM_ENTRY_STATUS_MTA=")</script></a><ul><li><a href="/status/mta.asp"><script>i18n("CONTENT_STATUS_MTA_STATUS_TITLE=")</script></a></li></ul></li><li><a href="/status/diagnostics-ping.asp"><script>i18n("LM_ENTRY_STATUS_DIAGNOSTIC=")</script></a><ul><li><a href="/status/diagnostics-ping.asp"><script>i18n("LM_ENTRY_STATUS_DIAGNOSTIC_PING=")</script></a></li><li><a href="/status/diagnostics-route.asp"><script>i18n("LM_ENTRY_STATUS_DIAGNOSTIC_TRACEROUTE=")</script></a></li></ul></li>
</ul>
<!--end subnavigation-->

</div>
<div class="upc_grid_9">

<h1><script>i18n("CONTENT_STATUS_MTA_STATUS_TITLE=")</script></h1>
<div class="upc_content_area">
<h2><script>i18n("LM_ENTRY_STATUS_CONNECTION_DOWNSTREAM=")</script></h2>
<p><script>i18n("CONTENT_STATUS_CONNECTION_DS_DESCRIPTION=")</script></p>

<h3><script>i18n("CONTENT_STATUS_CONNECTION_DS_TABLE_TITLE=")</script></h3>
<table>
<thead>
<tr>
<th><script>i18n("CONTENT_STATUS_CONNECTION_DS_RECEIVER_NUM=")</script></th>
<th><script>i18n("CONTENT_STATUS_CONNECTION_DS_CH_ID=")</script></th>
<th><script>i18n("CONTENT_STATUS_CONNECTION_DS_LOCK_STATUS=")</script></th>
<th><script>i18n("CONTENT_STATUS_CONNECTION_DS_FREQUENCY=")</script></th>
<th><script>i18n("CONTENT_STATUS_CONNECTION_DS_MODULATION=")</script></th>
<th><script>i18n("CONTENT_STATUS_CONNECTION_DS_SYMBOL_RATE=")</script></th>
<th><script>i18n("CONTENT_STATUS_CONNECTION_DS_SNR=")</script></th>
<th><script>i18n("CONTENT_STATUS_CONNECTION_DS_POWER=")</script></th>
</tr>
</thead>
<tbody>
	
<tr><td>1</td> <td>3</td> <td><script>i18n("TAG_UPC_T38")</script></td> <td>802000000</td> <td><script>i18n("256QAM")</script></td>  <td><script>i18n("6952000")</script></td> <td>40.3</td> <td> 0.6</td></tr>
<tr><td>2</td> <td>1</td> <td><script>i18n("TAG_UPC_T38")</script></td> <td>786000000</td> <td><script>i18n("256QAM")</script></td>  <td><script>i18n("6952000")</script></td> <td>40.3</td> <td> 0.9</td></tr>
<tr><td>3</td> <td>2</td> <td><script>i18n("TAG_UPC_T38")</script></td> <td>794000000</td> <td><script>i18n("256QAM")</script></td>  <td><script>i18n("6952000")</script></td> <td>40.3</td> <td> 0.9</td></tr>
<tr><td>4</td> <td>4</td> <td><script>i18n("TAG_UPC_T38")</script></td> <td>810000000</td> <td><script>i18n("256QAM")</script></td>  <td><script>i18n("6952000")</script></td> <td>39.9</td> <td> 0.6</td></tr>
<tr><td>5</td> <td>5</td> <td><script>i18n("TAG_UPC_T38")</script></td> <td>818000000</td> <td><script>i18n("256QAM")</script></td>  <td><script>i18n("6952000")</script></td> <td>40.4</td> <td> 0.6</td></tr>
<tr><td>6</td> <td>6</td> <td><script>i18n("TAG_UPC_T38")</script></td> <td>826000000</td> <td><script>i18n("256QAM")</script></td>  <td><script>i18n("6952000")</script></td> <td>39.9</td> <td> 0.0</td></tr>
<tr><td>7</td> <td>7</td> <td><script>i18n("TAG_UPC_T38")</script></td> <td>834000000</td> <td><script>i18n("256QAM")</script></td>  <td><script>i18n("6952000")</script></td> <td>40.3</td> <td> 0.3</td></tr>
<tr><td>8</td> <td>8</td> <td><script>i18n("TAG_UPC_T38")</script></td> <td>842000000</td> <td><script>i18n("256QAM")</script></td>  <td><script>i18n("6952000")</script></td> <td>39.9</td> <td>-0.3</td></tr>


<!--and so on...-->
</tbody>
</table>
<form class="upc_inline_form" action="/goform/status/connection-downstream" method="POST" name="status/connection-downstream">
<input type="hidden" name="CSRFValue" value=19672260>
<label><script>i18n("CONTENT_STATUS_CONNECTION_DS_FREQUENCY=")</script></label><input id="freq" type="text" name= "CmInfoDsFreq1" value="802000"><span class="extralabel"><script>i18n("CONTENT_STATUS_CONNECTION_DS_FREQ_UNIT=")</script></span>
<button class="upc_button4" type="submit"><span><script>i18n("CONTENT_STATUS_CONNECTION_DS_FORCE_FREQ=")</script></span></button>
</form>

<div class="clear">&nbsp;</div>
</div>
<div class="upc_content_area_footer">&nbsp;</div>


</div>
<div class="clear">&nbsp;</div>
</div>
</body>
</html>
';

    public function setUp() {
        $this->parser = new \Pstryk\AppBundle\Http\Parser();
    }
    
    public function tearDown() {
        unset($this->parser);
    }

    public function testParse() {
        $downstreams = $this->parser->parse($this->content);
        
        $first = $downstreams->first();
        $this->assertEquals(1, $first->getReceiverNo());
        $this->assertEquals(3, $first->getChannelId());
        $this->assertEquals('TAG_UPC_T38', $first->getLockStatus());
        $this->assertEquals(802000000, $first->getFrequency());
        $this->assertEquals('256QAM', $first->getModulation());
        $this->assertEquals(6952000, $first->getSymbolRate());
        $this->assertEquals(40.3, $first->getSnr());
        $this->assertEquals(0.6, $first->getPower());
    }
    
}
