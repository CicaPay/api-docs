

// set api key, you can get it on bpay.bryocorp.com
const apiKey = "xxxxxxxxxxxxxxxxxxxxxxxxxxxxxx";

// set request mode
const mode = "live"; // test or live


// GET TRANSACTION STATUS
fetch(`https://bpay.bryocorp.com/e_merchant_own/${mode}/check_transaction_status/${apiKey}/${transaction_id}`, {
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
