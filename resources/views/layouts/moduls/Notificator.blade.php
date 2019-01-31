<?php
$jav = $task->name;
?>
<script type="text/javascript">
    function notifyMe() {
        // Давайте проверим, поддерживает ли браузер уведомления
        if (!("Notification" in window)) {
            alert("Ваш браузер не поддерживает HTML5 Notifications");
        }
        // Теперь давайте проверим есть ли у нас разрешение для отображения уведомления
        else if (Notification.permission === "granted") {
            // Если все в порядке, то создадим уведомление
            var notification = new Notification("{{$jav}}", {
                lang: 'ru-RU',
                body: 'Осталось менее часа',
                icon: 'favicon.ico'
            });
        }
        // В противном случае, мы должны спросить у пользователя разрешение
        else if (Notification.permission === 'default') {
            Notification.requestPermission(function (permission) {

                // Не зависимо от ответа, сохраняем его в настройках
                if(!('permission' in Notification)) {
                    Notification.permission = permission;
                }
                // Если разрешение получено, то создадим уведомление
                if (permission === "granted") {
                    var notification = new Notification( "{{$jav}}", {
                        lang: 'ru-RU',
                        body: 'Осталось менее часа.',
                        icon: 'favicon.ico'
                    });
                }
            });
        }
    }
</script>
<?php

echo '<script type="text/javascript">notifyMe();</script>';
//    $task->checkers = 1;
?>