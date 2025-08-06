function verifyEmail() {
    const email = document.getElementById('verify-email').value;
    const msg = document.getElementById('verify-message');
    msg.innerText = 'Verifying...';

    fetch(evfpData.ajax_url, {
        method: 'POST',
        headers: {'Content-Type': 'application/x-www-form-urlencoded'},
        body: 'action=check_email_purchase&email=' + encodeURIComponent(email) + '&nonce=' + evfpData.nonce
    })
    .then(res => res.json())
    .then(data => {
        if (data.success) {
            msg.innerText = 'Purchase verified! Content unlocked.';
            // Set a cookie to persist verification (secure alternative to sessionStorage)
            document.cookie = "evfp_verified=true; path=/; max-age=86400"; // 1-day cookie
            location.reload(); // Reload to trigger server-side rendering of protected content
        } else {
            msg.innerText = 'Sorry, no matching purchase found.';
        }
    });
}
