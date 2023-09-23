
// set api key, you can get it on cicapay.com
const apiKey = "xxxxxxxxxxxxxxxxxxxxxxxx";

// set request mode
const mode = "live"; // test or live

// SEND PAY IN PRO REQUEST 

var data = {
    "amount": 550000,
    "currency1": "EUR",
    "currency2": "bcoin",
    "buyer_email": "example@gmail.com",
    "description": "Achat de matériels",
};

fetch(`https://api.cicapay.com/e_merchant_crypto/${mode}/pay_in/${apiKey}`, {
    method: "POST",
    headers: {
        "Content-Type": "application/x-www-form-urlencoded",
        // OR "Content-Type": "application/json",
    },
    body: JSON.stringify(data),
})
    .then((response) => response.json())
    .then((data) => {
        console.log("Success:", data);
    })
    .catch((error) => {
        console.error("Error:", error);
    });
