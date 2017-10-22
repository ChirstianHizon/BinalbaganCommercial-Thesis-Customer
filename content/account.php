<link href="css/account.css" rel="stylesheet">
<br />
<br />

<div class="container">

  <div class="separator">
    <h4 class="title-sep">Orders Made</h4>
    <br/>
    <div id="table">
      <table id="order_id" class="table sortable-markers-on-left cell-hovered border bordered" width="100%" cellspacing="0">
        <thead>
            <tr>
                <!-- <th>Order ID</th> -->
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
    <br />
    <br />
    <br />
    <h4 style="display:none;">Total Orders Made: <b id="order-total">0</b></h4>
  </div>
  <br/>
  <br/>



  <div class="separator">




    <div class="section group">

      <div class="section group">
        <div class="col span_1_of_3">

        </div>
        <div id="userdetails" class="col span_1_of_3">
          Account Details <br /><br />
          <!-- <div id="image-container">
            <div id="image">
              <img src="images/iphone.jpg" width="200px" height="200px"/>
              <input id="imageselector" class="imageselector" type="file" alt="Choose Product Image" onchange="getimage(event)" ><br>
            </div>

          </div><br /> -->

          Username: <br />
          <div class="input-control text">
            <input id="uname" type="text" placeholder="Username" value="<?php echo $_SESSION['custname']; ?>" disabled/>
          </div>

          First Name:<br  />
          <div class="input-control text">
            <input id="ufname" type="text" placeholder="First Name" pattern="^(?=.*[a-zA-Z]).+$" minlength="2" maxlength="20" value="<?php echo $_SESSION['custfname']; ?>" disabled/>
          </div>

          Last Name:<br  />
          <div class="input-control text">
            <input id="ulname" type="text" placeholder="Last Name" pattern="^(?=.*[a-zA-Z]).+$" minlength="2" maxlength="20" value="<?php echo $_SESSION['custlname']; ?>" disabled/>
          </div>

          Contact:<br  />
          <div class="input-control text">
            <input id="ucontact" type="text" placeholder="Contact Number" maxlength="11" minlength="11" min="1" max="99999999999" pattern="^(09|\+639)\d{9}$" disabled/>
          </div>

          Address<br/>
          <div class="input-control textarea">
            <textarea id="uaddress" rows="5" placeholder="Address" disabled ></textarea>
          </div>
          <button id="editprofile"> Edit Profile</button>
          <button id="cancel">Cancel</button>
          <button id="changepass">Change Password</button>
        </div>
        <div class="col span_1_of_3">

        </div>
      </div>

      <!-- COLUMN 1 -->
    	<div  class="col span_1_of_2">

    	</div>


      <!-- COLUMN 2 -->
      <div id="mapandpic" class="col span_1_of_2" style="display:none;width:0px;">

    	Address:<br />
      <b>Set your Address by Clicking anywhere on the Map</b><br />
      <div id="customer_map" class="map"></div>

    	</div>
    </div>

  </div>
  <br />
  <br />
</div>

<!-- Footer -->
<footer>
      <!-- Copyright etc -->
      <div class="small-print">
        <div class="container">
          <!-- <p><a href="#">Terms &amp; Conditions</a> | <a href="#">Privacy Policy</a> | <a href="#">Contact</a></p> -->
          <p>Copyright &copy; BinalbaganCommercial.com 2017 </p>
        </div>
      </div>

</footer>


<div id="order-modal" class="modal">
  <!-- Modal content -->
  <div class="modal-content">
    <span onclick="closeModal()" class="close">&times;</span>
    <div class="modal-header">

      <h2>Order</h2>
    </div>
    <div class="modal-body">
      <b id="cart-status"></b>
      <span>Order No: <b><span id="orderid"></span></b></span>
      <br />
      <span>Status: <b><span id="status"></span></b></span>
      <br />
      <table id="status_id" class="table cell-hovered border bordered" width="100%" cellspacing="0">
        <thead>
            <tr>
                <th>Product</th>
                <th>Quantity</th>
                <th>Subtotal</th>
            </tr>
        </thead>
        <tbody id="status-body">
        </tbody>
      </table>
      <br/>
      <br/>
      <br/>
      <span>Message:</span>
      <br  />
      <h6 style="color:black"><span id="message">
      </span></h6>
      <br />
      <br/>
      <br/>
      Total Amount:<b id="status-total"></b>
      <br/>
    </div>
    <!-- <div class = "modal-footer">
      <!-- <button id="checkout" onclick="openTypePicker()" class="button success"> Checkout </button> -->
    </div> -->
  </div>
</div>

<script src="js/jquery-1.11.3.min.js"></script>
<script src="js/bootstrap.min.js"></script>
<script src="js/ie10-viewport-bug-workaround.js"></script>

<script src="api\ResizeSensor\ElementQueries.js"></script>
<script src="api\ResizeSensor\ResizeSensor.js"></script>

<script src="js/account.js"></script>

<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyC5_KfF9P5eQzcC_fO4VWdgoumYFv7vAQg&callback=initializeMap"async defer></script>
