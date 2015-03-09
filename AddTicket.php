<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>Add Ticket</title>
<style type="text/css">
@import url("css-form-style-sample/form_style.css");
</style>
</head>

<body>
<form id="Add" name="AddTicket" method="post" class="dark-matter">
<h1>Ticket Adding Form
	<span>Please fill all the fields.</span>
</h1>
  <p>
      <label for="textfield">Title:</label>
      <input type="text" placeholder="Enter Subject" name="title" id="title">
      
      <label for="textfield">Description:</label>
      <textarea id="description" name="des"></textarea>
      
      <label for="textfield">Customer:</label>
      <input type="text" name="Customer" id="Customer">
      
      <label for="textfield"> Assigned To:</label>
      <input type="checkbox" name="00">
      <labelc for="checkbox">Sasank </labelc>
      <input type="checkbox" name="01"> 
      <labelc for="checkbox">Asad </labelc>
      <input type="checkbox" name="02">
      <labelc for="checkbox">EPrice </labelc>
      <input type="checkbox" name="03"> 
      <labelc for="checkbox">Alex </labelc>
      <input type="checkbox" name="04">
      <labelc for="checkbox">MrGrove </labelc>
      <input type="checkbox" name="05">
      <labelc for="checkbox">Jojomo </labelc>   
      <br><br>
      
      <label for="select">Category:</label>
      <select name="select" id="select" size="1">
      	<option value="Pleae select">Please Select</option>
     	<option value="Account creation">Account Creation</option>
	    <option value="Account previleges">Account previleges</option>
        <option value="AD">AD</option>
	    <option value="Backup">Backup</option>
        <option value="Checkout item">Checkout item</option>
	    <option value="Course">Course</option>
        <option value="Data">Data</option>
	    <option value="Database">Database</option>
        <option value="Decomission">Decommision</option>
     	<option value="DNS">DNS</option>
	    <option value="Documentation">Documentation</option>
        <option value="Email">Email</option>
	    <option value="Hardware">Hardware</option>
        <option value="HCC">HCC</option>
	    <option value="HPC">HPC</option>
        <option value="Imaging">Imaging</option>
	    <option value="Inventory">Inventory</option>
        <option value="IRC">IRC</option>
        <option value="Login">Login</option>
        <option value="Logs">Logs</option>
        <option value="Misc">Misc</option>
        <option value="Move">Move</option>
        <option value="Network">Netowrk</option>
        <option value="Organize">Organize</option>
        <option value="OS Install">OS Install</option>
        <option value="Inventory">OS Upgrade</option>
        <option value="Other Account Related">Other Account Related</option>
        <option value="Password">Password</option>
        <option value="Permission">Permission</option>
        <option value="Printer">Printer</option>
        <option value="Public Relations">Public Relations</option>
        <option value="Purchase Request">Purchase Request</option>
        <option value="Restricted Data">Restricted Data</option>
        <option value="Room Access">Room Access</option>
        <option value="Room Reservation">Room Reservation</option>
        <option value="SCM">SCM</option>
        <option value="Security">Security</option>
        <option value="Server">Server</option>
        <option value="Software">Software</option>
        <option value="SSL Certificate">SSL Certificate</option>
        <option value="Storage">Storage</option>
        <option value="Surplus">Surplus</option>
        <option value="Systems Integration">Systems Integration</option>
        <option value="Technical Specifications">Technical Specifications</option>
        <option value="Virus/Spyware/Malware">Virus/Spyware/Malware</option>
        <option value="VMWARE">VMWARE</option>
        <option value="Website">Website</option>
        <option value="Wiki">Wiki</option>
        <option value="Workstation Setup">Workstation Setup</option>
        </select>  
      <label for="textfield"> Affected Level:</label>
      <labelc>
        <input type="radio" name="AffectedLevelRadio" value="Low" id="AffectedLevelRadio_0">
        Low</labelc>
      <labelc>
        <input type="radio" name="AffectedLevelRadio" value="Medium" id="AffectedLevelRadio_1">
        Meidum</labelc>
        <labelc>
        <input type="radio" name="AffectedLevelRadio" value="High" id="AffectedLevelRadio_2">
        High</labelc>
        <br><br>
        
      <label for="textfield"> Severity:</label>
      <labelc>
        <input type="radio" name="SeverityRadio" value="Low" id="SeverityRadio_0">
        Low</labelc>
      <labelc>
        <input type="radio" name="SeverityRadio" value="Medium" id="SeverityRadio_1">
        Meidum</labelc>
        <labelc>
        <input type="radio" name="SeverityRadio" value="High" id="SeverityRadio_2">
        High</labelc>      
        <br><br>
        
        <label for="textfield">Location:</label>
      	<input type="text" placeholder="Enter Room Number" name="location" id="location">
        <label for="select">Location:</label>
      <select name="select" id="select" size="1">
      	<option value="Select Location">Select Location</option>
     	<option value="\\file.ist.unomaha.edu\systems\software">\\file.ist.unomaha.edu\systems\software
        </option>
        <option value="00 - Atrium">00 - Atrium</option>
        <option value="100A">100A</option><option value="154D">154D</option>
        <option value="154D 154E 154F">154D 154E 154F</option>
        <option value="154E 154F 15fD">154E 154F 15fD</option>
        <option value="155">155</option><option value="157">157</option>
        <option value="158a">158a</option><option value="158b">158b</option><option value="158c">158c</option><option value="158g">158g</option><option value="158h">158h</option><option value="158k">158k</option><option value="158r">158r</option><option value="160">160</option><option value="161">161</option><option value="162">162</option><option value="164">164</option><option value="166">166</option><option value="168">168</option><option value="170">170</option><option value="170a">170a</option><option value="170b">170b</option><option value="172">172</option><option value="172a">172a</option><option value="172b">172b</option><option value="172c">172c</option><option value="172e">172e</option><option value="173a">173a</option><option value="173b">173b</option><option value="173c">173c</option><option value="173d">173d</option><option value="173e">173e</option><option value="173E">173E</option><option value="174a">174a</option><option value="174b">174b</option><option value="174c">174c</option><option value="174d">174d</option><option value="174e">174e</option><option value="174f">174f</option><option value="174g">174g</option><option value="174h">174h</option><option value="174i">174i</option><option value="175a">175a</option><option value="175b">175b</option><option value="175c">175c</option><option value="175d">175d</option><option value="175e">175e</option><option value="176b">176b</option><option value="176c">176c</option><option value="176d">176d</option><option value="176e">176e</option><option value="177a">177a</option><option value="177b">177b</option><option value="177c">177c</option><option value="177d">177d</option><option value="177e">177e</option><option value="193">193</option><option value="193a">193a</option><option value="193c">193c</option><option value="207">207</option><option value="217">217</option><option value="222">222</option><option value="222">222</option><option value="222">222</option><option value="241A">241A</option><option value="241a">241a</option><option value="242">242</option><option value="248">248</option><option value="253">253</option><option value="256">256</option><option value="257">257</option><option value="259">259</option><option value="260">260</option><option value="261">261</option><option value="263">263</option><option value="269">269</option><option value="270">270</option><option value="274">274</option><option value="275a">275a</option><option value="275b">275b</option><option value="275c">275c</option><option value="276">276</option><option value="277">277</option><option value="278">278</option><option value="279">279</option><option value="280">280</option><option value="280a">280a</option><option value="280b">280b</option><option value="280c">280c</option><option value="280d">280d</option><option value="281a">281a</option><option value="281b">281b</option><option value="281c">281c</option><option value="281d">281d</option><option value="281e">281e</option><option value="282a">282a</option><option value="282b">282b</option><option value="282C">282C</option><option value="282c">282c</option><option value="282d">282d</option><option value="282e">282e</option><option value="282f">282f</option><option value="282g">282g</option><option value="282h">282h</option><option value="282i">282i</option><option value="283a">283a</option><option value="283b">283b</option><option value="283c">283c</option><option value="283d">283d</option><option value="283e">283e</option><option value="284a">284a</option><option value="284b">284b</option><option value="284c">284c</option><option value="284d">284d</option><option value="284e">284e</option><option value="285a">285a</option><option value="285b">285b</option><option value="285e">285e</option><option value="286">286</option><option value="293">293</option><option value="293a">293a</option><option value="293c">293c</option><option value="301">301</option><option value="318">318</option><option value="320">320</option><option value="331">331</option><option value="335">335</option><option value="337">337</option><option value="350">350</option><option value="355">355</option><option value="356a">356a</option><option value="356b">356b</option><option value="357">357</option><option value="358">358</option><option value="360">360</option><option value="361">361</option><option value="362">362</option><option value="363a">363a</option><option value="364">364</option><option value="365">365</option><option value="366">366</option><option value="366a">366a</option><option value="367a">367a</option><option value="367b">367b</option><option value="369">369</option><option value="370">370</option><option value="373">373</option><option value="374">374</option><option value="375">375</option><option value="376">376</option><option value="377">377</option><option value="378">378</option><option value="383">383</option><option value="387">387</option><option value="389">389</option><option value="391">391</option><option value="393">393</option><option value="393a">393a</option><option value="393c">393c</option><option value="AH-514D">AH-514D</option><option value="ATTIC">ATTIC</option><option value="EAB013">EAB013</option><option value="Ehrling">Ehrling</option><option value="firefly">firefly</option><option value="Grand Island">Grand Island</option><option value="Kearney">Kearney</option><option value="Lab 222">Lab 222</option><option value="merritt">merritt</option><option value="Multiple Labs">Multiple Labs</option><option value="Norfolk">Norfolk</option><option value="North Platte">North Platte</option><option value="PKI Adobe VM for labs">PKI Adobe VM for labs</option>
        <option value="Scottsbluff">Scottsbluff</option></select>
        
      
</form>
</body>
</html>
