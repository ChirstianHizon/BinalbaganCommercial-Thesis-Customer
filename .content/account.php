<link href="css/account.css" rel="stylesheet">
<br />
<br />

<div class="container">

  <div class="separator">
    <h4 class="title-sep">Orders Made</h4>
    <br/>
    <div id="table">
      <table id="order_id" class="display" width="100%" cellspacing="0">
        <thead>
            <tr>
                <th>Order ID</th>
                <th>Order Date</th>
                <th>Quantity</th>
                <th>Total</th>
                <th>Status</th>
                <th>Type</th>
                <th></th>
            </tr>
        </thead>
        <tbody id="order-body">
        </tbody>
      </table>
    </div>
    <h4>Total Orders Made: <b id="order-total">0</b></h4>
  </div>
  <br/>
  <br/>
  <div class="separator">


    <div class="section group">
      <!-- COLUMN 1 -->
    	<div id="userdetails" class="col span_1_of_2">
        Account Details <br />
        <div id="image-container">
          <div id="image">
            <img src="images/iphone.jpg" width="200px" height="200px"/>
            <input id="imageselector" class="imageselector" type="file" alt="Choose Product Image" onchange="getimage(event)" ><br>
          </div>
        </div><br />
        Username: <br />
        <input id="uname" type="text" placeholder="Username" value="<?php echo $_SESSION['custname']; ?>" disabled/>
        First Name:<br  />
        <input id="ufname" type="text" placeholder="First Name" value="<?php echo $_SESSION['custfname']; ?>" disabled/>
        Last Name:<br  />
        <input id="ulname" type="text" placeholder="Last Name" value="<?php echo $_SESSION['custlname']; ?>" disabled/>
        Contact:<br  />
        <input id="ucontact" type="number" placeholder="Contact Number" min="0" disabled/>
        Address<br/>
        <textarea id="uaddress" rows="5" placeholder="Address" disabled ></textarea>
        <button id="editprofile"> Edit Profile</button>
        <button id="cancel">Cancel</button>
        <button id="changepass">Change Password</button>
    	</div>


      <!-- COLUMN 2 -->
      <div id="mapandpic" class="col span_1_of_2">
    	Address:<br />
      <b>Set your Address by Clicking anywhere on the Map</b><br />
      <div id="customer_map" class="map"></div>
    	</div>
    </div>

  </div>
  <br />
  <br />
</div>

<script src="js/jquery-1.11.3.min.js"></script>
<script src="js/bootstrap.min.js"></script>
<script src="js/ie10-viewport-bug-workaround.js"></script>

<script src="api\ResizeSensor\ElementQueries.js"></script>
<script src="api\ResizeSensor\ResizeSensor.js"></script>

<script src="js/account.js"></script>

<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyC5_KfF9P5eQzcC_fO4VWdgoumYFv7vAQg&callback=initializeMap"async defer></script>
