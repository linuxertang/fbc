<script src="https://cdnjs.cloudflare.com/ajax/libs/stellar-sdk/6.2.0/stellar-sdk.js"></script>
<!--script src="../includes/assets/js/jquery/jquery-3.2.1.min.js"></script>-->
<!--<script src="../includes/assets/js/stellar-sdk.js?v=2"></script>-->


<!--<script>
  function http(u, d = '', s = 'json') {
      var m = d ? 'POST' : 'GET';
      return new Promise(function(resolve, reject) {
          $.ajax({
              method: m,
              dataType: s,
              async: true,//使用同步的方式,true为异步方式
              url: u,
              data: d,
              success: function(res, xhr) {
                  resolve(res);
              }
          })
      })
  }
</script> -->
<script>
//  var StellarSdk = require("stellar-sdk");
  const server = new StellarSdk.Server('http://113.52.135.201:8000', {allowHttp: true})
  //const server = new StellarSdk.Server('http://113.52.135.201:8000')
/*
  function account(addr) {
    var uri = 'http://113.52.135.201:8004',
        qs = {
          addr: addr
        };
    http(uri, qs).then(res => {
        console.log(addr + '成功发放');
    });
  }
  console.log('StellarSdk', StellarSdk);
  const server = new StellarSdk.Server('http://113.52.135.201:8000', {allowHttp: true})
*/
/*
  let pairA = StellarSdk.Keypair.random()
  let pairB = StellarSdk.Keypair.random()
  console.log(pairA.publicKey(),pairA.secret())
  console.log(pairB.publicKey(),pairB.secret())
  account(pairA.publicKey());
  account(pairB.publicKey());

  const accountA = {
    public: pairA.publicKey(),
    secret: pairA.secret()
  }
  const accountB = {
    public: pairB.publicKey(),
    secret: pairB.secret()
  }
*/
  /*
  const accountA = {
    public: 'GAF6THQPK3CO3A372MDCQPZ6ACLJYJR3BMM7GZKEVSFYCXKXOWFHHFXD',
    secret: 'SDMVZBJM4SUCF7ON3J5QURANCZC242AMDGZDZBV2YQV3LEEHEMZVZT77'
  }
  const accountB = {
    public: 'GDW2RB5ELTZ3VC46OFKPV2J4PU245KGXFFEPTSXUMAQSHFXTOOLQKAWY',
    secret: 'SCGFNSKLX2FFERL2MGEYWHHR5RVTIDFJBGOPVBMXAASF4GV6IDRNMYKD'
  }
  */



//var StellarSdk = require("stellar-sdk");
var sourceKeys = StellarSdk.Keypair.fromSecret(
  "SDJCZISO5M5XAUV6Y7MZJNN3JZ5BWPXDHV4GXP3MYNACVDNQRQSERXBC",
);
var destinationId = "GCP6IHMHWRCF5TQ4ZP6TVIRNDZD56W42F42VHYWMVDGDAND75YGAHHBQ";
// Transaction will hold a built transaction we can resubmit if the result is unknown.
var transaction;

// First, check to make sure that the destination account exists.
// You could skip this, but if the account does not exist, you will be charged
// the transaction fee when the transaction fails.
server
  .loadAccount(destinationId)
  // If the account is not found, surface a nicer error message for logging.
  .catch(function (error) {
    if (error instanceof StellarSdk.NotFoundError) {
      throw new Error("The destination account does not exist!");
    } else return error;
  })
  // If there was no error, load up-to-date information on your account.
  .then(function () {
    return server.loadAccount(sourceKeys.publicKey());
  })
  .then(function (sourceAccount) {
    // Start building the transaction.
    transaction = new StellarSdk.TransactionBuilder(sourceAccount, {
      fee: StellarSdk.BASE_FEE,
      networkPassphrase: StellarSdk.Networks.TESTNET,
    })
      .addOperation(
        StellarSdk.Operation.payment({
          destination: destinationId,
          // Because Stellar allows transaction in many currencies, you must
          // specify the asset type. The special "native" asset represents Lumens.
          asset: StellarSdk.Asset.native(),
          amount: "10",
        }),
      )
      // A memo allows you to add your own metadata to a transaction. It's
      // optional and does not affect how Stellar treats the transaction.
      .addMemo(StellarSdk.Memo.text("Test Transaction"))
      // Wait a maximum of three minutes for the transaction
      .setTimeout(180)
      .build();
    // Sign the transaction to prove you are actually the person sending it.
    transaction.sign(sourceKeys);
    // And finally, send it off to Stellar!
    return server.submitTransaction(transaction);
  })
  .then(function (result) {
    console.log("Success! Results:", result);
  })
  .catch(function (error) {
    console.error("Something went wrong!", error);
    // If the result is unknown (no response body, timeout etc.) we simply resubmit
    // already built transaction:
    server.submitTransaction(transaction);
  });
/*
  setTimeout(() => {
    var account = new StellarSdk.Account(
    accountA.public,
    '12884901898'
    )
    var transaction = new StellarSdk.TransactionBuilder(account, {
      fee: StellarSdk.BASE_FEE,
      networkPassphrase: StellarSdk.Networks.TESTNET
    })
      .addOperation(
        StellarSdk.Operation.payment({
          destination: accountB.public,
          asset: StellarSdk.Asset.native(),
          amount: "100.5000001"  // 100.50 XLM
        })
      )
      .setTimeout(30)
      .build();
    console.log(accountA.secret)
    var key1 = StellarSdk.Keypair.fromSecret(accountA.secret);
    var key2 = StellarSdk.Keypair.fromSecret(accountB.secret);
    console.log('key1',key1);
    transaction.sign(key1)
    transaction.sign(pairB)
    server.submitTransaction(transaction)
      .then(res =>{
        console.log(res)
      })
      .catch(res=>{
        console.log(res)
      })	
        
  },8000);
*/

</script>
