userVision = {
    'events' : []
};

// Creates the time of the event, compatible with the database
function getTime() {
    return new Date().toISOString().slice(0, 19).replace('T', ' ');
}

// Use for creating a selector for the element interacted with
function getCSSSelector(el){
    let selector = el.tagName.toLowerCase();
    const attrs = el.attributes
    for (var i = 0; i < attrs.length; i++) {
        let attr = attrs.item(i)
        if (attr.name === 'id') selector += `#${attr.value}`;
        if (attr.name === 'class') selector += attr.value.split(' ').map((c) => `.${c}`).join('');
        if (attr.name === 'name') selector += `[${attr.name}=${attr.value}]`;
    }
    return selector
}

function log(e) {
    console.log(e);
    var event = {
        'type': e.type,
        'time': getTime(),
        'selector': getCSSSelector(e.target),
        'x': e.screenX,
        'y': e.screenY
    }

    userVision.events.push(event);
}
 
document.body.addEventListener("click", log);

document.addEventListener('visibilitychange', function logData() {
    if (document.visibilityState === 'hidden') {
        console.log('Saving session..');

        var data = JSON.stringify(userVision.events)

        var isLoggedSuccessful = navigator.sendBeacon('/save.php', data);

        if (isLoggedSuccessful) {
            // Delete the events
            userVision.events = [];
        }
    }
});