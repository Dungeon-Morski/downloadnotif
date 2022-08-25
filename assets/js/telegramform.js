$('.notification').submit( function(event) {
    // Отмена обычного поведения
    event.preventDefault();

    // Клик по скрытой ссылки загрузки (для закачки без перезагрузки страницы или открытия других окон)
    event.target.querySelector('.download-link').click();

    // Получение имени нажатой кнопки
    let inputButton = event.originalEvent.submitter;

    // Отправка имени на страницу оброботки
    $.ajax({
        type: 'POST',
        url: 'send-message-to-telegram.php',
        dataType: 'json',
        data: {
            "name": inputButton.name
        }
    });
});