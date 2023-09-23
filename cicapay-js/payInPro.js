
// set api key, you can get it on cicapay.com
const apiKey = "xxxxxxxxxxxxxxxxxxxxxxxx";

// set request mode
const mode = "live"; // test or live

// SEND PAY IN PRO REQUEST 

var order = [
    {
        'name': 'Pneu',
        'unit_price': 100,
        'quantity': 10
    },
    {
        'name': 'Par brise',
        'unit_price': 1000,
        'quantity': 25
    },
    {
        'name': 'Volant',
        'unit_price': 160,
        'quantity': 29
    }
]
var data = {
    "mobile_money_number": "65000000",
    "description": "Achat de matériels",
    "first_name": "Cica",
    "last_name": "He",
    "email": "example@gmail.com",
    "customer_company": "HOCI SARL",
    "network": "moov_bj",
    "order": order
};

fetch(`https://api.cicapay.com/e_merchant_own/${mode}/pay_in/${apiKey}`, {
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
