self.addEventListener("push", (event) => {
    const notification = event.data.json();

    event.waitUntil(
        self.registration.showNotification(notification.title, {
            body: notification.body,
            icon: "./images/no_image.jpeg",
            data: {
                url: notification.url
            }
        })
    )
}); // listen for notifaction


self.addEventListener("notificationclick", (event) => {
    event.waitUntil(
        clients.openWindow(event.notification.data.url)
    )
})//lisen to click