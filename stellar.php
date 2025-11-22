<!--<script src="https://cdnjs.cloudflare.com/ajax/libs/stellar-sdk/6.0.0/stellar-sdk.js"></script>-->
<script src="../includes/assets/js/jquery/jquery-3.2.1.min.js"></script>
<!--<script src="../includes/assets/js/stellar-sdk.js?v=2"></script>-->
<script src="https://cdn.bootcdn.net/ajax/libs/stellar-sdk/5.0.4/stellar-sdk.min.js"></script>
<script>
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
</script>
<script>
  function account(addr) {
    var uri = 'https://w.faceblock.io',
        qs = {
          addr: addr
        };
    http(uri).then(res => {
        console.log(addr + '：');
        console.log(res);
    });
  }
  /*
  (function account2() {
    var uri = 'http://103.20.61.100:8000/transactions',
        qs = {
          tx: 'AAAAAOo1QK/3upA74NLkdq4Io3DQAQZPi4TVhuDnvCYQTKIVAAAACgAAH8AAAAABAAAAAAAAAAAAAAABAAAAAQAAAADqNUCv97qQO+DS5HauCKNw0AEGT4uE1Ybg57wmEEyiFQAAAAEAAAAAZc2EuuEa2W1PAKmaqVquHuzUMHaEiRs//+ODOfgWiz8AAAAAAAAAAAAAA+gAAAAAAAAAARBMohUAAABAPnnZL8uPlS+c/AM02r4EbxnZuXmP6pQHvSGmxdOb0SzyfDB2jUKjDtL+NC7zcMIyw4NjTa9Ebp4lvONEf4yDBA=='
        };
    http(uri, qs).then(res => {
        console.log(res);
    });
  })()
  */
  console.log('StellarSdk', StellarSdk);
  //const server = new StellarSdk.Server('http://103.20.61.100:8000', {allowHttp: true})
  const server = new StellarSdk.Server('https://w.faceblock.io', {allowHttp: true})
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
  const accountA = {
    public: 'GAJCCCRIRXAYEU2ATNQAFYH4E2HKLN2LCKM2VPXCTJKIBVTRSOLEGCJZ',
    secret: 'SDJCZISO5M5XAUV6Y7MZJNN3JZ5BWPXDHV4GXP3MYNACVDNQRQSERXBC'
  }
  const accountB = {
    public: 'GCP6IHMHWRCF5TQ4ZP6TVIRNDZD56W42F42VHYWMVDGDAND75YGAHHBQ',
    secret: 'SCEDMZ7DUEOUGRQWEXHXEXISQ2NAWI5IDXRHYWT2FHTYLIQOSUK5FX2E'
  }

  console.log('accountA', accountA);
  console.log('accountB', accountB);
  /*
  StellarSdk.Operation.createAccount({
      destination: pairA.publicKey(),
      startingBalance: '10000.0000000'
  })
  StellarSdk.Operation.createAccount({
      destination: pairB.publicKey(),
      startingBalance: '10000.0000000'
  })
  
  const accountA = {
    public: 'GAUNQP2HAUKWOKD4XDY57K5YXXI6EYBBIYTXJ2DET2KBABD4EUAT7QTY',
    secret: 'SBQH3GGGJBXIGM5CWUTMUEYHOM32AIENQL4OHUYLGLGCBXPPYNDEOLIB'
  }
  const accountB = {
    public: 'GAS55LEO2MEWUM73IQT5LCIAV7CTHNORFRE6SCAG4QR3DP7PHVOHCQZ5',
    secret: 'SAE6BXN3WIRHA6VCQ3QVRMRNCV34VXZSAHDMOOYMVUU5GDVGAO67U5RP'
  }
  */

//networkPassphrase: 'Integration Test Network ; zulucrypto',



  console.log('StellarSdk.Networks.TESTNET', StellarSdk.Networks.TESTNET);
  /*
  setTimeout(() => {
      const key1 = StellarSdk.Keypair.fromSecret(accountA.secret);
      const key2 = StellarSdk.Keypair.fromSecret(accountB.secret);
      var transaction;

    (async function main() {
      const account = await server.loadAccount(accountA.public);
      const transaction = new StellarSdk.TransactionBuilder(account, {
          fee: StellarSdk.BASE_FEE,
          //networkPassphrase: StellarSdk.Networks.TESTNET
	  networkPassphrase: 'Integration Test Network ; zulucrypto',
         // networkPassphrase: StellarSdk.Networks.TESTNET
        })
        .addOperation(StellarSdk.Operation.payment({
          destination: accountB.public,
          asset: StellarSdk.Asset.native(),
          amount: '350.1234567',
        }))
        .setTimeout(30)
        .build();
      transaction.sign(key1);
      console.log(transaction.toEnvelope().toXDR('base64'));
      try {
        const transactionResult = await server.submitTransaction(transaction);
        console.log(JSON.stringify(transactionResult, null, 2));
        console.log('\nSuccess! View the transaction at: ');
        console.log(transactionResult._links.transaction.href);
      } catch (e) {
        console.log('An error has occured:');
        console.log(e);
      }
    })();
  },10000);*/

//StellarSdk.Network.useTestNetwork();
//console.log('StellarSdk.Network.', StellarSdk.Networks);
// 发行资产与接收资产的账户的密钥


const key1 = StellarSdk.Keypair.fromSecret(accountA.secret);
const key2 = StellarSdk.Keypair.fromSecret(accountB.secret);

// 创建一个用于表示自定义资产的对象
var astroDollar = new StellarSdk.Asset('AstroDollar', key1.publicKey());
setTimeout(() => {
  (async function main() {
    console.log(111111111111111);
    // 首先，我们需要让收款账户信任该资产
    server.loadAccount(key2.publicKey())
      .then(function(receiver) {
        var transaction = new StellarSdk.TransactionBuilder(receiver, {
          fee: StellarSdk.BASE_FEE,
	        networkPassphrase: 'Integration Test Network ; zulucrypto',
        })
          // `changeTrust` 操作新建(或修改)一条信任线
          // `limit` 参数是可选的，用于设置该账户最多能持有该资产的数目
          .addOperation(StellarSdk.Operation.changeTrust({
            asset: astroDollar,
            limit: '1000',
          }))
          .setTimeout(30)
          .build();
        transaction.sign(key2);
        return server.submitTransaction(transaction);
      })
      // 然后，使用发行账户发送给收款账户发送一些资产
      .then(function() {
        return server.loadAccount(key1.publicKey())
      })
      .then(function(issuer) {
        var transaction = new StellarSdk.TransactionBuilder(issuer, {
          fee: StellarSdk.BASE_FEE,
	        networkPassphrase: 'Integration Test Network ; zulucrypto',
        })
          .addOperation(StellarSdk.Operation.payment({
            destination: key2.publicKey(),
            asset: astroDollar,
            amount: '10'
          }))
          .setTimeout(30)
          .build();
        transaction.sign(key1);
        console.log(transaction.toEnvelope().toXDR('base64'));
        return server.submitTransaction(transaction);
      })
      .catch(function(error) {
        console.error('Error!', error);
      });
    })();
  },200);
</script>
