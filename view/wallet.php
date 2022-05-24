<?php if (!defined("IN_WALLET")) {
  die("Auth Error!");
} ?>

<?php

if (!empty($info_pop)) {
  echo '<div class="pop-up ">
        <div class="auth-2fa-detials">
    ' . $info_pop['message'] . '<a href="/"><span class="close" title="Close">X</span></a></div></div>';
}
?>
<div class="container">

  <div class="panel panel-default">
    <div class="panel-body">
      <?php
      if (!empty($error)) {
        echo "<p style='font-weight: bold; color: red;text-align:center'>" . $error['message'];
        "</p>";
      }
      if (!empty($success)) {
        echo "<p style='font-weight: bold; color: green;text-align:center'>" . $success['message'];
        "</p>";
      }

      ?>


      <div class="row">
        <div class="col-sm-8">
          <p style="font-size:14px"><?php echo $lang['WALLET_HELLO']; ?>, <strong><?php echo $user_session; ?></strong>! <?php if ($admin) { ?><strong>
                <font color="green">[Admin]</font><?php } ?>
              </strong></p>
        </div>
      </div>



      <div class="ac-wallet mb30">

        <form class="ac-wallet_withdraw text-center clearfix" action="index.php" method="POST" id="withdrawform">
          <input type="hidden" name="action" value="withdraw" />
          <input type="hidden" name="token" value="<?php echo $_SESSION['token']; ?>">
          <h2 class="ac-h2">Withdraw <?= $short ?></h2>
          <h4 class="ac-h4"> Balance: <span class="account_balance"><?php echo satoshitize($balance); ?></span> <?= $short ?></h4>
          <div class="input-g mb35">
            <input type="text" class="input-i center" name="address" placeholder="Enter <?= $short ?> Address" />
          </div>
          <div class="input-g">
            <input type="text" class="input-i center" name="amount" placeholder="Enter Amount" />
          </div>
          <!-- <h4 class="ac-h4 text-left w-fee"> Fee: 0.0020000 <?= $short ?></h4> -->
          <button class="green-btn ml10 withdraw-btn">Withdraw</button>
          <p id="withdrawmsg" style="color: #098609;font-weight:400;font-size:18px;"></p>
        </form>

        <div class="ac-wallet_deposit text-center">
          <h2 class="ac-h2">Deposit <?= $short ?></h2>
          <h4 class="ac-h4"> Your <?= $short ?> Deposit Address </h4>

          <?php
          //show qr-code for deposit address
          if (sizeof($addressList) != 0) {
          ?>
            <div class="qr-code ">
              <img src="qrgen/?address=<?php echo   $addressList[0]; ?>" alt="QR Code" />
            </div>
          <?php } ?>

          <?php
          // show get address button, if no deposit address
          if (sizeof($addressList) === 0) {
          ?>
            <form action="index.php" method="POST" id="newaddressform">
              <input type="hidden" name="action" value="new_address" />
              <button type="submit" class="btn btn-default addr">Get Address</button>
            </form>
            <p id="newaddressmsg"></p>
          <?php     }        ?>


          <div class="flex-center input-g">
            <?php
            if (sizeof($addressList) != 0) {
            ?>
              <input type="text" class="input-i text-center" id="deposit-address" value="<?php echo $addressList[0]; ?>" placeholder="<?php echo $addressList[0]; ?>" />
              <span class="copy-addr">
                <svg width="43" height="45" viewBox="0 0 43 45" fill="none" xmlns="http://www.w3.org/2000/svg">
                  <rect x="0.5" y="0.5" width="42" height="44" rx="3.5" fill="white" stroke="#CAC7C7"></rect>
                  <path d="M26.4737 7.37491H13.2105C11.9947 7.37491 11 8.24738 11 9.31374V22.8855H13.2105V9.31374H26.4737V7.37491ZM25.3684 11.2526H17.6316C16.4158 11.2526 15.4321 12.125 15.4321 13.1914L15.4211 26.7632C15.4211 27.8296 16.4047 28.702 17.6205 28.702H29.7895C31.0053 28.702 32 27.8296 32 26.7632V17.0691L25.3684 11.2526ZM17.6316 26.7632V13.1914H24.2632V18.0385H29.7895V26.7632H17.6316Z" fill="black"></path>
                </svg>
              </span>

            <?php } ?>
          </div>

        </div>
      </div>

      <!-- history -->
      <div class="panel panel-default">
        <div class="panel-body">

          <p><?php echo $lang['WALLET_LAST10']; ?></p>
          <table class="table table-striped " id="txlist">
            <thead>
              <tr>
                <td><?php echo $lang['WALLET_DATE']; ?></td>
                <td><?php echo $lang['WALLET_ADDRESS']; ?></td>
                <td><?php echo $lang['WALLET_TYPE']; ?></td>
                <td><?php echo $lang['WALLET_AMOUNT']; ?></td>
                <td><?php echo $lang['WALLET_FEE']; ?></td>
                <td><?php echo $lang['WALLET_CONFS']; ?></td>
                <td><?php echo $lang['WALLET_INFO']; ?></td>
              </tr>
            </thead>
            <tbody>
              <?php
              $bold_txxs = "";
              foreach (array_reverse($transactionList) as $transaction) {
                if ($transaction['category'] == "send") {
                  $tx_type = '<span class="history-type withdraw">Withdraw</span>';
                } else {
                  $tx_type = '<span class="history-type deposit">Deposit</span>';
                  $transaction['fee'] = "";
                }
                echo '<tr>
                                         <td>' . date('n/j/Y h:i a', $transaction['time']) . '</td>
                                         <td>' . $transaction['address'] . '</td>
                                         <td>' . $tx_type . '</td>
                                         <td>' . abs($transaction['amount']) . '</td>
                                         <td>' . $transaction['fee'] . '</td>
                                         <td>' . $transaction['confirmations'] . '</td>
                                         <td><a href="' . $blockchain_tx_url,  $transaction['txid'] . '" target="_blank">Info</a></td>
                                      </tr>';
              }
              ?>
            </tbody>
          </table>

        </div>
      </div>

    </div>
  </div>
</div>





<div class="container">
  <div class="panel panel-default">
    <div class="panel-body">


      <form action="index.php" method="POST">

        <br />
        <?php
        if ($admin) {
        ?>
          <p><strong>Admin Links:</strong></p>
          <a href="?a=home" class="btn btn-success">Admin Dashboard</a>

          <br />
          <br />
          <p><strong><?php echo $lang['WALLET_USERLINKS']; ?></strong></p>
        <?php
        }
        ?>
        <!-- User Profile -->
        <div class="row">
          <div class="col-md-8">

            <form>
              <input type="hidden" name="action" value="logout" />
              <button type="submit" class="btn btn-danger"> </span> <?php echo $lang['WALLET_LOGOUT']; ?></button>
            </form>

            <form action="index.php" method="POST">
              <input type="hidden" name="action" value="support" action="index.php" />
              <button type="submit" class="btn btn-primary"><?php echo $lang['WALLET_SUPPORT']; ?></button>
            </form>

            <form action="index.php" method="POST">
              <input type="hidden" name="action" value="authgen" />
              <button type="submit" class="btn btn-success"><?php echo $lang['WALLET_2FAON']; ?></button>
            </form>

            <form action="index.php" method="post">
              <input type="hidden" name="action" value="disauth" />
              <button type="submit" class="btn btn-danger"><?php echo $lang['WALLET_2FAOFF']; ?></button>
            </form>

          </div>
          <br>
        </div>


        <div class="row">
          <div class="col-sm-12">
            <div class="panel panel-default">
              <div class="panel-body">
                <p><strong><?php echo $lang['WALLET_PASSUPDATE']; ?></strong></p>
                <form action="index.php" method="POST" class="clearfix" id="pwdform">
                  <input type="hidden" name="action" value="password" />
                  <input type="hidden" name="token" value="<?php echo $_SESSION['token']; ?>">



                  <div class="col-md-3"><input type="password" class="form-control" name="oldpassword" placeholder="<?php echo $lang['WALLET_PASSUPDATEOLD']; ?>"></div>
                  <div class="col-md-3"><input type="password" class="form-control" name="newpassword" placeholder="<?php echo $lang['WALLET_PASSUPDATENEW']; ?>"></div>
                  <div class="col-md-3"><input type="password" class="form-control" name="confirmpassword" placeholder="<?php echo $lang['WALLET_PASSUPDATENEWCONF']; ?>"></div>

                  <div class="col-md-3"><button type="submit" class="btn btn-success"><?php echo $lang['WALLET_PASSUPDATECONF']; ?></button></div>
                </form>

                <p style="text-align:center" id="pwdmsg"></p>


                <br />



              </div>


            </div>
          </div>

        </div> <!-- row dig ends-->

        <br />
        <p style="font-size:1em;"><?php echo $lang['WALLET_SUPPORTNOTE']; ?></p>
        <br />


    </div>
  </div>
</div>

<script type="text/javascript">
  var blockchain_tx_url = "<?= $blockchain_tx_url ?>";
  $("#withdrawform input[name='action']").first().attr("name", "jsaction");
  $("#newaddressform input[name='action']").first().attr("name", "jsaction");
  $("#pwdform input[name='action']").first().attr("name", "jsaction");
  $("#donate").click(function(e) {
    $("#donateinfo").show();
    $("#withdrawform input[name='address']").val("<?= $donation_address ?>");
    $("#withdrawform input[name='amount']").val("0.01");
  });
  $("#withdrawform").submit(function(e) {
    var postData = $(this).serializeArray();
    var formURL = $(this).attr("action");
    $.ajax({
      url: formURL,
      type: "POST",
      data: postData,
      success: function(data, textStatus, jqXHR) {
        var json = $.parseJSON(data);
        if (json.success) {
          $("#withdrawform input.input-i").val("");
          $("#withdrawmsg").text(json.message);
          $("#withdrawmsg").css("color", "green");
          $("#withdrawmsg").show();
          updateTables(json);
          refreshBalance(json['balance']);
        } else {
          $("#withdrawmsg").text(json.message);
          $("#withdrawmsg").css("color", "red");
          $("#withdrawmsg").show();
        }
        if (json.newtoken) {
          $('input[name="token"]').val(json.newtoken);
        }
      },
      error: function(jqXHR, textStatus, errorThrown) {
        //ugh, gtfo
      }
    });
    e.preventDefault();
  });

  $("#newaddressform").submit(function(e) {
    var postData = $(this).serializeArray();
    var formURL = $(this).attr("action");
    $.ajax({
      url: formURL,
      type: "POST",
      data: postData,
      success: function(data, textStatus, jqXHR) {
        var json = $.parseJSON(data);
        if (json.success) {
          $("#newaddressmsg").text(json.message);
          $("#newaddressmsg").css("color", "green");
          $("#newaddressmsg").show();
          updateTables(json);
        } else {
          $("#newaddressmsg").text(json.message);
          $("#newaddressmsg").css("color", "red");
          $("#newaddressmsg").show();
        }
        if (json.newtoken) {
          $('input[name="token"]').val(json.newtoken);
        }
      },
      error: function(jqXHR, textStatus, errorThrown) {
        //ugh, gtfo
      }
    });
    e.preventDefault();
    window.setTimeout(function() {
      location.href = "/";
    }, 3000);
  });
  $("#pwdform").submit(function(e) {
    var postData = $(this).serializeArray();
    var formURL = $(this).attr("action");
    $.ajax({
      url: formURL,
      type: "POST",
      data: postData,
      success: function(data, textStatus, jqXHR) {
        var json = $.parseJSON(data);
        if (json.success) {
          $("#pwdform input.form-control").val("");
          $("#pwdmsg").text(json.message);
          $("#pwdmsg").css("color", "green");
          $("#pwdmsg").show();
        } else {
          $("#pwdmsg").text(json.message);
          $("#pwdmsg").css("color", "red");
          $("#pwdmsg").show();
        }
        if (json.newtoken) {
          $('input[name="token"]').val(json.newtoken);
        }
      },
      error: function(jqXHR, textStatus, errorThrown) {
        //ugh, gtfo
      }
    });
    e.preventDefault();
  });

  function updateTables(json) {
    json.transactionList.reverse();
    $("#balance").text(json.balance.toFixed(8));
    $("#alist tbody tr").remove();
    for (var i = json.addressList.length - 1; i >= 0; i--) {
      $("#alist tbody").prepend("<tr><td>" + json.addressList[i] + "</td></tr>");
    }
    $("#txlist tbody tr").remove();
    for (var i = json.transactionList.length - 1; i >= 0; i--) {
      var tx_type = '<b class="history-type deposit">Deposit</b>';

      if (json.transactionList[i]['category'] == "send") {
        tx_type = '<b class="history-type withdraw">Withdraw</b>';
      }
      $("#txlist tbody").prepend('<tr> \
               <td>' + moment(json.transactionList[i]['time'], "X").format('l hh:mm a') + '</td> \
               <td>' + json.transactionList[i]['address'] + '</td> \
               <td>' + tx_type + '</td> \
               <td>' + Math.abs(json.transactionList[i]['amount']) + '</td> \
               <td>' + ((json.transactionList[i]['fee'] != undefined) ? json.transactionList[i]['fee'] : "") + '</td> \
               <td>' + json.transactionList[i]['confirmations'] + '</td> \
               <td><a href="' + blockchain_tx_url.replace("%s", json.transactionList[i]['txid']) + '" target="_blank">Info</a></td> \
            </tr>');
    }
  }

  //refresh balance
  function refreshBalance(balance) {
    let acc_balance = document.getElementsByClassName("account_balance");
    acc_balance[0].innerHTML = balance;
  }
  // copy deposit address to clipboard
  const copyText = document.querySelector(".copy-addr");
  copyText.addEventListener("click", () => {
    let input = document.querySelector("#deposit-address");
    input.select();
    document.execCommand("copy");
    window.getSelection().removeAllRanges();
    //remove add
    copyText.classList.add("active");
    //remove alert
    setTimeout(function() {
      copyText.classList.remove("active");
    }, 2000);
  });
</script>