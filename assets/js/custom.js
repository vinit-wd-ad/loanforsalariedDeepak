
// EMI Calculator
const fmt = (n) => `₹${n.toLocaleString('en-IN')}`;

const amount = document.getElementById('amount');
const amountRange = document.getElementById('amountRange');
const rate = document.getElementById('rate');
const rateRange = document.getElementById('rateRange');
const days = document.getElementById('days');
const daysRange = document.getElementById('daysRange');

const loanOut = document.getElementById('loanOut');
const interestOut = document.getElementById('interestOut');
const totalOut = document.getElementById('totalOut');
const example = document.getElementById('example');

function calculate() {
    let P = parseFloat(amount.value);
    let R = parseFloat(rate.value);
    let D = parseInt(days.value);

    let interest = Math.round(P * (R / 100) * D);
    let total = P + interest;

    loanOut.textContent = fmt(P);
    interestOut.textContent = fmt(interest);
    totalOut.textContent = fmt(total);

    example.innerHTML = `*<span class="highlight">Representative Example:</span> If you are borrowing ${P}/- for ${D} days <br>
      Borrowing: Rs ${P.toLocaleString('en-IN')} + Interest: Rs ${interest.toLocaleString('en-IN')} = Total Payment: Rs ${total.toLocaleString('en-IN')}`;
}

function sync(a, b) {
    a.addEventListener('input', () => { b.value = a.value; calculate(); });
    b.addEventListener('input', () => { a.value = b.value; calculate(); });
}

sync(amount, amountRange);
sync(rate, rateRange);
sync(days, daysRange);

calculate();

// Contact form
$(document).ready(function () {
    $("#contactForm").on("submit", function (e) {
        e.preventDefault();

        let form = $(this);

        $.ajax({
            url: "/store-contact",
            type: "POST",
            data: form.serialize(),
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') // Laravel only
            },
            success: function (response) {
                if (response.status == 200) {
                    alert("Thank You for Applying");
                    location.reload();
                } else {
                    alert("Something went wrong");
                }
            }
        })
    })
})