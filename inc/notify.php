<div>
<center>
<textarea id="notifyMessage" style=" font-size:.6em; width:94%;resize:none;border-radius:0px;">HTML5 Realtime Push Notification</textarea><br />
</center>

<span style="font-size:.6em;">Send via : </span><br><select id="name" name="name" style="width:37%;">
  <option value="<?php echo $_SESSION['name_of_user']?>"><?php echo $_SESSION['name_of_user']?></option>
   <option value="Shift Manager">Shift Manager</option>
  <option value="Adjustments">Adjustments</option>
  <option value="Support">Support</option>
</select>


<select id="channel" name="channel" style="width:27%" >
  <option value="">Channel...</option>
  <option value="shared">Shared Agents</option>
  <option value="rosetta">Rosetta Agents</option>
  <option value="shift">Shift Manager</option>
  <option value="support">Tech Support</option>
  <option value="performance">Performance</option>
  <option value="traffic">Traffic</option>
  <option value="scripts">Scripts</option>
  <option value="control">Quality Control</option>
  <option value="payroll">Payroll</option>
  <option value="Management">Management</option>
  <option value="all">All</option>
</select>

<select id="method" name="method" style="width:27%;">
  <option value="">Method...</option>
  <option value="0">Notification</option>
  <option value="1">Stream</option>
  <option value="2">Both</option>
</select><br /> 

<button class="notify">Notify</button>
</div>