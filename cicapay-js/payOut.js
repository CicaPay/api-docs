
// set api key, you can get it on cicapay.com
const apiKey = "xxxxxxxxxxxxxxxxxxxxxxxxxxx";

// set request mode
const mode = "live"; // test or live


// SEND PAY OUT REQUEST

const data =
{
    "mobile_money_number": 65000000,
    "amount": 500000,
    "first_name": "yves",
    "last_name": "Hhhhhhh",
    "email": "example@proton.com",
    "network": "moov_bj"
};

fetch(`https://api.cicapay.com/e_merchant_own/${mode}/pay_out/${apiKey}`, {
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
