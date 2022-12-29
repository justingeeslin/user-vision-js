function log(e) {
    console.log('Click', e);
}
 
document.body.addEventListener("click", log);

document.addEventListener('visibilitychange', function logData() {
    if (document.visibilityState === 'hidden') {
        console.log('Saving session..');
        analyticsData = {};
        navigator.sendBeacon('/save.php', analyticsData);
    }
});