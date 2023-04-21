

// set api key, you can get it on cicapay.com
const apiKey = "xxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxx";

// set request mode
const mode = "live"; // test or live


// GET TRANSACTION INFO

var transaction_id = "BP64241A8741CC9";

fetch(`https://cicapay.com/e_merchant_own/${mode}/get_transaction_info/${apiKey}/${transaction_id}`, {
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

