function copyEVFPShortcode() {
    const input = document.getElementById('evfp-shortcode');
    input.select();
    input.setSelectionRange(0, 99999);
    document.execCommand('copy');
    alert('Shortcode copied to clipboard!');
}
