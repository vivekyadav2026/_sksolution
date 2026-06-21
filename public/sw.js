self.addEventListener('push', function (e) {
    if (!(self.Notification && self.Notification.permission === 'granted')) {
        //notifications aren't supported or permission not granted!
        return;
    }

    if (e.data) {
        var msg = e.data.json();
        console.log("Push event received: ", msg);
        e.waitUntil(self.registration.showNotification(msg.title, {
            body: msg.body,
            icon: msg.icon,
            actions: msg.actions
        }).catch(err => console.error("Error showing notification:", err)));
    }
});

self.addEventListener('notificationclick', function(e) {
    var notification = e.notification;
    var action = e.action;
    var actionUrl = null;
    
    if (action === 'close') {
        notification.close();
        return;
    } 

    if (notification.actions && notification.actions.length > 0) {
        notification.actions.forEach(function(act) {
            if(act.action === action) {
                actionUrl = act.actionUrl || act.url;
            }
        });
    }

    if (!actionUrl) {
        // Default URL if no specific action clicked
        actionUrl = '/'; 
    }

    notification.close();
    
    e.waitUntil(
        clients.matchAll({ type: 'window' }).then(windowClients => {
            for (var i = 0; i < windowClients.length; i++) {
                var client = windowClients[i];
                if (client.url === actionUrl && 'focus' in client) {
                    return client.focus();
                }
            }
            if (clients.openWindow) {
                return clients.openWindow(actionUrl);
            }
        })
    );
});
