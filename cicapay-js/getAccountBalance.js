

// set api key, you can get it on cicapay.com
const apiKey = "xxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxx";

// set request mode
const mode = "live"; // test or live

// GET YOUR ACCOUNT BALANCE 
fetch(`https://api.cicapay.com/e_merchant_own/${mode}/check_balance/${apiKey}`, {
    method: "GET",
    headers: {
        "Content-Type": "application/x-www-form-urlencoded",
        // OR "Content-Type": "application/json",
    },
})
    .then((response) => response.json())
    .then((data) => {
        console.log("Success:", data);
    })
    .catch((error) => {
        console.error("Error:", error);
    });

