<html>
<body>
<p>Pesanan {{ $pesanan->pesanan_id }} sebesar {{ $pesanan->nominal }}</p>
<button type="button" id="pay-button">PAY</button>
</body>
<script src="https://app.sandbox.midtrans.com/snap/snap.js"
data-client-key="{{ env('MIDTRANS_CLIENT_KEY') }}">
</script>
<script>
const payButton = document.querySelector('#pay-button');
payButton.addEventListener('click', function(e) {

e.preventDefault();
snap.pay('{{ $pesanan->token }}', {
// Optional
onSuccess: function(result) {
/* You may add your own js here, this is just example */
console.log(result)
},
// Optional
onPending: function(result) {
/* You may add your own js here, this is just example */
console.log(result)
},
// Optional
onError: function(result) {
/* You may add your own js here, this is just example */
console.log(result)
}
});
});
</script>
</html>