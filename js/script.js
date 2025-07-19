function verifyEmail() {
    const email = document.getElementById('verify-email').value;
    const msg = document.getElementById('verify-message');
    msg.innerText = 'Verifying...';

    const cacheKey = 'evg_verified_' + email;
    if (sessionStorage.getItem(cacheKey) === 'true') {
        msg.innerText = 'Already verified!';
        document.getElementById('verify-section').style.display = 'none';
        document.getElementById('protected-content').style.display = 'block';
        return;
    }

    fetch(evgData.ajax_url, {
        method: 'POST',
        headers: {'Content-Type': 'application/x-www-form-urlencoded'},
        body: 'action=check_email_purchase&email=' + encodeURIComponent(email) + '&nonce=' + evgData.nonce
    })
    .then(res => res.json())
    .then(data => {
        if (data.success) {
            msg.innerText = 'Purchase verified! Content unlocked.';
            sessionStorage.setItem(cacheKey, 'true');
            document.getElementById('verify-section').style.display = 'none';
            document.getElementById('protected-content').style.display = 'block';
        } else {
            msg.innerText = 'Sorry, no matching purchase found.';
        }
    });
}
