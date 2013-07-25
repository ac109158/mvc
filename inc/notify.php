<div>
<span style="font-size:.6em;">Send via : </span><select id="name" name="name">
  <option value="<?php echo $_SESSION['name_of_user']?>"><?php echo $_SESSION['name_of_user']?></option>
   <option value="Shift Manager">Shift Manager</option>
  <option value="Adjustments">Adjustments</option>
  <option value="Support">Support</option>
</select><br />

<textarea id="notifyMessage" style="width:96%; margin:0px auto; resize:none;border-radius:5px;">HTML5 Realtime Push Notification</textarea><br />

<select id="channel" name="channel">
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

<select id="method" name="method">
  <option value="">Method...</option>
  <option value="0">Notification</option>
  <option value="1">Stream</option>
  <option value="2">Both</option>
</select>

<button class="notify">Notify</button>
</div>