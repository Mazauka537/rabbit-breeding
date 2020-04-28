<div>
    <h2>Здравствуйте!</h2>

    <p>Вы получили это письмо, потому что мы получили запрос на сброс пароля для вашей учетной записи.</p>

    <p>
        <a href="{{ url(config('app.url').route('password.reset', ['token' => $token, 'email' => $email], false)) }}" style="padding: 10px 15px; background:dodgerblue; color: #fff; border-radius: 5px; text-decoration: none;">
            Сбросить пароль
        </a>
    </p>

    <p>Действие этой ссылки для сброса пароля истечет через 60 минут.</p>

    <p>Если вы не запрашивали сброс пароля, то никаких дальнейших действий не требуется.</p>

    <p>С Уважением, сайт {{ config('app.name') }}</p>

    <br>

    <p>
        Если у вас возникли проблемы с нажатием кнопки "сбросить пароль", скопируйте и вставьте URL-адрес ниже в свой веб-браузер:<br>
        {{ url(config('app.url').route('password.reset', ['token' => $token, 'email' => $email], false)) }}
    </p>
</div>
